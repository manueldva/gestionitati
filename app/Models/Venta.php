<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    
    //protected $table = 'hojarutas';


    protected $fillable = [
       'cliente_id' ,'fecha', 'usuario' , 'usuario_alta', 'fecha_alta', 'usuario_modi', 'fecha_modi'
    ];


	public function cliente(){
        
        return $this->belongsTo(Cliente::class);
    }

    public function ventadetalles(){ //vendedor
        return $this->HasMany(Ventadetalle::class);
    }


    
    public function scopeType($query, $type, $valor) 
    {
        
        if ($type == 'fecha') 
        {
            $query->where('fecha', '=',  $valor)->orderBy('fecha', 'DESC');
          
        }else if ($type == 'codigo') 
        {
            $query->where('cliente_id', '=', $valor)->orderBy('fecha', 'DESC');

        } else
        {
              $query->orderBy('fecha', 'DESC');
          
        }
    }

}
