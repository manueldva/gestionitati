<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barrios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('provincia_id')->unsigned();
            $table->foreign('provincia_id')->references('id')->on('provincias');
            $table->integer('departamento_id')->unsigned();
            $table->foreign('departamento_id')->references('id')->on('departamentos');
            $table->integer('localidad_id')->unsigned();
            $table->foreign('localidad_id')->references('id')->on('localidades');
            $table->string('descripcion', 350);
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
        Schema::dropIfExists('barrios');
    }
}
