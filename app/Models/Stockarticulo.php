<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stockarticulo extends Model
{
    //protected $table = 'perfiles';

	protected $fillable = [
    	'descripcion','stockactual',  'stockminimo', 'stockmaximo' , 'tiemporeposicion', 'tipotiempo_id','sucursal_id' , 'usuario_alta', 'fecha_alta', 'usuario_modi', 'fecha_modi'
	];

}
