<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockajustesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stockajustes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('stockarticulo_id')->unsigned()->nullable();
            $table->foreign('stockarticulo_id')->references('id')->on('stockarticulos');
            $table->integer('cantidad')->nullable();
            $table->integer('tipoajuste_id')->unsigned()->nullable();
            $table->foreign('tipoajuste_id')->references('id')->on('tipoajustes');
            $table->integer('motivoajuste_id')->unsigned()->nullable();
            $table->foreign('motivoajuste_id')->references('id')->on('motivoajustes');
            $table->integer('proveedorajuste_id')->unsigned()->nullable();
            $table->foreign('proveedorajuste_id')->references('id')->on('proveedorajustes');
            $table->string('lote',128)->nullable();
            $table->dateTime('fechavencimiento')->nullable();
            $table->string('observacion',500)->nullable();
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
        Schema::dropIfExists('stockajustes');
    }
}
