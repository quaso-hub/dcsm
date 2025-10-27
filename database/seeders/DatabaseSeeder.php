<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            CategoryFoodSeeder::class,
            CategoryItemSeeder::class,
            FoodSeeder::class,
            FoodItemSeeder::class,
            DefaultFoodsItemSeeder::class,
            FoodsCategoriesListSeeder::class,
            PaymentSeeder::class,
            OrderSeeder::class,
        ]);
    }
}
