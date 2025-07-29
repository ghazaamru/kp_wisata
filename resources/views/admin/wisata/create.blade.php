@extends('layouts.admin')

@section('title', 'Tambah Wisata')
@section('page-title', 'Tambah Data Wisata Baru')

@section('content')
    <form action="{{ route('admin.wisata.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            {{-- Kolom Kiri untuk Nama, Deskripsi, dan Peta --}}
            <div class="col-md-8">
                <div class="mb-3">
                    <label for="nama_obyek_wisata" class="form-label">Nama Obyek Wisata</label>
                    <input type="text" name="nama_obyek_wisata" id="nama_obyek_wisata" class="form-control" placeholder="Contoh: Pantai Kuta" value="{{ old('nama_obyek_wisata') }}">
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control wysiwyg-editor" style="height:250px" name="deskripsi" id="deskripsi"></textarea>
                </div>
                <div class="mb-3">
                    <label for="gmap_embed_link" class="form-label">Lokasi Google Maps (Embed Code)</label>
                    <textarea class="form-control" style="height:120px" name="gmap_embed_link" id="gmap_embed_link" placeholder="Tempelkan kode <iframe> dari Google Maps di sini">{{ old('gmap_embed_link') }}</textarea>
                    <small class="form-text text-muted">
                        Buka Google Maps > Cari Lokasi > Share > Embed a map > Copy HTML.
                    </small>
                </div>
            </div>

            {{-- Kolom Kanan untuk Detail Lainnya --}}
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="kategori_id" class="form-label">Kategori</label>
                    <select class="form-select" name="kategori_id" id="kategori_id">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($kategori as $item)
                            <option value="{{ $item->id }}" {{ old('kategori_id') == $item->id ? 'selected' : '' }}>{{ $item->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="lokasi" class="form-label">Lokasi / Rute</label>
                    <input type="text" name="lokasi" id="lokasi" class="form-control" placeholder="Contoh: Bali, Indonesia" value="{{ old('lokasi') }}">
                </div>
                <div class="mb-3">
                    <label for="harga_tiket" class="form-label">Harga Tiket (Rp)</label>
                    <input type="number" name="harga_tiket" id="harga_tiket" class="form-control" value="{{ old('harga_tiket', 0) }}" min="0">
                    <small class="form-text text-muted">Masukkan angka saja. Isi 0 jika gratis.</small>
                </div>
                 <div class="mb-3">
                    <label for="jam_operasional" class="form-label">Jam Operasional</label>
                    <input type="text" name="jam_operasional" id="jam_operasional" class="form-control" value="{{ old('jam_operasional') }}" placeholder="Contoh: 08:00 - 17:00">
                </div>
                <div class="mb-3">
                    <label for="link_hotel" class="form-label">Link Hotel/Booking</label>
                    <input type="url" name="link_hotel" id="link_hotel" class="form-control" value="{{ old('link_hotel') }}" placeholder="https://contoh-link.com">
                </div>
            </div>
        </div>

        <hr>

        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar Destinasi</label>
            <input class="form-control" type="file" name="gambar" id="gambar">
        </div>
        
        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.wisata.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
@endsection
