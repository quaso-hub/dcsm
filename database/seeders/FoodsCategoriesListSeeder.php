<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FoodsCategoriesListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Kosongkan tabel pivot terlebih dahulu
        DB::table('foods_categories_list')->delete();

        // Hubungkan produk standar dengan kategori item yang tersedia untuknya
        $links = [
            // --- Classic Beef Burger (food_id: 1) ---
            ['food_id' => 1, 'category_item_id' => 2], // Punya Pilihan Roti
            ['food_id' => 1, 'category_item_id' => 3], // Punya Pilihan Protein
            ['food_id' => 1, 'category_item_id' => 4], // Punya Sayuran Segar
            ['food_id' => 1, 'category_item_id' => 5], // Punya Topping
            ['food_id' => 1, 'category_item_id' => 6], // Punya Saus

            // --- Grilled Chicken Salad (food_id: 2) ---
            ['food_id' => 2, 'category_item_id' => 3], // Punya Pilihan Protein
            ['food_id' => 2, 'category_item_id' => 4], // Punya Sayuran Segar
            ['food_id' => 2, 'category_item_id' => 5], // Punya Topping
            ['food_id' => 2, 'category_item_id' => 6], // Punya Saus

            // --- Spicy Salmon Bowl (food_id: 3) ---
            ['food_id' => 3, 'category_item_id' => 1], // Punya Karbohidrat Dasar
            ['food_id' => 3, 'category_item_id' => 3], // Punya Pilihan Protein
            ['food_id' => 3, 'category_item_id' => 4], // Punya Sayuran Segar
            ['food_id' => 3, 'category_item_id' => 5], // Punya Topping
            ['food_id' => 3, 'category_item_id' => 6], // Punya Saus
        ];

        // Insert data ke tabel pivot
        DB::table('foods_categories_list')->insert($links);
    }
}
