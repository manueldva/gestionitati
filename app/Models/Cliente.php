<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'tipocliente_id', 'cliente', 'apellido', 'nombre', 'referente', 'tipodocumento_id', 'numerodocumento', 'fechanacimiento', 'tipoiva_id', 'cuit', 'sincargo', 'provincia_id', 'localidad_id','barrio_id', 'calle_id', 'manzana', 'casa', 'numero','edificiotorre','piso','seccion','lote','codigopostal','referenciadomicilio','observaciondomicilio','telefonoparticular','celular','companiatelefonica_id','email','empleado_id', 'horadesde','horahasta','estado','motivoestado','usuario_alta','fecha_alta','usuario_modi','fecha_modi',
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


    public function empleado(){
        
        return $this->belongsTo(Empleado::class);
    }

    public function localidad(){
        
        return $this->belongsTo(Localidad::class);
    }

    public function provincia(){
        
    return $this->belongsTo(Provincia::class);
    }

    public function departamento(){
        
        return $this->belongsTo(Departamento::class);
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

    public function clientearticulos(){
        return $this->HasMany(Clientearticulo::class);
    }

    public function clientefamiliar(){
        return $this->HasMany(Clientefamiliar::class);
    }


    
    

	public function scopeType($query, $type, $valor, $barrios, $tipoclientes) 
    {
		
		if ($type == 'nrodocumento')
        {
            $query->where('numerodocumento', 'like', '%' . $valor . '%')->orderBy('cliente', 'DESC');
        } else if ($type == 'cliente') 
        {
			//$query->where('id', $valor)->orderBy('id', 'ASC');
    		$query->where('cliente', 'like', '%' . $valor . '%')->orderBy('cliente', 'DESC');
			//$query->client()->where('name', 'like', '%' . $valor . '%')->orderBy('id', 'ASC');
        }
        else if ($type == 'barrio') 
        {
            //$query->where('id', $valor)->orderBy('id', 'ASC');
            $query->where('barrio_id', '=', $barrios)->orderBy('cliente', 'DESC');
            //$query->client()->where('name', 'like', '%' . $valor . '%')->orderBy('id', 'ASC');
        }
        else if ($type == 'tipocliente') 
        {
            //$query->where('id', $valor)->orderBy('id', 'ASC');
            $query->where('tipocliente_id', '=', $tipoclientes)->orderBy('cliente', 'DESC');
            //$query->client()->where('name', 'like', '%' . $valor . '%')->orderBy('id', 'ASC');


        } else
        {
            $query;
        }
    }
}
