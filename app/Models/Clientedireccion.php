<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clientedireccion extends Model
{
    
    protected $table = 'clientedirecciones';

    protected $fillable = [
        'cliente_id', 'provincia_id','departamento_id', 'localidad_id','barrio_id', 'calle_id', 'manzana', 'casa', 'numero','edificiotorre','piso','seccion','lote','codigopostal','referenciadomicilio','observaciondomicilio','empleado_id', 'horariovisita', 'horadesde','horahasta','usuario_alta','fecha_alta','usuario_modi','fecha_modi','longitud','latitud','ubicacion'
	];



    public function cliente(){
        
        return $this->belongsTo(Cliente::class);
        //->orderBy('title');
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

    public function hojarutadetalles(){ //vendedor
        return $this->HasMany(Hojarutadetalle::class);
    }

   

    public function scopeType($query, $type, $barrios,$calle, $numero, $numero2) 
    {
        //dd($numero);
        if ($type == 'barrio')
        {
            $query->where('barrio_id', '=', $barrios );

            /*$query->with('cliente')->with(['cliente' => function($query2) {
                $query2->orderBy('apellido');
            }])->where('barrio_id', '=', $barrios );*/
        }else if ($type == 'callenumero') 
        {
            if ($numero == null) {
                $query->where('calle_id',  $calle);//->where('numero', 'like', '%' . $numero . '%'); 
            } else {
                $query->where('calle_id',  $calle)->where('numero', 'like', '%' . $numero . '%'); 
            }
        }else if ($type == 'mzcasa') 
        {
            if($barrios == null) {
             
                if ($numero2 == null && $numero !== null) {
                    $query->where('manzana', 'like', '%' . $numero . '%'); 
                } else if ($numero == null && $numero2 !== null) {
                    $query->where('casa', 'like', '%' . $numero2 . '%'); 
                } else if ($numero == null && $numero2 == null) {
                    $query; 
                 } else {
                    $query->where('manzana', 'like', '%' . $numero . '%')->where('casa', 'like', '%' . $numero2 . '%'); 
                }
            } else {


                if ($numero2 == null && $numero !== null) {
                    $query->where('manzana', 'like', '%' . $numero . '%')->where('barrio_id', $barrios ); 
                } else if ($numero == null && $numero2 !== null) {
                    $query->where('casa', 'like', '%' . $numero2 . '%')->where('barrio_id', $barrios ); 
                } else if ($numero == null && $numero2 == null) {
                    $query->where('barrio_id', $barrios ); 
                 } else {
                    $query->where('manzana', 'like', '%' . $numero . '%')->where('casa', 'like', '%' . $numero2 . '%')->where('barrio_id', $barrios ); 
                }
                 //$query->where('manzana', 'like', '%' . $numero . '%')->where('casa', 'like', '%' . $numero2 . '%')->where('barrio_id', $barrios ); 
            }
            //$query->where('manzana', 'like', '%' . $numero . '%')->where('casa', 'like', '%' . $numero2 . '%')->where('barrio_id', $barrios ); 

        } else
        {
            $query;
        }

    }
}
