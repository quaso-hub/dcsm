<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Food;

class SearchController extends Controller
{
    public function suggestions(Request $request)
    {
        $query = $request->get('q', '');

        $results = Food::where('name', 'like', '%' . $query . '%')
            ->limit(10)
            ->pluck('name');

        return response()->json($results);
    }
}
