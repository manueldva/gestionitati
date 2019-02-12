<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    //protected $table = 'barrios';

	protected $fillable = [
    	'tipoempleado_id', 'empleado', 'apellido', 'nombre' , 'movil', 'patente',  'usuario_alta', 'fecha_alta', 'usuario_modi', 'fecha_modi'
	];


	public function clientes(){//vendedor
    	return $this->HasMany(Cliente::class);
    }


    public function tipoempleado(){
        
        return $this->belongsTo(Tipoempleado::class);
    }



    
	 public function scopeType($query, $type, $valor, $valor2) 
    {
        
        if ($type == 'codigo') 
        {
            $query->where('id', '=',  $valor)->orderBy('empleado');
          
        }else if ($type == 'apellido') 
        {
            $query->where('apellido', 'like', '%' . $valor . '%')->orderBy('empleado');

        }else if ($type == 'nombre') 
        {
            $query->where('nombre', 'like', '%' . $valor . '%')->orderBy('empleado');

        }else if ($type == 'apellidonombre') 
        {
            $query->where('apellido', 'like', '%' . $valor . '%')->where('nombre', 'like', '%' . $valor2 . '%')->orderBy('empleado');

        } else
        {
              $query->orderBy('empleado');
          
        }
    }
}
