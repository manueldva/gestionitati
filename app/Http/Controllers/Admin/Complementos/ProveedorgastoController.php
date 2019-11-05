<?php

namespace App\Http\Controllers\Admin\Complementos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Complementos\ProveedorgastoStoreRequest;
use App\Http\Requests\Complementos\ProveedorgastoUpdateRequest;
use Alert;

use App\Models\Proveedorgasto;
use App\Models\Gasto;
use App\Models\Modulo;
use App\Models\Perfil;
use Auth; 

use App\Helpers\FechaHelper;
class ProveedorgastoController extends Controller
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

         $proveedorgastos = Proveedorgasto::type($request->get('type'), $request->get('val'))->paginate(15);


        foreach($proveedorgastos as $proveedorgasto){
            $proveedorgasto->fecha_alta = FechaHelper::getFechaImpresion($proveedorgasto->fecha_alta); 
        }

        $proveedorgastos->setPath('proveedorgastos');

         //dd($motivos);

       return view('admin.complementos.proveedorgastos.index', compact('proveedorgastos', 'permiso'));
    }

   /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.complementos.proveedorgastos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProveedorgastoStoreRequest $request)
    {
        $proveedorgasto = Proveedorgasto::create($request->all());

        //auditoria
        $proveedorgasto->fill(['usuario_alta' => Auth::user()->username , 'fecha_alta' => date('Y-m-d H:i:s')])->save();
        //
        Alert::success('Proveedor creado con exito')->persistent("Cerrar");
        //return redirect()->route('tipoempleados.index');
        return redirect()->route('proveedorgastos.edit', $proveedorgasto->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $proveedorgasto = Proveedorgasto::find($id);

        $proveedorgasto->fecha_alta = FechaHelper::getFechaImpresion($proveedorgasto->fecha_alta); 

        return view('admin.complementos.proveedorgastos.show', compact('proveedorgasto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proveedorgasto = Proveedorgasto::find($id);

        return view('admin.complementos.proveedorgastos.edit', compact('proveedorgasto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProveedorgastoUpdateRequest $request, $id)
    {
        
        $proveedorgasto = Proveedorgasto::find($id);

        $proveedorgasto->fill($request->all())->save();


        //auditoria
        $proveedorgasto->fill(['usuario_modi' => Auth::user()->username , 'fecha_modi' => date('Y-m-d H:i:s')])->save();
        //

        Alert::success('Proveedor actualizado con exito')->persistent("Cerrar");
        //return redirect()->route('tipoempleados.index');
        return redirect()->route('proveedorgastos.edit', $proveedorgasto->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $existe = Gasto::where('proveedorgasto_id', $id)->count();

        if($existe > 0) 
        {
            Alert::error('No se puede eliminar el registro')->persistent("Cerrar");
            return back();
        }

        
        Proveedorgasto::find($id)->delete();

        Alert::success('Eliminado correctamente')->persistent("Cerrar");
        return back();
    }
}
