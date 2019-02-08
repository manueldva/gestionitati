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
use App\Models\Modulo;
use App\Models\Perfil;

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
        $perfil = Perfil::find(Auth::user()->perfil_id);
        $modulo_actual = Modulo::where('valor', '=', 'TABLERO')->get();
        $modulos = $perfil->modulos()->where('modulo_id', '=', $modulo_actual[0]->id)->get();
        $permiso = $modulos[0]->pivot->permiso;
 
        return view('home', compact('permiso'));
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
