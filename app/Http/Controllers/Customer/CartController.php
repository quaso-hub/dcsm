<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Food;
use App\Models\FoodItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CartController extends Controller
{

    public function index()
    {
        $cartItems = CartItem::with('food')->where('user_id', auth()->id())->get();

        $subtotal = $cartItems->sum(fn($item) => ($item->base_price + $item->addons_total_price) * $item->quantity);
        $totalQty = $cartItems->count(); // Total qty semua item di cart

        session(['cart_total_qty' => $totalQty]); // Simpan ke session

        return view('Customer.pages.cart', [
            'cart' => $cartItems,
            'baseTotal' => $subtotal,
            'tax' => $subtotal * 0.11,
            'fee' => 5000,
        ]);
    }


    public function store(Request $request)
    {
        // 1. Validasi input dari frontend
        $request->validate([
            'food_id' => 'required|exists:foods,id',
            'qty' => 'required|integer|min:1',
            'customizations' => 'nullable|array', // Kustomisasi adalah array dari ID food_item
            'customizations.*' => 'exists:foods_items,id', // Validasi setiap ID di dalam array
        ]);

        try {
            DB::beginTransaction();

            $food = Food::findOrFail($request->food_id);
            $addons_total_price = 0;
            $customizations_details = [];

            // 2. Hitung total harga addon dan siapkan detailnya untuk disimpan di JSON
            if ($request->has('customizations') && !empty($request->customizations)) {
                $addon_ids = $request->customizations;
                $addons = FoodItem::whereIn('id', $addon_ids)->get();

                foreach ($addons as $addon) {
                    $addons_total_price += $addon->extra_price;
                    $customizations_details[] = [
                        'id' => $addon->id,
                        'name' => $addon->name,
                        'extra_price' => $addon->extra_price,
                        'category' => $addon->categoryItem->name, // Ambil nama kategori addon
                    ];
                }
            }

            // 3. Cek apakah item yang SAMA PERSIS (produk + kustomisasi) sudah ada di cart
            $existing_cart_item = CartItem::where('user_id', auth()->id())
                ->where('food_id', $food->id)
                // Pengecekan JSON bisa jadi rumit, untuk kecepatan kita anggap jika kustomisasinya
                // berbeda maka akan jadi item baru di cart. Ini sudah cukup baik.
                // Untuk perbandingan JSON yang akurat, perlu cara yang lebih advanced.
                // Untuk sekarang kita sederhanakan: kita cari berdasarkan food_id & total harga addon.
                ->where('addons_total_price', $addons_total_price)
                ->first();

            if ($existing_cart_item) {
                // 4. JIKA SUDAH ADA: Cukup update kuantitasnya
                $existing_cart_item->quantity += $request->qty;
                $existing_cart_item->save();
            } else {
                // 5. JIKA BELUM ADA: Buat item baru di cart
                CartItem::create([
                    'user_id' => auth()->id(),
                    'food_id' => $food->id,
                    'quantity' => $request->qty,
                    'base_price' => $food->base_price,
                    'addons_total_price' => $addons_total_price,
                    'customizations' => $customizations_details,
                ]);
            }

            DB::commit();

            $totalQty = CartItem::where('user_id', auth()->id())->count();
            session(['cart_total_qty' => $totalQty]);

            return response()->json([
                'message' => 'Produk berhasil ditambahkan ke keranjang!',
                'cart_total_qty' => $totalQty
            ]);

            // return response()->json(['message' => 'Produk berhasil ditambahkan ke keranjang!']);
        } catch (\Exception $e) {
            DB::rollBack();
            // Kirim response error yang lebih informatif
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }


    // Tambah atau kurang qty
    public function update(Request $request)
    {
        $request->validate(['cart_item_id' => 'required|exists:cart_items,id', 'action' => 'required|in:increment,decrement']);
        $item = CartItem::where('id', $request->cart_item_id)->where('user_id', auth()->id())->firstOrFail();

        if ($request->action === 'increment') $item->quantity++;
        else $item->quantity--;

        if ($item->quantity <= 0) {
            $item->delete();
            $data = $this->getCartTotals();
            $data['status'] = 'deleted';
            $data['cart_is_empty'] = CartItem::where('user_id', auth()->id())->count() === 0;
            return response()->json($data);
        }

        $item->save();
        $data = $this->getCartTotals();
        $data['status'] = 'updated';
        $data['new_quantity'] = $item->quantity;
        $data['item_total_price'] = ($item->base_price + $item->addons_total_price) * $item->quantity;


        $totalQty = CartItem::where('user_id', auth()->id())->count();
        session(['cart_total_qty' => $totalQty]);
        $data['cart_total_qty'] = $totalQty;
        return response()->json($data);
    }

    // Ganti method remove yang lama dengan ini
    public function remove(Request $request)
    {
        $request->validate(['cart_item_id' => 'required|exists:cart_items,id']);
        CartItem::where('id', $request->cart_item_id)->where('user_id', auth()->id())->delete();

        $data = $this->getCartTotals();
        $data['status'] = 'success';
        $data['cart_is_empty'] = CartItem::where('user_id', auth()->id())->count() === 0;


        $totalQty = CartItem::where('user_id', auth()->id())->count();
        session(['cart_total_qty' => $totalQty]);
        $data['cart_total_qty'] = $totalQty;
        return response()->json($data);
    }

    // Tambahkan method helper baru ini di dalam CartController
    private function getCartTotals()
    {
        $cartItems = CartItem::where('user_id', auth()->id())->get();
        $subtotal = $cartItems->sum(fn($item) => ($item->base_price + $item->addons_total_price) * $item->quantity);
        $tax = $subtotal * 0.11;
        $serviceFee = 5000;
        $grandTotal = $subtotal + $tax + $serviceFee;
        return [
            'subtotal' => $subtotal,
            'tax' => $tax,
            'service_fee' => $serviceFee,
            'grand_total' => $grandTotal,
        ];
    }

    /**
     * Clear semua cart milik user.
     */
    public function clear()
    {
        CartItem::where('user_id', auth()->id())->delete();
        session(['cart_total_qty' => 0]); // Reset badge cart
        return back()->with('status', 'Keranjang berhasil dikosongkan.');
    }

    public function saveMeta(Request $request)
    {
        session([
            'order_mode' => $request->input('mode', 'dine'),
            'order_place' => $request->input('place', null),
        ]);

        return response()->json(['status' => 'ok']);
    }

    public function clearMeta()
    {
        session()->forget(['order_mode', 'order_place']);
        return response()->json(['status' => 'cleared']);
    }

    public function getQty()
    {
        $totalQty = CartItem::where('user_id', auth()->id())->sum('quantity');
        return response()->json(['qty' => $totalQty]);
    }
}
