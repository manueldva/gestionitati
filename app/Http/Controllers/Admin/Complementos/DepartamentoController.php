<?php

namespace App\Http\Controllers\Admin\Complementos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Complementos\DepartamentoStoreRequest;
use App\Http\Requests\Complementos\DepartamentoUpdateRequest;
use Alert;
use App\Models\Provincia;
use App\Models\Departamento;
use App\Models\Cliente;
use App\Models\Modulo;
use App\Models\Perfil;
use Auth;

use App\Helpers\FechaHelper;

class DepartamentoController extends Controller
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
 

        $departamentos = Departamento::type($request->get('type'), $request->get('val'))->paginate(10);

        foreach($departamentos as $departamento){
            $departamento->fecha_alta = FechaHelper::getFechaImpresion($departamento->fecha_alta); 
        }

        $departamentos->setPath('departamentos');

         //dd($motivos);

       return view('admin.complementos.departamentos.index', compact('departamentos', 'permiso'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provincias  = Provincia::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        return view('admin.complementos.departamentos.create', compact('provincias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartamentoStoreRequest $request)
    {

        /*validacion en el controlador por que el request personalizado no lo permite*/
        $existe = Departamento::where('provincia_id', $request->get('provincia_id'))->where('descripcion', '=',$request->get('descripcion'))->count();

        if($existe > 0) 
        {
            Alert::error('Este departamento ya fue creado y asociado a esta provincia')->persistent("Cerrar");
            return back()->withinput();
        }
        
        $departamento = Departamento::create($request->all());

        //auditoria
        $departamento->fill(['usuario_alta' => Auth::user()->username , 'fecha_alta' => date('Y-m-d H:i:s')])->save();
        //
        Alert::success('Departamento creado con exito')->persistent("Cerrar");
        return redirect()->route('departamentos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $departamento = Departamento::find($id);

        $departamento->fecha_alta = FechaHelper::getFechaImpresion($departamento->fecha_alta); 

        return view('admin.complementos.departamentos.show', compact('departamento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $departamento = Departamento::find($id);

        $provincias  = Provincia::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        return view('admin.complementos.departamentos.edit', compact('departamento', 'provincias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DepartamentoUpdateRequest $request, $id)
    {
        
        /*validacion en el controlador por que el request personalizado no lo permite*/
        $existe = Departamento::where('provincia_id', $request->get('provincia_id'))->where('descripcion', '=', $request->get('descripcion'))->where('id', '<>', $id)->count();

        if($existe > 0) 
        {
            Alert::error('Este departamento ya fue creado y asociado a esta provincia')->persistent("Cerrar");
            return back()->withinput();
        }
        

        $departamento = Departamento::find($id);

        $departamento->fill($request->all())->save();


        //auditoria
        $departamento->fill(['usuario_modi' => Auth::user()->username , 'fecha_modi' => date('Y-m-d H:i:s')])->save();
        //

        Alert::success('Departamento actualizado con exito')->persistent("Cerrar");
        return redirect()->route('departamentos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $existe = Cliente::where('departamento_id', $id)->count();

        if($existe > 0) 
        {
            Alert::error('No se puede eliminar el registro')->persistent("Cerrar");
            return back();
        }
        
        Departamento::find($id)->delete();

        Alert::success('Eliminado correctamente')->persistent("Cerrar");
        return back();
    }
}
