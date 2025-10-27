@extends('admin.layouts.master')
@section('title', 'Orders Data')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/vendors/datatables.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>Orders</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Data</li>
    <li class="breadcrumb-item active">Orders</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">
                        <h3>Order List</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
                                        <th>Order Number</th>
                                        <th>User</th>
                                        <th>Payment</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>#{{ $order->order_number }}</td>
                                            <td>{{ $order->user ? $order->user->first_name . ' ' . $order->user->last_name : 'Guest' }}
                                            </td>
                                            <td>{{ $order->payment->name ?? 'Wallet' }}</td>
                                            <td><span
                                                    class="badge badge-light-info">{{ ucfirst($order->order_type) }}</span>
                                            </td>
                                            <td>
                                                @php
                                                    $statusClass = '';
                                                    switch ($order->status) {
                                                        case 'pending':
                                                            $statusClass = 'badge-light-warning';
                                                            break;
                                                        case 'processing':
                                                            $statusClass = 'badge-light-primary';
                                                            break;
                                                        case 'completed':
                                                            $statusClass = 'badge-light-success';
                                                            break;
                                                        case 'cancelled':
                                                            $statusClass = 'badge-light-danger';
                                                            break;
                                                    }
                                                @endphp
                                                <a href="javascript:void(0)"
                                                    class="badge {{ $statusClass }} update-status-btn"
                                                    data-id="{{ $order->id }}" data-status="{{ $order->status }}">
                                                    {{ ucfirst($order->status) }}
                                                </a>
                                            </td>
                                            <td>Rp{{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                            <td>{{ $order->created_at->format('d M Y, H:i') }}</td>
                                            <td>
                                                <a href="{{ route('orders.show', $order->id) }}" class="text-info">
                                                    <i class="icon-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Status Modal -->
    <div class="modal fade" id="statusModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form id="statusForm">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Order Status</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p>Order Number: <strong id="orderNumber"></strong></p>
                        <div class="mb-3">
                            <label class="form-label">New Status</label>
                            <select name="status" id="statusSelect" class="form-select" required>
                                <option value="pending">Pending</option>
                                <option value="processing">Processing</option>
                                <option value="completed">Completed</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update Status</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>
    <script>
        $(function() {
            const statusModal = new bootstrap.Modal('#statusModal');

            // Event listener untuk tombol/badge status
            $('.update-status-btn').on('click', function() {
                const orderId = $(this).data('id');
                const currentStatus = $(this).data('status');
                const orderNumber = $(this).closest('tr').find('td:first').text();

                // Set action form dan nilai di dalam modal
                $('#statusForm').attr('action', `{{ url('admin/orders') }}/${orderId}`);
                $('#orderNumber').text(orderNumber);
                $('#statusSelect').val(currentStatus);

                statusModal.show();
            });

            // Event listener untuk submit form update status
            $('#statusForm').on('submit', function(e) {
                e.preventDefault();
                const form = $(this);
                const url = form.attr('action');

                $.ajax({
                    url: url,
                    method: 'POST', // Method override untuk PUT
                    data: form.serialize(),
                    success: function(res) {
                        statusModal.hide();
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: res.message,
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => location.reload());
                    },
                    error: function(err) {
                        Swal.fire('Failed!', 'Could not update status.', 'error');
                    }
                });
            });
        });
    </script>
@endsection
