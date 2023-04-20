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
        Schema::create('details_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('units_id');
            $table->foreign('units_id')->references('id')->on('units');
            $table->unsignedBigInteger('products_id');
            $table->foreign('products_id')->references('id')->on('products');
            $table->integer('quantity');
            $table->decimal('import_price',65,0);
            $table->decimal('price',65,0);
            $table->string('image');
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
        Schema::dropIfExists('details_products');
    }
};
