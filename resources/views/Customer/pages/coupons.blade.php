@extends('Customer.layouts.app')

@section('title', 'Kupon Saya')

@section('content')
<style>
    .container {
        max-width: 1140px;
    }

    .mobile-back {
        display: none;
    }

    @media (max-width: 576px) {
        .mobile-back {
            display: inline-block;
            margin-bottom: 1.25rem;
        }
    }

    .coupon-card {
        position: relative;
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.05);
        overflow: hidden;
        display: flex;
        align-items: center;
        padding: 1.25rem;
        margin-bottom: 1.5rem;
        animation: fadeSlideIn 0.4s ease forwards;
        opacity: 0;
    }

    .coupon-card::before, .coupon-card::after {
        content: '';
        position: absolute;
        width: 20px;
        height: 40px;
        background: #f8f9fa;
        top: 50%;
        transform: translateY(-50%);
        z-index: 1;
    }

    .coupon-card::before {
        left: -10px;
        border-radius: 0 999px 999px 0;
    }

    .coupon-card::after {
        right: -10px;
        border-radius: 999px 0 0 999px;
    }

    .coupon-content {
        flex-grow: 1;
    }

    .coupon-code {
        font-size: 1.25rem;
        font-weight: 600;
        color: #0d6efd;
    }

    .coupon-desc {
        color: #6c757d;
        font-size: 0.95rem;
        margin-bottom: 0.5rem;
    }

    .coupon-expire {
        font-size: 0.85rem;
        color: #999;
    }

    .coupon-btn {
        white-space: nowrap;
        transition: all 0.3s ease;
    }

    .coupon-btn:hover {
        transform: scale(1.05);
    }

    @keyframes fadeSlideIn {
        from {
            opacity: 0;
            transform: translateY(15px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    body.dark .coupon-card {
        background-color: #2a2a2a;
        color: #fff;
    }

    body.dark .coupon-card::before,
    body.dark .coupon-card::after {
        background-color: #1e1e1e;
    }

    body.dark .coupon-desc {
        color: #bbb;
    }

    body.dark .coupon-expire {
        color: #888;
    }

    body.dark .coupon-code {
        color: #4dabf7;
    }

    @media (max-width: 576px) {
        .coupon-card {
            flex-direction: column;
            align-items: flex-start;
            padding: 1rem;
        }

        .coupon-btn {
            width: 100%;
            margin-top: 1rem;
        }
    }
</style>

<div class="container py-4">

    <a href="{{ route('home.index') }}" class="btn btn-outline-secondary btn-sm mobile-back">
         Back
    </a>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">
            <i class="bi bi-ticket-perforated text-danger me-2"></i>
            Kupon Saya
        </h4>
    </div>

    @php
        $coupons = [
            [
                'code' => 'MAKANHEMAT30',
                'desc' => 'Diskon 30% untuk semua makanan di atas Rp50.000',
                'expire' => 'Berlaku hingga 30 Juli 2025',
            ],
            [
                'code' => 'PIZZAFEST',
                'desc' => 'Diskon 40% khusus menu Pizza setiap Jumat',
                'expire' => 'Berlaku hingga 15 Agustus 2025',
            ],
            [
                'code' => 'ONGKIRGRATIS',
                'desc' => 'Gratis ongkir hingga Rp10.000',
                'expire' => 'Berlaku hingga 10 Juli 2025',
            ],
        ];
    @endphp

    @foreach($coupons as $coupon)
        <div class="coupon-card">
            <div class="coupon-content">
                <div class="coupon-code">{{ $coupon['code'] }}</div>
                <div class="coupon-desc">{{ $coupon['desc'] }}</div>
                <div class="coupon-expire">{{ $coupon['expire'] }}</div>
            </div>
            <div class="ms-auto">
                <button class="btn btn-outline-primary coupon-btn" onclick="copyToClipboard('{{ $coupon['code'] }}')">
                    Salin Kode
                </button>
            </div>
        </div>
    @endforeach

</div>

<script>
    function copyToClipboard(code) {
        navigator.clipboard.writeText(code).then(() => {
            const isDark = document.body.classList.contains('dark');

            Swal.fire({
                title: 'Kode Disalin!',
                text: `Kode "${code}" siap digunakan`,
                icon: 'success',
                confirmButtonText: 'OK',
                background: isDark ? '#2a2a2a' : '#fff',
                color: isDark ? '#fff' : '#000',
                iconColor: '#198754',
                confirmButtonColor: '#0d6efd',
                customClass: {
                    popup: 'rounded-4'
                }
            });
        });
    }
</script>
@endsection
