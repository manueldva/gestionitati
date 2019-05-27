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

use Auth;


class StockController extends Controller
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
    public function index()
    {
       $perfil = Perfil::find(Auth::user()->perfil_id);
        $modulo_actual = Modulo::where('valor', '=', 'STOCK')->get();
        $modulos = $perfil->modulos()->where('modulo_id', '=', $modulo_actual[0]->id)->get();
        $permiso = $modulos[0]->pivot->permiso;
 

        $sucursales  = Sucursal::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');
        //$stocks =  Stockarticulo::type($request->get('type'), $request->get('val'))->paginate(15);
        $stocks =  Stockarticulo::paginate(15);

        /*foreach($barrios as $barrio){
            $barrio->fecha_alta = FechaHelper::getFechaImpresion($barrio->fecha_alta); 
        }*/

        $stocks->setPath('stocks');

         //dd($motivos);

       return view('admin.stocks.index', compact('stocks','sucursales','permiso'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $articulos  = Articulo::where('tipoarticulo_id', '<>', 2)->orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        $sucursales  = Sucursal::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');


        return view('admin.stocks.create', compact('articulos', 'sucursales'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $stock = Stockarticulo::create($request->all());

        $descripciontemp = '';

        $listado_articulos_text = $request->input("listado_articulos");

        if($listado_articulos_text) {


            $listado_articulos_array = explode('&&&', $listado_articulos_text);
            array_pop($listado_articulos_array);



            foreach ($listado_articulos_array as $articulo_text)
            {
                list($articulo_id, $descripcion) = explode('|', $articulo_text);

                $stockdetalle = new Stockarticulodetalle();
                    $stockdetalle->stockarticulo_id = $stock->id;
                    $stockdetalle->articulo_id = $articulo_id;
                    $stockdetalle->usuario_alta = Auth::user()->username;
                    $stockdetalle->fecha_alta = date('Y-m-d H:i:s');

                $stockdetalle->save();

                if($descripciontemp == '')
                {
                    $descripciontemp = $descripcion;
                } else 
                {
                    $descripciontemp = $descripciontemp . ' - ' . $descripcion;
                }
            }
        }

        //auditoria
        $stock->fill(['descripcion' => $descripciontemp, 'usuario_alta' => Auth::user()->username , 'fecha_alta' => date('Y-m-d H:i:s')])->save();
        //


        Alert::success('Stock creado con exito')->persistent("Cerrar");
        return redirect()->route('stocks.edit', $stock->id);
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
        $articulos  = Articulo::where('tipoarticulo_id', '<>', 2)->orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        $sucursales  = Sucursal::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        $stock = Stockarticulo::find($id);

        return view('admin.stocks.create', compact('articulos', 'sucursales', 'stock'));
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
