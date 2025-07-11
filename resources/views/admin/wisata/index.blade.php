<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Wisata</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Manajemen Data Wisata</h2>
        @if(auth()->user()->role == 'superadmin')
    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Kembali ke Dashboard</a>
@else
    <a href="{{ route('contributor.dashboard') }}" class="btn btn-secondary">Kembali ke Dashboard</a>
@endif
    </div>
    
    <a href="{{ route('admin.wisata.create') }}" class="btn btn-primary mb-3">Tambah Wisata Baru</a>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">{{ $message }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Obyek Wisata</th>
                <th>Lokasi</th>
                @if(auth()->user()->role == 'superadmin')
                    <th>Diposting oleh</th>
                @endif
                <th width="200px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($semuaWisata as $data)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->nama_obyek_wisata }}</td>
                <td>{{ $data->lokasi }}</td>
                @if(auth()->user()->role == 'superadmin')
                    {{-- Kode ini aman jika relasi user tidak ada, akan menampilkan 'N/A' --}}
                    <td>{{ $data->user->name ?? 'N/A' }}</td>
                @endif
                <td>
                    <form action="{{ route('admin.wisata.destroy', $data->id) }}" method="POST">
                        <a class="btn btn-info btn-sm" href="{{ route('admin.wisata.edit', $data->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus data ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Belum ada data wisata.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
</body>
</html>