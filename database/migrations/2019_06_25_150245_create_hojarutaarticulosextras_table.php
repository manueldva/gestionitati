<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHojarutaarticulosextrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hojarutaarticulosextras', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hojaruta_id')->unsigned()->nullable();
            $table->foreign('hojaruta_id')->references('id')->on('hojarutas');
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
        Schema::dropIfExists('hojarutaarticulosextras');
    }
}
