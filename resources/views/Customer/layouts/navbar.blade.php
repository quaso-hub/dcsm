<style>
    .icon-btn {
        background: transparent;
        border: none;
        padding: .45rem .6rem;
        font-size: 1.35rem;
        color: #6c757d;
        transition: color .2s
    }

    .icon-btn:hover {
        color: #0d6efd
    }

    .nav-icon {
        position: relative;
        color: #6c757d;
        transition: color .2s
    }

    .nav-icon.nav-active {
        color: #0d6efd
    }

    .nav-icon .badge {
        font-size: .6rem
    }

    .dark .icon-btn,
    .dark .nav-icon {
        color: #ffffff
    }

    .dark .nav-icon.nav-active {
        color: #0d6efd
    }

    .dropdown-menu {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(6px);
        border: none;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .dark .dropdown-menu {
        background: rgba(30, 30, 30, 0.85);
        backdrop-filter: blur(6px);
    }

    .dropdown-menu {
        border-radius: 0.75rem;
    }

    .dropdown-item:hover,
    .dropdown-item:focus {
        background: #f8f9fa;
        color: #000
    }

    .dark .dropdown-item:hover,
    .dark .dropdown-item:focus {
        background: #343a40;
        color: #ffffff
    }

    .nav-cats {
        min-width: 130px
    }

    .btn-cats {
        border: none;
        background: transparent;
        color: #6c757d
    }

    .btn-cats:hover,
    .btn-cats:focus {
        color: #0d6efd
    }

    .search-wrapper {
        position: relative;
        z-index: 1060;
        width: 100%;
        max-width: 640px;
    }

    .search-wrapper i {
        position: absolute;
        left: 18px;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
    }

    .search-wrapper input {
        padding-left: 50px;
        border-radius: 50rem !important;
        border: 1px solid #dee2e6 !important;
    }

    .search-wrapper input:focus {
        border-color: #0d6efd !important;
        box-shadow: none;
    }

    .dark .search-wrapper i {
        color: #bcbcbc
    }

    .dark .search-wrapper input {
        background: #1e1e1e !important;
        color: #f1f1f1 !important;
        border: 1px solid #555 !important;
    }

    .search-wrapper.suggestions-open .suggestions-box {
        display: block;
    }

    .search-overlay {
        position: fixed;
        inset: 0;
        background-color: rgba(0, 0, 0, 0.3);
        backdrop-filter: blur(4px);
        z-index: 1040;
        display: none;
    }

    .suggestions-box {
        position: absolute;
        top: 100%;
        margin-top: 4px;
        left: 0;
        right: 0;
        z-index: 1061;
        background: #fff;
        border-radius: .75rem;
        box-shadow: 0 8px 20px rgba(0, 0, 0, .1);
        display: none;
        overflow: hidden;
        padding: .5rem 0;
    }

    .dark .suggestions-box {
        background: #2b2b2b
    }

    .suggestion-item {
        padding: .65rem 1rem;
        cursor: pointer;
        animation: fadeInUp .3s ease forwards;
        opacity: 0;
        transform: translateY(10px);
    }

    .suggestion-item:hover {
        background: #f8f9fa
    }

    .dark .suggestion-item:hover {
        background: #3a3a3a
    }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 767.98px) {
        .search-wrapper {
            margin-top: .5rem;
        }
    }

    @keyframes shake {

        0%,
        100% {
            transform: scale(1)
        }

        25%,
        75% {
            transform: scale(1.05)
        }
    }

    .btn-shake {
        animation: shake .3s ease-in-out;
    }
</style>


<nav class="navbar navbar-expand-lg bg-white dark:bg-dark shadow-sm border-bottom py-3 px-3 d-none d-md-flex">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center text-danger" href="{{ route('home.index') }}">
            <img src="https://picsum.photos/seed/logo/32" height="32" class="rounded-circle me-2" alt="">
            <strong>eFood</strong>
        </a>

        <div class="d-flex align-items-center flex-grow-1 justify-content-center gap-4">
            <div class="dropdown nav-cats flex-shrink-0">
                <button class="btn btn-cats" data-bs-toggle="dropdown">Categories <i
                        class="bi bi-chevron-down small"></i></button>
                <ul class="dropdown-menu">
                    @foreach ($categories as $c)
                        <li>
                            <a class="dropdown-item" href="{{ route('category.index', ['name' => $c->name]) }}">
                                {{ $c->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="search-wrapper position-relative w-100">
                <i class="bi bi-search"></i>
                <input type="text" class="form-control shadow-sm search-input" placeholder="Are you hungry?"
                    onfocus="showSearchOverlay()" oninput="filterSuggestions(this)" onblur="hideSearchOverlayDelayed()">
                <div class="suggestions-box rounded-4">
                    @foreach (['Pizza', 'Burger', 'Sandwich', 'Hot Item', 'Set Menu'] as $i => $item)
                        <div class="suggestion-item" style="animation-delay: {{ $i * 80 }}ms">{{ $item }}
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="d-flex align-items-center gap-4 ms-2">
                <a href="{{ route('like') }}" class="nav-icon {{ request()->routeIs('like') ? 'nav-active' : '' }}">
                    <i class="bi bi-heart fs-5"></i>
                    <span
                        id="badge-like"class="badge bg-danger position-absolute top-0 start-100 translate-middle">0</span>
                </a>
                <a href="{{ route('cart.index') }}" class="nav-icon {{ request()->routeIs('cart') ? 'nav-active' : '' }}">
                    <i class="bi bi-cart fs-5"></i>
                    <span id="badge-cart" class="badge bg-danger position-absolute top-0 start-100 translate-middle">
                        {{ session('cart_total_qty', 0) }}
                    </span>
                </a>
            </div>
        </div>

        <div class="d-flex align-items-center gap-3 ms-auto">
            <button class="icon-btn" onclick="toggleSidebar()"><i class="bi bi-list fs-5"></i></button>
            <button class="icon-btn" id="themeToggleDesktop"><i class="bi bi-circle-half fs-5"></i></button>
        </div>
    </div>
</nav>

@if (request()->routeIs('home.index'))
    <nav class="navbar bg-white dark:bg-dark shadow-sm d-md-none px-3 py-2">
        <a class="navbar-brand text-danger m-0 p-0" href="{{ route('home.index') }}">eFood</a>
        <div class="ms-auto d-flex gap-2">
            <button class="icon-btn" data-bs-toggle="collapse" data-bs-target="#mobileSearch"><i
                    class="bi bi-search"></i></button>
            <button class="icon-btn" id="themeToggleMobile"><i class="bi bi-circle-half"></i></button>
        </div>
    </nav>

    <div class="collapse d-md-none px-3 mt-2" id="mobileSearch">
        <div class="search-wrapper w-100 position-relative">
            <i class="bi bi-search"></i>
            <input type="text" class="form-control shadow-sm search-input" placeholder="Are you hungry?"
                onfocus="showSearchOverlay(this)" onblur="hideSearchOverlayDelayed(this)"
                oninput="filterSuggestions(this)">
            {{-- <div class="suggestions-box rounded-4">
                @foreach (['Pizza', 'Burger', 'Sandwich', 'Hot Item', 'Set Menu'] as $i => $item)
                    <div class="suggestion-item" style="animation-delay: {{ $i * 80 }}ms">{{ $item }}
                    </div>
                @endforeach
            </div> --}}
            <div class="suggestions-box rounded-4"></div>
        </div>
    </div>
@endif

<div class="search-overlay" onclick="hideSearchOverlay()"></div>



