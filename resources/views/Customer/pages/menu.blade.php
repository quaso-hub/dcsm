@extends('Customer.layouts.app')

@section('title', 'Menu')

@section('content')
    <style>
        .menu-tabs {
            overflow-x: auto;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
            /* Firefox */
            -ms-overflow-style: none;
            /* IE and Edge */
            margin-bottom: 2rem;
            scroll-behavior: smooth;
        }

        .menu-tabs::-webkit-scrollbar {
            display: none;
        }

        .tab-btn {
            display: inline-block;
            border: none;
            border-radius: 999px;
            padding: 0.5rem 1.2rem;
            margin-right: 0.5rem;
            background-color: #f1f1f1;
            color: #333;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .tab-btn:hover {
            background-color: #e0e0e0;
        }

        .tab-btn.active {
            background-color: #0d6efd;
            color: #fff;
        }

        body.dark .tab-btn {
            background-color: #2a2a2a;
            color: #ccc;
        }

        body.dark .tab-btn:hover {
            background-color: #333;
        }

        body.dark .tab-btn.active {
            background-color: #0d6efd;
            color: #fff;
        }

        .tab-btn:focus,
        .tab-btn:active {
            outline: none !important;
            box-shadow: none !important;
        }

        .back-btn {
            display: none;
        }

        @media (max-width: 768px) {
            .back-btn {
                display: inline-block;
            }
        }
    </style>

    <div class="container py-4" style="max-width: 1140px;">
        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('home.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill back-btn">
                    Back
                </a>
                <h4 class="fw-bold mb-0">Our Menu</h4>
            </div>
        </div>

        {{-- Tabs --}}
        <div class="menu-tabs d-flex px-1">
            @foreach ($categories as $cat)
                <a href="{{ route('menu.index', ['category' => $cat]) }}" class="tab-btn {{ $cat === $active ? 'active' : '' }}">
                    {{ $cat }}
                </a>
            @endforeach
        </div>

        <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 g-4">
            @forelse ($foods as $product)
                <div class="col">
                    @include('Customer.components.product-card', [
                        'id' => $product->id,
                        'title' => $product->name,
                        'image' => $product->image_url,
                        'price' => $product->base_price,
                        'rating' => $product->rating ?? 4.0,
                        'fav' => false,
                        'off' => null,
                    ])
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-warning text-center">
                        No menu found for <strong>{{ $active }}</strong>.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection
