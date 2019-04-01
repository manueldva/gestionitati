<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tipoprecio extends Model
{
    
    protected $table = 'tipoprecios';


    protected $fillable = [
        'descripcion', 'usuario_alta', 'fecha_alta', 'usuario_modi', 'fecha_modi'
    ];
}
