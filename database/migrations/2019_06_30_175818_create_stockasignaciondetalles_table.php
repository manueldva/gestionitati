<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockasignaciondetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stockasignaciondetalles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('stockasignacion_id')->unsigned()->nullable();
            $table->foreign('stockasignacion_id')->references('id')->on('stockasignaciones');
            $table->integer('stockarticulo_id')->unsigned()->nullable();
            $table->foreign('stockarticulo_id')->references('id')->on('stockarticulos');
            $table->integer('cantidad')->nullable()->default(0);
            $table->integer('devuelve')->nullable()->default(0);
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
        Schema::dropIfExists('stockasignaciondetalles');
    }
}
