<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clientefamiliar extends Model
{
   	protected $table = 'clientefamiliares';

   	protected $fillable = [
    	'cliente_id', 'tipofamiliar_id', 'nombre', 'contacto' ,'usuario_alta', 'fecha_alta', 'usuario_modi', 'fecha_modi'
	]; 


    public function cliente(){
        
        return $this->belongsTo(Cliente::class);
    }

    public function tipofamiliar(){
        
        return $this->belongsTo(Tipofamiliar::class);
    }


}
