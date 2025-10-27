@extends('Customer.layouts.app')

@section('title', 'Category: ' . (request()->query('name') ?? 'All'))

@section('content')
    @php
        $category = request()->query('name') ?? 'All Categories';
        $title = ucwords(str_replace('-', ' ', $category));

        // $categories = ['All Categories', 'Set Menu', 'Hot Item', 'Biriyani', 'Drinks', 'Pizza', 'Sandwich', 'Burger'];

        // $allProducts = [
        //     ['name' => 'Chicken Pizza', 'category' => 'Pizza'],
        //     ['name' => 'Veg Burger', 'category' => 'Burger'],
        //     ['name' => 'Mutton Biriyani', 'category' => 'Biriyani'],
        //     ['name' => 'Coke', 'category' => 'Drinks'],
        //     ['name' => 'Sandwich Deluxe', 'category' => 'Sandwich'],
        // ];

        // $filtered =
        //     $category === 'All Categories'
        //         ? $allProducts
        //         : array_filter($allProducts, fn($p) => $p['category'] === $category);

    @endphp

    <div class="container py-4 mb-5">
        <div class="d-md-none d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('home.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                Back
            </a>
            <div class="dropdown">
                <button class="btn btn-primary btn-sm rounded-pill dropdown-toggle px-3" type="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    {{ $title }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                    @foreach ($categories as $cat)
                        <li>
                            <a class="dropdown-item" href="{{ route('category.index', ['name' => $cat->name]) }}">
                                {{ $cat->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <a href="{{ route('category.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                Reset
            </a>
        </div>

        <div class="d-none d-md-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-semibold mb-0">
                Showing results for:
                <span class="text-primary">{{ $title }}</span>
            </h4>
            <a href="{{ route('category.index') }}"
                class="btn btn-sm border bg-white text-dark dark-mode-invert shadow-sm rounded-pill px-4">
                Reset
            </a>
        </div>

        <div class="d-md-none mb-2">
            <h5 class="fw-semibold">
                Showing results for:
                <span class="text-primary">{{ $title }}</span>
            </h5>
        </div>

        <div class="row g-3">
            @forelse($foods as $product)
                <div class="col-6 col-md-4 col-lg-3">
                    <x-product-card :id="$product->id" :image="$product->image_path ? asset('storage/' . $product->image_path) : 'https://picsum.photos/seed/food1/400/300'" :title="$product->name" :price="$product->base_price" />
                </div>
            @empty
                <div class="col-12">
                    <div class="no-items-wrapper text-center">
                        <div class="fs-2 mb-3">😞</div>
                        <div class="fw-semibold">No items found in this category.</div>
                    </div>
                </div>
            @endforelse
        </div>

        <style>
            html,
            body {
                height: 100%;
                overflow-x: hidden;
            }

            .dark-mode-invert {
                background-color: #fff !important;
                color: #111 !important;
            }

            body.dark .dark-mode-invert {
                background-color: #222 !important;
                color: #eee !important;
            }

            .container {
                padding-bottom: 6rem !important;
            }

            .dropdown-menu a {
                transition: all 0.2s ease-in-out;
                border-radius: 0.25rem;
            }

            .dropdown-menu a:hover {
                background: rgba(0, 0, 0, 0.05);
            }

            body.dark .dropdown-menu {
                background-color: #2a2a2a;
                color: #fff;
            }

            body.dark .dropdown-menu a:hover {
                background: rgba(255, 255, 255, 0.08);
            }

            .btn-outline-secondary {
                border-color: #ccc;
            }

            body.dark .btn-outline-secondary {
                background-color: #2a2a2a;
                color: #eee;
                border-color: #444;
            }

            .btn-outline-secondary:hover {
                background-color: #f8f9fa;
                color: #000;
            }

            body.dark .btn-outline-secondary:hover {
                background-color: #444;
                color: #fff;
            }

            .dropdown-toggle {
                box-shadow: none !important;
            }

            .no-items-wrapper {
                background: rgba(255, 255, 255, 0.65);
                backdrop-filter: blur(8px);
                border-radius: 1rem;
                padding: 2rem 1.5rem;
                color: #333;
                box-shadow: 0 8px 24px rgba(0, 0, 0, 0.05);
                max-width: 500px;
                margin: 0 auto;
                transition: all 0.3s ease;
            }

            body.dark .no-items-wrapper {
                background: rgba(40, 40, 40, 0.65);
                color: #f1f1f1;
                box-shadow: 0 8px 24px rgba(0, 0, 0, 0.25);
            }

            @media (min-width: 768px) {
                .no-items-wrapper {
                    padding: 3rem;
                    font-size: 1.1rem;
                }
            }
        </style>
    @endsection
