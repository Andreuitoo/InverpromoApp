<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Viviendas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('viviendas', function (Blueprint $table) {
            $table->id();
            $table->string('ref')->nullable();
            $table->date('fecha')->nullable();
            $table->string('nota')->nullable();
            $table->string('tipo')->nullable();
            $table->string('propietario')->nullable();
            $table->integer('telefono')->nullable();
            $table->string('zona')->nullable();
            $table->string('zona_2')->nullable();
            $table->integer('precio_prop')->nullable();
            $table->integer('precio_venta')->nullable();
            $table->string('terraza')->nullable();
            $table->integer('num_hab')->nullable();
            $table->integer('num_banos')->nullable();
            $table->string('ascensor')->nullable();
            $table->string('altura_planta')->nullable();
            $table->string('coladuria')->nullable();
            $table->string('garaje')->nullable();
            $table->string('piscina')->nullable();
            $table->string('balcon')->nullable();
            $table->integer('m2')->nullable();
            $table->string('estado')->nullable();
            $table->string('muebles')->nullable();
            $table->string('carpinteria_int')->nullable();
            $table->string('carpinteria_ext')->nullable();
            $table->string('zona_comunitaria')->nullable();
            $table->string('antiguedad')->nullable();
            $table->string('direccion')->nullable();
            $table->string('descripcion')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('viviendas');
    }
}
