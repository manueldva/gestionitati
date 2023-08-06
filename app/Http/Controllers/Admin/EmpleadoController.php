<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\EmpleadoStoreRequest;
use App\Http\Requests\EmpleadoUpdateRequest;
use Alert;

use App\Models\Empleado;
use App\Models\Sucursal;
use App\Models\Cliente;
use App\Models\Tipoempleado;
use App\Models\Tipodocumento;
use App\Models\Companiatelefonica;
use App\Models\Estadocivil;
use App\Models\Localidad;
use App\Models\Barrio;

use App\Models\Clientedireccion;
use App\Models\Modulo;
use App\Models\Perfil;
use App\User;
use Auth;

use DB;

use App\Helpers\FechaHelper;

class EmpleadoController extends Controller
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
        $modulo_actual = Modulo::where('valor', '=', 'EMPLEADO')->get();
        $modulos = $perfil->modulos()->where('modulo_id', '=', $modulo_actual[0]->id)->get();
        $permiso = $modulos[0]->pivot->permiso;

        //
        $modulo_actual_user = Modulo::where('valor', '=', 'SEGURIDAD')->get();
        $modulos_user = $perfil->modulos()->where('modulo_id', '=', $modulo_actual_user[0]->id)->get();
        $permiso_user = $modulos_user[0]->pivot->permiso;


        $empleados = Empleado::type($request->get('type'), $request->get('val'), $request->get('val2'))->paginate(15);

        /*foreach($empleados as $empleado){
            $temp = User::where('empleado_id', $empleado->id)->first();
            $empleado->usuario_alta = $temp->id;
        }*/

        

        $empleados->setPath('empleados');

         //dd($motivos);

       return view('admin.empleados.index', compact('empleados', 'permiso', 'permiso_user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $tipoempleados  = Tipoempleado::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');
        $sucursales  = Sucursal::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');
        $tipodocumentos  = Tipodocumento::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');
        $companiatelefonicas  = Companiatelefonica::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');
        $localidades  = Localidad::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');
        $estadociviles  = Estadocivil::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        return view('admin.empleados.create', compact('tipoempleados', 'sucursales', 'tipodocumentos', 'companiatelefonicas','localidades', 'estadociviles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmpleadoStoreRequest $request)
    {
        $empleado = Empleado::create($request->all());

        //auditoria
        $empleado->fill(['empleado'=> $empleado->apellido . ' ' . $empleado->nombre,  'usuario_alta' => Auth::user()->username , 'fecha_alta' => date('Y-m-d H:i:s')])->save();
        //

        //para crear usuario
        $user = new User;
            $user->name = $empleado->empleado;
            $user->password = bcrypt('123456');
            $user->empleado_id = $empleado->id;
        $user->save();
        //
        Alert::success('Empleado creado con exito')->persistent("Cerrar");
        //return redirect()->route('empleados.index');
        return redirect()->route('empleados.edit', $empleado->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empleado = Empleado::find($id);

        //$articulo->fecha_alta = FechaHelper::getFechaImpresion($articulo->fecha_alta); 

        return view('admin.empleados.show', compact('empleado'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empleado = Empleado::find($id);
        $tipoempleados  = Tipoempleado::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');
        $sucursales  = Sucursal::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');
        $tipodocumentos  = Tipodocumento::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');
        $companiatelefonicas  = Companiatelefonica::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');
        $localidades  = Localidad::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');
        $estadociviles  = Estadocivil::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');
        
        $empleado->fechanacimiento = FechaHelper::getFechaInputDate($empleado->fechanacimiento); 

        $empleado->fechaingreso = FechaHelper::getFechaInputDate($empleado->fechaingreso); 
        
        $empleado->fechaegreso = FechaHelper::getFechaInputDate($empleado->fechaegreso); 



        return view('admin.empleados.edit', compact('empleado', 'tipoempleados', 'sucursales', 'tipodocumentos', 'companiatelefonicas', 'localidades', 'estadociviles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmpleadoUpdateRequest $request, $id)
    {
        
        $empleado = Empleado::find($id);

        $empleado->fill($request->all())->save();


        //auditoria
        $empleado->fill(['empleado'=> $empleado->apellido . ' ' . $empleado->nombre, 'usuario_modi' => Auth::user()->username , 'fecha_modi' => date('Y-m-d H:i:s')])->save();
        //

        //para usuario
        $usuario = User::find($empleado->user->id);
        $usuario->fill(['name'=> $empleado->empleado])->save();
       // 


        Alert::success('Empleado actualizado con exito')->persistent("Cerrar");
        //return redirect()->route('empleados.index');
        return redirect()->route('empleados.edit', $empleado->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $existe = Cliente::where('empleado_id', $id)->count();

        if($existe > 0) 
        {
            Alert::error('No se puede eliminar el registro')->persistent("Cerrar");
            return back();
        }


        $existe = User::where('empleado_id', $id)->count();

        if($existe > 0) 
        {
            Alert::error('No se puede eliminar el registro')->persistent("Cerrar");
            return back();
        }


        
        Empleado::find($id)->delete();

        Alert::success('Eliminado correctamente')->persistent("Cerrar");
        return back();
    }


    public function empleadotransferir($id)
    {
        
        $empleadodesde  = Empleado::orderBy('empleado', 'ASC')->where('tipoempleado_id', 1)->where('id', '<>', $id)->pluck('empleado' , 'id');

        
        $empleadoatransferir  = Empleado::orderBy('empleado', 'ASC')->where('tipoempleado_id', 1)->where('id', $id)->pluck('empleado' , 'id');


        return view('admin.empleados.transferir', compact('empleadodesde', 'empleadoatransferir'));
    }

    public function empleadotransferirstore(Request $request)
    {   
        
        $cantidad = Clientedireccion::where('empleado_id',$request->get('empleadodesde_id'))->count();

        if($cantidad > 0) {

            /*$contratosdesde = Clientedireccion::where('empleado_id',$request->get('empleadodesde_id'))->get();
            foreach ($contratosdesde as $key => $value) {
               

                    $value->empleado_id = $request->get('empleadoatransferir_id');
                    $value->usuario_modi = Auth::user()->username;
                    $value->fecha_modi = date('Y-m-d H:i:s');

                $value->save();*/

            $query="update clientedirecciones set
                    empleado_id = " . $request->get('empleadoatransferir_id') ." 
                    where empleado_id  = " . $request->get('empleadodesde_id');

            DB::select($query);

            

            Alert::success('Se transfirieron '. $cantidad . ' Contratos a un nuevo empleado de reparto')->persistent("Cerrar");
        } else {
            Alert::info('El empleado seleccionado no posee contratos para transferir')->persistent("Cerrar");
        }
        

        //dd($contratosdesde);

       
        return redirect()->route('empleados.index');
    }

    public function empleadoabarrio($id)
    {
        

        $empleado = Empleado::where('id',$id)->pluck('empleado' , 'id');

        
        //$barrios  = Barrio::orderBy('descripcion')->get();
        $barrios = Barrio::select('id', 'descripcion', 'localidad_id')
                 ->with('localidad:id,descripcion')
                 ->orderBy('descripcion')
                 ->get();

        //
        //dd(json_encode($barrios->toArray()));

        return view('admin.empleados.barrios', compact('empleado', 'barrios'));
    }



    // Ejemplo en el controlador
    public function empleadoabarrioStore(Request $request)
    {
        // Obtener los IDs de los barrios seleccionados del formulario
        $barriosSeleccionados = $request->input('barrios', []);

        $empleado_id = $request->input('empleado_id');

    
        $cantidad = 0;

        // Guardar los IDs en otra tabla (por ejemplo, la tabla "barrio_user")
        foreach ($barriosSeleccionados as $barrioId) {
            
            $cantidad += Clientedireccion::where('barrio_id', $barrioId)->count();

            ClienteDireccion::where('barrio_id', $barrioId)
                ->update(['empleado_id' => $empleado_id]);
        }

        Alert::success('Se actualizaron '. $cantidad . ' Contratos a un nuevo empleado de reparto')->persistent("Cerrar");
        return redirect()->route('empleados.index');
    }

}
