<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    
    //protected $table = 'barrios';

	protected $fillable = [
    	'provincia_id','descripcion', 'usuario_alta', 'fecha_alta', 'usuario_modi', 'fecha_modi'
	];


	public function clientes(){
    	return $this->HasMany(Cliente::class);
    }


    public function localidades(){
        return $this->HasMany(Localidad::class);
    }


    public function provincia(){
        
        return $this->belongsTo(Provincia::class);
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
