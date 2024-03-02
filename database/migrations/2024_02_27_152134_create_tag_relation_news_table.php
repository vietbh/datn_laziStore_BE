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
        Schema::create('tag_relation_news', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('tag_id')->unsigned()->nullable();
            $table->unsignedInteger('news_id')->unsigned()->nullable();
            $table->foreign('tag_id')->references('id')->on('tag');
            $table->foreign('news_id')->references('id')->on('news');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tag_relation_news');
    }
};
