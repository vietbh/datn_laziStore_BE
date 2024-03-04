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
            $table->string('name',255)->unique();
            $table->string('slug',255);
            $table->string('seo_keywords',255)->unique();
            $table->string('product_type',255)->nullable();
            $table->longText('description');
            $table->boolean('show_hide')->default(true);
            $table->string('status')->default('none');
            $table->unsignedInteger('categories_product_id');
            $table->unsignedInteger('brand_id');            
            $table->foreign('categories_product_id')->references('id')->on('categories_products');
            $table->foreign('brand_id')->references('id')->on('brands');
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
