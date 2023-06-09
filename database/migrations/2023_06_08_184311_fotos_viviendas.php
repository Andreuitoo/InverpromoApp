<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FotosViviendas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fotosViviendas', function (Blueprint $table) {
            $table->id();
            $table->string('ruta');
            $table->unsignedBigInteger('vivienda_id');
            $table->foreign('vivienda_id')->references('id')->on('viviendas')->onDelete('cascade');
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
        Schema::dropIfExists('fotosViviendas');
    }
}
