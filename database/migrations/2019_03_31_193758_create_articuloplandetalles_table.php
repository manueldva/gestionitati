<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticuloplandetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articuloplandetalles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('plan_id')->unsigned()->nullable();
            $table->foreign('plan_id')->references('id')->on('articulos');
            $table->integer('planarticulo_id')->unsigned()->nullable();
            $table->foreign('planarticulo_id')->references('id')->on('articulos');
            $table->integer('cantidad')->nullable();
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
        Schema::dropIfExists('articuloplandetalles');
    }
}
