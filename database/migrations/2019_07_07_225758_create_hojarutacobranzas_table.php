<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHojarutacobranzasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hojarutacobranzas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hojaruta_id')->unsigned()->nullable();
            $table->foreign('hojaruta_id')->references('id')->on('hojarutas');
            $table->decimal('monto',12,2)->default(0)->nullable();
            $table->dateTime('fechacobranza')->nullable();
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
        Schema::dropIfExists('hojarutacobranzas');
    }
}
