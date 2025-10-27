<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryItem;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; // [PENTING] Tambahkan ini untuk validasi

class CategoryItemController extends Controller
{
    public function index()
    {
        $categories = CategoryItem::with('foodItems')->get();
        return view('admin.category_item.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'selection_type' => ['required', Rule::in(['radio', 'checkbox'])],
            'builder_tags' => 'nullable|array',
            'builder_tags.*' => 'string',
        ]);

        // Jika builder_tags tidak ada di request, set jadi array kosong agar konsisten
        $validated['builder_tags'] = $validated['builder_tags'] ?? [];

        $category = CategoryItem::create($validated);

        return response()->json([
            'message' => 'Category created successfully.',
            'data' => $category
        ]);
    }

    public function update(Request $request, CategoryItem $categoriesItem)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'selection_type' => ['required', Rule::in(['radio', 'checkbox'])],
            'builder_tags' => 'nullable|array',
            'builder_tags.*' => 'string',
        ]);

        // Jika builder_tags tidak ada di request, set jadi array kosong agar konsisten
        $validated['builder_tags'] = $validated['builder_tags'] ?? [];

        $categoriesItem->update($validated);


        return response()->json([
            'message' => 'Category updated successfully.',
            'data' => $categoriesItem
        ]);
    }

    public function destroy(CategoryItem $categoriesItem)
    {
        $categoriesItem->delete();

        return response()->json([
            'message' => 'Category deleted successfully.'
        ]);
    }
}
