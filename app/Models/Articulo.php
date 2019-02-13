<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    //protected $table = 'barrios';

	protected $fillable = [
    	'descripcion', 'stock' ,'usuario_alta', 'fecha_alta', 'usuario_modi', 'fecha_modi'
	];

    /*public function clientearticulo(){
        
        return $this->belongsTo(Clientearticulo::class);
    }*/


    public function scopeType($query, $type, $valor) 
    {
		
		if($type == 'codigo')
		{
			$query->where('id', '=', $valor)->orderBy('descripcion', 'ASC');

		} elseif ($type == 'descripcion')
        {
            $query->where('descripcion', 'like', '%' . $valor . '%')->orderBy('descripcion', 'ASC');
        } else
        {
            $query->orderBy('descripcion', 'ASC');
        }
    }
    

}
