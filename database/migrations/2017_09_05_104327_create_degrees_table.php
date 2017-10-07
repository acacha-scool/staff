<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateDegreesTable.
 */
class CreateDegreesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('degrees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

//        Schema::create('degree_user', function (Blueprint $table) {
//            $table->increments('id');
//            $table->integer('degree_id')->unsigned();
//            $table->integer('user_id')->unsigned();
//            $table->boolean('main');
//            $table->foreign('degree_id')->references('id')->on('degrees')->onDelete('cascade');
//            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
//
//            $table->timestamps();
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('degrees');
        Schema::dropIfExists('degree_user');
    }
}
