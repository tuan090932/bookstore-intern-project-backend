<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class BooksTableSeeder extends Seeder
{
    /**
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 2) as $index) {
            DB::table('books')->insert([
                'title' => $faker->sentence(3),
                'language_id' => $faker->numberBetween(1, 10),
                'num_pages' => $faker->numberBetween(100, 1000),
                'publisher_id' => $faker->numberBetween(1, 10),
                'category_id' => $faker->numberBetween(1, 10),
                'image' => $faker->imageUrl(250, 250, 'books', true, 'Faker'),
                'description' => $faker->paragraph,
                'price' => $faker->randomFloat(2, 10, 200),
                'stock' => $faker->numberBetween(1, 100),
                'author_id' => $faker->numberBetween(1, 10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
