@props([
    'id' => 0,
    'image' => 'https://picsum.photos/seed/hor/600/400',
    'title' => 'Product',
    'price' => 0,
    'rating' => 4.2,
    'fav' => false,
    'off' => null,
    'soldOut' => false,
])

<style>
    .pg-card {
        border-radius: 1.25rem;
        transition: .25s
    }

    .pg-img {
        height: 170px;
        object-fit: cover;
        border-radius: 1.25rem 1.25rem 0 0;
        transition: filter .25s
    }

    .pg-card:hover {
        box-shadow: 0 1rem 2rem rgba(0, 0, 0, .12);
        transform: translateY(-6px)
    }

    .pg-card:hover .pg-img {
        filter: brightness(.8)
    }

    .pg-btn,
    .qty-pill {
        background: #e63946;
        border: none;
        color: #fff;
        border-radius: 50rem;
        min-height: 34px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: .65rem;
        padding: 0 .9rem;
        font-weight: 500
    }

    .pg-btn {
        width: 88%;
        margin: 0 auto;
        box-shadow: 0 6px 16px rgba(230, 57, 70, .35);
        transition: .2s
    }

    .pg-btn:hover {
        transform: scale(1.05)
    }

    .qty-pill {
        width: 88%;
        margin: 0 auto;
        background: #f8d7da;
        color: #e63946;
        box-shadow: 0 6px 16px rgba(230, 57, 70, .25)
    }

    .qty-pill .circle {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #e63946;
        color: #fff;
        font-size: 1.25rem
    }

    .like-btn {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center
    }

    .like-btn.active {
        background: #e63946;
        color: #fff
    }

    .dark .pg-card {
        background: #1e1e1e
    }

    .dark .pg-card:hover {
        box-shadow: 0 1rem 2rem rgba(0, 0, 0, .5)
    }

    .dark .pg-img {
        filter: brightness(.85)
    }

    .dark .pg-card:hover .pg-img {
        filter: brightness(.7)
    }

    .dark .pg-btn:hover {
        background: #2a2a2a;
        color: #fff
    }

    .dark .like-btn {
        background-color: rgba(255, 255, 255, 0.365);
        color: rgba(255, 255, 255, 0.75);
        border: 1px solid rgba(255, 255, 255, 0.15);
    }

    .dark .like-btn:hover {
        background-color: rgba(255, 255, 255, 0.15);
        color: #fff;
    }

    .dark .like-btn.active {
        background-color: #e63946;
        color: #fff;
        border: none;
    }
</style>

<div class="card pg-card bg-white dark:bg-dark text-body dark:text-light border-0 h-100" data-id="{{ $id }}"
    data-title="{{ $title }}" data-price="{{ $price }}" data-image="{{ $image }}">
    <div class="position-relative">
        <img src="{{ $image }}" class="w-100 pg-img" alt="{{ $title }}">
        @isset($off)
            <span class="badge bg-danger rounded-pill position-absolute top-0 start-0 m-2 px-3">{{ $off }} %
                OFF</span>
        @endisset
        @if ($soldOut)
            <span
                class="badge bg-danger position-absolute top-50 start-50 translate-middle px-4">Not&nbsp;Available</span>
        @endif

        <button class="btn btn-light position-absolute top-0 end-0 m-2 like-btn{{ $fav ? ' active' : '' }}"
            data-id="{{ $id }}" onclick="toggleLike(this)">
            <i class="bi bi-heart{{ $fav ? '-fill' : '' }}"></i>
        </button>
    </div>

    <div class="p-3">
        <h6 class="fw-semibold mb-1 text-truncate">{{ $title }}</h6>
        <div class="d-flex justify-content-between align-items-center small mb-3">
            <span class="text-warning">
                <i class="bi bi-star-fill me-1"></i>{{ number_format((float) $rating, 1) }}
            </span>
            <span class="fw-bold text-danger">Rp. {{ number_format((float) $price, 2, ',', '.') }}</span>
        </div>

        <div class="action-area" data-action="{{ $id }}">
            <button class="pg-btn add-btn d-flex align-items-center justify-content-center gap-1">
                <i class="bi bi-plus-circle"></i> Add
            </button>
        </div>
    </div>
</div>
