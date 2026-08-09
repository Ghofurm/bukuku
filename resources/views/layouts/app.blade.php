<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bukuku') — Bukuku</title>

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
<body>

    <!-- Navbar Sticky -->
    <nav class="navbar navbar-expand-lg navbar-bukuku sticky-top">
        <div class="container">
            <a class="navbar-brand navbar-brand-bukuku d-flex align-items-center gap-2" href="{{ route('home') }}">
                <i class="bi bi-journal-bookmark-fill"></i> Bukuku
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarBukukuNav" aria-controls="navbarBukukuNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarBukukuNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-3">
                    <li class="nav-item">
                        <a class="nav-link nav-link-bukuku" href="{{ route('home') }}">
                            <i class="bi bi-house-door me-1"></i> Beranda
                        </a>
                    </li>
                </ul>

                <div class="d-flex align-items-center gap-3">
                    @if(session()->has('user_id'))
                        <div class="dropdown">
                            <button class="btn btn-link text-decoration-none p-0 d-flex align-items-center gap-2 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="user-avatar-circle">
                                    {{ strtoupper(substr(session('user_name'), 0, 1)) }}
                                </div>
                                <span class="d-none d-sm-inline font-weight-medium text-dark">
                                    {{ session('user_name') }}
                                </span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2">
                                <li>
                                    <a class="dropdown-menu-item dropdown-item d-flex align-items-center gap-2" href="{{ route('profile') }}">
                                        <i class="bi bi-person me-1"></i> Profil Saya
                                    </a>
                                </li>
                                @if(session('user_role') === 'admin')
                                    <li>
                                        <a class="dropdown-menu-item dropdown-item d-flex align-items-center gap-2 text-primary" href="{{ route('admin.dashboard') }}">
                                            <i class="bi bi-speedometer2 me-1"></i> Dashboard Admin
                                        </a>
                                    </li>
                                @endif
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger d-flex align-items-center gap-2">
                                            <i class="bi bi-box-arrow-right me-1"></i> Keluar
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm px-3">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Messages Container -->
    <div class="container mt-4">
        @if(session('success'))
            <div class="alert alert-autumn-success alert-dismissible fade show d-flex align-items-center gap-2 shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill text-success fs-5"></i>
                <div>{{ session('success') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-autumn-error alert-dismissible fade show d-flex align-items-center gap-2 shadow-sm" role="alert">
                <i class="bi bi-exclamation-triangle-fill text-danger fs-5"></i>
                <div>{{ session('error') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-autumn-error alert-dismissible fade show shadow-sm" role="alert">
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
    </div>

    <!-- Main Content -->
    <main class="py-4">
        @yield('content')
    </main>

    <!-- Footer Publik -->
    <footer class="footer-bukuku">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-5">
                    <h5 class="d-flex align-items-center gap-2 text-white mb-3">
                        <i class="bi bi-journal-bookmark-fill text-warning"></i> Bukuku
                    </h5>
                    <p class="text-white-50 mb-0" style="max-width: 360px;">
                        Ruang hangat bagi para pecinta buku untuk berbagi ulasan, menemukan rekomendasi bacaan baru, dan mencatat koleksi favorit.
                    </p>
                </div>
                <div class="col-md-3 offset-md-1">
                    <h6 class="text-white mb-3">Navigasi</h6>
                    <ul class="list-unstyled d-flex flex-column gap-2 mb-0">
                        <li><a href="{{ route('home') }}" class="text-white-50"><i class="bi bi-chevron-right small me-1"></i> Beranda</a></li>
                        @if(session()->has('user_id'))
                            <li><a href="{{ route('profile') }}" class="text-white-50"><i class="bi bi-chevron-right small me-1"></i> Profil Saya</a></li>
                        @else
                            <li><a href="{{ route('login') }}" class="text-white-50"><i class="bi bi-chevron-right small me-1"></i> Masuk / Akun</a></li>
                        @endif
                    </ul>
                </div>
                <div class="col-md-3">
                    <h6 class="text-white mb-3">Bukuku</h6>
                    <p class="text-white-50 small mb-0">
                        Dirancang dengan hangat dan manis untuk menghadirkan ketenangan dalam setiap halaman ulasan.
                    </p>
                </div>
            </div>

            <div class="footer-bottom text-center">
                <p class="mb-0">&copy; {{ date('Y') }} <strong>Bukuku</strong> — Dibuat untuk kenyamanan membaca Anda.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5.3 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
</body>
</html>

