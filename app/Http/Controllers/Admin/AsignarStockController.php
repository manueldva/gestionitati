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
use App\Models\Sucursal;
/*use App\Models\Hojaruta;
use App\Models\Hojarutadetalle;
use App\Models\Hojarutaarticuloextra;*/
use App\Models\Distrito;
use App\Models\Barrio;
use App\Models\Articulo;
use App\Models\Venta;
use App\Models\Stockarticulo;
use App\Models\Stockventa;
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

        //dd($perfil);
        //$stockasignaciones = Stockasignacion::type($request->get('type'), $request->get('val'))->paginate(15);
        $stockasignaciones = Stockasignacion::orderBy('id','DESC')->paginate(15);
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
        //$articulos  = Articulo::where('tipoarticulo_id', '=', 1)->orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');
        $sucursales  = Sucursal::where('id',1)->orderBy('id')->pluck('descripcion' , 'id');


        $tipoempleado = Tipoempleado::where('descripcion', '=', 'Vendedor')->first();
        if($tipoempleado) {
            $empleados  = Empleado::orderBy('empleado', 'ASC')->where('tipoempleado_id', $tipoempleado->id)->where('Sucursal_id', 1)->pluck('empleado' , 'id');
                
            if(!$empleados) $empleados = [];
        } else {
            $empleados = [];
        }


        $articulos  = DB::table('articulos')
            ->join('stockarticulodetalles', 'stockarticulodetalles.articulo_id', '=', 'articulos.id')
            ->join('stockarticulos', 'stockarticulos.id', '=', 'stockarticulodetalles.stockarticulo_id')
            ->join('stockventas', 'stockventas.stockarticulo_id', '=', 'stockarticulos.id')
            ->select('stockarticulos.descripcion', 'stockarticulos.id')
            ->where('articulos.tipoarticulo_id', '=', 1)
            ->pluck('descripcion', 'id');
           // ->pluck('descripcion', 'id');

        //dd($articulos );
        //$distritos  = Distrito::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        
        //$barrios  = Barrio::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        return view('admin.stockasignaciones.create', compact('empleados', 'articulos', 'sucursales'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $stockasignacion = Stockasignacion::create($request->all());

        //$descripciontemp = '';

        $listado_stocks_text = $request->input("listado_stocks");

        if($listado_stocks_text) {


            $listado_stocks_array = explode('&&&', $listado_stocks_text);
            array_pop($listado_stocks_array);



            foreach ($listado_stocks_array as $stock_text)
            {
                list($codigo, $cantidad) = explode('|', $stock_text);

                $stockasignaciondetalle = new Stockasignaciondetalle();
                    $stockasignaciondetalle->stockasignacion_id = $stockasignacion->id;
                    $stockasignaciondetalle->stockventa_id = $codigo;
                    $stockasignaciondetalle->cantidad = $cantidad;
                    $stockasignaciondetalle->usuario_alta = Auth::user()->username;
                    $stockasignaciondetalle->fecha_alta = date('Y-m-d H:i:s');

                $stockasignaciondetalle->save();

                $stockventa = Stockventa::find($codigo);
                    $stockventa->stockactual = intval($stockventa->stockactual) - intval($cantidad);
                    $stockventa->usuario_modi = Auth::user()->username;
                    $stockventa->fecha_modi = date('Y-m-d H:i:s');
                $stockventa->save();

                /*if($descripciontemp == '')
                {
                    $descripciontemp = $descripcion;
                } else 
                {
                    $descripciontemp = $descripciontemp . ' - ' . $descripcion;
                }*/
            }
        }

        //auditoria
        $stockasignacion->fill(['estado'=> 1, 'usuario_alta' => Auth::user()->username , 'fecha_alta' => date('Y-m-d H:i:s')])->save();
        //


        Alert::success('Asiganción creada con exito')->persistent("Cerrar");
        return redirect()->route('stockasignaciones.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $show = 1;

        $stockasignacion = Stockasignacion::find($id);

        $stockasignaciondetalles = Stockasignaciondetalle::where('stockasignacion_id',$id)->get();

        //dd( $stockasignaciondetalles);
        $stockasignacion->fecha = FechaHelper::getFechaInputDate($stockasignacion->fecha); 

        //$distritos  = Distrito::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        
        //$barrios  = Barrio::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        return view('admin.stockasignaciones.show', compact('stockasignacion' , 'stockasignaciondetalles', 'show'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $show = 0;
        $stockasignacion = Stockasignacion::find($id);

        $stockasignaciondetalles = Stockasignaciondetalle::where('stockasignacion_id',$id)->get();

        //dd( $stockasignaciondetalles);
        $stockasignacion->fecha = FechaHelper::getFechaInputDate($stockasignacion->fecha); 

        //$distritos  = Distrito::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        
        //$barrios  = Barrio::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        return view('admin.stockasignaciones.edit', compact('stockasignacion' , 'stockasignaciondetalles', 'show'));
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
        
        $stockasignacion = Stockasignacion::find($id);


        //auditoria
        $stockasignacion->fill(['estado'=> 2, 'usuario_modi' => Auth::user()->username , 'fecha_modi' => date('Y-m-d H:i:s')])->save();
        //


        //$descripciontemp = '';

        $listado_stocks_text = $request->input("listado_stocks");

        if($listado_stocks_text) {


            $listado_stocks_array = explode('&&&', $listado_stocks_text);
            array_pop($listado_stocks_array);



            foreach ($listado_stocks_array as $stock_text)
            {
                list($codigo, $cantidad, $devuelve,$vacios,$vacioscierre) = explode('|', $stock_text);

                    $stockasignaciondetalle = Stockasignaciondetalle::find($id);
                        $stockasignaciondetalle->devuelve = $devuelve;
                        $stockasignaciondetalle->vacios = $vacios;
                        $stockasignaciondetalle->vacioscierrecontrato = $vacioscierre;
                        $stockasignaciondetalle->usuario_alta = Auth::user()->username;
                        $stockasignaciondetalle->fecha_alta = date('Y-m-d H:i:s');

                    $stockasignaciondetalle->save();

                    if($devuelve > 0){
                        $stockventa = Stockventa::find($stockasignaciondetalle->stockventa_id);
                            $stockventa->stockactual = intval($stockventa->stockactual) + intval($devuelve);
                            $stockventa->usuario_modi = Auth::user()->username;
                            $stockventa->fecha_modi = date('Y-m-d H:i:s');
                        $stockventa->save();
                    }

                /*if($descripciontemp == '')
                {
                    $descripciontemp = $descripcion;
                } else 
                {
                    $descripciontemp = $descripciontemp . ' - ' . $descripcion;
                }*/
            }
        }



        Alert::success('Asiganción creada con exito')->persistent("Cerrar");
        return redirect()->route('stockasignaciones.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        Stockasignaciondetalle::where('stockasignacion_id', $id)->delete();    

        Stockasignacion::find($id)->delete();

        Alert::success('Eliminado correctamente')->persistent('Cerrar');
        return back();
    }



    public function printstocksignacion($id)
    {

        $stockasignacion = Stockasignacion::find($id);

        $stockasignacion->fecha = FechaHelper::getFechaInputDate($stockasignacion->fecha); 
        
        $stockasignaciondetalles = Stockasignaciondetalle::where('stockasignacion_id', $id)->get();

        
        $cantidad = Stockasignaciondetalle::where('stockasignacion_id', $id)->sum('cantidad');

        //dd($cantidad);
        $pdf = PDF::loadView('admin.stockasignaciones.printstocksignacion', compact('stockasignacion', 'stockasignaciondetalles', 'cantidad'));
            //$pdf->setPaper('Legal', 'landscape');

            return $pdf->setPaper('Legal', 'landscape')->stream('detalle.pdf');
    }
}
