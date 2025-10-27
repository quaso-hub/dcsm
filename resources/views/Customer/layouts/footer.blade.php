<footer class="footer mt-auto pt-5 position-relative text-dark-subtle">
    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        main.container-fluid {
            flex: 1 0 auto;
        }

        footer.footer {
            flex-shrink: 0;
            background-color: #f8f9fa;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .dark footer.footer {
            background-color: #262626;
            color: #f1f1f1;
        }

        .footer .container {
            max-width: 1140px;
            margin-left: auto;
            margin-right: auto;
        }

        .footer a {
            transition: color 0.2s ease-in-out;
        }

        .footer a:hover {
            color: #dc3545 !important;
        }

        .dark .footer a {
            color: #e0e0e0 !important;
        }

        .dark .footer a:hover {
            color: #f87171 !important;
        }


        /* fab */

        .fab {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #25D366;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            z-index: 9999;
            transition: transform 0.3s;
        }

        .fab:hover {
            transform: scale(1.1);
        }

        .chat-popup {
            position: fixed;
            bottom: 90px;
            right: 20px;
            width: 300px;
            border-radius: 10px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
            z-index: 9999;
            animation: fadeIn 0.3s ease;
            display: none;
        }

        .chat-header {
            font-weight: bold;
            font-size: 16px;
        }

        textarea {
            resize: none;
            padding: 8px;
            font-size: 14px;
            border-radius: 6px;
            margin-bottom: 10px;
        }

        button#sendToWhatsApp {
            background-color: #25D366;
            border: none;
            color: white;
            font-weight: bold;
            border-radius: 6px;
            cursor: pointer;
        }

        button#sendToWhatsApp:hover {
            background-color: #1ebe5b;
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

        /* Light / dark mode support */
        body.bg-dark .chat-popup {
            background-color: #1e1e1e;
            color: #fff;
            border: 1px solid #444;
        }

        body.bg-dark .chat-popup textarea {
            background-color: #2b2b2b;
            color: #fff;
            border: 1px solid #444;
        }

        body.bg-dark .btn-close {
            filter: invert(1);
        }

        body.bg-light .chat-popup {
            background-color: #fff;
            color: #000;
            border: 1px solid #ddd;
        }

        body.bg-light .chat-popup textarea {
            background-color: #fff;
            color: #000;
            border: 1px solid #ccc;
        }



        /* Newsletter */
        .footer .newsletter-wrapper {
            position: absolute;
            top: -48px;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            max-width: 1140px;
            z-index: 10;
        }

        .footer .newsletter-bg {
            background-color: #dc3545;
            color: white;
            border-radius: 1rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            padding: 1rem 1.5rem;
        }

        .dark .footer .newsletter-bg {
            background-color: #e63946;
            color: #fff;
        }

        .footer .btn-light {
            color: #000;
        }

        .dark .footer .btn-light {
            background-color: #f1f1f1;
            color: #000;
        }

        @media (min-width: 992px) {
            .footer::before {
                content: '';
                display: block;
                height: 5rem;
            }
        }
    </style>

    {{-- Floating Newsletter (outside container) --}}
    <div class="newsletter-wrapper d-none d-lg-block">
        <div
            class="newsletter-bg d-flex flex-column flex-md-row align-items-center justify-content-between position-relative overflow-hidden">
            <div class="position-absolute top-50 start-50 translate-middle opacity-10" style="z-index:0;">
                <img src="https://picsum.photos/seed/burger/100/100" alt="bg" class="img-fluid">
            </div>
            <div class="position-relative z-1 mb-2 mb-md-0">
                <strong class="fs-5">Newsletter</strong><br>
                <small>Subscribe to our newsletter and unlock a world of exclusive</small>
            </div>
            <form class="d-flex position-relative z-1 mt-2 mt-md-0" style="max-width: 320px;">
                <input type="email" class="form-control me-2" placeholder="Your Email Address">
                <button class="btn btn-light">Subscribe</button>
            </form>
        </div>
    </div>

    <div class="container pt-5">
        {{-- Footer Content --}}
        <div class="row gy-4 text-center text-md-start">
            <div class="col-12 col-md-3">
                <div class="d-flex align-items-center gap-2 mb-2 justify-content-center justify-content-md-start">
                    <img src="https://picsum.photos/seed/logo/32/32" alt="logo" class="rounded-circle">
                    <h5 class="mb-0 text-danger">eFood</h5>
                </div>
                <p class="small">Best Delivery Service Near You. Enjoy the best food around at your home</p>
                <div class="d-flex justify-content-center justify-content-md-start gap-3 fs-4">
                    <i class="bi bi-pinterest"></i>
                    <i class="bi bi-linkedin"></i>
                    <i class="bi bi-facebook"></i>
                </div>
            </div>
            <div class="col-6 col-md-2">
                <h6 class="fw-semibold">My Account</h6>
                <ul class="list-unstyled small">
                    <li><a href="#">Profile</a></li>
                    <li><a href="#">Address</a></li>
                    <li><a href="#">Live Chat</a></li>
                    <li><a href="#">My Order</a></li>
                </ul>
            </div>
            <div class="col-6 col-md-2">
                <h6 class="fw-semibold">Quick Links</h6>
                <ul class="list-unstyled small">
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms & Conditions</a></li>
                    <li><a href="#">About Us</a></li>
                </ul>
            </div>
            <div class="col-12 col-md-5">
                <h6 class="fw-semibold">Download Our Apps</h6>
                <div class="d-flex gap-3 justify-content-center justify-content-md-start">
                    <img src="https://picsum.photos/seed/google/140/48" alt="Google Play" class="img-fluid">
                    <img src="https://picsum.photos/seed/apple/140/48" alt="App Store" class="img-fluid">
                </div>
            </div>
        </div>

        <div class="text-center py-4 mt-4 border-top border-secondary small">
            e-Food © {{ date('Y') }}
        </div>
    </div>

    <!-- Floating FAB -->
    <button type="button" class="fab" id="chatFab" data-bs-toggle="tooltip" data-bs-placement="left"
        title="Chat dengan Chef!">
        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="white" viewBox="0 0 24 24">
            <path
                d="M12.04 2.004a9.96 9.96 0 0 0-8.54 15.25l-1.13 4.11 4.22-1.11a9.95 9.95 0 0 0 5.45 1.55c5.52 0 10-4.48 10-10s-4.47-10-10-10Zm0 18.4c-1.75 0-3.37-.49-4.74-1.35l-.34-.21-2.5.66.67-2.43-.22-.35a8.37 8.37 0 0 1-1.37-4.61c0-4.66 3.79-8.45 8.45-8.45 4.66 0 8.45 3.79 8.45 8.45s-3.79 8.45-8.45 8.45Zm4.5-6.52c-.25-.13-1.5-.74-1.73-.82-.23-.08-.4-.13-.57.13s-.66.82-.81.98c-.15.17-.3.18-.55.05-.25-.13-1.05-.39-2-1.26a7.51 7.51 0 0 1-1.38-1.7c-.15-.25-.02-.39.11-.52.11-.12.25-.3.37-.45.13-.15.17-.26.26-.43.08-.17.04-.32-.02-.45s-.57-1.37-.78-1.88c-.2-.48-.4-.42-.55-.43h-.47c-.17 0-.45.06-.68.3s-.89.87-.89 2.12c0 1.25.91 2.46 1.04 2.63.13.17 1.78 2.71 4.31 3.8.6.26 1.07.41 1.43.53.6.19 1.14.16 1.57.1.48-.07 1.5-.61 1.71-1.2.21-.59.21-1.1.15-1.2-.06-.1-.23-.15-.48-.28Z" />
        </svg>
    </button>
    <div class="fab-tooltip">Chat langsung dengan Chef!</div>

    <!-- Chat Popup Box -->
    <div id="chatPopup" class="chat-popup">
        <div class="p-3 border-bottom d-flex align-items-center justify-content-between">
            <div class="chat-header">💬 Chat ke Chef</div>
            <button type="button" class="btn-close" id="closePopup" aria-label="Close"></button>
        </div>
        <div class="p-3">
            <textarea class="form-control" id="chatMessage" rows="3" placeholder="Tulis pesan kamu..."></textarea>
            <button class="btn w-100 mt-2" id="sendToWhatsApp">Kirim via WhatsApp</button>
        </div>
    </div>
</footer>
