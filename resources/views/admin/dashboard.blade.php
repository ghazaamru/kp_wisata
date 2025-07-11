<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Contributor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-5">
    <div class="container">
        <h1>Dashboard Contributor</h1>
        <p>Selamat datang, {{ auth()->user()->name }}!</p>

        <ul class="list-group mt-4">
            <li class="list-group-item">
                <a href="{{ route('admin.wisata.index') }}">Manajemen Wisata</a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('admin.kategori.index') }}">Manajemen Kategori</a>
            </li>
        </ul>

        <form action="{{ route('logout') }}" method="post" class="mt-4">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>
</body>
</html>