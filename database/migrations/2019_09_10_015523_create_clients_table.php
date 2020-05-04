<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_client', 80);
            $table->string('lastname', 80);
            $table->string('address', 80)->nullable();
            $table->string('city', 80)->nullable();
            $table->string('province', 80)->nullable();
            $table->string('postal_code', 30)->nullable();
            $table->string('country', 60)->nullable();
            $table->string('phone_client', 30);
            $table->string('email', 100)->unique();
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
        Schema::dropIfExists('clients');
    }
}
