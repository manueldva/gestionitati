<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hojarutadetalle extends Model
{
    
    protected $table = 'hojarutadetalles';


    protected $fillable = [
        'hojaruta_id','cliente_id', 'clientedireccion_id', 'contrato_id', 'articulo_id' , 'cantidad', 'fecha', 'estado' , 'usuario_alta', 'fecha_alta', 'usuario_modi', 'fecha_modi', 'cantidadfinal', 'precio', 'tipopago'
    ];




    public function hojaruta(){
        
        return $this->belongsTo(Hojaruta::class);
    }


    public function cliente(){
        
        return $this->belongsTo(Cliente::class);
    }

    public function clientedireccion(){
        
        return $this->belongsTo(Clientedireccion::class);
    }

    public function contrato(){
        
        return $this->belongsTo(Contrato::class);
    }

    public function articulo(){
        
        return $this->belongsTo(Articulo::class);
    }


}
