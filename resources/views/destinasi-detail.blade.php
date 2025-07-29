<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $wisata->nama_obyek_wisata }} - {{ $pengaturan['site_title']->value ?? 'YokWisata' }}</title>
    
    <!-- CSS Libraries -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Custom Styles -->
    <style>
        body { 
            font-family: 'Poppins', sans-serif; 
            background-color: #f8f9fa; 
        }
        .swiper { 
            width: 100%; 
            height: 60vh; 
            background-color: #eee;
        }
        .swiper-slide {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .info-card .list-group-item {
            background-color: transparent;
            border-color: rgba(0,0,0,0.08);
        }
        .gmap-container {
            border-radius: 0.5rem;
            overflow: hidden;
            line-height: 0;
        }
        .gmap-container iframe {
            border: 0;
            width: 100%;
            height: 400px;
        }
        .sektor-card-img {
            height: 120px;
            object-fit: cover;
        }
        .sektor-card .card-body {
            padding: 0.75rem;
        }
        .sektor-card .card-title {
            font-size: 1rem;
            margin-bottom: 0.25rem;
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

    <!-- Galeri Slider -->
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <!-- Gambar Utama -->
            <div class="swiper-slide">
                <img src="{{ $wisata->gambar ? asset('storage/' . $wisata->gambar) : 'https://source.unsplash.com/1600x900/?' . $wisata->lokasi }}" alt="{{ $wisata->nama_obyek_wisata }}">
            </div>
            <!-- Gambar dari Galeri -->
            @foreach($wisata->galeri as $gambar)
            <div class="swiper-slide">
                <img src="{{ asset('storage/' . $gambar->path_gambar) }}" alt="Galeri {{ $wisata->nama_obyek_wisata }}">
            </div>
            @endforeach
        </div>
        <div class="swiper-button-next text-white"></div>
        <div class="swiper-button-prev text-white"></div>
        <div class="swiper-pagination"></div>
    </div>

    <!-- Konten Detail -->
    <main class="container my-4">
        <div class="text-center mb-5">
            <span class="badge bg-primary mb-2 fs-6">{{ $wisata->kategori?->nama_kategori ?? 'Umum' }}</span>
            <h1 class="fw-bold">{{ $wisata->nama_obyek_wisata }}</h1>
            <p class="lead text-muted"><i class="bi bi-geo-alt-fill"></i> {{ $wisata->lokasi }}</p>
        </div>
        
        <!-- =================================================== -->
        <!-- Tampilan untuk Desktop (lg dan lebih besar) -->
        <!-- =================================================== -->
        <div class="row g-4 g-lg-5 d-none d-lg-flex">
            <!-- Kolom Kiri (Desktop) -->
            <div class="col-lg-8">
                <!-- Deskripsi -->
                <article class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h3 class="mb-3">Tentang Destinasi</h3>
                        <div class="text-muted" style="text-align: justify;">
                            {!! $wisata->deskripsi !!}
                        </div>
                    </div>
                </article>

                <!-- Sektor Pendukung -->
                <div class="mt-5">
                    <h3 class="mb-3">Fasilitas & Sektor Pendukung</h3>
                    <div class="row g-3">
                        @forelse($wisata->sektorPendukung as $sektor)
                            <div class="col-md-6">
                                <div class="card h-100 shadow-sm">
                                    <img src="{{ $sektor->gambar ? asset('storage/' . $sektor->gambar) : 'https://placehold.co/400x300?text=Gambar' }}" class="card-img-top sektor-card-img" alt="{{ $sektor->nama_sektor }}">
                                    <div class="card-body">
                                        <span class="badge rounded-pill bg-info-subtle text-info-emphasis mb-2">{{ ucwords(str_replace('_', ' ', $sektor->jenis)) }}</span>
                                        <h5 class="card-title">{{ $sektor->nama_sektor }}</h5>
                                        <p class="card-text text-muted small">
                                            <i class="bi bi-pin-map-fill"></i> {{ $sektor->alamat }}<br>
                                            <i class="bi bi-telephone-fill"></i> {{ $sektor->kontak ?? '-' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <p class="text-muted">Informasi sektor pendukung belum tersedia untuk destinasi ini.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan (Desktop) -->
            <div class="col-lg-4">
                <!-- Informasi Penting -->
                <div class="card border-0 shadow-sm info-card mb-4">
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

                <!-- Peta Lokasi -->
                @if($wisata->gmap_embed_link)
                <div class="card border-0 shadow-sm">
                     <div class="card-header fw-bold bg-light text-dark-emphasis">
                        <i class="bi bi-map-fill me-2"></i>Peta Lokasi
                    </div>
                    <div class="card-body p-0">
                         <div class="gmap-container">
                            {!! $wisata->gmap_embed_link !!}
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- =================================================== -->
        <!-- Tampilan untuk Mobile (di bawah lg) -->
        <!-- =================================================== -->
        <div class="row g-4 d-lg-none">
            <div class="col-12">
                <!-- 1. Deskripsi -->
                <article class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h3 class="mb-3">Tentang Destinasi</h3>
                        <div class="text-muted" style="text-align: justify;">
                            {!! $wisata->deskripsi !!}
                        </div>
                    </div>
                </article>

                <!-- 2. Informasi Penting -->
                <div class="card border-0 shadow-sm info-card mb-4">
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

                <!-- 3. Peta Lokasi -->
                @if($wisata->gmap_embed_link)
                <div class="card border-0 shadow-sm mb-4">
                     <div class="card-header fw-bold bg-light text-dark-emphasis">
                        <i class="bi bi-map-fill me-2"></i>Peta Lokasi
                    </div>
                    <div class="card-body p-0">
                         <div class="gmap-container">
                            {!! $wisata->gmap_embed_link !!}
                        </div>
                    </div>
                </div>
                @endif

                <!-- 4. Sektor Pendukung -->
                <div class="mt-5">
                    <h3 class="mb-3">Fasilitas & Sektor Pendukung</h3>
                    <div class="row g-3">
                        @forelse($wisata->sektorPendukung as $sektor)
                            <div class="col-md-6">
                                <div class="card h-100 shadow-sm">
                                    <img src="{{ $sektor->gambar ? asset('storage/' . $sektor->gambar) : 'https://placehold.co/400x300?text=Gambar' }}" class="card-img-top sektor-card-img" alt="{{ $sektor->nama_sektor }}">
                                    <div class="card-body">
                                        <span class="badge rounded-pill bg-info-subtle text-info-emphasis mb-2">{{ ucwords(str_replace('_', ' ', $sektor->jenis)) }}</span>
                                        <h5 class="card-title">{{ $sektor->nama_sektor }}</h5>
                                        <p class="card-text text-muted small">
                                            <i class="bi bi-pin-map-fill"></i> {{ $sektor->alamat }}<br>
                                            <i class="bi bi-telephone-fill"></i> {{ $sektor->kontak ?? '-' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <p class="text-muted">Informasi sektor pendukung belum tersedia untuk destinasi ini.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center p-3 mt-5">
        © {{ date('Y') }} {{ $pengaturan['site_title']->value ?? 'YokWisata' }}
    </footer>

    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    
    <!-- Inisialisasi Swiper -->
    <script>
      var swiper = new Swiper(".mySwiper", {
        loop: true,
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        keyboard: true,
        autoplay: {
          delay: 4000,
          disableOnInteraction: false,
        },
      });
    </script>
</body>
</html>
