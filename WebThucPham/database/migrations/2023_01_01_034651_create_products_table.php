<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('categories_id');
            $table->foreign('categories_id')->references('id')->on('categories')->onDelete('cascade');
            $table->string('price');
            $table->string('image');
            $table->string('ingredient');
            $table->string('exp');
            $table->unsignedBigInteger('trademarks_id');
            $table->foreign('trademarks_id')->references('id')->on('trademarks');
            $table->unsignedBigInteger('countries_id');
            $table->foreign('countries_id')->references('id')->on('countries');
            $table->string('description');
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
        Schema::dropIfExists('products');
    }
};
