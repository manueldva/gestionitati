<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    
    protected $table = 'sucursales';


    protected $fillable = [
        'descripcion', 'usuario_alta', 'fecha_alta', 'usuario_modi', 'fecha_modi'
    ];




	public function empleados(){
    	return $this->HasMany(Empleado::class);
    }


    public function stockarticulos(){
        return $this->HasMany(Stockarticulo::class);
    }


    public function clientes(){
        return $this->HasMany(Cliente::class);
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
