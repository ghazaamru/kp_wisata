@extends('layouts.admin')

@section('title', 'Sektor Pendukung')
@section('page-title')
    Sektor Pendukung untuk: <span class="text-primary">{{ $wisata->nama_obyek_wisata }}</span>
@endsection

@section('header-actions')
    {{-- PERBAIKAN DI SINI: Tambahkan $wisata->id sebagai parameter --}}
    <a href="{{ route('admin.wisata.sektor-pendukung.create', $wisata->id) }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Sektor
    </a>
@endsection

@section('content')
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>Nama Sektor</th>
                    <th>Jenis</th>
                    <th>Alamat</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($sektors as $sektor)
                <tr>
                    <td>
                        <img src="{{ $sektor->gambar ? asset('storage/' . $sektor->gambar) : 'https://placehold.co/60x40?text=N/A' }}" alt="Gambar" class="me-2 rounded" style="width: 60px; height: 40px; object-fit: cover;">
                        {{ $sektor->nama_sektor }}
                    </td>
                    <td>{{ ucwords(str_replace('_', ' ', $sektor->jenis)) }}</td>
                    <td>{{ $sektor->alamat }}</td>
                    <td class="text-center">
                        <form action="{{ route('admin.wisata.sektor-pendukung.destroy', [$wisata->id, $sektor->id]) }}" method="POST" class="d-inline-flex gap-1">
                            <a class="btn btn-info btn-sm" href="{{ route('admin.wisata.sektor-pendukung.edit', [$wisata->id, $sektor->id]) }}" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin?')" title="Hapus">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">Belum ada data sektor pendukung.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
