<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedorajuste extends Model
{
        //protected $table = 'barrios';

	protected $fillable = [
    	'descripcion', 'usuario_alta', 'fecha_alta', 'usuario_modi', 'fecha_modi'
	];




    public function stockajustes(){
        return $this->HasMany(Stockajuste::class);
    }

}
