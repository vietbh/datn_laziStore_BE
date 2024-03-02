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
        Schema::create('categories_news', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name')->unique();
            $table->string('slug');
            $table->integer('position')->default(1);
            $table->boolean('show_hide')->default(true);
            $table->unsignedInteger('parent_category_id')->nullable();
            $table->foreign('parent_category_id')->references('id')->on('categories_news');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories_news');
    }
};
