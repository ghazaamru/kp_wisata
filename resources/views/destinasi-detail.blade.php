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
        body { 
            font-family: 'Poppins', sans-serif; 
            background-color: #f8f9fa; 
        }
        .hero-detail {
            height: 55vh;
            background-size: cover;
            background-position: center;
            color: white;
            display: flex;
            align-items: flex-end;
            padding-bottom: 4rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.7);
        }
        .info-card .list-group-item {
            background-color: transparent;
            border-color: rgba(0,0,0,0.08);
        }
        .gmap-container {
            border-radius: 0.5rem;
            overflow: hidden;
            line-height: 0; /* Menghilangkan spasi ekstra di bawah iframe */
        }
        .gmap-container iframe {
            border: 0;
            width: 100%;
            height: 400px;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">
                <i class="bi bi-geo-alt-fill text-primary"></i> YokWisata
            </a>
            <a href="{{ route('home') }}" class="btn btn-outline-primary">
                <i class="bi bi-arrow-left"></i> Kembali ke Beranda
            </a>
        </div>
    </nav>

    <!-- Hero Section untuk Detail -->
    <header class="hero-detail" style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.5)), url('{{ $wisata->gambar ? asset('storage/' . $wisata->gambar) : 'https://source.unsplash.com/1600x900/?' . $wisata->lokasi }}');">
        <div class="container">
            <span class="badge bg-primary mb-2">{{ $wisata->kategori?->nama_kategori ?? 'Umum' }}</span>
            <h1 class="display-4 fw-bold">{{ $wisata->nama_obyek_wisata }}</h1>
            <p class="lead"><i class="bi bi-geo-alt-fill"></i> {{ $wisata->lokasi }}</p>
        </div>
    </header>

    <!-- Konten Detail -->
    <main class="container my-5">
        <div class="row g-4 g-lg-5">
            <!-- Kolom Kiri: Deskripsi dan Peta -->
            <div class="col-lg-8">
                <article>
                    <h3 class="mb-3">Tentang Destinasi</h3>
                    <p class="text-muted" style="text-align: justify;">{{ $wisata->deskripsi }}</p>
                </article>

                @if($wisata->gmap_embed_link)
                <div class="mt-5">
                    <h3 class="mb-3">Peta Lokasi</h3>
                    <div class="gmap-container shadow-sm">
                        {!! $wisata->gmap_embed_link !!}
                    </div>
                </div>
                @endif
            </div>

            <!-- Kolom Kanan: Informasi Penting -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm info-card sticky-top" style="top: 100px;">
                    <div class="card-header fw-bold bg-light text-dark-emphasis">
                        <i class="bi bi-info-circle-fill me-2"></i>Informasi Penting
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>Harga Tiket</strong>
                            <span class="badge bg-success-subtle text-success-emphasis rounded-pill">
                                @if($wisata->harga_tiket > 0)
                                    Rp {{ number_format($wisata->harga_tiket, 0, ',', '.') }}
                                @else
                                    Gratis
                                @endif
                            </span>
                        </li>
                        @if($wisata->jam_operasional)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>Jam Buka</strong>
                            <span>{{ $wisata->jam_operasional }}</span>
                        </li>
                        @endif
                    </ul>
                    @if($wisata->link_hotel)
                    <div class="card-body text-center">
                        <a href="{{ $wisata->link_hotel }}" class="btn btn-success w-100" target="_blank">
                            <i class="bi bi-building"></i> Booking Hotel Terdekat
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center p-3 mt-5">
        © 2025 YokWisata
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
