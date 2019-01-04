<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

//use App\Models\Tarea;
use Auth;
/*use App\Models\Compra;
use App\Models\Comprapago;
use App\Models\Venta;
use App\Models\Ventapago;
use App\Models\Cliente;
use Illuminate\Support\Facades\Input;*/

use App\Helpers\FechaHelper;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$mistareasabiertas  = Tarea::where('usuario_alta', Auth::user()->username)->where('estado','Abierta')->count();

        $otrastareasabiertas  = Tarea::where('usuario_alta', '<>' , Auth::user()->username)->where('estado','Abierta')->count();*/
        
        //return view('home', compact('mistareasabiertas', 'otrastareasabiertas'));
        return view('home');
    }


    public function detallemistareasabiertas(Request $request)
    { 
        
        /*$ventas = array();

        //$comp = Compra::orderBy('nrofactura')->get();
        $fechaventa = date('Y-m-d 00:00:01');*/

        $miusuario = 1;

        $tareas =  Tarea::where('usuario_alta', Auth::user()->username)->where('estado','Abierta')->paginate(10);


        $tareas->setPath('detallemistareasabiertas');

        return view('admin.home.detalletareasabiertas',compact('tareas', 'miusuario'));

        //return view('homeinforme.listadoventasdiarias', ['ventas' => $ventas]); 
    }

    public function detalleotrastareasabiertas(Request $request)
    { 
        
        /*$ventas = array();

        //$comp = Compra::orderBy('nrofactura')->get();
        $fechaventa = date('Y-m-d 00:00:01');*/

        $miusuario = 0;

        $tareas =  Tarea::where('usuario_alta','<>' , Auth::user()->username)->where('estado','Abierta')->paginate(10);


        $tareas->setPath('detallemistareasabiertas');

        return view('admin.home.detalletareasabiertas',compact('tareas', 'miusuario'));

        //return view('homeinforme.listadoventasdiarias', ['ventas' => $ventas]); 
    }
}
