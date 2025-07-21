@extends('layouts.admin')

@section('title', 'Tambah Sektor Pendukung')
@section('page-title')
    Tambah Sektor untuk: <span class="text-primary">{{ $wisata->nama_obyek_wisata }}</span>
@endsection

@section('content')
    <form action="{{ route('admin.wisata.sektor-pendukung.store', $wisata->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="nama_sektor" class="form-label">Nama Sektor</label>
                <input type="text" name="nama_sektor" id="nama_sektor" class="form-control" value="{{ old('nama_sektor') }}" placeholder="Contoh: Hotel Bintang Lima">
            </div>
            <div class="col-md-6 mb-3">
                <label for="jenis" class="form-label">Jenis Sektor</label>
                <select name="jenis" id="jenis" class="form-select">
                    <option value="akomodasi">Akomodasi (Hotel, Villa)</option>
                    <option value="restoran">Restoran / Kuliner</option>
                    <option value="transportasi">Transportasi</option>
                    <option value="atraksi">Atraksi</option>
                    <option value="toko_suvenir">Toko Suvenir</option>
                    <option value="fasilitas_umum">Fasilitas Umum (Toilet, Parkir)</option>
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" name="alamat" id="alamat" class="form-control" value="{{ old('alamat') }}">
        </div>
        <div class="mb-3">
            <label for="kontak" class="form-label">Kontak (No. Telp / Email)</label>
            <input type="text" name="kontak" id="kontak" class="form-control" value="{{ old('kontak') }}">
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi Singkat</label>
            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3">{{ old('deskripsi') }}</textarea>
        </div>
        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar</label>
            <input class="form-control" type="file" name="gambar" id="gambar">
        </div>
        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.wisata.sektor-pendukung.index', $wisata->id) }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
@endsection
