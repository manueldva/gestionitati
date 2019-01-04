<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\ArticuloStoreRequest;
use App\Http\Requests\ArticuloUpdateRequest;
use Alert;
use App\Models\Articulo;
use App\Models\Proveedor;
use App\Models\Rubro;

use App\Models\Venta;

use Auth;

use App\Helpers\FechaHelper;

class VentaController extends Controller
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

        $ventas = Venta::type($request->get('type'), $request->get('val'))->paginate(10);

        /*foreach($ventas as $venta){
            $articulo->fecha_alta = FechaHelper::getFechaImpresion($articulo->fecha_alta);
        }*/

        $ventas->setPath('ventas');

       return view('admin.ventas.index', compact('ventas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*$users  = User::orderBy('username', 'ASC')->where('username', Auth::user()->username)->pluck('username' , 'id');

        $servidores  = Servidor::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        $base_id = 0; // para que no tire error al tratar de cargar una base seleccionada

        $motivos  = Motivo::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');*/


        return view('admin.ventas.create'/*, compact('servidores','users', 'motivos', 'base_id')*/);
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
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function show(Venta $venta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function edit(Venta $venta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Venta $venta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Venta $venta)
    {
        //
    }
}
