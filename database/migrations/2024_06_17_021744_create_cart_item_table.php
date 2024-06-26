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
        Schema::create('cart_item', function (Blueprint $table) {
            $table->id('item_id');
            $table->unsignedBigInteger('book_id');
            $table->unsignedBigInteger('cart_id');
            $table->integer('quantity');
            $table->timestamps();

            $table->foreign('book_id')->references('book_id')->on('books');
            $table->foreign('cart_id')->references('cart_id')->on('cart');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_item');
    }
};
