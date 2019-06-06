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


}
