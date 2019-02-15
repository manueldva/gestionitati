<?php

namespace App\Http\Controllers\Admin\Complementos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Complementos\TipoempleadoStoreRequest;
use App\Http\Requests\Complementos\TipoempleadoUpdateRequest;
use Alert;

use App\Models\Tipoempleado;
use App\Models\Empleado;
use App\Models\Modulo;
use App\Models\Perfil;
use Auth;

use App\Helpers\FechaHelper;

class TipoempleadoController extends Controller
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

         $tipoempleados = Tipoempleado::type($request->get('type'), $request->get('val'))->paginate(15);


        foreach($tipoempleados as $tipoempleado){
            $tipoempleado->fecha_alta = FechaHelper::getFechaImpresion($tipoempleado->fecha_alta); 
        }

        $tipoempleados->setPath('tipoempleados');

         //dd($motivos);

       return view('admin.complementos.tipoempleados.index', compact('tipoempleados', 'permiso'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.complementos.tipoempleados.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipoempleadoStoreRequest $request)
    {
        $tipoempleado = Tipoempleado::create($request->all());

        //auditoria
        $tipoempleado->fill(['usuario_alta' => Auth::user()->username , 'fecha_alta' => date('Y-m-d H:i:s')])->save();
        //
        Alert::success('Tipo Empleado creado con exito')->persistent("Cerrar");
        //return redirect()->route('tipoempleados.index');
        return redirect()->route('tipoempleados.edit', $tipoempleado->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipoempleado = Tipoempleado::find($id);

        $tipoempleado->fecha_alta = FechaHelper::getFechaImpresion($tipoempleado->fecha_alta); 

        return view('admin.complementos.tipoempleados.show', compact('tipoempleado'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipoempleado = Tipoempleado::find($id);

        return view('admin.complementos.tipoempleados.edit', compact('tipoempleado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TipoempleadoUpdateRequest $request, $id)
    {
        
        $tipoempleado = Tipoempleado::find($id);

        $tipoempleado->fill($request->all())->save();


        //auditoria
        $tipoempleado->fill(['usuario_modi' => Auth::user()->username , 'fecha_modi' => date('Y-m-d H:i:s')])->save();
        //

        Alert::success('Tipo Empleado actualizado con exito')->persistent("Cerrar");
        //return redirect()->route('tipoempleados.index');
        return redirect()->route('tipoempleados.edit', $tipoempleado->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $existe = Empleado::where('tipoempleado_id', $id)->count();

        if($existe > 0) 
        {
            Alert::error('No se puede eliminar el registro')->persistent("Cerrar");
            return back();
        }

        
        Tipoempleado::find($id)->delete();

        Alert::success('Eliminado correctamente')->persistent("Cerrar");
        return back();
    }
}