<!DOCTYPE html>
<html>
<head>
    <title>Tambah Wisata</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Tambah Data Wisata Baru</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Ada beberapa masalah dengan input Anda.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.wisata.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama_obyek_wisata" class="form-label">Nama Obyek Wisata</label>
            <input type="text" name="nama_obyek_wisata" id="nama_obyek_wisata" class="form-control" placeholder="Contoh: Pantai Kuta">
        </div>
        <div class="mb-3">
            <label for="lokasi" class="form-label">Lokasi</label>
            <input type="text" name="lokasi" id="lokasi" class="form-control" placeholder="Contoh: Bali, Indonesia">
        </div>
        <div class="mb-3">
            <label for="kategori_id" class="form-label">Kategori</label>
            <select class="form-select" name="kategori_id" id="kategori_id">
                @foreach ($kategori as $item)
                    <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control" style="height:150px" name="deskripsi" id="deskripsi" placeholder="Jelaskan tentang obyek wisata ini"></textarea>
        </div>
        
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.wisata.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>