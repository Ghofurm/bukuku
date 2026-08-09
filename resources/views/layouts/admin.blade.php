<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') — Bukuku Admin</title>

    <!-- Google Fonts (Outfit & Inter Tight) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@400;500&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- Bukuku Autumn Warm Theme -->
    <link href="{{ asset('css/bukuku.css') }}" rel="stylesheet">
</head>
<body style="background-color: var(--autumn-cream);">

    <!-- Mobile Top Navigation Bar -->
    <nav class="navbar navbar-expand-md navbar-bukuku d-md-none sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand navbar-brand-bukuku d-flex align-items-center gap-2" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-journal-bookmark-fill"></i> Bukuku Admin
            </a>
            <button class="btn btn-outline-primary border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#adminSidebarOffcanvas" aria-controls="adminSidebarOffcanvas">
                <i class="bi bi-list fs-4"></i>
            </button>
        </div>
    </nav>

    <!-- Desktop Fixed Sidebar -->
    <aside class="admin-sidebar d-none d-md-flex">
        <div class="mb-4">
            <a class="navbar-brand navbar-brand-bukuku d-flex align-items-center gap-2" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-journal-bookmark-fill"></i> Bukuku Admin
            </a>
            <div class="text-muted small mt-1">Panel Kelola Bukuku</div>
        </div>

        <nav class="nav flex-column mb-auto">
            <a class="admin-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a class="admin-nav-link {{ request()->routeIs('admin.books.*') ? 'active' : '' }}" href="{{ route('admin.books.index') }}">
                <i class="bi bi-book"></i> Kelola Buku
            </a>
            <a class="admin-nav-link {{ request()->routeIs('admin.genres.*') ? 'active' : '' }}" href="{{ route('admin.genres.index') }}">
                <i class="bi bi-tags"></i> Kelola Genre
            </a>
            <a class="admin-nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                <i class="bi bi-people"></i> Kelola User
            </a>
        </nav>

        <div class="pt-3 border-top border-secondary-subtle">
            <a href="{{ route('home') }}" class="btn btn-sm btn-outline-secondary w-100 mb-2 text-start d-flex align-items-center gap-2">
                <i class="bi bi-arrow-left"></i> Ke Web Utama
            </a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-danger w-100 text-start d-flex align-items-center gap-2">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Mobile Offcanvas Sidebar -->
    <div class="offcanvas offcanvas-start bg-light" tabindex="-1" id="adminSidebarOffcanvas" aria-labelledby="adminSidebarOffcanvasLabel">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title font-weight-bold text-primary" id="adminSidebarOffcanvasLabel">
                <i class="bi bi-journal-bookmark-fill me-1"></i> Bukuku Admin
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-flex flex-column justify-content-between">
            <nav class="nav flex-column">
                <a class="admin-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
                <a class="admin-nav-link {{ request()->routeIs('admin.books.*') ? 'active' : '' }}" href="{{ route('admin.books.index') }}">
                    <i class="bi bi-book"></i> Kelola Buku
                </a>
                <a class="admin-nav-link {{ request()->routeIs('admin.genres.*') ? 'active' : '' }}" href="{{ route('admin.genres.index') }}">
                    <i class="bi bi-tags"></i> Kelola Genre
                </a>
                <a class="admin-nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                    <i class="bi bi-people"></i> Kelola User
                </a>
            </nav>

            <div class="pt-3 border-top">
                <a href="{{ route('home') }}" class="btn btn-sm btn-outline-secondary w-100 mb-2 text-start d-flex align-items-center gap-2">
                    <i class="bi bi-arrow-left"></i> Ke Web Utama
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-danger w-100 text-start d-flex align-items-center gap-2">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Main Admin Content Area -->
    <main class="admin-content">
        <!-- Flash Messages Container -->
        @if(session('success'))
            <div class="alert alert-autumn-success alert-dismissible fade show d-flex align-items-center gap-2 shadow-sm mb-4" role="alert">
                <i class="bi bi-check-circle-fill text-success fs-5"></i>
                <div>{{ session('success') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-autumn-error alert-dismissible fade show d-flex align-items-center gap-2 shadow-sm mb-4" role="alert">
                <i class="bi bi-exclamation-triangle-fill text-danger fs-5"></i>
                <div>{{ session('error') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-autumn-error alert-dismissible fade show shadow-sm mb-4" role="alert">
                <div class="d-flex align-items-center gap-2 mb-1">
                    <i class="bi bi-x-circle-fill text-danger fs-5"></i>
                    <strong>Mohon periksa kembali input Anda:</strong>
                </div>
                <ul class="mb-0 ps-4">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Bootstrap 5.3 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
</body>
</html>
