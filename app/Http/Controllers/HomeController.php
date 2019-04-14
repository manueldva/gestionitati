<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\Modulo;
use App\Models\Perfil;
use Illuminate\Support\Facades\Input;
use App\Helpers\FechaHelper;

use App\Models\Articulo;
use App\Models\Cliente;
use App\Models\Clientedireccion;
use App\Models\Contrato;
use App\Models\Contratoarticulo;
use App\Models\Barrio;
use App\Models\Tipocliente;

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

        $perfil = Perfil::find(Auth::user()->perfil_id);
        $modulo_actual = Modulo::where('valor', '=', 'TABLERO')->get();
        $modulos = $perfil->modulos()->where('modulo_id', '=', $modulo_actual[0]->id)->get();
        $permiso = $modulos[0]->pivot->permiso;


       $contratos = DB::table('contratos')
                    ->join('clientes', 'contratos.cliente_id', '=', 'clientes.id')
                    ->where('contratos.estado', '=', 1)
                    ->where('clientes.estado', '=', 1)
                    ->count();

        return view('home', compact('contratos', 'permiso'));
    }


    public function detalleinformecontratos(Request $request)
    { 

        $barrios  = Barrio::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');
        
        $data = [];

        $articulos = Articulo::where('tipoarticulo_id', '<>', 3)->orderBy('descripcion')->get();

        if($request->get('barrios') == null) {
            $contratos = DB::table('contratos')
                    ->join('clientes', 'contratos.cliente_id', '=', 'clientes.id')
                    ->where('contratos.estado', '=', 1)
                    ->where('clientes.estado', '=', 1)
                    ->count();
        } else {
            $contratos = DB::table('contratos')
                    ->join('clientedirecciones', 'contratos.clientedireccion_id', '=', 'clientedirecciones.id')
                    ->join('clientes', 'contratos.cliente_id', '=', 'clientes.id')
                    ->where('contratos.estado', '=', 1)
                    ->where('clientes.estado', '=', 1)
                    ->where('clientedirecciones.barrio_id', '=', $request->get('barrios'))
                    ->count();
        }

        foreach ($articulos as $key => $value) {
            
            //$contratos = Contratoarticulo::where('articulo_id', $value->id)->count();
            if($request->get('barrios') == null) {
      
                $temp = DB::table('contratoarticulos')
                         ->select(DB::raw('sum(cantidad) as cantidad'))
                         ->where('articulo_id', '=', $value->id)
                         ->first();

            } else {
                $temp = DB::table('contratoarticulos')
                    ->select(DB::raw('sum(contratoarticulos.cantidad) as cantidad'))
                    ->join('contratos', 'contratoarticulos.contrato_id', '=', 'contratos.id')
                    ->join('clientedirecciones', 'contratos.clientedireccion_id', '=', 'clientedirecciones.id')
                    ->where('contratoarticulos.articulo_id', '=', $value->id)
                    ->where('clientedirecciones.barrio_id', '=', $request->get('barrios'))
                    ->first();
            }

            if ($temp->cantidad == null) {
                $cantidad = 0;
            } else {
                $cantidad = $temp->cantidad;
            }


            $data [] = ['codigo' => $value->id,  'articulo' => $value->descripcion, 'cantidad' => $cantidad];

        }

        return view('admin.home.detalleinformecontratos', compact('data', 'barrios', 'contratos'));
    }


    public function informecontratosbarriosarticulos()
    { 

        $barrios  = Barrio::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');
        $articulos  = Articulo::orderBy('descripcion', 'ASC')->where('tipoarticulo_id', '<>', 3)->pluck('descripcion' , 'id');
        
        
       return view('admin.home.informecontratosbarriosarticulos', compact('barrios', 'articulos'));
    }
}
