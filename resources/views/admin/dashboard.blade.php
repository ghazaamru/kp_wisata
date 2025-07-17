@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
    <div class="row g-4">
        <div class="col-md-6 col-lg-3">
            <div class="stat-card bg-card-1">
                <i class="bi bi-geo-alt-fill stat-icon"></i>
                <h5>Total Destinasi</h5>
                <p class="display-4">{{ $stats['wisata'] ?? 0 }}</p>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="stat-card bg-card-2">
                <i class="bi bi-tags-fill stat-icon"></i>
                <h5>Total Kategori</h5>
                <p class="display-4">{{ $stats['kategori'] ?? 0 }}</p>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="stat-card bg-card-3 text-dark">
                <i class="bi bi-calendar-event-fill stat-icon"></i>
                <h5>Total Event</h5>
                <p class="display-4">{{ $stats['events'] ?? 0 }}</p>
            </div>
        </div>
        @if(auth()->user()->role == 'superadmin')
        <div class="col-md-6 col-lg-3">
            <div class="stat-card bg-card-4">
                <i class="bi bi-people-fill stat-icon"></i>
                <h5>Total Pengguna</h5>
                <p class="display-4">{{ $stats['users'] ?? 0 }}</p>
            </div>
        </div>
        @endif
    </div>

    <div class="mt-5 p-4 bg-light rounded">
        <h4>Selamat Datang, {{ auth()->user()->name }}!</h4>
        <p class="mb-0">Gunakan menu navigasi di samping untuk mulai mengelola konten website Anda.</p>
    </div>
@endsection
