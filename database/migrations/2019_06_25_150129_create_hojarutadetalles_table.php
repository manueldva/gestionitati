<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHojarutadetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hojarutadetalles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hojaruta_id')->unsigned()->nullable();
            $table->foreign('hojaruta_id')->references('id')->on('hojarutas');
            $table->integer('cliente_id')->unsigned()->nullable();
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->integer('clientedireccion_id')->unsigned()->nullable();
            $table->foreign('clientedireccion_id')->references('id')->on('clientedirecciones');
            $table->integer('contrato_id')->unsigned()->nullable();
            $table->foreign('contrato_id')->references('id')->on('contratos');
            $table->integer('articulo_id')->unsigned()->nullable();
            $table->foreign('articulo_id')->references('id')->on('articulos');
            $table->integer('cantidad')->nullable()->default(0);
            $table->dateTime('fecha')->nullable();
            $table->integer('estado')->default(0);
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
        Schema::dropIfExists('hojarutadetalles');
    }
}
