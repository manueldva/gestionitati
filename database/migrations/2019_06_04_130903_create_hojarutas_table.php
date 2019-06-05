<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHojarutasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hojarutas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('empleado_id')->unsigned()->nullable();
            $table->foreign('empleado_id')->references('id')->on('empleados');
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
        Schema::dropIfExists('hojarutas');
    }
}
