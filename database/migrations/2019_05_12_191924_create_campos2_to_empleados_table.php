<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampos2ToEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empleados', function (Blueprint $table) {
            $table->integer('tipodocumento_id')->unsigned()->nullable();
            $table->foreign('tipodocumento_id')->references('id')->on('tipodocumentos');
            $table->string('numerodocumento', 20)->nullable();
            $table->dateTime('fechanacimiento')->nullable();
            $table->integer('estadocivil_id')->unsigned()->nullable();
            $table->foreign('estadocivil_id')->references('id')->on('estadociviles');
            $table->string('sexo', 1)->nullable();
            $table->dateTime('fechaingreso')->nullable();
            $table->dateTime('fechaegreso')->nullable();
            $table->string('telefonoparticular', 20)->nullable();
            $table->string('celular', 20)->nullable();
            $table->integer('companiatelefonica_id')->unsigned()->nullable();
            $table->foreign('companiatelefonica_id')->references('id')->on('companiatelefonicas');
            $table->string('email',128)->nullable();
            $table->integer('localidad_id')->unsigned()->nullable();
            $table->foreign('localidad_id')->references('id')->on('localidades');
            $table->string('direccion', 250)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('empleados', function (Blueprint $table) {
            //
        });
    }
}
