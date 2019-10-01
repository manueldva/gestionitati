<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stockasignacion extends Model
{
    protected $table = 'stockasignaciones';

	protected $fillable = [
    	'empleado_id', 'fecha', 'estado' , 'observacion', 'usuario_alta', 'fecha_alta', 'usuario_modi', 'fecha_modi'
	];


	public function empleado(){
        
        return $this->belongsTo(Empleado::class);
    }


    public function stockasignaciondetalles(){
        return $this->HasMany(Stockasignaciondetalle::class);
    }


}
