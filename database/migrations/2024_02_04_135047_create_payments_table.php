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
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('payment_number')->unique();
            $table->enum('payment_method',['cod', 'banking', 'credit']);
            $table->integer('count_items');
            $table->decimal('total',20,2);
            $table->decimal('amount',20,2);
            $table->enum('status',['pending', 'in_progress', 'completed','cancel'])->default('pending');
            $table->string('payment_qr_code',100)->nullable();
            $table->string('payment_momo_link',100)->nullable();
            $table->unsignedInteger('order_id');
            $table->unsignedInteger('user_id');
            $table->foreign('order_id')->references('id')->on('orders');
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
        Schema::dropIfExists('payments');
    }
};
