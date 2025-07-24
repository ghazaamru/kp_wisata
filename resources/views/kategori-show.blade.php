<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destinasi Kategori: {{ $kategori->nama_kategori }} - YokWisata</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* PERUBAHAN UNTUK STICKY FOOTER */
        html, body {
            height: 100%;
        }
        body { 
            font-family: 'Poppins', sans-serif; 
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
        }
        main {
            flex: 1 0 auto; /* Membuat konten utama mengisi ruang yang tersedia */
        }
        footer {
            flex-shrink: 0; /* Mencegah footer menyusut */
        }
        /* AKHIR PERUBAHAN */

        .card {
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
            border-radius: 1rem;
            border: none;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }
        .destination-card-v2 {
            background-color: #fff;
            display: block;
            text-decoration: none;
            color: inherit;
        }
        .destination-card-v2 .card-img-top {
            height: 180px;
            object-fit: cover;
            border-radius: 1rem 1rem 0 0;
        }
        .destination-card-v2 .card-body {
            padding: 1rem 1.25rem;
        }
        .destination-card-v2 .card-title {
            font-weight: 600;
            font-size: 1.1rem;
        }
        .destination-card-v2 .card-text {
            color: #6c757d;
            font-size: 0.9rem;
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

    <!-- Konten Halaman Kategori -->
    <main class="container my-5">
        <div class="text-center mb-5">
            <h1 class="fw-bold">Kategori: {{ $kategori->nama_kategori }}</h1>
            <p class="lead text-muted">{{ $kategori->deskripsi }}</p>
        </div>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @forelse($destinasi as $item)
            <div class="col">
                <a href="{{ route('destinasi.show', $item->id) }}" class="card h-100 shadow-sm destination-card-v2">
                    @if($item->gambar)
                        <img src="{{ asset('storage/' . $item->gambar) }}" class="card-img-top" alt="{{ $item->nama_obyek_wisata }}">
                    @else
                        <img src="https://source.unsplash.com/400x300/?{{ $item->lokasi }}" class="card-img-top" alt="{{ $item->nama_obyek_wisata }}">
                    @endif
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title mb-1">{{ $item->nama_obyek_wisata }}</h5>
                            <p class="card-text mb-0"><i class="bi bi-geo-alt"></i> {{ $item->lokasi }}</p>
                        </div>
                        <i class="bi bi-chevron-right text-primary"></i>
                    </div>
                </a>
            </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="bi bi-emoji-frown fs-1 text-muted"></i>
                        <h3 class="mt-3">Belum Ada Destinasi</h3>
                        <p class="text-muted">Maaf, belum ada destinasi wisata yang ditambahkan untuk kategori ini.</p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-5 d-flex justify-content-center">
            {{ $destinasi->links() }}
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center p-3 mt-auto">
        © 2025 YokWisata
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
