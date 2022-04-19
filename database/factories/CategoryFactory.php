<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

class CategoryFactory extends Factory
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
            'Defensa de torres',
            'Deportes',
            'Disparos',
            'Acción',
            'Audiojuego',
            'Aventura',
            'Battle Royale',
            'Carreras',
            'MMORPG',
            'RPG'
            )),
            'description' => $this->faker->unique()->sentence()
        ];
    }
}
