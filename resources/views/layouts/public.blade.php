<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMKEU</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/simkeu_logo2.png') }}">

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- FontAwesome via CDN (lebih reliable) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <!-- FontAwesome dari SB Admin -->
    <link href="{{ asset('sbadmin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- SB Admin 2 — tetap dipakai untuk Bootstrap & utilities -->
    <link href="{{ asset('sbadmin/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        /* ── RESET FONT & BACKGROUND ── */
        body {
            font-family: 'Plus Jakarta Sans', 'Segoe UI', sans-serif !important;
        }

        *:not(i):not(.fas):not(.far):not(.fab):not(.fal):not(.fad):not([class*="fa-"]) {
            font-family: 'Plus Jakarta Sans', 'Segoe UI', sans-serif !important;
        }

        body {
            background: #f1f5f9 !important;
            min-height: 100vh;
        }

        /* ── NAVBAR OVERRIDES ── */
        .simkeu-navbar {
            background: #fff !important;
            border-bottom: 1px solid #e5e7eb;
            box-shadow: 0 1px 4px rgba(0, 0, 0, .06) !important;
            padding: 0 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .simkeu-navbar .navbar-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
            height: 60px;
        }

        .simkeu-navbar .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .simkeu-navbar .brand img {
            width: 36px;
            height: 36px;
            object-fit: contain;
        }

        .simkeu-navbar .brand-text {
            font-size: .88rem;
            font-weight: 700;
            color: #1a56db;
            line-height: 1.2;
        }

        .simkeu-navbar .brand-text span {
            display: block;
            font-size: .65rem;
            font-weight: 500;
            color: #6b7280;
            letter-spacing: .03em;
        }

        .simkeu-navbar .nav-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .simkeu-navbar .tahun-select {
            border: 1.5px solid #e5e7eb;
            border-radius: 10px;
            padding: 6px 12px;
            font-size: .82rem;
            font-weight: 600;
            color: #374151;
            background: #f9fafb;
            cursor: pointer;
            outline: none;
            transition: border-color .2s;
            height: 38px;
        }

        .simkeu-navbar .tahun-select:focus {
            border-color: #1a56db;
            background: #fff;
        }

        .simkeu-navbar .btn-login {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #1a56db;
            color: #fff !important;
            font-size: .8rem;
            font-weight: 700;
            padding: 7px 16px;
            border-radius: 10px;
            text-decoration: none !important;
            transition: background .2s;
        }

        .simkeu-navbar .btn-login:hover {
            background: #1341b2;
        }

        /* ── MAIN WRAPPER ── */
        .page-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            padding: 32px 24px 48px;
        }

        @media (max-width: 768px) {

            .page-wrapper {
                padding: 20px 16px 32px;
            }

            .simkeu-navbar .navbar-inner {
                padding: 0 12px;
            }

            .simkeu-navbar .brand img {
                width: 30px;
                height: 30px;
            }

            .simkeu-navbar .brand-text {
                font-size: .8rem;
            }

            .simkeu-navbar .brand-text span {
                display: none;
            }

            .simkeu-navbar .nav-right {
                gap: 6px;
            }

            .simkeu-navbar .tahun-select {
                max-width: 120px;
                font-size: .75rem;
                padding: 6px 8px;
            }

            .simkeu-navbar .btn-login {
                padding: 7px 10px;
                font-size: .75rem;
            }
        }
    </style>

    @yield('styles')
</head>

<body>

    <!-- NAVBAR CUSTOM (menggantikan navbar SB Admin bawaan) -->
    <nav class="simkeu-navbar">
        <div class="navbar-inner">

            <a class="brand" href="/">
                <img src="{{ asset('assets/img/simkeu_logo2.png') }}" alt="Logo SIMKEU">
                <div class="brand-text">
                    SIMKEU
                    <span>Sistem Informasi Manajemen Keuangan Desa</span>
                </div>
            </a>

            <div class="nav-right">
                <form method="GET" class="mb-0">
                    <select name="tahun" class="tahun-select" onchange="this.form.submit()">
                        @for($i = date('Y'); $i >= 2020; $i--)
                            <option value="{{ $i }}" {{ request('tahun', date('Y')) == $i ? 'selected' : '' }}>
                                Tahun {{ $i }}
                            </option>
                        @endfor
                    </select>
                </form>
                <a href="{{ route('login') }}" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i>
                    Login
                </a>
            </div>

        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <div class="page-wrapper">
        @yield('content')
    </div>

    <script src="{{ asset('sbadmin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('sbadmin/js/sb-admin-2.min.js') }}"></script>
    @yield('scripts')

</body>

</html>