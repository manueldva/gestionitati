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
    public function index(Request $request)
    {
       $perfil = Perfil::find(Auth::user()->perfil_id);
        $modulo_actual = Modulo::where('valor', '=', 'STOCK')->get();
        $modulos = $perfil->modulos()->where('modulo_id', '=', $modulo_actual[0]->id)->get();
        $permiso = $modulos[0]->pivot->permiso;
 

        $sucursales  = Sucursal::orderBy('id')->pluck('descripcion' , 'id');

        if($request->get('sucursal_id')){
            if($request->get('type') == 'descripcion'){
                $query="select sa.id, sa.descripcion, s.descripcion sucursal, sa.stockactual, sa.stockminimo 
                    from stockarticulos sa
                    inner join sucursales s on sa.sucursal_id = s.id
                    inner join stockarticulodetalles sad on sa.id = sad.stockarticulo_id
                    inner join articulos a on sad.articulo_id = a.id
                    where s.id  = " . $request->get('sucursal_id') . " and a.descripcion like '%" . $request->get('val') . "%'
                    group by sa.id, sa.descripcion, s.descripcion, sa.stockactual, sa.stockminimo";
            } else
            {
                $query="select sa.id, sa.descripcion, s.descripcion sucursal, sa.stockactual, sa.stockminimo 
                    from stockarticulos sa
                    inner join sucursales s on sa.sucursal_id = s.id
                    where s.id  = " . $request->get('sucursal_id');
            }
        } else {
            $query="select sa.id, sa.descripcion, s.descripcion sucursal, sa.stockactual, sa.stockminimo 
                from stockarticulos sa
                inner join sucursales s on sa.sucursal_id = s.id
                where s.id = 1";

        }

        $data = DB::select($query);
        
        $page = Input::get('page', 1);
        $paginate = 15;
        //
        $offSet = ($page * $paginate) - $paginate; //calcula la cantidad de paginas
        $itemsForCurrentPage = array_slice($data, $offSet, $paginate, true); //calcula que pagina es la actual
        $stocks = new \Illuminate\Pagination\LengthAwarePaginator($itemsForCurrentPage, count($data), $paginate, $page);//genera el paginador personalizado

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
        $articulos  = Articulo::where('tipoarticulo_id', '=', 1)->orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        $sucursales  = Sucursal::orderBy('id')->pluck('descripcion' , 'id');

         $tipotiempos  = Tipotiempo::orderBy('id')->pluck('descripcion' , 'id');


        return view('admin.stocks.create', compact('articulos', 'sucursales', 'tipotiempos'));
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
        $articulos  = Articulo::where('tipoarticulo_id', '=', 1)->orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        $sucursales  = Sucursal::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        $tipotiempos  = Tipotiempo::orderBy('id')->pluck('descripcion' , 'id');


        $stock = Stockarticulo::find($id);

        $stockdetalles = Stockarticulodetalle::where('stockarticulo_id', $id)->get();

        //dd($stock);

        return view('admin.stocks.show', compact('articulos', 'sucursales', 'tipotiempos', 'stock', 'stockdetalles'));
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

        return view('admin.stocks.edit', compact('articulos', 'sucursales', 'tipotiempos', 'stock', 'stockdetalles'));
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
        $stock = Stockarticulo::find($id);

        $stock->fill($request->all())->save();

        //$stock = Stockarticulo::create($request->all());

        $descripciontemp = '';

        $listado_articulos_text = $request->input("listado_articulos");

        if($listado_articulos_text) {

            Stockarticulodetalle::where('stockarticulo_id', $id)->delete();    

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
        $stock->fill(['descripcion' => $descripciontemp, 'usuario_modi' => Auth::user()->username , 'fecha_modi' => date('Y-m-d H:i:s')])->save();
        //


        Alert::success('Stock editado con exito')->persistent("Cerrar");
        return redirect()->route('stocks.edit', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        /*$existe = Articulo::where('rubro_id', $id)->count();

        if($existe > 0) 
        {
            Alert::error('No se puede eliminar el registro')->persistent("Cerrar");
            return back();
        }*/
        

        
        Stockarticulodetalle::where('stockarticulo_id', $id)->delete();    

        Stockarticulo::find($id)->delete();

        Alert::success('Eliminado correctamente')->persistent('Cerrar');
        return back();
    }
}
