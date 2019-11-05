<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\GastoStoreRequest;
use App\Http\Requests\GastoUpdateRequest;
use Alert;

use App\Models\Tipocomprobante;
use App\Models\Rubrogasto;
use App\Models\Proveedorgasto;
use App\Models\Gasto;
use App\Models\Modulo;
use App\Models\Perfil;
use Auth;

use App\Helpers\FechaHelper;

class GastosController extends Controller
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
        $modulo_actual = Modulo::where('valor', '=', 'GASTOS')->get();
        $modulos = $perfil->modulos()->where('modulo_id', '=', $modulo_actual[0]->id)->get();
        $permiso = $modulos[0]->pivot->permiso;
 

        //$tipoempleados = Tipoempleado::type($request->get('type'), $request->get('val'))->where('id','!=',1)->paginate(15);

         $gastos = Gasto::type($request->get('type'), $request->get('val'))->paginate(15);


        foreach($gastos as $gasto){
            $gasto->fecha = FechaHelper::getFechaImpresion($gasto->fecha); 
        }

        $gastos->setPath('gastos');

         //dd($motivos);

       return view('admin.gastos.index', compact('gastos', 'permiso'));
    }

   /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipocomprobantes  = Tipocomprobante::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');
        $rubrogastos  = Rubrogasto::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');
        $proveedorgastos  = Proveedorgasto::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        $mediopagos  = ['1'=>'Efectivo', '2'=>'Cheque', '3'=>'Transferencia'];
        $tipopagos  = ['1'=>'Gasto', '2'=>'Compra'];

        return view('admin.gastos.create', compact('tipocomprobantes','rubrogastos', 'mediopagos', 'tipopagos', 'proveedorgastos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GastoStoreRequest $request)
    {
        $gasto = Gasto::create($request->all());

        //auditoria
        $gasto->fill(['usuario_alta' => Auth::user()->username , 'fecha_alta' => date('Y-m-d H:i:s')])->save();
        //
        Alert::success('Gasto asentado con exito')->persistent("Cerrar");
        //return redirect()->route('tipoempleados.index');
        return redirect()->route('gastos.edit', $gasto->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gasto = Gasto::find($id);

        $gasto->fecha = FechaHelper::getFechaImpresion($gasto->fecha); 

        return view('admin.gastos.show', compact('gasto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gasto = Gasto::find($id);
        $tipocomprobantes  = Tipocomprobante::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        
        $gasto->fecha = FechaHelper::getFechaInputDate($gasto->fecha);

        $rubrogastos  = Rubrogasto::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        $proveedorgastos  = Proveedorgasto::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        $mediopagos  = ['1'=>'Efectivo', '2'=>'Cheque', '3'=>'Transferencia'];
        $tipopagos  = ['1'=>'Gasto', '2'=>'Compra'];

        return view('admin.gastos.edit', compact('gasto', 'tipocomprobantes', 'rubrogastos', 'mediopagos', 'tipopagos', 'proveedorgastos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GastoUpdateRequest $request, $id)
    {
        
        $gasto = Gasto::find($id);

        $gasto->fill($request->all())->save();


        //auditoria
        $gasto->fill(['usuario_modi' => Auth::user()->username , 'fecha_modi' => date('Y-m-d H:i:s')])->save();
        //

        Alert::success('Gasto actualizado con exito')->persistent("Cerrar");
        //return redirect()->route('tipoempleados.index');
        return redirect()->route('gastos.edit', $gasto->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        /*$existe = Gasto::where('tipocomprobante_id', $id)->count();

        if($existe > 0) 
        {
            Alert::error('No se puede eliminar el registro')->persistent("Cerrar");
            return back();
        }*/

        
        Gasto::find($id)->delete();

        Alert::success('Eliminado correctamente')->persistent("Cerrar");
        return back();
    }
}
