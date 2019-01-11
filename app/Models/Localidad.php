<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Localidad extends Model
{
    protected $table = 'localidades';

	protected $fillable = [
    	'departamento_id','descripcion', 'usuario_alta', 'fecha_alta', 'usuario_modi', 'fecha_modi'
	];


	public function clientes(){
    	return $this->HasMany(Cliente::class);
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
