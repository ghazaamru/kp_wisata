@extends('layouts.admin')

{{-- Judul Halaman --}}
@section('title', 'Manajemen Kategori')
@section('page-title', 'Manajemen Data Kategori')

{{-- Tombol Aksi di Header --}}
@section('header-actions')
    <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Kategori Baru
    </a>
@endsection

{{-- Konten Utama Halaman --}}
@section('content')
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Deskripsi</th>
                    <th class="text-center" width="150px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($semuaKategori as $kategori)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $kategori->nama_kategori }}</td>
                    <td>{{ $kategori->deskripsi ?? '-' }}</td>
                    <td class="text-center">
                        <form action="{{ route('admin.kategori.destroy', $kategori->id) }}" method="POST" class="d-inline-flex gap-1">
                            <a class="btn btn-info btn-sm" href="{{ route('admin.kategori.edit', $kategori->id) }}" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus kategori ini?')" title="Hapus">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">Belum ada data kategori.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
