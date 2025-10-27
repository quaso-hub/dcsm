@extends('Customer.layouts.app')

@section('title', 'Notifikasi')

@section('content')
    <style>
        .container {
            max-width: 1140px;
        }

        .notif-card {
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(4px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            animation: fadeIn 0.5s ease;
        }

        .notif-item {
            transition: all 0.3s ease;
            cursor: pointer;
            padding: 1rem 1.25rem;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
            background-color: transparent;
            border-bottom: 1px solid #e0e0e0;
            animation: fadeUp 0.4s ease forwards;
            opacity: 0;
        }

        .notif-item:last-child {
            border-bottom: none;
        }

        .notif-item:hover {
            background-color: rgba(0, 0, 0, 0.025);
        }

        .notif-icon {
            animation: ring 1.5s infinite;
        }

        @keyframes ring {
            0% {
                transform: rotate(0deg);
            }

            10% {
                transform: rotate(15deg);
            }

            20% {
                transform: rotate(-10deg);
            }

            30% {
                transform: rotate(5deg);
            }

            40% {
                transform: rotate(-5deg);
            }

            50% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(0deg);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.98);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .notif-item:nth-child(1) {
            animation-delay: 0s;
        }

        .notif-item:nth-child(2) {
            animation-delay: 0.05s;
        }

        .notif-item:nth-child(3) {
            animation-delay: 0.1s;
        }

        .notif-item:nth-child(4) {
            animation-delay: 0.15s;
        }

        body.dark .notif-card {
            background-color: rgba(34, 34, 34, 0.9);
            box-shadow: 0 8px 24px rgba(255, 255, 255, 0.05);
        }

        body.dark .notif-item {
            border-color: #444;
            color: #f0f0f0;
        }

        body.dark .notif-item:hover {
            background-color: rgba(255, 255, 255, 0.03);
        }

        body.dark .text-muted {
            color: #bbb !important;
        }

        .modal.fade .modal-dialog {
            transform: translateY(30px);
            transition: transform 0.3s ease-out, opacity 0.3s ease-out;
        }

        .modal.fade.show .modal-dialog {
            transform: translateY(0);
        }

        body.dark .modal-content {
            background-color: #1f1f1f;
            color: #fff;
        }

        body.dark .modal-header,
        body.dark .modal-footer {
            border-color: #333;
        }

        @media (max-width: 576px) {
            .mobile-back {
                display: inline-block;
            }

            .notif-item {
                flex-direction: column;
                align-items: flex-start;
            }

            .notif-time {
                margin-top: 0.5rem;
            }
        }

        @media (min-width: 577px) {
            .mobile-back {
                display: none;
            }
        }

        .modal {
            z-index: 4000;
        }

        .notif-scroll-container {
            max-height: 70vh;
            overflow-y: auto;
            scrollbar-width: none;
            -ms-overflow-style: none;
            padding-bottom: 1rem;
        }

        .notif-scroll-container::-webkit-scrollbar {
            display: none;
        }

        @media (max-width: 576px) {
            .notif-scroll-container {
                padding-bottom: 5rem;
            }
        }

        /* modal sheet bottom */
        @media (max-width: 576px) {
            .modal.modal-slide-up .modal-dialog {
                margin: 0;
                height: 100%;
                display: flex;
                align-items: flex-end;
            }

            .modal.modal-slide-up .modal-content {
                width: 100%;
                border-radius: 20px 20px 0 0;
                margin: 0;
                border: none;
                animation: slideUpMobile 0.4s ease-out;
            }

            @keyframes slideUpMobile {
                from {
                    transform: translateY(100%);
                    opacity: 0;
                }

                to {
                    transform: translateY(0);
                    opacity: 1;
                }
            }
        }

        body.dark .modal-content {
            background-color: #1e1e1e;
            color: #fff;
        }

        body.dark .modal-header,
        body.dark .modal-footer {
            border-color: #333;
        }

        body.dark .btn-close {
            filter: invert(1);
        }

        .modal-content {
            border-radius: 20px;
        }

        @media (max-width: 576px) {
            .modal.modal-slide-up .modal-content {
                border-radius: 20px 20px 0 0 !important;
            }
        }
    </style>

    <div class="container py-4">

        {{-- Mobile Back Button --}}
        <a href="{{ route('home.index') }}" class="btn btn-outline-secondary btn-sm mb-3 mobile-back">
            Back
        </a>

        {{-- Judul --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0"><i class="bi bi-bell-fill text-warning me-2"></i>Notifikasi</h4>
        </div>

        {{-- Dummy Data --}}
        @php
            $notifications = [
                [
                    'title' => 'Promo Hari Ini!',
                    'desc' => 'Diskon 30% untuk semua menu Pizza. Berlaku sampai jam 10 malam!',
                    'time' => '5 menit yang lalu',
                ],
                [
                    'title' => 'Pesanan Diterima',
                    'desc' => 'Pesanan kamu sedang diproses oleh restoran.',
                    'time' => '1 jam yang lalu',
                ],
                [
                    'title' => 'Voucher Baru!',
                    'desc' => 'Gunakan kode "MAKANHEMAT" untuk potongan Rp15.000',
                    'time' => '3 jam yang lalu',
                ],
                [
                    'title' => 'Update Aplikasi',
                    'desc' => 'Yuk update aplikasi untuk fitur baru & pengalaman lebih cepat.',
                    'time' => 'Kemarin',
                ],
            ];
        @endphp

        @if (count($notifications) > 0)
            <div class="notif-scroll-container notif-card">
                @foreach ($notifications as $i => $notif)
                    <div class="list-group-item notif-item" data-bs-toggle="modal" data-bs-target="#notifModal"
                        data-title="{{ $notif['title'] }}" data-desc="{{ $notif['desc'] }}"
                        data-time="{{ $notif['time'] }}">
                        <div class="me-3">
                            <i class="bi bi-bell-fill text-primary fs-4 notif-icon"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="fw-semibold">{{ $notif['title'] }}</div>
                            <div class="text-muted small">{{ $notif['desc'] }}</div>
                        </div>
                        <small class="text-muted ms-2 notif-time">{{ $notif['time'] }}</small>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-bell-slash fs-1 text-secondary"></i>
                <h6 class="mt-3">Tidak ada notifikasi</h6>
                <p class="text-muted">Notifikasi kamu akan muncul di sini saat tersedia.</p>
            </div>
        @endif

    </div>

    {{-- Modal --}}
    <div class="modal fade" id="notifModal" tabindex="-1" aria-labelledby="notifModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-custom-slide">
            <div class="modal-content shadow-lg border-0 rounded-4 p-3">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold fs-5" id="notifModalLabel">📨 Detail Notifikasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <h6 id="modalNotifTitle" class="fw-semibold mb-2 fs-6 text-primary"></h6>
                    <p class="text-muted small mb-1" id="modalNotifTime"></p>
                    <p id="modalNotifDesc" class="mt-3 mb-0 lh-lg"></p>
                </div>
            </div>
        </div>
    </div>


    <script>
        const notifModal = document.getElementById('notifModal');
        notifModal.addEventListener('show.bs.modal', function(event) {
            const trigger = event.relatedTarget;
            const title = trigger.getAttribute('data-title');
            const desc = trigger.getAttribute('data-desc');
            const time = trigger.getAttribute('data-time');

            notifModal.querySelector('#modalNotifTitle').textContent = title;
            notifModal.querySelector('#modalNotifDesc').textContent = desc;
            notifModal.querySelector('#modalNotifTime').textContent = time;

            if (window.innerWidth <= 576) {
                notifModal.classList.add('modal-slide-up');
            } else {
                notifModal.classList.remove('modal-slide-up');
            }
        });
    </script>
@endsection
