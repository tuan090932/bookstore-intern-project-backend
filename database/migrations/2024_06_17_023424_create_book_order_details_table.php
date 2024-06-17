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
        Schema::create('book_order_details', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('book_id');
            $table->integer('quantity');
            $table->double('price');
            $table->timestamps();

            $table->primary(['order_id', 'book_id']);
            $table->foreign('order_id')->references('order_id')->on('book_order');
            $table->foreign('book_id')->references('book_id')->on('books');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_order_details');
    }
};
