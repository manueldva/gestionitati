<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modelocontrato extends Model
{
    //public $timestamps = false;
    //protected $table = 'colores';


    protected $fillable = [
        'descripcion', 'usuario_alta', 'fecha_alta', 'usuario_modi', 'fecha_modi'
    ];



    public function contratos(){
      return $this->HasMany(Contrato::class);
    }

    /*public function localidades(){
      return $this->HasMany(Localidad::class);
    }

    public function departamentos(){
      return $this->HasMany(Departamento::class);
    }

    public function barrios(){
      return $this->HasMany(Barrio::class);
    }

    public function calles(){
      return $this->HasMany(Calle::class);
    }*/

  

    public function scopeType($query, $type, $valor) 
    {
		
      if ($type == 'codigo') 
      {
        $query->where('id', '=',  $valor)->orderBy('descripcion');
      
      }else if ($type == 'descripcion') 
      {
        $query->where('descripcion', 'like', '%' . $valor . '%')->orderBy('descripcion');

      } else
      {
          $query->orderBy('descripcion');
      
      }
    }

}
