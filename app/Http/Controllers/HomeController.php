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
use App\Models\Contrato;
use App\Models\Contratoarticulo;
use App\Models\Barrio;

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


         $contratos = DB::table('contratos')->count();

        return view('home', compact('contratos', 'permiso'));
    }


    public function detalleinformecontratos(Request $request)
    { 
            /*$data = DB::select(DB::raw('CALL InformeHomeArticuloGeneraldetalle()'));

            // parametros para la paginacion
            $page = Input::get('page', 1);
            $paginate = 15;
            //
            $offSet = ($page * $paginate) - $paginate; //calcula la cantidad de paginas
            $itemsForCurrentPage = array_slice($data, $offSet, $paginate, true); //calcula que pagina es la actual
            $articulos = new \Illuminate\Pagination\LengthAwarePaginator($itemsForCurrentPage, count($data), $paginate, $page);//genera el paginador personalizado

            $articulos->setPath('detallegeneralfaltantehome'); //general arl personalizada

            return view('admin.home.informearticulogeneralfaltante',compact('articulos'));

            //return view('admin.home.informearticulogondolafaltante', compact('articulos'));*/



        $barrios  = Barrio::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');
        
        $data = [];

        $articulos = Articulo::orderBy('descripcion')->get();

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

        return view('admin.home.detalleinformecontratos', compact('data', 'barrios'));
    }
}
