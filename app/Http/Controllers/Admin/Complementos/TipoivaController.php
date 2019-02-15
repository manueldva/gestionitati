<?php

namespace App\Http\Controllers\Admin\Complementos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Complementos\TipoivaStoreRequest;
use App\Http\Requests\Complementos\TipoivaUpdateRequest;
use Alert;

use App\Models\Tipoiva;
use App\Models\Cliente;
use App\Models\Modulo;
use App\Models\Perfil;
use Auth;

use App\Helpers\FechaHelper;

class TipoivaController extends Controller
{
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
        $modulo_actual = Modulo::where('valor', '=', 'COMPLEMENTO')->get();
        $modulos = $perfil->modulos()->where('modulo_id', '=', $modulo_actual[0]->id)->get();
        $permiso = $modulos[0]->pivot->permiso;
 

        $tipoivas = Tipoiva::type($request->get('type'), $request->get('val'))->paginate(15);

        foreach($tipoivas as $tipoiva){
            $tipoiva->fecha_alta = FechaHelper::getFechaImpresion($tipoiva->fecha_alta); 
        }

        $tipoivas->setPath('tipoivas');

         //dd($motivos);

       return view('admin.complementos.tipoivas.index', compact('tipoivas', 'permiso'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.complementos.tipoivas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(tipoivastoreRequest $request)
    {
        $tipoiva = Tipoiva::create($request->all());

        //auditoria
        $tipoiva->fill(['usuario_alta' => Auth::user()->username , 'fecha_alta' => date('Y-m-d H:i:s')])->save();
        //
        Alert::success('Tipo Iva creado con exito')->persistent("Cerrar");
        //return redirect()->route('tipoivas.index');
        return redirect()->route('tipoivas.edit', $tipoiva->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipoiva = Tipoiva::find($id);

        $tipoiva->fecha_alta = FechaHelper::getFechaImpresion($tipoiva->fecha_alta); 

        return view('admin.complementos.tipoivas.show', compact('tipoiva'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipoiva = Tipoiva::find($id);

        return view('admin.complementos.tipoivas.edit', compact('tipoiva'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TipoivaUpdateRequest $request, $id)
    {
        
        $tipoiva = Tipoiva::find($id);

        $tipoiva->fill($request->all())->save();


        //auditoria
        $tipoiva->fill(['usuario_modi' => Auth::user()->username , 'fecha_modi' => date('Y-m-d H:i:s')])->save();
        //

        Alert::success('Tipo Iva actualizado con exito')->persistent("Cerrar");
        //return redirect()->route('tipoivas.index');
        return redirect()->route('tipoivas.edit', $tipoiva->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $existe = Cliente::where('tipoiva_id', $id)->count();

        if($existe > 0) 
        {
            Alert::error('No se puede eliminar el registro')->persistent("Cerrar");
            return back();
        }

        
        Tipoiva::find($id)->delete();

        Alert::success('Eliminado correctamente')->persistent("Cerrar");
        return back();
    }
}