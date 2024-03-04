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
        Schema::create('comment_news', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->text('content');
            $table->integer('likes')->default(0);
            $table->boolean('show_hide')->default(true);
            $table->dateTime('datetime_create');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('news_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('news_id')->references('id')->on('news');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comment_news');
        
    }
};
