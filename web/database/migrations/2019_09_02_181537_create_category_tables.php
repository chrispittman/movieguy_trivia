<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description');
            $table->bigInteger('user_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('category_review', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('category_id')->unsigned();
            $table->bigInteger('review_id')->unsigned();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('review_id')->references('id')->on('reviews');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_review');
        Schema::dropIfExists('categories');
    }
}
