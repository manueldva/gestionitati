<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    public $timestamps = false;
    protected $table = 'proveedores';


    protected $fillable = [
        'estado','observaciones','email','celular','telefono','domicilio','nombrecontacto' , 'nombre', 'usuario_alta', 'fecha_alta', 'usuario_modi', 'fecha_modi'
    ];

    public function articulos(){
      
    	return $this->HasMany(Articulo::class);
    }
    

    public function scopeType($query, $type, $valor) 
    {
		
      if ($type == 'codigo') 
      {
        $query->where('id', '=',  $valor)->orderBy('nombre');
      
      }else if ($type == 'nombre') 
      {
        $query->where('nombre', 'like', '%' . $valor . '%')->orderBy('nombre');

      } else
      {
          $query->orderBy('nombre');
      
      }
    }
}
