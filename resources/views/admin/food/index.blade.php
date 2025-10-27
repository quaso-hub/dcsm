@extends('admin.layouts.master')
@section('title', 'Foods Data')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/vendors/datatables.css') }}">
    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            font-size: 0;
            width: 100%;
            height: 100%;
            position: absolute;
            right: 0;
            top: 0;
            cursor: pointer;
            z-index: 1;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            position: relative;
            overflow: hidden;
        }

        .dark-only .select2-container--default .select2-selection--multiple {
            background-color: #2a2e37;
            border-color: #444c57;
            color: #fff;
        }

        .dark-only .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #6f42c1;
            color: white;
            border: none;
        }

        .dark-only .select2-container--default .select2-selection--multiple .select2-selection__rendered {
            color: white;
        }

        .dark-only .select2-container--default .select2-results__option--highlighted {
            background-color: #6f42c1;
            color: white;
        }

        .dark-only .select2-container--default .select2-results__option {
            background-color: #2a2e37;
            color: white;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #6f42c1 !important;
            color: #fff !important;
            border: none !important;
            padding: 4px 8px;
            border-radius: 4px;
            margin-top: 5px;
            margin-right: 5px;
            font-size: 0.85rem;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: #ffffff !important;
            margin-right: 4px;
            font-weight: bold;
        }

        .select2-container--default .select2-selection--multiple {
            background-color: #2a2a2a;
            border: 1px solid #444;
            min-height: 40px;
            padding: 4px;
        }

        body:not(.dark-only) .select2-container--default .select2-selection--multiple {
            background-color: #fff;
            border-color: #ced4da;
        }

        body:not(.dark-only) .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #6f42c1;
            color: white;
        }
    </style>

@endsection

