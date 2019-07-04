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
use App\Models\Hojaruta;
use App\Models\Hojarutadetalle;
use App\Models\Hojarutaarticuloextra;
use App\Models\Distrito;
use App\Models\Barrio;
use App\Models\Articulo;
use App\Models\Stockarticulo;
use App\Models\Stockarticulodetalle;

use DB;
use Illuminate\Support\Facades\Input;

use App\Helpers\FechaHelper;
use Barryvdh\DomPDF\Facade as PDF;


use Auth;

class HojarutaController extends Controller
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
    

        $hojarutas = Hojaruta::type($request->get('type'), $request->get('val'), $request->get('empleados'))->paginate(15);

        /*foreach($articulos as $articulo){
            $articulo->fecha_alta = FechaHelper::getFechaImpresion($articulo->fecha_alta); 
        }*/

         foreach($hojarutas as $hojaruta){
            $hojaruta->fecha = FechaHelper::getFechaImpresion($hojaruta->fecha); 

            $query="select ba.descripcion from hojarutas hr
                inner join hojarutadetalles hrd on hr.id = hrd.hojaruta_id
                inner join clientedirecciones cd on hrd.clientedireccion_id = cd.id
                left join barrios ba on ba.id = cd.barrio_id
                where  hr.id = " . $hojaruta->id . "
                group by ba.descripcion
                order by ba.descripcion";

            $data = DB::select($query);
            $temp = '';
            foreach ($data as $key => $value) {
               if($temp == ''){
                    $temp = $value->descripcion;
               } else {
                    $temp = $temp .' - '. $value->descripcion;
               }
               
            }

            $hojaruta->usuario_alta = $temp;
        }



        $hojarutas->setPath('hojarutas');

        $tipoempleado = Tipoempleado::where('descripcion', '=', 'Vendedor')->first();
        if($tipoempleado) {
            $empleados  = Empleado::orderBy('empleado', 'ASC')->where('tipoempleado_id', $tipoempleado->id)->where('Sucursal_id', 1)->pluck('empleado' , 'id');
                
            if(!$empleados) $empleados = [];
        } else {
            $empleados = [];
        }

        return view('admin.hojarutas.index', compact('hojarutas', 'permiso', 'empleados'));
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

        $distritos  = Distrito::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        
        $barrios  = Barrio::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        return view('admin.hojarutas.create', compact('empleados', 'distritos', 'barrios', 'articulos'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        //dd($request->all());

        $hojaruta = Hojaruta::create($request->all());

        //auditoria
        $hojaruta->fill(['estado'=> 1, 'usuario_alta' => Auth::user()->username , 'fecha_alta' => date('Y-m-d H:i:s')])->save();
        //


        $listado_articulos_text = $request->input("listado_articulos");

        if($listado_articulos_text) {


            $listado_articulos_array = explode('&&&', $listado_articulos_text);
            array_pop($listado_articulos_array);



            foreach ($listado_articulos_array as $articulo_text)
            {
                list($articulo_id, $cantidad) = explode('|', $articulo_text);

                $hojaextra = new Hojarutaarticuloextra();
                    $hojaextra->hojaruta_id = $hojaruta->id;
                    $hojaextra->cantidad = $cantidad;
                    $hojaextra->articulo_id = $articulo_id;
                    $hojaextra->fecha = date('Y-m-d H:i:s');
                    $hojaextra->estado = 1;
                    $hojaextra->usuario_alta = Auth::user()->username;
                    $hojaextra->fecha_alta = date('Y-m-d H:i:s');
                $hojaextra->save();
               
            }
        }


        $listado_hojaruta_text = $request->input("listado_hojaruta");

        if($listado_hojaruta_text) {


            $listado_hojaruta_array = explode('&&&', $listado_hojaruta_text);
            array_pop($listado_hojaruta_array);



            foreach ($listado_hojaruta_array as $hojaruta_text)
            {
                list($clientedireccion_id,$cliente_id, $cantidad, $articulo_id) = explode('|', $hojaruta_text);

                $hojadetalle = new Hojarutadetalle();
                    $hojadetalle->hojaruta_id = $hojaruta->id;
                    $hojadetalle->cliente_id = $cliente_id;
                    $hojadetalle->clientedireccion_id = $clientedireccion_id;
                    //$hojadetalle->contrato_id = $contrato_id;
                    $hojadetalle->cantidad = $cantidad;
                    $hojadetalle->articulo_id = $articulo_id;
                    $hojadetalle->fecha = date('Y-m-d H:i:s');
                    $hojadetalle->estado = 1;
                    $hojadetalle->usuario_alta = Auth::user()->username;
                    $hojadetalle->fecha_alta = date('Y-m-d H:i:s');
                $hojadetalle->save();
               
            }
        }



        Alert::success('Hoja de ruta creada con exito')->persistent("Cerrar");
        return redirect()->route('hojarutas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hojaruta = Hojaruta::find($id);

        $query1="select hrd.cliente_id, CASE c.tipocliente_id WHEN 1 THEN CONCAT(c.apellido, ' ',  c.nombre) WHEN 2 THEN c.cliente ELSE '-' END cliente,
        ba.descripcion as barrio, c.tipocliente_id, ca.descripcion as calle, cd.numero, cd.manzana, cd.casa, cd.seccion, cd.lote, cd.edificiotorre, cd.piso, cd.observaciondomicilio, cd.referenciadomicilio,
        a.descripcion articulo, hrd.cantidad, hrd.estado, hrd.tipopago
        from hojarutas hr
        inner join hojarutadetalles hrd on hr.id = hrd.hojaruta_id
        inner join clientes c on hrd.cliente_id = c.id
        inner join clientedirecciones cd on hrd.clientedireccion_id = cd.id
        left join calles ca on ca.id = cd.calle_id
        left join barrios ba on ba.id = cd.barrio_id
        inner join articulos a on hrd.articulo_id = a.id
        where hr.id = " . $id . "
        order by hrd.id";

        $detalles = DB::select($query1);

        $hojaruta->fecha = FechaHelper::getFechaInputDate($hojaruta->fecha); 


        $query="select ba.descripcion from hojarutas hr
                inner join hojarutadetalles hrd on hr.id = hrd.hojaruta_id
                inner join clientedirecciones cd on hrd.clientedireccion_id = cd.id
                left join barrios ba on ba.id = cd.barrio_id
                where  hr.id = " . $id . "
                group by ba.descripcion
                order by ba.descripcion";

        $data = DB::select($query);
        $cant_barrio = count($data);
        $barrio = '';
        foreach ($data as $key => $value) {
           if($barrio == ''){
                $barrio = $value->descripcion;
           } else {
                $barrio = $barrio .' - '. $value->descripcion;
           }
           
        }


        return view('admin.hojarutas.show', compact('hojaruta', 'barrio','cant_barrio', 'detalles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
         $hojaruta = Hojaruta::find($id);

        $hojaruta->fecha = FechaHelper::getFechaInputDate($hojaruta->fecha); 

        return view('admin.hojarutas.edit', compact('hojaruta'));
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
       
        $listado_hoja_text = $request->input("listado_hoja");

        if($listado_hoja_text) {


            $listado_hoja_array = explode('&&&', $listado_hoja_text);
            array_pop($listado_hoja_array);



            foreach ($listado_hoja_array as $hoja_text)
            {
                list($codigo, $tipopago ,$cantidad) = explode('|', $hoja_text);


                $detalle = Hojarutadetalle::find($codigo);
                    $precio = Articulo::where('id', $detalle->articulo_id)->select('precioreparto')->first();
                
                    $detalle->cantidadfinal = $cantidad;
                    $detalle->precio = $precio->precioreparto;
                    $detalle->tipopago = $tipopago;
                    $detalle->fecha = $request->input("fecha");
                    $detalle->estado = 2;
                    $detalle->usuario_modi = Auth::user()->username;
                    $detalle->fecha_modi = date('Y-m-d H:i:s');
                $detalle->save();
               
            }

        }


        if($request->input("estado") == "2"){
            $hoja = Hojaruta::find($id);
                $hoja->estado = 2;
                $hoja->usuario_modi = Auth::user()->username;
                $hoja->fecha_modi = date('Y-m-d H:i:s');
            $hoja->save();
        }

        Alert::success('Hoja de ruta procesada con exito')->persistent("Cerrar");
        return redirect()->route('hojarutas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         
        Hojarutadetalle::where('hojaruta_id', $id)->delete();    

        Hojarutaarticuloextra::where('hojaruta_id', $id)->delete();    

        Hojaruta::find($id)->delete();

        Alert::success('Eliminado correctamente')->persistent('Cerrar');
        return back();
    }



    public function printhojaruta($id)
    {

        $hojaruta = Hojaruta::find($id);
        $hojaruta->fecha = FechaHelper::getFechaInputDate($hojaruta->fecha); 

        $query="select hrd.cliente_id, CASE c.tipocliente_id WHEN 1 THEN CONCAT(c.apellido, ' ',  c.nombre) WHEN 2 THEN c.cliente ELSE '-' END cliente,
        ba.descripcion as barrio, c.tipocliente_id, ca.descripcion as calle, cd.numero, cd.manzana, cd.casa, cd.seccion, cd.lote, cd.edificiotorre, cd.piso, cd.observaciondomicilio, cd.referenciadomicilio,
        a.descripcion articulo, hrd.cantidad, c.celular
        from hojarutas hr
        inner join hojarutadetalles hrd on hr.id = hrd.hojaruta_id
        inner join clientes c on hrd.cliente_id = c.id
        inner join clientedirecciones cd on hrd.clientedireccion_id = cd.id
        left join calles ca on ca.id = cd.calle_id
        left join barrios ba on ba.id = cd.barrio_id
        inner join articulos a on hrd.articulo_id = a.id
        where hr.id = " . $id . "
        order by hrd.id";

        $hojarutas = DB::select($query);


   
        $query2="select count(distinct(clientedireccion_id)) cantidad from  hojarutadetalles
        where hojaruta_id = " .$id ;

        $data2 = DB::select($query2);

        foreach ($data2 as $key => $value) {
           $cantidad = $value->cantidad;
        }



        $query_b="select ba.descripcion from hojarutas hr
                inner join hojarutadetalles hrd on hr.id = hrd.hojaruta_id
                inner join clientedirecciones cd on hrd.clientedireccion_id = cd.id
                left join barrios ba on ba.id = cd.barrio_id
                where  hr.id = " . $id . "
                group by ba.descripcion
                order by ba.descripcion";

        $cantidad_b = DB::select($query_b);
        $barrio = '';
        foreach ($cantidad_b as $key => $value) {
           if($barrio == ''){
                $barrio = $value->descripcion;
           } else {
                $barrio = $barrio .' - '. $value->descripcion;
           }
           
        }



        $extras = Hojarutaarticuloextra::where('hojaruta_id', $id)->get();
        
        $tempid = 0;
        //dd(count($hojarutas));
        if(count($hojarutas) > 200)
        {
            return view('admin.hojarutas.printhojaruta', compact('hojarutas', 'hojaruta', 'cantidad', 'extras', 'cantidad_b', 'barrio', 'tempid'));
        } else
        {
            $pdf = PDF::loadView('admin.hojarutas.printhojaruta', compact('hojarutas', 'hojaruta', 'cantidad', 'extras', 'cantidad_b', 'barrio', 'tempid'));
            //$pdf->setPaper('Legal', 'landscape');

            return $pdf->setPaper('Legal', 'landscape')->stream('hojaruta.pdf');

        }


        /*$pdf = PDF::loadView('admin.hojarutas.printhojaruta', compact('hojarutas', 'hojaruta', 'cantidad', 'extras'));
        //$pdf->setPaper('Legal', 'landscape');

        return $pdf->setPaper('Legal', 'landscape')->stream('hojaruta.pdf');*/

        
    }

}
