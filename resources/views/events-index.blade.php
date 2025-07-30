<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Event Mendatang - {{ $pengaturan['site_title']->value ?? 'YokWisata' }}</title>
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
        .event-card {
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
            border-radius: 1rem;
            border: none;
            background-color: #fff;
        }
        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }
        .event-card-img {
            height: 200px;
            object-fit: cover;
            border-radius: 1rem 1rem 0 0;
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

    <!-- Konten Halaman Event -->
    <main class="container my-5">
        <div class="text-center mb-5">
            <h1 class="fw-bold">Event & Aktivitas Mendatang</h1>
            <p class="lead text-muted">Jangan lewatkan berbagai acara menarik di Gunung Kidul.</p>
        </div>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @forelse($events as $event)
            <div class="col">
                <div class="card h-100 shadow-sm event-card">
                    <img src="{{ $event->gambar ? asset('storage/' . $event->gambar) : 'https://source.unsplash.com/500x400/?event' }}" class="event-card-img" alt="{{ $event->nama_event }}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold">{{ $event->nama_event }}</h5>
                        <p class="card-text text-muted small">
                            <i class="bi bi-calendar-event"></i> {{ $event->tanggal_mulai->format('d M Y') }}
                            @if($event->tanggal_selesai)
                                - {{ $event->tanggal_selesai->format('d M Y') }}
                            @endif
                            <br>
                            <i class="bi bi-geo-alt"></i> {{ $event->lokasi }}
                        </p>
                        <p class="card-text flex-grow-1">{{ \Illuminate\Support\Str::limit($event->deskripsi, 100) }}</p>
                        <a href="{{ route('events.show', $event->id) }}" role="button" class="btn btn-outline-primary mt-auto">Lihat Detail Event</a>
                    </div>
                </div>
            </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="bi bi-calendar-x fs-1 text-muted"></i>
                        <h3 class="mt-3">Belum Ada Event</h3>
                        <p class="text-muted">Saat ini belum ada event mendatang yang dijadwalkan.</p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-5 d-flex justify-content-center">
            {{ $events->links() }}
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center p-3 mt-auto">
        © {{ date('Y') }} {{ $pengaturan['site_title']->value ?? 'YokWisata' }}
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
