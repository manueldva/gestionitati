<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientearticulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientearticulos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cliente_id')->unsigned()->nullable();
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->integer('articulo_id')->unsigned()->nullable();
            $table->foreign('articulo_id')->references('id')->on('articulos');
            $table->integer('cantidad')->nullable();
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
        Schema::dropIfExists('clientearticulos');
    }
}
