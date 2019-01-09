<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'tipocliente_id', 'cliente', 'referente', 'nrodocumento', 'direccion', 'celular', 'empresacelular_id', 'email', 
        'nrosocio', 'fechaingreso', 'estadocliente_id', 'motivo', 'file', 'celularemergencia', 'telefonoemergencia'
	];



    /*public function estadocliente(){
		
		return $this->belongsTo(Estadocliente::class);
    }


    public function empresacelular(){
		
		return $this->belongsTo(Empresacelular::class);
    }*/
    
    

	public function scopeType($query, $type, $valor) 
    {
		
		if ($type == 'nrodocumento')
        {
            $query->where('nrodocumento', 'like', '%' . $valor . '%')->orderBy('cliente', 'DESC');
        } else if ($type == 'cliente') 
        {
			//$query->where('id', $valor)->orderBy('id', 'ASC');
    		$query->where('cliente', 'like', '%' . $valor . '%')->orderBy('cliente', 'DESC');
			//$query->client()->where('name', 'like', '%' . $valor . '%')->orderBy('id', 'ASC');

        } else
        {
            $query;
        }
    }
}
