<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProveedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 200);
            $table->string('nombrecontacto',200)->nullable();
            $table->string('domicilio',400)->nullable();
            $table->string('telefono',25)->nullable();
            $table->string('celular',25)->nullable();
            $table->string('email',200)->nullable();
            $table->string('observaciones', 1000)->nullable();
            $table->enum('estado',['Activo', 'Inactivo'])->default('Activo');
            $table->string('usuario_alta',50)->nullable();
            $table->timestamp('fecha_alta')->nullable();
            $table->string('usuario_modi',50)->nullable();
            $table->timestamp('fecha_modi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proveedores');
    }
}
