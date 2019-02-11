<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tipocliente_id')->unsigned()->nullable();
            $table->foreign('tipocliente_id')->references('id')->on('tipoclientes');
            $table->string('cliente', 200)->nullable();
            $table->string('apellido', 200)->nullable();
            $table->string('nombre', 200)->nullable();
            $table->string('referente', 150)->nullable();
            $table->integer('tipodocumento_id')->unsigned()->nullable();
            $table->foreign('tipodocumento_id')->references('id')->on('tipodocumentos');
            $table->string('numerodocumento', 20)->nullable();
            $table->dateTime('fechanacimiento')->nullable();
            $table->integer('tipoiva_id')->unsigned()->nullable();
            $table->foreign('tipoiva_id')->references('id')->on('tipoivas');
            $table->string('cuit', 20)->nullable();
            $table->boolean('sincargo')->default(0);
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
            $table->string('telefonoparticular', 20)->nullable();
            $table->string('celular', 20)->nullable();
            $table->integer('companiatelefonica_id')->unsigned()->nullable();
            $table->foreign('companiatelefonica_id')->references('id')->on('companiatelefonicas');
            $table->string('email',128)->nullable();

            $table->integer('empleado_id')->unsigned()->nullable();
            $table->foreign('empleado_id')->references('id')->on('empleados');
            $table->integer('horariovisita')->nullable();
            $table->string('horadesde',5)->default('00:00')->nullable();
            $table->string('horahasta',5)->default('00:00')->nullable();
            $table->boolean('estado')->default(0);
            $table->string('motivoestado', 100)->nullable();
            $table->string('usuario_alta',50)->nullable();
            $table->dateTime('fecha_alta')->nullable();
            $table->string('usuario_modi',50)->nullable();
            $table->dateTime('fecha_modi')->nullable();
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
        Schema::dropIfExists('clientes');
    }
}
