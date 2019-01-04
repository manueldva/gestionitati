<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo', 50)->nullable();
            $table->string('descripcion',250)->nullable();
            $table->integer('rubro_id')->unsigned()->nullable();
            $table->foreign('rubro_id')->references('id')->on('rubros');
            $table->integer('proveedor_id')->unsigned()->nullable();
            $table->foreign('proveedor_id')->references('id')->on('proveedores');
            $table->integer('stock')->nullable();
            $table->integer('stockminimo')->nullable();
            $table->integer('stockmaximo')->nullable();
            $table->decimal('preciounitario', 14,2)->nullable();
            $table->enum('estado',['Activo', 'Inactivo'])->default('Activo');
            $table->string('observaciones', 1000)->nullable();
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
        Schema::dropIfExists('articulos');
    }
}
