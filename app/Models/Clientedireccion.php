<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clientedireccion extends Model
{
    
    protected $table = 'clientedirecciones';

    protected $fillable = [
        'cliente_id', 'provincia_id','departamento_id', 'localidad_id','barrio_id', 'calle_id', 'manzana', 'casa', 'numero','edificiotorre','piso','seccion','lote','codigopostal','referenciadomicilio','observaciondomicilio','empleado_id', 'horariovisita', 'horadesde','horahasta','usuario_alta','fecha_alta','usuario_modi','fecha_modi',
	];



    public function cliente(){
        
        return $this->belongsTo(Cliente::class);
    }

    public function empleado(){
        
        return $this->belongsTo(Empleado::class);
    }


    public function calle(){
        
        return $this->belongsTo(Calle::class);
    }

    public function barrio(){
        
        return $this->belongsTo(Barrio::class);
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
    



    
    
/*
	public function scopeType($query, $type, $valor, $valor2, $barrios, $tipoclientes) 
    {
		
		if ($type == 'nrodocumento')
        {
            $query->where('numerodocumento', 'like', '%' . $valor . '%')->orderBy('apellido', 'DESC');
        }else if ($type == 'apellido') 
        {
            $query->where('apellido', 'like', '%' . $valor . '%')->orderBy('apellido');

        }else if ($type == 'nombre') 
        {
            $query->where('nombre', 'like', '%' . $valor . '%')->orderBy('apellido');

        }else if ($type == 'apellidonombre') 
        {
            $query->where('apellido', 'like', '%' . $valor . '%')->where('nombre', 'like', '%' . $valor2 . '%')->orderBy('apellido');

        }
        else if ($type == 'barrio') 
        {
            //$query->where('id', $valor)->orderBy('id', 'ASC');
            $query->where('barrio_id', '=', $barrios)->orderBy('apellido', 'DESC');
            //$query->client()->where('name', 'like', '%' . $valor . '%')->orderBy('id', 'ASC');
        }
        else if ($type == 'tipocliente') 
        {
            //$query->where('id', $valor)->orderBy('id', 'ASC');
            $query->where('tipocliente_id', '=', $tipoclientes)->orderBy('apellido', 'DESC');
            //$query->client()->where('name', 'like', '%' . $valor . '%')->orderBy('id', 'ASC');


        } else
        {
            $query;
        }
    }*/
}
