<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hojarutacobranza extends Model
{
    protected $table = 'hojarutacobranzas';


    protected $fillable = [
        'hojaruta_id', 'monto' ,'fechacobranza', 'usuario_alta', 'fecha_alta', 'usuario_modi', 'fecha_modi'
    ];


    public function hojaruta(){
        
        return $this->belongsTo(Hojaruta::class);
    }

}
