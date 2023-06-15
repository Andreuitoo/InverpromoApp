<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pisos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pisos', function (Blueprint $table) {
            $table->id();
            $table->string('ref')->nullable();
            $table->date('fecha')->nullable();
            $table->string('tipo_piso')->nullable();
            $table->string('zona')->nullable();
            $table->integer('precio')->nullable();
            $table->integer('num_hab')->nullable();
            $table->string('muebles')->nullable();
            $table->string('descripcion')->nullable();
            $table->integer('telefono')->nullable();
            $table->string('propietario')->nullable();
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
        Schema::dropIfExists('pisos');
    }
}
