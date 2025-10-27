@extends('Customer.layouts.app')
@section('title', 'Pesanan Saya')

@section('content')
    <style>
        .container-custom {
            max-width: 1140px;
            margin: auto;
            padding: 1.5rem 1rem;
        }

        .order-card {
            border-radius: 14px;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
            transition: background-color 0.3s, box-shadow 0.3s, border 0.3s;
        }

        body.dark .order-card {
            background-color: #252525;
            border: 1px solid rgba(255, 255, 255, 0.05);
            box-shadow: 0 0 0 1px rgba(255, 255, 255, 0.04), 0 4px 12px rgba(0, 0, 0, 0.5);
        }


        .order-progress {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-top: 10px;
        }

        .order-progress .dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #ccc;
            transition: background 0.3s;
        }

        .order-progress .dot.active {
            background: #0d6efd;
        }

        .order-status-bar {
            display: flex;
            justify-content: space-between;
            font-size: 0.75rem;
            color: #888;
            gap: 20px;
            margin-top: 4px;
        }

        body.dark .order-status-bar {
            color: #aaa;
        }

        .btn-back {
            display: none;
        }

        @media (max-width: 768px) {
            .btn-back {
                display: inline-flex;
                align-items: center;
                margin-bottom: 1rem;
                background: transparent;
                border: none;
                font-size: 1rem;
                color: var(--fg-dark);
            }

            body.dark .btn-back {
                color: #fff;
            }
        }

        .swal2-popup {
            border-radius: 18px !important;
            padding: 1.5rem !important;
            max-width: 600px;
        }

        body.dark .swal2-popup {
            background-color: #1e1e1e !important;
            color: #fff;
        }

        .receipt-box {
            border: 1px dashed #ccc;
            border-radius: 10px;
            padding: 1rem;
            background: #f8f9fa;
            margin-top: 1rem;
        }

        body.dark .receipt-box {
            background: #2b2b2b;
            border-color: #555;
        }

        .modal-header-custom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: bold;
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }

        .modal-close-btn {
            cursor: pointer;
            font-size: 1.2rem;
            font-weight: bold;
        }

        .progress-steps {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
            flex-wrap: wrap;
        }

        .step-item {
            flex: 1;
            text-align: center;
            position: relative;
        }

        .step-item:not(:last-child)::after {
            content: "";
            position: absolute;
            top: 12px;
            left: 50%;
            width: 100%;
            height: 3px;
            background: #ccc;
            transform: translateX(0%);
            z-index: 0;
        }

        .step-item.step-complete:not(:last-child)::after {
            background: #28a745;
            /* hijau untuk yang sudah selesai */
        }

        .step-circle {
            width: 24px;
            height: 24px;
            background: #ccc;
            border-radius: 50%;
            margin: auto;
            line-height: 24px;
            color: white;
            z-index: 1;
            position: relative;
            font-size: 14px;
        }

        .step-complete .step-circle {
            background: #28a745;
        }

        .step-circle {
            width: 24px;
            height: 24px;
            background: #ccc;
            border-radius: 50%;
            margin: auto;
            line-height: 24px;
            color: white;
            z-index: 1;
            position: relative;
        }

        .step-complete .step-circle {
            background: #28a745;
        }

        .step-complete::after {
            background: #28a745;
        }

        .step-label {
            font-size: 0.75rem;
            margin-top: 5px;
        }

        @media (max-width: 768px) {
            .swal2-popup {
                width: 100% !important;
                margin: 0 !important;
                bottom: 0;
                position: fixed !important;
                left: 0;
                border-radius: 18px 18px 0 0 !important;
                animation: slideUp 0.3s ease-out;
            }

            @keyframes slideUp {
                from {
                    transform: translateY(100%);
                }

                to {
                    transform: translateY(0);
                }
            }
        }

        .nav-tabs .nav-link {
            color: #0d6efd;
        }

        body.dark .nav-tabs .nav-link {
            color: #9db4d3;
        }

        body.dark .nav-tabs .nav-link.active {
            background-color: #2b2b2b !important;
            color: #fff;
            border-color: #444 #444 #2b2b2b;
        }

        .text-muted {
            color: #6c757d !important;
        }

        body.dark .text-muted {
            color: #ccc !important;
        }


        /* style modal reviews */
        .modal {
            z-index: 3090;
        }

        .review-modal-content {
            border-radius: 1.25rem;
            padding: 1.5rem 1.5rem 2rem;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease-in-out;
        }

        .rating-stars .star {
            color: #ccc;
            cursor: pointer;
            transition: transform 0.2s, color 0.2s;
        }

        .rating-stars .star:hover,
        .rating-stars .star.hovered,
        .rating-stars .star.selected {
            color: #ffc107;
            transform: scale(1.2);
        }

        body.dark .review-modal-content {
            background-color: #1e1e1e;
            color: #f1f1f1;
        }

        body.dark .form-control {
            background: #2a2a2a;
            color: #fff;
            border-color: #444;
        }

        body.dark .btn-close {
            filter: invert(1);
        }

        body.dark .star {
            color: #555;
        }

        body.dark .star.selected {
            color: #f8c300;
        }

        @media (max-width: 768px) {
            .modal.modal-review {
                padding: 0 !important;
            }

            .modal.modal-review .modal-dialog {
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                margin: 0;
                width: 100%;
                max-width: none;
                transform: translateY(100%);
                transition: transform 0.35s ease-in-out;
                z-index: 3080;
            }

            .modal.modal-review.show .modal-dialog {
                transform: translateY(0%);
            }

            .modal.modal-review .modal-content {
                border-radius: 1.25rem 1.25rem 0 0;
                border: none;
                margin-bottom: env(safe-area-inset-bottom, 0);
            }

            body.modal-open {
                overflow: hidden;
            }
        }
    </style>

    <div class="container-custom">
        <button onclick="history.back()" class="btn-back"><i class="bi bi-arrow-left me-1"></i> Kembali</button>
        <h4 class="fw-bold mb-4">Pesanan Saya</h4>

        <ul class="nav nav-tabs mb-3" id="orderTabs">
            <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#proses">Sedang Diproses</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#selesai">Selesai</button>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="proses">
                @foreach ($proses as $order)
                    <div class="order-card p-3 mb-3">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="mb-1 fw-bold">Order ID: {{ $order->order_number }}</h6>
                                <small class="text-muted">{{ $order->created_at->diffForHumans() }} &bull;
                                    {{ $order->details->sum('quantity') }} item</small>

                                {{-- Progress Bar --}}
                                @php
                                    $statusSteps = [
                                        'pending' => 0,
                                        'konfirmasi' => 0,
                                        'processing' => 1,
                                        'diproses' => 1,
                                        'dikirim' => 2,
                                        'completed' => 3,
                                        'selesai' => 3,
                                    ];

                                    $currentStep = $statusSteps[strtolower($order->status)] ?? 0;
                                @endphp

                                <div class="order-progress mt-2 align-items-center">
                                    @for ($i = 0; $i <= 2; $i++)
                                        <div class="dot {{ $i <= $currentStep ? 'active' : '' }}"></div>
                                        @if ($i < 2)
                                            <div class="bar flex-grow-1 {{ $i < $currentStep ? 'bg-primary' : 'bg-secondary' }}"
                                                style="height: 2px;"></div>
                                        @endif
                                    @endfor
                                </div>

                                <div class="order-status-bar">
                                    <span>Konfirmasi</span>
                                    <span>Diproses</span>
                                    <span>Selesai</span>
                                </div>
                            </div>
                            <div class="text-end">
                                @php
                                    $badgeClass = match (strtolower($order->status)) {
                                        'pending' => 'bg-warning text-dark',
                                        'processing' => 'bg-primary',
                                        'completed', 'selesai' => 'bg-success',
                                        'cancelled', 'dibatalkan' => 'bg-danger',
                                        default => 'bg-secondary',
                                    };
                                @endphp
                                <span class="badge {{ $badgeClass }} rounded-pill text-capitalize">
                                    @if ($order->status === 'completed' || $order->status === 'selesai')
                                        ✅
                                    @elseif ($order->status === 'cancelled')
                                        ❌
                                    @elseif ($order->status === 'processing')
                                        🔄
                                    @else
                                        ⏳
                                    @endif
                                    {{ ucfirst($order->status) }}
                                </span>
                                <br>
                                <div class="text-danger mt-2">Rp{{ number_format($order->total_amount) }}</div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end gap-2 mt-3">
                            <button class="btn btn-outline-secondary btn-sm rounded-pill"
                                onclick="showDetail('{{ $order->order_number }}', '{{ $order->status }}')">Lihat
                                Detail</button>
                            <button class="btn btn-danger btn-sm rounded-pill"
                                onclick="cancelOrder('{{ $order->order_number }}')">Batalkan</button>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="tab-pane fade" id="selesai">
                @foreach ($selesai as $order)
                    <div class="order-card p-3 mb-3">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="mb-1 fw-bold">Order ID: {{ $order->order_number }}</h6>
                                <small class="text-muted">{{ $order->created_at->diffForHumans() }} &bull;
                                    {{ $order->details->sum('quantity') }} item</small>
                                @php
                                    $status = strtolower($order->status);
                                    $badgeClass = match ($status) {
                                        'pending' => 'bg-warning text-dark',
                                        'processing' => 'bg-primary',
                                        'completed', 'selesai' => 'bg-success',
                                        'cancelled', 'dibatalkan' => 'bg-danger',
                                        default => 'bg-secondary',
                                    };

                                    $statusLabel = match ($status) {
                                        'pending' => 'Pesanan Belum Diproses',
                                        'processing' => 'Pesanan Sedang Diproses',
                                        'completed', 'selesai' => 'Pesanan Telah Selesai',
                                        'cancelled', 'dibatalkan' => 'Pesanan Dibatalkan',
                                        default => 'Status Tidak Dikenal',
                                    };

                                    $textColor = match ($status) {
                                        'completed', 'selesai' => 'text-success',
                                        'cancelled', 'dibatalkan' => 'text-danger',
                                        'pending' => 'text-warning',
                                        'processing' => 'text-primary',
                                        default => 'text-muted',
                                    };
                                @endphp

                                <div class="mt-2 fw-semibold {{ $textColor }}">{{ $statusLabel }}</div>
                            </div>
                            <div class="text-end">
                                <span class="badge {{ $badgeClass }} rounded-pill text-capitalize">
                                    @if ($status === 'completed' || $status === 'selesai')
                                        ✅
                                    @elseif ($status === 'cancelled' || $status === 'dibatalkan')
                                        ❌
                                    @elseif ($status === 'processing')
                                        🔄
                                    @elseif ($status === 'pending')
                                        ⏳
                                    @endif
                                    {{ ucfirst($order->status) }}
                                </span>
                                <br>
                                <div class="text-success mt-2">Rp{{ number_format($order->total_amount) }}</div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-3 gap-2">
                            <button class="btn btn-outline-secondary btn-sm rounded-pill"
                                onclick="showDetail('{{ $order->order_number }}', '{{ $order->status }}')">Lihat
                                Detail</button>

                            <button class="btn btn-outline-primary btn-sm rounded-pill"
                                onclick="showReviewModal('{{ $order->order_number }}')">Beri Ulasan</button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- modal reviews --}}
    <div class="modal fade modal-review" id="reviewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content review-modal-content">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="modal-title fw-semibold">📝 Beri Ulasan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="reviewForm">
                    <input type="hidden" id="reviewOrderId">

                    <div class="mb-4 text-center">
                        <div class="rating-stars fs-3 d-flex justify-content-center gap-2">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="bi bi-star-fill star" data-value="{{ $i }}"></i>
                            @endfor
                        </div>
                        <small id="ratingHint" class="text-muted mt-2 d-block">Pilih rating sesuai pengalamanmu</small>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="reviewComment" placeholder="Komentar..." style="height: 100px"></textarea>
                        <label for="reviewComment">Tulis komentarmu...</label>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary rounded-pill py-2 shadow-sm">Kirim Ulasan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            fetch("{{ route('cart.meta.qty') }}")
                .then(res => res.json())
                .then(data => {
                    if (typeof updateCartBadge === 'function') {
                        updateCartBadge(data.qty || 0);
                    }
                });
        });

        document.addEventListener('DOMContentLoaded', () => {
            fetch("{{ route('cart.meta.qty') }}")
                .then(res => res.json())
                .then(data => {
                    if (typeof updateCartBadge === 'function') {
                        updateCartBadge(data.qty || 0);
                    }
                });
        });


        function showDetail(orderNumber, status) {
            fetch(`{{ route('myorders.show', ':id') }}`.replace(':id', orderNumber))
                .then(res => res.json())
                .then(data => {
                    const steps = ['Konfirmasi', 'Diproses', 'Dikirim', 'Selesai'];
                    const statusMap = {
                        pending: 0,
                        processing: 1,
                        dikirim: 2,
                        selesai: 3,
                        completed: 3,
                        cancelled: -1
                    };

                    const currentIndex = statusMap[status.toLowerCase()] ?? -1;

                    let progressHTML = '';

                    if (currentIndex === -1) {
                        progressHTML = `
                    <div class="text-danger fw-bold text-center">❌ Pesanan Dibatalkan</div>
                `;
                    } else {
                        progressHTML = steps.map((step, index) => `
                    <div class="step-item ${index <= currentIndex ? 'step-complete' : ''}">
                        <div class="step-circle">${index <= currentIndex ? '✔' : ''}</div>
                        <div class="step-label">${step}</div>
                    </div>
                `).join('');
                    }

                    const html = `
                <div class="modal-header-custom">
                    <span>Detail Pesanan</span>
                    <span class="modal-close-btn" onclick="Swal.close(); removeSwalBackdrop();">&times;</span>
                </div>
                <div class="progress-steps">${progressHTML}</div>
                <div class="receipt-box">
                    <p><strong>ID:</strong> ${data.id}</p>
                    <p><strong>Waktu:</strong> ${data.created_at}</p>
                    <p><strong>Metode Bayar:</strong> ${data.payment}</p>
                    <p><strong>Item:</strong><br> ${data.items.map(i => '🍽️ ' + i).join('<br>')}</p>
                    <p><strong>Catatan:</strong> ${data.note}</p>
                    <p><strong>Total:</strong> Rp${data.total}</p>
                    <p><strong>Status:</strong> <span class="badge ${badgeColorClass(data.status)}">${statusLabel(data.status)}</span></p>
                </div>`;

                    Swal.fire({
                        html: html,
                        showConfirmButton: false,
                        showCloseButton: false,
                        backdrop: true,
                        customClass: {
                            popup: 'swal2-popup'
                        },
                        didClose: removeSwalBackdrop
                    });
                });
        }


        function removeSwalBackdrop() {
            const swalContainer = document.querySelector('.swal2-container');
            if (swalContainer) swalContainer.remove();
            document.body.classList.remove('swal2-shown');
            document.body.style.overflow = '';
        }

        function cancelOrder(id) {
            Swal.fire({
                title: 'Alasan Pembatalan',
                input: 'text',
                inputPlaceholder: 'Tulis alasan pembatalan...',
                showCancelButton: true,
                confirmButtonText: 'Kirim',
                cancelButtonText: 'Batal',
                preConfirm: (reason) => {
                    if (!reason) {
                        Swal.showValidationMessage('Harap isi alasan pembatalan');
                    }
                    return reason;
                }
            }).then(result => {
                if (result.isConfirmed) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Dibatalkan',
                        text: `Pesanan ${id} dibatalkan.`,
                        confirmButtonText: 'Tutup'
                    });
                }
            });
        }

        // modal script reviews
        let selectedRating = 0;

        function showReviewModal(orderId) {
            document.getElementById('reviewOrderId').value = orderId;
            document.getElementById('reviewComment').value = '';
            selectedRating = 0;

            document.querySelectorAll('.star').forEach(star => {
                star.classList.remove('selected');
            });

            const modal = new bootstrap.Modal(document.getElementById('reviewModal'));
            modal.show();
        }

        // Rating selection
        document.querySelectorAll('.star').forEach(star => {
            star.addEventListener('mouseenter', function() {
                const value = parseInt(this.dataset.value);
                highlightStars(value);
            });

            star.addEventListener('mouseleave', function() {
                highlightStars(selectedRating);
            });

            star.addEventListener('click', function() {
                selectedRating = parseInt(this.dataset.value);
                highlightStars(selectedRating);
            });
        });

        function highlightStars(value) {
            document.querySelectorAll('.star').forEach(star => {
                const v = parseInt(star.dataset.value);
                star.classList.toggle('selected', v <= value);
            });
        }

        // Submit review
        document.getElementById('reviewForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const orderId = document.getElementById('reviewOrderId').value;
            const comment = document.getElementById('reviewComment').value;

            if (!selectedRating) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Rating belum dipilih!',
                    text: 'Silakan beri bintang sebelum mengirim.',
                    background: document.body.classList.contains('dark') ? '#1e1e1e' : '#fff',
                    color: document.body.classList.contains('dark') ? '#f1f1f1' : '#000',
                    customClass: {
                        popup: 'rounded-4 shadow'
                    }
                });
                return;
            }

            bootstrap.Modal.getInstance(document.getElementById('reviewModal')).hide();

            Swal.fire({
                icon: 'success',
                title: 'Ulasan Dikirim!',
                text: 'Terima kasih atas ulasanmu.',
                timer: 2500,
                showConfirmButton: false,
                background: document.body.classList.contains('dark') ? '#1e1e1e' : '#fff',
                color: document.body.classList.contains('dark') ? '#f1f1f1' : '#000',
                customClass: {
                    popup: 'rounded-4 shadow'
                }
            });

            // submit ke server
            // console.log({ orderId, selectedRating, comment });
        });

        const statusLabelMap = {
            pending: 'Menunggu',
            processing: 'Diproses',
            completed: 'Selesai',
            cancelled: 'Dibatalkan'
        };

        function statusLabel(status) {
            return statusLabelMap[status] ?? status.charAt(0).toUpperCase() + status.slice(1);
        }

        function badgeColorClass(status) {
            const normalized = status.toLowerCase();
            if (normalized === 'pending') return 'bg-warning text-dark';
            if (normalized === 'processing') return 'bg-primary';
            if (normalized === 'completed' || normalized === 'selesai') return 'bg-success';
            if (normalized === 'cancelled' || normalized === 'dibatalkan') return 'bg-danger';
            return 'bg-secondary';
        }
    </script>
@endsection
