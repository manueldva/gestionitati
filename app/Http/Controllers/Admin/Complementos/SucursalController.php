<?php

namespace App\Http\Controllers\Admin\Complementos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Complementos\SucursalStoreRequest;
use App\Http\Requests\Complementos\SucursalUpdateRequest;
use Alert;

use App\Models\Sucursal;
use App\Models\Empleado;
use App\Models\Stockarticulo;
use App\Models\Cliente;
use App\Models\Modulo;
use App\Models\Perfil;
use Auth;

use App\Helpers\FechaHelper;

class SucursalController extends Controller
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

         $sucursales = Sucursal::type($request->get('type'), $request->get('val'))->paginate(15);


        foreach($sucursales as $sucursal){
            $sucursal->fecha_alta = FechaHelper::getFechaImpresion($sucursal->fecha_alta); 
        }

        $sucursales->setPath('sucursales');

         //dd($motivos);

       return view('admin.complementos.sucursales.index', compact('sucursales', 'permiso'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.complementos.sucursales.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SucursalStoreRequest $request)
    {
        $sucursal = Sucursal::create($request->all());

        //auditoria
        $sucursal->fill(['usuario_alta' => Auth::user()->username , 'fecha_alta' => date('Y-m-d H:i:s')])->save();
        //
        Alert::success('Sucursal creada con exito')->persistent("Cerrar");
        //return redirect()->route('tipoempleados.index');
        return redirect()->route('sucursales.edit', $sucursal->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sucursal = Sucursal::find($id);

        $sucursal->fecha_alta = FechaHelper::getFechaImpresion($sucursal->fecha_alta); 

        return view('admin.complementos.sucursales.show', compact('sucursal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sucursal = Sucursal::find($id);

        return view('admin.complementos.sucursales.edit', compact('sucursal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SucursalUpdateRequest $request, $id)
    {
        
        $sucursal = Sucursal::find($id);

        $sucursal->fill($request->all())->save();


        //auditoria
        $sucursal->fill(['usuario_modi' => Auth::user()->username , 'fecha_modi' => date('Y-m-d H:i:s')])->save();
        //

        Alert::success('Sucursal actualizada con exito')->persistent("Cerrar");
        //return redirect()->route('tipoempleados.index');
        return redirect()->route('sucursales.edit', $sucursal->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $existe = Empleado::where('sucursal_id', $id)->count();

        if($existe > 0) 
        {
            Alert::error('No se puede eliminar el registro')->persistent("Cerrar");
            return back();
        }


        $existe = Cliente::where('sucursal_id', $id)->count();

        if($existe > 0) 
        {
            Alert::error('No se puede eliminar el registro')->persistent("Cerrar");
            return back();
        }


        $existe = Stockarticulo::where('sucursal_id', $id)->count();

        if($existe > 0) 
        {
            Alert::error('No se puede eliminar el registro')->persistent("Cerrar");
            return back();
        }

        
        Sucursal::find($id)->delete();

        Alert::success('Eliminado correctamente')->persistent("Cerrar");
        return back();
    }
}
