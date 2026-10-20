@extends('layouts.app')

@section('title', 'Pesanan Berhasil - TiketKu')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-4 p-4 text-center">
                <div class="mb-3">
                    <i class="bi bi-check-circle-fill text-success display-1"></i>
                </div>
                <h3 class="fw-bold text-success">Pemesanan Berhasil!</h3>
                <p class="text-muted">Terima kasih, pesanan tiket Anda telah dicatat.</p>

                <div class="card bg-light border-0 text-start p-3 my-3 rounded-3">
                    <p class="mb-1 text-muted small">ID Pesanan: <strong>#{{ $order->id }}</strong></p>
                    <p class="mb-1 text-muted small">Nama Pemesan: <strong>{{ $order->user->name }}</strong></p>
                    <p class="mb-0 text-muted small">Total Pembayaran: <strong class="text-primary fs-5">Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong></p>
                </div>

                <div class="d-flex gap-2 justify-content-center">
                    <a href="{{ route('dashboard') }}" class="btn btn-primary px-4 rounded-3">Kembali ke Beranda</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection