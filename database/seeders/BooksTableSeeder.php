<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Language;
use App\Models\Publisher;
use App\Models\Category;
use App\Models\Author;
use Faker\Factory as Faker;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $languages = Language::all()->pluck('language_id')->toArray();
        $publishers = Publisher::all()->pluck('publisher_id')->toArray();
        $categories = Category::all()->pluck('category_id')->toArray();
        $authors = Author::all()->pluck('author_id')->toArray();

        Book::factory()->count(50)->make()->each(function($book) use ($faker, $languages, $publishers, $categories, $authors) {
            $book->language_id = $faker->randomElement($languages);
            $book->publisher_id = $faker->randomElement($publishers);
            $book->category_id = $faker->randomElement($categories);
            $book->author_id = $faker->randomElement($authors);
            $book->save();
        });
    }
}
