<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Companiatelefonica extends Model
{
    //protected $table = 'barrios';

	protected $fillable = [
    	'descripcion', 'usuario_alta', 'fecha_alta', 'usuario_modi', 'fecha_modi'
	];


	public function clientes(){
    	return $this->HasMany(Cliente::class);
    }

    public function scopeType($query, $type, $valor) 
    {
        
      if ($type == 'codigo') 
      {
        $query->where('id', '=',  $valor)->orderBy('descripcion');
      
      }else if ($type == 'descripcion') 
      {
        $query->where('descripcion', 'like', '%' . $valor . '%')->orderBy('descripcion');

      } else
      {
          $query->orderBy('descripcion');
      
      }
    }
}
