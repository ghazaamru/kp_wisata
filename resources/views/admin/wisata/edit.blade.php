<!DOCTYPE html>
<html>
<head>
    <title>Edit Wisata</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Edit Data Wisata</h2>

    <form action="{{ route('admin.wisata.update', $wisata->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nama Obyek Wisata</label>
            <input type="text" name="nama_obyek_wisata" class="form-control" value="{{ $wisata->nama_obyek_wisata }}">
        </div>

        <div class="mb-3">
            <label for="kategori_id" class="form-label">Kategori</label>
            <select class="form-select" name="kategori_id" id="kategori_id">
                @foreach ($kategori as $item)
                    <option value="{{ $item->id }}" {{ $wisata->kategori_id == $item->id ? 'selected' : '' }}>
                        {{ $item->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Lokasi</label>
            <input type="text" name="lokasi" class="form-control" value="{{ $wisata->lokasi }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea class="form-control" style="height:150px" name="deskripsi">{{ $wisata->deskripsi }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Perbarui</button>
        <a href="{{ route('admin.wisata.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>