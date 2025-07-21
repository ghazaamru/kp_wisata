@extends('layouts.admin')

@section('title', 'Kelola Galeri')
@section('page-title')
        Kelola Galeri untuk: <span class="text-primary">{{ $wisata->nama_obyek_wisata }}</span>
@endsection

@section('header-actions')
        <a href="{{ route('admin.wisata.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali ke Manajemen Wisata
        </a>
@endsection

@section('content')
        {{-- Form untuk Upload Gambar --}}
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Upload Gambar Baru</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.galeri.store', $wisata->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Pilih satu atau beberapa gambar</label>
                        <input class="form-control" type="file" name="gambar[]" id="gambar" multiple required>
                        <small class="form-text text-muted">Anda bisa memilih lebih dari satu file. Ukuran maks 2MB per file.</small>
                    </div>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>
            </div>
        </div>

        {{-- Daftar Gambar yang Sudah Ada --}}
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Galeri Saat Ini</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    @forelse($wisata->galeri as $gambar)
                        <div class="col-md-3">
                            <div class="position-relative">
                                <img src="{{ asset('storage/' . $gambar->path_gambar) }}" class="img-fluid rounded" alt="Gambar Galeri">
                                <form action="{{ route('admin.galeri.destroy', $gambar->id) }}" method="POST" class="position-absolute top-0 end-0 m-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm rounded-circle" onclick="return confirm('Yakin ingin menghapus gambar ini?')">
                                        <i class="bi bi-x"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <p class="text-muted text-center">Belum ada gambar di galeri.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
@endsection
    