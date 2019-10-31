<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asignarstockagregado extends Model
{
    
    protected $table = 'asignarstockagregados';

	protected $fillable = [
    	'stockasignaciondetalle_id','carga', 'cantidad', 'usuario_alta', 'fecha_alta', 'usuario_modi', 'fecha_modi'
    ];
    


    public function stockasignaciondetalle(){
        
        return $this->belongsTo(Stockasignaciondetalle::class);
    }

}
