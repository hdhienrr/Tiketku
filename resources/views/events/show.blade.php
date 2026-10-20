@extends('layouts.app')

@section('title', $event->title . ' - TiketKu')

@section('content')
<div class="container my-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Event</li>
        </ol>
    </nav>

    <!-- Notifikasi Error jika ada -->
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">
        <!-- Kolom Kiri: Gambar & Deskripsi Event -->
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 rounded-4 overflow-hidden mb-4">
                <img src="{{ $event->image }}" class="w-100" style="max-height: 400px; object-fit: cover;" alt="{{ $event->title }}">
                <div class="card-body p-4">
                    <span class="badge bg-danger mb-2">{{ $event->category }}</span>
                    <h2 class="fw-bold mb-3">{{ $event->title }}</h2>
                    
                    <div class="d-flex flex-wrap gap-4 text-muted mb-4 pb-3 border-bottom">
                        <div>
                            <i class="bi bi-calendar3 text-primary me-2"></i>
                            <strong>{{ \Carbon\Carbon::parse($event->event_date)->format('d F Y, H:i') }} WIB</strong>
                        </div>
                        <div>
                            <i class="bi bi-geo-alt text-primary me-2"></i>
                            <strong>{{ $event->location }}</strong>
                        </div>
                    </div>

                    <h5 class="fw-bold mb-3">Tentang Event</h5>
                    <p class="text-secondary lh-lg">{{ $event->description }}</p>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Pilihan Tiket & Form Pemesanan -->
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 rounded-4 sticky-top" style="top: 90px;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">Pilih Kategori Tiket</h5>

                    <form action="{{ route('orders.store') }}" method="POST">
                        @csrf
                        <div class="d-flex flex-column gap-3 mb-4">
                            @foreach($event->tickets as $ticket)
                                <div class="card border p-3 rounded-3">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h6 class="fw-bold mb-0">{{ $ticket->name }}</h6>
                                        <span class="text-primary fw-bold">Rp {{ number_format($ticket->price, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center text-muted small">
                                        <span>Stok: {{ $ticket->stock }} tersedia</span>
                                        <div class="input-group input-group-sm w-50">
                                            <input type="number" name="tickets[{{ $ticket->id }}]" class="form-control text-center" value="0" min="0" max="{{ $ticket->stock }}">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2 fw-bold rounded-3">
                            <i class="bi bi-cart-plus me-2"></i>Pesan Sekarang
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection