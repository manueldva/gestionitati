<?php

namespace App\Http\Controllers\Admin\Complementos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//use App\Http\Requests\Complementos\LocalidadStoreRequest;
use App\Http\Requests\Complementos\BarrioUpdateRequest;
use Alert;
use App\Models\Provincia;
use App\Models\Departamento;
use App\Models\Localidad;
use App\Models\Cliente;
use App\Models\Clientedireccion;
use App\Models\Calle;
use App\Models\Barrio;
use App\Models\Distrito;
use App\Models\Modulo;
use App\Models\Perfil;
use Auth;

use App\Helpers\FechaHelper;

class BarrioController extends Controller
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
 

        $barrios =  Barrio::type($request->get('type'), $request->get('val'))->paginate(15);

        foreach($barrios as $barrio){
            $barrio->fecha_alta = FechaHelper::getFechaImpresion($barrio->fecha_alta); 
        }

        $barrios->setPath('barrios');

         //dd($motivos);

       return view('admin.complementos.barrios.index', compact('barrios', 'permiso'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provincias  = Provincia::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');
        $distritos  = Distrito::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');


        return view('admin.complementos.barrios.create', compact('provincias', 'distritos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $listado_barrio_text = $request->input("listado_barrios");
        
        $listado_barrios_array = explode('&&&', $listado_barrio_text);
        array_pop($listado_barrios_array);

        //dd($listado_barrios_array);

		foreach ($listado_barrios_array as $barrio_text)
		{
			list($provincia_id, $departamento_id, $localidad_id, $distrito_id,
            $descripcion, $sincalle) = explode('|', $barrio_text);

			$barrio = new Barrio();
                $barrio->provincia_id = $provincia_id;
                $barrio->departamento_id = $departamento_id;
                $barrio->localidad_id = $localidad_id;
                if($distrito_id !== '') $barrio->distrito_id = $distrito_id;
                $barrio->descripcion = $descripcion;
                $barrio->sincalle = $sincalle;
                $barrio->usuario_alta = Auth::user()->username;
                $barrio->fecha_alta = date('Y-m-d H:i:s');

			$barrio->save();
		}

        //
        Alert::success('Barrio creado con exito')->persistent("Cerrar");
        return redirect()->route('barrios.index');
        //return redirect()->route('barrios.edit', $barrio->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $barrio = Barrio::find($id);

        $barrio->fecha_alta = FechaHelper::getFechaImpresion($barrio->fecha_alta); 

        return view('admin.complementos.barrios.show', compact('barrio'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $barrio = Barrio::find($id);
        $distritos  = Distrito::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');


        return view('admin.complementos.barrios.edit', compact('barrio', 'distritos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(request $request, $id)
    {
        $barrio = Barrio::find($id);


        $localidad = Localidad::where('id', $barrio->localidad_id)->first();
        /*validacion en el controlador por que el request personalizado no lo permite*/
        $existe = Barrio::where('localidad_id', $localidad->id)->where('descripcion', '=', $request->get('descripcion'))->where('id', '<>', $id)->count();

        if($existe > 0) 
        {
            Alert::error('Este barrio ya fue creado y asociado a esta localidad')->persistent("Cerrar");
            return back()->withinput();
        }
        

        $barrio->fill($request->all())->save();

        if($request->input('sincalle') == '1'){
            $sincalle = 1;
        }  else {
            $sincalle = 0;
        }


        //auditoria
        $barrio->fill(['sincalle' => $sincalle, 'usuario_modi' => Auth::user()->username , 'fecha_modi' => date('Y-m-d H:i:s')])->save();
        //

        Alert::success('Barrio actualizado con exito')->persistent("Cerrar");
        return redirect()->route('barrios.index');
        //return redirect()->route('barrios.edit', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $existe = Clientedireccion::where('barrio_id', $id)->count();

        if($existe > 0) 
        {
            Alert::error('No se puede eliminar el registro')->persistent("Cerrar");
            return back();
        }
        
        Barrio::find($id)->delete();

        Alert::success('Eliminado correctamente')->persistent("Cerrar");
        return back();
    }
}
