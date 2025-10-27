<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\CategoryItem;
use App\Models\Food;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function getDetails($id)
    {
        try {
            $food = Food::findOrFail($id);

            $categories = null;
            $defaultItemIds = [];

            if ($food->category_food_id == 5) {

                // build your own
                $foodNameLower = strtolower($food->name);
                $builderType = null;

                // Tentukan tipe builder spesifik (bowl, bread, dll) dari nama produknya
                if (str_contains($foodNameLower, 'bowl')) {
                    $builderType = 'bowl';
                } elseif (str_contains($foodNameLower, 'sandwich') || str_contains($foodNameLower, 'bread')) {
                    $builderType = 'bread';
                }

                // Jika tipe builder berhasil diidentifikasi, ambil kategori item yang sesuai
                if ($builderType) {
                    $categories = CategoryItem::with('foodItems')
                        ->whereJsonContains('builder_tags', $builderType)
                        ->get();
                }

                // Builder tidak punya item default
                $defaultItemIds = [];
            } else {
                // default
                $food->load('categoriesItem.foodItems', 'defaultItems');
                $categories = $food->categoriesItem;
                $defaultItemIds = $food->defaultItems->pluck('food_item_id')->toArray();
            }

            // 3. Format response JSON
            $options = [];
            if ($categories) {
                foreach ($categories as $category) {
                    $options[] = [
                        'category_name' => $category->name,
                        'selection_type' => $category->selection_type,
                        'items' => $category->foodItems->map(function ($item) {
                            return [
                                'id' => $item->id,
                                'name' => $item->name,
                                'extra_price' => $item->extra_price,
                            ];
                        })
                    ];
                }
            }

            $response = [
                'id' => $food->id,
                'name' => $food->name,
                'base_price' => $food->base_price,
                'image_path' => asset('storage/' . $food->image_path),
                'options' => $options,
                'default_ids' => $defaultItemIds,
            ];

            return response()->json($response);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Food not found'], 404);
        }
    }
}
