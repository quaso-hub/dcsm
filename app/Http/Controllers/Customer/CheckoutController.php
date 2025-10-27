<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderDetailOption;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CheckoutController extends Controller
{
    public function index()
    {
        if (!session()->has('order_mode')) {
            return redirect()->route('cart.index')->with('error', 'Pilih mode pesanan dulu.');
        }

        $userId = auth()->id();
        $cartItems = CartItem::with('food')->where('user_id', $userId)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong.');
        }

        $subtotal = $cartItems->sum(fn($item) => ($item->base_price + $item->addons_total_price) * $item->quantity);
        $tax = round($subtotal * 0.11);
        $fee = 5000;
        $total = $subtotal + $tax + $fee;

        // Ambil dari session cart
        $mode = session('order_mode');
        $place = session('order_place');
        $walletBalance = auth()->user()->wallet->balance;

        // Optional: ambil metode pembayaran dari DB
        $paymentMethods = Payment::all()->where('is_active', 1);;

        return view('Customer.pages.checkout', compact(
            'cartItems',
            'subtotal',
            'tax',
            'fee',
            'total',
            'mode',
            'place',
            'walletBalance',
            'paymentMethods'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'payment_method' => 'required',
            'note' => 'nullable|string',
        ]);

        if (!session()->has('order_mode')) {
            return response()->json(['message' => 'Session order tidak ditemukan.'], 400);
        }

        try {
            DB::beginTransaction();

            $user = auth()->user();
            $userId = $user->id;
            $cartItems = CartItem::where('user_id', $userId)->get();

            if ($cartItems->isEmpty()) {
                return response()->json(['message' => 'Keranjang kosong.'], 400);
            }

            $subtotal = $cartItems->sum(fn($item) => ($item->base_price + $item->addons_total_price) * $item->quantity);
            $tax = $subtotal * 0.11;
            $fee = 5000;
            $total = $subtotal + $tax + $fee;

            // Wallet check
            if ($request->payment_method === 'wallet') {
                $wallet = $user->wallet;

                if (!$wallet || $wallet->balance < $total) {
                    throw ValidationException::withMessages([
                        'payment_method' => 'Saldo wallet tidak mencukupi.',
                    ]);
                }

                $wallet->decrement('balance', $total);

                $wallet->transactions()->create([
                    'type' => 'out',
                    'label' => 'Pembayaran Pesanan',
                    'amount' => $total,
                    'date' => now()->toDateString(),
                ]);
            }

            $order = Order::create([
                'user_id' => $userId,
                'order_type' => session('order_mode') === 'dine' ? 'dine-in' : 'take-away',
                'total_amount' => $total,
                'status' => 'pending',
                'payment_id' => $request->payment_method === 'wallet' ? null : $request->payment_method,
            ]);

            foreach ($cartItems as $item) {
                $detail = OrderDetail::create([
                    'order_id' => $order->id,
                    'food_id' => $item->food_id,
                    'quantity' => $item->quantity,
                    'note' => $request->note,
                ]);

                if (!empty($item->customizations)) {
                    foreach ($item->customizations as $custom) {
                        OrderDetailOption::create([
                            'order_detail_id' => $detail->id,
                            'food_item_id' => $custom['id'],
                        ]);
                    }
                }
            }

            CartItem::where('user_id', $userId)->delete();
            DB::commit();

            return response()->json(['message' => 'Order berhasil disimpan', 'order_id' => $order->id]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Gagal Checkout'], 500);
        }
    }
}
