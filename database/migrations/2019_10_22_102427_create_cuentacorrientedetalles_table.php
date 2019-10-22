<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuentacorrientedetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuentacorrientedetalles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cuentacorriente_id')->unsigned()->nullable();
            $table->foreign('cuentacorriente_id')->references('id')->on('cuentacorrientes');
            $table->decimal('monto',14,2)->default(0)->nullable();
            $table->dateTime('fechapago')->nullable();
            $table->integer('tipopago')->default(1);
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
        Schema::dropIfExists('cuentacorrientedetalles');
    }
}
