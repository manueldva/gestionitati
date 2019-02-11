<?php

namespace App\Http\Controllers\Admin\Complementos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Complementos\CompaniatelefonicaStoreRequest;
use App\Http\Requests\Complementos\CompaniatelefonicaUpdateRequest;
use Alert;

use App\Models\Companiatelefonica;
use App\Models\Cliente;
use App\Models\Modulo;
use App\Models\Perfil;
use Auth;

use App\Helpers\FechaHelper;

class CompaniatelefonicaController extends Controller
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
 

        $companiatelefonicas = Companiatelefonica::type($request->get('type'), $request->get('val'))->paginate(15);

        foreach($companiatelefonicas as $companiatelefonica){
            $companiatelefonica->fecha_alta = FechaHelper::getFechaImpresion($companiatelefonica->fecha_alta); 
        }

        $companiatelefonicas->setPath('companiatelefonicas');

         //dd($motivos);

       return view('admin.complementos.companiatelefonicas.index', compact('companiatelefonicas', 'permiso'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.complementos.companiatelefonicas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompaniatelefonicaStoreRequest $request)
    {
        $companiatelefonica = Companiatelefonica::create($request->all());

        //auditoria
        $companiatelefonica->fill(['usuario_alta' => Auth::user()->username , 'fecha_alta' => date('Y-m-d H:i:s')])->save();
        //
        Alert::success('Proveedor Telefonico creado con exito')->persistent("Cerrar");
        return redirect()->route('companiatelefonicas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $companiatelefonica = Companiatelefonica::find($id);

        $companiatelefonica->fecha_alta = FechaHelper::getFechaImpresion($companiatelefonica->fecha_alta); 

        return view('admin.complementos.companiatelefonicas.show', compact('companiatelefonica'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $companiatelefonica = Companiatelefonica::find($id);

        return view('admin.complementos.companiatelefonicas.edit', compact('companiatelefonica'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompaniatelefonicaUpdateRequest $request, $id)
    {
        
        $companiatelefonica = Companiatelefonica::find($id);

        $companiatelefonica->fill($request->all())->save();


        //auditoria
        $companiatelefonica->fill(['usuario_modi' => Auth::user()->username , 'fecha_modi' => date('Y-m-d H:i:s')])->save();
        //

        Alert::success('Proveedor Telefonico actualizado con exito')->persistent("Cerrar");
        return redirect()->route('companiatelefonicas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $existe = Cliente::where('companiatelefonica_id', $id)->count();

        if($existe > 0) 
        {
            Alert::error('No se puede eliminar el registro')->persistent("Cerrar");
            return back();
        }

        
        Companiatelefonica::find($id)->delete();

        Alert::success('Eliminado correctamente')->persistent("Cerrar");
        return back();
    }
}