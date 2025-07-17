@extends('layouts.admin')

@section('title', 'Edit Wisata')
@section('page-title', 'Edit Data Wisata')

@section('content')
    <form action="{{ route('admin.wisata.update', $wisata->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-8">
                {{-- ... (Nama, Deskripsi) ... --}}
                <div class="mb-3">
                    <label for="nama_obyek_wisata" class="form-label">Nama Obyek Wisata</label>
                    <input type="text" name="nama_obyek_wisata" class="form-control" value="{{ old('nama_obyek_wisata', $wisata->nama_obyek_wisata) }}">
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control" style="height:150px" name="deskripsi">{{ old('deskripsi', $wisata->deskripsi) }}</textarea>
                </div>
                
                {{-- TAMBAHKAN BLOK INI --}}
                <div class="mb-3">
                    <label for="gmap_embed_link" class="form-label">Lokasi Google Maps (Embed Code)</label>
                    <textarea class="form-control" style="height:120px" name="gmap_embed_link" id="gmap_embed_link" placeholder="Tempelkan kode <iframe> dari Google Maps di sini">{{ old('gmap_embed_link', $wisata->gmap_embed_link) }}</textarea>
                    <small class="form-text text-muted">
                        Buka Google Maps > Cari Lokasi > Share > Embed a map > Copy HTML.
                    </small>
                </div>
                {{-- AKHIR BLOK TAMBAHAN --}}
            </div>
            <div class="col-md-4">
                {{-- ... (Kategori, Lokasi, Harga, Jam, Link Hotel) ... --}}
                <div class="mb-3">
                    <label for="kategori_id" class="form-label">Kategori</label>
                    <select class="form-select" name="kategori_id" id="kategori_id">
                        @foreach ($kategori as $item)
                            <option value="{{ $item->id }}" {{ old('kategori_id', $wisata->kategori_id) == $item->id ? 'selected' : '' }}>
                                {{ $item->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="lokasi" class="form-label">Lokasi / Rute</label>
                    <input type="text" name="lokasi" class="form-control" value="{{ old('lokasi', $wisata->lokasi) }}">
                </div>
                <div class="mb-3">
                    <label for="harga_tiket" class="form-label">Harga Tiket (Rp)</label>
                    <input type="number" name="harga_tiket" class="form-control" value="{{ old('harga_tiket', $wisata->harga_tiket) }}">
                </div>
                 <div class="mb-3">
                    <label for="jam_operasional" class="form-label">Jam Operasional</label>
                    <input type="text" name="jam_operasional" class="form-control" value="{{ old('jam_operasional', $wisata->jam_operasional) }}">
                </div>
                <div class="mb-3">
                    <label for="link_hotel" class="form-label">Link Hotel/Booking</label>
                    <input type="url" name="link_hotel" class="form-control" value="{{ old('link_hotel', $wisata->link_hotel) }}">
                </div>
            </div>
        </div>

        <hr>

        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar Destinasi</label>
            @if($wisata->gambar)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $wisata->gambar) }}" alt="Gambar saat ini" style="max-height: 150px; border-radius: 5px;">
                </div>
            @endif
            <input class="form-control" type="file" name="gambar" id="gambar">
        </div>
        
        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Perbarui</button>
            <a href="{{ route('admin.wisata.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
@endsection