@section('breadcrumb-title')
    <h3>Foods Data</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Data</li>
    <li class="breadcrumb-item active">Foods</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">
                        <h3>Foods</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createFoodModal">
                                <i class="icon-plus"></i> Add Food
                            </button>

                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Description</th>
                                        <th>Nutrition Info</th>
                                        <th>Active</th>
                                        <th>Categories Food</th>
                                        <th>Categories Item</th>
                                        <th>Image</th>
                                        <th>Default Food Items</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($foods as $food)
                                        <tr id="food-row-{{ $food->id }}">
                                            <td>{{ $food->name }}</td>
                                            <td>Rp. {{ number_format($food->base_price, 2, ',', '.') }}</td>
                                            <td>{{ $food->description }}</td>
                                            <td>{{ $food->nutrition_info }}</td>
                                            <td>
                                                @if ($food->is_active)
                                                    <span class="badge badge-light-success">Yes</span>
                                                @else
                                                    <span class="badge badge-light-danger">No</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span
                                                    class="badge badge-light-primary">{{ $food->categoryFood->name ?? 'N/A' }}</span>
                                            </td>
                                            <td>
                                                <a href="#" class="text-info show-categories-btn"
                                                    data-bs-toggle="modal" data-bs-target="#showCategoriesModal"
                                                    data-json='@json($food->categoriesItem->pluck('name'))'>
                                                    <i class="icon-list"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="javascript:void(0)" class="text-info view-image-btn"
                                                    data-bs-toggle="modal" data-bs-target="#imageModal"
                                                    data-image="{{ $food->image_path ? asset('storage/' . $food->image_path) : '' }}"
                                                    data-has-image="{{ $food->image_path ? '1' : '0' }}">
                                                    <i class="icon-image"></i>
                                                </a>
                                            </td>

                                            <td>
                                                <a href="javascript:void(0)" class="text-primary manage-default-btn"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#defaultItemModal{{ $food->id }}">
                                                    <i class="icon-settings"></i>
                                                </a>
                                            </td>

                                            <td>
                                                <ul class="action">
                                                    <li class="edit">
                                                        <a href="javascript:void(0)" class="text-success edit-food-btn"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editFoodModal{{ $food->id }}"
                                                            data-food='@json($food)'
                                                            data-category-items='@json($food->categoriesItem->pluck('id')->toArray())'
                                                            data-id="{{ $food->id }}">
                                                            <i class="icon-pencil-alt"></i>
                                                        </a>
                                                    </li>
                                                    <li class="delete">
                                                        <a href="javascript:void(0)" class="text-danger delete-food"
                                                            data-id="{{ $food->id }}">
                                                            <i class="icon-trash"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>



                            @foreach ($foods as $food)
                                <!-- Modal Edit -->
                                <div class="modal fade" id="editFoodModal{{ $food->id }}" tabindex="-1"
                                    aria-labelledby="editModalLabel{{ $food->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-md">
                                        <form class="edit-food-form w-100" data-id="{{ $food->id }}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-content shadow">
                                                <div class="modal-header bg-light">
                                                    <h5 class="modal-title" id="editModalLabel{{ $food->id }}">✏️ Edit Food</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Name</label>
                                                        <input type="text" name="name" class="form-control" value="{{ $food->name }}" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Base Price</label>
                                                        <input type="number" step="0.01" name="base_price" class="form-control"
                                                            value="{{ $food->base_price }}" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Description</label>
                                                        <textarea name="description" class="form-control" rows="2">{{ $food->description }}</textarea>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Nutrition Info</label>
                                                        <textarea name="nutrition_info" class="form-control" rows="2">{{ $food->nutrition_info }}</textarea>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Category Food</label>
                                                        <select name="category_food_id" class="form-select" required>
                                                            <option value="">-- Select Category Food --</option>
                                                            @foreach ($categoriesFood as $category)
                                                                <option value="{{ $category->id }}"
                                                                    {{ $food->category_food_id == $category->id ? 'selected' : '' }}>
                                                                    {{ $category->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Categories Item</label>
                                                        <select name="category_ids[]" id="edit-cat-{{ $food->id }}"
                                                            class="form-control category-select" multiple="multiple">
                                                            @foreach ($categoriesItem as $category)
                                                                <option value="{{ $category->id }}"
                                                                    {{ $food->categoriesItem->contains($category->id) ? 'selected' : '' }}>
                                                                    {{ $category->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Image</label>
                                                        <input type="file" name="image" class="form-control" accept="image/*">
                                                    </div>

                                                    <div class="form-check mb-3">
                                                        <input class="form-check-input" type="checkbox" name="is_active" value="1"
                                                            id="active-{{ $food->id }}" {{ $food->is_active ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="active-{{ $food->id }}">
                                                            Active
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">💾 Update</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>


                                {{-- modal Default Items  --}}
                                <div class="modal fade" id="defaultItemModal{{ $food->id }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <form class="add-default-item-form" data-food-id="{{ $food->id }}">
                                            @csrf
                                            <input type="hidden" name="food_id" value="{{ $food->id }}">

                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Default Items for
                                                        "{{ $food->name }}"</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body">

                                                    <label for="food_item_id_{{ $food->id }}">Tambah
                                                        Default Item:</label>

                                                    @php
                                                        $foodCategoryIds = $food->categoriesItem
                                                            ->pluck('id')
                                                            ->toArray();
                                                        $defaultItemIds = $food->defaultItems
                                                            ->pluck('food_item_id')
                                                            ->toArray();

                                                        $filteredItems = $allItems
                                                            ->filter(function ($item) use (
                                                                $foodCategoryIds,
                                                                $defaultItemIds,
                                                            ) {
                                                                return in_array(
                                                                    $item->category_item_id,
                                                                    $foodCategoryIds,
                                                                ) && !in_array($item->id, $defaultItemIds);
                                                            })
                                                            ->values();
                                                    @endphp

                                                    @if ($filteredItems->isEmpty())
                                                        <div class="alert alert-warning">
                                                            Food ini belum punya kategori item. Harap atur
                                                            kategori dulu.
                                                        </div>
                                                    @else
                                                        <select name="food_item_id"
                                                            class="form-control default-item-select" required>
                                                            @foreach ($filteredItems as $item)
                                                                <option value="{{ $item->id }}">
                                                                    {{ $item->name }}
                                                                    ({{ $item->categoryItem->name ?? 'N/A' }})
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    @endif

                                                    <hr>
                                                    <strong>Default Items Sekarang:</strong>
                                                    <ul class="mt-2">
                                                        @forelse ($food->defaultItems as $def)
                                                            <li>
                                                                {{ $def->item->name }} -
                                                                <em>{{ $def->item->categoryItem->name ?? 'N/A' }}</em>

                                                                <a href="javascript:void(0)"
                                                                    class="text-danger delete-default-item"
                                                                    data-id="{{ $def->id }}">
                                                                    <i class="icon-trash"></i>
                                                                </a>
                                                            </li>
                                                        @empty
                                                            <li><em>Belum ada default item.</em></li>
                                                        @endforelse
                                                    </ul>

                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Tutup</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach





                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header">
                    <h5 class="modal-title">Food Image</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <div id="imageWrapper">
                        <img id="imagePreview" class="img-fluid rounded mb-3" alt="Food Image"
                            style="max-height: 300px;">
                        <p id="noImageText" class="text-white">No image available</p>
                    </div>
                    <div class="text-center">
                        <button type="button" id="deleteImageBtn" class="btn btn-danger d-none" data-id="">
                            <i class="icon-trash"></i> Delete Image
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Create -->
    <div class="modal fade" id="createFoodModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <form id="createFoodForm" enctype="multipart/form-data" class="w-100">
                @csrf
                <div class="modal-content shadow">
                    <div class="modal-header bg-light">
                        <h5 class="modal-title fw-semibold">🍽️ Create New Food</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" required placeholder="e.g. Fried Rice">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Base Price</label>
                            <input type="number" step="1" name="base_price" class="form-control" required placeholder="e.g. 25000">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="2" placeholder="Short description..."></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nutrition Info</label>
                            <textarea name="nutrition_info" class="form-control" rows="2" placeholder="e.g. Calories, Protein..."></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Category Food</label>
                            <select name="category_food_id" class="form-select" required>
                                <option value="">-- Select Category Food --</option>
                                @foreach ($categoriesFood as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Item Categories</label>
                            <select name="category_ids[]" multiple="multiple" id="create-category-select"
                                class="form-control category-select" style="width: 100%;">
                                @foreach ($categoriesItem as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Image</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="food-active" checked>
                            <label class="form-check-label" for="food-active">
                                Active
                            </label>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">➕ Create</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- Show Categories Modal -->
    <div class="modal fade" id="showCategoriesModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Categories</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <ul id="categoriesList"></ul>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Inisialisasi Select2 untuk modal CREATE EDIT
            $('.category-select').each(function() {
                $(this).select2({
                    placeholder: "Select one or more categories",
                    allowClear: true,
                    dropdownParent: $(this).closest(
                        '.modal')
                });
            });

            //select2 modal nambah default item
            $(document).on('shown.bs.modal', function(e) {
                const $modal = $(e.target);
                $modal.find('.default-item-select').each(function() {
                    if (!$(this).hasClass("select2-hidden-accessible")) {
                        $(this).select2({
                            dropdownParent: $modal,
                            width: '100%',
                            theme: 'bootstrap4',
                            placeholder: "Pilih item"
                        });
                    }
                });
            });


            // reset create modal
            $('#createFoodModal').on('hidden.bs.modal', function() {
                const form = $(this).find('form')[0];
                form.reset();
                $(form).find('select[name="category_ids[]"]').val(null).trigger('change');
            });

            // Event listener saat tombol edit diklik
            $(document).on('click', '.edit-food-btn', function() {
                const foodId = $(this).data('id');
                const foodData = $(this).data('food');
                const categoryItems = $(this).data('category-items');

                const modal = $('#editFoodModal' + foodId);

                modal.find('input[name="name"]').val(foodData.name);
                modal.find('input[name="base_price"]').val(foodData.base_price);
                modal.find('textarea[name="description"]').val(foodData.description);
                modal.find('textarea[name="nutrition_info"]').val(foodData.nutrition_info);
                modal.find('select[name="category_food_id"]').val(foodData.category_food_id);
                modal.find('input[name="is_active"]').prop('checked', foodData.is_active);

                modal.find('select[name="category_ids[]"]').val(categoryItems).trigger('change');

                // ✅ Simpan original state di data attr
                modal.data('original', {
                    name: foodData.name,
                    base_price: foodData.base_price,
                    description: foodData.description,
                    nutrition_info: foodData.nutrition_info,
                    category_food_id: foodData.category_food_id,
                    is_active: foodData.is_active,
                    category_ids: categoryItems
                });
            });


            let originalCategoryValues = [];

            $(document).on('click', '.edit-food-btn', function() {
                const data = $(this).data('json');
                originalCategoryValues = data.categoriesItem;
            });

            $('.edit-food-form').closest('.modal').on('hidden.bs.modal', function() {
                const modal = $(this);
                const form = modal.find('form');
                const original = modal.data('original');

                if (original) {
                    form.find('input[name="name"]').val(original.name);
                    form.find('input[name="base_price"]').val(original.base_price);
                    form.find('textarea[name="description"]').val(original.description);
                    form.find('textarea[name="nutrition_info"]').val(original.nutrition_info);
                    form.find('select[name="category_food_id"]').val(original.category_food_id);
                    form.find('input[name="is_active"]').prop('checked', original.is_active);
                    form.find('select[name="category_ids[]"]').val(original.category_ids).trigger('change');
                }
            });



            $('.modal').on('hidden.bs.modal', function() {
                const $modal = $(this);
                const selectElement = $modal.find('.category-select');
                if (selectElement.length) {
                    selectElement.val(originalCategoryValues).trigger('change');
                }
            });

            // Script untuk Show Categories Modal
            $(document).on('click', '.show-categories-btn', function() {
                const categories = $(this).data('json');
                const $list = $('#categoriesList');
                $list.empty(); // Kosongkan list sebelumnya

                if (categories && categories.length > 0) {
                    categories.forEach(cat => {
                        $list.append(`<li class="list-group-item">${cat}</li>`);
                    });
                } else {
                    $list.append('<li class="list-group-item"><em>No categories assigned.</em></li>');
                }
            });

            // Script untuk View Image Modal
            $(document).on('click', '.view-image-btn', function() {
                const hasImage = $(this).data('has-image') == 1;
                const imageUrl = $(this).data('image');
                const foodId = $(this).closest('tr').find('.delete-food').data('id');

                if (hasImage) {
                    $('#imagePreview').attr('src', imageUrl).removeClass('d-none');
                    $('#noImageText').addClass('d-none');
                    $('#deleteImageBtn').removeClass('d-none').attr('data-id', foodId);
                } else {
                    $('#imagePreview').addClass('d-none').attr('src', '');
                    $('#noImageText').removeClass('d-none');
                    $('#deleteImageBtn').addClass('d-none').attr('data-id', '');
                }
            });

            // --- AJAX UNTUK CREATE, UPDATE, DELETE ---

            // Create
            $('#createFoodForm').on('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);

                $.ajax({
                    url: "{{ route('foods.store') }}",
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        sessionStorage.setItem('foods_success', response.message ||
                            'Food created successfully');
                        location.reload();
                    },
                    error: function() {
                        Swal.fire('Failed', 'Create failed, please try again.', 'error');
                    }
                });
            });

            // Edit (Update)
            $(document).on('submit', '.edit-food-form', function(e) {
                e.preventDefault();
                const form = this;
                const foodId = $(form).data('id');
                const formData = new FormData(form);
                formData.append('_method', 'PUT');

                $.ajax({
                    url: "{{ route('foods.update', '') }}/" + foodId,
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        sessionStorage.setItem('foods_success', response.message ||
                            'Food updated successfully');
                        location.reload();
                    },
                    error: function() {
                        Swal.fire('Failed', 'Update failed, please try again.', 'error');
                    }
                });
            });

            // Delete Food
            $(document).on('click', '.delete-food', function() {
                const foodId = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('foods.destroy', '') }}/" + foodId,
                            type: 'POST',
                            data: {
                                _method: 'DELETE',
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                sessionStorage.setItem('foods_success', response
                                    .message || 'Food deleted successfully');
                                location.reload();
                            },
                            error: function() {
                                Swal.fire('Failed!', 'Failed to delete food item.',
                                    'error');
                            }
                        });
                    }
                });
            });

            // Delete Image
            $(document).on('click', '#deleteImageBtn', function() {
                const foodId = $(this).data('id');

                let url = "{{ route('foods.delete_image', ['food' => ':id']) }}";
                url = url.replace(':id', foodId);

                Swal.fire({
                    title: 'Delete image?',
                    text: 'This action cannot be undone.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            method: 'POST',
                            data: {
                                _method: 'PATCH',
                                _token: '{{ csrf_token() }}',
                            },
                            success: function(res) {
                                sessionStorage.setItem('foods_success', res.message ||
                                    'Image deleted successfully');
                                location.reload();
                            },
                            error: function() {
                                Swal.fire('Failed', 'Failed to delete image.', 'error');
                            }
                        });
                    }
                });
            });



            // Delete default item
            $(document).on('click', '.delete-default-item', function() {
                const id = $(this).data('id');

                Swal.fire({
                    title: 'Yakin hapus default item?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('foods.default-items.destroy', '__id__') }}"
                                .replace('__id__', id),
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                _method: 'DELETE'
                            },
                            success: function() {
                                location
                                    .reload();
                            },
                            error: function() {
                                Swal.fire('Gagal', 'Tidak bisa menghapus item.',
                                    'error');
                            }
                        });
                    }
                });
            });

        });

        // Tambah default item pakai AJAX
        $(document).on('submit', '.add-default-item-form', function(e) {
            e.preventDefault();

            const $form = $(this);
            const foodId = $form.data('food-id');
            const itemId = $form.find('.default-item-select').val();
            console.log('Selected Item ID:', itemId);

            console.log('Form:', $form[0]);
            console.log('Select Value:', itemId);

            if (!itemId) {
                Swal.fire('Gagal', 'Pilih item terlebih dahulu.', 'warning');
                return;
            }

            $.ajax({
                url: "{{ route('foods.default-items.store') }}",
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    food_id: foodId,
                    food_item_id: itemId
                },
                success: function() {
                    sessionStorage.setItem('foods_success',
                        'Default item berhasil ditambahkan.');
                    location.reload();
                },
                error: function() {
                    Swal.fire('Gagal', 'Gagal menambahkan item.', 'error');
                }
            });
        });


        // Tampilkan alert sukses setelah reload dari sessionStorage
        const successMessage = sessionStorage.getItem('foods_success');
        if (successMessage) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: successMessage,
                timer: 2000,
                showConfirmButton: false
            });
            sessionStorage.removeItem('foods_success');
        }
    </script>

@endsection
