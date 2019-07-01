<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Empleado extends Model
{
    //protected $table = 'barrios';

	protected $fillable = [
    	'tipoempleado_id', 'sucursal_id',  'empleado', 'apellido', 'nombre' , 'movil', 'patente',  'usuario_alta', 'fecha_alta', 'usuario_modi', 'fecha_modi', 'tipodocumento_id', 'numerodocumento','fechanacimiento','fechaingreso','fechaegreso', 'estadocivil_id','sexo','telefonoparticular','celular','companiatelefonica_id','email','localidad_id', 'direccion'];



    public function clientedirecciones(){ //vendedor
        return $this->HasMany(Clientedireccion::class);
    }



    public function tipoempleado(){
        
        return $this->belongsTo(Tipoempleado::class);
    }



    public function user(){
        return $this->hasOne(User::class , 'empleado_id');
    }



    public function sucursal(){
        
        return $this->belongsTo(Sucursal::class);
    }


    public function estadocivil(){
        
        return $this->belongsTo(Estadocivil::class);
    }

    public function tipodocumento(){
        
        return $this->belongsTo(Tipodocumento::class);
    }

    public function companiatelefonica(){
        
        return $this->belongsTo(Companiatelefonica::class);
    }

    public function localidad(){
        
        return $this->belongsTo(Localidad::class);
    }



    public function hojarutas(){ //vendedor
        return $this->HasMany(Hojaruta::class);
    }

    public function stockasiganciones(){ //vendedor
        return $this->HasMany(Stockasignacion::class);
    }



    
	 public function scopeType($query, $type, $valor, $valor2) 
    {
        
        if ($type == 'codigo') 
        {
            $query->where('id', '=',  $valor)->orderBy('empleado');
          
        }else if ($type == 'apellido') 
        {
            $query->where('apellido', 'like', '%' . $valor . '%')->orderBy('empleado');

        }else if ($type == 'nombre') 
        {
            $query->where('nombre', 'like', '%' . $valor . '%')->orderBy('empleado');

        }else if ($type == 'apellidonombre') 
        {
            $query->where('apellido', 'like', '%' . $valor . '%')->where('nombre', 'like', '%' . $valor2 . '%')->orderBy('empleado');

        } else
        {
              $query->orderBy('empleado');
          
        }
    }
}
