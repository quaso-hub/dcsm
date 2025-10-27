<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalOrders = Order::count();
        $totalSales = Order::where('status', 'completed')->sum('total_amount');
        $ordersThisWeek = Order::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $avgOrderValue = Order::where('status', 'completed')->avg('total_amount');
        $recentOrders = Order::latest()->take(5)->with('user')->get();

        $orderStats = Order::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->get()
            ->groupBy(function ($item) {
                return Carbon::parse($item->created_at)->format('l');
            });

        $orderDays = [];
        $orderCounts = [];

        foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day) {
            $orderDays[] = $day;
            $orderCounts[] = isset($orderStats[$day]) ? $orderStats[$day]->count() : 0;
        }

        return view('admin.index', compact(
            'totalUsers',
            'totalOrders',
            'totalSales',
            'ordersThisWeek',
            'pendingOrders',
            'avgOrderValue',
            'recentOrders',
            'orderDays',
            'orderCounts'
        ));
    }
}
