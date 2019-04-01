<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tipoenvase extends Model
{
    
    protected $table = 'tipoenvases';


    protected $fillable = [
        'descripcion', 'usuario_alta', 'fecha_alta', 'usuario_modi', 'fecha_modi'
    ];


}
