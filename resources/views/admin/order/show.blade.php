@extends('admin.layouts.master')
@section('title', 'Order Detail')

@section('breadcrumb-title')
    <h3>Order Detail</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Orders</a></li>
    <li class="breadcrumb-item active">Detail</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">

            {{-- INFO ORDER --}}
            <div class="card mb-3">
                <div class="card-header">
                    <h5>Order #{{ $order->order_number }}</h5>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">Customer</dt>
                        <dd class="col-sm-9">{{ $order->user ? $order->user->first_name . ' ' . $order->user->last_name : 'Guest' }}</dd>

                        <dt class="col-sm-3">Payment</dt>
                        <dd class="col-sm-9">{{ $order->payment->name ?? 'Wallet' }}</dd>

                        <dt class="col-sm-3">Order Type</dt>
                        <dd class="col-sm-9">{{ ucfirst($order->order_type) }}</dd>

                        <dt class="col-sm-3">Status</dt>
                        <dd class="col-sm-9">{{ ucfirst($order->status) }}</dd>

                        <dt class="col-sm-3">Total Amount</dt>
                        <dd class="col-sm-9">Rp. {{ number_format($order->total_amount, 2, ',', '.') }}</dd>

                        <dt class="col-sm-3">Placed At</dt>
                        <dd class="col-sm-9">{{ $order->created_at->format('d M Y, H:i') }}</dd>
                    </dl>
                </div>
            </div>

            {{-- DETAIL ITEMS --}}
            <div class="card">
                <div class="card-header">
                    <h5>Order Items</h5>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th>Food List</th>
                                <th>Quantity</th>
                                <th>Note</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($order->details as $detail)
                                <tr>
                                    <td>{{ $detail->food->name }}</td>
                                    <td>{{ $detail->quantity }}</td>
                                    <td>{{ $detail->note ?? '-' }}</td>
                                    <td>
                                        @if ($detail->options->count())
                                            <ul class="mb-0">
                                                @foreach ($detail->options as $opt)
                                                    <li>{{ $opt->foodItem->name }}</li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <em>None</em>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No items found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <a href="{{ route('myorders.index') }}" class="btn btn-secondary mt-3"><i class="icon-arrow-left"></i> Back to Orders</a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
