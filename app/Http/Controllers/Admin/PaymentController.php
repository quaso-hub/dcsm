<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::latest()->get();
        return view('admin.payment.index', compact('payments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:payments,name',
            'description' => 'nullable|string',
            // 'is_active' => 'boolean',
        ]);

        // $validated['is_active'] = $request->has('is_active');

        $payment = Payment::create($validated);

        return response()->json(['message' => 'Payment method created successfully.', 'data' => $payment]);
    }

    public function update(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:payments,name,' . $payment->id,
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $payment->update($validated);

        return response()->json(['message' => 'Payment method updated successfully.', 'data' => $payment]);
    }

    public function destroy(Payment $payment)
    {
        if ($payment->order()->count() > 0) {
            return response()->json(['message' => 'Cannot delete. This method is used in orders.'], 422);
        }

        $payment->delete();

        return response()->json(['message' => 'Payment method deleted successfully.']);
    }
}
