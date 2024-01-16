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
            // $table->id();
            // $table->decimal('price',10,2);
            // $table->integer('quantity_in_stock')->default(1);
            $table->increments('id');
            $table->string('name',255);
            $table->string('seo_keywords',255)->nullable();
            $table->string('slug',255)->unique();
            $table->string('product_type',255)->nullable();
            $table->text('description');
            $table->string('image_url',255);
            $table->unsignedInteger('categories_product_id');
            $table->unsignedInteger('brand_id');            
            $table->foreign('categories_product_id')->references('id')->on('categories_products');
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->integer('quantity_available')->default(0);
            $table->integer('quantity_sold')->default(0);
            $table->char('show_hide')->default('show');
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
