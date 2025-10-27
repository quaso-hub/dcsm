@extends('Customer.layouts.app')
@section('title', 'Customize Your Meal')

@section('content')
    @php
        $categories = [
            'Base' => [
                [
                    'name' => 'Salad Bowl',
                    'price' => 6.5,
                    'cal' => 250,
                    'image' => 'https://picsum.photos/seed/salad/100',
                ],
                ['name' => 'Wrap', 'price' => 7.0, 'cal' => 300, 'image' => 'https://picsum.photos/seed/wrap/100'],
            ],
            'Size' => [
                ['name' => 'Small', 'price' => 0, 'cal' => 0],
                ['name' => 'Medium', 'price' => 1.5, 'cal' => 50],
                ['name' => 'Large', 'price' => 2.5, 'cal' => 100],
            ],
            'Toppings' => [
                [
                    'name' => 'Chia Seeds',
                    'price' => 0.75,
                    'cal' => 30,
                    'image' => 'https://picsum.photos/seed/chia/100',
                ],
                ['name' => 'Quinoa', 'price' => 1.25, 'cal' => 80, 'image' => 'https://picsum.photos/seed/quinoa/100'],
            ],
            'Sides' => [
                ['name' => 'Soup', 'price' => 2.0, 'cal' => 90, 'image' => 'https://picsum.photos/seed/soup/100'],
                [
                    'name' => 'Fruit Mix',
                    'price' => 2.25,
                    'cal' => 120,
                    'image' => 'https://picsum.photos/seed/fruits/100',
                ],
            ],
            'Drinks' => [
                ['name' => 'Juice', 'price' => 1.75, 'cal' => 100, 'image' => 'https://picsum.photos/seed/juice/100'],
                ['name' => 'Water', 'price' => 1.0, 'cal' => 0, 'image' => 'https://picsum.photos/seed/water/100'],
            ],
            'Add-ons' => [
                [
                    'name' => 'Extra Sauce',
                    'price' => 0.5,
                    'cal' => 40,
                    'image' => 'https://picsum.photos/seed/sauce/100',
                ],
                [
                    'name' => 'Bread Stick',
                    'price' => 1.25,
                    'cal' => 130,
                    'image' => 'https://picsum.photos/seed/bread/100',
                ],
            ],
        ];
    @endphp

    <style>
        :root {
            --bg-light: #fff;
            --fg-light: #000;
            --bg-dark: #121212;
            --fg-dark: #e0e0e0;
            --primary: #4caf50;
            --secondary: #9e9e9e;
            --card-radius: 1rem;
        }

        body {
            background-color: var(--bg-light);
            color: var(--fg-light);
            font-family: 'Segoe UI', sans-serif;
        }

        body.dark {
            background-color: var(--bg-dark);
            color: var(--fg-dark);
        }

        .btn-modern {
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-modern:hover {
            opacity: 0.9;
        }

        .btn-outline-primary {
            border-color: var(--primary);
            color: var(--primary);
        }

        .btn-outline-primary:hover {
            background-color: var(--primary);
            color: #fff;
        }

        .container {
            max-width: 800px;
        }


        /* card custom choose */
        .card.custom-meal {
            border: none;
            border-radius: 1rem;
            background: linear-gradient(to bottom right, #ffffff, #f8f9fa);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card.custom-meal:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.08);
        }

        .card.custom-meal .card-header {
            background: transparent;
            border-bottom: 1px dashed rgba(0, 0, 0, 0.1);
            font-weight: 600;
            font-size: 1rem;
            color: #333;
        }

        .card.custom-meal .card-body {
            padding: 1rem 1.25rem;
            font-size: 0.95rem;
            color: #555;
        }

        .card.custom-meal .btn-modern {
            font-size: 0.8rem;
            padding: 0.35rem 0.75rem;
            border-radius: 50rem;
            transition: all 0.25s ease;
        }

        .card.custom-meal .btn-modern:hover {
            background-color: #0d6efd;
            color: #fff;
            box-shadow: 0 4px 10px rgba(13, 110, 253, 0.3);
            border-color: transparent;
        }

        body.dark .card.custom-meal {
            background: linear-gradient(to bottom right, #2c2c2c, #1e1e1e);
            box-shadow: 0 6px 18px rgba(255, 255, 255, 0.03);
        }

        body.dark .card.custom-meal .card-header,
        body.dark .card.custom-meal .card-body {
            color: #eee;
            border-color: rgba(255, 255, 255, 0.08);
        }


        .selected-item {
            transition: transform 0.3s ease;
            background-color: #f1f1f1;
            color: #000;
        }

        body.dark .selected-item {
            background-color: #333;
            color: #fff;
        }

        .selected-item:hover {
            transform: scale(1.02);
        }

        .modal .modal-content {
            border-radius: var(--card-radius);
            transition: transform 0.2s ease;
        }

        .modal.show .modal-dialog {
            transform: scale(1.02);
        }

        .modal-body .text-center {
            transition: background 0.2s ease;
            border-radius: 0.75rem;
            padding: 1rem;
        }

        .modal-body .text-center:hover {
            background: rgba(0, 0, 0, 0.05);
        }

        body.dark .modal-body .text-center:hover {
            background: rgba(255, 255, 255, 0.05);
        }

        .summary-card {
            background: #f8f9fa;
            color: #212529;
            border-radius: 14px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
            transition: background 0.3s, box-shadow 0.3s, color 0.3s;
        }

        .summary-card .summary-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .summary-card .summary-list li {
            display: flex;
            justify-content: space-between;
            padding: 6px 0;
            border-bottom: 1px dashed rgba(0, 0, 0, 0.05);
            font-size: 0.95rem;
        }

        body.dark .summary-card {
            background: #252525;
            color: #f1f1f1;
            box-shadow: 0 0 0 1px rgba(255, 255, 255, 0.05), 0 4px 16px rgba(0, 0, 0, 0.5);
        }

        body.dark .summary-card .summary-list li {
            border-color: rgba(255, 255, 255, 0.1);
        }

        @media (max-width: 768px) {
            .summary-card {
                margin-bottom: 90px;
                padding: 1.25rem;
            }
        }

        .btn-success {
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .btn-success:hover {
            transform: scale(1.02);
        }

        @media (max-width: 768px) {
            .card {
                border-radius: 0.75rem;
            }

            .container {
                padding-bottom: 120px;
            }
        }

        .modal {
            z-index: 2000;
        }

        body.dark .modal-content .text-muted {
            color: rgba(255, 255, 255, 0.6) !important;
        }

        .selected-item-wrapper {
            position: relative;
            padding-right: 2rem;
        }

        .btn-close-custom {
            background-color: rgba(220, 53, 69, 0.1);
            color: #dc3545;
            border: none;
            border-radius: 50%;
            font-size: 0.75rem;
            width: 22px;
            height: 22px;
            line-height: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: background 0.2s ease;
        }

        .btn-close-custom:hover {
            background-color: rgba(220, 53, 69, 0.2);
        }

        .swal2-rounded {
            border-radius: 1rem !important;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }

        .modal-body-grid {
            display: grid;
            gap: 1.5rem;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        }

        .modal-body-grid .item-card {
            text-align: center;
            border-radius: 0.75rem;
            padding: 1rem;
            transition: background 0.2s ease;
        }

        .modal-body-grid .item-card:hover {
            background: rgba(0, 0, 0, 0.05);
        }

        body.dark .modal-body-grid .item-card:hover {
            background: rgba(255, 255, 255, 0.05);
        }

        @media (max-width: 768px) {
            .modal.mobile-bottom .modal-dialog {
                position: fixed;
                bottom: 0;
                left: 0;
                margin: 0;
                width: 100%;
                height: auto;
                max-height: 90%;
                border-radius: 1rem 1rem 0 0;
            }

            .modal.mobile-bottom .modal-content {
                border-radius: 1rem 1rem 0 0;
                height: 100%;
                overflow-y: auto;
            }
        }
    </style>

    <div class="container py-5 position-relative">
        <button class="btn btn-modern btn-outline-primary position-absolute top-0 start-0 m-3" onclick="history.back()">
            Back
        </button>

        <h2 class="text-center fw-bold mb-4 mt-5 pt-2">Customize Your Meal</h2>

        @foreach (['Base', 'Size', 'Toppings', 'Sides', 'Drinks', 'Add-ons'] as $category)
            <div class="card mb-4 custom-meal">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ $category }}</span>
                    <button class="btn btn-sm btn-modern btn-outline-primary"
                        onclick="openPopup('{{ $category }}')">Choose</button>
                </div>
                <div class="card-body d-flex flex-wrap gap-3" id="selected-{{ $category }}">
                    <em>No item selected</em>
                </div>
            </div>
        @endforeach


        <div class="card summary-card mt-5 p-4">
            <div class="card-body">
                <h5 class="fw-bold mb-4">Ringkasan Pesanan</h5>
                <ul class="summary-list mb-3">
                    <li>Total Item: <span id="totalItems">0</span></li>
                    <li>Total Kalori: <span id="totalCalories">0</span> cal</li>
                    <li>Subtotal: <span>$<span id="subtotal">0.00</span></span></li>
                    <li>Pajak (10%): <span>$<span id="tax">0.00</span></span></li>
                </ul>
                <div class="d-flex justify-content-between align-items-center border-top pt-3 mt-3">
                    <strong>Total:</strong>
                    <strong>$<span id="total">0.00</span></strong>
                </div>
                <button class="btn btn-success w-100 mt-4 rounded-pill fw-semibold shadow-sm"
                    onclick="confirmAddToCart()">Tambah ke Keranjang</button>
            </div>
        </div>

    </div>

    {{-- MODALS --}}
    @foreach ($categories as $group => $items)
        <div class="modal fade mobile-bottom" id="popup-{{ $group }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Select {{ $group }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body modal-body-grid">
                        @foreach ($items as $index => $item)
                            <div class="text-center mb-4">
                                @if (isset($item['image']))
                                    <img src="{{ $item['image'] }}" class="img-thumbnail mb-2" alt="{{ $item['name'] }}"
                                        style="width:100px;height:100px;object-fit:cover;border-radius:0.75rem;">
                                @endif
                                <h6 class="mb-1">{{ $item['name'] }}</h6>
                                <p class="text-muted small">${{ number_format($item['price'], 2) }} · {{ $item['cal'] }}
                                    cal</p>
                                <div id="controls-{{ $group }}-{{ $index }}">
                                    <button class="btn btn-sm btn-outline-primary btn-modern"
                                        onclick="addItem('{{ $group }}', {{ $index }})">Add</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selection = {};
            const items = @json($categories);
            const taxRate = 0.1;

            window.openPopup = function(group) {
                const modal = new bootstrap.Modal(document.getElementById(`popup-${group}`));
                modal.show();
            };

            window.addItem = function(group, index) {
                selection[`${group}-${index}`] = 1;
                renderQty(group, index);
                updateDisplay();
            };

            window.adjustQty = function(group, index, delta) {
                const key = `${group}-${index}`;
                selection[key] = (selection[key] || 0) + delta;
                if (selection[key] <= 0) {
                    delete selection[key];
                    renderAdd(group, index);
                } else {
                    renderQty(group, index);
                }
                updateDisplay();
            };

            window.renderAdd = function(group, index) {
                const el = document.getElementById(`controls-${group}-${index}`);
                if (el) {
                    el.innerHTML =
                        `<button class="btn btn-sm btn-outline-primary btn-modern" onclick="addItem('${group}', ${index})">Add</button>`;
                }
            };

            window.renderQty = function(group, index) {
                const el = document.getElementById(`controls-${group}-${index}`);
                if (el) {
                    el.innerHTML = `
                    <div class="d-flex justify-content-center align-items-center gap-2">
                        <button class="btn btn-sm btn-outline-secondary btn-modern" onclick="adjustQty('${group}', ${index}, -1)">−</button>
                        <span class="fw-semibold">${selection[`${group}-${index}`]}</span>
                        <button class="btn btn-sm btn-outline-secondary btn-modern" onclick="adjustQty('${group}', ${index}, 1)">＋</button>
                    </div>
                `;
                }
            };

            window.removeItem = function(group, index) {
                delete selection[`${group}-${index}`];
                renderAdd(group, index);
                updateDisplay();
            };

            window.confirmAddToCart = function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Your custom meal has been added.',
                    background: document.body.classList.contains('dark') ? '#1f1f1f' : '#fff',
                    color: document.body.classList.contains('dark') ? '#fff' : '#000',
                    confirmButtonColor: '#4caf50',
                });
            };

            function updateDisplay() {
                let total = 0,
                    cal = 0,
                    count = 0;

                for (const group in items) {
                    const container = document.getElementById(`selected-${group}`);
                    if (!container) continue;
                    container.innerHTML = '';

                    items[group].forEach((item, i) => {
                        const key = `${group}-${i}`;
                        const qty = selection[key] || 0;
                        if (qty > 0) {
                            count += qty;
                            cal += item.cal * qty;
                            total += item.price * qty;
                            container.innerHTML += `
    <div class="selected-item-wrapper position-relative mb-3">
        <button class="btn btn-sm btn-close-custom position-absolute top-0 end-0 m-1" onclick="removeItem('${group}', ${i})">
            <small>×</small>
        </button>
        <div class="selected-item d-flex align-items-center rounded p-2 shadow-sm">
            ${item.image ? `<img src="${item.image}" class="me-2" style="width: 50px; height: 50px; border-radius: .5rem;">` : ''}
            <div>
                <strong>${qty}× ${item.name}</strong><br>
                $${(item.price * qty).toFixed(2)} · ${item.cal * qty} cal
            </div>
        </div>
    </div>`;


                        }
                    });

                    if (!container.innerHTML) {
                        container.innerHTML = '<em>No item selected</em>';
                    }
                }

                document.getElementById('totalItems').innerText = count;
                document.getElementById('totalCalories').innerText = cal;
                document.getElementById('subtotal').innerText = total.toFixed(2);
                document.getElementById('tax').innerText = (total * taxRate).toFixed(2);
                document.getElementById('total').innerText = (total * (1 + taxRate)).toFixed(2);
            }
        });

        window.showSuccess = function() {
            const isDark = document.body.classList.contains('dark');

            Swal.fire({
                icon: 'success',
                title: 'Added!',
                text: 'Your custom meal has been added.',
                background: isDark ? '#2a2a2a' : '#ffffff',
                color: isDark ? '#eaeaea' : '#1a1a1a',
                confirmButtonColor: '#4caf50',
                customClass: {
                    popup: 'swal2-rounded',
                },
                buttonsStyling: false
            });
        };

        window.selection = {};

        window.removeItem = function(group, index) {
            delete window.selection[`${group}-${index}`];
            renderAdd(group, index);
            updateDisplay();
        };
    </script>
@endsection
