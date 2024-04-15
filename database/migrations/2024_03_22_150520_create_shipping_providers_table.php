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
        Schema::create('shipping_providers', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('address');
            $table->string('phone_number')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('website')->nullable();
            $table->longText('operating_areas')->nullable();
            $table->text('shipping_policies')->nullable();
            $table->decimal('shipping_cost',10,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_providers');
    }
};
