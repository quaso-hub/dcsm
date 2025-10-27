<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryFoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Kosongkan tabel untuk mencegah duplikasi
        DB::table('categories_food')->delete();

        $categories = [
            [
                'name' => 'Main Courses',
                'description' => 'Hidangan utama yang mengenyangkan dan penuh nutrisi.',
            ],
            [
                'name' => 'Signature Bowls',
                'description' => 'Pilihan bowl dengan resep andalan dari chef kami.',
            ],
            [
                'name' => 'Healthy Salads',
                'description' => 'Salad segar dengan berbagai pilihan dressing sehat.',
            ],
            [
                'name' => 'Burgers & Sandwiches',
                'description' => 'Pilihan burger dan sandwich dengan roti gandum dan isian berkualitas.',
            ],
            [
                'name' => 'Build Your Own',
                'description' => 'Menu kustomisasi di mana kamu bisa merakit sendiri hidanganmu.',
            ],
            [
                'name' => 'Snacks & Sides',
                'description' => 'Camilan dan hidangan pendamping yang sehat.',
            ],
            [
                'name' => 'Fresh Juices & Drinks',
                'description' => 'Minuman segar yang dibuat dari buah dan sayuran asli.',
            ],
        ];

        // Tambahkan timestamp
        $timestamp = now();
        foreach ($categories as &$category) {
            $category['created_at'] = $timestamp;
            $category['updated_at'] = $timestamp;
        }

        // Insert data ke database
        DB::table('categories_food')->insert($categories);
    }
}
