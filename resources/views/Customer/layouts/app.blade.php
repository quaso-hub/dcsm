<!DOCTYPE html>
<html lang="id" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Customer') | BellFresh</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        .dark {
            background-color: #1f1f1f !important;
            color: #e2e2e2 !important
        }

        .dark .bg-white,
        .dark .navbar,
        .dark .dropdown-menu,
        .dark .offcanvas,
        .dark .card,
        .dark .form-control,
        .dark .modal-content {
            background-color: #2b2b2b !important;
            color: #f2f2f2 !important;
            border-color: #3d3d3d !important
        }

        .dark h1,
        .dark h2,
        .dark h3,
        .dark h4,
        .dark h5,
        .dark .section-title {
            color: #ffffff !important
        }

        .dark .form-control::placeholder {
            color: #aaaaaa !important
        }

        .dark .dropdown-item {
            color: #e0e0e0 !important
        }

        .dark .dropdown-item:hover,
        .dark .dropdown-item:focus {
            background-color: #3c3c3c !important;
            color: #fff !important
        }

        .dark .btn-outline-secondary {
            color: #ffffff;
            border-color: #666
        }

        .dark .btn-outline-secondary:hover {
            background-color: #444;
            border-color: #666
        }

        .dark .badge.bg-danger {
            background-color: #dc3545 !important
        }

        .dark .scroll-x>.card-wrapper,
        .dark .card2-wrapper {
            background-color: #2c2c2c
        }

        .dark ::-webkit-scrollbar {
            width: 8px;
            height: 6px
        }

        .dark ::-webkit-scrollbar-thumb {
            background: #444;
            border-radius: 3px
        }

        @media (max-width: 575.98px) {
            footer {
                display: none !important
            }
        }


        /* DESKTOP (Default) */
        .modal-dialog {
            max-width: 720px;
            margin: 1.75rem auto;
            display: flex;
            align-items: center;
            min-height: calc(100vh - 3.5rem);
            /* cukup turun agar tidak nabrak */
        }

        .modal-content {
            border-radius: 1.25rem;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            background: #fff;
        }

        /* BACKDROP Enhanced */
        .modal-backdrop.show {
            background-color: rgba(0, 0, 0, 0.55);
            backdrop-filter: blur(6px);
            z-index: 1080 !important;
        }

        /* MODAL z-index */
        .modal.modal-bottomsheet {
            z-index: 1090 !important;
        }

        /* === MOBILE BOTTOM SHEET === */
        @media (max-width: 768px) {
            .modal.modal-bottomsheet .modal-dialog {
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                top: auto;
                margin: 0;
                width: 100%;
                max-height: 95vh;
                height: auto;
                transform: translateY(100%);
                transition: transform 0.35s ease-out;
                display: block;
                /* override desktop flex */
                pointer-events: auto;
            }

            .modal.modal-bottomsheet.show .modal-dialog {
                transform: translateY(0);
            }

            .modal.modal-bottomsheet .modal-content {
                border-radius: 1.25rem 1.25rem 0 0;
                max-height: 95vh;
                height: auto;
                overflow-y: auto;
                box-shadow: 0 -2px 18px rgba(0, 0, 0, 0.12);
            }

            .dark .modal.modal-bottomsheet .modal-content {
                background-color: #2b2b2b;
                color: #fff;
            }

            /* Ensure it doesn’t float like desktop */
            .modal-dialog {
                align-items: flex-end !important;
                min-height: unset !important;
            }
        }



        .modal-body img {
            max-height: 300px;
            object-fit: cover
        }

        .mod-hdr {
            display: flex;
            gap: .75rem
        }

        .mod-hdr img {
            width: 88px;
            height: 88px;
            object-fit: cover;
            border-radius: .75rem
        }

        .mod-badge {
            font-size: .65rem;
            padding: .15rem .45rem;
            border-radius: 50rem;
            background: #e9ecef
        }

        .opt-box {
            border: 1px solid #eee;
            border-radius: .9rem;
            padding: 1rem;
            margin-bottom: 1.25rem
        }

        .opt-hd {
            font-weight: 600;
            margin-bottom: .75rem;
            display: flex;
            justify-content: space-between;
            align-items: center
        }

        .opt-line {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: .6rem
        }

        .opt-line:last-child {
            margin: 0
        }

        .price-sm {
            white-space: nowrap
        }

        .btn-qty {
            width: 28px;
            height: 28px;
            border: none;
            border-radius: .35rem;
            background: #e63946;
            color: #fff;
            font-size: 1rem;
            display: flex;
            align-items: center;
            justify-content: center
        }

        .btn-qty.outline {
            background: #fff;
            border: 1px solid #e63946;
            color: #e63946
        }

        .total-row {
            font-weight: 600
        }

        .dark .opt-box {
            border-color: #444;
            background: #2b2b2b
        }

        .dark .btn-qty.outline {
            background: #2b2b2b;
            color: #e63946;
            border-color: #666
        }

        .dark .mod-badge {
            background: #353535;
            color: #fff
        }

        .opt-line .addon-qty {
            transition: all .2s ease;
        }

        .opt-line .addon-qty:not(.show) {
            opacity: 0;
            visibility: hidden;
        }

        .opt-line .addon-qty.show {
            opacity: 1;
            visibility: visible;
        }

        .dark .btn-close {
            filter: invert(1);
            opacity: 0.9;
        }

        .dark .like-btn i {
            color: #fff;
        }

        .like-btn i {
            transition: color 0.25s ease-in-out;
        }

        html,
        body {
            height: 100%;
            overflow-x: hidden;
            scrollbar-width: none;
        }

        body {
            -ms-overflow-style: none;
        }

        body::-webkit-scrollbar {
            display: none;
        }


        /* scrollabe modals toppings */
        .scroll-section {
            max-height: 320px;
            overflow-y: auto;
            padding-right: 5px;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .scroll-section::-webkit-scrollbar {
            display: none;
        }

        .scroll-section {
            scroll-behavior: smooth;
            transition: max-height 0.3s ease;
        }

        .scroll-section {
            box-shadow: inset 0 8px 8px -8px rgba(0, 0, 0, 0.1), inset 0 -8px 8px -8px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 768px) {
            .scroll-section {
                max-height: 50vh;
            }
        }
    </style>
</head>

<body class="position-relative">

    @include('Customer.layouts.navbar')
    @include('Customer.layouts.sidebar')
    <main class="container-fluid content-area pt-4 pt-md-5 mb-lg-5 pb-lg-5">
        @yield('content')
    </main>

    @include('Customer.layouts.bottomnav')
    @include('Customer.layouts.footer')

    <div class="modal fade modal-bottomsheet" id="productModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    <button id="pm-like" class="btn btn-sm like-btn"><i class="bi bi-heart"></i></button>
                </div>
                <div class="mod-hdr mb-3">
                    <img id="pm-img" class="rounded">
                    <div class="flex-grow-1">
                        <h5 id="pm-title" class="mb-1"></h5>
                        <div class="small mb-1">
                            <span id="pm-rating">4.0</span> ★
                            <a id="pm-rev" href="#" class="text-decoration-none">(0 Reviews)</a>
                        </div>
                        <div class="h5 text-danger mb-1">Rp <span id="pm-price"></span></div>
                        <span class="mod-badge" id="pm-badge"></span>
                    </div>
                </div>

                <div class="scroll-section mb-3" id="pm-opts">
                </div>
                <div class="d-flex justify-content-between align-items-center total-row mb-3">
                    <span>Total</span><span class="h5 text-danger"><span id="pm-total"></span></span>
                </div>
                <div class="d-flex gap-3 mb-2">
                    <div class="d-flex align-items-center gap-2">
                        <button class="btn-qty outline" onclick="chgMainQty(-1)">−</button>
                        <span id="pm-qty">1</span>
                        <button class="btn-qty outline" onclick="chgMainQty(1)">＋</button>
                    </div>
                    <button class="btn flex-grow-1 btn-danger" onclick="addToCart()">Add to Cart</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function toggleSidebar() {
            document.getElementById('sidebarBackdrop').classList.toggle('show');
        }
        if (localStorage.getItem('theme') === 'dark') document.body.classList.add('dark');
        window.toggleTheme = () => {
            document.body.classList.toggle('dark');
            localStorage.setItem('theme', document.body.classList.contains('dark') ? 'dark' : 'light');
        };

        function toggleTheme() {
            document.documentElement.classList.toggle('dark')
            localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light')
        }

        document.getElementById('themeToggleDesktop')?.addEventListener('click', toggleTheme);
        document.getElementById('themeToggleMobile')?.addEventListener('click', toggleTheme);

        function toggleSidebar() {
            const ov = document.getElementById('sidebarBackdrop');
            if (ov) {
                ov.classList.toggle('show');
                return;
            }
            const el = document.getElementById('sidebar');
            if (el) {
                let o = bootstrap.Offcanvas.getInstance(el);
                if (!o) {
                    o = new bootstrap.Offcanvas(el);
                }
                o.toggle();
            }
        }
        document.addEventListener('DOMContentLoaded', () => {
            if (localStorage.getItem('theme') === 'dark') {
                document.body.classList.add('dark');
            }
        });


        const qs = (s, el = document) => el.querySelector(s)
        const modal = new bootstrap.Modal('#productModal')
        const cart = {}
        const liked = new Set()
        let prod = {}

        const modalEl = document.getElementById('productModal')
        modalEl.addEventListener('shown.bs.modal', () => {
            if (window.innerWidth <= 768) modalEl.classList.add('show')
        })
        modalEl.addEventListener('hidden.bs.modal', () => {
            modalEl.classList.remove('show')
        })


        function money(n) {
            return 'Rp' + new Intl.NumberFormat('id-ID').format(n);
        }

        function calcTotal() {
            if (!prod.price) return;
            let total = prod.price * prod.qty;
            const optSection = qs('#pm-opts');

            // kalkulasi untuk semua input yang dipilih (radio & checkbox)
            optSection.querySelectorAll('input:checked').forEach(input => {
                total += +input.dataset.price * prod.qty;
            });

            qs('#pm-total').textContent = money(total);
        }

        function chgMainQty(d) {
            prod.qty = Math.max(1, prod.qty + d)
            qs('#pm-qty').textContent = prod.qty
            calcTotal()
        }


        // add qty dinamis
        function updateCartBadge(totalQty) {
            const badge = document.getElementById('badge-cart');
            if (!badge) return;

            badge.textContent = totalQty;
            badge.classList.add('btn-shake');

            setTimeout(() => {
                badge.classList.remove('btn-shake');
            }, 300);
        }





        function addToCart() {

            const customizations = [];
            document.querySelectorAll('#pm-opts input:checked').forEach(el => {
                customizations.push(el.value);
            });

            $.ajax({
                url: "{{ route('cart.store') }}",
                type: "POST",
                data: {
                    food_id: prod.id,
                    qty: prod.qty,
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    customizations: customizations,
                },
                success: function(response) {
                    updateCartBadge(response.cart_total_qty);
                    cart[prod.id] = {
                        ...prod,
                        qty: (cart[prod.id]?.qty || 0) + prod.qty
                    };
                    updateCard(prod.id);
                    modal.hide();
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.message,
                        toast: true,
                        timer: 2000,
                        showConfirmButton: false,
                        position: 'top-end'
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Tidak bisa menambahkan ke cart.',
                        toast: true,
                        timer: 2000,
                        showConfirmButton: false,
                        position: 'top-end'
                    });
                }
            });
        }

        function toggleLike(id, fromModal = false) {
            if (liked.has(id)) {
                liked.delete(id)
            } else {
                liked.add(id)
            }
            document.querySelectorAll(`[data-id="${id}"] .like-btn`).forEach(btn => {
                btn.classList.toggle('active', liked.has(id))
                const icon = btn.querySelector('i')
                if (icon) icon.className = liked.has(id) ? 'bi bi-heart-fill' : 'bi bi-heart'
            })
            if (fromModal) {
                const icon = qs('#pm-like i')
                if (icon) icon.className = liked.has(id) ? 'bi bi-heart-fill' : 'bi bi-heart'
                qs('#pm-like').classList.toggle('active', liked.has(id))
            }
        }

        function populate(data) {
            // set data produk utama ke variabel global `prod`
            prod = {
                id: data.id,
                title: data.name,
                price: data.base_price,
                image: data.image_path,
                qty: 1
            };

            // isi elemen-elemen dasar di modal
            qs('#pm-img').src = prod.image;
            qs('#pm-title').textContent = prod.title;
            qs('#pm-price').textContent = prod.price.toLocaleString('id-ID');
            qs('#pm-rating').textContent = data.rating || '4.0';
            qs('#pm-rev').textContent = `(${data.reviews || 0} Reviews)`;
            qs('#pm-rev').href = "{{ route('reviews') }}";
            qs('#pm-qty').textContent = '1';
            qs('#pm-badge').textContent = 'Veg';
            qs('#pm-like i').className = liked.has(prod.id) ? 'bi bi-heart-fill' : 'bi bi-heart';
            qs('#pm-like').onclick = () => toggleLike(prod.id, true);

            const opts = data.options;
            const defaultIds = data.default_ids;
            const wrapper = qs('#pm-opts');
            wrapper.innerHTML = '';

            opts.forEach(group => {
                const box = document.createElement('div');
                box.className = 'opt-box';

                // Tentukan tipe input dan badge berdasarkan data dari backend
                const inputType = group.selection_type === 'radio' ? 'radio' : 'checkbox';
                const badge = inputType === 'checkbox' ? '<span class="badge text-bg-light small">Optional</span>' :
                    '';

                box.innerHTML = `<div class="opt-hd">${group.category_name} ${badge}</div>`;

                group.items.forEach((it, i) => {
                    const line = document.createElement('div');
                    line.className = 'opt-line';

                    // Cek apakah item ini harus terpilih secara default
                    const isChecked = defaultIds.includes(it.id) ? 'checked' : '';

                    line.innerHTML = `
                        <div class="form-check m-0 flex-grow-1">
                            <input type="${inputType}"
                                   class="form-check-input"
                                   name="opt-${group.category_name.replace(/\s+/g, '-')}"
                                   data-price="${it.extra_price}"
                                   value="${it.id}"
                                   id="item-${it.id}" ${isChecked}>
                            <label class="form-check-label ms-1" for="item-${it.id}">${it.name}</label>
                        </div>
                        <div class="price-sm">${it.extra_price > 0 ? '+ ' + money(it.extra_price) : ''}</div>`;

                    box.appendChild(line);
                });
                wrapper.appendChild(box);
            });

            // 5. Panggil fungsi kalkulasi harga awal
            calcTotal();
        }

        function updateCard(id) {
            const el = document.querySelector(`[data-id="${id}"]`)
            if (!el) return
            const area = el.querySelector('.action-area')
            if (!area) return
            if (cart[id]) {
                area.innerHTML = `
          <div class="qty-pill d-flex justify-content-between align-items-center">
            <button class="circle" onclick="removeFromCart('${id}')">−</button>
            <span>${cart[id].qty}</span>
            <button class="circle" onclick="addToCart('${id}')">＋</button>
          </div>`
            } else {
                area.innerHTML = `
          <button class="pg-btn add-btn d-flex align-items-center justify-content-center gap-1">
            <i class="bi bi-plus-circle"></i> Add
          </button>`
            }
        }

        function removeFromCart(id) {
            if (cart[id]) {
                cart[id].qty -= 1
                if (cart[id].qty <= 0) {
                    delete cart[id]
                }
                updateCard(id)
            }
        }

        document.addEventListener('click', e => {
            const btn = e.target.closest('.add-btn')
            if (btn) {
                const el = btn.closest('[data-id]');
                const id = el.dataset.id;

                $.ajax({
                    url: `/customer/foods/${id}/details`,
                    method: 'GET',
                    beforeSend: function() {
                        // Tampilkan modal dengan loading spinner
                        qs('#pm-opts').innerHTML =
                            '<div class="text-center p-5"><div class="spinner-border text-danger" role="status"></div></div>';
                        modal.show();
                    },
                    success: function(response) {
                        // Jika berhasil, panggil fungsi populate LAMA Anda dengan data BARU dari server
                        populate(response);
                    },
                    error: function() {
                        alert('Gagal memuat detail produk.');
                        modal.hide();
                    }
                });
            }

            // Event listener untuk kalkulasi ulang harga (dari kode lama Anda)
            if (e.target.matches('input[type=radio], input[type=checkbox]')) {
                calcTotal();
            }

            if (e.target.classList.contains('mini')) {
                const line = e.target.closest('.opt-line')
                let qty = +line.querySelector('.qty').textContent
                if (e.target.textContent === '＋') qty++
                else qty--
                qty = Math.max(0, qty)
                line.querySelector('.qty').textContent = qty
                line.querySelectorAll('.mini').forEach(b => b.disabled = qty === 0)
                calcTotal()
            }

            if (e.target.classList.contains('chk')) {
                const line = e.target.closest('.opt-line')
                const showArea = line.querySelector('.addon-qty')
                const enabled = e.target.checked
                if (enabled) {
                    showArea.classList.add('show')
                    showArea.querySelectorAll('.mini').forEach(b => b.disabled = false)
                } else {
                    showArea.classList.remove('show')
                    showArea.querySelector('.qty').textContent = '0'
                    showArea.querySelectorAll('.mini').forEach(b => b.disabled = true)
                }
                calcTotal()
            }

            const heart = e.target.closest('.like-btn')
            if (heart && heart.closest('.card')) {
                const card = heart.closest('[data-id]')
                if (card) toggleLike(card.dataset.id)
            }
        })




        // search live ajax
        document.addEventListener('DOMContentLoaded', () => {

            document.querySelectorAll('.search-input').forEach(input => {
                input.addEventListener('focus', () => {
                    showSearchOverlay(input);
                });

                input.addEventListener('blur', () => {
                    hideSearchOverlayDelayed(input);
                });

                input.addEventListener('input', () => {
                    filterSuggestions(input);
                });

                input.closest('.search-wrapper').querySelectorAll('.suggestion-item').forEach(item => {
                    item.addEventListener('mousedown', function(e) {
                        e.preventDefault();
                        input.value = this.textContent;
                        hideSearchOverlay();
                    });
                });
            });
        });

        function showSearchOverlay(inputEl) {
            document.querySelector('.search-overlay').style.display = 'block';
            const wrap = inputEl.closest('.search-wrapper');
            wrap.classList.add('suggestions-open');

            wrap.querySelectorAll('.suggestion-item').forEach((el, i) => {
                el.style.animation = 'none';
                el.offsetHeight;
                el.style.animation = `fadeInUp .3s ease forwards`;
                el.style.animationDelay = `${i * 80}ms`;
            });
        }

        function hideSearchOverlayDelayed(inputEl) {
            setTimeout(() => {
                if (!inputEl.matches(':focus')) hideSearchOverlay();
            }, 150);
        }

        function hideSearchOverlay() {
            document.querySelector('.search-overlay').style.display = 'none';
            document.querySelectorAll('.search-wrapper').forEach(wrap => wrap.classList.remove('suggestions-open'));
        }

        function filterSuggestions(inputEl) {
            const q = inputEl.value.toLowerCase();
            inputEl.closest('.search-wrapper').querySelectorAll('.suggestion-item').forEach(el => {
                el.style.display = el.textContent.toLowerCase().includes(q) ? 'block' : 'none';
            });
        }







        // like local storage bukan db
        const LIKE_KEY = 'favourites';

        function getLikedItems() {
            return JSON.parse(localStorage.getItem(LIKE_KEY)) || [];
        }

        function saveLikedItems(items) {
            localStorage.setItem(LIKE_KEY, JSON.stringify(items));
        }

        function toggleLike(btn) {
            const id = btn.dataset.id;
            let liked = getLikedItems();

            if (liked.includes(id)) {
                liked = liked.filter(i => i !== id);
                btn.classList.remove('active');
                btn.innerHTML = '<i class="bi bi-heart"></i>';
            } else {
                liked.push(id);
                btn.classList.add('active');
                btn.innerHTML = '<i class="bi bi-heart-fill"></i>';
            }

            saveLikedItems(liked);
            updateLikeBadge();
        }

        function updateLikeBadge() {
            const badge = document.getElementById('badge-like');
            if (!badge) return;

            const liked = getLikedItems();
            badge.textContent = liked.length;
            badge.classList.add('btn-shake');
            setTimeout(() => badge.classList.remove('btn-shake'), 300);
        }

        document.addEventListener('DOMContentLoaded', () => {
            updateLikeBadge();
            const liked = getLikedItems();
            liked.forEach(id => {
                const btn = document.querySelector(`.like-btn[data-id="${id}"]`);
                if (btn) {
                    btn.classList.add('active');
                    btn.innerHTML = '<i class="bi bi-heart-fill"></i>';
                }
            });
        });



        const fabBtn = document.getElementById('chatFab');
        const popup = document.getElementById('chatPopup');
        const closeBtn = document.getElementById('closePopup');
        const sendBtn = document.getElementById('sendToWhatsApp');
        const messageInput = document.getElementById('chatMessage');

        // Activate tooltip
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        const tooltipList = tooltipTriggerList.map(el => new bootstrap.Tooltip(el));

        // Toggle popup
        fabBtn.addEventListener('click', () => {
            popup.style.display = popup.style.display === 'none' || popup.style.display === '' ? 'block' : 'none';
        });

        closeBtn.addEventListener('click', () => {
            popup.style.display = 'none';
        });

        sendBtn.addEventListener('click', () => {
            const message = encodeURIComponent(messageInput.value.trim());
            if (!message) {
                alert("Tulis pesan dulu ya!");
                return;
            }
            const phone = '6282199358366';
            const url = `https://wa.me/${phone}?text=${message}`;
            window.open(url, '_blank');
        });
    </script>
</body>

</html>
