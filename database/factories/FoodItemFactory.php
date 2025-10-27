<?php

namespace Database\Factories;

use App\Models\CategoryItem;
use App\Models\FoodItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class FoodItemFactory extends Factory
{
    protected $model = FoodItem::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'extra_price' => $this->faker->randomFloat(2, 0.5, 5),
            'category_id' => CategoryItem::inRandomOrder()->first()->id ?? CategoryItem::factory(),
            'is_active' => $this->faker->boolean(75),
        ];
    }
}
