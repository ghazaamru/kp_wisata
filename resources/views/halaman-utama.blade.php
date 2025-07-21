<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pengaturan['site_title'] ?? 'Sistem Informasi Pariwisata' }}</title>

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Style Kustom -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        .hero-section {
            background: url("{{ isset($pengaturan['hero_image']) ? asset('storage/' . $pengaturan['hero_image']) : asset('images/gunung.jpg') }}") no-repeat center center;
            background-size: cover;
            height: 60vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6);
        }
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
        .section-title {
            font-weight: 700;
            margin-bottom: 30px;
            text-align: center;
        }
        .category-icon {
            font-size: 3rem;
            color: #0d6efd;
        }
        .card {
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.15);
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">
                <i class="bi bi-geo-alt-fill text-primary"></i> {{ $pengaturan['site_title'] ?? 'YokWisata' }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#destinasi">Destinasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#event">Event</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary ms-lg-3" href="{{ route('login') }}">
                           <i class="bi bi-box-arrow-in-right"></i> Login
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero-section text-center">
        <div class="container">
            <h1 class="display-4 fw-bold">{{ $pengaturan['hero_title'] ?? 'Jelajahi Keindahan Nusantara' }}</h1>
            <p class="lead my-3">{{ $pengaturan['hero_subtitle'] ?? 'Temukan destinasi wisata, event menarik, dan layanan pendukung terbaik di seluruh Indonesia.' }}</p>
        </div>
    </header>

    <main class="container my-5">

        <!-- Kategori Wisata Section -->
        <section id="kategori" class="mb-5 py-5">
            <h2 class="section-title">Kategori Wisata</h2>
            <div class="row text-center g-4">
                @forelse($categories as $category)
                    <div class="col-6 col-md-3">
                        <div class="card p-3 border-0 shadow-sm h-100 justify-content-center">
                            <i class="bi bi-tag category-icon"></i>
                            <h5 class="mt-3">{{ $category->nama_kategori }}</h5>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-muted">Kategori belum tersedia.</p>
                @endforelse
            </div>
        </section>

        <!-- Destinasi Populer Section -->
        <section id="destinasi" class="mb-5 py-5 bg-light rounded p-4">
            <h2 class="section-title">Destinasi Populer</h2>
            
            <!-- Wrapper untuk konten yang akan di-refresh -->
            <div id="destinasi-list">
                {{-- Memuat konten awal dari partial view --}}
                @include('partials.destinasi-paginated', ['destinations' => $destinations])
            </div>
        </section>

        <!-- Event Mendatang Section -->
        <!-- Event Mendatang Section -->
<section id="event" class="mb-5 py-5">
    <h2 class="section-title">Event Mendatang</h2>
    <div class="list-group">
        @forelse($events as $event)
        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start mb-3 shadow-sm rounded border-0">
            <div class="d-flex w-100 justify-content-between">
                {{-- PERUBAHAN: Menggunakan ->nama_event --}}
                <h5 class="mb-1 fw-bold text-primary">{{ $event->nama_event }}</h5>
                {{-- Ini akan tetap berfungsi karena ada $casts di model Event --}}
                <small class="text-muted">{{ $event->tanggal_mulai->format('d M Y') }}</small>
            </div>
            {{-- PERUBAHAN: Menggunakan ->deskripsi dan ->lokasi --}}
            <p class="mb-1">{{ \Illuminate\Support\Str::limit($event->deskripsi, 150) }}</p>
            <small class="text-muted"><i class="bi bi-geo-alt"></i> {{ $event->lokasi }}</small>
        </a>
        @empty
            <p class="text-center text-muted">Tidak ada event dalam waktu dekat.</p>
        @endforelse
    </div>
</section>


        <!-- Layanan & Masukan Section -->
        <section id="dukungan" class="py-5 bg-primary text-white text-center rounded">
            <div class="container">
                <h2 class="section-title text-white">Layanan & Masukan</h2>
                <p>Temukan hotel, restoran, dan agen travel terbaik untuk perjalanan Anda. Punya keluhan atau masukan? Kami siap mendengarkan.</p>
                <div class="mt-4">
                    <a href="#" class="btn btn-light btn-lg me-2">
                       <i class="bi bi-building"></i> Sektor Pendukung
                    </a>
                    <a href="{{ route('pengaduan.create') }}" class="btn btn-outline-light btn-lg">
                       <i class="bi bi-chat-left-text"></i> Buat Pengaduan
                    </a>
                </div>
            </div>
        </section>

    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white pt-5 pb-4">
        <div class="container text-center text-md-start">
            <div class="row">
                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                    <h6 class="text-uppercase fw-bold">{{ $pengaturan['site_title'] ?? 'YokWisata' }}</h6>
                    <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #0d6efd; height: 2px"/>
                    <p>
                        Platform informasi pariwisata terpadu untuk menjelajahi kekayaan alam dan budaya Indonesia.
                    </p>
                </div>
                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                    <h6 class="text-uppercase fw-bold">Link Cepat</h6>
                    <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #0d6efd; height: 2px"/>
                    <p><a href="#destinasi" class="text-white text-decoration-none">Destinasi</a></p>
                    <p><a href="#event" class="text-white text-decoration-none">Event</a></p>
                    <p><a href="{{ route('login') }}" class="text-white text-decoration-none">Login Admin</a></p>
                </div>
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                    <h6 class="text-uppercase fw-bold">Kontak</h6>
                    <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #0d6efd; height: 2px"/>
                    <p><i class="bi bi-geo-alt-fill me-3"></i> {{ $pengaturan['contact_address'] ?? 'Semarang, Indonesia' }}</p>
                    <p><i class="bi bi-envelope-fill me-3"></i> {{ $pengaturan['contact_email'] ?? 'info@yokwisata.com' }}</p>
                    <p><i class="bi bi-telephone-fill me-3"></i> {{ $pengaturan['contact_phone'] ?? '+62 24 1234 5678' }}</p>
                </div>
            </div>
        </div>
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
            © {{ date('Y') }} {{ $pengaturan['site_title'] ?? 'YokWisata' }}
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- PERUBAHAN DI SINI: Menggunakan tag <script> standar -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fungsi untuk memuat konten destinasi via AJAX
            function loadDestinations(url) {
                const destinationList = document.getElementById('destinasi-list');
                destinationList.style.opacity = '0.5';

                fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    destinationList.innerHTML = data.html;
                    destinationList.style.opacity = '1';
                    window.history.pushState({path:url}, '', url);
                })
                .catch(error => {
                    console.error('Error:', error);
                    destinationList.style.opacity = '1';
                    // Jika gagal, kembali ke cara lama
                    window.location.href = url;
                });
            }

            // Tambahkan event listener ke #destinasi-list untuk menangani link pagination baru
            document.getElementById('destinasi-list').addEventListener('click', function(event) {
                if (event.target.matches('.pagination a')) {
                    event.preventDefault();
                    const url = event.target.getAttribute('href');
                    if (url) {
                        loadDestinations(url);
                    }
                }
            });
        });
    </script>

</body>
</html>
