<?php
namespace Database\Factories;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    protected $model = Address::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'city' => $this->faker->city,
            'country_name' => $this->faker->country,
            'shipping_address' => $this->faker->address,
            'user_id' => User::factory(),
        ];
    }
}
