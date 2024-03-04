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
        Schema::create('discounts', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('discount_code',255)->unique();
            $table->decimal('discount_price',10,2);
            $table->integer('discount_total');
            $table->integer('used_discount')->default(0);
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->boolean('show_hide')->default(true);
            $table->enum('status',['active','inactive'])->default('inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discounts');
    }
};
