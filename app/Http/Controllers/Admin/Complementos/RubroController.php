<?php

namespace App\Http\Controllers\Admin\Complementos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Complementos\RubroStoreRequest;
use App\Http\Requests\Complementos\RubroUpdateRequest;
use Alert;

use App\Models\Rubro;
use App\Models\Articulo;
use Auth;

use App\Helpers\FechaHelper;

class RubroController extends Controller
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
       
        $rubros = Rubro::type($request->get('type'), $request->get('val'))->paginate(10);

        foreach($rubros as $rubro){
            $rubro->fecha_alta = FechaHelper::getFechaImpresion($rubro->fecha_alta); 
        }

        $rubros->setPath('rubros');

         //dd($motivos);

       return view('admin.complementos.rubros.index', compact('rubros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.complementos.rubros.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RubroStoreRequest $request)
    {
        $rubro = Rubro::create($request->all());

        //auditoria
        $rubro->fill(['usuario_alta' => Auth::user()->username , 'fecha_alta' => date('Y-m-d H:i:s')])->save();
        //
        Alert::success('Rubro creado con exito')->persistent("Cerrar");
        return redirect()->route('rubros.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rubro = Rubro::find($id);

        $rubro->fecha_alta = FechaHelper::getFechaImpresion($rubro->fecha_alta); 

        return view('admin.complementos.rubros.show', compact('rubro'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rubro = Rubro::find($id);

        return view('admin.complementos.rubros.edit', compact('rubro'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RubroUpdateRequest $request, $id)
    {
        
        $rubro = Rubro::find($id);

        $rubro->fill($request->all())->save();


        //auditoria
        $rubro->fill(['usuario_modi' => Auth::user()->username , 'fecha_modi' => date('Y-m-d H:i:s')])->save();
        //

        Alert::success('Rubro actualizado con exito')->persistent("Cerrar");
        return redirect()->route('rubros.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $existe = Articulo::where('rubro_id', $id)->count();

        if($existe > 0) 
        {
            Alert::error('No se puede eliminar el registro')->persistent("Cerrar");
            return back();
        }
        
        Rubro::find($id)->delete();

        Alert::success('Eliminado correctamente')->persistent("Cerrar");
        return back();
    }
}
