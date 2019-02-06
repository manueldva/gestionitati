<?php

namespace App\Http\Controllers\Admin\Complementos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//use App\Http\Requests\Complementos\LocalidadStoreRequest;
use App\Http\Requests\Complementos\LocalidadUpdateRequest;
use Alert;
use App\Models\Provincia;
use App\Models\Departamento;
use App\Models\Localidad;
use App\Models\Cliente;
use App\Models\Calle;
use App\Models\Barrio;
use App\Models\Modulo;
use App\Models\Perfil;
use Auth;

use App\Helpers\FechaHelper;

class LocalidadController extends Controller
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
 

        $localidades = Localidad::type($request->get('type'), $request->get('val'))->paginate(15);

        foreach($localidades as $localidad){
            $localidad->fecha_alta = FechaHelper::getFechaImpresion($localidad->fecha_alta); 
        }

        $localidades->setPath('localidades');

         //dd($motivos);

       return view('admin.complementos.localidades.index', compact('localidades', 'permiso'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provincias  = Provincia::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');


        return view('admin.complementos.localidades.create', compact('provincias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $listado_localidades_text = $request->input("listado_localidades");
        
        $listado_localidades_array = explode('&&&', $listado_localidades_text);
        array_pop($listado_localidades_array);

        //dd($listado_localidades_array);

		foreach ($listado_localidades_array as $localidad_text)
		{
			list($provincia_id, $departamento_id,
            $descripcion, $sinbarrio) = explode('|', $localidad_text);

			$localidad = new Localidad();
                $localidad->provincia_id = $provincia_id;
                $localidad->departamento_id = $departamento_id;
                $localidad->descripcion = $descripcion;
                $localidad->sinbarrio = $sinbarrio;
                $localidad->usuario_alta = Auth::user()->username;
                $localidad->fecha_alta = date('Y-m-d H:i:s');

			$localidad->save();
		}

        //
        Alert::success('Localidad creada con exito')->persistent("Cerrar");
        return redirect()->route('localidades.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $localidad = Localidad::find($id);

        $localidad->fecha_alta = FechaHelper::getFechaImpresion($localidad->fecha_alta); 

        return view('admin.complementos.localidades.show', compact('localidad'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $localidad = Localidad::find($id);

        //dd($localidad->sinbarrio);

        return view('admin.complementos.localidades.edit', compact('localidad', 'provincias', 'departamentos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LocalidadUpdateRequest $request, $id)
    {
        $localidad = Localidad::find($id); 
        $departamento = Departamento::where('id', $localidad->departamento_id)->first();

        /*validacion en el controlador por que el request personalizado no lo permite*/
        $existe = Localidad::where('departamento_id', $departamento->id)->where('descripcion', '=', $request->get('descripcion'))->where('id', '<>', $id)->count();

        if($existe > 0) 
        {
            Alert::error('Esta localdidad ya fue creada y asociada a este departamento')->persistent("Cerrar");
            return back()->withinput();
        }
        



        $localidad->fill($request->all())->save();

        if($request->input('sinbarrio') == '1'){
            $sinbarrio = 1;
        }  else {
            $sinbarrio = 0;
        }
        


        //auditoria
        $localidad->fill(['sinbarrio' => $sinbarrio, 'usuario_modi' => Auth::user()->username , 'fecha_modi' => date('Y-m-d H:i:s')])->save();
        //

        Alert::success('Localidad actualizada con exito')->persistent("Cerrar");
        return redirect()->route('localidades.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $existe = Cliente::where('localidad_id', $id)->count();

        if($existe > 0) 
        {
            Alert::error('No se puede eliminar el registro')->persistent("Cerrar");
            return back();
        }

        $existe = Barrio::where('localidad_id', $id)->count();

        if($existe > 0) 
        {
            Alert::error('No se puede eliminar el registro')->persistent("Cerrar");
            return back();
        }

        $existe = Calle::where('localidad_id', $id)->count();

        if($existe > 0) 
        {
            Alert::error('No se puede eliminar el registro')->persistent("Cerrar");
            return back();
        }

        
        Localidad::find($id)->delete();

        Alert::success('Eliminado correctamente')->persistent("Cerrar");
        return back();
    }
}
