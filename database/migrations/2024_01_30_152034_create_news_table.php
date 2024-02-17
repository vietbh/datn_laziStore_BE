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
            $table->longText('description');
            $table->string('author',50);
            $table->dateTime('datetime_create');
            $table->integer('views')->default(0);
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
