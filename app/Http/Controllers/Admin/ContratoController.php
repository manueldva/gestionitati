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

        $direcciones = [];

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
                $temp = $temp . ' Piso ' . $value->piso;
            } 

            $direcciones = [$value->id => $temp];
        }

        //dd($direcciones);

        $modelocontratos  = Modelocontrato::orderBy('id', 'ASC')->pluck('descripcion' , 'id');

        $articulos  = Articulo::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');



        return view('admin.contratos.edit', compact('cliente', 'articulos', 'direcciones', 'modelocontratos'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticuloUpdateRequest $request, $id)
    {
        
        $articulo = Articulo::find($id);

        $articulo->fill($request->all())->save();


        //auditoria
        $articulo->fill(['usuario_modi' => Auth::user()->username , 'fecha_modi' => date('Y-m-d H:i:s')])->save();
        //

        Alert::success('Articulo actualizado con exito')->persistent("Cerrar");
        return redirect()->route('articulos.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contrato  $contrato
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contrato $contrato)
    {
        //
    }
}
