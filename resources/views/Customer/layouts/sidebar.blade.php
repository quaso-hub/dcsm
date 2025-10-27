<style>
    .sidebar-overlay {
        position: fixed; inset: 0; z-index: 1060;
        background: rgba(0, 0, 0, .45); backdrop-filter: blur(4px);
        display: none;
    }
    .sidebar-overlay.show { display: block; }

    .sidebar-panel {
        position: absolute; right: 1rem; top: -100%;
        width: 320px; max-width: 90vw;
        border-radius: 1rem;
        background: #ffffff; padding: 1.5rem 1.25rem;
        transition: top .4s cubic-bezier(.25,.8,.25,1);
        overflow-y: auto; max-height: calc(100vh - 2rem);
    }
    .sidebar-overlay.show .sidebar-panel { top: 5rem; }

    .dark .sidebar-panel { background: #1e1e1e; color: #f1f1f1; }

    .tile-btn {
        width: 64px; height: 64px; border-radius: 1rem;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.55rem; background: #f1f3f5;
    }
    .dark .tile-btn { background: #2b2b2b; }

    .menu-link {
        display: flex; align-items: center; gap: .7rem;
        padding: .6rem 1rem; border-radius: .8rem;
        font-size: .94rem; background: #f8f9fa; color: #495057;
        text-decoration: none;
    }
    .menu-link i { font-size: 1.2rem; }
    .menu-link:hover { background: #e9ecef; color: #0d6efd; }

    .dark .menu-link { background: #282828; color: #dddddd; }
    .dark .menu-link:hover { background: #353535; color: #0d6efd; }

    .dark .sidebar-panel .btn-close { filter: invert(1) grayscale(100%); opacity: .8; }

    .logout-btn {
        display: flex; align-items: center; justify-content: center;
        gap: 0.5rem; font-weight: 500;
        background: #ffffff; color: #dc3545;
        border: 1px solid #dc3545;
        padding: .65rem 1rem; border-radius: .8rem;
        width: 100%; font-size: 1rem;
        transition: all 0.3s ease;
    }
    .logout-btn:hover {
        background: #dc3545; color: #fff;
    }
    .dark .logout-btn {
        background: #2c2c2c; color: #ff6b6b; border-color: #ff6b6b;
    }
    .dark .logout-btn:hover {
        background: #ff6b6b; color: #000;
    }

    .sidebar-close-btn {
        background: #e9ecef;
        color: #333;
        font-weight: 500;
        border-radius: .8rem;
        transition: all .25s ease;
    }
    .sidebar-close-btn:hover {
        background: #ced4da;
        color: #000;
    }
    .dark .sidebar-close-btn {
        background: #333;
        color: #f1f1f1;
    }
    .dark .sidebar-close-btn:hover {
        background: #444;
        color: #fff;
    }
</style>

<div id="sidebarBackdrop" class="sidebar-overlay">
    <div class="sidebar-panel">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-semibold mb-0">Menu Helper</h5>
            <button class="btn-close" onclick="toggleSidebar()"></button>
        </div>

        <div class="d-flex justify-content-between mb-4">
            <a href="{{ route('wallet.index') }}" class="text-center text-decoration-none">
                <div class="tile-btn"><i class="bi bi-wallet2"></i></div>
                <small class="d-block mt-2">Wallet</small>
            </a>
            <a href="{{ route('myorders.index') }}" class="text-center text-decoration-none">
                <div class="tile-btn"><i class="bi bi-receipt"></i></div>
                <small class="d-block mt-2">My&nbsp;Order</small>
            </a>
            <a href="{{ route('customer.profile') }}" class="text-center text-decoration-none">
                <div class="tile-btn"><i class="bi bi-person"></i></div>
                <small class="d-block mt-2">Profile</small>
            </a>
        </div>

        <div class="vstack gap-3">
            <a href="{{ route('menu.index') }}" class="menu-link"><i class="bi bi-grid"></i>Menu</a>
            <a href="{{ route('notifications') }}" class="menu-link"><i class="bi bi-bell"></i>Notification</a>
            <a href="{{ route('coupons') }}"       class="menu-link"><i class="bi bi-ticket-perforated"></i>Coupon</a>
            <a href="{{ route('refer') }}"         class="menu-link"><i class="bi bi-people"></i>Refer &amp; Earn</a>
        </div>

        <hr class="my-4">

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>

        <button class="btn sidebar-close-btn mt-3 w-100" onclick="toggleSidebar()">
            <i class="bi bi-x-lg me-1"></i> Close
        </button>
    </div>
</div>
