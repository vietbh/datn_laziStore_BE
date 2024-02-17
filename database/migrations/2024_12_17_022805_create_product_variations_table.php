<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_variations', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('color_type');
            $table->decimal('price',10,2);
            $table->decimal('price_sale',10,2);
            $table->integer('quantity');
            $table->integer('quantity_availible')->default(0);
            $table->integer('quantity_sold')->default(0);
            $table->unsignedInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variations');
    }
};
