<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    public $timestamps = false;
    //protected $table = 'articulos';

    protected $fillable = [
        'fechaventa','importetotal','observaciones','usuario_alta', 'fecha_alta', 'usuario_modi', 'fecha_modi'
    ];

    public function ventadetalles(){
  
      return $this->HasMany(Ventadetalle::class);
    }


    public function scopeType($query, $type, $valor) 
    {
		
      if ($type == 'codigo') 
      {
        $query->where('id', '=',  $valor)->orderBy('fechaventa');
      
      }else if ($type == 'fecha') 
      {
        $query->where('fechaventa', '=',  $valor)->orderBy('fechaventa');

      } else
      {
          $query->orderBy('fechaventa');
      
      }
    }

}
