<div class="sidebar-wrapper" sidebar-layout="stroke-svg">
    <div>
        <div class="logo-wrapper">
            <a href="{{ route('dashboard.index') }}"
                class="d-flex align-items-center gap-2 text-decoration-none sidebar-logo animated-logo">

                <i class="bi bi-shop fs-4 text-danger logo-icon"></i>

                <span class="fw-bold fs-5 text-dark for-light m-0">AJOFOOD</span>

                <span class="fw-bold fs-5 text-light for-dark m-0">AJOFOOD</span>
            </a>

            <div class="back-btn"><i class="fa fa-angle-left"></i></div>

            <div class="toggle-sidebar">
                <i class="bi bi-layout-sidebar sidebar-toggle toggle-icon"></i>
            </div>

        </div>
        <div class="logo-icon-wrapper">
            <a href="{{ route('dashboard.index') }}">
                <i class="bi bi-shop fs-4 text-danger logo-icon"></i>
            </a>
        </div>

        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn">
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                aria-hidden="true"></i></div>
                    </li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title"
                            href="{{ route('dashboard.index') }}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-home') }}"></use>
                            </svg><span>Dashboard</span></a></li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="{{ route('users.index') }}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-user') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-user') }}"></use>
                            </svg><span>Users</span></a></li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="{{ route('foods.index') }}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-ecommerce') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-ecommerce') }}"></use>
                            </svg><span>Foods</span></a>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title" href="{{ route('categoriesFoods.index') }}">
                            <i class="bi bi-grid-fill fs-5 me-2 sidebar-icon"></i>
                            <span>Food Categories</span>
                        </a>
                    </li>


                    <li class="sidebar-list"><a class="sidebar-link sidebar-title"
                            href="{{ route('categoriesItems.index') }}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-board') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-board') }}"></use>
                            </svg><span>Item Categories</span></a></li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title"
                            href="{{ route('food-items.index') }}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-ui-kits') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-ui-kits') }}"></use>
                            </svg><span>Food Items</span></a></li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="{{ route('orders.index') }}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-task') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-task') }}"></use>
                            </svg><span>Orders</span></a></li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title" href="{{ route('payments.index') }}">
                            <i class="fa-solid fa-credit-card fa-fw me-2"></i>
                            <span>Payment Methods</span>
                        </a>
                    </li>


                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>
