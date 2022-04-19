<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use App\Models\Category;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->randomElement($array = array (
                'Pong',
                'Zork',
                'Hades',
                'The Last of Us Part II',
                'Sekiro: Shadows Die Twice',
                'Persona 5 Royal',
                'Red Dead Redemption 2',
                'God of War',
                "Assassin's Creed: Origins",
                'The Legend of Zelda: Breath of the Wild',
                'Overwatch',
                'The Witcher 3: Wild Hunt',
                'Bloodborne',
                'The Last of Us'
                )),
            'description' => $this->faker->text(),
            'price' => $this->faker->numberBetween($min = 1000, $max = 9000),
            'stock' => $this->faker->numberBetween($min = 50, $max = 100),
            //'image' => 'products/' . $this->faker->image(public_path('images\products'),400,300, null, false),
            'status' => $this->faker->randomElement($array = array (
                'activo',
                'inactivo'
            )),
            'tax' => 15,
        ];
    }
}