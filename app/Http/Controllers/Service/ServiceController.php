<?php

namespace App\Http\Controllers\Service;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Perfil;
use App\Models\Modulo;



class ServiceController extends Controller
{
 	
	public function __construct()
    {
        $this->middleware('auth');
	}
	
	
 	public function habilitarmodulos($user)
    {
    	$resultado = [];
		$temp = User::find($user);
		if($temp->perfil_id) {
			$perfilmodulo = Perfil::find($temp->perfil_id)->modulos()->get();
			
			//dd($perfilmodulo);

			foreach ($perfilmodulo as $value) {
				$resultado[] = ['descripcion' => $value->descripcion, 'permiso' => $value->pivot->permiso]; 
			}
		} else {
			
			$resultado = [0]; 
			
		}

       	//dd($resultado);

       return $resultado; 
    }
}
