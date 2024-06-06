<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure related data exists before seeding books
        DB::table('languages')->insert([
            ['language_name' => 'English', 'created_at' => now(), 'updated_at' => now()],
            ['language_name' => 'French', 'created_at' => now(), 'updated_at' => now()],
            ['language_name' => 'Spanish', 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('publishers')->insert([
            ['publisher_name' => 'Publisher 1', 'created_at' => now(), 'updated_at' => now()],
            ['publisher_name' => 'Publisher 2', 'created_at' => now(), 'updated_at' => now()],
            ['publisher_name' => 'Publisher 3', 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('authors')->insert([
            ['author_name' => 'Author 1', 'created_at' => now(), 'updated_at' => now()],
            ['author_name' => 'Author 2', 'created_at' => now(), 'updated_at' => now()],
            ['author_name' => 'Author 3', 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('categories')->insert([
            ['category_name' => 'Fiction', 'created_at' => now(), 'updated_at' => now()],
            ['category_name' => 'Non-Fiction', 'created_at' => now(), 'updated_at' => now()],
            ['category_name' => 'Science Fiction', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Create book entries
        $books = [
            [
                'title' => 'Book 1',
                'language_id' => 1, // Assuming 1 corresponds to English
                'num_pages' => 300,
                'publisher_id' => 1, // Assuming 1 corresponds to Publisher 1
                'category_id' => 1, // Assuming 1 corresponds to Fiction
                'image' => 'https://example.com/book1.jpg',
                'description' => 'Description for Book 1',
                'price' => 29.99,
                'stock' => 100,
                'author_id' => 1, // Assuming 1 corresponds to Author 1
            ],
            [
                'title' => 'Book 2',
                'language_id' => 2, // Assuming 2 corresponds to French
                'num_pages' => 150,
                'publisher_id' => 2, // Assuming 2 corresponds to Publisher 2
                'category_id' => 2, // Assuming 2 corresponds to Non-Fiction
                'image' => 'https://example.com/book2.jpg',
                'description' => 'Description for Book 2',
                'price' => 19.99,
                'stock' => 200,
                'author_id' => 2, // Assuming 2 corresponds to Author 2
            ],
            [
                'title' => 'Book 3',
                'language_id' => 3, // Assuming 3 corresponds to Spanish
                'num_pages' => 450,
                'publisher_id' => 3, // Assuming 3 corresponds to Publisher 3
                'category_id' => 3, // Assuming 3 corresponds to Science Fiction
                'image' => 'https://example.com/book3.jpg',
                'description' => 'Description for Book 3',
                'price' => 39.99,
                'stock' => 50,
                'author_id' => 3, // Assuming 3 corresponds to Author 3
            ],
        ];

        foreach ($books as $bookData) {
            $book = new Book();
            $book->fill($bookData);
            $book->save();
        }
    }
}
