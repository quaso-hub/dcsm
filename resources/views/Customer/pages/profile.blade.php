@extends('Customer.layouts.app')
@section('title', 'Profil')

@section('content')
    <style>
        .container-profile {
            max-width: 1140px;
            margin: auto;
            padding: 2rem 1rem;
        }

        .avatar-profile {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #dee2e6;
            cursor: pointer;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 1.25rem;
            margin-top: 2rem;
        }

        .menu-item {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 1.2rem 0.5rem;
            text-align: center;
            color: #333;
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .menu-item i {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .menu-item:hover {
            background: #e9ecef;
            color: #0d6efd;
        }

        .dark .menu-item {
            background: #2a2a2a;
            color: #eee;
        }

        .dark .menu-item:hover {
            background: #333;
            color: #0d6efd;
        }

        /* Modal styling */
        .modal.profile-modal {
            z-index: 3050;
        }

        .modal.profile-modal .modal-content {
            border-radius: 16px;
            padding: 2rem;
        }

        .dark .modal.profile-modal .modal-content {
            background: #1e1e1e;
            color: #fff;
        }

        .dark .modal.profile-modal .btn-close {
            filter: invert(1);
        }

        .upload-avatar-wrapper {
            position: relative;
            width: 100px;
            height: 100px;
            margin: auto;
        }

        .upload-avatar-wrapper img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #ccc;
        }

        .upload-avatar-wrapper label {
            position: absolute;
            bottom: 0;
            right: 0;
            background: #0d6efd;
            color: #fff;
            border-radius: 50%;
            padding: 4px;
            font-size: 0.9rem;
            cursor: pointer;
        }

        .logout-card {
            background: #fff;
            border-radius: 12px;
            padding: 1rem;
            text-align: center;
            color: #dc3545;
            font-weight: 500;
            transition: all 0.3s ease;
            border: 1px solid #dc3545;
        }

        .logout-card:hover {
            background: #dc3545;
            color: #fff;
        }

        .dark .logout-card {
            background: #2b2b2b;
            border-color: #ff6b6b;
            color: #ff6b6b;
        }

        .dark .logout-card:hover {
            background: #ff6b6b;
            color: #000;
        }

        body.dark .text-muted {
            color: #e0e0e0 !important;
        }

        .profile-tile {
            width: 100%;
            height: 100%;
            padding: 1.2rem 0.8rem;
            border-radius: 0.75rem;
            background: #f8f9fa;
            color: #333;
            border: none;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease-in-out;
        }

        .profile-tile:hover {
            background-color: #e9ecef;
            color: #000;
        }

        .dark .profile-tile {
            background: #2b2b2b;
            color: #fff;
        }

        .dark .profile-tile:hover {
            background: #353535;
        }

        .danger-tile {
            background-color: #ffe5e5;
            color: #dc3545;
        }

        .danger-tile:hover {
            background-color: #dc3545;
            color: #fff;
        }

        .dark .danger-tile {
            background-color: #3a1c1c;
            color: #ff6b6b;
        }

        .dark .danger-tile:hover {
            background-color: #ff6b6b;
            color: #000;
        }

        .email-text {
            transition: color 0.3s;
        }

        body.dark .email-text {
            color: #ccc !important;
        }

        .btn-delete-account {
            background-color: transparent;
            border: 1px solid #dc3545;
            color: #dc3545;
            font-weight: 500;
            border-radius: 0.75rem;
            transition: all 0.2s ease-in-out;
            box-shadow: 0 0 0 transparent;
            font-size: 0.95rem;
            height: 42px;
            display: inline-flex;
            align-items: center;
        }

        .btn-delete-account:hover {
            background-color: rgba(220, 53, 69, 0.1);
            color: #999696;
            box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
            transform: scale(1.03);
        }

        body.dark .btn-delete-account:hover {
            background-color: rgba(220, 53, 69, 0.2);
            color: #ffffff;
        }

        .btn-delete-account {
            margin-left: 1.5rem;
        }

        @media (min-width: 769px) {
            .btn-delete-account .bi {
                margin-right: 0.5rem;
            }
        }

        /* edit button versi mobile */
        @media (max-width: 768px) {
            .btn-delete-account {
                position: absolute;
                top: 50%;
                right: 1rem;
                transform: translateY(-50%);
                font-size: 1.5rem;
                color: #dc3545;
                border: none;
                background: transparent;
                padding: 0;
                z-index: 1;
            }

            .btn-delete-account span {
                display: none;
            }

            .btn-delete-account .bi {
                margin: 0;
            }

            .card.position-relative {
                position: relative;
            }
        }

        /* Modal edit mobile */
        @media (max-width: 768px) {
            .modal.profile-modal .modal-dialog {
                position: fixed;
                bottom: 0;
                margin: 0;
                width: 100%;
                left: 0;
                right: 0;
                transform: translateY(100%);
                transition: transform 0.3s ease-in-out;
            }

            .modal.profile-modal.show .modal-dialog {
                transform: translateY(0);
            }

            .modal.profile-modal .modal-content {
                border-radius: 1rem 1rem 0 0;
                padding: 1.5rem;
            }
        }
    </style>

    <div class="container-profile">

        {{-- Static Account Section --}}
        <div class="card border-0 shadow-sm bg-light-subtle dark:bg-dark mb-4 rounded-4 overflow-hidden position-relative">
            <div class="row g-0 align-items-center px-4 py-3">
                {{-- Avatar --}}
                <div class="col-auto">
                    <img src="https://picsum.photos/100" alt="User Avatar"
                        class="rounded-circle border border-3 border-danger-subtle shadow-sm me-3"
                        style="width: 72px; height: 72px; object-fit: cover; cursor: pointer;" onclick="showProfileModal()">
                </div>

                {{-- Info Utama --}}
                <div class="col">
                    <h6 class="mb-0 fw-semibold">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h6>
                    <small class="text-muted d-block email-text">{{ auth()->user()->email }}</small>
                </div>

                {{-- Info Detail --}}
                <div class="col-auto d-none d-md-flex align-items-center gap-4 text-center ms-auto">
                    <div>
                        <div class="fw-bold">{{ auth()->user()->loyalty_point ?? 0 }}</div>
                        <small class="text-muted">Loyalty Point</small>
                    </div>
                    <div class="vr text-danger opacity-25"></div>
                    <div>
                        <div class="fw-bold">${{ number_format(auth()->user()->wallet_balance ?? 0, 2) }}</div>
                        <small class="text-muted">Wallet Balance</small>
                    </div>
                    <div class="vr text-danger opacity-25"></div>
                    <div>
                        <div class="fw-bold">{{ auth()->user()->orders_count ?? 0 }}</div>
                        <small class="text-muted">Total Order</small>
                    </div>
                    <div class="vr text-danger opacity-25"></div>
                    <div>
                        <div class="fw-bold">{{ auth()->user()->favorites_count ?? 0 }}</div>
                        <small class="text-muted">Favourite</small>
                    </div>
                </div>

                {{-- Delete Action --}}
                <div class="col-md-auto ms-auto">
                    <form id="deleteAccountForm" method="POST" action="{{ route('customer.delete-account') }}">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-delete-account" onclick="confirmDelete()">
                            <i class="bi bi-trash3"></i> <span>Delete Account</span>
                        </button>
                    </form>
                </div>

            </div>
        </div>


        {{-- Grid Menu --}}
        <div class="menu-grid">

            <a href="{{ route('customer.profile') }}" class="menu-item">
                <i class="bi bi-person"></i> Profile
            </a>

            <a href="{{ route('myorders.index') }}" class="menu-item">
                <i class="bi bi-receipt"></i> My Order
            </a>

            <a href="#" class="menu-item">
                <i class="bi bi-star"></i> Menu
            </a>

            <a href="{{ route('notifications') }}" class="menu-item">
                <i class="bi bi-bell"></i> Notification
            </a>

            <a href="{{ route('wallet.index') }}" class="menu-item">
                <i class="bi bi-wallet2"></i> Wallet
            </a>

            <a href="{{ route('coupons') }}" class="menu-item">
                <i class="bi bi-ticket-perforated"></i> Coupon
            </a>

            <a href="{{ route('refer') }}" class="menu-item">
                <i class="bi bi-people"></i> Refer &amp; Earn
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="profile-tile danger-tile">
                    <i class="bi bi-box-arrow-right fs-4"></i>
                    <span class="mt-2 small">Logout</span>
                </button>
            </form>
        </div>

    </div>

    {{-- Modal Edit Profile --}}
    <div class="modal fade profile-modal" id="profileModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="modal-title">Edit Profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="#" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="upload-avatar-wrapper mb-4">
                        <img src="https://picsum.photos/100" alt="Avatar Preview">
                        <label for="avatarInput"><i class="bi bi-camera"></i></label>
                        <input type="file" id="avatarInput" name="avatar" class="d-none">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">First Name</label>
                        <input type="text" class="form-control" value="{{ auth()->user()->first_name }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Last Name</label>
                        <input type="text" class="form-control" value="{{ auth()->user()->last_name }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" value="{{ auth()->user()->email }}">
                    </div>

                    <div class="text-end mt-3">
                        <button class="btn btn-primary px-4">Save</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    {{-- Script --}}
    <script>
        function showProfileModal() {
            const modal = new bootstrap.Modal(document.getElementById('profileModal'));
            modal.show();
        }

        document.getElementById('avatarInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const img = document.querySelector('.upload-avatar-wrapper img');
                img.src = URL.createObjectURL(file);
            }
        });

        function confirmDelete() {
            const isDark = document.body.classList.contains('dark');

            Swal.fire({
                title: 'Are you sure?',
                text: "Deleting your account is irreversible.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Continue',
                cancelButtonText: 'Cancel',
                background: isDark ? '#1e1e1e' : '#fff',
                color: isDark ? '#f8f9fa' : '#212529',
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                reverseButtons: true,
                customClass: {
                    popup: 'rounded-4 shadow-lg',
                    confirmButton: 'btn btn-danger px-4 rounded-pill',
                    cancelButton: 'btn btn-secondary px-4 rounded-pill'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    askPinAndDelete(isDark);
                }
            });
        }

        function askPinAndDelete(isDark) {
            let timerInterval;
            let timeLeft = 30; // seconds

            Swal.fire({
                title: 'PIN Confirmation',
                html: `
                <p class="mb-2">Please enter your 6-digit security PIN to delete your account.</p>
                <input type="password" id="pinInput" class="swal2-input rounded-pill text-center" maxlength="6" placeholder="Enter PIN">
                <p class="text-danger small mt-2" id="countdown">Expires in <span id="pin-timer">${timeLeft}</span>s</p>
            `,
                focusConfirm: false,
                showCancelButton: true,
                confirmButtonText: 'Verify & Delete',
                cancelButtonText: 'Cancel',
                background: isDark ? '#1e1e1e' : '#fff',
                color: isDark ? '#f8f9fa' : '#212529',
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                customClass: {
                    popup: 'rounded-4 shadow-lg',
                    confirmButton: 'btn btn-danger px-4 rounded-pill',
                    cancelButton: 'btn btn-secondary px-4 rounded-pill'
                },
                didOpen: () => {
                    const pinInput = Swal.getPopup().querySelector('#pinInput');
                    pinInput.focus();

                    timerInterval = setInterval(() => {
                        timeLeft--;
                        const el = document.getElementById('pin-timer');
                        if (el) el.innerText = timeLeft;
                        if (timeLeft <= 0) {
                            clearInterval(timerInterval);
                            Swal.close();
                            Swal.fire({
                                icon: 'error',
                                title: 'Timed Out',
                                text: 'PIN entry timed out. Please try again.',
                                timer: 2500,
                                showConfirmButton: false,
                                background: isDark ? '#1e1e1e' : '#fff',
                                color: isDark ? '#f8f9fa' : '#212529',
                                customClass: {
                                    popup: 'rounded-4 shadow'
                                }
                            });
                        }
                    }, 1000);
                },
                preConfirm: () => {
                    const pin = document.getElementById('pinInput').value;
                    if (!pin || pin.length < 4) {
                        Swal.showValidationMessage('PIN must be at least 4 digits');
                        return false;
                    }
                    clearInterval(timerInterval);
                    return pin;
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Account Deleted',
                        text: 'Your account has been deleted successfully.',
                        timer: 2500,
                        showConfirmButton: false,
                        background: isDark ? '#1e1e1e' : '#fff',
                        color: isDark ? '#f8f9fa' : '#212529',
                        customClass: {
                            popup: 'rounded-4 shadow-lg'
                        }
                    }).then(() => {
                        document.getElementById('deleteAccountForm').submit();
                    });
                }
            });
        }
    </script>
@endsection
