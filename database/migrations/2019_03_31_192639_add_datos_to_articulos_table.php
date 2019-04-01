<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDatosToArticulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('articulos', function (Blueprint $table) {
            $table->integer('tipoenvase_id')->unsigned()->nullable();
            $table->foreign('tipoenvase_id')->references('id')->on('tipoenvases');
            $table->string('caracteristicas', 300)->nullable();
            $table->string('abreviatura', 50)->nullable();
            $table->boolean('clasificacion')->default(0);
            $table->decimal('precioventa',12,2)->default(0)->nullable();
            $table->decimal('precioreparto',12,2)->default(0)->nullable();
            $table->decimal('precioplan',12,2)->default(0)->nullable();
            $table->decimal('costo',12,2)->default(0)->nullable();
            $table->decimal('costovendedor',12,2)->default(0)->nullable();
            $table->decimal('costorepartidor',12,2)->default(0)->nullable();
            $table->string('condicioniva', 100)->nullable();
            $table->string('file', 128)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articulos', function (Blueprint $table) {
            //
        });
    }
}
