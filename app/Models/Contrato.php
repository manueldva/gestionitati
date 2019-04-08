<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
     //protected $table = 'localidades';

	protected $fillable = [
    	'modelocontrato_id','cliente_id', 'clientedireccion_id', 'fechacontrato', 'estado' ,'usuario_alta', 'fecha_alta', 'usuario_modi', 'fecha_modi'
	];


   
    public function modelocontrato(){
        
        return $this->belongsTo(Modelocontrato::class);
    }


    
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
