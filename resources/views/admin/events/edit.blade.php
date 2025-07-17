@extends('layouts.admin')

@section('title', 'Edit Event')
@section('page-title', 'Edit Event')

@section('content')
    <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-8">
                <div class="mb-3">
                    <label for="nama_event" class="form-label">Nama Event</label>
                    <input type="text" name="nama_event" id="nama_event" class="form-control" value="{{ old('nama_event', $event->nama_event) }}">
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi Event</label>
                    <textarea class="form-control" name="deskripsi" id="deskripsi" rows="8">{{ old('deskripsi', $event->deskripsi) }}</textarea>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="lokasi" class="form-label">Lokasi</label>
                    <input type="text" name="lokasi" id="lokasi" class="form-control" value="{{ old('lokasi', $event->lokasi) }}">
                </div>
                <div class="mb-3">
                    <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" value="{{ old('tanggal_mulai', $event->tanggal_mulai->format('Y-m-d')) }}">
                </div>
                <div class="mb-3">
                    <label for="tanggal_selesai" class="form-label">Tanggal Selesai (Opsional)</label>
                    <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control" value="{{ old('tanggal_selesai', $event->tanggal_selesai ? $event->tanggal_selesai->format('Y-m-d') : '') }}">
                </div>
                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar/Poster Event</label>
                    @if($event->gambar)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $event->gambar) }}" alt="Gambar saat ini" style="max-height: 150px; border-radius: 5px;">
                        </div>
                    @endif
                    <input class="form-control" type="file" name="gambar" id="gambar">
                </div>
            </div>
        </div>
        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Perbarui Event</button>
            <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
@endsection
