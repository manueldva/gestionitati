<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stockventa extends Model
{
    
    protected $fillable = [
    	'stockactual', 'stockarticulo_id' , 'usuario_alta', 'fecha_alta', 'usuario_modi', 'fecha_modi'
	];



	public function stockarticulo(){
        
        return $this->belongsTo(Stockarticulo::class);
    }


    
    public function stockasignaciondetalles(){
        return $this->HasMany(Stockasignaciondetalle::class);
    }

}
