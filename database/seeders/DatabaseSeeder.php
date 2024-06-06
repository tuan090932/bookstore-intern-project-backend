<?php

use Database\Seeders\CategoriesTableSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PublishersTableSeeder::class,
            LanguagesTableSeeder::class,
            AuthorsTableSeeder::class,
            CategoriesTableSeeder::class,
            BooksTableSeeder::class,
        ]);
    }
}
