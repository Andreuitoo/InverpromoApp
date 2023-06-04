<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Clientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable();
            $table->date('fecha')->nullable();
            $table->integer('telefono')->nullable();
            $table->integer('telefono_2')->nullable();
            $table->string('zona')->nullable();
            $table->string('zona_2')->nullable();
            $table->integer('num_hab')->nullable();
            $table->integer('num_hab_2')->nullable();
            $table->integer('precio')->nullable();
            $table->integer('precio_2')->nullable();
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
        Schema::dropIfExists('clientes');
    }
}
