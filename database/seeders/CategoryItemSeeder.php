<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Kosongkan tabel terlebih dahulu untuk konsistensi
        DB::table('categories_item')->delete();

        $categories = [
            [
                'name' => 'Karbohidrat Dasar',
                'description' => 'Pilihan sumber karbohidrat utama untuk Custom Bowl atau Wrap Anda.',
                'selection_type' => 'radio',
                // Hanya untuk 'bowl'
                'builder_tags' => json_encode(['bowl']),
            ],
            [
                'name' => 'Pilihan Roti',
                'description' => 'Pilihan jenis roti untuk Burger atau Sandwich.',
                'selection_type' => 'radio',
                // Hanya untuk 'bread'
                'builder_tags' => json_encode(['bread']),
            ],
            [
                'name' => 'Pilihan Protein',
                'description' => 'Sumber protein utama, dari hewani hingga nabati.',
                'selection_type' => 'radio',
                'builder_tags' => json_encode(['bowl', 'bread']),
            ],
            [
                'name' => 'Sayuran Segar',
                'description' => 'Berbagai macam sayuran segar untuk menambah vitamin dan serat.',
                'selection_type' => 'checkbox',
                'builder_tags' => json_encode(['bowl', 'bread']),
            ],
            [
                'name' => 'Topping & Pelengkap',
                'description' => 'Item tambahan untuk memperkaya rasa dan tekstur makanan Anda.',
                'selection_type' => 'checkbox',
                'builder_tags' => json_encode(['bowl', 'bread']),
            ],
            [
                'name' => 'Saus & Dressing',
                'description' => 'Pilihan saus untuk menyempurnakan cita rasa hidangan.',
                'selection_type' => 'checkbox',
                'builder_tags' => json_encode(['bowl', 'bread']),
            ],
        ];

        $timestamp = now();
        foreach ($categories as &$category) {
            $category['created_at'] = $timestamp;
            $category['updated_at'] = $timestamp;
        }

        // Insert data ke database
        DB::table('categories_item')->insert($categories);
    }
}
