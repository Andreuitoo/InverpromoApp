<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fotos', function (Blueprint $table) {
            $table->id();
            $table->string('ruta');
            $table->unsignedBigInteger('piso_id');
            $table->foreign('piso_id')->references('id')->on('pisos')->onDelete('cascade');
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
        Schema::dropIfExists('fotos');
    }
}
