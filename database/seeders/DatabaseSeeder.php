<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            LanguagesTableSeeder::class,
            AuthorsTableSeeder::class,
            CategoriesTableSeeder::class,
            PublishersTableSeeder::class,
            BooksTableSeeder::class,
        ]);
    }
}
