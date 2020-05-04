<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('client_id')->unsigned();          
            $table->integer('user_id')->unsigned();          
            $table->integer('statu_id')->unsigned();          

            $table->integer('order')->unique();
            $table->string('denomination');
            $table->string('reason')->nullable();
            $table->string('code');
            $table->integer('quantity');           
         
            $table->timestamp('date')->nullable();            

            $table->foreign('client_id')->references('id')->on('clients')
            ->onDelete('cascade')
            ->onUpdate('cascade');  

            $table->foreign('user_id')->references('id')->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');  

            $table->foreign('statu_id')->references('id')->on('status')
            ->onDelete('cascade')
            ->onUpdate('cascade');  


            $table->softDeletes();
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
        Schema::dropIfExists('orders');
    }
}
