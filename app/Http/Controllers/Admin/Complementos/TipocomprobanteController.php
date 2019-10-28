<?php

namespace App\Http\Controllers\Admin\Complementos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Complementos\TipocomprobanteStoreRequest;
use App\Http\Requests\Complementos\TipocomprobanteUpdateRequest;
use Alert;

use App\Models\Tipocomprobante;
use App\Models\Gasto;
use App\Models\Modulo;
use App\Models\Perfil;
use Auth;

use App\Helpers\FechaHelper;

class TipocomprobanteController extends Controller
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
        $modulo_actual = Modulo::where('valor', '=', 'COMPLEMENTO')->get();
        $modulos = $perfil->modulos()->where('modulo_id', '=', $modulo_actual[0]->id)->get();
        $permiso = $modulos[0]->pivot->permiso;
 

        //$tipoempleados = Tipoempleado::type($request->get('type'), $request->get('val'))->where('id','!=',1)->paginate(15);

         $tipocomprobantes = Tipocomprobante::type($request->get('type'), $request->get('val'))->paginate(15);


        foreach($tipocomprobantes as $tipocomprobante){
            $tipocomprobante->fecha_alta = FechaHelper::getFechaImpresion($tipocomprobante->fecha_alta); 
        }

        $tipocomprobantes->setPath('tipocomprobantes');

         //dd($motivos);

       return view('admin.complementos.tipocomprobantes.index', compact('tipocomprobantes', 'permiso'));
    }

   /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.complementos.tipocomprobantes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipocomprobanteStoreRequest $request)
    {
        $tipocomprobante = Tipocomprobante::create($request->all());

        //auditoria
        $tipocomprobante->fill(['usuario_alta' => Auth::user()->username , 'fecha_alta' => date('Y-m-d H:i:s')])->save();
        //
        Alert::success('Tipo Comprobante creado con exito')->persistent("Cerrar");
        //return redirect()->route('tipoempleados.index');
        return redirect()->route('tipocomprobantes.edit', $tipocomprobante->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipocomprobante = Tipocomprobante::find($id);

        $tipocomprobante->fecha_alta = FechaHelper::getFechaImpresion($tipocomprobante->fecha_alta); 

        return view('admin.complementos.tipocomprobantes.show', compact('tipocomprobante'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipocomprobante = Tipocomprobante::find($id);

        return view('admin.complementos.tipocomprobantes.edit', compact('tipocomprobante'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TipocomprobanteUpdateRequest $request, $id)
    {
        
        $tipocomprobante = Tipocomprobante::find($id);

        $tipocomprobante->fill($request->all())->save();


        //auditoria
        $tipocomprobante->fill(['usuario_modi' => Auth::user()->username , 'fecha_modi' => date('Y-m-d H:i:s')])->save();
        //

        Alert::success('Tipo Comprobante actualizado con exito')->persistent("Cerrar");
        //return redirect()->route('tipoempleados.index');
        return redirect()->route('tipocomprobantes.edit', $tipocomprobante->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $existe = Gasto::where('tipocomprobante_id', $id)->count();

        if($existe > 0) 
        {
            Alert::error('No se puede eliminar el registro')->persistent("Cerrar");
            return back();
        }

        
        Tipocomprobante::find($id)->delete();

        Alert::success('Eliminado correctamente')->persistent("Cerrar");
        return back();
    }
}
