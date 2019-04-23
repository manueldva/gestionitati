<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'tipocliente_id', 'cliente', 'apellido', 'nombre', 'referente', 'tipodocumento_id', 'numerodocumento', 'tipoiva_id','telefonoparticular','celular', 'direcciones','companiatelefonica_id','email', 'estado','motivoestado','usuario_alta','fecha_alta','usuario_modi','fecha_modi', 'sucursal_id',
	];



    public function companiatelefonica(){
        
        return $this->belongsTo(Companiatelefonica::class);
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


    public function clientefamiliar(){
        return $this->HasMany(Clientefamiliar::class);
    }

    public function clientedireccion(){
        return $this->HasMany(Clientedireccion::class);
    }

     public function contratos(){
        return $this->HasMany(Contrato::class);
    }


    public function sucursal(){
        
        return $this->belongsTo(Sucursal::class);
    }

    
    

	public function scopeType($query, $type, $valor, $valor2, $barrios, $tipoclientes, $estados) 
    {
		
		if ($type == 'nrodocumento')
        {
            $query->where('numerodocumento', 'like', '%' . $valor . '%')->orderBy('apellido');
        }else if ($type == 'apellido') 
        {
            $query->where('apellido', 'like', '%' . $valor . '%')->orderBy('apellido');

        }else if ($type == 'nombre') 
        {
            $query->where('nombre', 'like', '%' . $valor . '%')->orderBy('apellido');

        }else if ($type == 'codigo') 
        {
            $query->where('id', '=',  $valor)->orderBy('apellido'); 

        }else if ($type == 'apellidonombre') 
        {
            $query->where('apellido', 'like', '%' . $valor . '%')->where('nombre', 'like', '%' . $valor2 . '%')->orderBy('apellido');

        }
        else if ($type == 'barrio') 
        {
            $query->orderBy('apellido'); //cambiar mas adelante
        }
        else if ($type == 'tipocliente') 
        {
            //$query->where('id', $valor)->orderBy('id', 'ASC');
            $query->where('tipocliente_id', '=', $tipoclientes)->orderBy('apellido');
            //$query->client()->where('name', 'like', '%' . $valor . '%')->orderBy('id', 'ASC');

        }
        else if ($type == 'estado') 
        {
            //$query->where('id', $valor)->orderBy('id', 'ASC');
            $query->where('estado', '=', $estados)->orderBy('apellido');
            //$query->client()->where('name', 'like', '%' . $valor . '%')->orderBy('id', 'ASC');
        
        } else
        {
            $query->orderBy('apellido');
        }
    }
}
