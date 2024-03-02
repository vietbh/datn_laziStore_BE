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
        Schema::create('comment_products', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->longText('comment');
            $table->integer('likes')->default(0);
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('product_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('product_id')->references('id')->on('products');
            // $table->unsignedInteger('parent_id')->nullable();
            // $table->foreign('parent_id')
            //       ->references('id')
            //       ->on('comment_products')
            //       ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('comment_products', function (Blueprint $table) {
        //     $table->dropColumn('likes');
        //     $table->dropForeign(['parent_id']);
        //     $table->dropColumn('parent_id');
        // });
        Schema::dropIfExists('comment_products');
        
    }
};
