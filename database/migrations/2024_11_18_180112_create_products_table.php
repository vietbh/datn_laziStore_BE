<?php

use App\Models\Brands;
use App\Models\CategoriesProduct;
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
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name',255);
            $table->string('seo_keywords',255)->unique();
            $table->string('slug',255)->unique();
            $table->string('product_type',255)->nullable();
            $table->string('description');
            $table->string('image_url',255);
            $table->string('image_path',255);
            $table->unsignedInteger('categories_product_id')->nullable();
            $table->unsignedInteger('brand_id')->nullable();            
            $table->foreign('categories_product_id')->references('id')->on('categories_products');
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->boolean('show_hide')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
