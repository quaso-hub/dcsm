<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DefaultFoodsItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Kosongkan tabel terlebih dahulu
        DB::table('default_foods_item')->delete();

        // Data resep default untuk produk standar
        // Pastikan ID ini sesuai dengan data di seeder lain (FoodSeeder, FoodItemSeeder, CategoryItemSeeder)
        $defaultItems = [
            // =================================================================
            // Default untuk: Classic Beef Burger (food_id: 1)
            // =================================================================
            [
                'food_id' => 1,
                'food_item_id' => 5,     // Item: Roti Brioche
            ],
            [
                'food_id' => 1,
                'food_item_id' => 8,     // Item: Daging Sapi Giling Panggang
            ],

            // =================================================================
            // Default untuk: Grilled Chicken Salad (food_id: 2)
            // =================================================================
            [
                'food_id' => 2,
                'food_item_id' => 9,     // Item: Dada Ayam Panggang
            ],
            [
                'food_id' => 2,
                'food_item_id' => 15,    // Item: Selada Romaine
            ],
            [
                'food_id' => 2,
                'food_item_id' => 27,    // Item: Caesar Dressing
            ],

            // =================================================================
            // Default untuk: Spicy Salmon Bowl (food_id: 3)
            // =================================================================
            [
                'food_id' => 3,
                'food_item_id' => 1,     // Item: Nasi Putih
            ],
            [
                'food_id' => 3,
                'food_item_id' => 10,    // Item: Ikan Salmon Panggang
            ],
            [
                'food_id' => 3,
                'food_item_id' => 21,    // Item: Alpukat
            ],
        ];

        // Tambahkan timestamp untuk setiap item sebelum insert
        $timestamp = now();
        foreach ($defaultItems as &$item) {
            $item['created_at'] = $timestamp;
            $item['updated_at'] = $timestamp;
        }

        // Insert data ke database
        DB::table('default_foods_item')->insert($defaultItems);
    }
}
