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
        Schema::create('slide_ads', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('title');
            $table->string('content');
            $table->string('image_url');
            $table->string('image_path');
            $table->integer('position')->default(1);
            $table->string('link')->nullable();
            $table->boolean('show_hide')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slide_ads');
    }
};
