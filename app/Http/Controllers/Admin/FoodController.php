<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryFood;
use App\Models\Food;
use App\Models\DefaultFoodsItem;
use App\Models\CategoryItem;
use App\Models\FoodItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class FoodController extends Controller
{

    public function index()
    {
        $categoriesItem = CategoryItem::all();
        $categoriesFood = CategoryFood::all();

        // Ambil semua food + relasinya
        $foods = Food::with([
            'categoriesItem',
            'defaultItems.item.categoryItem',
        ])->get();

        // Ambil semua items + kategori (kalau mau pakai global fallback)
        $allItems = FoodItem::with('categoryItem')->get();

        return view('admin.food.index', compact('foods', 'categoriesItem', 'categoriesFood', 'allItems'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'base_price' => 'required|numeric',
            'description' => 'nullable|string',
            'nutrition_info' => 'nullable|string',
            'category_food_id' => 'required|exists:categories_food,id',
            'category_ids' => 'nullable|array',
            'images' => 'nullable|image|mimes:jpg,jpeg,png|max:5000',
            'is_active' => 'nullable|boolean'
        ]);

        $food = Food::create([
            'category_food_id' => $request->category_food_id,
            'name' => $validated['name'],
            'base_price' => $validated['base_price'],
            'description' => $validated['description'] ?? null,
            'nutrition_info' => $validated['nutrition_info'] ?? null,
            'is_active' => $request->has('is_active'),
        ]);

        $food->categoriesItem()->sync($request->input('category_ids', []));

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = Str::slug($food->name) . '-' . $food->id . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('foods', $filename, 'public');
            $food->update(['image_path' => $path]);
        }

        return response()->json([
            'message' => 'Food created successfully.',
            'data' => $food->fresh()
        ]);
    }

    public function update(Request $request, Food $food)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'base_price' => 'required|numeric',
            'description' => 'nullable|string',
            'nutrition_info' => 'nullable|string',
            'category_food_id' => 'required|exists:categories_food,id',
            'category_ids' => 'nullable|array',
            'images' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'is_active' => 'nullable|boolean'
        ]);

        $food->update([
            'category_food_id' => $request->category_food_id,
            'name' => $validated['name'],
            'base_price' => $validated['base_price'],
            'description' => $validated['description'] ?? null,
            'nutrition_info' => $validated['nutrition_info'] ?? null,
            'is_active' => $request->has('is_active'),
        ]);

        $food->categoriesItem()->sync($request->input('category_ids', []));

        if ($request->hasFile('image')) {
            if ($food->image_path && Storage::disk('public')->exists($food->image_path)) {
                Storage::disk('public')->delete($food->image_path);
            }

            $file = $request->file('image');
            $filename = Str::slug($food->name) . '-' . $food->id . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('foods', $filename, 'public');
            $food->update(['image_path' => $path]);
        }

        return response()->json([
            'message' => 'Food updated successfully.',
            'data' => $food->fresh()
        ]);
    }

    public function destroy(Food $food)
    {
        if ($food->image_path && Storage::disk('public')->exists($food->image_path)) {
            Storage::disk('public')->delete($food->image_path);
        }

        $food->categoriesItem()->detach();
        $food->delete();

        return response()->json(['message' => 'Food deleted successfully']);
    }

    public function deleteImage(Food $food)
    {
        if (!$food->image_path) {
            return response()->json([
                'message' => 'Food does not have an image to delete.'
            ], 404);
        }

        try {
            // Hapus file dari storage
            if (Storage::disk('public')->exists($food->image_path)) {
                Storage::disk('public')->delete($food->image_path);
            }

            // Update kolom di database menjadi null
            $food->image_path = null;
            $food->save();

            return response()->json([
                'message' => 'Image has been successfully deleted.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete the image.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function storeDefaultItem(Request $request)
    {
        $request->validate([
            'food_id' => 'required|exists:foods,id',
            'food_item_id' => 'required|exists:foods_items,id',
        ]);

        $exists = DefaultFoodsItem::where('food_id', $request->food_id)
            ->where('food_item_id', $request->food_item_id)
            ->exists();

        if (!$exists) {
            DefaultFoodsItem::create([
                'food_id' => $request->food_id,
                'food_item_id' => $request->food_item_id,
            ]);
        }

        return back()->with('foods_success', 'Default item ditambahkan');
    }

    public function destroyDefaultItem($id)
    {
        $defaultItem = DefaultFoodsItem::findOrFail($id);
        $defaultItem->delete();

        return back()->with('foods_success', 'Default item berhasil dihapus.');
    }
}
