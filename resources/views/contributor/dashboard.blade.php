@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
    <div class="row g-4">
        <div class="col-md-6 col-lg-4">
            <div class="stat-card bg-card-1">
                <i class="bi bi-geo-alt-fill stat-icon"></i>
                <h5>Total Destinasi Saya</h5>
                <p class="display-4">{{ $stats['wisata'] ?? 0 }}</p>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="stat-card bg-card-2">
                <i class="bi bi-tags-fill stat-icon"></i>
                <h5>Total Kategori</h5>
                <p class="display-4">{{ $stats['kategori'] ?? 0 }}</p>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="stat-card bg-card-3 text-dark">
                <i class="bi bi-calendar-event-fill stat-icon"></i>
                <h5>Total Event Saya</h5>
                <p class="display-4">{{ $stats['events'] ?? 0 }}</p>
            </div>
        </div>
    </div>

    <div class="mt-5 p-4 bg-light rounded">
        <h4>Selamat Datang, {{ auth()->user()->name }}!</h4>
        <p class="mb-0">Gunakan menu navigasi di samping untuk mulai mengelola konten yang telah Anda buat.</p>
    </div>
@endsection
