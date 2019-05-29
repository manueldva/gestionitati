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
use App\Models\Proveedorajuste;
use App\Models\Motivoajuste;
use App\Models\Stockajuste;
use App\Models\Stockarticulo;
use App\Models\Stockarticulodetalle;

use DB;
use Illuminate\Support\Facades\Input;

use Auth;

class StockajusteController extends Controller
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

        $tipoajustes  = Tipoajuste::orderBy('id')->pluck('descripcion' , 'id');

        $motivoajustes  = Motivoajuste::orderBy('id')->pluck('descripcion' , 'id');

        $proveedorajustes  = Proveedorajuste::orderBy('id')->pluck('descripcion' , 'id');

        $stock = Stockarticulo::find($id);

        $stockdetalles = Stockarticulodetalle::where('stockarticulo_id', $id)->get();

        //dd($stock);

        return view('admin.stockajustes.edit', compact('articulos', 'sucursales', 'tipotiempos', 'tipoajustes', 'motivoajustes', 'proveedorajustes' , 'stock', 'stockdetalles'));
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
        $stockajuste = Stockajuste::create($request->all()); // uso update para dar de alta y no editar

        
        $stockajuste->fill(['stockarticulo_id' => $id, 'usuario_alta' => Auth::user()->username , 'fecha_alta' => date('Y-m-d H:i:s')])->save();
        //

        $stock = Stockarticulo::find($id);
            if($stockajuste->tipoajuste_id == 1)
            {
                $stock->stockactual =  (int)$stock->stockactual + (int)$stockajuste->cantidad ;
            } else if($stockajuste->tipoajuste_id == 2)
            {
                $stock->stockactual =  (int)$stock->stockactual - (int)$stockajuste->cantidad ;
            }
            $stock->usuario_modi = Auth::user()->username;
            $stock->fecha_modi = date('Y-m-d H:i:s');
        $stock->save();


        Alert::success('Ajuste realizado con exito')->persistent("Cerrar");
        return redirect()->route('stockajustes.edit', $id);

       
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
