<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'total' => $this->faker->numberBetween($min = 100000, $max = 500000),
            'product_id' => Product::all()->random()->id,
            'user_id' => User::all()->random()->id,
        ];
    }
}
