<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCantidadfinalToHojarutadetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hojarutadetalles', function (Blueprint $table) {
            $table->integer('cantidadfinal')->nullable()->default(0);
            $table->decimal('precio',12,2)->default(0)->nullable();
            $table->integer('tipopago')->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hojarutadetalles', function (Blueprint $table) {
            //
        });
    }
}
