<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests\clienteStoreRequest;
use App\Http\Requests\ClienteUpdateRequest;
use Illuminate\Support\Facades\Storage;

use Intervention\Image\ImageManagerStatic as Image;

use App\Helpers\FechaHelper;

use Alert;

use App\Http\Controllers\Controller;
use App\Models\Cliente;

use App\Models\Barrio;
use App\Models\Calle;
use App\Models\Departamento;
use App\Models\Empleado;
use App\Models\Localidad;
use App\Models\movil;
use App\Models\provincia;
use App\Models\TipoCliente;
use App\Models\Tipodocumento;
use App\Models\Companiatelefonica;
use App\Models\Tipoiva;



use App\Models\Modulo;
use App\Models\Perfil;
use Auth;

use App\Helpers\Animate;

class ClienteController extends Controller
{
    const IMG_PATH = 'image/clientes/';
    const IMG_WIDTH = 300;
    const IMG_HEIGHT = 300;


    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
        $perfil = Perfil::find(Auth::user()->perfil_id);
        $modulo_actual = Modulo::where('valor', '=', 'CLIENTE')->get();
        $modulos = $perfil->modulos()->where('modulo_id', '=', $modulo_actual[0]->id)->get();
        $permiso = $modulos[0]->pivot->permiso;

        $clientes = Cliente::type($request->get('type'), $request->get('val'))->paginate(10);
        $clientes->setPath('clientes');

        //dd($clientes);
        
       return view('admin.clientes.index', compact('clientes', 'permiso'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $companiatelefonicas  = Companiatelefonica::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        $provincias  = Provincia::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        $tipodocumentos  = Tipodocumento::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        $tipoivas  = Tipoiva::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        $tipoclientes  = Tipocliente::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');



        $estadoclientes    = [ 0 => 'Inactivo', 1 => 'Activo'];

        return view('admin.clientes.create', compact('companiatelefonicas', 'estadoclientes', 'provincias', 'tipodocumentos', 'tipoclientes', 'tipoivas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(clienteStoreRequest $request)
    {
        //dd($request->file('image'));

        $cliente = Cliente::create($request->all());

        $cliente->nrosocio = $cliente->id;
        $cliente->save();
        
       
        //image
        if($request->file('image')){
            Image::make($request->file('image'))
                ->resize(self::IMG_WIDTH,self::IMG_HEIGHT)
                ->save(self::IMG_PATH . $cliente->id . '.jpg');
            $cliente->fill(['file' => self::IMG_PATH . $cliente->id . '.jpg'])->save();
        }
        
        Alert::success('Cliente creado con exito')->persistent('Cerrar');

        //return redirect()->route('receptions.index');
        return redirect()->route('clientes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cliente = Cliente::find($id);

        $cliente->fechanacimiento = FechaHelper::getFechaInputDate( $cliente->fechanacimiento); 

        $cliente->fechaingreso = FechaHelper::getFechaInputDate( $cliente->fechaingreso); 

        $companiatelefonicas  = Companiatelefonica::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        $provincias  = Provincia::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        $departamentos  = Departamento::orderBy('descripcion', 'ASC')->where('provincia_id', $cliente->provincia_id)->pluck('descripcion' , 'id');

        $localidades  = Localidad::orderBy('descripcion', 'ASC')->where('departamento_id', $cliente->departamento_id)->pluck('descripcion' , 'id');

        $barrios  = Barrio::orderBy('descripcion', 'ASC')->where('localidad_id', $cliente->localidad_id)->pluck('descripcion' , 'id');

        $calles  = Calle::orderBy('descripcion', 'ASC')->where('barrio_id', $cliente->barrio_id)->pluck('descripcion' , 'id');

        $tipoivas  = Tipoiva::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        $tipoclientes  = Tipocliente::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

       $estadoclientes    = [ 0 => 'Inactivo', 1 => 'Activo'];



        return view('admin.clientes.show', compact('cliente','companiatelefonicas', 'estadoclientes', 'provincias', 'departamentos', 'localidades', 'barrios', 'calles', 'tipoivas', 'tipoclientes'));

       

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $cliente = Cliente::find($id);

        $cliente->fechanacimiento = FechaHelper::getFechaInputDate( $cliente->fechanacimiento); 

        $cliente->fechaingreso = FechaHelper::getFechaInputDate( $cliente->fechaingreso); 

        $companiatelefonicas  = Companiatelefonica::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        $provincias  = Provincia::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        $departamentos  = Departamento::orderBy('descripcion', 'ASC')->where('provincia_id', $cliente->provincia_id)->pluck('descripcion' , 'id');

        $localidades  = Localidad::orderBy('descripcion', 'ASC')->where('departamento_id', $cliente->departamento_id)->pluck('descripcion' , 'id');

        $barrios  = Barrio::orderBy('descripcion', 'ASC')->where('localidad_id', $cliente->localidad_id)->pluck('descripcion' , 'id');

        $calles  = Calle::orderBy('descripcion', 'ASC')->where('barrio_id', $cliente->barrio_id)->pluck('descripcion' , 'id');

        $tipoivas  = Tipoiva::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        $tipoclientes  = Tipocliente::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

       $estadoclientes    = [ 0 => 'Inactivo', 1 => 'Activo'];


        return view('admin.clientes.edit', compact('cliente','companiatelefonicas', 'estadoclientes', 'provincias', 'departamentos', 'localidades', 'barrios', 'calles', 'tipoivas', 'tipoclientes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClienteUpdateRequest $request, $id)
    {
        $cliente = Cliente::find($id);

        $cliente->fill($request->all())->save();

        //image
        if($request->file('image')){
            Image::make($request->file('image'))
                ->resize(self::IMG_WIDTH,self::IMG_HEIGHT)
                ->save(self::IMG_PATH . $cliente->id . '.jpg');
            $cliente->fill(['file' => self::IMG_PATH . $cliente->id . '.jpg'])->save();
        }
        
        Alert::success('Cliente Actualizado con exito')->persistent('Cerrar');

        //return redirect()->route('receptions.index');
        return redirect()->route('clientes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        /*if(Reception::where('client_id', $id)->first()) 
        {
            Alert::error('No se puede eliminar el registro');
            return back();
        }*/

        Cliente::find($id)->delete();

        Alert::success('Eliminado correctamente')->persistent('Cerrar');
        return back();
    }
}
