<?php

namespace App\Http\Controllers\Admin\Complementos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Complementos\TipofamiliarStoreRequest;
use App\Http\Requests\Complementos\TipofamiliarUpdateRequest;
use Alert;

use App\Models\Tipofamiliar;
//use App\Models\Empleado;
use App\Models\Modulo;
use App\Models\Perfil;
use Auth;

use App\Helpers\FechaHelper;

class TipofamiliarController extends Controller
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
 

        $tipofamiliares = Tipofamiliar::type($request->get('type'), $request->get('val'))->paginate(15);

        foreach($tipofamiliares as $tipofamiliar){
            $tipofamiliar->fecha_alta = FechaHelper::getFechaImpresion($tipofamiliar->fecha_alta); 
        }

        $tipofamiliares->setPath('tipofamiliares');

         //dd($motivos);

       return view('admin.complementos.tipofamiliares.index', compact('tipofamiliares', 'permiso'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.complementos.tipofamiliares.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipofamiliarStoreRequest $request)
    {
        $tipofamiliar = Tipofamiliar::create($request->all());

        //auditoria
        $tipofamiliar->fill(['usuario_alta' => Auth::user()->username , 'fecha_alta' => date('Y-m-d H:i:s')])->save();
        //
        Alert::success('Tipo Familiar creado con exito')->persistent("Cerrar");
        return redirect()->route('tipofamiliares.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipofamiliar = Tipofamiliar::find($id);

        $tipofamiliar->fecha_alta = FechaHelper::getFechaImpresion($tipofamiliar->fecha_alta); 

        return view('admin.complementos.tipofamiliares.show', compact('tipofamiliar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipofamiliar = Tipofamiliar::find($id);

        return view('admin.complementos.tipofamiliares.edit', compact('tipofamiliar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TipofamiliarUpdateRequest $request, $id)
    {
        
        $tipofamiliar = Tipofamiliar::find($id);

        $tipofamiliar->fill($request->all())->save();


        //auditoria
        $tipofamiliar->fill(['usuario_modi' => Auth::user()->username , 'fecha_modi' => date('Y-m-d H:i:s')])->save();
        //

        Alert::success('Tipo Familiar actualizado con exito')->persistent("Cerrar");
        return redirect()->route('tipofamiliares.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        /*$existe = Empleado::where('tipoempleado_id', $id)->count();

        if($existe > 0) 
        {
            Alert::error('No se puede eliminar el registro')->persistent("Cerrar");
            return back();
        }*/

        
        Tipofamiliar::find($id)->delete();

        Alert::success('Eliminado correctamente')->persistent("Cerrar");
        return back();
    }
}