@extends('Customer.layouts.app')

@section('title', 'Reviews')

@section('content')
<div class="container py-4 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <button class="btn btn-outline-secondary btn-sm rounded-pill px-3" onclick="history.back()">Back</button>
        <button class="btn btn-outline-secondary btn-sm rounded-pill px-3" onclick="resetFilter()" id="resetBtn" style="display: none;">Reset Filter</button>
    </div>

    <h3 class="fw-bold text-center mb-4">Customer Reviews</h3>

    @php
        $reviews = $reviews ?? [
            ['user' => 'Jawad Elmeladi', 'rating' => 5, 'date' => now(), 'comment' => 'Bad'],
            ['user' => 'Brandon Foster', 'rating' => 4, 'date' => '2021-09-05', 'comment' => 'Good'],
        ];
        $total = count($reviews);
        $avg = $total ? round(collect($reviews)->avg('rating'), 1) : 0;
        $counts = collect($reviews)->groupBy('rating')->map->count();
    @endphp

    <div class="row align-items-center justify-content-center mb-5">
        <div class="col-auto text-center">
            <div class="display-3 fw-bold">{{ $avg }}</div>
            <div class="fs-2 text-warning"><i class="bi bi-star-fill"></i></div>
            <div class="text-muted">{{ $total }} review{{ $total !== 1 ? 's' : '' }}</div>
        </div>
        <div class="col-md-6 mt-4 mt-md-0">
            @for ($r = 5; $r >= 1; $r--)
                @php
                    $cnt = $counts->get($r, 0);
                    $pct = $total ? round(($cnt / $total) * 100) : 0;
                @endphp
                <div class="d-flex align-items-center mb-2 star-filter" data-star="{{ $r }}" style="cursor:pointer;">
                    <span class="me-2 text-primary fw-semibold">{{ $r }} <i class="bi bi-star-fill text-warning"></i></span>
                    <div class="progress flex-grow-1 me-2" style="height: 6px;">
                        <div class="progress-bar bg-warning" style="width: {{ $pct }}%"></div>
                    </div>
                    <small class="text-muted">{{ $cnt }}</small>
                </div>
            @endfor
        </div>
    </div>

    <div id="reviewsList">
        @forelse($reviews as $rev)
        <div class="review-card position-relative mb-4 p-4 rounded-4 border bg-white dark:bg-dark text-dark dark:text-light shadow-sm" data-rating="{{ $rev['rating'] }}">
            <div class="d-flex justify-content-between align-items-start mb-2">
                <div>
                    <div class="fw-semibold fs-6">{{ $rev['user'] }}</div>
                    <div class="mb-1">
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="bi bi-star{{ $i <= $rev['rating'] ? '-fill text-warning' : '' }}"></i>
                        @endfor
                    </div>
                </div>
                <small class="text-muted">{{ \Carbon\Carbon::parse($rev['date'])->translatedFormat('d M Y') }}</small>
            </div>
            <p class="mb-3 text-secondary">{{ $rev['comment'] }}</p>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-success like-btn rounded-pill d-flex align-items-center gap-1 px-3 py-1">
                    <i class="bi bi-hand-thumbs-up"></i>
                </button>
                <button class="btn btn-outline-danger dislike-btn rounded-pill d-flex align-items-center gap-1 px-3 py-1">
                    <i class="bi bi-hand-thumbs-down"></i>
                </button>
            </div>
        </div>
        @empty
        <div class="text-center py-5 text-muted">
            <i class="bi bi-chat-dots fs-1 mb-3 d-block"></i>
            No reviews yet. Be the first to review!
        </div>
        @endforelse
    </div>
</div>

{{-- Modal for desktop --}}
<div class="modal fade" id="desktopReviewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content dark:bg-dark bg-light text-dark dark:text-light rounded-4 shadow">
            <div class="modal-header border-0">
                <h5 class="modal-title">Customer Reviews</h5>
                <button type="button" class="btn-close dark:invert" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>

<style>
    .dark .bg-white {
        background-color: #2a2a2a !important;
        color: #f2f2f2 !important;
    }
    .dark .text-dark {
        color: #f2f2f2 !important;
    }
    .dark .btn-outline-secondary {
        color: #f2f2f2;
        border-color: #888;
    }
    .review-card {
        transition: all 0.3s ease;
        border: 1px solid #dee2e6 !important;
    }

    .review-card:hover {
        box-shadow: 0 0.5rem 1.25rem rgba(0, 0, 0, 0.08);
    }
</style>

<script>
    const reviews = document.querySelectorAll('.review-card');
    const resetBtn = document.getElementById('resetBtn');

    document.querySelectorAll('.star-filter').forEach(el => {
        el.addEventListener('click', () => {
            const rating = el.dataset.star;
            reviews.forEach(r => {
                r.style.display = r.dataset.rating == rating ? 'block' : 'none';
            });
            resetBtn.style.display = 'inline-block';
        });
    });

    function resetFilter() {
        reviews.forEach(r => r.style.display = 'block');
        resetBtn.style.display = 'none';
    }

    document.querySelectorAll('.like-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            btn.classList.toggle('active');
        });
    });

    document.querySelectorAll('.dislike-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            btn.classList.toggle('active');
        });
    });

    if (window.innerWidth > 768) {
        const reviewModal = new bootstrap.Modal(document.getElementById('desktopReviewModal'));
        const reviewTrigger = document.querySelector('#pm-rev');

        if (reviewTrigger) {
            reviewTrigger.addEventListener('click', e => {
                e.preventDefault();

                fetch('{{ route("reviews") }}')
                    .then(res => res.text())
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');
                        const reviewContent = doc.querySelector('.container');

                        const modalBody = document.querySelector('#desktopReviewModal .modal-body');
                        modalBody.innerHTML = '';
                        modalBody.appendChild(reviewContent);

                        reviewModal.show();
                    });
            });
        }
    }
</script>
@endsection