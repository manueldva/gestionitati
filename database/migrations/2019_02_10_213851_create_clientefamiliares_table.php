<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientefamiliaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientefamiliares', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cliente_id')->unsigned()->nullable();
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->integer('tipofamiliar_id')->unsigned()->nullable();
            $table->foreign('tipofamiliar_id')->references('id')->on('tipofamiliares');
            $table->string('nombre', 200)->nullable();
            $table->string('contacto', 100)->nullable();
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
        Schema::dropIfExists('clientefamiliares');
    }
}
