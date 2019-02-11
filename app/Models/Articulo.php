<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    //protected $table = 'barrios';

	protected $fillable = [
    	'descripcion', 'stock' ,'usuario_alta', 'fecha_alta', 'usuario_modi', 'fecha_modi'
	];

    public function clientearticulo(){
        
        return $this->belongsTo(Clientearticulo::class);
    }

}
