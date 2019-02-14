<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
     //protected $table = 'localidades';

	protected $fillable = [
    	'modelocontrato_id','cliente_id', 'clientedireccion_id', 'fechacontrato', 'usuario_alta', 'fecha_alta', 'usuario_modi', 'fecha_modi'
	];


    /*public function clientedirecciones(){
        return $this->HasMany(Clientedireccion::class);
    }

    public function localidades(){
    	return $this->HasMany(Localidad::class);
    }

    public function barrios(){
    	return $this->HasMany(Localidad::class);
    }

    public function calles(){
    	return $this->HasMany(Localidad::class);
    }

    public function provincia(){
        
        return $this->belongsTo(Provincia::class);
    }*/


    
	/*public function scopeType($query, $type, $valor) 
    {
		
		if($type == 'descripcion')
		{
			$query->where('descripcion', 'like', '%' . $valor . '%')->orderBy('descripcion', 'ASC');

		} elseif ($type == 'codigo')
        {
            $query->where('id', '=',  $valor)->orderBy('descripcion', 'ASC');
        } else
        {
            $query->orderBy('descripcion', 'ASC');
        }
    }*/
}
