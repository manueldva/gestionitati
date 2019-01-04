<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    public $timestamps = false;
    //protected $table = 'articulos';


    protected $fillable = [
        'codigo','descripcion','rubro_id','proveedor_id','stock','stockminimo' , 'stockmaximo', 'preciounitario','estado', 'observaciones','usuario_alta', 'fecha_alta', 'usuario_modi', 'fecha_modi'
    ];


    public function rubro(){
  		
        return $this->belongsTo(Rubro::class);
    }

    public function proveedor(){
        
        return $this->belongsTo(Proveedor::class);
    }
    
    public function ventadetalles(){

    	return $this->HasMany(Ventadetalle::class);
    }
      
    

    public function scopeType($query, $type, $valor) 
    {
		
      if ($type == 'codigo') 
      {
        $query->where('codigo', 'like', '%' . $valor . '%')->orderBy('descripcion');
      
      }else if ($type == 'descripcion') 
      {
        $query->where('descripcion', 'like', '%' . $valor . '%')->orderBy('descripcion');

      } else
      {
          $query->orderBy('descripcion');
      
      }
    }
}
