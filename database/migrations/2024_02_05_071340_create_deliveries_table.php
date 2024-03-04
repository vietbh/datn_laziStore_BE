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
        Schema::create('deliveries', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('delivery_number', 50)->unique();
            $table->string('delivery_name', 22);
            $table->string('delivery_phone', 15);
            $table->string('delivery_address', 255);
            $table->decimal('delivery_fee', 10, 2);
            $table->text('delivery_note')->nullable();
            $table->enum('delivery_status', ['pending', 'in_progress', 'completed'])->default('pending');        
            $table->dateTime('estimated_delivery_time');
            $table->dateTime('completed_at')->nullable();
            $table->dateTime('delivered_at')->nullable();
            $table->unsignedInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deliveries');
    }
};
