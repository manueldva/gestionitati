<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    protected $table = 'perfiles';

	protected $fillable = [
    	'perfil', 'descripcion', 'usuario_alta', 'fecha_alta', 'usuario_modi', 'fecha_modi'
	];


	public function users(){
    	return $this->HasMany(User::class);
    }


    public function modulos()
    {
        return $this->belongsToMany(Modulo::class)->withPivot('permiso');
	}
	

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
    }
}
