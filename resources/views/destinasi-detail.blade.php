<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $wisata->nama_obyek_wisata }} - YokWisata</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .hero-detail {
            height: 50vh;
            background-size: cover;
            background-position: center;
            color: white;
            display: flex;
            align-items: flex-end;
            padding-bottom: 4rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.7);
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">
                <i class="bi bi-geo-alt-fill text-primary"></i> YokWisata
            </a>
            <a href="{{ route('home') }}" class="btn btn-outline-primary">Kembali ke Beranda</a>
        </div>
    </nav>

    <header class="hero-detail" style="background-image: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('https://source.unsplash.com/1600x900/?{{ $wisata->lokasi }}');">
        <div class="container">
            <h1 class="display-4 fw-bold">{{ $wisata->nama_obyek_wisata }}</h1>
            <p class="lead"><i class="bi bi-geo-alt-fill"></i> {{ $wisata->lokasi }}</p>
        </div>
    </header>

    <main class="container my-5">
        <div class="row">
            <div class="col-lg-8">
                <h3 class="mb-3">Deskripsi</h3>
                <p style="text-align: justify;">{{ $wisata->deskripsi }}</p>

                <h3 class="mt-5 mb-3">Sektor Pendukung</h3>
                <div class="list-group">
                    @forelse($wisata->sektorPendukung as $sektor)
                        <div class="list-group-item">
                            <h5 class="mb-1">{{ $sektor->nama_sektor }} ({{ ucwords(str_replace('_', ' ', $sektor->jenis)) }})</h5>
                            <p class="mb-1">{{ $sektor->alamat }}</p>
                            <small>Kontak: {{ $sektor->kontak ?? '-' }}</small>
                        </div>
                    @empty
                        <p class="text-muted">Belum ada data sektor pendukung untuk destinasi ini.</p>
                    @endforelse
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header fw-bold">
                        Informasi Tambahan
                    </div>
                    <ul class="list-group list-group-flush">
                        {{-- Menggunakan null-safe operator untuk keamanan data --}}
                        <li class="list-group-item">Kategori: {{ $wisata->kategori?->nama_kategori ?? 'Tidak ada kategori' }}</li>
                        <li class="list-group-item">Diposting oleh: {{ $wisata->user?->name ?? 'N/A' }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-dark text-white text-center p-3 mt-5">
        © 2025 YokWisata
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>