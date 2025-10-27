<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\CategoryFood;
use App\Models\Food;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua kategori
        $categories = CategoryFood::all();

        // Ambil query param nama kategori
        $selectedName = $request->query('name', 'All Categories');

        // Cari kategori berdasarkan nama
        $selectedCategory = $categories->firstWhere('name', $selectedName);

        // Query food
        $foodsQuery = Food::with('categoryFood')
            ->where('is_active', true);

        // Filter jika bukan All Categories dan nama kategori valid
        if ($selectedName !== 'All Categories' && $selectedCategory) {
            $foodsQuery->where('category_food_id', $selectedCategory->id);
        }

        $foods = $foodsQuery->get();

        return view('Customer.pages.categories', compact('categories', 'foods', 'selectedName'));
    }
}
