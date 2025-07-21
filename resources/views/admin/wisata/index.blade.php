@extends('layouts.admin')

{{-- Judul Halaman --}}
@section('title', 'Manajemen Wisata')
@section('page-title', 'Manajemen Data Wisata')

{{-- Tombol Aksi di Header --}}
@section('header-actions')
    <a href="{{ route('admin.wisata.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Wisata Baru
    </a>
@endsection

{{-- Konten Utama Halaman --}}
@section('content')
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Obyek Wisata</th>
                    <th>Lokasi</th>
                    @if(auth()->user()->role == 'superadmin')
                        <th>Diposting oleh</th>
                    @endif
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($semuaWisata as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <img src="{{ $data->gambar ? asset('storage/' . $data->gambar) : 'https://placehold.co/60x40?text=N/A' }}" alt="Gambar" class="me-2 rounded" style="width: 60px; height: 40px; object-fit: cover;">
                        {{ $data->nama_obyek_wisata }}
                    </td>
                    <td>{{ $data->lokasi }}</td>
                    @if(auth()->user()->role == 'superadmin')
                        <td>{{ $data->user->name ?? 'N/A' }}</td>
                    @endif
                    <td class="text-center">
                        <form action="{{ route('admin.wisata.destroy', $data->id) }}" method="POST" class="d-inline-flex gap-1">
                            <a class="btn btn-success btn-sm" href="{{ route('admin.wisata.sektor-pendukung.index', $data->id) }}" title="Kelola Sektor Pendukung">
                                <i class="bi bi-building"></i>
                            </a>
                             <a class="btn btn-warning btn-sm" href="{{ route('admin.galeri.index', $data->id) }}" title="Kelola Galeri">
                                <i class="bi bi-images"></i>
                            </a> 
                            <a class="btn btn-info btn-sm" href="{{ route('admin.wisata.edit', $data->id) }}" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus data ini?')" title="Hapus">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="{{ auth()->user()->role == 'superadmin' ? '5' : '4' }}" class="text-center">Belum ada data wisata.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
