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
            $table->increments('id');
            $table->date('fecha');
            $table->string('tipo_piso');
            $table->string('zona');
            $table->integer('precio');
            $table->integer('num_hab');
            $table->string('muebles');
            $table->string('descripcion');
            $table->integer('telefono');
            $table->string('propietario');
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
