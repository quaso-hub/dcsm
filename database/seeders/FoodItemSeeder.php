<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FoodItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Kosongkan tabel terlebih dahulu untuk menghindari duplikasi saat seeder dijalankan ulang
        DB::table('foods_items')->delete();

        // Siapkan data item yang akan di-insert
        $items = [
            // =================================================================
            // KATEGORI 1: KARBOHIDRAT DASAR (untuk Bowl/Wrap)
            // =================================================================
            [
                'name' => 'Nasi Putih',
                'category_item_id' => 1,
                'extra_price' => 0,
                'is_active' => true,

            ],
            [
                'name' => 'Nasi Merah',
                'category_item_id' => 1,
                'extra_price' => 3000,
                'is_active' => true,
                
            ],
            [
                'name' => 'Quinoa',
                'category_item_id' => 1,
                'extra_price' => 8000,
                'is_active' => true,

            ],
            [
                'name' => 'Kentang Panggang',
                'category_item_id' => 1,
                'extra_price' => 5000,
                'is_active' => true,

            ],

            // =================================================================
            // KATEGORI 2: PILIHAN ROTI (untuk Burger/Sandwich)
            // =================================================================
            [
                'name' => 'Roti Brioche',
                'category_item_id' => 2,
                'extra_price' => 0,
                'is_active' => true,

            ],
            [
                'name' => 'Roti Gandum Utuh',
                'category_item_id' => 2,
                'extra_price' => 2000,
                'is_active' => true,

            ],
            [
                'name' => 'Roti Ciabatta',
                'category_item_id' => 2,
                'extra_price' => 3000,
                'is_active' => true,

            ],

            // =================================================================
            // KATEGORI 3: PILIHAN PROTEIN
            // =================================================================
            [
                'name' => 'Daging Sapi Giling Panggang',
                'category_item_id' => 3,
                'extra_price' => 15000,
                'is_active' => true,

            ],
            [
                'name' => 'Dada Ayam Panggang',
                'category_item_id' => 3,
                'extra_price' => 12000,
                'is_active' => true,

            ],
            [
                'name' => 'Ikan Salmon Panggang',
                'category_item_id' => 3,
                'extra_price' => 25000,
                'is_active' => true,

            ],
            [
                'name' => 'Tahu Goreng',
                'category_item_id' => 3,
                'extra_price' => 5000,
                'is_active' => true,

            ],
            [
                'name' => 'Tempe Bakar',
                'category_item_id' => 3,
                'extra_price' => 5000,
                'is_active' => true,

            ],
            [
                'name' => 'Telur Rebus',
                'category_item_id' => 3,
                'extra_price' => 4000,
                'is_active' => true,

            ],

            // =================================================================
            // KATEGORI 4: SAYURAN SEGAR
            // =================================================================
            [
                'name' => 'Selada Romaine',
                'category_item_id' => 4,
                'extra_price' => 3000,
                'is_active' => true,

            ],
            [
                'name' => 'Tomat Ceri',
                'category_item_id' => 4,
                'extra_price' => 2500,
                'is_active' => true,

            ],
            [
                'name' => 'Irisan Timun',
                'category_item_id' => 4,
                'extra_price' => 1500,
                'is_active' => true,

            ],
            [
                'name' => 'Bawang Bombay Merah',
                'category_item_id' => 4,
                'extra_price' => 2000,
                'is_active' => true,

            ],
            [
                'name' => 'Paprika Mix',
                'category_item_id' => 4,
                'extra_price' => 4000,
                'is_active' => true,

            ],

            // =================================================================
            // KATEGORI 5: TOPPING & PELENGKAP
            // =================================================================
            [
                'name' => 'Keju Cheddar Parut',
                'category_item_id' => 5,
                'extra_price' => 5000,
                'is_active' => true,

            ],
            [
                'name' => 'Alpukat',
                'category_item_id' => 5,
                'extra_price' => 8000,
                'is_active' => true,

            ],
            [
                'name' => 'Jagung Pipil Manis',
                'category_item_id' => 5,
                'extra_price' => 3000,
                'is_active' => true,

            ],
            [
                'name' => 'Jamur Champignon Tumis',
                'category_item_id' => 5,
                'extra_price' => 6000,
                'is_active' => true,

            ],
            [
                'name' => 'Croutons (Roti Kering)',
                'category_item_id' => 5,
                'extra_price' => 2500,
                'is_active' => true,

            ],

            // =================================================================
            // KATEGORI 6: SAUS & DRESSING
            // =================================================================
            [
                'name' => 'Saus BBQ Classic',
                'category_item_id' => 6,
                'extra_price' => 3000,
                'is_active' => true,

            ],
            [
                'name' => 'Mayones',
                'category_item_id' => 6,
                'extra_price' => 2000,
                'is_active' => true,

            ],
            [
                'name' => 'Caesar Dressing',
                'category_item_id' => 6,
                'extra_price' => 5000,
                'is_active' => true,

            ],
            [
                'name' => 'Saus Sambal',
                'category_item_id' => 6,
                'extra_price' => 1000,
                'is_active' => true,

            ],
            [
                'name' => 'Japanese Sesame Dressing',
                'category_item_id' => 6,
                'extra_price' => 6000,
                'is_active' => true,

            ],
        ];

        // Tambahkan timestamp untuk setiap item sebelum insert
        $timestamp = now();
        foreach ($items as &$item) {
            $item['created_at'] = $timestamp;
            $item['updated_at'] = $timestamp;
        }

        // Insert data ke database
        DB::table('foods_items')->insert($items);
    }
}
