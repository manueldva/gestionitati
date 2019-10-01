<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hojarutaarticuloextra extends Model
{
     protected $table = 'hojarutaarticulosextras';


    protected $fillable = [
        'hojaruta_id','articulo_id', 'cantidad' ,'fecha' ,'estado' , 'usuario_alta', 'fecha_alta', 'usuario_modi', 'fecha_modi'
    ];


    public function hojaruta(){
        
        return $this->belongsTo(Hojaruta::class);
    }


     public function articulo(){
        
        return $this->belongsTo(Articulo::class);
    }

}
