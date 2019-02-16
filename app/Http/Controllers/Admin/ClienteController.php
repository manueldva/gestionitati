<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests\clienteStoreRequest;
use App\Http\Requests\ClienteUpdateRequest;
use Illuminate\Support\Facades\Storage;

use Intervention\Image\ImageManagerStatic as Image;

use App\Helpers\FechaHelper;

use Alert;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Clientefamiliar;
use App\Models\Clientedireccion;
use App\Models\Clientearticulo;
use App\Models\Empleado;
//use App\Models\Movil;
use App\Models\Provincia;
use App\Models\Departamento;
use App\Models\Localidad;
use App\Models\Barrio;
use App\Models\Calle;
use App\Models\Tipocliente;
use App\Models\Tipoempleado;
use App\Models\Tipodocumento;
use App\Models\Tipofamiliar;
use App\Models\Companiatelefonica;
use App\Models\Tipoiva;
use App\Models\Articulo;

use App\Models\Modulo;
use App\Models\Perfil;
use Auth;

use App\Helpers\Animate;

class ClienteController extends Controller
{
    const IMG_PATH = 'image/clientes/';
    const IMG_WIDTH = 300;
    const IMG_HEIGHT = 300;


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
        $modulo_actual = Modulo::where('valor', '=', 'CLIENTE')->get();
        $modulos = $perfil->modulos()->where('modulo_id', '=', $modulo_actual[0]->id)->get();
        $permiso = $modulos[0]->pivot->permiso;

        $clientes = Cliente::type($request->get('type'), $request->get('val'), $request->get('val2'), $request->get('barrios'), $request->get('tipoclientes'))->paginate(15);
        $clientes->setPath('clientes');

        $barrios  = Barrio::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        $tipoclientes  = Tipocliente::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        foreach ($clientes as $key => $value) {
            $clientedireccion = Clientedireccion::where('cliente_id', $value->id)->first();

            //$direcciones =  array();
         
            if($clientedireccion->barrio_id) {
                $temp = 'Bº ' . $clientedireccion->barrio->descripcion;
            } 

            if($clientedireccion->calle_id) {
                $temp = $temp . ' Calle ' . $clientedireccion->calle->descripcion;
            } 

            if($clientedireccion->numero) {
                $temp = $temp . ' Nro. ' . $clientedireccion->numero;
            }

            if($clientedireccion->manzana) {
                $temp = $temp . ' Mz. ' . $clientedireccion->manzana;
            } 


            if($clientedireccion->casa) {
                $temp = $temp . ' C. ' . $clientedireccion->casa;
            } 

            if($clientedireccion->seccion) {
                $temp = $temp . ' Seccion ' . $clientedireccion->seccion;
            }

            if($clientedireccion->lote) {
                $temp = $temp . ' Lote ' . $clientedireccion->lote;
            }

            if($clientedireccion->edificiotorre) {
                $temp = $temp . ' Edificio ' . $clientedireccion->edificiotorre;
            } 

            if($clientedireccion->piso) {
                $temp = $temp . ' Piso/Dpto ' . $clientedireccion->piso;
            } 

            $value->usuario_modi = $temp;
            
        }

        //dd($clientes);
        
