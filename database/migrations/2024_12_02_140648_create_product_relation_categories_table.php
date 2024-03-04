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
        Schema::create('product_relation_categories', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->unsignedInteger('categories_product_id');
            $table->unsignedInteger('product_id');
            $table->foreign('categories_product_id')->references('id')->on('categories_products');
            $table->foreign('product_id')->references('id')->on('products');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_relation_categories');
    }
};
