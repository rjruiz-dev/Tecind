<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gags', function (Blueprint $table) {
            $table->increments('id');           
            $table->integer('number_gag');
            $table->string('diameter');           
            $table->enum('type_gag', ['EXTERIOR', 'INTERIOR'])->default('EXTERIOR');
            $table->enum('category_gag', ['PASANTE', 'CON TOPE'])->default('PASANTE');           
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
        Schema::dropIfExists('gags');
    }
}
