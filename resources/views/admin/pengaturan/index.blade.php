@extends('layouts.admin')

@section('title', 'Manajemen Pengaturan')
@section('page-title', 'Pengaturan Website')

@section('content')
    <form action="{{ route('admin.pengaturan.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <p class="text-muted">Ubah informasi umum yang tampil di halaman depan website Anda.</p>
        <hr>

        {{-- Helper function untuk mengambil nilai dari koleksi pengaturan --}}
        @php
            function get_setting($key, $pengaturan, $default = '') {
                return $pengaturan[$key]->value ?? $default;
            }
        @endphp

        <div class="row">
            <div class="col-md-6">
                <h5 class="mb-3">Pengaturan Umum</h5>
                <div class="mb-3">
                    <label for="site_title" class="form-label">Judul Website</label>
                    <input type="text" class="form-control" id="site_title" name="site_title" value="{{ get_setting('site_title', $pengaturan) }}">
                </div>
            </div>
            <div class="col-md-6">
                <h5 class="mb-3">Pengaturan Kontak (Footer)</h5>
                 <div class="mb-3">
                    <label for="contact_address" class="form-label">Alamat</label>
                    <input type="text" class="form-control" id="contact_address" name="contact_address" value="{{ get_setting('contact_address', $pengaturan) }}">
                </div>
                 <div class="mb-3">
                    <label for="contact_email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="contact_email" name="contact_email" value="{{ get_setting('contact_email', $pengaturan) }}">
                </div>
                 <div class="mb-3">
                    <label for="contact_phone" class="form-label">Telepon</label>
                    <input type="text" class="form-control" id="contact_phone" name="contact_phone" value="{{ get_setting('contact_phone', $pengaturan) }}">
                </div>
            </div>
        </div>

        <hr class="my-4">

        <h5 class="mb-3">Pengaturan Halaman Utama (Hero Section)</h5>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="hero_title" class="form-label">Judul Hero</label>
                    <input type="text" class="form-control" id="hero_title" name="hero_title" value="{{ get_setting('hero_title', $pengaturan) }}">
                </div>
                <div class="mb-3">
                    <label for="hero_subtitle" class="form-label">Subjudul Hero</label>
                    <textarea class="form-control" name="hero_subtitle" id="hero_subtitle" rows="3">{{ get_setting('hero_subtitle', $pengaturan) }}</textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="hero_image" class="form-label">Gambar Hero</label>
                    @if(get_setting('hero_image', $pengaturan))
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . get_setting('hero_image', $pengaturan)) }}" alt="Gambar Hero" class="img-thumbnail" style="max-height: 150px;">
                        </div>
                    @endif
                    <input class="form-control" type="file" name="hero_image" id="hero_image">
                    <small class="form-text text-muted">Pilih gambar baru untuk mengganti yang lama.</small>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
        </div>
    </form>
@endsection
