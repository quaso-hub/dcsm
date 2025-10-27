<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\CategoryFood;
use App\Models\Food;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categoriesTop = CategoryFood::with([
            'foods' => function ($query) {
                $query->where('is_active', 1)->inRandomOrder();
            }
        ])->withCount(['foods as foods_active_count' => function ($query) {
            $query->where('is_active', 1);
        }])
            ->orderByDesc('foods_active_count')
            ->take(2)
            ->get()
            ->map(function ($category) {
                $category->foods = $category->foods->take(3);
                return $category;
            });

        $recommendedFoods = Food::withSum('orderDetails as total_ordered', 'quantity')
            ->whereHas('orderDetails')
            ->orderByDesc('total_ordered')
            ->take(6)
            ->get();

        return view('customer.pages.home', compact('categoriesTop', 'recommendedFoods'));
    }
}
