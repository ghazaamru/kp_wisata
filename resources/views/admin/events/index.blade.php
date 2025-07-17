@extends('layouts.admin')

@section('title', 'Manajemen Event')
@section('page-title', 'Manajemen Data Event')

@section('header-actions')
    <a href="{{ route('admin.events.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Event Baru
    </a>
@endsection

@section('content')
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Event</th>
                    <th>Lokasi</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    @if(auth()->user()->role == 'superadmin')
                        <th>Diposting oleh</th>
                    @endif
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($events as $event)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <img src="{{ $event->gambar ? asset('storage/' . $event->gambar) : 'https://placehold.co/60x40?text=N/A' }}" alt="Gambar" class="me-2 rounded" style="width: 60px; height: 40px; object-fit: cover;">
                        {{ $event->nama_event }}
                    </td>
                    <td>{{ $event->lokasi }}</td>
                    <td>{{ $event->tanggal_mulai->format('d M Y') }}</td>
                    <td>{{ $event->tanggal_selesai ? $event->tanggal_selesai->format('d M Y') : '-' }}</td>
                    @if(auth()->user()->role == 'superadmin')
                        <td>{{ $event->user->name ?? 'N/A' }}</td>
                    @endif
                    <td class="text-center">
                        <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" class="d-inline-flex gap-1">
                            <a class="btn btn-info btn-sm" href="{{ route('admin.events.edit', $event->id) }}" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus event ini?')" title="Hapus">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="{{ auth()->user()->role == 'superadmin' ? '7' : '6' }}" class="text-center">Belum ada data event.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