       return view('admin.clientes.index', compact('clientes', 'barrios', 'tipoclientes' ,'permiso'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $editshow = 0;

        $companiatelefonicas  = Companiatelefonica::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        $provincias  = Provincia::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        $tipodocumentos  = Tipodocumento::orderBy('id', 'ASC')->pluck('descripcion' , 'id');

        $tipoivas  = Tipoiva::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        $tipoclientes  = Tipocliente::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        $articulos  = Articulo::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        $tipoempleado = Tipoempleado::where('descripcion', '=', 'Vendedor')->first();
        if($tipoempleado) {
            $empleados  = Empleado::orderBy('empleado', 'ASC')->where('tipoempleado_id', $tipoempleado->id)->pluck('empleado' , 'id');
                
            if(!$empleados) $empleados = [];
        } else {
            $empleados = [];
        }

        $tipofamiliar  = Tipofamiliar::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');
    
        $estadoclientes    = [ 0 => 'Inactivo', 1 => 'Activo'];

        return view('admin.clientes.create', compact('companiatelefonicas', 'estadoclientes', 'provincias', 'tipodocumentos', 'tipoclientes', 'tipoivas', 'articulos', 'empleados', 'tipofamiliar', 'editshow'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());

        $cliente = Cliente::create($request->all());

        //auditoria
        $cliente->fill( ['estado'=> 1, 'usuario_alta' => Auth::user()->username , 'fecha_alta' => date('Y-m-d H:i:s')])->save();
        //
        

        //guardar direcciones asociados al cliente
        if($request->get('direcciones') == '1'){ // varias direcciones
            $listado_direcciones_text = $request->input("listado_direcciones");
        
            $listado_direcciones_array = explode('&&&', $listado_direcciones_text);
            array_pop($listado_direcciones_array);

            //dd($listado_direcciones_array);

            foreach ($listado_direcciones_array as $direccion_text)
            {
                list($provincia_id, $departamento_id, $localidad_id, 
                    $barrio_id, $calle_id, $numero, $manzana, $casa, 
                    $edificiotorre, $piso, $seccion, $lote, $codigopostal, 
                    $referencia, $observacion, $empleado_id, $horariovisita,
                    $horadesde, $horahasta, $direccion_id) = explode('|', $direccion_text);

                $clientedireccion = new Clientedireccion();
                    $clientedireccion->cliente_id = $cliente->id;
                    $clientedireccion->provincia_id = $provincia_id;
                    $clientedireccion->departamento_id = $departamento_id;
                    $clientedireccion->localidad_id = $localidad_id;
                    if($barrio_id !== '') $clientedireccion->barrio_id = $barrio_id;
                    if($calle_id !== '') $clientedireccion->calle_id = $calle_id;
                    if($numero !== '')$clientedireccion->numero = $numero;
                    if($manzana !== '')$clientedireccion->manzana = $manzana;
                    if($casa !== '')$clientedireccion->casa = $casa;
                    if($edificiotorre !== '')$clientedireccion->edificiotorre = $edificiotorre;
                    if($piso !== '')$clientedireccion->piso = $piso;
                    if($seccion !== '')$clientedireccion->seccion = $seccion;
                    if($lote !== '')$clientedireccion->lote = $lote;
                    if($codigopostal !== '')$clientedireccion->codigopostal = $codigopostal;
                    if($referencia !== '')$clientedireccion->referenciadomicilio = $referencia;
                    if($observacion !== '')$clientedireccion->observaciondomicilio = $observacion;
                    $clientedireccion->empleado_id = $empleado_id;
                    if($horariovisita !== '') $clientedireccion->horariovisita = $horariovisita;
                    if($horadesde !== '')$clientedireccion->horadesde = $horadesde;
                    if($horahasta !== '') $clientedireccion->horahasta = $horahasta;
                    $clientedireccion->usuario_alta = Auth::user()->username;
                    $clientedireccion->fecha_alta = date('Y-m-d H:i:s');

                $clientedireccion->save();
            }
        } else {
            $clientedireccion = Clientedireccion::create($request->all());

            $clientedireccion->fill( ['cliente_id'=> $cliente->id, 'usuario_alta' => Auth::user()->username , 'fecha_alta' => date('Y-m-d H:i:s')])->save();
        }
        
        //


        //guardar familiares asociados al cliente
        $listado_familiares_text = $request->input("listado_familiares");

        if($listado_familiares_text) {


            $listado_familiares_array = explode('&&&', $listado_familiares_text);
            array_pop($listado_familiares_array);



            foreach ($listado_familiares_array as $familiar_text)
            {
                list($tipofamiliar_id, $nombrefamiliar, $contactofamiliar) = explode('|', $familiar_text);

                $clientefamiliar = new Clientefamiliar();
                    $clientefamiliar->tipofamiliar_id = $tipofamiliar_id;
                    $clientefamiliar->cliente_id = $cliente->id;
                    $clientefamiliar->nombre = $nombrefamiliar;
                    $clientefamiliar->contacto = $contactofamiliar;
                    $clientefamiliar->usuario_alta = Auth::user()->username;
                    $clientefamiliar->fecha_alta = date('Y-m-d H:i:s');

                $clientefamiliar->save();
            }
        }

        //
        Alert::success('Cliente creado con exito')->persistent("Cerrar");
        //return redirect()->route('clientes.index');
         return redirect()->route('clientes.edit', $cliente->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $editshow = 2;

        $cliente = Cliente::find($id);

        $clientedirecciones = Clientedireccion::where('cliente_id', $cliente->id)->get();


        //para saber si tiene barrio o no
        if($cliente->direcciones == 0){
            $localidatemp = Localidad::find($clientedirecciones['0']['localidad_id']);
            $sinbarrio = $localidatemp->sinbarrio;
        } else {
            $sinbarrio = 0;
        }

        //sin calle
        if($cliente->direcciones == 0){
             if($clientedirecciones['0']['barrio_id']){
            //para saber si tiene barrio o no
                $barriotemp = Barrio::find($clientedirecciones['0']['barrio_id']);
                $sincalle = $barriotemp->sincalle;
            //sin 
            } else {
                $sincalle = 0;
            }
        } else {
            $sincalle = 0;
        }

        $companiatelefonicas  = Companiatelefonica::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        $provincias  = Provincia::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        if($cliente->direcciones == 0)
        {    
            $departamentos  = Departamento::orderBy('descripcion', 'ASC')->where('provincia_id', $clientedirecciones['0']['provincia_id'])->pluck('descripcion' , 'id');

            $localidades  = Localidad::orderBy('descripcion', 'ASC')->where('departamento_id', $clientedirecciones['0']['departamento_id'])->pluck('descripcion' , 'id');

            $barrios  = Barrio::orderBy('descripcion', 'ASC')->where('localidad_id', $clientedirecciones['0']['localidad_id'])->pluck('descripcion' , 'id');

            $calles  = Calle::orderBy('descripcion', 'ASC')->where('localidad_id', $clientedirecciones['0']['localidad_id'])->pluck('descripcion' , 'id');

        } 

        //dd($calles);
        $tipoivas  = Tipoiva::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        $tipodocumentos  = Tipodocumento::orderBy('id', 'ASC')->pluck('descripcion' , 'id');

        $tipoclientes  = Tipocliente::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        $tipoempleado = Tipoempleado::where('descripcion', '=', 'Vendedor')->first();
        if($tipoempleado) {
            $empleados  = Empleado::orderBy('empleado', 'ASC')->where('tipoempleado_id', $tipoempleado->id)->pluck('empleado' , 'id');
                
            if(!$empleados) $empleados = [];
        } else {
            $empleados = [];
        }

        $estadoclientes    = [ 0 => 'Inactivo', 1 => 'Activo'];

        $tipofamiliar  = Tipofamiliar::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        //$clientearticulos = Clientearticulo::where('cliente_id', $cliente->id)->get();

        $clientefamiliares = Clientefamiliar::where('cliente_id', $cliente->id)->get();




        return view('admin.clientes.show', compact('cliente','companiatelefonicas', 'estadoclientes', 'provincias','departamentos' , 'localidades', 'barrios', 'calles', 'tipoivas', 'tipoclientes', 'tipodocumentos', 'articulos', 'empleados', 'tipofamiliar', 'clientefamiliares', 'clientedirecciones' , 'editshow'));

       

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editshow = 1;

        
        $cliente = Cliente::find($id);

        $clientedirecciones = Clientedireccion::where('cliente_id', $cliente->id)->get();


        //para saber si tiene barrio o no
        if($cliente->direcciones == 0){
            $localidatemp = Localidad::find($clientedirecciones['0']['localidad_id']);
            $sinbarrio = $localidatemp->sinbarrio;
        } else {
            $sinbarrio = 0;
        }

        //sin calle
        if($cliente->direcciones == 0){
             if($clientedirecciones['0']['barrio_id']){
            //para saber si tiene barrio o no
                $barriotemp = Barrio::find($clientedirecciones['0']['barrio_id']);
                $sincalle = $barriotemp->sincalle;
            //sin 
            } else {
                $sincalle = 0;
            }
        } else {
            $sincalle = 0;
        }

        $companiatelefonicas  = Companiatelefonica::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        $provincias  = Provincia::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        if($cliente->direcciones == 0)
        {    
            $departamentos  = Departamento::orderBy('descripcion', 'ASC')->where('provincia_id', $clientedirecciones['0']['provincia_id'])->pluck('descripcion' , 'id');

            $localidades  = Localidad::orderBy('descripcion', 'ASC')->where('departamento_id', $clientedirecciones['0']['departamento_id'])->pluck('descripcion' , 'id');

            $barrios  = Barrio::orderBy('descripcion', 'ASC')->where('localidad_id', $clientedirecciones['0']['localidad_id'])->pluck('descripcion' , 'id');

            $calles  = Calle::orderBy('descripcion', 'ASC')->where('localidad_id', $clientedirecciones['0']['localidad_id'])->pluck('descripcion' , 'id');

        } 

        //dd($calles);
        $tipoivas  = Tipoiva::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        $tipodocumentos  = Tipodocumento::orderBy('id', 'ASC')->pluck('descripcion' , 'id');

        $tipoclientes  = Tipocliente::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        $tipoempleado = Tipoempleado::where('descripcion', '=', 'Vendedor')->first();
        if($tipoempleado) {
            $empleados  = Empleado::orderBy('empleado', 'ASC')->where('tipoempleado_id', $tipoempleado->id)->pluck('empleado' , 'id');
                
            if(!$empleados) $empleados = [];
        } else {
            $empleados = [];
        }

        $estadoclientes    = [ 0 => 'Inactivo', 1 => 'Activo'];

        $tipofamiliar  = Tipofamiliar::orderBy('descripcion', 'ASC')->pluck('descripcion' , 'id');

        //$clientearticulos = Clientearticulo::where('cliente_id', $cliente->id)->get();

        $clientefamiliares = Clientefamiliar::where('cliente_id', $cliente->id)->get();







        return view('admin.clientes.edit', compact('cliente','companiatelefonicas', 'estadoclientes', 'provincias', 'departamentos', 'localidades', 'barrios', 'calles', 'tipoivas', 'tipoclientes', 'tipodocumentos', 'articulos', 'empleados', 'tipofamiliar', 'clientefamiliares', 'clientedirecciones','sinbarrio', 'sincalle', 'editshow'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cliente = Cliente::find($id);

        $cliente->fill($request->all())->save();

        //auditoria
        $cliente->fill(['usuario_modi' => Auth::user()->username , 'fecha_modi' => date('Y-m-d H:i:s')])->save();
        //


        //guardar direcciones asociados al cliente
        if($request->get('direcciones') == '1'){ // varias direcciones
            $listado_direcciones_text = $request->input("listado_direcciones");
        
            $listado_direcciones_array = explode('&&&', $listado_direcciones_text);
            array_pop($listado_direcciones_array);

            //dd($listado_direcciones_array);

            foreach ($listado_direcciones_array as $direccion_text)
            {
                list($provincia_id, $departamento_id, $localidad_id, 
                    $barrio_id, $calle_id, $numero, $manzana, $casa, 
                    $edificiotorre, $piso, $seccion, $lote, $codigopostal, 
                    $referencia, $observacion, $empleado_id, $horariovisita,
                    $horadesde, $horahasta, $direccion_id) = explode('|', $direccion_text);
                
                //alert($direccion_id);
                if($direccion_id == 0)
                {
                    $clientedireccion = new Clientedireccion();
                        $clientedireccion->cliente_id = $cliente->id;
                        $clientedireccion->provincia_id = $provincia_id;
                        $clientedireccion->departamento_id = $departamento_id;
                        $clientedireccion->localidad_id = $localidad_id;
                        if($barrio_id !== '') $clientedireccion->barrio_id = $barrio_id;
                        if($calle_id !== '') $clientedireccion->calle_id = $calle_id;
                        if($numero !== '')$clientedireccion->numero = $numero;
                        if($manzana !== '')$clientedireccion->manzana = $manzana;
                        if($casa !== '')$clientedireccion->casa = $casa;
                        if($edificiotorre !== '')$clientedireccion->edificiotorre = $edificiotorre;
                        if($piso !== '')$clientedireccion->piso = $piso;
                        if($seccion !== '')$clientedireccion->seccion = $seccion;
                        if($lote !== '')$clientedireccion->lote = $lote;
                        if($codigopostal !== '')$clientedireccion->codigopostal = $codigopostal;
                        if($referencia !== '')$clientedireccion->referenciadomicilio = $referencia;
                        if($observacion !== '')$clientedireccion->observaciondomicilio = $observacion;
                        $clientedireccion->empleado_id = $empleado_id;
                        if($horariovisita !== '') $clientedireccion->horariovisita = $horariovisita;
                        if($horadesde !== '')$clientedireccion->horadesde = $horadesde;
                        if($horahasta !== '') $clientedireccion->horahasta = $horahasta;
                        $clientedireccion->usuario_alta = Auth::user()->username;
                        $clientedireccion->fecha_alta = date('Y-m-d H:i:s');

                    $clientedireccion->save();
                }
            }
        } else {
            //$cliente = Clientedireccion::create($request->all());

            $clientedirecciontemp = Clientedireccion::where('cliente_id', $cliente->id)->first();

             $direccion = Clientedireccion::find($clientedirecciontemp->id);

            $direccion->fill($request->all())->save();

            //auditoria
            $direccion->fill(['usuario_modi' => Auth::user()->username , 'fecha_modi' => date('Y-m-d H:i:s')])->save();
        }
        

        //eliminar familiares
        $clientefam = Clientefamiliar::where('cliente_id', $id)->delete();

        //guardar familiares asociados al cliente
        $listado_familiares_text = $request->input("listado_familiares");

        if($listado_familiares_text) {


            $listado_familiares_array = explode('&&&', $listado_familiares_text);
            array_pop($listado_familiares_array);



            foreach ($listado_familiares_array as $familiar_text)
            {
                list($tipofamiliar_id, $nombrefamiliar, $contactofamiliar) = explode('|', $familiar_text);

                $clientefamiliar = new Clientefamiliar();
                    $clientefamiliar->tipofamiliar_id = $tipofamiliar_id;
                    $clientefamiliar->cliente_id = $cliente->id;
                    $clientefamiliar->nombre = $nombrefamiliar;
                    $clientefamiliar->contacto = $contactofamiliar;
                    $clientefamiliar->usuario_alta = Auth::user()->username;
                    $clientefamiliar->fecha_alta = date('Y-m-d H:i:s');

                $clientefamiliar->save();
            }
        }
        
        Alert::success('Cliente Actualizado con exito')->persistent('Cerrar');

        //return redirect()->route('receptions.index');
       return redirect()->route('clientes.edit', $cliente->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        /*if(Reception::where('client_id', $id)->first()) 
        {
            Alert::error('No se puede eliminar el registro');
            return back();
        }*/
        Clientedireccion::where('cliente_id', $id)->delete();    
        Clientefamiliar::where('cliente_id', $id)->delete();

        Cliente::find($id)->delete();

        Alert::success('Eliminado correctamente')->persistent('Cerrar');
        return back();
    }
}
