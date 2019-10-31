<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsignarstockagregadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignarstockagregados', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('stockasignaciondetalle_id')->unsigned()->nullable();
            $table->foreign('stockasignaciondetalle_id')->references('id')->on('stockasignaciondetalles');
            $table->integer('carga')->nullable()->default(0);
            $table->integer('cantidad')->nullable()->default(0);
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
        Schema::dropIfExists('asignarstockagregados');
    }
}
