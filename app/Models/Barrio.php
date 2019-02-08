<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barrio extends Model
{
    //protected $table = 'barrios';

	protected $fillable = [
    	'provincia_id','localidad_id', 'departamento_id', 'distrito_id', 'descripcion', 'sincalle', 'usuario_alta', 'fecha_alta', 'usuario_modi', 'fecha_modi'
	];


	public function clientes(){
    	return $this->HasMany(Cliente::class);
    }

    
    public function provincia(){
        
        return $this->belongsTo(Provincia::class);
    }

    public function distrito(){
        
        return $this->belongsTo(Distrito::class);
    }


    public function departamento(){
        
        return $this->belongsTo(Departamento::class);
    }

    
    public function localidad(){
        
        return $this->belongsTo(Localidad::class);
    }




    
	public function scopeType($query, $type, $valor) 
    {
		
		if($type == 'codigo')
		{
			$query->where('id', '=', $valor)->orderBy('descripcion', 'ASC');

		} elseif ($type == 'descripcion')
        {
            $query->where('descripcion', 'like', '%' . $valor . '%')->orderBy('descripcion', 'ASC');
        } else
        {
            $query->orderBy('descripcion', 'ASC');
        }
    }
}
