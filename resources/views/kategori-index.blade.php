<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Kategori Destinasi - {{ $pengaturan['site_title']->value ?? 'YokWisata' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
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
            flex: 1 0 auto;
        }
        footer {
            flex-shrink: 0;
        }
        .category-card-v2 {
            border: none;
            border-radius: 1rem;
            overflow: hidden;
            position: relative;
            display: block;
            text-decoration: none;
            height: 250px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .category-card-v2:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        .category-card-v2 img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s;
        }
        .category-card-v2:hover img {
            transform: scale(1.05);
        }
        .category-card-v2 .card-img-overlay {
            background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0) 60%);
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 1.5rem;
        }
        .category-card-v2 .card-title {
            font-weight: 600;
            font-size: 1.5rem;
            color: #fff;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.5);
        }
        .category-card-v2 .card-text {
            color: rgba(255,255,255,0.9);
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">
                <i class="bi bi-geo-alt-fill text-primary"></i> {{ $pengaturan['site_title']->value ?? 'YokWisata' }}
            </a>
            <a href="{{ route('home') }}" class="btn btn-outline-primary">
                <i class="bi bi-arrow-left"></i> Kembali ke Beranda
            </a>
        </div>
    </nav>

    <!-- Konten Halaman Kategori -->
    <main class="container my-5">
        <div class="text-center mb-5">
            <h1 class="fw-bold">Pilih Kategori Destinasi</h1>
            <p class="lead text-muted">Jelajahi berbagai jenis wisata yang ditawarkan di Gunung Kidul.</p>
        </div>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @forelse($semuaKategori as $kategori)
            <div class="col">
                <a href="{{ route('kategori.show', $kategori->id) }}" class="category-card-v2">
                    {{-- PERUBAHAN DI SINI: Menampilkan gambar dari database --}}
                    @if($kategori->gambar)
                        <img src="{{ asset('storage/' . $kategori->gambar) }}" class="card-img" alt="{{ $kategori->nama_kategori }}">
                    @else
                        {{-- Fallback jika tidak ada gambar --}}
                        <img src="https://source.unsplash.com/500x500/?{{ $kategori->nama_kategori }}" class="card-img" alt="{{ $kategori->nama_kategori }}">
                    @endif
                    <div class="card-img-overlay">
                        <h5 class="card-title">{{ $kategori->nama_kategori }}</h5>
                        <p class="card-text">{{ \Illuminate\Support\Str::limit($kategori->deskripsi, 50) }}</p>
                    </div>
                </a>
            </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <p class="text-muted">Belum ada kategori yang ditambahkan.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center p-3 mt-auto">
        © {{ date('Y') }} {{ $pengaturan['site_title']->value ?? 'YokWisata' }}
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
