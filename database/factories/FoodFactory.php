<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FoodFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(2, true),
            'description' => $this->faker->sentence(),
            'base_price' => $this->faker->randomFloat(2, 10, 100),
            'image_path' => null,
            'nutrition_info' => $this->faker->text(50),
            'is_active' => $this->faker->boolean(75),
        ];
    }
}
