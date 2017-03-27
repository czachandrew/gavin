<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('activities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title'); 
            $table->text('content');
            $table->string('due_date'); 
            $table->string('reminder'); 
            $table->string('type');
            $table->string('status')->default('open');
            $table->integer('creator_id'); 
            $table->integer('facility_id')->nullable();
            $table->integer('assigned_id'); 
            $table->string('assigned_type');
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
        Schema::dropIfExists('activities');
    }
}
