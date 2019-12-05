<?php


namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\ArticuloStoreRequest;
use App\Http\Requests\ArticuloUpdateRequest;
use Alert;
use DB;
use App\Models\Contrato;
use App\Models\Contratoarticulo;
use App\Models\Clientedireccion;
use App\Models\Modelocontrato;
use App\Models\Cliente;
use App\Models\Articulo;
use App\Models\Modulo;
use App\Models\Perfil;
use Auth;

use App\Helpers\FechaHelper;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;

class ContratoController extends Controller
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
    public function create($id)
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
     * @param  \App\Contrato  $contrato
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cliente = Cliente::find($id);
        
        $clientedirecciones = Clientedireccion::where('cliente_id', $cliente->id)->get();

        $direcciones =  array();

        $temp = '';

        foreach ($clientedirecciones as $key => $value) {
             
            if($value->barrio_id) {
                $temp = 'Bº ' . $value->barrio->descripcion;
            } 

            if($value->calle_id) {
                $temp = $temp . ' Calle ' . $value->calle->descripcion;
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

            $direcciones += [$value->id => $temp];
        }

        //dd($direcciones);

        $modelocontratos  = Modelocontrato::orderBy('id', 'ASC')->pluck('descripcion' , 'id');

        $articulos  = Articulo::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        // para el listado
        $contratos  = Contrato::where('cliente_id', $id)->orderBy('fechacontrato' , 'DESC')->get();

        $temp = '';
        $temp2 = '';
        foreach ($contratos as $key => $value) {


         //para direcciones
            $clientedirectemp = Clientedireccion::find($value->clientedireccion_id);
                 
            if($clientedirectemp->barrio_id) {
                $temp2 = 'Bº ' . $clientedirectemp->barrio->descripcion;
            } 

            if($clientedirectemp->calle_id) {
                $temp2 = $temp2 . ' Calle ' . $clientedirectemp->calle->descripcion;
            } 

            if($clientedirectemp->numero) {
                $temp2 = $temp2 . ' Nro. ' . $clientedirectemp->numero;
            }

            if($clientedirectemp->manzana) {
                $temp2 = $temp2 . ' Mz. ' . $clientedirectemp->manzana;
            } 


            if($clientedirectemp->casa) {
                $temp2 = $temp2 . ' C. ' . $clientedirectemp->casa;
            } 

            if($clientedirectemp->seccion) {
                $temp2 = $temp2 . ' Seccion ' . $clientedirectemp->seccion;
            }

            if($clientedirectemp->lote) {
                $temp2 = $temp2 . ' Lote ' . $clientedirectemp->lote;
            }

            if($clientedirectemp->edificiotorre) {
                $temp2 = $temp2 . ' Edificio ' . $clientedirectemp->edificiotorre;
            } 

            if($clientedirectemp->piso) {
                $temp2 = $temp2 . ' Piso/Dpto ' . $clientedirectemp->piso;
            } 

            $value->usuario_alta = $temp2;

            $temp2 = '';
                //
            //

            $contratoarticulos  = Contratoarticulo::where('contrato_id', $value->id)->get();

            foreach ($contratoarticulos as $key1 => $value1) {
                
                if($temp == ''){
                    $temp =  $value1->articulo->descripcion . ' (' . $value1->cantidad . ' Unidad/es) <br>';
                } else {
                    $temp = $temp  .  $value1->articulo->descripcion . ' (' . $value1->cantidad . ' Unidad/es)  <br>';
                }
               
            }

            $value->usuario_modi = $temp;

            $temp = '';
        
                //
        }
        //

        $edit = 0;

        $estados    = [ 0 => 'Inactivo', 1 => 'Activo'];

        $c_activos = DB::Select('select sum(ca.cantidad) cantidad, a.descripcion articulo from contratos c
                inner join contratoarticulos ca on c.id = ca.contrato_id
                inner join clientes cli on c.cliente_id = cli.id
                inner join articulos a on ca.articulo_id = a.id
                where c.cliente_id = ?  and c.estado = 1 and cli.estado = 1
                group by a.descripcion',  [$id]);



        return view('admin.contratos.show', compact('edit', 'cliente', 'articulos', 'direcciones', 'modelocontratos', 'contratos', 'estados', 'c_activos'));

    }


    public function printcontrato($id)
    {
        $contratotemp = Contrato::find($id);
        $modelocontrato = Modelocontrato::find($contratotemp->modelocontrato_id);
        $cliente = Cliente::find($contratotemp->cliente_id);
        //echo $modelocontrato;
        
        $contrato = $modelocontrato->cuerpo;
        $fecha = new Carbon($contratotemp->fechacontrato);
        //para el mes
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $mes = $meses[($fecha->format('n')) - 1];
        //
        // cliente
        if($cliente->tipocliente_id == 1){
            $apellidonombre = $cliente->apellido .' '. $cliente->nombre;
        } else {
            $apellidonombre = $cliente->cliente; 
        }
        //

        //direccion
        $clientedireccion = Clientedireccion::where('id', $contratotemp->clientedireccion_id)->first();

       //dd($clientedireccion);

        if($clientedireccion->barrio_id) {
            $direcciones = 'Bº ' . $clientedireccion->barrio->descripcion;
        } 

        if($clientedireccion->calle_id) {
            $direcciones = $direcciones . ' Calle ' . $clientedireccion->calle->descripcion;
        } 

        if($clientedireccion->numero) {
            $direcciones = $direcciones . ' Nro. ' . $clientedireccion->numero;
        }

        if($clientedireccion->manzana) {
            $direcciones = $direcciones . ' Mz. ' . $clientedireccion->manzana;
        } 


        if($clientedireccion->casa) {
            $direcciones = $direcciones . ' C. ' . $clientedireccion->casa;
        } 

        if($clientedireccion->seccion) {
            $direcciones = $direcciones . ' Seccion ' . $clientedireccion->seccion;
        }

        if($clientedireccion->lote) {
            $direcciones = $direcciones . ' Lote ' . $clientedireccion->lote;
        }

        if($clientedireccion->edificiotorre) {
            $direcciones = $direcciones . ' Edificio ' . $clientedireccion->edificiotorre;
        } 

        if($clientedireccion->piso) {
            $direcciones = $direcciones . ' Piso/Dpto ' . $clientedireccion->piso;
        }
        //
        //articulos
        $contratoarticulos  = Contratoarticulo::where('contrato_id', $id)->get();
        $tot = count($contratoarticulos);
        $articulos = '';
        foreach ($contratoarticulos as $key => $value) {
            
            if($articulos == ''){
                $articulos =  '<ul><li>'. $value->articulo->descripcion . ' - ' . $value->cantidad . ' Unidad/es</li>';
            } else {
                $articulos = $articulos . '<li>' .  $value->articulo->descripcion . ' - ' . $value->cantidad . ' Unidad/es</li>';
            }
            
            if ($key == $tot-1){
                $articulos = $articulos . '</ul>';
            }
                 
        }
        //
        $contrato = str_replace('{{codigo_contrato}}', $contratotemp->cliente_id, $contrato);
        $contrato = str_replace('{{dia_contrato}}', $fecha->day, $contrato);
        $contrato = str_replace('{{mes_contrato}}',$mes, $contrato);
        $contrato = str_replace('{{anio_contrato}}', $fecha->year, $contrato);
        $contrato = str_replace('{{apellido_nombre_cliente}}', $apellidonombre, $contrato);
        $contrato = str_replace('{{tipodocumento}}', $cliente->tipodocumento->descripcion, $contrato);
        $contrato = str_replace('{{nrodocumento_cliente}}', $cliente->numerodocumento, $contrato);
        $contrato = str_replace('{{domicilio_cliente}}', $direcciones, $contrato);
        $contrato = str_replace('{{articulo_cantidad}}', $articulos, $contrato);

        $pdf = PDF::loadView('admin.contratos.printcontrato', compact('contrato'));

        return $pdf->setPaper('Legal')->stream('contrato.pdf');
    }



      /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $cliente = Cliente::find($id);
        
        $clientedirecciones = Clientedireccion::where('cliente_id', $cliente->id)->get();

        $direcciones =  array();

        
        $temp = '';

        foreach ($clientedirecciones as $key => $value) {
             
            if($value->barrio_id) {
                $temp = 'Bº ' . $value->barrio->descripcion;
            } 
            
            if($value->calle_id) {
                $temp = $temp . ' Calle ' . $value->calle->descripcion;
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

            $direcciones += [$value->id => $temp];
        }

        //dd($direcciones);

        $modelocontratos  = Modelocontrato::orderBy('id', 'ASC')->pluck('modelo' , 'id');

        $articulos  = Articulo::where('tipoarticulo_id', '<>', 3)->where('estado', 1)->orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        // para el listado
        $contratos  = Contrato::where('cliente_id', $id)->orderBy('fechacontrato' , 'DESC')->get();

        $temp = '';
        $temp2 = '';
        foreach ($contratos as $key => $value) {


         //para direcciones
            $clientedirectemp = Clientedireccion::find($value->clientedireccion_id);
                 
            if($clientedirectemp->barrio_id) {
                $temp2 = 'Bº ' . $clientedirectemp->barrio->descripcion;
            } 

            if($clientedirectemp->calle_id) {
                $temp2 = $temp2 . ' Calle ' . $clientedirectemp->calle->descripcion;
            } 

            if($clientedirectemp->numero) {
                $temp2 = $temp2 . ' Nro. ' . $clientedirectemp->numero;
            }

            if($clientedirectemp->manzana) {
                $temp2 = $temp2 . ' Mz. ' . $clientedirectemp->manzana;
            } 


            if($clientedirectemp->casa) {
                $temp2 = $temp2 . ' C. ' . $clientedirectemp->casa;
            } 

            if($clientedirectemp->seccion) {
                $temp2 = $temp2 . ' Seccion ' . $clientedirectemp->seccion;
            }

            if($clientedirectemp->lote) {
                $temp2 = $temp2 . ' Lote ' . $clientedirectemp->lote;
            }

            if($clientedirectemp->edificiotorre) {
                $temp2 = $temp2 . ' Edificio ' . $clientedirectemp->edificiotorre;
            } 

            if($clientedirectemp->piso) {
                $temp2 = $temp2 . ' Piso/Dpto ' . $clientedirectemp->piso;
            } 

            $value->usuario_alta = $temp2;

            $temp2 = '';
                //
            //

            $contratoarticulos  = Contratoarticulo::where('contrato_id', $value->id)->get();

            foreach ($contratoarticulos as $key1 => $value1) {
                
                if($temp == ''){
                    $temp =  $value1->articulo->descripcion . ' (' . $value1->cantidad . ' Unidad/es) <br>';
                } else {
                    $temp = $temp  .  $value1->articulo->descripcion . ' (' . $value1->cantidad . ' Unidad/es)  <br>';
                }
               
               
            }

            $value->usuario_modi = $temp;

            $temp = '';
        
                //
        }
        //

        $edit = 1;

       $estados    = [ 0 => 'Inactivo', 1 => 'Activo'];

       $c_activos = DB::Select('select sum(ca.cantidad) cantidad, a.descripcion articulo from contratos c
        inner join contratoarticulos ca on c.id = ca.contrato_id
        inner join clientes cli on c.cliente_id = cli.id
        inner join articulos a on ca.articulo_id = a.id
        where c.cliente_id = ?  and c.estado = 1 and cli.estado = 1
        group by a.descripcion',  [$id]);

        return view('admin.contratos.edit', compact('edit', 'cliente', 'articulos', 'direcciones', 'modelocontratos', 'contratos', 'estados', 'c_activos'));

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
        //$contrato = Contrato::find($id);


        if($request->get("contrato_id")) {
            
            $contrato = Contrato::find($request->get("contrato_id"));

            $contrato->fill($request->all())->save();

                        //auditoria
            $contrato->fill(['usuario_modi' => Auth::user()->username , 'fecha_modi' => date('Y-m-d H:i:s')])->save();
            //

            Contratoarticulo::where('contrato_id', $contrato->id)->delete();    

            Alert::success('Contrato modificado con exito')->persistent("Cerrar");
        } else {

            $contrato = Contrato::create($request->all());

            //auditoria
            $contrato->fill(['cliente_id' => $id, 'usuario_alta' => Auth::user()->username , 'fecha_alta' => date('Y-m-d H:i:s')])->save();
            //

            Alert::success('Contrato creado con exito')->persistent("Cerrar");
        }

      

         //guardar familiares asociados al cliente
        $listado_articulos_text = $request->input("listado_articulos");

        if($listado_articulos_text) {


            $listado_articulos_array = explode('&&&', $listado_articulos_text);
            array_pop($listado_articulos_array);



            foreach ($listado_articulos_array as $articulo_text)
            {
                list($articulo_id, $cantidad) = explode('|', $articulo_text);

                $contratoarticulo = new Contratoarticulo();
                    $contratoarticulo->contrato_id = $contrato->id;
                    $contratoarticulo->articulo_id = $articulo_id;
                    $contratoarticulo->cantidad = $cantidad;
                    $contratoarticulo->usuario_alta = Auth::user()->username;
                    $contratoarticulo->fecha_alta = date('Y-m-d H:i:s');

                $contratoarticulo->save();
            }
        }

        //
        //Alert::success('Contrato creado con exito')->persistent("Cerrar");
        //return redirect()->route('clientes.index');
        return redirect()->route('contratos.edit', $id);

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contrato  $contrato
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        Contratoarticulo::where('contrato_id', $id)->delete();    

        Contrato::find($id)->delete();

        /*Alert::success('Eliminado correctamente')->persistent('Cerrar');
        return back();*/

        return true;
    }


    public function eliminar($id)
    {
        
        //dd($id);
        Contratoarticulo::where('contrato_id', $id)->delete();    

        Contrato::find($id)->delete();

        /*Alert::success('Eliminado correctamente')->persistent('Cerrar');
        return back();*/

        return 0;
    }
}
