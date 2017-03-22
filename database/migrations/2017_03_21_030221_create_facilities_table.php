<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facilities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name'); 
            $table->string('link');
            $table->string('address');
            $table->string('city');
            $table->string('state'); 
            $table->string('zip')->nullable(); 
            $table->string('phone'); 

            $table->string('date_called')->nullable(); 
            $table->string('contacted')->default('no'); 
            $table->string('notes')->nullable();
            $table->string('possible')->default('unkown');
            $table->text('codes')->nullable();

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
        Schema::dropIfExists('facilities');
    }
}
