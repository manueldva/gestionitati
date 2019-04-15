<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    //protected $table = 'barrios';

	protected $fillable = [
    	'descripcion', 'tipoarticulo_id' ,'tipoenvase_id', 'abreviatura', 'caracteristicas', 'precioventa', 'precioreparto' , 'precioplan', 'costo', 'costovendedor', 'clasificacion', 'costorepartidor' ,'condicioniva' , 'stock' ,'usuario_alta', 'file', 'fecha_alta', 'usuario_modi', 'fecha_modi'
	];

    public function contratoarticulos(){
        return $this->HasMany(Contratoarticulo::class);
    }

    public function tipoarticulo(){
        
        return $this->belongsTo(Tipoarticulo::class);
    }



    public function scopeType($query, $type, $valor, $tipoarticulo) 
    {
		
		if($type == 'codigo')
		{
			$query->where('id', '=', $valor)->orderBy('descripcion', 'ASC');

		} elseif ($type == 'descripcion')
        {
            $query->where('descripcion', 'like', '%' . $valor . '%')->orderBy('descripcion', 'ASC');

        } elseif ($type == 'tipoarticulo')
        {
            $query->where('tipoarticulo_id', '=', $tipoarticulo)->orderBy('descripcion', 'ASC');

        } else
        {
            $query->orderBy('descripcion', 'ASC');
        }
    }
    

}
