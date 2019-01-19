<?php

namespace App\Http\Controllers\Admin\Complementos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Complementos\ProvinciaStoreRequest;
use App\Http\Requests\Complementos\ProvinciaUpdateRequest;
use Alert;

use App\Models\Provincia;
use App\Models\Cliente;
use App\Models\Modulo;
use App\Models\Perfil;
use Auth;

use App\Helpers\FechaHelper;

class ProvinciaController extends Controller
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
 

        $provincias = Provincia::type($request->get('type'), $request->get('val'))->paginate(10);

        foreach($provincias as $provincia){
            $provincia->fecha_alta = FechaHelper::getFechaImpresion($provincia->fecha_alta); 
        }

        $provincias->setPath('provincias');

         //dd($motivos);

       return view('admin.complementos.provincias.index', compact('provincias', 'permiso'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.complementos.provincias.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProvinciaStoreRequest $request)
    {
        $provincia = Provincia::create($request->all());

        //auditoria
        $provincia->fill(['usuario_alta' => Auth::user()->username , 'fecha_alta' => date('Y-m-d H:i:s')])->save();
        //
        Alert::success('Provincia creada con exito')->persistent("Cerrar");
        return back();
        //return redirect()->route('provincias.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $provincia = Provincia::find($id);

        $provincia->fecha_alta = FechaHelper::getFechaImpresion($provincia->fecha_alta); 

        return view('admin.complementos.provincias.show', compact('provincia'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $provincia = Provincia::find($id);

        return view('admin.complementos.provincias.edit', compact('provincia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProvinciaUpdateRequest $request, $id)
    {
        
        $provincia = Provincia::find($id);

        $provincia->fill($request->all())->save();


        //auditoria
        $provincia->fill(['usuario_modi' => Auth::user()->username , 'fecha_modi' => date('Y-m-d H:i:s')])->save();
        //

        Alert::success('Provincia actualizada con exito')->persistent("Cerrar");
        return redirect()->route('provincias.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $existe = Cliente::where('provincia_id', $id)->count();

        if($existe > 0) 
        {
            Alert::error('No se puede eliminar el registro')->persistent("Cerrar");
            return back();
        }
        
        Provincia::find($id)->delete();

        Alert::success('Eliminado correctamente')->persistent("Cerrar");
        return back();
    }
}
