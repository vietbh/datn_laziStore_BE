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
        Schema::create('images_products', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->longText('image_path');
            $table->longText('image_url');
            $table->integer('position')->default(1);
            $table->boolean('show_hide')->default(true);
            $table->unsignedInteger('variation_gallery_id');
            $table->foreign('variation_gallery_id')->references('id')->on('gallery_product_variations');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images_products');
    }
};
