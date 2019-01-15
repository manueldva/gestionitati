<?php

namespace App\Http\Controllers\Admin\Complementos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Complementos\CalleStoreRequest;
use App\Http\Requests\Complementos\CalleUpdateRequest;
use Alert;

use App\Models\Calle;
use App\Models\Cliente;
use App\Models\Modulo;
use App\Models\Perfil;
use Auth;

use App\Helpers\FechaHelper;

class CalleController extends Controller
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
 

        $calles = Calle::type($request->get('type'), $request->get('val'))->paginate(10);

        foreach($calles as $calle){
            $calle->fecha_alta = FechaHelper::getFechaImpresion($calle->fecha_alta); 
        }

        $calles->setPath('calles');

         //dd($motivos);

       return view('admin.complementos.calles.index', compact('calles', 'permiso'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.complementos.calles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CallestoreRequest $request)
    {
        $calle = Calle::create($request->all());

        //auditoria
        $calle->fill(['usuario_alta' => Auth::user()->username , 'fecha_alta' => date('Y-m-d H:i:s')])->save();
        //
        Alert::success('Calle creada con exito')->persistent("Cerrar");
        return redirect()->route('calles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $calle = Calle::find($id);

        $calle->fecha_alta = FechaHelper::getFechaImpresion($calle->fecha_alta); 

        return view('admin.complementos.calles.show', compact('calle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $calle = Calle::find($id);

        return view('admin.complementos.calles.edit', compact('calle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CalleUpdateRequest $request, $id)
    {
        
        $calle = Calle::find($id);

        $calle->fill($request->all())->save();


        //auditoria
        $calle->fill(['usuario_modi' => Auth::user()->username , 'fecha_modi' => date('Y-m-d H:i:s')])->save();
        //

        Alert::success('Calle actualizada con exito')->persistent("Cerrar");
        return redirect()->route('calles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $existe = Cliente::where('provincia_id', $id)->count();

        if($existe > 0) 
        {
            Alert::error('No se puede eliminar el registro')->persistent("Cerrar");
            return back();
        }
        
        Calle::find($id)->delete();

        Alert::success('Eliminado correctamente')->persistent("Cerrar");
        return back();
    }
}
