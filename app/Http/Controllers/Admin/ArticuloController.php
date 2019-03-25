<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\ArticuloStoreRequest;
use App\Http\Requests\ArticuloUpdateRequest;
use Alert;

use App\Models\Articulo;
use App\Models\Tipoarticulo;
use App\Models\Contratoarticulo;
use App\Models\Modulo;
use App\Models\Perfil;
use Auth;


use App\Helpers\FechaHelper;

class ArticuloController extends Controller
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
        $modulo_actual = Modulo::where('valor', '=', 'ARTICULO')->get();
        $modulos = $perfil->modulos()->where('modulo_id', '=', $modulo_actual[0]->id)->get();
        $permiso = $modulos[0]->pivot->permiso;
 

        $articulos = Articulo::type($request->get('type'), $request->get('val'))->paginate(15);

        foreach($articulos as $articulo){
            $articulo->fecha_alta = FechaHelper::getFechaImpresion($articulo->fecha_alta); 
        }

        $articulos->setPath('articulos');

         //dd($motivos);

       return view('admin.articulos.index', compact('articulos', 'permiso'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipoarticulos  = Tipoarticulo::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');
        $planarticulos  = Articulo::where('tipoarticulo_id', 1)->orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        return view('admin.articulos.create', compact('tipoarticulos', 'planarticulos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticuloStoreRequest $request)
    {
        $articulo = Articulo::create($request->all());

        //auditoria
        $articulo->fill(['usuario_alta' => Auth::user()->username , 'fecha_alta' => date('Y-m-d H:i:s')])->save();
        //
        Alert::success('Producto creado con exito')->persistent("Cerrar");
        //return redirect()->route('articulos.index');
        return redirect()->route('articulos.edit', $articulo->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $articulo = Articulo::find($id);

        $articulo->fecha_alta = FechaHelper::getFechaImpresion($articulo->fecha_alta); 

        return view('admin.articulos.show', compact('articulo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $articulo = Articulo::find($id);

        $tipoarticulos  = Tipoarticulo::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');
        $planarticulos  = Articulo::where('tipoarticulo_id', 1)->orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        return view('admin.articulos.edit', compact('articulo','planarticulos' , 'tipoarticulos'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticuloUpdateRequest $request, $id)
    {
        
        $articulo = Articulo::find($id);

        $articulo->fill($request->all())->save();


        //auditoria
        $articulo->fill(['usuario_modi' => Auth::user()->username , 'fecha_modi' => date('Y-m-d H:i:s')])->save();
        //

        Alert::success('Producto actualizado con exito')->persistent("Cerrar");
        //return redirect()->route('articulos.index');
        return redirect()->route('articulos.edit', $articulo->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $existe = Contratoarticulo::where('articulo_id', $id)->count();

        if($existe > 0) 
        {
            Alert::error('No se puede eliminar el registro')->persistent("Cerrar");
            return back();
        }

        
        Articulo::find($id)->delete();

        Alert::success('Eliminado correctamente')->persistent("Cerrar");
        return back();
    }
}
