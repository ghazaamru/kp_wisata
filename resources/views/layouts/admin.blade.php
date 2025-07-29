<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - YokWisata</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7fc;
        }
        .sidebar {
            background-color: #fff;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            padding-top: 20px;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
            z-index: 1000;
        }
        .sidebar .nav-link {
            color: #555;
            font-weight: 500;
            padding: 10px 20px;
            margin: 5px 15px;
            border-radius: 8px;
            transition: all 0.3s;
        }
        .sidebar .nav-link.active, .sidebar .nav-link:hover {
            background-color: #0d6efd;
            color: #fff;
            transform: translateX(5px);
        }
        .sidebar .nav-link i {
            margin-right: 10px;
        }
        .main-content {
            margin-left: 250px;
            padding: 30px;
        }
        .content-wrapper {
            background-color: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }
        .stat-card {
            border: none;
            border-radius: 10px;
            color: #fff;
            position: relative;
            overflow: hidden;
            padding: 1.5rem;
            transition: transform 0.3s;
        }
        .stat-card:hover {
            transform: translateY(-5px);
        }
        .stat-card .stat-icon {
            font-size: 4rem;
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            opacity: 0.2;
        }
        .stat-card h5 {
            font-weight: 500;
        }
        .stat-card .display-4 {
            font-weight: 700;
        }
        .bg-card-1 { background: linear-gradient(45deg, #0d6efd, #4dabf7); }
        .bg-card-2 { background: linear-gradient(45deg, #198754, #40c057); }
        .bg-card-3 { background: linear-gradient(45deg, #ffc107, #ffd43b); }
        .bg-card-4 { background: linear-gradient(45deg, #dc3545, #fa5252); }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h4 class="px-3 mb-4 fw-bold text-primary">YokWisata</h4>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard', 'contributor.dashboard') ? 'active' : '' }}" href="{{ auth()->user()->role == 'superadmin' ? route('admin.dashboard') : route('contributor.dashboard') }}">
                    <i class="bi bi-speedometer2"></i>Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.wisata.*') ? 'active' : '' }}" href="{{ route('admin.wisata.index') }}">
                    <i class="bi bi-geo-alt-fill"></i>Destinasi Wisata
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}" href="{{ route('admin.kategori.index') }}">
                    <i class="bi bi-tags-fill"></i>Kategori
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.events.*') ? 'active' : '' }}" href="{{ route('admin.events.index') }}">
                    <i class="bi bi-calendar-event-fill"></i>Event
                </a>
            </li>
            @if(auth()->user()->role == 'superadmin')
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.pengaduan.*') ? 'active' : '' }}" href="{{ route('admin.pengaduan.index') }}">
                    <i class="bi bi-chat-left-text-fill"></i>Pengaduan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.pengaturan.*') ? 'active' : '' }}" href="{{ route('admin.pengaturan.index') }}">
                    <i class="bi bi-gear-fill"></i>Pengaturan
                </a>
            </li>
            @endif
        </ul>
        <div class="position-absolute bottom-0 w-100 p-3">
             <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class="btn btn-danger w-100"><i class="bi bi-box-arrow-right"></i> Logout</button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <header class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">@yield('page-title')</h1>
            <div class="header-actions">
                @yield('header-actions')
            </div>
        </header>

        <!-- Wrapper untuk konten utama -->
        <div class="content-wrapper">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> Ada beberapa masalah dengan input Anda.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
     <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Cari semua textarea dengan kelas .wysiwyg-editor
            const editors = document.querySelectorAll('textarea.wysiwyg-editor');
            editors.forEach(editor => {
                ClassicEditor
                    .create(editor)
                    .catch(error => {
                        console.error(error);
                    });
            });
        });
    </script>
</body>
</html>
