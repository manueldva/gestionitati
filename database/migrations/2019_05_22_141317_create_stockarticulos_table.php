<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockarticulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stockarticulos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion',500)->nullable();
            $table->integer('stockactual')->default(0);
            $table->integer('stockminimo')->default(0);
            $table->integer('stockmaximo')->nullable();
            $table->integer('tiemporeposicion')->nullable();
            $table->integer('tipotiempo_id')->unsigned()->nullable();
            $table->foreign('tipotiempo_id')->references('id')->on('tipotiempos');
            $table->integer('sucursal_id')->unsigned()->nullable();
            $table->foreign('sucursal_id')->references('id')->on('sucursales');
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
        Schema::dropIfExists('stockarticulos');
    }
}
