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
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('title')->unique();
            $table->string('slug');
            $table->string('seo_keywords')->unique();
            $table->string('image_url',255);
            $table->string('image_path',255);
            $table->longText('description');
            $table->string('author',50);
            $table->string('date_create');
            $table->string('time_create');
            $table->integer('position')->default(0);
            $table->integer('views')->unsigned()->default(0);
            $table->boolean('show_hide')->default(true);
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('categories_news_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('categories_news_id')->references('id')->on('categories_news');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
