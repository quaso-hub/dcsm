@extends('admin.layouts.master')
@section('title', 'Food Category Data')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/vendors/datatables.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>Food Categories</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Data</li>
    <li class="breadcrumb-item active">Food Categories</li>
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
    </style>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">
                        <h3>Food Category List</h3>
                        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createModal">
                            <i class="icon-plus"></i> Add Food Category
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Total Foods</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $cat)
                                        <tr>
                                            <td>{{ $cat->name }}</td>
                                            <td>{{ Str::limit($cat->description, 70) }}</td>
                                            <td>{{ $cat->foods_count }}</td>
                                            <td>
                                                <ul class="action">
                                                    <li class="edit">
                                                        <a href="#" class="text-success edit-btn"
                                                            data-bs-toggle="modal" data-bs-target="#editModal"
                                                            data-id="{{ $cat->id }}" data-name="{{ $cat->name }}"
                                                            data-description="{{ $cat->description }}">
                                                            <i class="icon-pencil-alt"></i>
                                                        </a>
                                                    </li>
                                                    <li class="delete">
                                                        <a href="javascript:void(0)" class="text-danger delete-btn"
                                                            data-id="{{ $cat->id }}">
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
    <div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <form id="createForm" class="w-100">
                @csrf
                <div class="modal-content shadow">
                    <div class="modal-header bg-light">
                        <h5 class="modal-title fw-semibold">🍽️ Create Food Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nameInput" class="form-label">Name</label>
                            <input type="text" id="nameInput" name="name" class="form-control"
                                placeholder="e.g. Beverages" required>
                        </div>

                        <div class="mb-3">
                            <label for="descInput" class="form-label">Description</label>
                            <textarea id="descInput" name="description" class="form-control" rows="3" placeholder="Optional description..."></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">💾 Save</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <form id="editForm" class="w-100">
                @csrf
                @method('PUT')
                <div class="modal-content shadow">
                    <div class="modal-header bg-light">
                        <h5 class="modal-title fw-semibold">✏️ Edit Food Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" id="edit-id" name="id">

                        <div class="mb-3">
                            <label for="edit-name" class="form-label">Name</label>
                            <input type="text" id="edit-name" name="name" class="form-control" required placeholder="e.g. Snacks">
                        </div>

                        <div class="mb-3">
                            <label for="edit-description" class="form-label">Description</label>
                            <textarea id="edit-description" name="description" class="form-control" rows="3" placeholder="Optional description..."></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">✅ Update</button>
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

            // Create
            $('#createForm').on('submit', function(e) {
                e.preventDefault();
                $.post("{{ route('categoriesFoods.store') }}", $(this).serialize())
                    .done(res => {
                        sessionStorage.setItem('success', res.message);
                        location.reload();
                    })
                    .fail((err) => alertFail(err.responseJSON.message));
            });

            if (sessionStorage.getItem('success')) {
                alertSuccess(sessionStorage.getItem('success'));
                sessionStorage.removeItem('success');
            }

            // Edit - Show data in modal
            $('.edit-btn').on('click', function() {
                const id = $(this).data('id');
                const name = $(this).data('name');
                const description = $(this).data('description');

                $('#edit-id').val(id);
                $('#edit-name').val(name);
                $('#edit-description').val(description);
            });

            // Update
            $('#editForm').on('submit', function(e) {
                e.preventDefault();
                const id = $('#edit-id').val();
                $.ajax({
                    url: `{{ url('admin/categoriesFoods') }}/${id}`,
                    method: 'POST', // Method override for PUT
                    data: $(this).serialize(),
                    success: function(res) {
                        sessionStorage.setItem('success', res.message);
                        location.reload();
                    },
                    error: (err) => alertFail(err.responseJSON.message)
                });
            });

            // Delete
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
                            url: `{{ url('admin/categoriesFoods') }}/${id}`,
                            method: 'POST',
                            data: {
                                _method: 'DELETE',
                                _token: '{{ csrf_token() }}'
                            },
                            success: (res) => {
                                sessionStorage.setItem('success', res.message);
                                location.reload();
                            },
                            error: (err) => alertFail(err.responseJSON.message)
                        });
                    }
                });
            });
        });
    </script>
@endsection
