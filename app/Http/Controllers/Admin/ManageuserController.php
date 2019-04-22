<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Storage;
use Auth;
use Alert;
use Validator;
use App\Helpers\Animate;
use App\Models\Modulo;
use App\Models\Perfil;

use App\User;
use App\Models\Tarea;

class ManageuserController extends Controller
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
    public function index()
    {
     
       /*if (Auth::user()->userType !== 'ADMINISTRATOR') {

        Alert::error('El usuario no esta autorizado para ingresar a este modulo');
        return redirect()->route('home');
       }*/

        $perfil = Perfil::find(Auth::user()->perfil_id);
        $modulo_actual = Modulo::where('valor', '=', 'SEGURIDAD')->get();
        $modulos = $perfil->modulos()->where('modulo_id', '=', $modulo_actual[0]->id)->get();
        $permiso = $modulos[0]->pivot->permiso;


        
       $users = User::where('username','!=','mavila')->orderBy('name')->paginate(15);

       if ($permiso == 0 ) return back();

       return view('admin.manageusers.index', compact('users','permiso'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $perfiles  = Perfil::orderBy('perfil', 'ASC')->pluck('perfil' , 'id');


        return view('admin.manageusers.create', compact('perfiles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        
       /* if ($request->input('name') == ''  || $request->input('username') == '' || $request->input('email') == '') 
        {
            //Alert::error('Faltas datos para dar de alta el Usuario');
            return back()->with('danger', 'Complete todos los datos del usuario')->withInput();
        }


        if (User::where('username', $request->input('username'))->first()) 
        {
            return back()->with('danger', 'Este username ya esta en uso')->withInput();
        }

        if (User::where('email', $request->input('email'))->first()) 
        {
            return back()->with('danger', 'Este email ya esta en uso')->withInput();
        }
    */


        $user = User::create($request->all());


        $user->password = bcrypt('123456');
        $user->save();

        Alert::success('Contraseña inicial: 123456', 'Usuario creado con exito')->persistent("Cerrar");
        return redirect()->route('manageusers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        $image  = Animate::image();  

        return view('admin.manageusers.show', compact('user', 'image'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        $perfiles  = Perfil::orderBy('perfil', 'ASC')->pluck('perfil' , 'id');


        return view('admin.manageusers.edit', compact('user', 'perfiles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //public function update(UserUpdateRequest $request, $id)
    public function update(Request $request, $id)
    {
        
        if ($request->input('name') == ''  || $request->input('username') == '') 
        {
            //Alert::error('Faltas datos para dar de alta el Usuario');
            return back()->with('danger', 'Complete todos los datos del usuario')->withInput();
        }


        if (User::where('username', $request->input('username'))->where('id', '!=', $id)->first()) 
        {
            return back()->with('danger', 'Este username ya esta en uso')->withInput();
        }

        /*if (User::where('email', $request->input('email'))->where('id', '!=',  $id)->first()) 
        {
            return back()->with('danger', 'Este email ya esta en uso')->withInput();
        }*/


        $user = User::find($id);

        /*$existe = Tarea::where('usuario_alta', $user->username)->count();

        if($existe > 0) 
        {
            Alert::error('No se puede modificar el nombre de usuario de este registro')->persistent("Cerrar");
            return back();
        }*/

        $user->fill($request->all())->save();
        
       if($request->get('resetpass') == "on")
        {
            $user->password = bcrypt('123456');
            $user->save();
            Alert::success('La contraseña reseteada es: 123456','Usuario actualizado con exito')->persistent("Cerrar");
        }else {
            Alert::success('Usuario actualizado con exito')->persistent("Cerrar");
        } 

        //return redirect()->route('manageusers.index');
        return redirect()->route('empleados.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        /*$user = User::find($id);

        $existe = Tarea::where('usuario_alta', $user->username)->count();

        if($existe > 0) 
        {
            Alert::error('No se puede eliminar el registro')->persistent("Cerrar");
            return back();
        }*/


        User::find($id)->delete();

        Alert::success('Eliminado correctamente')->persistent("Cerrar");;
        return back();
    }


    public function showSetting($id)
    {

        $user = User::find($id);

        $image  = Animate::image(); 

        //return $user;
        return view('admin.manageusers.setting', compact('user', 'image'));
    }


    public function setting(Request $request, $id)
    {

        if ($request->input('password') !== $request->input('password2')){
            return back()->with('danger', 'Las contraseñas deben coincidir')->withInput();
        }

        

        if($request->file('image')){

            $input  = array('image' => $request->file('image'));

            $rules = array('image' => 'mimes:jpg,jpeg,png');

            $validator = Validator::make($input,  $rules);

            if ($validator->fails())
            {
                return back()->with('danger', 'La imagen no posee un formato valido')->withInput();
            }
        } 


        // contraseña
        $user = User::find($id);

        if ($request->input('password2')){
            $user->fill(['password' => bcrypt($request->input('password2'))])->save();
        }  

         //IMAGE 
        if($request->file('image')){
            $path = Storage::disk('public')->put('image',  $request->file('image'));
            //$user->fill(['file' => asset($path)])->save();
            $user->fill(['file' =>  $path])->save();
        }

        $image  = Animate::image(); 

        Alert::success('Usuario actualizado con exito')->persistent("Cerrar");;
        return view('admin.manageusers.setting', compact('user', 'image'));

    }
}
