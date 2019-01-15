<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calle extends Model
{
    
    //protected $table = 'barrios';

	protected $fillable = [
    	'descripcion', 'usuario_alta', 'fecha_alta', 'usuario_modi', 'fecha_modi'
	];


	public function clientes(){
    	return $this->HasMany(Cliente::class);
    }

    
	public function scopeType($query, $type, $valor) 
    {
		
		if($type == 'descripcion')
		{
			$query->where('descripcion', 'like', '%' . $valor . '%')->orderBy('descripcion', 'ASC');

		} elseif ($type == 'codigo')
        {
            $query->where('codigo', '=',  $valor)->orderBy('descripcion', 'ASC');
        } else
        {
            $query->orderBy('descripcion', 'ASC');
        }
    }
}
