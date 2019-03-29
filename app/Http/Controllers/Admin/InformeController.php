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
        $usuarios  = User::orderBy('username', 'ASC')->where('id', '<>', 1)->pluck('username' , 'username');


        return view('admin.informes.show',compact('usuarios'));
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
        //
    }


    public function detalleinformecontratoprint($barrio)
    {

        $data = [];

        $articulos = Articulo::where('tipoarticulo_id', '<>', 3)->orderBy('descripcion')->get();

        if($barrio == null   || $barrio == '0') {
            $contratos = DB::table('contratos')->count();

            $barriodesc = 'Todos';
        } else {
            $contratos = DB::table('contratos')
                    ->join('clientedirecciones', 'contratos.clientedireccion_id', '=', 'clientedirecciones.id')
                    ->where('clientedirecciones.barrio_id', '=', $barrio)
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
                        $temp2 =  $value1->articulo->descripcion . ' (' . $value1->cantidad . ' Unidad/es)';
                    } else {
                        $temp2 = $temp2 . ' - ' .  $value1->articulo->descripcion . ' (' . $value1->cantidad . ' Unidad/es)';
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
        //$pdf->setPaper('A4', 'landscape');

        return $pdf->stream('informe.pdf');
        //$dompdf->set_paper ('a4','landscape'); 

        


    }


}
