<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stockajuste extends Model
{
   	
   	protected $fillable = [
    	'stockarticulo_id','cantidad',  'tipoajuste_id', 'motivoajuste_id' , 'proveedorajuste_id', 'lote','fechavencimiento', 'observacion' , 'usuario_alta', 'fecha_alta', 'usuario_modi', 'fecha_modi'
	];



    public function stockarticulo(){
        
        return $this->belongsTo(Stockarticulo::class);
    }


    public function tipoajuste(){
        
        return $this->belongsTo(Tipoajuste::class);
    }


    public function motivoajuste(){
        
        return $this->belongsTo(Motivoajuste::class);
    }


    public function proveedorajuste(){
        
        return $this->belongsTo(Proveedorajuste::class);
    }
}
