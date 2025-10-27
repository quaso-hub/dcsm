@extends('Customer.layouts.app')
@section('title', 'Home')

@section('content')
    <style>
        .section-title {
            font-weight: 700;
            margin-bottom: .5rem
        }

        .special-box {
            border-radius: 1.25rem;
            overflow: hidden
        }

        .discover-box {
            background: #f4f8ff;
            border-radius: 1.25rem;
            padding: 1.5rem
        }

        .discover-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: .35rem;
            width: 85px
        }

        .discover-item img {
            width: 68px;
            height: 68px;
            object-fit: cover;
            border-radius: .75rem
        }

        .dark .discover-box {
            background: #232323;
            border: 1px solid #3a3a3a
        }

        .dark .discover-item small {
            color: #f1f1f1
        }

        /* horizontal scroll container */
        .scroll-x {
            display: flex;
            gap: 1.25rem;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            padding-bottom: .5rem
        }

        .scroll-x::-webkit-scrollbar {
            display: none
        }

        .scroll-x {
            -ms-overflow-style: none;
            scrollbar-width: none
        }

        .scroll-x>* {
            scroll-snap-align: start;
            flex-shrink: 0
        }

        /* preserve full size card */
        .card-wrapper,
        .card2-wrapper {
            width: auto;
            max-width: none
        }

        /* fallback for mobile */
        @media (max-width:575.98px) {
            .discover-box {
                padding: 1rem
            }

            .discover-item {
                width: 64px
            }

            .discover-item img {
                width: 54px;
                height: 54px
            }

            .scroll-x>.card-wrapper,
            .scroll-x>.card2-wrapper {
                flex: 0 0 85%;
                max-width: 85%
            }
        }

        .chef-wrap {
            background: #fff6f6;
            border-radius: 1.25rem;
            padding: 1.5rem;
            position: relative
        }

        .dark .chef-wrap {
            background: #2b2b2b
        }

        .chef-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 42px;
            height: 42px;
            border: 2px solid #e63946;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            color: #e63946;
            cursor: pointer;
            transition: .2s
        }

        .chef-arrow:hover {
            background: #e63946;
            color: #fff
        }

        .chef-arrow.prev {
            left: -21px
        }

        .chef-arrow.next {
            right: -21px
        }



        .custom-builder-box {
            background: linear-gradient(145deg, #f4f9ff, #ffffff);
            border-radius: 1.25rem;
            border: 1px solid #e0e0e0;
            padding: 2rem 1.5rem;
            height: 100%;
            min-height: 100%;
            transition: all 0.4s ease-in-out;
            box-shadow: 0 0 0 transparent;
            animation: fadeInUp 0.6s ease;
            position: relative;
            overflow: hidden;
        }

        .custom-builder-box:hover {
            transform: translateY(-6px) scale(1.02);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.08);
        }

        .builder-icon {
            background: #e63946;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            margin-bottom: 1rem;
            box-shadow: 0 0 15px rgba(230, 57, 70, 0.5);
            transition: transform 0.4s ease;
        }

        .custom-builder-box:hover .builder-icon {
            transform: rotate(10deg) scale(1.1);
        }

        .builder-content h5 {
            color: #222;
            font-size: 1.1rem;
        }

        .builder-content p {
            color: #666;
            font-size: 0.9rem;
        }

        .dark .custom-builder-box {
            background: linear-gradient(145deg, #1d1d1d, #2c2c2c);
            border-color: #444;
        }

        .dark .builder-content h5 {
            color: #ffffff;
        }

        .dark .builder-content p {
            color: #bbbbbb;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 767.98px) {
            .custom-builder-box {
                padding: 1.5rem 1rem;
            }

            .builder-icon {
                width: 64px;
                height: 64px;
            }

            .builder-content h5 {
                font-size: 1rem;
            }

            .builder-content p {
                font-size: 0.85rem;
            }
        }

        @media (max-width: 767.98px) {
            .container {
                padding-bottom: 5rem !important;
            }
        }

        .see-more-btn {
            display: inline-block;
            padding: 0.65rem 1.5rem;
            font-weight: 500;
            font-size: 1rem;
            color: #dc3545;
            border: 2px solid #dc3545;
            border-radius: .7rem;
            text-decoration: none;
            transition: all 0.3s ease;
            background-color: transparent;
        }

        .see-more-btn:hover {
            background-color: #dc3545;
            color: #fff;
            transform: translateY(-2px) scale(1.03);
            box-shadow: 0 6px 16px rgba(220, 53, 69, 0.35);
        }

        body.dark .see-more-btn {
            color: #ff6b6b;
            border-color: #ff6b6b;
        }

        body.dark .see-more-btn:hover {
            background-color: #ff6b6b;
            color: #000;
        }
    </style>

    <div class="container" style="max-width: 1140px;">
        <div class="row g-4 mb-5">
            <div class="col-12 col-lg-8">
                <h5 class="section-title">Today’s Specials</h5>
                <div id="specialCarousel" class="carousel slide special-box" data-bs-touch="true" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach (['pizza', 'burger', 'salad', 'coffee'] as $k => $seed)
                            <div class="carousel-item {{ !$k ? 'active' : '' }}">
                                <img src="https://picsum.photos/seed/{{ $seed }}/1200/350" class="d-block w-100"
                                    loading="lazy">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <a href="{{ route('discover') }}"
                    class="custom-builder-box d-flex flex-column justify-content-center align-items-center text-center text-decoration-none h-100 w-100">
                    <div class="builder-icon">
                        <i class="bi bi-egg-fried fs-1"></i>
                    </div>
                    <div class="builder-content">
                        <h5 class="fw-bold mb-1">Custom Dish Builder</h5>
                        <p class="mb-0">Craft your own delicious and healthy dish</p>
                    </div>
                </a>
            </div>
        </div>

        @foreach ($categoriesTop as $index => $category)
            <section class="mb-5">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h5 class="section-title">{{ $category->name }}</h5>
                    <a href="{{ route('category.index', ['name' => $category->name]) }}"
                        class="small fw-semibold text-primary text-decoration-none">
                        Discover All
                    </a>
                </div>

                <div class="scroll-x">
                    @foreach ($category->foods as $food)
                        <div class="{{ $index === 0 ? 'card-wrapper' : 'card2-wrapper' }}">
                            @if ($index === 0)
                                <x-product-card :image="$food->image_path
                                    ? asset('storage/' . $food->image_path)
                                    : 'https://picsum.photos/seed/' . $food->id . '/500/350'" :title="$food->name" :price="$food->base_price" :rating="4.5"
                                    :off="null" :sold-out="false" :id="$food->id" />
                            @else
                                <x-product-card-2 :image="$food->image_path
                                    ? asset('storage/' . $food->image_path)
                                    : 'https://picsum.photos/seed/' . $food->id . '/500/350'" :title="$food->name" :price="$food->base_price" :rating="4.5"
                                    :off="null" :sold-out="false" :id="$food->id" />
                            @endif
                        </div>
                    @endforeach
                </div>
            </section>
        @endforeach

        {{-- Chef's Recommendation --}}
        @if ($recommendedFoods->count())
            <section class="mb-5 position-relative">
                <h5 class="section-title text-center mb-3">Chef's Recommendation <i class="bi bi-emoji-smile"></i></h5>
                <div class="chef-wrap">
                    <div class="scroll-x" id="chefScroll">
                        @foreach ($recommendedFoods as $food)
                            <div class="card-wrapper">
                                <x-product-card :image="$food->image_path
                                    ? asset('storage/' . $food->image_path)
                                    : 'https://picsum.photos/seed/' . $food->id . '/500/350'" :title="$food->name" :price="$food->base_price" :rating="4.5"
                                    :off="null" :sold-out="false" :id="$food->id" />
                            </div>
                        @endforeach
                    </div>
                    <div class="chef-arrow prev" onclick="chefNavigate(-1)"><i class="bi bi-arrow-left"></i></div>
                    <div class="chef-arrow next" onclick="chefNavigate(1)"><i class="bi bi-arrow-right"></i></div>
                </div>
            </section>
        @endif

        {{-- See More Button (Selalu Tampil) --}}
        <div class="text-center mt-5 mb-5">
            <a href="{{ route('menu.index') }}" class="see-more-btn">See More</a>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        const chefScroll = document.getElementById('chefScroll');

        function chefNavigate(dir) {
            chefScroll.scrollBy({
                left: chefScroll.clientWidth * 0.8 * dir,
                behavior: 'smooth'
            });
        }
        new bootstrap.Carousel('#specialCarousel', {
            interval: 4000,
            ride: 'carousel'
        });
    </script>
@endpush
