<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clientearticulo extends Model
{
    
	protected $fillable = [
    	'cliente_id', 'articulo_id', 'cantidad' ,'usuario_alta', 'fecha_alta', 'usuario_modi', 'fecha_modi'
	];

    public function cliente(){
        
        return $this->belongsTo(Cliente::class);
    }

    public function articulo(){
        
        return $this->belongsTo(Articulo::class);
    }

}
