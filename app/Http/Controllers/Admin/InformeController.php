<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Alert;
use DB;

use App\Models\Modulo;
use App\Models\Perfil;
use Illuminate\Support\Facades\Input;

use App\User;
use App\Models\Articulo;
use App\Models\Cliente;
use App\Models\Clientedireccion;
use App\Models\Tipoempleado;
use App\Models\Empleado;;
use App\Models\Contrato;
use App\Models\Contratoarticulo;
use App\Models\Barrio;
use Auth;

use App\Helpers\FechaHelper;

use Barryvdh\DomPDF\Facade as PDF;

class InformeController extends Controller
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
        /*$usuarios  = User::orderBy('username', 'ASC')->where('id', '<>', 1)->pluck('username' , 'username');

        
        return view('admin.informes.show',compact('usuarios'));*/

        $perfil = Perfil::find(Auth::user()->perfil_id);
        $modulo_actual = Modulo::where('valor', '=', 'INFORMES')->get();
        $modulos = $perfil->modulos()->where('modulo_id', '=', $modulo_actual[0]->id)->get();
        $permiso = $modulos[0]->pivot->permiso;
    

        return view('admin.informes.index', compact('permiso'));

        //echo "prueba";
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$usuarios  = User::orderBy('username', 'ASC')->where('id', '<>', 1)->whereNotNull('username')->pluck('username' , 'username');
        if($id == 1) { // ventas por repartidor
            $tipoempleado = Tipoempleado::where('descripcion', '=', 'Vendedor')->first();
            if($tipoempleado) {
                $usuarios  = Empleado::orderBy('empleado', 'ASC')->where('tipoempleado_id', $tipoempleado->id)->pluck('empleado' , 'id');
                    
                if(!$usuarios) $usuarios = [];
            } else {
                $usuarios = [];
            }
            
            return view('admin.informes.show1',compact('usuarios'));
        } else if($id == 2) { // ventas en oficina
            $tipoempleado = Tipoempleado::where('descripcion', '=', 'Administrativo')->first();
            if($tipoempleado) {
                $usuarios  = Empleado::orderBy('empleado', 'ASC')->where('tipoempleado_id', $tipoempleado->id)->pluck('empleado' , 'id');
                    
                if(!$usuarios) $usuarios = [];
            } else {
                $usuarios = [];
            }
            return view('admin.informes.show2',compact('usuarios'));
        } else if($id == 4) { // informe automatico para clientes que no han comprado en mas de 1 mes
            
            $now = new \DateTime('now');
            $fechaanterior = date("Y-m-d",strtotime($now->format('Y-m-d')."- 2 month"));
                
            /*$query="SELECT c.id, CASE c.tipocliente_id WHEN 1 THEN CONCAT(c.apellido, ' ',  c.nombre) WHEN 2 THEN c.cliente ELSE '-' END cliente , DATE_FORMAT(hrd.fechacarga, '%d/%m/%Y') as fecha FROM clientes AS c
            left join hojarutadetalles hrd on hrd.cliente_id = c.id and hrd.id = (SELECT id FROM hojarutadetalles where cliente_id = c.id order by fecha desc limit 1)
            where c.estado = 1 and (hrd.fecha <  '" . $fechaanterior . "' or hrd.fecha is null)
            order by c.apellido, c.nombre";*/
            
            $query="SELECT c.id, CASE c.tipocliente_id WHEN 1 THEN CONCAT(c.apellido, ' ',  c.nombre) WHEN 2 THEN c.cliente ELSE '-' END cliente  , DATE_FORMAT(hrd.fechacarga, '%Y-%m-%d') as fecha, b.descripcion as barrio, e.empleado FROM clientes AS c
            left join hojarutadetalles hrd on hrd.cliente_id = c.id and hrd.fechacarga = (SELECT fechacarga FROM hojarutadetalles where cliente_id = c.id order by fechacarga desc limit 1)
            inner join contratos co on c.id = co.cliente_id and co.estado = 1
            inner join clientedirecciones cd on c.id = cd.cliente_id
            left join barrios b on cd.barrio_id = b.id
            inner join empleados e on cd.empleado_id = e.id
            where c.estado = 1 and (hrd.fechacarga < '" . $fechaanterior . "' or hrd.fechacarga is null)  and c.sucursal_id = 1
            group by  c.id, 
             CASE c.tipocliente_id WHEN 1 THEN CONCAT(c.apellido, ' ',  c.nombre) WHEN 2 THEN c.cliente ELSE '-' END,
            hrd.fechacarga,b.descripcion,e.empleado 
            order by e.empleado, b.descripcion, CASE c.tipocliente_id WHEN 1 THEN CONCAT(c.apellido, ' ',  c.nombre) WHEN 2 THEN c.cliente ELSE '-' END ";

            $resultado = DB::select($query);

            /*$pdf = PDF::loadView('admin.informes.informeclientessincomprarprint', compact('resultado', 'fechaanterior'));
            //$pdf->setPaper('Legal', 'landscape');

            return $pdf->setPaper('A4')->stream('informecliente.pdf');*/


            return view('admin.informes.informeclientessincomprarprint',compact('resultado', 'fechaanterior'));
        } else if($id == 3) { // ventas en oficina
            $tipoempleado = Tipoempleado::where('descripcion', '=', 'Administrativo')->first();
            if($tipoempleado) {
                $usuarios  = Empleado::orderBy('empleado', 'ASC')->where('tipoempleado_id', $tipoempleado->id)->pluck('empleado' , 'id');
                    
                if(!$usuarios) $usuarios = [];
            } else {
                $usuarios = [];
            }
            return view('admin.informes.show3',compact('usuarios'));
           
        }
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


    public function detalleinformecontratoprint($barrio)
    {

        $data = [];

        $articulos = Articulo::where('tipoarticulo_id', '<>', 3)->orderBy('descripcion')->get();

        if($barrio == null   || $barrio == '0') {
            $contratos = DB::table('contratos')
                    ->join('clientes', 'contratos.cliente_id', '=', 'clientes.id')
                    ->where('contratos.estado', '=', 1)
                    ->where('clientes.estado', '=', 1)
                    ->count();

            $barriodesc = 'Todos';
        } else {
            $contratos = DB::table('contratos')
                    ->join('clientedirecciones', 'contratos.clientedireccion_id', '=', 'clientedirecciones.id')
                    ->join('clientes', 'contratos.cliente_id', '=', 'clientes.id')
                    ->where('clientedirecciones.barrio_id', '=', $barrio)
                    ->where('contratos.estado', '=', 1)
                    ->where('clientes.estado', '=', 1)
                    ->count();


            $barriotemp = Barrio::find($barrio);
            $barriodesc = $barriotemp->descripcion;
        }

        foreach ($articulos as $key => $value) {
            
            //$contratos = Contratoarticulo::where('articulo_id', $value->id)->count();
            if($barrio == null   || $barrio == '0') {
      
                $temp = DB::table('contratoarticulos')
                         ->select(DB::raw('sum(cantidad) as cantidad'))
                         ->where('articulo_id', '=', $value->id)
                         ->first();

            } else {
                $temp = DB::table('contratoarticulos')
                    ->select(DB::raw('sum(contratoarticulos.cantidad) as cantidad'))
                    ->join('contratos', 'contratoarticulos.contrato_id', '=', 'contratos.id')
                    ->join('clientedirecciones', 'contratos.clientedireccion_id', '=', 'clientedirecciones.id')
                    ->where('contratoarticulos.articulo_id', '=', $value->id)
                    ->where('clientedirecciones.barrio_id', '=', $barrio)
                    ->first();
            }

            if ($temp->cantidad == null) {
                $cantidad = 0;
            } else {
                $cantidad = $temp->cantidad;
            }


            $data [] = ['codigo' => $value->id,  'articulo' => $value->descripcion, 'cantidad' => $cantidad];

        }


        //dd($data);

        $pdf = PDF::loadView('admin.informes.informecontratos.detalleinformecontratoprint', compact('barriodesc', 'data', 'contratos'));

        return $pdf->stream('informe.pdf');


    }

    public function detalleclienteprint($barrio)
    {

        $barriotemp = Barrio::find($barrio);
        $barriodesc = $barriotemp->descripcion;

        $cantidad = DB::table('clientedirecciones')->where('barrio_id', $barrio)->count();


        $clientes = Clientedireccion::where('barrio_id', $barrio)->get();


        foreach ($clientes as $key => $value) {
            $temp = '';
            $temp2 = '';
            //$direcciones =  array();
         
            /*if($value->barrio_id) {
                $temp = 'Bº ' . $value->barrio->descripcion;
            } */

            if($value->calle_id) {
                $temp = ' Calle ' . $value->calle->descripcion;
            } 

            if($value->numero) {
                $temp = $temp . ' Nro. ' . $value->numero;
            }

            if($value->manzana) {
                $temp = $temp . ' Mz. ' . $value->manzana;
            } 


            if($value->casa) {
                $temp = $temp . ' C. ' . $value->casa;
            } 

            if($value->seccion) {
                $temp = $temp . ' Seccion ' . $value->seccion;
            }

            if($value->lote) {
                $temp = $temp . ' Lote ' . $value->lote;
            }

            if($value->edificiotorre) {
                $temp = $temp . ' Edificio ' . $value->edificiotorre;
            } 

            if($value->piso) {
                $temp = $temp . ' Piso/Dpto ' . $value->piso;
            } 

            $value->usuario_modi = $temp;

           
            // articulos

            $contrato = Contrato::where('Clientedireccion_id', $value->id)->where('cliente_id', $value->cliente_id)->orderBy('fechacontrato', 'desc')->first();
            
            if($contrato) {
                $contratoarticulos  = Contratoarticulo::where('contrato_id', $contrato->id)->get();

                foreach ($contratoarticulos as $key1 => $value1) {
                    
                    if($temp2 == ''){
                        $temp2 =  $value1->articulo->descripcion . ' (' . $value1->cantidad . ' u.) <br>';
                    } else {
                        $temp2 = $temp2  .  $value1->articulo->descripcion . ' (' . $value1->cantidad . ' u.) <br>';
                    }
                   
                }

                $value->usuario_alta = $temp2;
            } else {
                $value->usuario_alta = '';
            }
            
            //

        }
        //dd($clientes);

        $pdf = PDF::loadView('admin.informes.detalleclienteprint', compact('barriodesc', 'clientes', 'cantidad'));
        //$pdf->setPaper('Legal', 'landscape');

        return $pdf->setPaper('Legal', 'landscape')->stream('informe.pdf');
        //return $pdf->stream('informe.pdf');
        //$dompdf->set_paper ('a4','landscape'); 

        


    }


    public function informecontratosbarriosarticulosprint($barrio, $articulo)
    {       
       $barriotemp = Barrio::find($barrio);
        $barriodesc = $barriotemp->descripcion;

        //$cantidad = DB::table('clientedirecciones')->where('barrio_id', $barrio)->count();


        //$clientes = Clientedireccion::where('barrio_id', $barrio)->get();

        $clientes = Clientedireccion::whereHas('cliente', function($query) {
              $query->where('estado',1)->orderBy('apellido');
          })
          ->where('barrio_id', $barrio)
          //->select('clientedirecciones')
          ->get();

         

        foreach ($clientes as $key => $value) {
            $temp = '';
            $temp2 = '';
            //$direcciones =  array();
         
            /*if($value->barrio_id) {
                $temp = 'Bº ' . $value->barrio->descripcion;
            } */

            if($value->calle_id) {
                $temp = ' Calle ' . $value->calle->descripcion;
            } 

            if($value->numero) {
                $temp = $temp . ' Nro. ' . $value->numero;
            }

            if($value->manzana) {
                $temp = $temp . ' Mz. ' . $value->manzana;
            } 


            if($value->casa) {
                $temp = $temp . ' C. ' . $value->casa;
            } 

            if($value->seccion) {
                $temp = $temp . ' Seccion ' . $value->seccion;
            }

            if($value->lote) {
                $temp = $temp . ' Lote ' . $value->lote;
            }

            if($value->edificiotorre) {
                $temp = $temp . ' Edificio ' . $value->edificiotorre;
            } 

            if($value->piso) {
                $temp = $temp . ' Piso/Dpto ' . $value->piso;
            } 

            if($value->referenciadomicilio) {
                $temp = $temp . ' (' . $value->referenciadomicilio .  ')';
            } 

            $value->usuario_modi = $temp;

            if($value->cliente->tipocliente_id == 1){
                $value->referenciadomicilio = $value->cliente->apellido . ' ' .  $value->calle = $value->cliente->nombre;
            } else {
                $value->referenciadomicilio = $value->cliente->cliente;
            }
           
            // articulos

            /*$contrato = Contrato::where('Clientedireccion_id', $value->id)->where('estado', 1)->where('cliente_id', $value->cliente_id)->orderBy('fechacontrato', 'desc')->first();
            
            if($contrato) {
                

                $contratoarticulos  = Contratoarticulo::where('contrato_id', $contrato->id)->get();

                foreach ($contratoarticulos as $key1 => $value1) {
                    
                    if($temp2 == ''){
                        $temp2 =  $value1->articulo->descripcion . ' (' . $value1->cantidad . ' u.) <br>';
                    } else {
                        $temp2 = $temp2  .  $value1->articulo->descripcion . ' (' . $value1->cantidad . ' u.) <br>';
                    }
                   
                }
                //para filtrar por articulo
                if($articulo !== '0') {
                    $existe = 0;
                    $art_temp = (int) $articulo;
                    foreach ($contratoarticulos as $key2 => $value2) {
                        if($value2->articulo_id == $art_temp){
                            
                            $existe = 1;
                            break;
                        }
                    }
                    
                    if($existe == 0) {

                        $temp2 = '';
                    }
                }
                //

                $value->usuario_alta = $temp2;
            } else {
                $value->usuario_alta = '';
            }*/
            
            //

            //desde aca se hace con procedimientos por ahora
            //$contratos = DB::select("CALL INF_SUM_articuloscontratos_SP(?,?)" ,  [$value->cliente_id,$value->id]);
            // se sustituyo el store por que se puede poner aca directamente la consulta
            $contratos = DB::Select('select sum(ca.cantidad) cantidad, a.descripcion articulo, a.id articulo_id  from contratos c
                inner join contratoarticulos ca on c.id = ca.contrato_id
                inner join clientes cli on c.cliente_id = cli.id
                inner join articulos a on ca.articulo_id = a.id
                where c.cliente_id = ? and c.clientedireccion_id = ? and c.estado = 1 and cli.estado = 1
                group by a.descripcion, a.id',  [$value->cliente_id,$value->id]);

            //dd($contratos['0']['cantidad'] );
            if($contratos)
            {
                foreach ($contratos as $key1 => $value1) {

                    //dd($value1->cantidad);
                    if($temp2 == ''){
                        $temp2 =  $value1->articulo . ' (' . $value1->cantidad . ' u.) <br>';
                    } else {
                        $temp2 = $temp2  .  $value1->articulo . ' (' . $value1->cantidad . ' u.) <br>';
                    }
                }


                if($articulo !== '0') {
                    $existe = 0;
                    $art_temp = (int) $articulo;
                    foreach ($contratos as $key2 => $value2) {
                        if($value2->articulo_id == $art_temp){
                            
                            $existe = 1;
                            break;
                        }
                    }
                    
                    if($existe == 0) {

                        $temp2 = '';
                    }
                }
                $value->usuario_alta = $temp2;

            } else {
                $value->usuario_alta = '';
            }
            //hasta aca

        }

        /*if($articulo !== '0') {
            $cantidad = 0;
            foreach ($clientes as $key3 => $value3) {
                if($value3->usuario_alta !== ''){
                    $cantidad += 1; 
                }
            }
        } else {
            //$cantidad = DB::table('clientedirecciones')->where('barrio_id', $barrio)->count();
            $cantidad = $clientes->count();
        }*/

        $cantidad = 0;
            foreach ($clientes as $key3 => $value3) {
                if($value3->usuario_alta !== ''){
                    $cantidad += 1; 
                }
            }

        $data = $clientes->sortBy('referenciadomicilio'); //$clientes->sortBy('referenciadomicilio');

        //dd($cantidad);

        $pdf = PDF::loadView('admin.informes.detallecontratosbarriosarticulosprint', compact('barriodesc', 'data', 'cantidad'));
        //$pdf->setPaper('Legal', 'landscape');

        return $pdf->setPaper('Legal', 'landscape')->stream('informe.pdf');
        //return $pdf->stream('informe.pdf');
        //$dompdf->set_paper ('a4','landscape'); 

    }


    /*para informes generales*/

    public function informevendedorgeneralprint($usuario, $fechadesde, $fechahasta)
    {
        
        $empleado = Empleado::find($usuario);

        $query2="select hrd.articulo_id, a.descripcion articulo, sum(hrd.cantidadfinal) cantidad, hrd.precio ,  sum((hrd.precio * hrd.cantidadfinal)) monto from hojarutadetalles hrd
            inner join articulos a on hrd.articulo_id = a.id
            inner join hojarutas hr on hrd.hojaruta_id =  hr.id
            where hr.empleado_id = " . $usuario . " and hrd.estado = 2 and hrd.fechacarga between '" . $fechadesde . "' and '" . $fechahasta . "'
            group by articulo_id, a.descripcion, hrd.precio
            order by a.descripcion";
       
        $t_por_articulo = DB::select($query2);


        //totales generates
        
        $query3="select sum(hrd.cantidadfinal) cantidad,  sum((hrd.precio * hrd.cantidadfinal)) monto from hojarutadetalles hrd
        inner join hojarutas hr on hrd.hojaruta_id =  hr.id
        where hr.empleado_id = " . $usuario . " and hrd.estado = 2 and hrd.fechacarga between '" . $fechadesde . "' and '" . $fechahasta . "'";

        $t_general = DB::select($query3);

        $totalgeneral = 0;
        $cantidadgeneral = 0;
        foreach ($t_general as $key => $value) {
           $totalgeneral  = $value->monto;
           $cantidadgeneral  = $value->cantidad;
        }

        //cobranza
         //totales cobranzas

        $query4="select ifnull(sum(monto), 0) as monto from hojarutacobranzas hrc
        inner join hojarutas hr on hrc.hojaruta_id =  hr.id
        where hr.empleado_id = " . $usuario . " and hrc.fechacobranza between '" . $fechadesde . "' and '" . $fechahasta . "'";


        $t_cobranza = DB::select($query4);

        $totalcobranza = 0;
        foreach ($t_cobranza as $key => $value) {
           $totalcobranza  = $value->monto;
        }
        //

        //discriminado por pago
        $query5="select 'Efectivo' as tipo, ifnull(sum((hrd.precio * hrd.cantidadfinal)), 0) monto from hojarutadetalles hrd
            inner join hojarutas hr on hrd.hojaruta_id =  hr.id
            where hr.empleado_id = " . $usuario . " and hrd.estado = 2 and hrd.tipopago = 1 and hrd.fechacarga between '" . $fechadesde . "' and '" . $fechahasta . "'
            union all
            select 'Cuenta Corriente' as tipo, ifnull(sum((hrd.precio * hrd.cantidadfinal)), 0) monto from hojarutadetalles hrd
            inner join hojarutas hr on hrd.hojaruta_id =  hr.id
            where hr.empleado_id = " . $usuario . " and hrd.estado = 2 and hrd.tipopago = 2 and hrd.fechacarga between '" . $fechadesde . "' and '" . $fechahasta . "'
            union all
            select 'Sin Cargo' as tipo, ifnull(sum((hrd.precio * hrd.cantidadfinal)), 0) monto from hojarutadetalles hrd
            inner join hojarutas hr on hrd.hojaruta_id =  hr.id
            where hr.empleado_id = " . $usuario . " and hrd.estado = 2 and hrd.tipopago = 3 and hrd.fechacarga between '" . $fechadesde . "' and '" . $fechahasta . "'";
        //dd($query5);

        $t_tipopago = DB::select($query5);
        $totalgeneralefectivo = 0;
        foreach ($t_tipopago as $key => $value) {
            if($value->tipo == 'Efectivo') {
                $totalgeneralefectivo =  number_format(($totalcobranza + $value->monto), 2, '.', '');
            }
        }
        
        
        $pdf = PDF::loadView('admin.informes.informevendedorgeneralprint', compact('empleado', 't_por_articulo', 'fechadesde', 'fechahasta','totalgeneralefectivo', 't_tipopago', 'totalcobranza', 'totalgeneral','cantidadgeneral'));
            //$pdf->setPaper('Legal', 'landscape');

        return $pdf->setPaper('Legal', 'landscape')->stream('informevendedorgeneral.pdf');
    }


    public function informeventaoficinaprint($usuario, $fechadesde, $fechahasta)
    {
        //echo $usuario;
        //$empleado = Empleado::find($usuario);
        $query2="select vd.articulo_id, a.descripcion articulo, sum(vd.cantidad) cantidad, vd.precio ,  sum((vd.precio * vd.cantidad)) monto from ventadetalles vd
        inner join articulos a on vd.articulo_id = a.id
        inner join ventas v on vd.venta_id =  v.id
        where v.fecha between '" . $fechadesde . "' and '" . $fechahasta . "'
        group by articulo_id, a.descripcion, vd.precio
        order by a.descripcion";

        $t_por_articulo = DB::select($query2);


        //totales generates
        
        $query3="select sum(vd.cantidad) cantidad,  sum((vd.precio * vd.cantidad)) monto from ventadetalles vd
        inner join ventas v on vd.venta_id =  v.id
        where v.fecha between '" . $fechadesde . "' and '" . $fechahasta . "'";

        $t_general = DB::select($query3);

        $totalgeneral = 0;
        $cantidadgeneral = 0;
        foreach ($t_general as $key => $value) {
           $totalgeneral  = $value->monto;
           $cantidadgeneral  = $value->cantidad;
        }

        //dd($t_por_articulo);
         
        $pdf = PDF::loadView('admin.informes.informeventaenoficinaprint', compact('t_por_articulo', 'fechadesde', 'fechahasta', 'totalgeneral','cantidadgeneral'));
            //$pdf->setPaper('Legal', 'landscape');

        return $pdf->setPaper('Legal', 'landscape')->stream('informeventaoficina.pdf');
    }

}
