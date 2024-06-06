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
        Schema::create('books', function (Blueprint $table) {
            $table->unsignedBigInteger('language_id');
            $table->unsignedBigInteger('publisher_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('author_id');

            $table->id('book_id');
            $table->string('title', 250);
            $table->integer('num_pages');
            $table->string('image', 250);
            $table->text('description')->nullable();
            $table->double('price');
            $table->integer('stock');
            $table->timestamps();

            $table->foreign('language_id')->references('language_id')->on('languages');
            $table->foreign('publisher_id')->references('publisher_id')->on('publishers');
            $table->foreign('category_id')->references('category_id')->on('categories');
            $table->foreign('author_id')->references('author_id')->on('authors');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
