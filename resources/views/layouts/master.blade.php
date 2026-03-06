<!DOCTYPE html>
<html lang="id">

<head>
    {{-- KONFIGURASI PWA AGAR BISA DI-INSTALL --}}
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <meta name="theme-color" content="#d63384">
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js');
            });
        }
    </script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - SIGAP</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- FEMININE COLOR PALETTE OVERRIDE --}}
    <style>
        /* ===== FEMININE COLOR VARIABLES ===== */
        :root {
            --bs-primary: #d63384;
            --bs-primary-rgb: 214, 51, 132;
            --bs-secondary: #b5657a;
            --bs-secondary-rgb: 181, 101, 122;
            --bs-success: #6f8f72;
            --bs-success-rgb: 111, 143, 114;
            --bs-info: #c084b8;
            --bs-info-rgb: 192, 132, 184;
            --bs-warning: #e8a0bf;
            --bs-warning-rgb: 232, 160, 191;
            --bs-danger: #e05a8a;
            --bs-danger-rgb: 224, 90, 138;
            --bs-light: #fdf0f5;
            --bs-light-rgb: 253, 240, 245;

            /* Link color */
            --bs-link-color: #d63384;
            --bs-link-color-rgb: 214, 51, 132;
            --bs-link-hover-color: #b5265f;

            /* Form focus ring */
            --bs-focus-ring-color: rgba(214, 51, 132, 0.25);
        }

        /* ===== BODY BACKGROUND ===== */
        body {
            background-color: #fff6fa;
        }

        /* ===== NAVBAR ===== */
        .navbar.bg-primary {
            background: linear-gradient(135deg, #d63384 0%, #c0478e 50%, #a8306e 100%) !important;
            box-shadow: 0 2px 10px rgba(214, 51, 132, 0.35);
        }

        /* ===== BUTTONS ===== */
        .btn-primary {
            background-color: #d63384;
            border-color: #d63384;
            color: #fff;
        }

        .btn-primary:hover,
        .btn-primary:focus,
        .btn-primary:active {
            background-color: #b5265f !important;
            border-color: #b5265f !important;
        }

        .btn-outline-primary {
            color: #d63384;
            border-color: #d63384;
        }

        .btn-outline-primary:hover {
            background-color: #d63384;
            border-color: #d63384;
            color: #fff;
        }

        .btn-success {
            background-color: #6f8f72;
            border-color: #6f8f72;
        }

        .btn-success:hover {
            background-color: #5a7a5d !important;
            border-color: #5a7a5d !important;
        }

        .btn-danger {
            background-color: #e05a8a;
            border-color: #e05a8a;
        }

        .btn-danger:hover {
            background-color: #c7486f !important;
            border-color: #c7486f !important;
        }

        .btn-outline-secondary {
            color: #b5657a;
            border-color: #b5657a;
        }

        .btn-outline-secondary:hover {
            background-color: #b5657a;
            border-color: #b5657a;
            color: #fff;
        }

        /* ===== CARDS ===== */
        .card {
            border-color: #f0d6e7;
        }

        .card-header.bg-primary {
            background-color: #d63384 !important;
        }

        .card-header.bg-info {
            background-color: #c084b8 !important;
        }

        .card-header.bg-success {
            background-color: #6f8f72 !important;
        }

        .bg-primary {
            background-color: #d63384 !important;
        }

        .bg-danger {
            background-color: #e05a8a !important;
        }

        .bg-success {
            background-color: #6f8f72 !important;
        }

        .bg-warning {
            background-color: #e8a0bf !important;
        }

        .bg-info {
            background-color: #c084b8 !important;
        }

        /* ===== TEXT COLORS ===== */
        .text-primary {
            color: #d63384 !important;
        }

        .text-danger {
            color: #e05a8a !important;
        }

        .text-success {
            color: #6f8f72 !important;
        }

        .text-info {
            color: #c084b8 !important;
        }

        /* ===== BADGES ===== */
        .badge.bg-primary {
            background-color: #d63384 !important;
        }

        .badge.bg-danger {
            background-color: #e05a8a !important;
        }

        .badge.bg-success {
            background-color: #6f8f72 !important;
        }

        .badge.bg-warning {
            background-color: #e8a0bf !important;
            color: #5c2d4a !important;
        }

        /* ===== ALERTS ===== */
        .alert-info {
            background-color: #fce4f5;
            border-color: #f0b8da;
            color: #7a1d55;
        }

        .alert-success {
            background-color: #eaf3eb;
            border-color: #c3dac5;
            color: #2d5b34;
        }

        .alert-danger {
            background-color: #fde8f0;
            border-color: #f5b8d0;
            color: #8c2244;
        }

        .alert-secondary {
            background-color: #fdf0f8;
            border-color: #f0d0e8;
            color: #6b3456;
        }

        /* ===== FORM CONTROLS ===== */
        .form-control:focus,
        .form-select:focus {
            border-color: #d63384;
            box-shadow: 0 0 0 0.25rem rgba(214, 51, 132, 0.20);
        }

        /* ===== TABLE ===== */
        .table-light {
            background-color: #fde8f4 !important;
        }

        .table-hover tbody tr:hover {
            background-color: #fdf0f8 !important;
        }

        /* ===== LINKS ===== */
        a:not(.btn):not(.nav-link):not(.navbar-brand) {
            color: #d63384;
        }

        a:not(.btn):not(.nav-link):not(.navbar-brand):hover {
            color: #a8265f;
        }
    </style>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

</head>

<body>

    <nav class="navbar navbar-expand navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">SIGAP APLIKASI</a>

            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">

                    {{-- LOGIKA 1: Jika yang datang adalah TAMU --}}
                    @guest
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('login') }}">
                                Login
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('register') }}">
                                Daftar Akun
                            </a>
                        </li>
                    @endguest


                    {{-- LOGIKA 2: Jika yang datang adalah PENGGUNA RESMI --}}
                    @auth

                        {{-- Jika dia ADMIN --}}
                        @if(Auth::user()->role == 'admin')
                            <li class="nav-item">
                                <a class="nav-link text-white fw-bold" href="{{ route('admin.dashboard') }}">
                                    Dashboard Admin
                                </a>
                            </li>

                            {{-- Jika dia WARGA --}}
                        @elseif(Auth::user()->role == 'warga')
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('user.lapor') }}">
                                    Tulis Pengaduan
                                </a>
                            </li>
                        @endif


                        {{-- Tombol Logout --}}
                        <li class="nav-item ms-2">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm mt-1 rounded-pill px-3">
                                    Logout
                                </button>
                            </form>
                        </li>

                    @endauth
                </ul>
            </div>
        </div>
    </nav>


    <div class="container mt-4">
        @yield('content')
    </div>

</body>

</html>