<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockventaidToStockasignaciondetalles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stockasignaciondetalles', function (Blueprint $table) {
            $table->integer('stockventa_id')->unsigned()->nullable();
            $table->foreign('stockventa_id')->references('id')->on('stockventas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stockasignaciondetalles', function (Blueprint $table) {
            //
        });
    }
}
