<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCantidadesToStockasignacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stockasignaciondetalles', function (Blueprint $table) {
            $table->integer('vacios')->default(0);
            $table->integer('vacioscierrecontrato')->default(0);
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
