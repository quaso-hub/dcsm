@extends('admin.layouts.master')
@section('title', 'Food Items Data')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/vendors/datatables.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>Food Items</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Data</li>
    <li class="breadcrumb-item active">Food Items</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">
                        <h3>All Food Items</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createItemModal">
                                <i class="icon-plus"></i> Add Item
                            </button>
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Price Addon</th>
                                        <th>Category Item</th>
                                        <th>Active</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($foodItems as $item)
                                        <tr id="item-row-{{ $item->id }}">
                                            <td>{{ $item->name }}</td>
                                            <td>Rp {{ number_format($item->extra_price, 0, ',', '.') }}</td>
                                            <td>
                                                <span
                                                    class="badge badge-light-primary">{{ $item->categoryItem->name ?? 'N/A' }}</span>
                                            </td>
                                            <td>
                                                @if ($item->is_active)
                                                    <span class="badge badge-light-success">Yes</span>
                                                @else
                                                    <span class="badge badge-light-danger">No</span>
                                                @endif
                                            </td>
                                            <td>
                                                <ul class="action">
                                                    <li class="edit">
                                                        <a href="javascript:void(0)" class="text-success edit-item-btn"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editItemModal{{ $item->id }}"
                                                            data-id="{{ $item->id }}"
                                                            data-json='@json($item)'>
                                                            <i class="icon-pencil-alt"></i>
                                                        </a>
                                                    </li>
                                                    <li class="delete">
                                                        <a href="javascript:void(0)" class="text-danger delete-item"
                                                            data-id="{{ $item->id }}">
                                                            <i class="icon-trash"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>

                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="editItemModal{{ $item->id }}" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <form class="edit-item-form" data-id="{{ $item->id }}">
                                                    @csrf
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Item: {{ $item->name }}</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label class="form-label">Name</label>
                                                                <input type="text" name="name" class="form-control"
                                                                    value="{{ $item->name }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Extra Price</label>
                                                                <input type="number" step="1" name="extra_price"
                                                                    class="form-control" value="{{ $item->extra_price }}"
                                                                    required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Category</label>
                                                                <select name="category_item_id" class="form-select"
                                                                    required>
                                                                    <option value="">-- Select Category --</option>
                                                                    @foreach ($categoriesItem as $category)
                                                                        <option value="{{ $category->id }}"
                                                                            {{ $item->category_item_id == $category->id ? 'selected' : '' }}>
                                                                            {{ $category->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-check mb-3">
                                                                <label class="form-check-label">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="is_active" value="1"
                                                                        {{ $item->is_active ? 'checked' : '' }}>Active</label>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success">Update</button>
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Cancel</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
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
    <div class="modal fade" id="createItemModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <form id="createFoodItemForm">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Create Food Item</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Extra Price</label>
                            <input type="number" step="1" name="extra_price" class="form-control" value="0" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <select name="category_item_id" class="form-select" required>
                                <option value="">-- Select Category --</option>
                                @foreach ($categoriesItem as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="isActiveCheck" checked>
                            <label class="form-check-label" for="isActiveCheck">
                                Active
                            </label>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Create</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection


@section('script')
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>

    {{-- SweetAlert2 script tidak perlu diubah --}}

    <script>
        $(document).ready(function() {
            const storeUrl = "{{ route('food-items.store') }}";
            const updateUrl = "{{ route('food-items.update', ':id') }}";
            const deleteUrl = "{{ route('food-items.destroy', ':id') }}";

            // Create
            $('#createFoodItemForm').on('submit', function(e) {
                e.preventDefault();
                $.post(storeUrl, $(this).serialize())
                    .done(res => {
                        sessionStorage.setItem('food_items_success', res.message);
                        location.reload();
                    })
                    .fail((err) => {
                        let errorMsg = 'Create failed. Please check your input.';
                        if (err.responseJSON && err.responseJSON.message) {
                            errorMsg = err.responseJSON.message;
                        }
                        Swal.fire('Failed', errorMsg, 'error');
                    });
            });

            // Reset modal create saat ditutup
            $('#createItemModal').on('hidden.bs.modal', function() {
                $(this).find('form')[0].reset();
            });

            // Edit form - Mengisi data saat modal dibuka
            $(document).on('click', '.edit-item-btn', function() {
                const data = $(this).data('json');
                const modal = $('#editItemModal' + data.id);

                modal.find('input[name="name"]').val(data.name);
                modal.find('input[name="extra_price"]').val(data.extra_price);
                modal.find('select[name="category_item_id"]').val(data.category_item_id);
                modal.find('input[name="is_active"]').prop('checked', data.is_active);
            });

            // Update
            $(document).on('submit', '.edit-item-form', function(e) {
                e.preventDefault();
                const id = $(this).data('id');
                const form = $(this);
                $.ajax({
                    url: updateUrl.replace(':id', id),
                    type: 'POST',
                    data: form.serialize() + '&_method=PUT',
                    success: function(res) {
                        sessionStorage.setItem('food_items_success', res.message);
                        location.reload();
                    },
                    error: function(err) {
                        let errorMsg = 'Update failed. Please check your input.';
                        if (err.responseJSON && err.responseJSON.message) {
                            errorMsg = err.responseJSON.message;
                        }
                        Swal.fire('Failed', errorMsg, 'error');
                    }
                });
            });

            // Delete
            $(document).on('click', '.delete-item', function() {
                const id = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This action cannot be undone!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.post(deleteUrl.replace(':id', id), {
                            _token: '{{ csrf_token() }}',
                            _method: 'DELETE'
                        }).done(res => {
                            sessionStorage.setItem('food_items_success', res.message);
                            location.reload();
                        }).fail(() => {
                            Swal.fire('Failed', 'Delete failed', 'error');
                        });
                    }
                });
            });

            // Menampilkan notifikasi sukses dari sessionStorage
            const msg = sessionStorage.getItem('food_items_success');
            if (msg) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: msg,
                    timer: 2000,
                    showConfirmButton: false
                });
                sessionStorage.removeItem('food_items_success');
            }
        });
    </script>
@endsection
