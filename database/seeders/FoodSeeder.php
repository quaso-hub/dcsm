<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Hapus data lama untuk mencegah duplikasi
        DB::table('foods')->delete();

        $foods = [
            // =================================================================
            // 1. MENU JADI (dengan resep default & aturan)
            // =================================================================
            [
                'category_food_id' => 1,
                'name' => 'Classic Beef Burger',
                'description' => 'Burger sapi klasik dengan roti brioche empuk, daging giling premium, dan saus BBQ andalan kami. Bisa dikustomisasi sesuai seleramu.',
                'base_price' => 55000,
                'nutrition_info' => 'Kalori: 650 kcal, Protein: 30g, Lemak: 35g, Karbohidrat: 50g',
                'is_active' => true,
            ],
            [
                'category_food_id' => 1,
                'name' => 'Grilled Chicken Salad',
                'description' => 'Salad sehat dengan potongan dada ayam panggang, sayuran segar, dan disiram dengan Caesar dressing. Pilihan ringan yang mengenyangkan.',
                'base_price' => 48000,
                'nutrition_info' => 'Kalori: 450 kcal, Protein: 40g, Lemak: 20g, Karbohidrat: 15g',
                'is_active' => true,
            ],
            [
                'category_food_id' => 1,
                'name' => 'Spicy Salmon Bowl',
                'description' => 'Potongan salmon panggang pedas di atas nasi hangat, disajikan dengan alpukat, jagung, dan sayuran segar lainnya. Pilihan favorit!',
                'base_price' => 65000,
                'nutrition_info' => 'Kalori: 700 kcal, Protein: 35g, Lemak: 30g, Karbohidrat: 70g',
                'is_active' => true,
            ],

            // =================================================================
            // 2. MENU CUSTOM (kanvas kosong)
            // =================================================================
            [
                'category_food_id' => 5,
                'name' => 'Build Your Own Bowl',
                'description' => 'Rakit sendiri mangkuk sehatmu! Pilih karbohidrat, protein, sayuran, topping, dan saus favoritmu dari nol.',
                'base_price' => 0, // Harga dihitung murni dari item yang dipilih
                'nutrition_info' => 'Informasi nutrisi bervariasi tergantung pilihan Anda.',
                'is_active' => true,
            ],
            [
                'category_food_id' => 5,
                'name' => 'Create Your Own Sandwich',
                'description' => 'Jadi koki untuk sandwich-mu sendiri. Pilih roti, isian utama, sayuran, dan saus untuk menciptakan kombinasi sempurna.',
                'base_price' => 15000, // Harga dasar termasuk roti standar
                'nutrition_info' => 'Informasi nutrisi bervariasi tergantung pilihan Anda.',
                'is_active' => true,
            ],
        ];

        // Tambahkan timestamp untuk setiap item sebelum insert
        $timestamp = now();
        foreach ($foods as &$food) {
            $food['created_at'] = $timestamp;
            $food['updated_at'] = $timestamp;
        }

        // Insert data ke database
        DB::table('foods')->insert($foods);
    }
}
