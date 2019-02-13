<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calle extends Model
{
    
    //protected $table = 'barrios';

	protected $fillable = [
    	'provincia_id', 'localidad_id', 'departamento_id', 'descripcion', 'usuario_alta', 'fecha_alta', 'usuario_modi', 'fecha_modi'
	];


	public function clientedirecciones(){
    	return $this->HasMany(Clientedireccion::class);
    }


    
    public function provincia(){
        
        return $this->belongsTo(Provincia::class);
    }

    public function departamento(){
        
        return $this->belongsTo(Departamento::class);
    }

    public function localidad(){
        
        return $this->belongsTo(Localidad::class);
    }


    
	public function scopeType($query, $type, $valor) 
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
    }
}
