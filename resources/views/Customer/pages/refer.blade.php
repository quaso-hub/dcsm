@extends('Customer.layouts.app')

@section('title', 'Referensi & Hadiah')

@section('content')
    <style>
        .container {
            max-width: 1140px;
        }

        .ref-box {
            background-color: #f8f9fa;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
        }

        .ref-code {
            font-size: 1.25rem;
            font-weight: 600;
            color: #0d6efd;
            letter-spacing: 1px;
        }

        .btn-share {
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .btn-share:hover {
            transform: scale(1.02);
        }

        .ref-howto li {
            padding-left: 0;
            padding-right: 0;
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

        /* Dark Mode */
        body.dark .ref-box {
            background-color: #2a2a2a;
            color: #fff;
        }

        body.dark .ref-howto .list-group-item {
            background-color: transparent;
            color: #ddd;
            border-color: #444;
        }

        body.dark .ref-code {
            color: #4dabf7;
        }

        body.dark .btn-outline-primary {
            color: #4dabf7;
            border-color: #4dabf7;
        }

        body.dark .btn-outline-primary:hover {
            background-color: #4dabf7;
            color: #000;
        }

        body.dark .btn-success {
            background-color: #198754;
        }

        /* Share Modal */
        .share-modal {
            z-index: 4001;
        }

        .share-modal-content {
            border-radius: 20px;
            background-color: #fff;
            animation: fadeInScale 0.4s ease;
        }

        body.dark .share-modal-content {
            background-color: #1e1e1e;
            color: #fff;
        }

        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: scale(0.96);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .share-options {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            margin-top: 1rem;
        }

        .share-option {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            border-radius: 10px;
            background-color: #f8f9fa;
            transition: all 0.25s ease;
            cursor: pointer;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05);
            animation: fadeUp 0.3s ease;
        }

        .share-option:hover {
            background-color: #e9ecef;
        }

        .share-option i {
            min-width: 24px;
        }

        body.dark .share-option {
            background-color: #2a2a2a;
            color: #fff;
            box-shadow: none;
        }

        body.dark .share-option:hover {
            background-color: #333;
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


        body.dark .text-muted {
            color: #bbb !important;
        }

        .ref-bg {
            background-color: #f8f9fa;
        }

        body.dark .ref-bg {
            background-color: #2a2a2a;
        }

        body.dark .border {
            border-color: #444 !important;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="container py-4">

        {{-- Mobile Back Button --}}
        <a href="{{ route('home.index') }}" class="btn btn-outline-secondary btn-sm mobile-back">
            Back
        </a>

        {{-- Judul --}}
        <h4 class="fw-bold mb-3">
            <i class="bi bi-gift-fill text-danger me-2"></i>
            Ajak Teman & Dapatkan Hadiah!
        </h4>
        <p class="text-muted mb-4">
            Bagikan kode referral kamu ke teman dan dapatkan saldo hingga <strong>Rp10.000</strong> untuk setiap pengguna
            baru yang mendaftar dan melakukan pesanan.
        </p>

        {{-- Kode Referral --}}
        <div class="text-center mb-4">
            <div class="d-inline-flex align-items-center border rounded-pill px-4 py-2 ref-bg ref-box shadow-sm">
                <span class="ref-code me-3">REF12345</span>
                <button class="btn btn-sm btn-outline-primary" onclick="copyReferral('REF12345')">
                    <i class="bi bi-clipboard"></i> Salin
                </button>
            </div>
        </div>

        {{-- Tombol Share --}}
        <div class="text-center mb-5">
            <button class="btn btn-success btn-lg rounded-pill px-5 btn-share" data-bs-toggle="modal"
                data-bs-target="#shareModal">
                <i class="bi bi-share me-1"></i> Bagikan Sekarang
            </button>
        </div>

        {{-- Penjelasan Program --}}
        <div class="ref-box ref-howto shadow-sm">
            <h6 class="fw-bold mb-3">Cara Kerja Program</h6>
            <ul class="list-group list-group-flush small">
                <li class="list-group-item">✅ Bagikan kode referral kamu ke teman-teman melalui sosial media atau aplikasi.
                </li>
                <li class="list-group-item">🧑‍🤝‍🧑 Temanmu harus mendaftar dan melakukan pesanan pertama.</li>
                <li class="list-group-item">🎁 Kamu akan menerima saldo hadiah otomatis setelah pesanan berhasil.</li>
            </ul>
        </div>
    </div>

    {{-- Share Modal --}}
    <div class="modal fade share-modal" id="shareModal" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-slide-up">
            <div class="modal-content share-modal-content p-4">
                <div class="modal-header border-0 pb-2">
                    <h5 class="modal-title fw-bold fs-5" id="shareModalLabel">
                        <i class="bi bi-send-check me-2 text-primary"></i>
                        Bagikan Kode Referral
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body pt-0">
                    <p class="text-muted small mb-3">
                        Pilih platform untuk membagikan link referral kamu ke teman, atau salin link secara manual.
                    </p>

                    <div class="share-options">
                        <div class="share-option"
                            onclick="shareLink('https://facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}')">
                            <i class="bi bi-facebook fs-4 text-primary"></i>
                            <span>Bagikan ke Facebook</span>
                        </div>
                        <div class="share-option"
                            onclick="shareLink('https://api.whatsapp.com/send?text={{ urlencode(request()->fullUrl()) }}')">
                            <i class="bi bi-whatsapp fs-4 text-success"></i>
                            <span>Kirim lewat WhatsApp</span>
                        </div>
                        <div class="share-option"
                            onclick="shareLink('https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}')">
                            <i class="bi bi-twitter fs-4 text-info"></i>
                            <span>Tweet di Twitter</span>
                        </div>
                        <div class="share-option" onclick="copyReferralLink('{{ request()->fullUrl() }}')">
                            <i class="bi bi-link-45deg fs-4"></i>
                            <span>Salin Link Referral</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function copyReferral(code) {
            navigator.clipboard.writeText(code).then(() => {
                const isDark = document.body.classList.contains('dark');
                Swal.fire({
                    title: 'Kode Disalin!',
                    text: `Kode "${code}" berhasil disalin ke clipboard.`,
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

        function copyReferralLink(link) {
            navigator.clipboard.writeText(link).then(() => {
                const isDark = document.body.classList.contains('dark');
                Swal.fire({
                    title: 'Link Disalin!',
                    text: 'Link referral siap untuk dibagikan.',
                    icon: 'success',
                    confirmButtonText: 'OK',
                    background: isDark ? '#2a2a2a' : '#fff',
                    color: isDark ? '#fff' : '#000',
                    iconColor: '#0d6efd',
                    confirmButtonColor: '#0d6efd',
                    customClass: {
                        popup: 'rounded-4'
                    }
                });
            });
        }

        function shareLink(url) {
            window.open(url, '_blank');
        }

        const shareModal = document.getElementById('shareModal');
        shareModal.addEventListener('show.bs.modal', function() {
            if (window.innerWidth <= 576) {
                shareModal.classList.add('modal-slide-up');
            } else {
                shareModal.classList.remove('modal-slide-up');
            }
        });
    </script>
@endsection
