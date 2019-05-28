<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\ModuloStoreRequest;
use App\Http\Requests\ModuloUpdateRequest;
use Alert;

use App\Models\Modulo;
use App\Models\Perfil;

use App\Models\Sucursal;
use App\Models\Articulo;
use App\Models\Tipotiempo;
use App\Models\Tipoajuste;
use App\Models\Proveesdorajuste;
use App\Models\Stockarticulo;
use App\Models\Stockarticulodetalle;

use DB;
use Illuminate\Support\Facades\Input;

use Auth;

class StockdetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $articulos  = Articulo::where('tipoarticulo_id', '=', 1)->orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        $sucursales  = Sucursal::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        $tipotiempos  = Tipotiempo::orderBy('id')->pluck('descripcion' , 'id');


        $stock = Stockarticulo::find($id);

        $stockdetalles = Stockarticulodetalle::where('stockarticulo_id', $id)->get();

        //dd($stock);

        return view('admin.stockdetalles.edit', compact('articulos', 'sucursales', 'tipotiempos', 'stock', 'stockdetalles'));
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
