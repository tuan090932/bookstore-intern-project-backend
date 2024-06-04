 
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
            $table->id('book_id'); // Sử dụng 'book_id' làm khóa chính
            $table->string('title', 250);
            $table->unsignedBigInteger('language_id');
            $table->integer('num_pages');
            $table->unsignedBigInteger('publisher_id');
            $table->unsignedBigInteger('category_id');
            $table->string('image', 250);
            $table->text('description')->nullable();
            $table->double('price');
            $table->integer('stock');
            $table->unsignedBigInteger('author_id');
            $table->timestamps();

            // Thiết lập khóa ngoại

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
