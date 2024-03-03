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
        Schema::create('comment_product_likes', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('comment_products_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('comment_products_id')->references('id')->on('comment_products')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comment_product_likes');
    }
};
