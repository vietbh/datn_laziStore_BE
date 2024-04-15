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
        Schema::create('specifications_products', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('value')->nullable();
            $table->integer('position')->default(1);
            $table->boolean('show_hide')->default(true);
            $table->boolean('type_speci')->default(false);
            $table->unsignedInteger('speci_id')->nullable();
            $table->unsignedInteger('product_id')->nullable();
            $table->unsignedInteger('rep_speci_product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('speci_id')->references('id')->on('specifications');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('specifications_products');
    }
};
