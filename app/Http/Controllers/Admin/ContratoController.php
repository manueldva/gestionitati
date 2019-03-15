<?php


namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\ArticuloStoreRequest;
use App\Http\Requests\ArticuloUpdateRequest;
use Alert;

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
     * @param  \App\Contrato  $contrato
     * @return \Illuminate\Http\Response
     */
    public function show(Contrato $contrato)
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
        /*$articulo = Articulo::find($id);

        return view('admin.articulos.edit'
        , compact('articulo'));*/
        $cliente = Cliente::find($id);
        
        $clientedirecciones = Clientedireccion::where('cliente_id', $cliente->id)->get();

        $direcciones =  array();

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
                    $temp =  $value1->articulo->descripcion . ' (' . $value1->cantidad . ' Unidad/es)';
                } else {
                    $temp = $temp . ' - ' .  $value1->articulo->descripcion . ' (' . $value1->cantidad . ' Unidad/es)';
                }
               
            }

            $value->usuario_modi = $temp;

            $temp = '';
        
                //
        }
        //


       



        return view('admin.contratos.edit', compact('cliente', 'articulos', 'direcciones', 'modelocontratos', 'contratos'));

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

        $contrato = Contrato::create($request->all());


        //auditoria
        $contrato->fill(['cliente_id' => $id, 'usuario_modi' => Auth::user()->username , 'fecha_modi' => date('Y-m-d H:i:s')])->save();
        //


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
        Alert::success('Contrato creado con exito')->persistent("Cerrar");
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
