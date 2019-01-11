<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'tipocliente_id', 'cliente', 'referente', 'nrodocumento', 'direccion', 'celular', 'empresacelular_id', 'email', 
        'nrosocio', 'fechaingreso', 'estadocliente_id', 'motivo', 'file', 'celularemergencia', 'telefonoemergencia'
	];



    public function barrio(){
        
        return $this->belongsTo(Barrio::class);
    }

    public function calle(){
        
        return $this->belongsTo(Calle::class);
    }

        public function companiatelefonica(){
        
        return $this->belongsTo(Companiatelefonica::class);
    }

        public function departamento(){
        
        return $this->belongsTo(Departamento::class);
    }

        public function empleado(){
        
        return $this->belongsTo(Empleado::class);
    }

        public function localidad(){
        
        return $this->belongsTo(Localidad::class);
    }

        public function movil(){
        
        return $this->belongsTo(Movil::class);
    }

        public function provincia(){
        
        return $this->belongsTo(Provincia::class);
    }

        public function tipocliente(){
        
        return $this->belongsTo(Tipocliente::class);
    }

        public function tipodocumento(){
        
        return $this->belongsTo(Tipodocumento::class);
    }

        public function tipoiva(){
        
        return $this->belongsTo(Tipoiva::class);
    }


    
    

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
