@extends('layouts.app')

@section('title', 'Dashboard - Pemesanan Tiket')

@section('content')
<div class="container">
    <!-- Banner Hero / Filter -->
    <div class="p-5 mb-4 bg-primary text-white rounded-4 shadow-sm position-relative overflow-hidden">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="display-5 fw-bold">Temukan Event & Tiket Spesial Anda!</h1>
                <p class="col-md-10 fs-5 mt-2">Pesan tiket konser, seminar, bioskop, dan atraksi favorit secara cepat, aman, dan tanpa antre.</p>
            </div>
        </div>
    </div>

    <!-- Search & Filter Bar -->
    <div class="card shadow-sm border-0 mb-4 rounded-3">
        <div class="card-body p-3">
            <form class="row g-3">
                <div class="col-md-5">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-0"><i class="bi bi-search"></i></span>
                        <input type="text" class="form-control border-0 bg-light" placeholder="Cari nama event, konser, atau lokasi...">
                    </div>
                </div>
                <div class="col-md-3">
                    <select class="form-select border-0 bg-light">
                        <option selected>Semua Kategori</option>
                        <option value="1">Konser Musik</option>
                        <option value="2">Seminar & Workshop</option>
                        <option value="3">Olahraga</option>
                        <option value="4">Pameran</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="date" class="form-control border-0 bg-light">
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-primary w-100">Cari Tiket</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Event Grid -->
    <h4 class="fw-bold mb-3"><i class="bi bi-fire text-danger me-2"></i>Event Populer Minggu Ini</h4>
    
    <div class="row g-4">
        @forelse($events as $event)
            <div class="col-md-4">
                <div class="card card-event shadow-sm h-100">
                    <img src="{{ $event->image }}" class="card-img-top rounded-top-4" style="height: 200px; object-fit: cover;" alt="{{ $event->title }}">
                    <div class="card-body d-flex flex-column">
                        <span class="badge bg-danger mb-2 w-auto align-self-start">{{ $event->category }}</span>
                        <h5 class="card-title fw-bold">{{ $event->title }}</h5>
                        <p class="text-muted small mb-2"><i class="bi bi-calendar3 me-1"></i> {{ \Carbon\Carbon::parse($event->event_date)->format('d F Y') }}</p>
                        <p class="text-muted small mb-3"><i class="bi bi-geo-alt me-1"></i> {{ $event->location }}</p>
                        <div class="mt-auto d-flex justify-content-between align-items-center">
                            <div>
                                <small class="text-muted d-block">Mulai dari</small>
                                <span class="fw-bold text-primary fs-5">
                                    Rp {{ number_format($event->tickets->min('price'), 0, ',', '.') }}
                                </span>
                            </div>
                            <a href="{{ route('event.show', $event->id) }}" class="btn btn-outline-primary rounded-3">Beli Tiket</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted">Belum ada event tersedia saat ini.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection