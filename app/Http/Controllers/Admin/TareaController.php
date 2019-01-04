<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\TareaStoreRequest;
use App\Http\Requests\TareaUpdateRequest;
use Illuminate\Support\Facades\Storage;
use Alert;

use App\Models\Servidor;
use App\User;
use App\Models\Base;
use App\Models\Motivo;
use App\Models\Tarea;
use Auth;

use App\Helpers\FechaHelper;


class TareaController extends Controller
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
       
        $tareas = Tarea::type($request->get('type'), $request->get('val'), $request->get('servidor_id'))->paginate(10);

        foreach($tareas as $tarea){
            $tarea->fecha = FechaHelper::getFechaImpresion($tarea->fecha); 
        }

        $tareas->setPath('tareas');

        $servidores  = Servidor::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

       return view('admin.tareas.index', compact('tareas', 'servidores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $users  = User::orderBy('username', 'ASC')->where('username', Auth::user()->username)->pluck('username' , 'id');

        $servidores  = Servidor::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        $base_id = 0; // para que no tire error al tratar de cargar una base seleccionada

        $motivos  = Motivo::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');



        return view('admin.tareas.create', compact('servidores','users', 'motivos', 'base_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TareaStoreRequest $request)
    {

        $tarea = Tarea::create($request->all());

        //auditoria
        $tarea->fill(['usuario_alta' => Auth::user()->username , 'fecha_alta' => date('Y-m-d H:i:s')])->save();
        //
        Alert::success('Tarea creada con exito')->persistent("Cerrar");
        return redirect()->route('tareas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tarea = Tarea::find($id);

        //$tarea->fecha_alta = FechaHelper::getFechaImpresion($tarea->fecha_alta); 

        $tarea->fecha = FechaHelper::getFechaImpresion($tarea->fecha); 

        return view('admin.tareas.show', compact('tarea'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tarea = Tarea::find($id);

        $users  = User::orderBy('username', 'ASC')->where('username', $tarea->usuario_alta)->pluck('username' , 'id');

        $servidores  = Servidor::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        $motivos  = Motivo::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        $tarea->fecha = FechaHelper::getFechaInputDate($tarea->fecha); 

        // para seleccinar la base guardada anteriormente
        if($tarea->base_id) {
            $base_id = $tarea->base_id;
        }else
        {
            $base_id = 0;
        }
        
        return view('admin.tareas.edit', compact('tarea', 'motivos', 'servidores', 'users', 'base_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TareaUpdateRequest $request, $id)
    {
        $tarea = Tarea::find($id);

        $tarea->fill($request->all())->save();


        //auditoria
        $tarea->fill(['usuario_modi' => Auth::user()->username , 'fecha_modi' => date('Y-m-d H:i:s')])->save();
        //

        Alert::success('Tarea actualizada con exito')->persistent("Cerrar");
        return redirect()->route('tareas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        /*$existe = Articulo::where('color_id', $id)->count();

        if($existe > 0) 
        {
            Alert::error('No se puede eliminar el registro')->persistent("Cerrar");
            return back();
        }*/
        

        Tarea::find($id)->delete();

        Alert::success('Eliminado correctamente')->persistent("Cerrar");
        return back();
    }




    public function TA_obtenerbases($id)
    {
        $resultado = array();

        $bases  = Base::orderBy('descripcion', 'ASC')->where('servidor_id', $id)->get();

        foreach ($bases as $key => $value) {
           $resultado[] = ['id' => $value->id, 'descripcion' => $value->descripcion];
        }
        
        return $resultado;
        
    }


}
