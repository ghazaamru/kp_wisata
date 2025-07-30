@extends('layouts.admin')

@section('title', 'Edit Kategori')
@section('page-title', 'Edit Kategori')

@section('content')
        <form action="{{ route('admin.kategori.update', $kategori->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nama_kategori" class="form-label">Nama Kategori</label>
                <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" value="{{ old('nama_kategori', $kategori->nama_kategori) }}">
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" name="deskripsi" id="deskripsi">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
            </div>
            
            {{-- Tambahkan input file gambar --}}
            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar Kategori</label>
                @if($kategori->gambar)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $kategori->gambar) }}" alt="Gambar saat ini" style="max-height: 150px; border-radius: 5px;">
                    </div>
                @endif
                <input class="form-control" type="file" name="gambar" id="gambar">
                <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</small>
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Perbarui</button>
                <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
@endsection
    