@extends('Customer.layouts.app')
@section('title', 'Search Result')

@section('content')
<div class="container py-4">
    <h5 class="mb-4">Hasil pencarian: <strong>{{ $q }}</strong></h5>
    @if($products->count())
        <div class="row">
            @foreach ($products as $p)
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h6 class="card-title">{{ $p->name }}</h6>
                            <p class="small text-muted">{{ $p->description ?? 'Tidak ada deskripsi' }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-muted">Tidak ditemukan hasil.</p>
    @endif
</div>
@endsection
