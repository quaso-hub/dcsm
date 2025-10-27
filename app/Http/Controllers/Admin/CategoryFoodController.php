<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryFood;
use Illuminate\Http\Request;

class CategoryFoodController extends Controller
{
    /**
     * Menampilkan daftar semua kategori makanan.
     */
    public function index()
    {
        $categories = CategoryFood::withCount('foods')->get();
        return view('admin.category_food.index', compact('categories'));
    }

    /**
     * Menyimpan kategori makanan baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories_food,name',
            'description' => 'nullable|string',
        ]);

        $category = CategoryFood::create($validated);

        return response()->json([
            'message' => 'Food Category created successfully.',
            'data' => $category
        ]);
    }

    /**
     * Memperbarui kategori makanan yang sudah ada.
     */
    public function update(Request $request, CategoryFood $categoriesFood)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories_food,name,' . $categoriesFood->id,
            'description' => 'nullable|string',
        ]);

        $categoriesFood->update($validated);

        return response()->json([
            'message' => 'Food Category updated successfully.',
            'data' => $categoriesFood
        ]);
    }

    /**
     * Menghapus kategori makanan.
     */
    public function destroy(CategoryFood $categoriesFood)
    {

        if ($categoriesFood->foods()->count() > 0) {
            return response()->json([
                'message' => 'Cannot delete. This category still has associated foods.'
            ], 422);
        }

        $categoriesFood->delete();

        return response()->json([
            'message' => 'Food Category deleted successfully.'
        ]);
    }
}
