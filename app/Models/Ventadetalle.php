<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ventadetalle extends Model
{
    
    //protected $table = 'barrios';


    protected $fillable = [
       'venta_id', 'articulo_id', 'precio','cantidad' , 'usuario_alta', 'fecha_alta', 'usuario_modi', 'fecha_modi'
    ];


	public function venta(){
        
        return $this->belongsTo(Venta::class);
    }


	public function articulo(){
        
        return $this->belongsTo(Articulo::class);
    }
}
