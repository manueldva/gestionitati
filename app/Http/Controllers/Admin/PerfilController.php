<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\PerfilStoreRequest;
use App\Http\Requests\PerfilUpdateRequest;
use Alert;

use App\Models\Modulo;
use App\Models\Perfil;
use App\User;
use Auth;

class PerfilController extends Controller
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
 

        $perfiles = Perfil::type($request->get('type'), $request->get('val'))->paginate(15);

        $perfiles->setPath('perfiles');

        if ($permiso == 0 ) return back();

       return view('admin.seguridad.perfiles.index', compact('perfiles', 'permiso'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.seguridad.perfiles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PerfilStoreRequest $request)
    {
        $perfil = perfil::create($request->all());

        //auditoria
        $perfil->fill(['usuario_modi' => Auth::user()->username , 'fecha_alta' => date('Y-m-d H:i:s')])->save();
        //
        
        Alert::success('Debe asignar los permisos a este nuevo perfil','Perfil creado con exito')->persistent("Cerrar");
        //return redirect()->route('perfiles.edit', $perfil->id);
        return $this->asignarmodulo($perfil->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $perfil = Perfil::find($id);


        return view('admin.seguridad.perfiles.show', compact('perfil'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $perfil = Perfil::find($id);

        return view('admin.seguridad.perfiles.edit', compact('perfil'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PerfilUpdateRequest $request, $id)
    {
        
        $perfil = Perfil::find($id);

        $perfil->fill($request->all())->save();

        //auditoria
        $perfil->fill(['usuario_modi' => Auth::user()->username , 'fecha_modi' => date('Y-m-d H:i:s')])->save();
        //

        Alert::success('Perfil actualizado con exito')->persistent("Cerrar");
        return redirect()->route('perfiles.edit', $perfil->id);
    }

    public function asignarmodulo($id)
    {
        $perfil = Perfil::findOrFail($id);
        $modulos = Modulo::orderby('descripcion')->get();

        $modulos_permisos = $perfil->modulos()->get();

        //echo $x[4]->pivot->permiso;

        //highlight_string(var_export($x,true));
        //exit;

        return view(
            'admin.seguridad.perfiles.asignarmodulo',
            [
                'perfil' => $perfil,
                'modulos' => $modulos,
                'modulos_permisos' => $modulos_permisos
            ]
        );
    }

    public function guardarpermisos(Request $request, $id)
    {
        $perfil = Perfil::findOrFail($id);
        $modulos = Modulo::get();

        foreach ($modulos as $modulo) {

            $perfil->modulos()->detach($modulo->id);

            $permiso = $request->input($modulo->id);

            $perfil->modulos()->attach(
                $modulo->id,
                array('permiso' => $permiso)
                );
        }

        Alert::success('Permisos actualizados correctamente.')->persistent("Cerrar");
        return $this->asignarmodulo($id);
        //return back();

        //return redirect('seguridad/perfiles/asignarmodulo/'.$id);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        //$existe = Perfil::find($id)->modulos()->count();
        $existe = User::where('perfil_id', $id)->count();

        //dd($existe);

        if($existe > 0) 
        {
            Alert::error('No se puede eliminar el registro')->persistent("Cerrar");
            return back();
        }

        $perfil = Perfil::findOrFail($id);
        $modulos = Modulo::get();

        foreach ($modulos as $modulo) {

            $perfil->modulos()->detach($modulo->id);

        }

        Perfil::find($id)->delete();

        Alert::success('Eliminado correctamente')->persistent("Cerrar");
        return back();
    }
}
