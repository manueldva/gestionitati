<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rubro extends Model
{
    public $timestamps = false;
    //protected $table = 'colores';


    protected $fillable = [
        'descripcion', 'usuario_alta', 'fecha_alta', 'usuario_modi', 'fecha_modi'
    ];


    /*public function articulos(){
    	return $this->HasMany(Articulo::class);
    }*/

    

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
