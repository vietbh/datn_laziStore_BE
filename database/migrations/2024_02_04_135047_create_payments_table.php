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
            $table->string('payment_number',255)->unique();
            $table->string('payment_method',20);
            $table->decimal('amount',10,2);
            $table->enum('status',['pending', 'in_progress', 'completed'])->default('pending');
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
