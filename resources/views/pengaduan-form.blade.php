<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak & Pengaduan - YokWisata</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f8f9fa; }
        .form-container {
            max-width: 700px;
            margin: 50px auto;
            background-color: #fff;
            padding: 2rem;
            border-radius: 10px;
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

    <!-- Form Konten -->
    <div class="container">
        <div class="form-container">
            <h2 class="text-center mb-4">Kontak & Pengaduan</h2>
            <p class="text-center text-muted mb-4">Punya pertanyaan, masukan, atau keluhan? Silakan isi formulir di bawah ini.</p>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('pengaduan.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nama_pelapor" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama_pelapor" name="nama_pelapor" value="{{ old('nama_pelapor') }}" required>
                </div>
                <div class="mb-3">
                    <label for="email_pelapor" class="form-label">Alamat Email</label>
                    <input type="email" class="form-control" id="email_pelapor" name="email_pelapor" value="{{ old('email_pelapor') }}" required>
                </div>
                <div class="mb-3">
                    <label for="isi_pengaduan" class="form-label">Pesan atau Isi Pengaduan</label>
                    <textarea class="form-control" id="isi_pengaduan" name="isi_pengaduan" rows="5" required>{{ old('isi_pengaduan') }}</textarea>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">Kirim Pesan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center p-3 mt-5">
        © 2025 YokWisata
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
