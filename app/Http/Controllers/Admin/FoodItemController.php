<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryItem;
use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\FoodItem;

class FoodItemController extends Controller
{
    public function index()
    {
        $categoriesItem = CategoryItem::all();
        $foodItems = FoodItem::with('categoryItem')->latest()->get();

        return view('admin.food_items.index', compact('categoriesItem', 'foodItems'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'extra_price' => 'required|numeric',
            'category_item_id' => 'required|exists:categories_item,id',
            'is_active' => 'nullable|boolean',
        ]);

        $foodItem = FoodItem::create([
            'name' => $request->name,
            'extra_price' => $request->extra_price,
            'category_item_id' => $request->category_item_id,
            'is_active' => $request->has('is_active'),
        ]);

        // if ($request->has('is_default')) {
        //     $food = Food::find($request->food_id);
        //     $food->defaultFoodItems()->syncWithoutDetaching([$foodItem->id]);
        // }

        return response()->json(['message' => 'Food item created successfully']);
    }

    public function update(Request $request, FoodItem $foodItem)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'extra_price' => 'required|numeric',
            'category_item_id' => 'required|exists:categories_item,id',
            'is_active' => 'nullable|boolean',
        ]);

        $foodItem->update([
            'name' => $request->name,
            'extra_price' => $request->extra_price,
            'category_item_id' => $request->category_item_id,
            'is_active' => $request->has('is_active'),
        ]);

        // if ($request->has('is_default')) {
        //     $food = Food::find($request->food_id);
        //     $food->defaultFoodItems()->syncWithoutDetaching([$foodItem->id]);
        // } else {
        //     $food = Food::find($request->food_id);
        //     $food->defaultFoodItems()->detach($foodItem->id);
        // }

        return response()->json(['message' => 'Food item updated successfully']);
    }

    public function destroy(FoodItem $foodItem)
    {
        $foodItem->delete();

        return response()->json(['message' => 'Food item deleted successfully']);
    }
}
