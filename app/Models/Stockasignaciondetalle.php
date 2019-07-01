<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stockasignaciondetalle extends Model
{
    protected $table = 'stockasignaciondetalles';

	protected $fillable = [
    	'stockasignacion_id','stockarticulo_id', 'cantidad', 'devuelve' ,'fecha', 'estado' , 'usuario_alta', 'fecha_alta', 'usuario_modi', 'fecha_modi'
	];


	public function stockasignacion(){
        
        return $this->belongsTo(Stockasignacion::class);
    }

    public function stockarticulo(){
        
        return $this->belongsTo(Stockarticulo::class);
    }


}
