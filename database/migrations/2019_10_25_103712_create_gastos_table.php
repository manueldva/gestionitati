<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGastosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gastos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tipocomprobante_id')->unsigned()->nullable();
            $table->foreign('tipocomprobante_id')->references('id')->on('tipocomprobantes');
            $table->integer('rubrogasto_id')->unsigned()->nullable();
            $table->foreign('rubrogasto_id')->references('id')->on('rubrogastos');
            $table->string('detalle',300)->nullable();
            $table->dateTime('fecha')->nullable();
            $table->decimal('monto',14,2)->default(0)->nullable();
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
        Schema::dropIfExists('gastos');
    }
}
