<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\CategoryFood;
use App\Models\Food;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $categories = CategoryFood::pluck('name')->toArray();

        array_unshift($categories, 'All');

        $active = $request->get('category', 'All');

        $query = Food::where('is_active', 1)->with('categoryFood');

        if ($active !== 'All') {
            $categoryId = CategoryFood::where('name', $active)->value('id');
            $query->where('category_food_id', $categoryId);
        }

        $foods = $query->get();

        return view('customer.pages.menu', compact('categories', 'active', 'foods'));
    }
}
