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
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('order_number',255)->unique();
            $table->string('full_name',255);
            $table->string('phone_number',30);
            $table->string('address',255);
            $table->longText('note')->nullable();
            $table->integer('count_items');
            $table->decimal('amount',20,2);
            $table->decimal('total',20,2);
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->date('date_create');
            $table->time('time_create');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
