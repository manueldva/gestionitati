<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\ModuloStoreRequest;
use App\Http\Requests\ModuloUpdateRequest;
use Alert;

use App\Models\Modulo;
use App\Models\Perfil;
use Auth;

class ModuloController extends Controller
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
        $modulo_actual = Modulo::where('valor', '=', 'SEGURIDAD')->get();
        $modulos = $perfil->modulos()->where('modulo_id', '=', $modulo_actual[0]->id)->get();
        $permiso = $modulos[0]->pivot->permiso;
 

        $modulos = Modulo::type($request->get('type'), $request->get('val'))->paginate(10);

        $modulos->setPath('modulos');

        if ($permiso == 0 ) return back();

       return view('admin..seguridad.modulos.index', compact('modulos', 'permiso'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.seguridad.modulos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ModuloStoreRequest $request)
    {
        $modulo = Modulo::create($request->all());

        //auditoria
        $modulo->fill(['usuario_alta' => Auth::user()->username , 'fecha_alta' => date('Y-m-d H:i:s')])->save();
        //
        Alert::success('Modulo creado con exito')->persistent("Cerrar");
        return redirect()->route('modulos.edit', $modulo->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $modulo = Modulo::find($id);


        return view('admin.seguridad.modulos.show', compact('modulo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $modulo = Modulo::find($id);

        return view('admin.seguridad.modulos.edit', compact('modulo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ModuloUpdateRequest $request, $id)
    {
        
        $modulo = Modulo::find($id);

        $modulo->fill($request->all())->save();


        //auditoria
        $modulo->fill(['usuario_modi' => Auth::user()->username , 'fecha_modi' => date('Y-m-d H:i:s')])->save();
        //

        Alert::success('Modulo actualizado con exito')->persistent("Cerrar");
        return redirect()->route('modulos.edit', $modulo->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $existe = Modulo::find($id)->perfiles()->count();

        //dd($existe);

        if($existe > 0) 
        {
            Alert::error('No se puede eliminar el registro')->persistent("Cerrar");
            return back();
        }

        Modulo::find($id)->delete();

        Alert::success('Eliminado correctamente')->persistent("Cerrar");
        return back();
    }
}
