<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentadetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventadetalles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('venta_id')->unsigned()->nullable();
			$table->foreign('venta_id')->references('id')->on('ventas');
			$table->integer('articulo_id')->unsigned()->nullable();
			$table->foreign('articulo_id')->references('id')->on('articulos');
			$table->integer('cantidad')->nullable();
			$table->decimal('preciounitario', 14,2)->nullable();
			$table->string('usuario_alta',50)->nullable();
			$table->timestamp('fecha_alta')->nullable();
			$table->string('usuario_modi',50)->nullable();
			$table->timestamp('fecha_modi')->nullable();
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
        Schema::dropIfExists('ventadetalles');
    }
}
