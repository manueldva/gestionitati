<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\ModuloStoreRequest;
use App\Http\Requests\ModuloUpdateRequest;
use Alert;

use App\Models\Modulo;
use App\Models\Perfil;
use App\Models\Tipoempleado;
use App\Models\Empleado;
/*use App\Models\Hojaruta;
use App\Models\Hojarutadetalle;
use App\Models\Hojarutaarticuloextra;*/
use App\Models\Distrito;
use App\Models\Barrio;
use App\Models\Articulo;
use App\Models\Stockarticulo;
use App\Models\Stockarticulodetalle;
use App\Models\Stockasignacion;
use App\Models\Stockasignaciondetalle;

use DB;
use Illuminate\Support\Facades\Input;

use App\Helpers\FechaHelper;
use Barryvdh\DomPDF\Facade as PDF;


use Auth;

class AsignarStockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perfil = Perfil::find(Auth::user()->perfil_id);
        $modulo_actual = Modulo::where('valor', '=', 'STOCK')->get();
        $modulos = $perfil->modulos()->where('modulo_id', '=', $modulo_actual[0]->id)->get();
        $permiso = $modulos[0]->pivot->permiso;

        //$stockasignaciones = Stockasignacion::type($request->get('type'), $request->get('val'))->paginate(15);
        $stockasignaciones = Stockasignacion::paginate(15);
        foreach($stockasignaciones as $stockasignacion){
            $stockasignacion->fecha = FechaHelper::getFechaImpresion($stockasignacion->fecha); 
        }



        $stockasignaciones->setPath('stockasignaciones');

       
        return view('admin.stockasignaciones.index', compact('stockasignaciones', 'permiso'));

       
 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $articulos  = Articulo::where('tipoarticulo_id', '=', 1)->orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');


        $tipoempleado = Tipoempleado::where('descripcion', '=', 'Vendedor')->first();
        if($tipoempleado) {
            $empleados  = Empleado::orderBy('empleado', 'ASC')->where('tipoempleado_id', $tipoempleado->id)->where('Sucursal_id', 1)->pluck('empleado' , 'id');
                
            if(!$empleados) $empleados = [];
        } else {
            $empleados = [];
        }

        //$distritos  = Distrito::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        
        //$barrios  = Barrio::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        return view('admin.stockasignaciones.create', compact('empleados', 'articulos'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
}
