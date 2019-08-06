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

   

    public function scopeType($query, $type, $barrios,$calle, $numero) 
    {
        
        if ($type == 'barrio')
        {
            $query->where('barrio_id', '=', $barrios );

            /*$query->with('cliente')->with(['cliente' => function($query2) {
                $query2->orderBy('apellido');
            }])->where('barrio_id', '=', $barrios );*/
        }else if ($type == 'callenumero') 
        {
            $query->where('calle_id',  $calle)->where('numero', 'like', '%' . $numero . '%'); 

        } else
        {
            $query;
        }

    }
}
