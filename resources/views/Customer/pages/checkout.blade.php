@extends('Customer.layouts.app')
@section('title', 'Checkout')

@section('content')
    <style>
        :root {
            --bg-light: #fff;
            --bg-dark: #2a2a2a;
            --fg-light: #333;
            --fg-dark: #eee;
            --sec-light: #666;
            --sec-dark: #bbb;
            --accent: #0d6efd;
        }

        body {
            color: var(--fg-light);
        }

        body.dark {
            color: var(--fg-dark);
        }

        .container {
            max-width: 1140px !important;
            padding: 2rem 1rem;
        }

        .btn-back {
            background: transparent;
            border: none;
            font-size: 1.3rem;
            color: var(--fg-light);
        }

        body.dark .btn-back {
            color: var(--fg-dark);
        }

        .card-box {
            background: var(--bg-light);
            border-radius: 1rem;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, .06);
            transition: background .3s;
        }

        body.dark .card-box {
            background: var(--bg-dark);
        }

        .form-check-label {
            font-weight: 500;
            cursor: pointer;
        }

        .summary-label {
            color: var(--sec-light);
        }

        body.dark .summary-label {
            color: var(--sec-dark);
        }

        /* ==========================
                                                                                                                                   MODAL & BOTTOMSHEET STYLE
                                                                                                                                =========================== */

        .modal {
            z-index: 3000;
        }

        .modal-backdrop.show {
            opacity: .5 !important;
        }

        .modal-dialog {
            max-width: 420px;
            margin: 1.5rem auto;
        }

        .modal-content {
            border-radius: 1rem;
            overflow: hidden;
            background: var(--bg-light);
            color: inherit;
            transition: background .3s;
            scrollbar-width: none;
            padding-bottom: 1rem;
        }

        .modal-content::-webkit-scrollbar {
            display: none;
        }

        body.dark .modal-content {
            background: var(--bg-dark);
        }

        .modal .btn-close {
            position: absolute;
            top: 0.75rem;
            right: 0.75rem;
            z-index: 10;
        }

        .close-btn {
            background: transparent;
            border: none;
            font-size: 1.25rem;
            color: inherit;
            position: absolute;
            top: .8rem;
            right: 1rem;
        }

        .btn-pay {
            background: var(--accent);
            border: none;
            color: #fff;
        }

        .fade-step {
            display: none;
            animation: fade .3s ease;
        }

        @keyframes fade {
            from {
                opacity: 0;
                transform: translateX(30px);
            }

            to {
                opacity: 1;
                transform: none;
            }
        }

        /* ==========================
                                                                                                                                   BOTTOM SHEET MOBILE STYLE
                                                                                                                                =========================== */
        @media (max-width: 768px) {
            .modal.bottomsheet .modal-dialog {
                margin: 0;
                width: 100%;
                max-width: none;
                display: flex;
                align-items: flex-end;
            }

            .modal.bottomsheet .modal-content {
                width: 100%;
                border-radius: 1rem 1rem 0 0;
                margin: 0;
                max-height: 95vh;
                overflow-y: auto;
                transform: translateY(100%);
                transition: transform 0.3s ease;
            }

            .modal.bottomsheet.fade.show .modal-content {
                transform: translateY(0);
            }


            .with-bottomnav {
                padding-bottom: 80px;
            }

            .bottomnav-fixed {
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                z-index: 1055;
                background: #fff;
                border-top: 1px solid #ddd;
            }

            body.dark .bottomnav-fixed {
                background: #1f1f1f;
                border-color: #333;
            }
        }

        /* ===============================
                                                                                                                       MODAL - BOTTOMSHEET RESPONSIVE
                                                                                                                    ================================= */

        .modal.modal-bottom-sheet {
            z-index: 3000;
        }

        .modal.modal-bottom-sheet .modal-dialog {
            max-width: 420px;
            width: 100%;
            margin: auto;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            pointer-events: none;
            position: relative;
        }

        .modal.modal-bottom-sheet .modal-content {
            border-radius: 1rem;
            background: var(--bg-light);
            transition: background 0.3s ease;
            color: inherit;
            pointer-events: all;
            width: 100%;
            max-height: 95vh;
            overflow-y: auto;
            scrollbar-width: none;
            margin: auto;
        }

        .modal-content::-webkit-scrollbar {
            display: none;
        }

        body.dark .modal.modal-bottom-sheet .modal-content {
            background: var(--bg-dark);
        }

        /* Button close position */
        .modal .btn-close {
            position: absolute;
            top: 0.75rem;
            right: 0.75rem;
            z-index: 10;
        }

        /* === BOTTOM SHEET for Mobile === */
        @media (max-width: 768px) {
            .modal.modal-bottom-sheet .modal-dialog {
                margin: 0;
                max-width: 100%;
                width: 100%;
                min-height: auto;
                height: auto;
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                align-items: flex-end;
                justify-content: center;
            }

            .modal.modal-bottom-sheet .modal-content {
                border-radius: 1rem 1rem 0 0;
                transform: translateY(100%);
                transition: transform 0.3s ease-out;
                max-height: 95vh;
                margin: 0;
            }

            .modal.modal-bottom-sheet.show .modal-content {
                transform: translateY(0);
            }
        }



        /* ==========================
                                                                                                                                   UI COMPONENT ENHANCEMENT
                                                                                                                                =========================== */

        .card-option {
            cursor: pointer;
            transition: transform 0.2s ease, background-color 0.2s;
        }

        .card-option:hover {
            transform: scale(1.02);
            background-color: rgba(13, 110, 253, 0.05);
        }

        body.dark .card-option:hover {
            background-color: rgba(255, 255, 255, 0.05);
        }

        .bg-wallet-box {
            background-color: #f8f9fa;
        }

        body.dark .bg-wallet-box {
            background-color: #2c2c2c !important;
        }

        body.dark .alert-warning {
            background-color: rgba(255, 193, 7, 0.1);
            color: #ffc107;
            border-color: #ffc10733;
        }


        .text-dynamic {
            color: #212529;
        }

        body.dark .text-dynamic {
            color: #ffffff;
        }

        body.dark .text-muted {
            color: #cccccc !important;
        }

        body.dark .dark-text-instruction {
            color: #cccccc;
        }

        body.dark .text-wallet-label {
            color: #ffffff;
        }

        .text-wallet-label {
            color: #212529;
        }

        .text-wallet-value {
            color: #000000;
        }

        body.dark .text-wallet-value {
            color: #ffffff;
        }

        body.dark .alert-warning .text-dark,
        body.dark .dark-text-warning {
            color: #f8f8f8 !important;
        }

        body.dark .swal2-popup {
            background-color: #2a2a2a !important;
            color: #fff !important;
        }

        body.dark .swal2-title,
        body.dark .swal2-html-container {
            color: #fff !important;
        }

        body.dark .swal2-confirm {
            background-color: #6366f1 !important;
            color: #fff !important;
        }


        body.dark .bg-wallet-box {
            background-color: #2e2e2e !important;
            box-shadow: inset 0 0 0 1px #444;
            border-radius: 0.5rem;
        }


        .payment-option {
            border: 1px solid #ccc;
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            background: var(--bg-light);
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .payment-option:hover {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
            border-color: var(--accent);
        }

        body.dark .payment-option {
            background: #1f1f1f;
            border-color: #444;
        }

        body.dark .payment-option:hover {
            border-color: #0d6efd;
            background: #292929;
        }

        .payment-option input[type="radio"] {
            transform: scale(1.25);
        }
    </style>


    <div class="container">
        <div class="d-flex align-items-center mb-4">
            <button class="btn-back me-3" onclick="location.href='{{ route('cart.index') }}'"><i
                    class="bi bi-arrow-left"></i></button>
            <h4 class="fw-bold mb-0">Checkout</h4>
        </div>

        <div class="card-box">
            <h6 class="mb-3">Payment Method</h6>

            <div class="payment-option mb-2" onclick="document.getElementById('payment_wallet').checked = true">
                <label class="form-check-label d-flex align-items-center" for="payment_wallet">
                    <input class="form-check-input me-3" type="radio" name="pay" id="payment_wallet" value="wallet">
                    <i class="bi bi-wallet2 fs-5 me-2"></i>
                    <strong>Wallet</strong> <span class="ms-2 text-muted"> (Saldo:
                        Rp{{ number_format($walletBalance) }})</span>
                </label>
            </div>

            @foreach ($paymentMethods as $method)
                <div class="payment-option mb-2"
                    onclick="document.getElementById('payment_{{ $method->id }}').checked = true">
                    <label class="form-check-label d-flex align-items-center" for="payment_{{ $method->id }}">
                        <input class="form-check-input me-3" type="radio" name="pay" id="payment_{{ $method->id }}"
                            value="{{ $method->id }}">
                        <i class="bi {{ $method->icon ?? 'bi-credit-card' }} fs-5 me-2"></i>
                        <strong>{{ $method->name }}</strong>
                    </label>
                </div>
            @endforeach
        </div>



        <div class="card-box">
            <h6 class="mb-3">Order Summary</h6>
            <ul class="list-group list-group-flush">
                <li class="d-flex justify-content-between">
                    <span class="summary-label">Subtotal</span>
                    <span>Rp{{ number_format($subtotal) }}</span>
                </li>
                <li class="d-flex justify-content-between">
                    <span class="summary-label">Delivery</span>
                    <span>Rp0</span> {{-- Kalau delivery nggak dipakai --}}
                </li>
                <li class="d-flex justify-content-between">
                    <span class="summary-label">Tax 11%</span>
                    <span>Rp{{ number_format($tax) }}</span>
                </li>
                <li class="d-flex justify-content-between">
                    <span class="summary-label">Service Fee</span>
                    <span>Rp{{ number_format($fee) }}</span>
                </li>
                <li class="d-flex justify-content-between fw-bold">
                    <span>Total</span>
                    <span class="text-danger">Rp{{ number_format($total) }}</span>
                </li>
            </ul>
        </div>

        <div class="card-box">
            <label class="form-label">Note for Restaurant</label>
            <textarea class="form-control" rows="3" placeholder="e.g. No peanuts, extra chili…"></textarea>
        </div>

        <div class="text-end mb-5"><button class="btn btn-success btn-lg" onclick="pay()">Confirm Order</button></div>
    </div>

    {{-- MODALS --}}
    <div class="modal fade modal-bottom-sheet" id="modalCard" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

                <div class="modal-body">
                    <div id="card-choose" class="fade-step">
                        <h5 class="mb-3">Choose Method</h5>

                        <div class="card mb-3 shadow-sm card-option" onclick="step('card','card-form')">
                            <div class="card-body d-flex align-items-center">
                                <i class="bi bi-credit-card fs-4 me-3 text-primary"></i>
                                <strong>Debit / Card</strong>
                            </div>
                        </div>

                        <div class="card mb-3 shadow-sm card-option" onclick="step('card','va-bank')">
                            <div class="card-body d-flex align-items-center">
                                <i class="bi bi-bank fs-4 me-3 text-primary"></i>
                                <strong>Bank Transfer / VA</strong>
                            </div>
                        </div>
                    </div>

                    <div id="card-form" class="fade-step">
                        <button class="btn-back mb-2" onclick="step('card','card-choose')"><i
                                class="bi bi-arrow-left"></i></button>
                        <h5 class="mb-2">Debit / Card</h5>
                        <input class="form-control mb-2" placeholder="Card Number">
                        <input class="form-control mb-2" placeholder="Name on Card">
                        <input class="form-control mb-2" placeholder="Expiry (MM/YY)">
                        <input class="form-control mb-3" placeholder="CVC">
                        <button class="btn btn-pay w-100" onclick="finish()">Pay Rp{{ number_format($total) }}</button>
                    </div>

                    <div id="va-bank" class="fade-step">
                        <button class="btn-back mb-2" onclick="step('card','card-choose')">
                            <i class="bi bi-arrow-left"></i>
                        </button>
                        <h5 class="mb-3">Select Bank</h5>

                        <div class="card mb-3 shadow-sm card-option" onclick="setBank('BCA','1234567890')">
                            <div class="card-body d-flex align-items-center">
                                <i class="bi bi-building fs-4 me-3 text-primary"></i>
                                <strong>BCA</strong>
                            </div>
                        </div>

                        <div class="card mb-3 shadow-sm card-option" onclick="setBank('Mandiri','9876543210')">
                            <div class="card-body d-flex align-items-center">
                                <i class="bi bi-building fs-4 me-3 text-primary"></i>
                                <strong>Mandiri</strong>
                            </div>
                        </div>

                        <div class="card mb-3 shadow-sm card-option" onclick="setBank('BNI','4561237890')">
                            <div class="card-body d-flex align-items-center">
                                <i class="bi bi-building fs-4 me-3 text-primary"></i>
                                <strong>BNI</strong>
                            </div>
                        </div>
                    </div>

                    <div id="va-form" class="fade-step">
                        <button class="btn-back mb-3" onclick="step('card','va-bank')">
                            <i class="bi bi-arrow-left"></i>
                        </button>

                        <h5 class="mb-3">Bank Transfer (VA)</h5>

                        <div class="mb-3 d-flex align-items-center">
                            <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center me-3"
                                style="width: 40px; height: 40px;">
                                <i class="bi bi-bank fs-5"></i>
                            </div>
                            <div>
                                <div class="fw-bold" id="bankTitle">Bank : BCA</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label mb-1">Virtual Account Number</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="vaNumber" value="1234567890" readonly>
                                <button class="btn btn-outline-secondary" type="button" onclick="copyVA()">Copy</button>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label mb-1">Amount</label>
                            <div class="form-control fw-bold bg-light text-dark dark-bg-dark">
                                Rp{{ number_format($total) }}
                            </div>
                        </div>

                        <div class="alert alert-warning d-flex align-items-center">
                            <i class="bi bi-clock me-2"></i>
                            <div>
                                Please transfer within <strong><span id="vaTime">03:00</span></strong>
                            </div>
                        </div>

                        <button class="btn btn-pay w-100" onclick="finish()">I’ve Transferred</button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-bottom-sheet" id="modalWallet" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

                <div class="modal-body">
                    <div id="wallet-info" class="fade-step">
                        <div class="mb-4 d-flex align-items-center">
                            <div class="bg-success bg-opacity-75 text-white rounded-circle d-flex justify-content-center align-items-center me-3"
                                style="width: 48px; height: 48px;">
                                <i class="bi bi-wallet2 fs-4"></i>
                            </div>
                            <div>
                                <h5 class="mb-0 fw-semibold text-wallet-label">Wallet</h5>
                                <small class="text-muted">My App Wallet</small>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-wallet-label">Balance</label>
                            <div class="form-control fw-bold bg-wallet-box border-0 text-wallet-value" readonly>
                                Rp{{ number_format($walletBalance) }}
                            </div>
                        </div>

                        <button class="btn btn-pay w-100 fw-semibold py-2" onclick="startWalletPay()">Proceed to Pay
                            Rp{{ number_format($total) }}</button>
                    </div>


                    <div id="pin-form" class="fade-step">
                        <button class="btn-back mb-3" onclick="step('wallet','wallet-info')">
                            <i class="bi bi-arrow-left"></i>
                        </button>

                        <h5 class="mb-3 text-wallet-label">Enter PIN</h5>

                        <input type="password" maxlength="6"
                            class="form-control text-center fw-bold fs-4 py-2 bg-wallet-box border-0 text-wallet-value mb-3"
                            placeholder="••••••">

                        <div class="alert alert-warning d-flex align-items-center mb-3">
                            <i class="bi bi-clock me-2"></i>
                            <div class="text-dark dark-text-warning">
                                Complete within <strong><span id="walletTime">02:00</span></strong>
                            </div>
                        </div>

                        <button class="btn btn-pay w-100 fw-semibold py-2" onclick="finish()">Pay Now</button>

                        <div class="mt-3 small text-muted dark-text-instruction">
                            <i class="bi bi-lightbulb-fill text-warning me-1"></i>
                            Make sure your wallet balance is sufficient. Payment will be auto-confirmed after PIN is
                            submitted.
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-bottom-sheet" id="modalQr" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1">
        <div class="modal-dialog ">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

                <div class="modal-body">
                    <div class="text-center mb-4">
                        <div class="bg-primary bg-opacity-75 text-white rounded-circle d-inline-flex justify-content-center align-items-center mb-3"
                            style="width: 56px; height: 56px;">
                            <i class="bi bi-qr-code-scan fs-3"></i>
                        </div>
                        <h5 class="fw-semibold text-dynamic">Scan to Pay</h5>
                        <small class="text-muted">Open your mobile banking or e-wallet app</small>
                    </div>

                    <div class="d-flex justify-content-center mb-4">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=ORDER123" alt="QR Code"
                            class="img-fluid border rounded p-1 shadow-sm bg-white">
                    </div>

                    <div class="mb-3 text-center">
                        <div class="fw-semibold text-muted mb-1">Amount</div>
                        <div class="h5 fw-bold text-dynamic">Rp{{ number_format($total) }}</div>
                    </div>

                    <div class="alert alert-warning d-flex align-items-center justify-content-center mb-3">
                        <i class="bi bi-clock me-2"></i>
                        <div class="text-dynamic">Expires in <strong><span id="qrTime">02:00</span></strong></div>
                    </div>

                    <div class="mb-3 small text-muted dark-text-instruction">
                        <i class="bi bi-info-circle-fill me-1 text-info"></i>
                        Make sure to complete the payment before the timer ends. Use any QRIS-compatible app to scan the
                        code above.
                    </div>

                    <button class="btn btn-pay w-100 fw-semibold py-2" onclick="finish()">I’ve Paid</button>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="paymentModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center p-4">
                <h5 class="mb-3">Konfirmasi Pesanan</h5>
                <p>Yakin ingin melanjutkan pembayaran?</p>
                <button class="btn btn-primary w-100" onclick="finish()">Ya, Lanjutkan</button>
            </div>
        </div>
    </div>

    <script>
        let timer = null,
            remain = 0;

        function pay() {
            const method = document.querySelector('input[name=pay]:checked')?.value;

            if (!method) {
                return Swal.fire('Pilih metode pembayaran dulu!', '', 'warning');
            }

            window.selectedMethod = method;

            const modal = new bootstrap.Modal(document.getElementById('paymentModal'));
            modal.show();
        }

        function updateCartBadge(totalQty) {
            const badge = document.getElementById('badge-cart');
            if (!badge) return;

            badge.textContent = totalQty;
            badge.classList.add('btn-shake');

            setTimeout(() => {
                badge.classList.remove('btn-shake');
            }, 300);
        }

        function finish() {
            resetTimers();

            const paymentModal = bootstrap.Modal.getInstance(document.getElementById('paymentModal'));
            if (paymentModal) paymentModal.hide();

            const payMethod = window.selectedMethod;
            const note = document.querySelector('textarea')?.value ?? '';

            if (!payMethod) {
                return Swal.fire('Pilih metode pembayaran dulu!', '', 'warning');
            }

            fetch("{{ route('checkout.store') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({
                        payment_method: payMethod,
                        note: note,
                    })
                })
                .then(async res => {
                    const data = await res.json();

                    if (!res.ok) {
                        const errorMsg = data.message || Object.values(data.errors || {})[0] ||
                            'Gagal melakukan checkout.';
                        throw new Error(errorMsg);
                    }

                    window.orderFinalized = true;

                    fetch("{{ route('cart.meta.clear') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });

                    Swal.fire('Order Berhasil!', '', 'success').then(() => location.href =
                        "{{ route('myorders.index') }}");
                })
                .catch(err => {
                    Swal.fire('Gagal', err.message, 'error');
                });
        }


        function openPay(method) {
            resetTimers();
            const modalId = 'modal' + cap(method);
            const modalElement = document.getElementById(modalId);

            const modal = new bootstrap.Modal(modalElement);
            modal.show();

            const first = modalElement.querySelector('.fade-step') || modalElement.querySelector('.modal-body');
            modalElement.querySelectorAll('.fade-step').forEach(e => e.style.display = 'none');
            if (first) first.style.display = 'block';

            if (method === 'qr') countdown('qrTime', 120);
        }


        function step(scope, id) {
            document.querySelectorAll('#modal' + cap(scope) + ' .fade-step').forEach(e => e.style.display = 'none');
            document.getElementById(id).style.display = 'block';
        }

        function countdown(elID, sec) {
            remain = sec;
            const el = document.getElementById(elID);
            timer = setInterval(() => {
                remain--;
                el.textContent = format(remain);
                if (remain <= 0) {
                    resetTimers();
                    Swal.fire('Time limit expired', '', 'error');
                    document.querySelectorAll('.modal.show').forEach(m => bootstrap.Modal.getInstance(m).hide());
                }
            }, 1000);
        }

        function resetTimers() {
            clearInterval(timer);
        }

        function cap(s) {
            return s.charAt(0).toUpperCase() + s.slice(1);
        }

        function format(s) {
            return ('0' + Math.floor(s / 60)).slice(-2) + ':' + ('0' + s % 60).slice(-2);
        }

        function setBank(name, number) {
            document.getElementById('bankTitle').innerText = 'Bank : ' + name;
            document.getElementById('vaNumber').innerText = number;
            step('card', 'va-form');
            resetTimers();
            countdown('vaTime', 180);
        }

        function copyVA() {
            const va = document.getElementById("vaNumber");
            navigator.clipboard.writeText(va.value).then(() => {
                Swal.fire('Copied!', 'VA Number has been copied.', 'success');
            });
        }

        function startWalletPay() {
            step('wallet', 'pin-form');
            resetTimers();
            countdown('walletTime', 120);
        }

        const isDark = document.body.classList.contains('dark');

        if (isDark) {
            Swal.mixin({
                background: '#2a2a2a',
                color: '#fff',
                confirmButtonColor: '#6366f1',
                customClass: {
                    popup: 'swal2-dark'
                }
            });
        }

        window.addEventListener('beforeunload', function() {
            if (window.orderFinalized) return;

            navigator.sendBeacon("{{ route('cart.meta.clear') }}", new URLSearchParams({
                _token: '{{ csrf_token() }}'
            }));
        });
    </script>
@endsection
