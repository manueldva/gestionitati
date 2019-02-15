<?php

namespace App\Http\Controllers\Admin\Complementos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Complementos\DistritoStoreRequest;
use App\Http\Requests\Complementos\DistritoUpdateRequest;
use Alert;

use App\Models\Distrito;
use App\Models\Barrio;
use App\Models\Modulo;
use App\Models\Perfil;
use Auth;

use App\Helpers\FechaHelper;

class DistritoController extends Controller
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
 

        $distritos = Distrito::type($request->get('type'), $request->get('val'))->paginate(15);

        foreach($distritos as $distrito){
            $distrito->fecha_alta = FechaHelper::getFechaImpresion($distrito->fecha_alta); 
        }

        $distritos->setPath('distritos');

         //dd($motivos);

       return view('admin.complementos.distritos.index', compact('distritos', 'permiso'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.complementos.distritos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DistritoStoreRequest $request)
    {
        $distrito = Distrito::create($request->all());

        //auditoria
        $distrito->fill(['usuario_alta' => Auth::user()->username , 'fecha_alta' => date('Y-m-d H:i:s')])->save();
        //
        Alert::success('Zona creada con exito')->persistent("Cerrar");
        //return redirect()->route('distritos.index');
        return redirect()->route('distritos.edit', $distrito->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $distrito = Distrito::find($id);

        $distrito->fecha_alta = FechaHelper::getFechaImpresion($distrito->fecha_alta); 

        return view('admin.complementos.distritos.show', compact('distrito'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $distrito = Distrito::find($id);

        return view('admin.complementos.distritos.edit', compact('distrito'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DistritoUpdateRequest $request, $id)
    {
        
        $distrito = Distrito::find($id);

        $distrito->fill($request->all())->save();


        //auditoria
        $distrito->fill(['usuario_modi' => Auth::user()->username , 'fecha_modi' => date('Y-m-d H:i:s')])->save();
        //

        Alert::success('Zona actualizada con exito')->persistent("Cerrar");
        return redirect()->route('distritos.edit', $distrito->id);
        //return redirect()->route('distritos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $existe = Barrio::where('distrito_id', $id)->count();

        if($existe > 0) 
        {
            Alert::error('No se puede eliminar el registro')->persistent("Cerrar");
            return back();
        }

        
        Distrito::find($id)->delete();

        Alert::success('Eliminado correctamente')->persistent("Cerrar");
        return back();
    }
}