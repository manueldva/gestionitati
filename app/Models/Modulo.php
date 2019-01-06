<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    protected $table = 'modulos';
 
    protected $fillable = [
        'descripcion','link', 'valor'
    ];



    public function perfiles()
    {
        return $this->belongsToMany(Perfil::class)->withPivot('perfil_id');
    }



    public function scopeType($query, $type, $valor) 
    {
		
		if ($type == 'link')
        {
            $query->where('link', 'like', '%' . $valor . '%')->orderBy('descripcion', 'ASC');
        } else if ($type == 'descripcion') 
        {
			$query->where('descripcion', 'like', '%' . $valor . '%')->orderBy('descripcion', 'ASC');

        } else
        {
            $query->orderBy('descripcion', 'ASC');
        }
    }
}
