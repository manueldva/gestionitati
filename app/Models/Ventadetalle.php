<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ventadetalle extends Model
{
    

    public $timestamps = false;
    //protected $table = 'articulos';


    protected $fillable = [
        'codigo','descripcion','rubro_id','proveedor_id','stock','stockminimo' , 'stockmaximo', 'estado', 'observaciones','usuario_alta', 'fecha_alta', 'usuario_modi', 'fecha_modi'
    ];



    public function venta(){
  		
        return $this->belongsTo(Venta::class);
    }
}
