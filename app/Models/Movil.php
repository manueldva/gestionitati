<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movil extends Model
{
    //protected $table = 'barrios';

	protected $fillable = [
    	'descripcion', 'patente', 'usuario_alta', 'fecha_alta', 'usuario_modi', 'fecha_modi'
	];


    public function empleados(){
        return $this->HasMany(Empleado::class);
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
