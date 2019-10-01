<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stockarticulo extends Model
{
    //protected $table = 'perfiles';

	protected $fillable = [
    	'descripcion','stockactual',  'stockminimo', 'stockmaximo' , 'tiemporeposicion', 'tipotiempo_id','sucursal_id' , 'usuario_alta', 'fecha_alta', 'usuario_modi', 'fecha_modi'
	];



    public function sucursal(){
        
        return $this->belongsTo(Sucursal::class);
    }


    public function tipotiempo(){
        
        return $this->belongsTo(Tipotiempo::class);
    }




    public function stockdetalles(){
        return $this->HasMany(Stockdetalle::class);
    }



    public function stockasignaciondetalles(){
        return $this->HasMany(Stockasignaciondetalle::class);
    }



    public function stockventas(){
        return $this->HasMany(Stockventa::class);
    }


}
