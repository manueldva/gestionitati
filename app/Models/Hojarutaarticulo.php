<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hojarutaarticulo extends Model
{
    protected $table = 'hojarutaarticulos';


    protected $fillable = [
        'articulo_id', 'fecha', 'estado' , 'usuario_alta', 'fecha_alta', 'usuario_modi', 'fecha_modi'
    ];



    public function hojarutaarticulodetalles(){ //vendedor
        return $this->HasMany(Hojarutadetalle::class);
    }

    public function articulo(){
        
        return $this->belongsTo(Articulo::class);
    }



    public function scopeType($query, $type, $valor) 
    {
        
        if ($type == 'fecha') 
        {
            $query->where('fecha', '=',  $valor)->orderBy('id', 'DESC');
          
        } else
        {
              $query->orderBy('id', 'DESC');
          
        }
    }


}
