<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cuentacorriente extends Model
{
    	//protected $table = 'clientefamiliares';

        protected $fillable = [
            'cliente_id', 'monto','usuario_alta', 'fecha_alta', 'usuario_modi', 'fecha_modi'
        ]; 
    
        public function cliente(){
            return $this->belongsTo(Cliente::class);
            //->orderBy('title');
        }

   
    public function cuentadorrientedetalles(){ //vendedor
        return $this->HasMany(Cuentacorrientedetalle::class);
    }
    
}
