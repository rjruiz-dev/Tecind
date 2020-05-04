<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('client_id')->unsigned();

            $table->string('name_company', 50)->unique();
            $table->string('cuit', 50)->unique();
            $table->string('web', 200)->nullable();          
            $table->string('phone_company', 20)->unique();
            $table->softDeletes();
            $table->timestamps();         
            
            $table->foreign('client_id')->references('id')->on('clients')
            ->onDelete('cascade')
            ->onUpdate('cascade');  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
