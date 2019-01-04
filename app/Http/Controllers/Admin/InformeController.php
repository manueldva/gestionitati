<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Alert;

use App\Models\Servidor;
use App\User;
use App\Models\Base;
use App\Models\Motivo;
use App\Models\Tarea;
use Auth;

use App\Helpers\FechaHelper;

use Barryvdh\DomPDF\Facade as PDF;

class InformeController extends Controller
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
        $usuarios  = User::orderBy('username', 'ASC')->where('id', '<>', 1)->pluck('username' , 'username');


        return view('admin.informes.show',compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function informeprint($usuario, $fechadesde, $fechahasta)
    {

        //return  $fechadesde;
        if($usuario == 'Todos')
        {
            $tareas = Tarea::orderBy('id', 'DESC')->whereBetween('fecha', array($fechadesde, $fechahasta))->get();
        }else{
            $tareas = Tarea::orderBy('id', 'DESC')->where('usuario_alta', $usuario)->whereBetween('fecha', array($fechadesde, $fechahasta))->get();
        }

        //$tareas = Tarea::orderBy('fecha', 'DESC')->where('usuario_alta', $usuario)->whereBetween('fecha', array($fechadesde, $fechahasta))->get();

        foreach($tareas as $tarea){
            $tarea->fecha = FechaHelper::getFechaImpresion($tarea->fecha); 
        }

        $pdf = PDF::loadView('admin.informes.informeprint', compact('tareas', 'usuario', 'fechadesde', 'fechahasta'));

        return $pdf->stream('reporte.pdf');


    }


}
