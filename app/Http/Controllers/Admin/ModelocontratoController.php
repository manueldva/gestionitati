<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\ModelocontratoStoreRequest;
use App\Http\Requests\ModelocontratoUpdateRequest;
use Alert;

use App\Models\Modelocontrato;
use App\Models\Contrato;
use App\Models\Modulo;
use App\Models\Perfil;
use Auth;

use App\Helpers\FechaHelper;

class ModelocontratoController extends Controller
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
        $modulo_actual = Modulo::where('valor', '=', 'MODELO_CONTRATO')->get();

        $modulos = $perfil->modulos()->where('modulo_id', '=', $modulo_actual[0]->id)->get();
        $permiso = $modulos[0]->pivot->permiso;
 

        $modelocontratos = Modelocontrato::type($request->get('type'), $request->get('val'))->paginate(15);

        /*foreach($modelocontratos as $modelocontratos){
            $tipoiva->fecha_alta = FechaHelper::getFechaImpresion($tipoiva->fecha_alta); 
        }*/


        $modelocontratos->setPath('modelocontratos');

         //dd($motivos);



       return view('admin.modelocontratos.index', compact('modelocontratos', 'permiso'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.modelocontratos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ModelocontratoStoreRequest $request)
    {
        $modelocontrato = Modelocontrato::create($request->all());

        //auditoria
        $modelocontrato->fill(['usuario_alta' => Auth::user()->username , 'fecha_alta' => date('Y-m-d H:i:s')])->save();
        //
        Alert::success('Modelo de contrato creado con exito')->persistent("Cerrar");
        //return redirect()->route('tipoivas.index');
        return redirect()->route('modelocontratos.edit', $modelocontrato->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipoiva = Tipoiva::find($id);

        $tipoiva->fecha_alta = FechaHelper::getFechaImpresion($tipoiva->fecha_alta); 

        return view('admin.complementos.tipoivas.show', compact('tipoiva'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $modelocontrato = Modelocontrato::find($id);

        return view('admin.modelocontratos.edit', compact('modelocontrato'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ModelocontratoUpdateRequest $request, $id)
    {
        
        $modelocontrato = Modelocontrato::find($id);

        $modelocontrato->fill($request->all())->save();


        //auditoria
        $modelocontrato->fill(['usuario_modi' => Auth::user()->username , 'fecha_modi' => date('Y-m-d H:i:s')])->save();
        //

        Alert::success('Modelo de Contrato actualizado con exito')->persistent("Cerrar");
        //return redirect()->route('tipoivas.index');
        return redirect()->route('modelocontratos.edit', $modelocontrato->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $existe = Contrato::where('modelocontrato_id', $id)->count();

        if($existe > 0) 
        {
            Alert::error('No se puede eliminar el registro')->persistent("Cerrar");
            return back();
        }

        
        Modelocontrato::find($id)->delete();

        Alert::success('Eliminado correctamente')->persistent("Cerrar");
        return back();
    }
}
