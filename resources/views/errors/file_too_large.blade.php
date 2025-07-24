<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Terlalu Besar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7fc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }
        .error-container {
            max-width: 500px;
        }
        .error-icon {
            font-size: 5rem;
            color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <i class="bi bi-file-earmark-x-fill error-icon mb-3"></i>
        <h1 class="display-5 fw-bold">Upload Gagal</h1>
        <p class="lead text-muted">
            Ukuran file yang Anda coba upload melebihi batas maksimal yang diizinkan oleh server.
        </p>
        <p>Silakan kembali dan coba lagi dengan file yang ukurannya lebih kecil (di bawah 2MB).</p>
        <a href="{{ url()->previous() }}" class="btn btn-primary mt-3">
            <i class="bi bi-arrow-left"></i> Kembali ke Halaman Sebelumnya
        </a>
    </div>
</body>
</html>
