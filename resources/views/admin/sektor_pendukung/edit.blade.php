@extends('layouts.admin')

@section('title', 'Edit Sektor Pendukung')
@section('page-title')
    Edit Sektor untuk: <span class="text-primary">{{ $wisata->nama_obyek_wisata }}</span>
@endsection

@section('content')
    <form action="{{ route('admin.wisata.sektor-pendukung.update', [$wisata->id, $sektorPendukung->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="nama_sektor" class="form-label">Nama Sektor</label>
                <input type="text" name="nama_sektor" id="nama_sektor" class="form-control" value="{{ old('nama_sektor', $sektorPendukung->nama_sektor) }}">
            </div>
            <div class="col-md-6 mb-3">
                <label for="jenis" class="form-label">Jenis Sektor</label>
                <select name="jenis" id="jenis" class="form-select">
                    <option value="akomodasi" {{ $sektorPendukung->jenis == 'akomodasi' ? 'selected' : '' }}>Akomodasi (Hotel, Villa)</option>
                    <option value="restoran" {{ $sektorPendukung->jenis == 'restoran' ? 'selected' : '' }}>Restoran / Kuliner</option>
                    <option value="transportasi" {{ $sektorPendukung->jenis == 'transportasi' ? 'selected' : '' }}>Transportasi</option>
                    <option value="atraksi" {{ $sektorPendukung->jenis == 'atraksi' ? 'selected' : '' }}>Atraksi</option>
                    <option value="toko_suvenir" {{ $sektorPendukung->jenis == 'toko_suvenir' ? 'selected' : '' }}>Toko Suvenir</option>
                    <option value="fasilitas_umum" {{ $sektorPendukung->jenis == 'fasilitas_umum' ? 'selected' : '' }}>Fasilitas Umum (Toilet, Parkir)</option>
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" name="alamat" id="alamat" class="form-control" value="{{ old('alamat', $sektorPendukung->alamat) }}">
        </div>
        <div class="mb-3">
            <label for="kontak" class="form-label">Kontak (No. Telp / Email)</label>
            <input type="text" name="kontak" id="kontak" class="form-control" value="{{ old('kontak', $sektorPendukung->kontak) }}">
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi Singkat</label>
            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $sektorPendukung->deskripsi) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar</label>
            @if($sektorPendukung->gambar)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $sektorPendukung->gambar) }}" alt="Gambar saat ini" style="max-height: 100px; border-radius: 5px;">
                </div>
            @endif
            <input class="form-control" type="file" name="gambar" id="gambar">
        </div>
        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Perbarui</button>
            <a href="{{ route('admin.wisata.sektor-pendukung.index', $wisata->id) }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
@endsection
