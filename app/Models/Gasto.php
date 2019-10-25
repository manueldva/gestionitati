<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gasto extends Model
{
    //protected $table = 'colores';


    protected $fillable = [
        'rubrogasto_id', 'tipocomprobante_id', 'monto' , 'fecha', 'detalle', 'usuario_alta', 'fecha_alta', 'usuario_modi', 'fecha_modi'
    ];


    public function tipocomprobante(){
    
        return $this->belongsTo(Tipocomprobante::class);
    }
    
    public function rubrogasto(){
    
        return $this->belongsTo(Rubrogasto::class);
    }



        
    
	public function scopeType($query, $type, $valor) 
    {
		
		if($type == 'codigo')
		{
			$query->where('id', '=', $valor)->orderBy('detalle');

		} elseif ($type == 'descripcion')
        {
            $query->where('detalle', 'like', '%' . $valor . '%')->orderBy('detalle');
        } elseif ($type == 'fecha')
        {
            $query->where('fecha', '=', $valor)->orderBy('detalle');
        } else
        {
            $query->orderBy('detalle');
        }
    }

}
