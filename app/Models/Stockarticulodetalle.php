<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stockarticulodetalle extends Model
{
    //protected $table = 'perfiles';

	protected $fillable = [
    	'stockarticulo_id', 'articulo_id', 'usuario_alta', 'fecha_alta', 'usuario_modi', 'fecha_modi'
	];


	public function articulo(){
        
        return $this->belongsTo(Articulo::class);
    }


    public function stockarticulo(){
        
        return $this->belongsTo(Stockarticulo::class);
    }


}
