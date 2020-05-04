<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePiecesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pieces', function (Blueprint $table) {
            $table->increments('id');                  
                   
            $table->integer('program_id')->unsigned();   
            $table->integer('gag_id')->unsigned();           
            $table->integer('machine_id')->unsigned();             
            $table->integer('order_id')->unsigned();    
         
            $table->string('user');   
            $table->string('code');   
            $table->integer('part_piece');      
            $table->time('time');                 
            $table->string('observation')->nullable();              
            
            $table->foreign('program_id')->references('id')->on('programs')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            
            $table->foreign('gag_id')->references('id')->on('gags')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('machine_id')->references('id')->on('machines')
            ->onDelete('cascade')
            ->onUpdate('cascade');          

            $table->foreign('order_id')->references('id')->on('orders')
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
        Schema::dropIfExists('pieces');
    }
}
