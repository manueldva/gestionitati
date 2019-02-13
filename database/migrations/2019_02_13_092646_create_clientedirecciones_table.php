<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientedireccionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientedirecciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cliente_id')->unsigned()->nullable();
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->integer('provincia_id')->unsigned()->nullable();
            $table->foreign('provincia_id')->references('id')->on('provincias');
            $table->integer('departamento_id')->unsigned()->nullable();
            $table->foreign('departamento_id')->references('id')->on('departamentos');
            $table->integer('localidad_id')->unsigned()->nullable();
            $table->foreign('localidad_id')->references('id')->on('localidades');
            $table->integer('barrio_id')->unsigned()->nullable();
            $table->foreign('barrio_id')->references('id')->on('barrios');
            $table->integer('calle_id')->unsigned()->nullable();
            $table->foreign('calle_id')->references('id')->on('calles');
            $table->string('manzana', 10)->nullable();
            $table->string('casa', 10)->nullable();
            $table->string('numero', 10)->nullable();
            $table->string('edificiotorre', 10)->nullable();
            $table->string('piso', 10)->nullable();
            $table->string('seccion', 10)->nullable();
            $table->string('lote', 10)->nullable();
            $table->string('codigopostal', 10)->nullable();
            $table->string('referenciadomicilio',500)->nullable();
            $table->string('observaciondomicilio',500)->nullable();
            $table->integer('empleado_id')->unsigned()->nullable();
            $table->foreign('empleado_id')->references('id')->on('empleados');
            $table->integer('horariovisita')->nullable();
            $table->string('horadesde',5)->default('00:00')->nullable();
            $table->string('horahasta',5)->default('00:00')->nullable();
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
        Schema::dropIfExists('clientedirecciones');
    }
}
