<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cuentacorrientedetalle extends Model
{
        //protected $table = 'clientefamiliares';

        protected $fillable = [
            'cuentacorriente_id', 'monto','fechapago','tipopago','usuario_alta', 'fecha_alta', 'usuario_modi', 'fecha_modi'
        ]; 
    
        public function cuentacorriente(){
            return $this->belongsTo(Cuentacorriente::class);
            //->orderBy('title');
        }
}
