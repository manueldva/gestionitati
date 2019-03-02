<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contratoarticulo extends Model
{
   	//protected $table = 'clientefamiliares';

   	protected $fillable = [
    	'contrato_id', 'articulo_id', 'cantidad','usuario_alta', 'fecha_alta', 'usuario_modi', 'fecha_modi'
	]; 


    public function articulo(){
        
        return $this->belongsTo(Articulo::class);
    }

    /*public function cliente(){
        
        return $this->belongsTo(Cliente::class);
    }

    public function tipofamiliar(){
        
        return $this->belongsTo(Tipofamiliar::class);
    }*/


}
