<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUbicacionToClienedireciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clientedirecciones', function (Blueprint $table) {
            $table->string('longitud', 100)->nullable();
            $table->string('latitud', 100)->nullable();
            $table->string('ubicacion', 4000)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clientedirecciones', function (Blueprint $table) {
            //
        });
    }
}
