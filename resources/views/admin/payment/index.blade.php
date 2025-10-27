@extends('admin.layouts.master')
@section('title', 'Payment Methods')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/vendors/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendors/switchery.min.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>Payment Methods</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Data</li>
    <li class="breadcrumb-item active">Payment Methods</li>
@endsection

@section('content')
    <style>
        .action li {
            display: inline-block;
            margin-right: 8px;
        }

        .action li:last-child {
            margin-right: 0;
        }

        .modal-dialog {
            max-width: 740px;
            width: 95%;
            margin: auto;
        }
        .modal-content {
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 10px 60px rgba(0, 0, 0, 0.2);
        }

        .modal.show .modal-dialog {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
    </style>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">
                        <h3>Payment Method List</h3>
                        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createModal">
                            <i class="icon-plus"></i> Add Method
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($payments as $payment)
                                        <tr>
                                            <td>{{ $payment->name }}</td>
                                            <td>{{ Str::limit($payment->description, 70) }}</td>
                                            <td>
                                                <span
                                                    class="badge {{ $payment->is_active ? 'badge-light-success' : 'badge-light-danger' }}">
                                                    {{ $payment->is_active ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>
                                            <td>
                                                <ul class="action">
                                                    <li class="edit">
                                                        <a href="#" class="text-success edit-btn"
                                                            data-bs-toggle="modal" data-bs-target="#editModal"
                                                            data-id="{{ $payment->id }}"
                                                            data-json='@json($payment)'>
                                                            <i class="icon-pencil-alt"></i>
                                                        </a>
                                                    </li>
                                                    <li class="delete">
                                                        <a href="javascript:void(0)" class="text-danger delete-btn"
                                                            data-id="{{ $payment->id }}">
                                                            <i class="icon-trash"></i>
                                                        </a>
                                                    </li>
                                                </ul>
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

    <!-- Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form id="createForm">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create Payment Method</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1" checked>
                            <label class="form-check-label">Active</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <form id="editForm">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Payment Method</h5><button type="button" class="btn-close"
                            data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="edit-id" name="id">
                        <div class="mb-3"><label class="form-label">Name</label><input type="text" id="edit-name"
                                name="name" class="form-control" required></div>
                        <div class="mb-3"><label class="form-label">Description</label>
                            <textarea id="edit-description" name="description" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="form-check form-switch"><input class="form-check-input" type="checkbox"
                                id="edit-is_active" name="is_active" value="1"><label
                                class="form-check-label">Active</label></div>
                    </div>
                    <div class="modal-footer"><button type="submit" class="btn btn-success">Update</button><button
                            type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button></div>
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
            const alertSuccess = (msg) => Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: msg,
                timer: 2000,
                showConfirmButton: false
            });
            const alertFail = (msg = 'Something went wrong') => Swal.fire({
                icon: 'error',
                title: 'Failed!',
                text: msg
            });

            $('#createForm').on('submit', function(e) {
                e.preventDefault();
                $.post("{{ route('payments.store') }}", $(this).serialize())
                    .done(res => {
                        sessionStorage.setItem('success', res.message);
                        location.reload();
                    })
                    .fail((err) => alertFail("Failed To Create"));
            });

            if (sessionStorage.getItem('success')) {
                alertSuccess(sessionStorage.getItem('success'));
                sessionStorage.removeItem('success');
            }

            $('.edit-btn').on('click', function() {
                const data = $(this).data('json');
                $('#edit-id').val(data.id);
                $('#edit-name').val(data.name);
                $('#edit-description').val(data.description);
                $('#edit-is_active').prop('checked', data.is_active);
            });

            $('#editForm').on('submit', function(e) {
                e.preventDefault();
                const id = $('#edit-id').val();
                $.ajax({
                    url: `{{ url('admin/payments') }}/${id}`,
                    method: 'POST',
                    data: $(this).serialize(),
                    success: (res) => {
                        sessionStorage.setItem('success', res.message);
                        location.reload();
                    },
                    error: (err) => alertFail("Failed To Edit")
                });
            });

            $('.delete-btn').on('click', function() {
                const id = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This action can't be undone.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `{{ url('admin/payments') }}/${id}`,
                            method: 'POST',
                            data: {
                                _method: 'DELETE',
                                _token: '{{ csrf_token() }}'
                            },
                            success: (res) => {
                                sessionStorage.setItem('success', res.message);
                                location.reload();
                            },
                            error: (err) => alertFail("Failed To Delete")
                        });
                    }
                });
            });
        });

        $('#createModal').on('shown.bs.modal', function() {
            $(this).find('input[name="name"]').trigger('focus');
        });

        $('#editModal').on('shown.bs.modal', function() {
            $(this).find('input[name="name"]').trigger('focus');
        });
    </script>
@endsection
