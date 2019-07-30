<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\ModuloStoreRequest;
use App\Http\Requests\ModuloUpdateRequest;
use Alert;

use App\Models\Modulo;
use App\Models\Perfil;

use App\Models\Articulo;
use App\Models\Venta;
use App\Models\Ventadetalle;

use DB;
use Illuminate\Support\Facades\Input;

use App\Helpers\FechaHelper;
use Barryvdh\DomPDF\Facade as PDF;

use Auth;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perfil = Perfil::find(Auth::user()->perfil_id);
        $modulo_actual = Modulo::where('valor', '=', 'VENTAS')->get();
        $modulos = $perfil->modulos()->where('modulo_id', '=', $modulo_actual[0]->id)->get();
        $permiso = $modulos[0]->pivot->permiso;

        //$stockasignaciones = Stockasignacion::type($request->get('type'), $request->get('val'))->paginate(15);
        $ventas = Venta::orderBy('id','DESC')->paginate(15);
        foreach($ventas as $venta){
            $venta->fecha = FechaHelper::getFechaImpresion($venta->fecha); 

            $cant = Ventadetalle::where('venta_id', $venta->id)->sum('cantidad');
            $venta->usuario_modi = $cant;
        }


        $ventas->setPath('ventas');

       
        return view('admin.ventas.index', compact('ventas', 'permiso'));

       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $articulos  = Articulo::where('tipoarticulo_id', '=', 1)->where('estado', 1)->orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');



        return view('admin.ventas.create', compact('articulos'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $venta = Venta::create($request->all());

        //$descripciontemp = '';

        $listado_articulos_text = $request->input("listado_articulos");

        if($listado_articulos_text) {


            $listado_articulos_array = explode('&&&', $listado_articulos_text);
            array_pop($listado_articulos_array);



            foreach ($listado_articulos_array as $articulo_text)
            {
                list($codigo, $cantidad) = explode('|', $articulo_text);

                 $articulo = Articulo::find($codigo);

                $ventadetalle = new Ventadetalle();
                    $ventadetalle->venta_id = $venta->id;
                    $ventadetalle->articulo_id = $codigo;
                    $ventadetalle->precio = $articulo->precioventa;
                    $ventadetalle->cantidad = $cantidad;
                    $ventadetalle->usuario_alta = Auth::user()->username;
                    $ventadetalle->fecha_alta = date('Y-m-d H:i:s');

                $ventadetalle->save();

               

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
        $venta->fill(['usuario_alta' => Auth::user()->username , 'fecha_alta' => date('Y-m-d H:i:s')])->save();
        //


        Alert::success('Venta Registrada con Exito')->persistent("Cerrar");
        return redirect()->route('ventas.index');
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
        Ventadetalle::where('venta_id', $id)->delete();    

        Venta::find($id)->delete();

        Alert::success('Eliminado correctamente')->persistent('Cerrar');
        return back();

    }
}
