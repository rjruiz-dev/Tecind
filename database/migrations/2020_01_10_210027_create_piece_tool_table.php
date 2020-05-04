<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePieceToolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('piece_tool', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('piece_id')->unsigned();           
            $table->integer('tool_id')->unsigned(); 
            
            $table->foreign('piece_id')->references('id')->on('pieces')
            ->onDelete('cascade')
            ->onUpdate('cascade');  

            $table->foreign('tool_id')->references('id')->on('tools')
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
        Schema::dropIfExists('piece_tool');
    }
}
