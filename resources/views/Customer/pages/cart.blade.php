@extends('Customer.layouts.app')
@section('title', 'Cart')

@section('content')
    {{-- Blok PHP ini sekarang hanya menggunakan variabel yang sudah dihitung di Controller --}}
    @php
        // Variabel $baseTotal, $tax, dan $fee sekarang dikirim dari CartController@index
        // Ini membuat view lebih bersih
    @endphp

    {{-- Style CSS tidak diubah, sudah sesuai dengan struktur asli --}}
    <style>
        :root {
            --bg-box-light: #ffffff;
            --bg-box-dark: #2b2b2b;
            --text-main-light: #333;
            --text-main-dark: #eee;
            --text-secondary-light: #666;
            --text-secondary-dark: #bbb;
        }

        body {
            color: var(--text-main-light);
        }

        body.dark {
            color: var(--text-main-dark);
        }

        .cart-container {
            max-width: 1140px;
            margin: auto;
            padding-bottom: 6rem;
        }

        .cart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .btn-back {
            display: none;
            background: transparent;
            border: none;
            font-size: 1.3rem;
            color: var(--text-main-light);
        }

        body.dark .btn-back {
            color: var(--text-main-dark);
        }

        @media(max-width:768px) {
            .btn-back {
                display: inline-block;
            }
        }

        .card-box {
            background: var(--bg-box-light);
            border-radius: 1rem;
            padding: 1rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            color: var(--text-main-light);
        }

        body.dark .card-box {
            background: var(--bg-box-dark);
            color: var(--text-main-dark);
        }

        .cart-item {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .cart-img {
            width: 90px;
            height: 90px;
            object-fit: cover;
            border-radius: 0.75rem;
        }

        .cart-info {
            flex: 1;
        }

        .cart-info h6 {
            margin: 0;
            font-weight: 600;
            color: inherit;
        }

        .cart-info .customizations {
            font-size: 0.85rem;
            color: var(--text-secondary-light);
            margin-top: 0.25rem;
            line-height: 1.4;
        }

        body.dark .cart-info .customizations {
            color: var(--text-secondary-dark);
        }

        .cart-info .total {
            font-weight: 700;
            color: #d32f2f;
            margin-top: 0.4rem;
        }

        .cart-action {
            text-align: right;
        }

        .summary-line {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            color: var(--text-secondary-light);
        }

        body.dark .summary-line {
            color: var(--text-secondary-dark);
        }

        .summary-total {
            font-size: 1.2rem;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
            color: var(--text-main-light);
        }

        body.dark .summary-total {
            color: var(--text-main-dark);
        }

        .btn-checkout {
            padding: 0.75rem 2rem;
            border-radius: 2rem;
            font-size: 1rem;
        }
    </style>

    <div class="container cart-container">
        <div class="cart-header">
            <div>
                <button class="btn-back" onclick="history.back()"><i class="bi bi-arrow-left"></i></button>
                <h4 class="d-inline-block ms-2 fw-bold">Keranjang Saya</h4>
            </div>
            @if (!$cart->isEmpty())
                <a href="#" class="btn btn-outline-danger" id="clear-cart-btn-original">Kosongkan Keranjang</a>
            @endif
        </div>

        @if (!$cart->isEmpty())
            <div class="card-box">
                <h6 class="mb-3">How would you like to order?</h6>
                <div class="order-mode mb-2">
                    <label><input type="radio" name="mode" value="dine" checked onchange="togglePlace()"> Dine
                        In</label>
                    <label><input type="radio" name="mode" value="takeout" onchange="togglePlace()"> Takeout</label>
                </div>
            </div>

            <div class="card-box place-card" id="placeOptions">
                <h6 class="mb-3">Where would you like to sit?</h6>
                <div class="order-mode">
                    <label><input type="radio" name="place" value="indoor" checked> Indoor</label>
                    <label><input type="radio" name="place" value="outdoor"> Outdoor</label>
                    <label><input type="radio" name="place" value="bar"> Bar</label>
                </div>
            </div>
        @endif


        {{-- Loop ini sekarang menggunakan variabel $cart dari controller, yang berisi data dari tabel cart_items --}}
        @if (!$cart->isEmpty())
            @foreach ($cart as $item)
                <div class="card-box">
                    <div class="cart-item">
                        <img src="{{ asset('storage/' . $item->food->image_path) }}"
                            onerror="this.onerror=null;this.src='https://placehold.co/90x90/e9ecef/333?text=Img';"
                            class="cart-img">
                        <div class="cart-info">
                            {{-- Menampilkan nama dan kuantitas --}}
                            <h6>{{ $item->food->name }} ×{{ $item->quantity }}</h6>

                            {{-- Menampilkan kustomisasi dari kolom JSON --}}
                            @if (!empty($item->customizations))
                                <div class="customizations">
                                    @foreach ($item->customizations as $custom)
                                        + {{ $custom['name'] }}<br>
                                    @endforeach
                                </div>
                            @endif

                            {{-- Menampilkan total harga per item (harga dasar + addons) * kuantitas --}}
                            <div class="total">
                                Rp{{ number_format(($item->base_price + $item->addons_total_price) * $item->quantity) }}
                            </div>
                        </div>
                        <div class="cart-action d-flex flex-column align-items-end">
                            <div class="btn-group mb-2" role="group">
                                {{-- [FIXED] Mengirim ID unik dari cart_items, bukan food_id --}}
                                <button onclick="changeQty({{ $item->id }}, 'decrement')"
                                    class="btn btn-sm btn-outline-secondary">−</button>
                                <button onclick="changeQty({{ $item->id }}, 'increment')"
                                    class="btn btn-sm btn-outline-secondary">+</button>
                            </div>
                            {{-- [FIXED] Mengirim ID unik dari cart_items, bukan food_id --}}
                            <button onclick="removeItem({{ $item->id }})"
                                class="btn btn-sm text-danger p-0">Hapus</button>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="card-box">
                <div class="text-center py-5">
                    <h6 class="mb-3">Keranjang kosong. Silakan tambahkan makanan dulu.</h6>
                </div>
            </div>
        @endif

        {{-- Bagian ringkasan total, sekarang menggunakan variabel dari controller --}}
        @if (!$cart->isEmpty())
            <div class="card-box">
                <div class="summary-line">
                    <div>Subtotal</div>
                    <div>Rp{{ number_format($baseTotal) }}</div>
                </div>
                <div class="summary-line">
                    <div>Pajak (11%)</div>
                    <div>Rp{{ number_format($tax) }}</div>
                </div>
                <div class="summary-line">
                    <div>Biaya Layanan</div>
                    <div>Rp{{ number_format($fee) }}</div>
                </div>
                <div class="summary-line summary-total">
                    <div>Total</div>
                    <div id="totalAmount">Rp{{ number_format($baseTotal + $tax + $fee) }}</div>
                </div>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <button class="btn btn-danger btn-checkout" onclick="submitOrderMeta()">Checkout</button>
            </div>
        @endif
    </div>

    {{-- Script ini dikembalikan ke struktur asli yang menggunakan reload halaman --}}
    <script>
        function updateCartBadge(totalQty) {
            const badge = document.getElementById('badge-cart');
            if (!badge) return;

            badge.textContent = totalQty;
            badge.classList.add('btn-shake');

            setTimeout(() => {
                badge.classList.remove('btn-shake');
            }, 300);
        }

        function changeQty(cartItemId, action) {
            $.ajax({
                url: "{{ route('cart.update') }}",
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    cart_item_id: cartItemId,
                    action: action
                },
                success: function(res) {
                    updateCartBadge(res.cart_total_qty);
                    location.reload();
                },
                error: function() {
                    alert('Gagal memperbarui kuantitas.');
                }
            });
        }




        function removeItem(cartItemId) {
            if (!confirm('Anda yakin ingin menghapus item ini?')) return;

            $.ajax({
                url: "{{ route('cart.remove') }}",
                method: 'DELETE',
                data: {
                    _token: "{{ csrf_token() }}",
                    cart_item_id: cartItemId
                },
                success: function(response) {
                    updateCartBadge(response.cart_total_qty);
                    location.reload();
                },
                error: function() {
                    alert('Gagal menghapus item.');
                }
            });
        }

        document.getElementById('clear-cart-btn-original')?.addEventListener('click', function(e) {
            e.preventDefault();
            if (!confirm('Anda yakin ingin mengosongkan keranjang?')) return;

            let form = document.createElement('form');
            form.method = 'POST';
            form.action = "{{ route('cart.clear') }}";
            form.innerHTML = `
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            `;
            document.body.appendChild(form);
            form.submit();
        });



        function togglePlace() {
            let dine = document.querySelector('input[name="mode"]:checked')?.value;
            let placeCard = document.getElementById('placeOptions');

            if (placeCard && dine === 'dine') {
                placeCard.style.display = 'block';
            } else if (placeCard) {
                placeCard.style.display = 'none';
            }
        }

        function submitOrderMeta() {
            const mode = document.querySelector('input[name="mode"]:checked')?.value;
            const place = document.querySelector('input[name="place"]:checked')?.value;

            fetch("{{ route('cart.meta.store') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    mode,
                    place
                })
            }).then(() => {
                window.location.href = "{{ route('checkout.index') }}";
            });
        }

        togglePlace();
    </script>
@endsection
