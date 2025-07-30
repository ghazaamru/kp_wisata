<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $event->nama_event }} - {{ $pengaturan['site_title']->value ?? 'YokWisata' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Poppins', sans-serif; 
            background-color: #f8f9fa; 
        }
        .event-hero {
            height: 50vh;
            background-size: cover;
            background-position: center;
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
            <a href="{{ route('events.index') }}" class="btn btn-outline-primary">
                <i class="bi bi-arrow-left"></i> Kembali ke Daftar Event
            </a>
        </div>
    </nav>

    <!-- Hero Section Event -->
    <header class="event-hero" style="background-image: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('{{ $event->gambar ? asset('storage/' . $event->gambar) : 'https://source.unsplash.com/1600x900/?festival' }}');">
    </header>

    <!-- Konten Detail Event -->
    <main class="container" style="margin-top: -80px;">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 shadow-lg">
                    <div class="card-body p-4 p-md-5">
                        <h1 class="fw-bold mb-3">{{ $event->nama_event }}</h1>
                        
                        <div class="d-flex flex-wrap gap-3 text-muted mb-4 border-bottom pb-3">
                            <div>
                                <i class="bi bi-calendar-event me-2"></i>
                                <strong>{{ $event->tanggal_mulai->format('d M Y') }}</strong>
                                @if($event->tanggal_selesai && $event->tanggal_selesai != $event->tanggal_mulai)
                                    - <strong>{{ $event->tanggal_selesai->format('d M Y') }}</strong>
                                @endif
                            </div>
                            <div>
                                <i class="bi bi-geo-alt-fill me-2"></i>
                                <strong>{{ $event->lokasi }}</strong>
                            </div>
                        </div>

                        <div class="mt-4">
                            <h4 class="mb-3">Deskripsi Event</h4>
                            <div class="fs-6" style="text-align: justify;">
                                {!! $event->deskripsi !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center p-3 mt-5">
        © {{ date('Y') }} {{ $pengaturan['site_title']->value ?? 'YokWisata' }}
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
