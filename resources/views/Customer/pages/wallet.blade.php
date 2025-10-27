@extends('Customer.layouts.app')

@section('title', 'Dompet')

@section('content')
    <style>
        .container {
            max-width: 1140px;
        }



        /* wallet seciton ygyg */
        .wallet-hero {
            background: linear-gradient(135deg, #0d6efd, #198754);
            color: white;
            border-radius: 16px;
            padding: 2rem 1.5rem;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
        }

        .wallet-hero h5 {
            opacity: 0.85;
        }

        .wallet-balance-display {
            font-size: 2.5rem;
            font-weight: 700;
            margin-top: 0.5rem;
            margin-bottom: 0.75rem;
        }

        .wallet-buttons {
            display: flex;
            justify-content: center;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .wallet-buttons button {
            min-width: 150px;
            font-weight: 500;
            border-radius: 12px;
            padding: 0.75rem 1.5rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .wallet-card {
            background: linear-gradient(135deg, #4066ff, #6ab8ff);
            border-radius: 20px;
            padding: 1.5rem;
            color: white;
            margin-bottom: 1.5rem;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.5s ease;
        }

        .wallet-card .visa {
            font-size: 1.5rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-align: right;
            opacity: 0.8;
        }

        .wallet-card .card-number {
            font-size: 1.1rem;
            letter-spacing: 2px;
            margin: 1rem 0;
        }

        .wallet-card .card-name {
            font-size: 0.95rem;
            opacity: 0.9;
        }

        .wallet-section-title {
            font-weight: 600;
            font-size: 1.1rem;
            margin-top: 1rem;
            margin-bottom: 0.75rem;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        body.dark .wallet-hero {
            background: linear-gradient(135deg, #157347, #1f1f1f);
            color: #fff;
        }

        body.dark .wallet-card {
            background: linear-gradient(135deg, #2d2d2d, #1a1a1a);
            color: #fff;
        }

        body.dark .wallet-card .visa {
            color: #ccc;
        }

        @media (max-width: 576px) {
            .wallet-balance-display {
                font-size: 2rem;
            }

            .wallet-card {
                padding: 1.25rem;
            }

            .wallet-card .card-number {
                font-size: 1rem;
            }

            .wallet-buttons button {
                width: 100%;
            }
        }


        /* statitisitc */
        .stat-section {
            margin-top: 3rem;
        }

        .stat-box {
            background: var(--bs-light);
            border-radius: 14px;
            padding: 1rem 1.25rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            animation: fadeInUp 0.5s ease;
        }

        .stat-box:hover {
            transform: translateY(-4px);
        }

        .stat-box i {
            font-size: 1.5rem;
            margin-right: 0.5rem;
        }

        .chart-placeholder {
            height: 180px;
            background: linear-gradient(135deg, #e9f3ff, #d2eaff);
            border-radius: 12px;
            margin-top: 1rem;
            position: relative;
        }

        .stat-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .stat-grid .stat-item {
            flex: 1 1 48%;
            padding: 1rem;
            background-color: var(--bs-white);
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .stat-grid .stat-item .label {
            font-size: 0.9rem;
            color: #888;
        }

        .stat-grid .stat-item .amount {
            font-weight: bold;
            font-size: 1.25rem;
            margin-top: 0.25rem;
        }

        .wallet-transactions {
            margin-top: 2rem;
        }

        .wallet-transactions ul {
            padding: 0;
            margin: 0;
            list-style: none;
        }

        .wallet-transactions li {
            display: flex;
            justify-content: space-between;
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #eee;
            align-items: center;
        }

        .wallet-transactions .icon {
            font-size: 1.2rem;
            margin-right: 0.75rem;
            color: var(--bs-primary);
        }

        .wallet-transactions .amount {
            font-weight: bold;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        body.dark .stat-box,
        body.dark .stat-grid .stat-item {
            background-color: #1f1f1f;
            color: #fff;
        }

        body.dark .wallet-transactions li {
            border-color: #333;
        }

        body.dark .chart-placeholder {
            background: linear-gradient(135deg, #2a2a2a, #444);
        }

        .custom-month-select {
            border-radius: 8px;
            background-color: var(--bs-light);
            color: #000;
        }

        body.dark .custom-month-select {
            background-color: #2b2b2b;
            color: #fff;
            border-color: #444;
        }

        .stat-grid .stat-item {
            background-color: var(--bs-light);
        }

        body.dark .stat-item {
            background-color: #1e1e1e;
            box-shadow: 0 4px 16px rgba(255, 255, 255, 0.05);
            border: 1px solid #2a2a2a;
        }

        body.dark .stat-item .label {
            color: #aaa;
        }




        .wallet-list li {
            transition: all 0.2s ease;
        }

        .wallet-list li:hover {
            background-color: #f8f9fa;
        }

        .modal-wallet {
            z-index: 4004;
        }

        .tab-wallet {
            display: flex;
            justify-content: space-between;
            border-bottom: 1px solid #dee2e6;
            margin-bottom: 1rem;
        }

        .tab-wallet button {
            flex: 1;
            border: none;
            background: none;
            padding: 0.75rem;
            font-weight: 500;
            color: inherit;
            border-bottom: 2px solid transparent;
            transition: all 0.2s ease;
        }

        .tab-wallet button.active {
            border-bottom-color: #0d6efd;
            color: #0d6efd;
        }

        .payment-method-box {
            display: none;
            animation: fadeIn 0.3s ease;
        }

        .payment-method-box.active {
            display: block;
        }

        .qr-image {
            max-width: 100%;
            border: 1px dashed #ccc;
            border-radius: 8px;
            padding: 10px;
            background-color: #f8f9fa;
        }

        .payment-instruction {
            font-size: 0.9rem;
            color: #6c757d;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Dark Mode */
        body.dark .wallet-balance {
            background: linear-gradient(135deg, #157347, #198754);
        }

        body.dark .wallet-list li:hover {
            background-color: #2a2a2a;
        }

        body.dark .tab-wallet {
            border-color: #444;
        }

        body.dark .tab-wallet button.active {
            color: #4dabf7;
            border-color: #4dabf7;
        }

        body.dark .text-muted {
            color: #bbb !important;
        }

        body.dark .list-group-item {
            background-color: #1e1e1e;
            color: #fff;
            border-color: #333;
        }

        body.dark .qr-image {
            background-color: #1f1f1f;
            border-color: #444;
        }

        /* Slide Up Modal */
        @media (max-width: 576px) {
            .modal.modal-slide-up .modal-dialog {
                margin: 0;
                height: 100%;
                display: flex;
                align-items: flex-end;
            }

            .modal.modal-slide-up .modal-content {
                width: 100%;
                border-radius: 20px 20px 0 0 !important;
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

        .hover-shadow:hover {
            box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
            transition: 0.3s ease;
        }

        .payment-timer {
            font-size: 0.9rem;
            font-weight: 500;
            color: #dc3545;
            margin-bottom: 0.5rem;
        }

        .payment-step-box {
            animation: fadeIn 0.3s ease;
        }

        body.dark .bg-light {
            background-color: #2a2a2a !important;
            color: #fff;
        }

        body.dark .card {
            background-color: #1e1e1e;
            border-color: #333;
        }

        body.dark .form-control {
            background-color: #1f1f1f;
            color: #fff;
            border-color: #444;
        }

        body.dark .btn-outline-secondary {
            color: #ccc;
            border-color: #666;
        }



        .styled-month-select {
            border-radius: 12px;
            background-color: var(--bs-body-bg);
            color: inherit;
            padding-left: 0.75rem;
            font-weight: 500;
        }

        body.dark .styled-month-select {
            background-color: #2a2a2a;
            color: #fff;
        }


        @media (max-width: 576px) {
            .wallet-transactions {
                padding-bottom: calc(10rem + env(safe-area-inset-bottom));
            }
        }
    </style>

    <div class="container py-4">

        @if (session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const isDark = document.body.classList.contains('dark');
                    Swal.fire({
                        title: 'Berhasil!',
                        html: '{{ session('success') }}',
                        icon: 'success',
                        background: isDark ? '#2a2a2a' : '#fff',
                        color: isDark ? '#fff' : '#000',
                        confirmButtonColor: '#0d6efd',
                        iconColor: '#198754',
                        customClass: {
                            popup: 'rounded-4'
                        }
                    });
                });
            </script>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Gagal!</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
            </div>
        @endif

        {{-- Back Button Mobile --}}
        <a href="{{ route('home.index') }}" class="btn btn-outline-secondary btn-sm d-sm-none mb-3">
            back
        </a>


        {{-- Header Balance --}}
        <div class="wallet-hero">
            <h5>Selamat Datang, <strong>{{ auth()->user()->name ?? 'Pengguna' }}</strong></h5>
            <div class="text-uppercase small mt-2">Saldo Anda</div>
            <div class="wallet-balance-display">Rp{{ number_format($wallet->balance, 2, ',', '.') }}</div>

            <div class="wallet-buttons mt-4">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#topupModal">
                    <i class="bi bi-plus-circle me-1"></i> Isi Saldo
                </button>
                <button class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#historyModal">
                    <i class="bi bi-clock-history me-1"></i> Riwayat
                </button>
            </div>
        </div>

        {{-- Kartu Virtual --}}
        <div class="wallet-section-title">Kartu Virtual Anda</div>
        <div class="wallet-card">
            <div class="visa">VISA</div>
            <div class="card-number">2148 3214 9812 2687</div>
            <div class="card-name">ACCUMALACA AJOJING</div>
        </div>

        {{-- Statistik & Overview --}}
        <div class="stat-section">

            <h6 class="fw-bold mb-3">Statistik Pengeluaran & Pemasukan</h6>

            {{-- Grafik Dummy --}}
            <div class="stat-box">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <i class="bi bi-bar-chart-fill text-primary me-1"></i> Overview Bulanan
                    </div>
                    <div class="form-floating" style="max-width: 140px;">
                        @php
                            $bulanIndo = [
                                '01' => 'Januari',
                                '02' => 'Februari',
                                '03' => 'Maret',
                                '04' => 'April',
                                '05' => 'Mei',
                                '06' => 'Juni',
                                '07' => 'Juli',
                                '08' => 'Agustus',
                                '09' => 'September',
                                '10' => 'Oktober',
                                '11' => 'November',
                                '12' => 'Desember',
                            ];

                            $uniqueMonths = collect($monthlyData)->pluck('month')->unique()->sort()->values()->all();
                        @endphp

                        <select class="form-select styled-month-select" id="monthSelect">
                            <option value="all" selected>All</option>
                            @foreach ($uniqueMonths as $m)
                                <option value="{{ $m }}">{{ $bulanIndo[substr($m, 5, 2)] }}
                                    {{ substr($m, 0, 4) }}</option>
                            @endforeach
                        </select>
                        <label for="monthSelect">Bulan</label>
                    </div>
                </div>
                <div class="chart-container">
                    <canvas id="walletChart"></canvas>
                </div>
            </div>

            {{-- Income / Outcome --}}
            <div class="stat-grid mt-4">
                <div class="stat-item text-success">
                    <div class="label">Pemasukan</div>
                    <div class="amount">+Rp{{ number_format($incomeTotal, 0, ',', '.') }}</div>
                </div>
                <div class="stat-item text-danger">
                    <div class="label">Pengeluaran</div>
                    <div class="amount">-Rp{{ number_format($expenseTotal, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>

        {{-- Transaksi Terakhir --}}
        <div class="wallet-transactions mt-5">
            <h6 class="fw-bold mb-3">Transaksi Terakhir</h6>
            <ul>
                @foreach ($transactions as $item)
                    <li class="list-group-item d-flex justify-content-between align-items-center"
                        data-date="{{ $item->date }}">
                        <div>
                            <div class="fw-semibold">{{ $item->label }}</div>
                            <small class="text-muted">{{ $item->date }}</small>
                        </div>
                        <div class="fw-bold {{ $item->type === 'in' ? 'text-success' : 'text-danger' }}">
                            {{ $item->type === 'in' ? '+' : '-' }}Rp{{ number_format($item->amount, 2, ',', '.') }}
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

    </div>


    {{-- Modal: Riwayat --}}
    <div class="modal fade modal-wallet" id="historyModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-slide-up">
            <div class="modal-content p-3 rounded-4">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold">
                        <i class="bi bi-clock-history me-2"></i> Riwayat Transaksi
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="tab-wallet mb-3">
                        <button class="active" onclick="showTab('all')">Semua</button>
                        <button onclick="showTab('latest')">Terbaru</button>
                        <button onclick="showTab('oldest')">Terlama</button>
                    </div>
                    <ul class="list-group wallet-list" id="walletHistoryList">
                        @foreach ($history as $item)
                            <li class="list-group-item d-flex justify-content-between align-items-center"
                                data-date="{{ $item->date }}">
                                <div>
                                    <div class="fw-semibold">{{ $item->label }}</div>
                                    <small class="text-muted">{{ $item->date }}</small>
                                </div>
                                <div class="fw-bold {{ $item->type === 'in' ? 'text-success' : 'text-danger' }}">
                                    {{ $item->type === 'in' ? '+' : '-' }}Rp{{ number_format($item->amount, 0, ',', '.') }}
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal: Isi Saldo --}}
    <div class="modal fade modal-wallet" id="topupModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-slide-up">
            <div class="modal-content p-4 rounded-4">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold">
                        <i class="bi bi-plus-circle me-2"></i> Isi Saldo
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    {{-- STEP 1: PILIH METODE --}}
                    <div id="step1" class="step">
                        <p class="fw-bold mb-3">Pilih Metode Pembayaran</p>
                        <div class="row g-3">
                            @foreach ($payments as $payment)
                                <div class="col-6" style="cursor: pointer;"
                                    onclick="goToTopupForm({{ $payment->id }}, '{{ $payment->name }}')">
                                    <div class="card shadow-sm text-center py-3 hover-shadow">
                                        <i class="bi {{ $payment->icon }} fs-2 text-primary"></i>
                                        <div class="mt-2 fw-semibold">{{ $payment->name }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- STEP 2: FORM --}}
                    <div id="step2" class="step d-none">
                        <button class="btn btn-outline-secondary btn-sm mb-3" onclick="backToStep1()">
                            <i class="bi bi-arrow-left me-1"></i>
                        </button>
                        <div id="dynamicForm"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        @if (session('success') || session('error'))
            document.addEventListener('DOMContentLoaded', () => {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });

                setTimeout(() => {
                    document.querySelector('.alert')?.classList.remove('show');
                }, 3000);
            });
        @endif

        function showTab(tab) {
            const items = [...document.querySelectorAll('#walletHistoryList li')];
            items.forEach(el => el.style.display = 'block');

            if (tab === 'latest') {
                items.sort((a, b) => new Date(b.dataset.date) - new Date(a.dataset.date));
            } else if (tab === 'oldest') {
                items.sort((a, b) => new Date(a.dataset.date) - new Date(b.dataset.date));
            }

            const list = document.getElementById('walletHistoryList');
            list.innerHTML = '';
            items.forEach(el => list.appendChild(el));

            document.querySelectorAll('.tab-wallet button').forEach(btn => btn.classList.remove('active'));
            document.querySelector(`.tab-wallet button[onclick="showTab('${tab}')"]`).classList.add('active');
        }

        function topupSuccess() {
            const isDark = document.body.classList.contains('dark');
            Swal.fire({
                title: 'Top Up Diproses!',
                html: 'Saldo akan segera masuk dalam 1-3 menit.<br><small>Pastikan sudah melakukan pembayaran.</small>',
                icon: 'success',
                background: isDark ? '#2a2a2a' : '#fff',
                color: isDark ? '#fff' : '#000',
                confirmButtonText: 'Oke',
                iconColor: '#198754',
                confirmButtonColor: '#0d6efd',
                customClass: {
                    popup: 'rounded-4'
                }
            });

            bootstrap.Modal.getInstance(document.getElementById('topupModal')).hide();
        }

        function changePaymentMethod() {
            document.querySelectorAll('.payment-method-box').forEach(el => el.classList.remove('active'));
            const method = document.getElementById('paymentMethod').value;
            if (method) {
                document.getElementById(method + 'Box').classList.add('active');
            }
        }

        document.querySelectorAll('.modal-wallet').forEach(modal => {
            modal.addEventListener('show.bs.modal', function() {
                modal.classList.toggle('modal-slide-up', window.innerWidth <= 576);
            });
        });

        let selectedMethod = '';
        let selectedBank = '';

        function goToTopupForm(paymentId, paymentName) {
            document.getElementById('step1').classList.add('d-none');
            document.getElementById('step2').classList.remove('d-none');

            const html = `
        <form method="POST" action="{{ route('wallet.topup') }}">
            @csrf
            <input type="hidden" name="payment_method" value="${paymentId}">
            <p class="mb-2">Metode: <strong>${paymentName}</strong></p>

            <div class="mb-3">
                <label for="amount" class="form-label">Masukkan Nominal</label>
                <input type="number" name="amount" class="form-control" placeholder="Contoh: 50000" required min="1000">
            </div>

            <button type="submit" class="btn btn-success w-100">Top Up Sekarang</button>
        </form>
    `;

            document.getElementById('dynamicForm').innerHTML = html;
        }

        function enterAmount(method, bank) {
            selectedMethod = method;
            selectedBank = bank;

            document.getElementById('dynamicForm').innerHTML = `
        <h6 class="fw-bold mb-3">Masukkan Nominal</h6>
        <p class="text-muted mb-2">Bank yang dipilih: <strong>${bank}</strong></p>
        <input type="number" id="amountInput" class="form-control mb-3" placeholder="Contoh: 50000">
        <button class="btn btn-primary w-100" onclick="showPaymentForm('${method}', '${bank}')">Lanjutkan</button>
    `;
        }

        function showPaymentForm(method, bank = '') {
            const amount = document.getElementById('amountInput')?.value || '0';
            const deadline = new Date(Date.now() + 10 * 60 * 1000); // 10 menit

            let html = `
        <div class="payment-timer mb-2" id="topup-timer">Sisa waktu pembayaran: <span>10:00</span></div>
    `;

            if (method === 'transfer') {
                html += `
            <h6 class="fw-bold mb-2">Transfer Bank - ${bank}</h6>
            <div class="bg-light p-3 rounded mb-3">
                Nominal: <strong>Rp${parseInt(amount).toLocaleString()}</strong><br>
                No Rekening: <strong>123-456-789</strong><br>
                Atas Nama: <strong>PT DompetMakan</strong>
            </div>
            <p class="text-muted small">Transfer sesuai nominal ke rekening di atas sebelum waktu habis.</p>
        `;
            }

            if (method === 'va') {
                html += `
            <h6 class="fw-bold mb-2">Virtual Account - ${bank}</h6>
            <div class="bg-light p-3 rounded mb-3">
                Nominal: <strong>Rp${parseInt(amount).toLocaleString()}</strong><br>
                VA Number: <strong>8998 1234 5678 90</strong>
            </div>
            <p class="text-muted small">Gunakan aplikasi perbankan untuk membayar via VA ini.</p>
        `;
            }

            if (method === 'qr') {
                html += `
            <h6 class="fw-bold mb-2">Pembayaran QRIS</h6>
            <div class="text-center mb-2">
                <img src="https://api.qrserver.com/v1/create-qr-code/?data=DompetMakan&size=160x160" alt="QR" class="qr-image mb-2">
                <div>Nominal: <strong>Rp${parseInt(amount).toLocaleString()}</strong></div>
            </div>
            <p class="text-muted small">Scan QR dengan aplikasi e-wallet kamu seperti GoPay, OVO, DANA.</p>
        `;
            }

            html += `
        <button class="btn btn-success w-100 mt-3" onclick="topupSuccess()">Saya Sudah Bayar</button>
        <small class="text-muted d-block mt-2">🔒 Pembayaran aman & otomatis. Saldo akan masuk dalam 1–3 menit.</small>
    `;

            document.getElementById('dynamicForm').innerHTML = html;
            startCountdown(deadline, 'topup-timer');
        }

        function startCountdown(endTime, elId) {
            const el = document.getElementById(elId).querySelector('span');

            function tick() {
                const now = new Date();
                const left = Math.max(0, endTime - now);
                const min = String(Math.floor(left / 60000)).padStart(2, '0');
                const sec = String(Math.floor((left % 60000) / 1000)).padStart(2, '0');
                el.textContent = `${min}:${sec}`;
                if (left <= 0) clearInterval(interval);
            }

            tick();
            const interval = setInterval(tick, 1000);
        }

        function backToStep1() {
            document.getElementById('step2').classList.add('d-none');
            document.getElementById('step1').classList.remove('d-none');
        }


        // wallet chart dummy

        const monthlyData = @json($monthlyData);

        function formatCurrency(value) {
            return 'Rp' + parseInt(value).toLocaleString('id-ID');
        }

        const groupedData = {};
        monthlyData.forEach(item => {
            const m = item.month;
            const t = item.type;
            const v = parseFloat(item.total);

            if (!groupedData[m]) groupedData[m] = {
                in: 0,
                out: 0
            };
            groupedData[m][t] = v;
        });

        const labels = Object.keys(groupedData);
        const incomeData = labels.map(m => groupedData[m].in || 0);
        const expenseData = labels.map(m => groupedData[m].out || 0);

        const ctx = document.getElementById('walletChart').getContext('2d');
        const walletChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                        label: 'Pemasukan',
                        data: incomeData,
                        borderColor: '#198754',
                        backgroundColor: 'rgba(25, 135, 84, 0.1)',
                        tension: 0.4,
                        fill: true,
                        pointRadius: 5,
                        pointHoverRadius: 7,
                    },
                    {
                        label: 'Pengeluaran',
                        data: expenseData,
                        borderColor: '#dc3545',
                        backgroundColor: 'rgba(220, 53, 69, 0.1)',
                        tension: 0.4,
                        fill: true,
                        pointRadius: 5,
                        pointHoverRadius: 7,
                    },
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false
                },
                plugins: {
                    legend: {
                        labels: {
                            color: '#333',
                            font: {
                                weight: 'bold'
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: ctx => `${ctx.dataset.label}: ${formatCurrency(ctx.raw)}`
                        }
                    }
                },
                scales: {
                    y: {
                        ticks: {
                            callback: value => formatCurrency(value)
                        }
                    }
                }
            }
        });

        function isDarkMode() {
            return document.body.classList.contains('dark');
        }



        const chartData = {
            all: {
                labels,
                income: incomeData,
                expense: expenseData
            }
        };

        // Buat per bulan
        labels.forEach((label, i) => {
            chartData[label] = {
                labels: [label],
                income: [incomeData[i]],
                expense: [expenseData[i]]
            };
        });




        // Update chart when month changes
        document.getElementById('monthSelect').addEventListener('change', function() {
            const selected = this.value;
            const data = chartData[selected];

            walletChart.data.labels = data.labels;
            walletChart.data.datasets[0].data = data.income;
            walletChart.data.datasets[1].data = data.expense;
            walletChart.update();
        });

        // Dark mode observer
        document.addEventListener('DOMContentLoaded', () => {
            const observer = new MutationObserver(() => {
                walletChart.options.plugins.legend.labels.color = isDarkMode() ? '#ccc' : '#333';
                walletChart.options.plugins.tooltip.backgroundColor = isDarkMode() ? '#2a2a2a' : '#fff';
                walletChart.options.plugins.tooltip.titleColor = isDarkMode() ? '#fff' : '#000';
                walletChart.options.plugins.tooltip.bodyColor = isDarkMode() ? '#ddd' : '#333';
                walletChart.options.scales.x.ticks.color = isDarkMode() ? '#aaa' : '#333';
                walletChart.options.scales.y.ticks.color = isDarkMode() ? '#aaa' : '#333';
                walletChart.options.scales.x.grid.color = isDarkMode() ? '#333' : '#eee';
                walletChart.options.scales.y.grid.color = isDarkMode() ? '#333' : '#eee';
                walletChart.update();
            });

            observer.observe(document.body, {
                attributes: true,
                attributeFilter: ['class']
            });
        });
    </script>
@endsection
