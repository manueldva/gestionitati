<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estadocivil extends Model
{
    
    //public $timestamps = false;
    protected $table = 'estadociviles';


    protected $fillable = [
        'descripcion', 'usuario_alta', 'fecha_alta', 'usuario_modi', 'fecha_modi'
    ];


    public function empleados(){
    	return $this->HasMany(Empleado::class);
    }


}
