<nav class="navbar fixed-bottom bottom-nav d-md-none border-top bg-light dark:bg-dark shadow-lg">
    <style>
        .bottom-nav {
            background: #f8f9fa;
            height: 78px;
            padding-top: 6px;
        }

        .bottom-nav a {
            flex: 1 1 20%;
            text-align: center;
            text-decoration: none;
        }

        .bottom-nav i {
            font-size: 1.45rem;
            line-height: 1;
        }

        .bottom-nav small {
            display: none;
            font-size: 0.75rem;
        }

        .nav-active i,
        .nav-active small {
            color: #0d6efd !important;
        }

        .nav-active small {
            display: block;
        }

        .dark .bottom-nav {
            background-color: #1e1e1e !important;
        }

        .dark .bottom-nav a {
            color: #a1a1a1 !important;
        }

        .fab-btn {
            width: 56px;
            height: 56px;
            margin-top: -28px;
            border-radius: 50%;
            background-color: #dc3545;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            box-shadow: 0 0 8px rgba(0,0,0,.25);
        }

        .fab-btn i {
            font-size: 1.7rem;
            color: white;
        }

        .fab-btn .badge {
            position: absolute;
            top: 4px;
            right: 4px;
            background: gold;
            color: black;
            font-size: .7rem;
            padding: 2px 6px;
            border-radius: 999px;
        }
    </style>

    <div class="container-fluid d-flex align-items-end px-0">

        <a href="{{ route('home.index') }}" class="text-center {{ request()->routeIs('home.index') ? 'nav-active' : '' }}">
            <i class="bi bi-house"></i><small>Home</small>
        </a>

        <a href="{{ route('like') }}" class="text-center {{ request()->routeIs('like') ? 'nav-active' : '' }}">
            <i class="bi bi-heart"></i><small>Fav</small>
        </a>

        {{-- FAB dibungkus div agar tidak mengganggu layout link --}}
        <div style="flex: 0 0 56px;" class="text-center">
            <a href="{{ route('cart.index') }}" class="fab-btn position-relative {{ request()->routeIs('cart') ? 'nav-active' : '' }}">
                <i class="bi bi-cart"></i>
                <span class="badge">2</span>
            </a>
        </div>

        <a href="{{ route('myorders.index') }}" class="text-center {{ request()->routeIs('orders') ? 'nav-active' : '' }}">
            <i class="bi bi-shop"></i><small>Order</small>
        </a>

        <a href="{{ route('customer.profile') }}" class="text-center {{ request()->routeIs('customer.profile') ? 'nav-active' : '' }}">
            <i class="bi bi-person"></i><small>Me</small>
        </a>

    </div>
</nav>
