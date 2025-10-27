<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Wallet;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $wallet = $user->wallet;

        if (!$wallet) {
            $wallet = Wallet::create([
                'user_id' => $user->id,
                'balance' => 0,
            ]);
        }

        $transactions = $wallet->transactions()->latest()->take(10)->get();

        $history = $wallet->transactions()->latest()->get();

        $incomeTotal = $wallet->transactions()
            ->where('type', 'in')
            ->sum('amount');

        $expenseTotal = $wallet->transactions()
            ->where('type', 'out')
            ->sum('amount');

        $monthlyData = $wallet->transactions()
            ->selectRaw('DATE_FORMAT(date, "%Y-%m") as month, type, SUM(amount) as total')
            ->groupBy('month', 'type')
            ->orderBy('month')
            ->get();

        $payments = Payment::all()->where('is_active', 1);

        return view('Customer.pages.wallet', compact(
            'wallet',
            'transactions',
            'history',
            'incomeTotal',
            'expenseTotal',
            'monthlyData',
            'payments'
        ));
    }

    public function topup(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1000',
            'payment_method' => 'required|exists:payments,id',
        ]);

        $user = auth()->user();
        $wallet = $user->wallet;

        DB::transaction(function () use ($wallet, $request) {
            $wallet->increment('balance', $request->amount);

            $wallet->transactions()->create([
                'type' => 'in',
                'label' => 'Top Up via ' . Payment::find($request->payment_method)->name,
                'amount' => $request->amount,
                'date' => now()->toDateString(),
            ]);
        });

        return redirect()->back()->with('success', 'Top up berhasil.');
    }
}
