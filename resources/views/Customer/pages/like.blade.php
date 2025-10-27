@extends('Customer.layouts.app')
@section('title', 'Favourite')

@section('content')
<style>
    .fav-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem; }
    .fav-back { display: none; border: none; background: transparent; font-size: 1.25rem; color: #333; }

    @media (max-width: 768px) {
        .fav-back { display: inline-block; }
        .fav-header h4 { font-size: 1.25rem; }
    }

    .fav-empty { padding: 4rem 0; text-align: center; }
    .fav-empty i { font-size: 3rem; color: #dc3545; }
    .fav-empty h6 { margin-top: 1rem; font-weight: 600; }

    .dark .fav-back { color: #f1f1f1; }
    .dark .fav-empty i { color: #f88; }
    .dark .fav-empty p { color: #ccc; }

    .pb-safe { padding-bottom: 5rem; }
</style>

<div class="container pb-safe" style="max-width: 1140px;">
    <div class="fav-header">
        <button class="fav-back" onclick="history.back()"><i class="bi bi-arrow-left"></i></button>
        <h4 class="fw-bold m-0">My Favourites</h4>
    </div>

    <div id="fav-list" class="row row-cols-2 row-cols-sm-3 row-cols-md-4 g-4"></div>

    <div id="fav-empty" class="fav-empty d-none">
        <i class="bi bi-heartbreak"></i>
        <h6>Belum ada item favorit</h6>
        <p class="text-muted">Produk yang kamu suka akan muncul di sini.</p>
    </div>
</div>

@php
    $favourites = [
        ['id' => 1, 'title' => 'Pizza Supreme', 'image' => 'https://picsum.photos/seed/pizzaSupreme/400/300', 'price' => 42000, 'rating' => 4.5, 'viewType' => 'card'],
        ['id' => 2, 'title' => 'Crispy Chicken', 'image' => 'https://picsum.photos/seed/crispyChicken/400/300', 'price' => 27000, 'rating' => 4.2, 'viewType' => 'card-2'],
        ['id' => 3, 'title' => 'Chizza Meal', 'image' => 'https://picsum.photos/seed/chizzaFav/400/300', 'price' => 25800, 'rating' => 4.0, 'viewType' => 'card'],
        ['id' => 4, 'title' => 'Beef Burger', 'image' => 'https://picsum.photos/seed/beefBurger/400/300', 'price' => 7200, 'rating' => 3.8, 'viewType' => 'card-2'],
    ];

    $cardsHtml = [];
    foreach ($favourites as $item) {
        $card = $item['viewType'] === 'card-2'
            ? view('Customer.components.product-card-2', [
                'id' => $item['id'],
                'title' => $item['title'],
                'image' => $item['image'],
                'price' => $item['price'],
                'rating' => $item['rating'],
                'fav' => true
              ])->render()
            : view('Customer.components.product-card', [
                'id' => $item['id'],
                'title' => $item['title'],
                'image' => $item['image'],
                'price' => $item['price'],
                'rating' => $item['rating'],
                'fav' => true
              ])->render();
        $cardsHtml[$item['id']] = '<div class="col" data-id="' . $item['id'] . '">' . $card . '</div>';
    }
@endphp

<script>
    const allProducts = @json($favourites);
    const allHtmlCards = @json($cardsHtml);

    function renderFavourites() {
        const favIds = JSON.parse(localStorage.getItem('favourites') || '[]');
        const listEl = document.getElementById('fav-list');
        const emptyEl = document.getElementById('fav-empty');

        listEl.innerHTML = '';

        if (favIds.length === 0) {
            emptyEl.classList.remove('d-none');
            return;
        } else {
            emptyEl.classList.add('d-none');
        }

        favIds.forEach(id => {
            if (allHtmlCards[id]) {
                listEl.insertAdjacentHTML('beforeend', allHtmlCards[id]);
            }
        });

        attachLikeListeners();
    }

    function attachLikeListeners() {
        document.querySelectorAll('.like-btn').forEach(btn => {
            btn.onclick = function () {
                const card = btn.closest('[data-id]');
                const id = card.dataset.id;

                let liked = JSON.parse(localStorage.getItem('favourites') || '[]');
                const index = liked.indexOf(id);
                if (index > -1) {
                    liked.splice(index, 1);
                    localStorage.setItem('favourites', JSON.stringify(liked));
                    updateLikeBadge(-1);
                    renderFavourites();
                } else {
                    liked.push(id);
                    localStorage.setItem('favourites', JSON.stringify(liked));
                    updateLikeBadge(1);
                }
            };
        });
    }

    function updateLikeBadge(change = 0) {
        const badge = document.getElementById('badge-like');
        let count = parseInt(badge?.textContent || '0');
        count = Math.max(count + change, 0);
        badge.textContent = count;
        badge.classList.add('btn-shake');
        setTimeout(() => badge.classList.remove('btn-shake'), 300);
    }

    document.addEventListener('DOMContentLoaded', renderFavourites);
</script>
@endsection
