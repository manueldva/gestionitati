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
use App\Models\Hojarutaarticulo;
use App\Models\Hojarutadetalle;
use App\Models\Distrito;
use App\Models\Barrio;
use App\Models\Articulo;
use App\Models\Stockarticulo;
use App\Models\Stockarticulodetalle;
use App\Models\Hojarutacobranza;
use DB;
use Illuminate\Support\Facades\Input;

use App\Helpers\FechaHelper;
use Barryvdh\DomPDF\Facade as PDF;

use Auth;

class HojarutaarticuloController extends Controller
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
        $modulo_actual = Modulo::where('valor', '=', 'HOJA_RUTA')->get();
        $modulos = $perfil->modulos()->where('modulo_id', '=', $modulo_actual[0]->id)->get();
        $permiso = $modulos[0]->pivot->permiso;

        $hojarutaarticulos = Hojarutaarticulo::type($request->get('type'), $request->get('val'))->paginate(15);

        /*foreach($articulos as $articulo){
            $articulo->fecha_alta = FechaHelper::getFechaImpresion($articulo->fecha_alta); 
        }*/

         foreach($hojarutaarticulos as $hojarutaarticulo){
            $hojarutaarticulo->fecha = FechaHelper::getFechaImpresion($hojarutaarticulo->fecha); 

        }

        $hojarutaarticulos->setPath('hojarutaarticulos');


        return view('admin.hojarutaarticulos.index', compact('hojarutaarticulos', 'permiso'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $articulos  = Articulo::where('tipoarticulo_id', '=', 1)->orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');


        return view('admin.hojarutaarticulos.create', compact('articulos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $hojarutaarticulo = Hojarutaarticulo::create($request->all());

        //auditoria
        $hojarutaarticulo->fill(['estado'=> 1, 'usuario_alta' => Auth::user()->username , 'fecha_alta' => date('Y-m-d H:i:s')])->save();
        //


        Alert::success('Hoja de ruta por articulo creada con exito')->persistent("Cerrar");
        return redirect()->route('hojarutaarticulos.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /* tipos de pagos
        0 = sin cargo
        1 = efectivo
        2 = cuenta corriente

        */
        $hojarutaarticulo = Hojarutaarticulo::find($id);

        $query="select orden1,orden2, orden3,orden4, orden5, orden6, orden7, orden8 ,cliente_id, cliente, barrio, tipocliente_id, calle, numero, manzana, casa, seccion, lote, edificiotorre, piso, observaciondomicilio, referenciadomicilio, clientedireccion_id, articulo_id, articulo, sum(cantidad) cantidad, celular   
                from (select  CASE WHEN ca.descripcion IS NULL THEN 2 ELSE 1 END orden1, CASE WHEN cd.numero IS NULL THEN 2 ELSE 1 END orden2,CASE WHEN cd.seccion IS NULL THEN 2 ELSE 1 END orden3,CASE WHEN cd.manzana IS NULL THEN 2 ELSE 1 END orden4, CASE WHEN cd.casa IS NULL THEN 2 ELSE 1 END orden5, CASE WHEN cd.edificiotorre IS NULL THEN 2 ELSE 1 END orden6, CASE WHEN cd.piso IS NULL THEN 2 ELSE 1 END orden7, CASE WHEN cd.lote IS NULL THEN 2 ELSE 1 END orden8,c.id cliente_id, CASE c.tipocliente_id WHEN 1 THEN CONCAT(c.apellido, ' ',  c.nombre) WHEN 2 THEN c.cliente ELSE '-' END cliente, ba.descripcion as barrio, c.tipocliente_id, ca.descripcion as calle, cd.numero, cd.manzana, cd.casa, cd.seccion, cd.lote, cd.edificiotorre, cd.piso, cd.observaciondomicilio, cd.referenciadomicilio, cd.id clientedireccion_id, a.id as articulo_id, a.descripcion articulo, coart.cantidad, c.celular    
            from clientes c
            inner join clientedirecciones cd on c.id = cd.cliente_id
            inner join contratos co on cd.id = co.clientedireccion_id
            inner join contratoarticulos coart on co.id = coart.contrato_id
            inner join articulos a on coart.articulo_id = a.id
            left join calles ca on ca.id = cd.calle_id
            left join barrios ba on ba.id = cd.barrio_id
            where a.id = " .  $hojarutaarticulo->articulo_id . " and c.estado = 1 and co.estado = 1 
            union all
            select  CASE WHEN ca.descripcion IS NULL THEN 2 ELSE 1 END orden1,CASE WHEN cd.numero IS NULL THEN 2 ELSE 1 END orden2,CASE WHEN cd.seccion IS NULL THEN 2 ELSE 1 END orden3,CASE WHEN cd.manzana IS NULL THEN 2 ELSE 1 END orden4, CASE WHEN cd.casa IS NULL THEN 2 ELSE 1 END orden5,CASE WHEN cd.edificiotorre IS NULL THEN 2 ELSE 1 END orden6,CASE WHEN cd.piso IS NULL THEN 2 ELSE 1 END orden7 , CASE WHEN cd.lote IS NULL THEN 2 ELSE 1 END orden8 ,c.id cliente_id, CASE c.tipocliente_id WHEN 1 THEN CONCAT(c.apellido, ' ',  c.nombre) WHEN 2 THEN c.cliente ELSE '-' END cliente, ba.descripcion as barrio, c.tipocliente_id, ca.descripcion as calle, cd.numero, cd.manzana, cd.casa, cd.seccion, cd.lote, cd.edificiotorre, cd.piso, cd.observaciondomicilio, cd.referenciadomicilio, cd.id clientedireccion_id, a.id as articulo_id, a.descripcion articulo, coart.cantidad, c.celular  
            from clientes c
            inner join clientedirecciones cd on c.id = cd.cliente_id
            inner join contratos co on cd.id = co.clientedireccion_id
            inner join contratoarticulos coart on co.id = coart.contrato_id
            inner join articuloplandetalles arplan on coart.articulo_id = arplan.plan_id
            inner join articulos a on arplan.planarticulo_id = a.id
            left join calles ca on ca.id = cd.calle_id
            left join barrios ba on ba.id = cd.barrio_id
            where a.id = " . $hojarutaarticulo->articulo_id . " and c.estado = 1 and co.estado = 1 
           ) as subconsulta
            group by orden1,orden2,orden3, orden4, orden5,orden6, orden7, orden8 ,cliente_id, cliente, barrio, tipocliente_id, calle, numero, manzana, casa, seccion, lote, edificiotorre, piso, observaciondomicilio, referenciadomicilio, clientedireccion_id, articulo_id, articulo, celular
            order by  barrio, orden1 , calle , orden2  , CAST(numero AS INTEGER) , orden3 , seccion , orden4 , CAST(manzana AS INTEGER) , orden5  ,CAST(casa AS INTEGER) , orden6 ,edificiotorre , orden7 , piso , orden8 , lote , referenciadomicilio  , cliente_id";


        $detalles = DB::select($query);

        $cant_cli= count($detalles);

        //dd($detalles);

        $hojarutaarticulo->fecha = FechaHelper::getFechaInputDate($hojarutaarticulo->fecha); 



        //dd($t_por_articulo);


        return view('admin.hojarutaarticulos.show', compact('hojarutaarticulo', 'detalles', 'cant_cli'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        echo "string";
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
                 
        //Hojarutadetalle::where('hojaruta_id', $id)->delete();    

        //Hojarutaarticuloextra::where('hojaruta_id', $id)->delete();    

        Hojarutaarticulo::find($id)->delete();

        Alert::success('Eliminado correctamente')->persistent('Cerrar');
        return back();
    }


    public function printhojarutaarticulo($id)
    {

        $hojarutaarticulo = Hojarutaarticulo::find($id);
        $hojarutaarticulo->fecha = FechaHelper::getFechaInputDate($hojarutaarticulo->fecha); 

        $query="select orden1,orden2, orden3,orden4, orden5, orden6, orden7, orden8 ,cliente_id, cliente, barrio, tipocliente_id, calle, numero, manzana, casa, seccion, lote, edificiotorre, piso, observaciondomicilio, referenciadomicilio, clientedireccion_id, articulo_id, articulo, sum(cantidad) cantidad, celular   
                from (select  CASE WHEN ca.descripcion IS NULL THEN 2 ELSE 1 END orden1, CASE WHEN cd.numero IS NULL THEN 2 ELSE 1 END orden2,CASE WHEN cd.seccion IS NULL THEN 2 ELSE 1 END orden3,CASE WHEN cd.manzana IS NULL THEN 2 ELSE 1 END orden4, CASE WHEN cd.casa IS NULL THEN 2 ELSE 1 END orden5, CASE WHEN cd.edificiotorre IS NULL THEN 2 ELSE 1 END orden6, CASE WHEN cd.piso IS NULL THEN 2 ELSE 1 END orden7, CASE WHEN cd.lote IS NULL THEN 2 ELSE 1 END orden8,c.id cliente_id, CASE c.tipocliente_id WHEN 1 THEN CONCAT(c.apellido, ' ',  c.nombre) WHEN 2 THEN c.cliente ELSE '-' END cliente, ba.descripcion as barrio, c.tipocliente_id, ca.descripcion as calle, cd.numero, cd.manzana, cd.casa, cd.seccion, cd.lote, cd.edificiotorre, cd.piso, cd.observaciondomicilio, cd.referenciadomicilio, cd.id clientedireccion_id, a.id as articulo_id, a.descripcion articulo, coart.cantidad, c.celular    
            from clientes c
            inner join clientedirecciones cd on c.id = cd.cliente_id
            inner join contratos co on cd.id = co.clientedireccion_id
            inner join contratoarticulos coart on co.id = coart.contrato_id
            inner join articulos a on coart.articulo_id = a.id
            left join calles ca on ca.id = cd.calle_id
            left join barrios ba on ba.id = cd.barrio_id
            where a.id = " .  $hojarutaarticulo->articulo_id . " and c.estado = 1 and co.estado = 1 
            union all
            select  CASE WHEN ca.descripcion IS NULL THEN 2 ELSE 1 END orden1,CASE WHEN cd.numero IS NULL THEN 2 ELSE 1 END orden2,CASE WHEN cd.seccion IS NULL THEN 2 ELSE 1 END orden3,CASE WHEN cd.manzana IS NULL THEN 2 ELSE 1 END orden4, CASE WHEN cd.casa IS NULL THEN 2 ELSE 1 END orden5,CASE WHEN cd.edificiotorre IS NULL THEN 2 ELSE 1 END orden6,CASE WHEN cd.piso IS NULL THEN 2 ELSE 1 END orden7 , CASE WHEN cd.lote IS NULL THEN 2 ELSE 1 END orden8 ,c.id cliente_id, CASE c.tipocliente_id WHEN 1 THEN CONCAT(c.apellido, ' ',  c.nombre) WHEN 2 THEN c.cliente ELSE '-' END cliente, ba.descripcion as barrio, c.tipocliente_id, ca.descripcion as calle, cd.numero, cd.manzana, cd.casa, cd.seccion, cd.lote, cd.edificiotorre, cd.piso, cd.observaciondomicilio, cd.referenciadomicilio, cd.id clientedireccion_id, a.id as articulo_id, a.descripcion articulo, coart.cantidad, c.celular  
            from clientes c
            inner join clientedirecciones cd on c.id = cd.cliente_id
            inner join contratos co on cd.id = co.clientedireccion_id
            inner join contratoarticulos coart on co.id = coart.contrato_id
            inner join articuloplandetalles arplan on coart.articulo_id = arplan.plan_id
            inner join articulos a on arplan.planarticulo_id = a.id
            left join calles ca on ca.id = cd.calle_id
            left join barrios ba on ba.id = cd.barrio_id
            where a.id = " . $hojarutaarticulo->articulo_id . " and c.estado = 1 and co.estado = 1 
           ) as subconsulta
            group by orden1,orden2,orden3, orden4, orden5,orden6, orden7, orden8 ,cliente_id, cliente, barrio, tipocliente_id, calle, numero, manzana, casa, seccion, lote, edificiotorre, piso, observaciondomicilio, referenciadomicilio, clientedireccion_id, articulo_id, articulo, celular
            order by  barrio, orden1 , calle , orden2  , CAST(numero AS INTEGER) , orden3 , seccion , orden4 , CAST(manzana AS INTEGER) , orden5  ,CAST(casa AS INTEGER) , orden6 ,edificiotorre , orden7 , piso , orden8 , lote , referenciadomicilio  , cliente_id";


        $detalles = DB::select($query);


        $tempid = 0;
        $tempid2 = '';

        if(count($detalles) > 2000)
        {
            return view('admin.hojarutaarticulos.printhojaruta', compact('hojarutaarticulo', 'detalles', 'tempid','tempid2'));
        } else
        {
            $pdf = PDF::loadView('admin.hojarutaarticulos.printhojaruta', compact('hojarutaarticulo', 'detalles', 'tempid','tempid2'));
            //$pdf->setPaper('Legal', 'landscape');

            return $pdf->setPaper('Legal', 'landscape')->stream('hojarutaarticulo.pdf');

        }


        /*$pdf = PDF::loadView('admin.hojarutas.printhojaruta', compact('hojarutas', 'hojaruta', 'cantidad', 'extras'));
        //$pdf->setPaper('Legal', 'landscape');

        return $pdf->setPaper('Legal', 'landscape')->stream('hojaruta.pdf');*/

        
    }
}
