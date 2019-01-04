<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\ProveedorStoreRequest;
use App\Http\Requests\ProveedorUpdateRequest;
use Alert;

use App\Models\Proveedor;
use App\Models\Articulo;
use Auth;

use App\Helpers\FechaHelper;

class ProveedorController extends Controller
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

        $proveedores = Proveedor::type($request->get('type'), $request->get('val'))->paginate(10);

        foreach($proveedores as $proveedor){
            $proveedor->fecha_alta = FechaHelper::getFechaImpresion($proveedor->fecha_alta);
        }

        $proveedores->setPath('proveedores');

         //dd($motivos);

       return view('admin.proveedores.index', compact('proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.proveedores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProveedorStoreRequest $request)
    {
        $proveedor = Proveedor::create($request->all());

        //auditoria
        $proveedor->fill(['usuario_alta' => Auth::user()->username , 'fecha_alta' => date('Y-m-d H:i:s')])->save();
        //
        Alert::success('Proveedor creado con exito')->persistent("Cerrar");
        return redirect()->route('proveedores.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $proveedor = Proveedor::find($id);

        return view('admin.proveedores.show', compact('proveedor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proveedor = Proveedor::find($id);

        return view('admin.proveedores.edit', compact('proveedor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProveedorUpdateRequest $request, $id)
    {

        $proveedor = Proveedor::find($id);

        $proveedor->fill($request->all())->save();


        //auditoria
        $proveedor->fill(['usuario_modi' => Auth::user()->username , 'fecha_modi' => date('Y-m-d H:i:s')])->save();
        //

        Alert::success('Proveedor actualizado con exito')->persistent("Cerrar");
        return redirect()->route('proveedores.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $existe = Articulo::where('proveedor_id', $id)->count();

        if($existe > 0)
        {
            Alert::error('No se puede eliminar el registro')->persistent("Cerrar");
            return back();
        }
        

        Proveedor::find($id)->delete();

        Alert::success('Eliminado correctamente')->persistent("Cerrar");
        return back();
    }
}
