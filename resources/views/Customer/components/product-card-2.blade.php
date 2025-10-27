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
    .ph-card {
        border-radius: 1.25rem;
        transition: .25s
    }

    .ph-img {
        width: 140px;
        height: 100%;
        object-fit: cover;
        border-radius: 1.25rem 0 0 1.25rem;
        transition: filter .25s
    }

    .ph-card:hover {
        box-shadow: 0 .75rem 1.5rem rgba(0, 0, 0, .12);
        transform: translateY(-4px);
        background: #f8f9fa
    }

    .qty-box {
        display: flex;
        gap: .5rem
    }

    .qty-btn {
        background: #e63946;
        border: none;
        color: #fff;
        width: 30px;
        height: 30px;
        border-radius: 50%
    }

    .ph-btn {
        background: #e63946;
        border: none;
        color: #fff;
        border-radius: 50rem;
        padding: .35rem 1.4rem;
        box-shadow: 0 6px 16px rgba(230, 57, 70, .35);
        transition: .2s
    }

    .ph-btn:hover {
        transform: scale(1.05)
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

    .dark .ph-card {
        background: #1e1e1e
    }

    .dark .ph-card:hover {
        background: #2a2a2a
    }

    .dark .ph-img {
        filter: brightness(.85)
    }

    .dark .ph-card:hover .ph-img {
        filter: brightness(.7)
    }

    .dark .ph-btn:hover {
        background: #2a2a2a;
        color: #fff
    }

    .dark .like-btn {
        background-color: rgba(255, 255, 255, 0.209);
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

<div class="card ph-card d-flex flex-row border-0 text-body dark:text-light" data-id="{{ $id }}"
    data-title="{{ $title }}" data-price="{{ $price }}" data-image="{{ $image }}">
    <div class="position-relative">
        <img src="{{ $image }}" class="ph-img" alt="{{ $title }}">
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
    <div class="flex-grow-1 p-3 d-flex flex-column justify-content-between">
        <div>
            <h6 class="fw-semibold mb-1 text-truncate">{{ $title }}</h6>
            <div class="d-flex justify-content-between align-items-center small mb-2">
                <span class="text-warning">
                    <i class="bi bi-star-fill me-1"></i>{{ number_format((float) $rating, 1) }}
                </span>
                <span class="fw-bold text-danger">Rp. {{ number_format((float) $price, 2, ',', '.') }}</span>
            </div>
        </div>
        <div class="action-area">
            <button class="ph-btn add-btn d-flex align-items-center gap-1">
                <i class="bi bi-plus-circle"></i> Add
            </button>
        </div>
    </div>
</div>
