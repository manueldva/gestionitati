<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tipotiempo extends Model
{
    
    //protected $table = 'tipoenvases';


    protected $fillable = [
        'descripcion', 'usuario_alta', 'fecha_alta', 'usuario_modi', 'fecha_modi'
    ];


    
    public function stockarticulos(){
        return $this->HasMany(Stockarticulo::class);
    }


}
