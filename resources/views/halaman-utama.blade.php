<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pengaturan['site_title'] ?? 'Sistem Informasi Pariwisata' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bs-primary-rgb: 13, 110, 253; /* Bootstrap Primary Blue */
        }
        html, body {
            height: 100%;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        .hero-section {
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.6)), url("{{ isset($pengaturan['hero_image']) ? asset('storage/' . $pengaturan['hero_image']) : asset('images/gunung.jpg') }}") no-repeat center center;
            background-size: cover;
            height: 100vh; /* Full viewport height */
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }
        .navbar {
            transition: background-color 0.4s ease-in-out;
        }
        .navbar-scrolled {
            background-color: rgba(255, 255, 255, 0.9) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .navbar .nav-link, .navbar .navbar-brand, .navbar .dropdown-toggle {
            color: #fff !important;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.4);
        }
        .navbar-scrolled .nav-link, .navbar-scrolled .navbar-brand, .navbar-scrolled .dropdown-toggle {
            color: #333 !important;
            text-shadow: none;
        }
        .hero-search-bar {
            max-width: 700px;
            margin: 2rem auto;
        }
        .hero-search-bar .form-control {
            border-radius: 50px;
            padding: 1rem 1.5rem;
            border: none;
        }
        .hero-search-bar .btn {
            border-radius: 50px;
            padding: 1rem 2rem;
        }
        .quick-access-btn {
            background-color: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: #fff;
            transition: all 0.3s;
        }
        .quick-access-btn:hover {
            background-color: rgba(255, 255, 255, 0.25);
            color: #fff;
        }
        .hero-content {
            animation: fadeIn 1s ease-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top py-3">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4" href="{{ route('home') }}">
                {{ $pengaturan['site_title'] ?? 'YokWisata' }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('kategori.index') }}">Destinasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('events.index') }}">Event</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pengaduan.create') }}">Kontak</a>
                    </li>
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-outline-light" href="{{ route('login') }}">
                           Login
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero-section text-center">
        <div class="container hero-content">
            <h1 class="display-3 fw-bold">{{ $pengaturan['hero_title']->value ?? 'Jelajahi Keindahan Tersembunyi Gunung Kidul' }}</h1>
            <p class="lead my-3">{{ $pengaturan['hero_subtitle']->value ?? 'Temukan 25+ pantai eksotis, gua menakjubkan, dan kuliner autentik Yogyakarta.' }}</p>
            
            <!-- Search Bar di Hero Section -->
            <div class="hero-search-bar">
                <form action="{{ route('search') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="query" class="form-control" placeholder="Cari pantai, gua, atau kuliner...">
                        <button class="btn btn-primary" type="submit">Eksplorasi Sekarang</button>
                    </div>
                </form>
            </div>

            <!-- Quick Access Buttons -->
            <div class="mt-4">
                <span class="me-2">Populer:</span>
                @foreach($categories->take(3) as $category)
                    <a href="{{ route('kategori.show', $category->id) }}" class="btn btn-sm rounded-pill quick-access-btn">{{ $category->nama_kategori }}</a>
                @endforeach
            </div>
        </div>
    </header>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const nav = document.querySelector('.navbar');
            // Tambahkan event listener untuk scroll
            window.addEventListener('scroll', function () {
                if (window.scrollY > 50) {
                    nav.classList.add('navbar-scrolled');
                    nav.classList.remove('navbar-dark');
                } else {
                    nav.classList.remove('navbar-scrolled');
                    nav.classList.add('navbar-dark');
                }
            });
        });
    </script>

</body>
</html>
