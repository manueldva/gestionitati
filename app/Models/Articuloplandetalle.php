<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Articuloplandetalle extends Model
{
    protected $table = 'articuloplandetalles';

	protected $fillable = [
    	'plan_id','planarticulo_id', 'cantidad', 'usuario_alta', 'fecha_alta', 'usuario_modi', 'fecha_modi'
	];

}
