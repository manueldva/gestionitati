<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hojaruta extends Model
{
    
    protected $table = 'hojarutas';


    protected $fillable = [
        'empleado_id','fecha', 'estado' , 'usuario_alta', 'fecha_alta', 'usuario_modi', 'fecha_modi'
    ];


    public function empleado(){
        
        return $this->belongsTo(Empleado::class);
    }



    public function hojarutaarticuloextras(){ //vendedor
        return $this->HasMany(Hojarutaarticuloextra::class);
    }


    public function hojarutadetalles(){ //vendedor
        return $this->HasMany(Hojarutadetalle::class);
    }



    public function scopeType($query, $type, $valor, $empleado) 
    {
        
        if ($type == 'fecha') 
        {
            $query->where('fecha', '=',  $valor)->orderBy('fecha', 'DESC');
          
        }else if ($type == 'empleado') 
        {
            $query->where('empleado_id', '=', $empleado)->orderBy('fecha', 'DESC');

        } else
        {
              $query->orderBy('fecha', 'DESC');
          
        }
    }



}
