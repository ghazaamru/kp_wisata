@extends('layouts.admin')

@section('title', 'Tambah Event')
@section('page-title', 'Tambah Event Baru')

@section('content')
    <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="mb-3">
                    <label for="nama_event" class="form-label">Nama Event</label>
                    <input type="text" name="nama_event" id="nama_event" class="form-control" value="{{ old('nama_event') }}">
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi Event</label>
                    <textarea class="form-control" name="deskripsi" id="deskripsi" rows="8">{{ old('deskripsi') }}</textarea>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="lokasi" class="form-label">Lokasi</label>
                    <input type="text" name="lokasi" id="lokasi" class="form-control" value="{{ old('lokasi') }}">
                </div>
                <div class="mb-3">
                    <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" value="{{ old('tanggal_mulai') }}">
                </div>
                <div class="mb-3">
                    <label for="tanggal_selesai" class="form-label">Tanggal Selesai (Opsional)</label>
                    <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control" value="{{ old('tanggal_selesai') }}">
                </div>
                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar/Poster Event</label>
                    <input class="form-control" type="file" name="gambar" id="gambar">
                </div>
            </div>
        </div>
        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Simpan Event</button>
            <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
@endsection
