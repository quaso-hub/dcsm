<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $orders = Order::with(['details.food', 'payment'])
            ->where('user_id', $userId)
            ->orderByDesc('created_at')
            ->get();

        $proses = $orders->filter(fn($order) => in_array($order->status, ['pending', 'processing']));
        $selesai = $orders->filter(fn($order) => in_array($order->status, ['completed', 'cancelled']));

        return view('Customer.pages.orders', compact('proses', 'selesai'));
    }

    public function show($orderNumber)
    {
        $order = Order::with(['details.food', 'payment'])
            ->where('user_id', auth()->id())
            ->where('order_number', $orderNumber)
            ->firstOrFail();

        return response()->json([
            'id' => $order->order_number,
            'created_at' => $order->created_at->format('d M Y, H:i'),
            'payment' => $order->payment->name ?? '-',
            'note' => $order->details->first()->note ?? '-',
            'items' => $order->details->map(fn($d) => $d->food->name . ' x' . $d->quantity),
            'total' => number_format($order->total_amount, 0, ',', '.'),
            'status' => ucfirst($order->status),
        ]);
    }
}
