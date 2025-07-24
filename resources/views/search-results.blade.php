<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pencarian - YokWisata</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f8f9fa; }
        
        /* PERUBAHAN CSS: Menambahkan style kartu baru */
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

        .filter-form {
            background-color: #fff;
            padding: 1.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
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

    <!-- Konten Hasil Pencarian -->
    <main class="container my-5">
        <div class="text-center mb-4">
            <h1 class="fw-bold">Pencarian Destinasi</h1>
        </div>

        <!-- FORM FILTER -->
        <form action="{{ route('search') }}" method="GET" class="filter-form mb-5">
            <div class="row g-3">
                <div class="col-md-7">
                    <label for="query" class="form-label">Cari Destinasi</label>
                    <input type="text" name="query" id="query" class="form-control" placeholder="Nama, lokasi, atau deskripsi..." value="{{ request('query') }}">
                </div>
                <div class="col-md-3">
                    <label for="kategori_id" class="form-label">Filter Kategori</label>
                    <select name="kategori_id" id="kategori_id" class="form-select">
                        <option value="">Semua Kategori</option>
                        @foreach($kategori as $item)
                            <option value="{{ $item->id }}" {{ request('kategori_id') == $item->id ? 'selected' : '' }}>
                                {{ $item->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-funnel-fill"></i> Terapkan
                    </button>
                </div>
            </div>
        </form>

        {{-- Menampilkan pesan hasil --}}
        @if(request('query') || request('kategori_id'))
            <p class="text-center text-muted mb-4">
                Menampilkan {{ $results->total() }} hasil
                @if(request('query'))
                    untuk <strong class="text-primary">"{{ request('query') }}"</strong>
                @endif
                @if(request('kategori_id'))
                    dalam kategori <strong class="text-primary">{{ $kategori->find(request('kategori_id'))->nama_kategori }}</strong>
                @endif
            </p>
        @endif

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 justify-content-center">
            @forelse($results as $destination)
            <div class="col">
                {{-- PERUBAHAN HTML: Menggunakan struktur kartu baru --}}
                <a href="{{ route('destinasi.show', $destination->id) }}" class="card h-100 shadow-sm destination-card-v2">
                    @if($destination->gambar)
                        <img src="{{ asset('storage/' . $destination->gambar) }}" class="card-img-top" alt="{{ $destination->nama_obyek_wisata }}">
                    @else
                        <img src="https://source.unsplash.com/400x300/?{{ $destination->lokasi }}" class="card-img-top" alt="{{ $destination->nama_obyek_wisata }}">
                    @endif
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title mb-1">{{ $destination->nama_obyek_wisata }}</h5>
                            <p class="card-text mb-0"><i class="bi bi-geo-alt"></i> {{ $destination->lokasi }}</p>
                        </div>
                        <i class="bi bi-chevron-right text-primary"></i>
                    </div>
                </a>
            </div>
            @empty
                <div class="col-lg-8">
                    <div class="text-center py-5 px-4 bg-white rounded shadow-sm">
                        <i class="bi bi-search-heart fs-1 text-muted mb-3"></i>
                        <h3 class="mt-3">Tidak Ditemukan</h3>
                        <p class="text-muted mb-0">Maaf, kami tidak dapat menemukan destinasi yang cocok. Coba ubah filter atau kata kunci Anda.</p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-5 d-flex justify-content-center">
            {{ $results->appends(request()->query())->links() }}
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center p-3 mt-5">
        © 2025 YokWisata
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
