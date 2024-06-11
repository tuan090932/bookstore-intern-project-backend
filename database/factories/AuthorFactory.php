<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AuthorFactory extends Factory
{
    protected $model = Author::class;

    public function definition()
    {
        return [
            'author_name' => $this->faker->name,
            'age' => $this->faker->numberBetween(25, 100),
            'birth_date' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'death_date' => $this->faker->optional($weight = 0.3)->date($format = 'Y-m-d', $max = 'now'),
        ];
    }
}
