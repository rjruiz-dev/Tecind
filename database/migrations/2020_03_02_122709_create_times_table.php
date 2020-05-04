<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('times', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('order_id')->unsigned(); 
            $table->integer('machine_id')->unsigned(); 
          
            $table->string('denomination');           
            $table->string('code');   
            $table->string('user');            
            $table->timestamp('date'); 
            $table->integer('quantity');
            $table->time('preparation_time'); 
            $table->time('machining_time'); 
            $table->string('observation')->nullable();          
             
            $table->foreign('order_id')->references('id')->on('orders')
            ->onDelete('cascade')
            ->onUpdate('cascade'); 

            $table->foreign('machine_id')->references('id')->on('machines')
            ->onDelete('cascade')
            ->onUpdate('cascade');

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
        Schema::dropIfExists('times');
    }
}
