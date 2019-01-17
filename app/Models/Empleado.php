<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    //protected $table = 'barrios';

	protected $fillable = [
    	'tipoempleado_id', 'empleado', 'movil_id', 'usuario_alta', 'fecha_alta', 'usuario_modi', 'fecha_modi'
	];


	public function clientes(){//vendedor
    	return $this->HasMany(Cliente::class);
    }


    public function movil(){
        
        return $this->belongsTo(Movil::class);
    }



    /*
	public function scopeType($query, $type, $valor) 
    {
		
		if($type == 'perfil')
		{
			$query->where('perfil', 'like', '%' . $valor . '%')->orderBy('perfil', 'ASC');

		} elseif ($type == 'descripcion')
        {
            $query->where('descripcion', 'like', '%' . $valor . '%')->orderBy('perfil', 'ASC');
        } else
        {
            $query->orderBy('perfil', 'ASC');
        }
    }*/
}
