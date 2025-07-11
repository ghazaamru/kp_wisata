<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Manajemen Data Kategori</h2>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Kembali ke Dashboard</a>
    </div>

    <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary mb-3">Tambah Kategori Baru</a>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">{{ $message }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Deskripsi</th>
                <th width="200px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($semuaKategori as $kategori)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $kategori->nama_kategori }}</td>
                <td>{{ $kategori->deskripsi }}</td>
                <td>
                    <form action="{{ route('admin.kategori.destroy', $kategori->id) }}" method="POST">
                        <a class="btn btn-info btn-sm" href="{{ route('admin.kategori.edit', $kategori->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin?')">Hapus</button>
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
</body>
</html>