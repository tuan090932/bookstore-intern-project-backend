<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    protected $model = Book::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'language_id' => $this->faker->numberBetween(1, 5),
            'publisher_id' => $this->faker->numberBetween(1, 5),
            'category_id' => $this->faker->numberBetween(1, 5),
            'author_id' => $this->faker->numberBetween(1, 5),
            'title' => $this->faker->sentence,
            'num_pages' => $this->faker->numberBetween(100, 500),
            'image' => $this->faker->imageUrl(250, 250, 'books', true),
            'description' => $this->faker->paragraph,
            'price' => $this->faker->randomFloat(2, 10, 100),
            'stock' => $this->faker->numberBetween(0, 200),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
