<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SIMKEU</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/img/simkeu_logo2.png') }}">

    <link href="{{ asset('sbadmin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('sbadmin/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('sbadmin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&display=swap"
        rel="stylesheet">

    <style>
        /* =============================================================
   SIMKEU — Layout Skin
============================================================= */

        /* ── FONT: hanya elemen non-icon ── */
        body {
            font-family: 'Plus Jakarta Sans', 'Segoe UI', sans-serif !important;
        }

        /* Targetkan elemen teks secara spesifik, BUKAN dengan wildcard * */
        .navbar-nav .nav-link span,
        .sidebar .nav-link span,
        .topbar .navbar-brand,
        /* .topbar .mr-2, */
        .card-body,
        .card-header,
        .card-footer,
        table,
        thead,
        tbody,
        tfoot,
        tr,
        td,
        th,
        input,
        select,
        textarea,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .modal-title,
        .modal-body,
        .dropdown-item span,
        label,
        small,
        p {
            font-family: 'Plus Jakarta Sans', 'Segoe UI', sans-serif !important;
        }

        /* Pastikan FontAwesome TIDAK ditimpa — eksplisit protect */
        /* .fas,
        .far,
        .fab,
        .fal,
        .fad,
        i.fas,
        i.far,
        i.fab,
        i.fal,
        [class^="fa-"],
        [class*=" fa-"],
        .fa,
        .fa-solid,
        .fa-regular,
        .fa-brands,
        .sidebar-brand-icon i,
        .nav-link i,
        .btn i,
        .dropdown-item i {
            font-family: "Font Awesome 6 Free", "Font Awesome 5 Free", "FontAwesome" !important;
            font-style: normal;
        } */

        /* ── BODY ── */
        body {
            background: #f1f5f9 !important;
        }

        /* ── SIDEBAR ── */
        .sidebar {
            background: linear-gradient(180deg, #1e3a8a 0%, #1a56db 100%) !important;
            box-shadow: 4px 0 20px rgba(26, 86, 219, .18) !important;
        }

        .sidebar .nav-item .nav-link {
            color: rgba(255, 255, 255, .72) !important;
            font-size: .82rem !important;
            font-weight: 600 !important;
            padding: 10px 20px !important;
            border-radius: 0 !important;
            transition: background .15s, color .15s !important;
        }

        .sidebar .nav-item.active .nav-link,
        .sidebar .nav-item .nav-link:hover {
            color: #fff !important;
            background: rgba(255, 255, 255, .12) !important;
        }

        .sidebar .nav-item.active .nav-link {
            border-left: 3px solid rgba(255, 255, 255, .8);
        }

        .sidebar .sidebar-brand {
            background: rgba(0, 0, 0, .15) !important;
            padding: 14px 20px !important;
        }

        .sidebar .sidebar-brand-text {
            font-size: 1.3rem !important;
            font-weight: 800 !important;
            letter-spacing: .04em !important;
            color: #fff !important;
            font-family: 'Plus Jakarta Sans', 'Segoe UI', sans-serif !important;
        }

        .sidebar .sidebar-divider {
            border-top-color: rgba(255, 255, 255, .12) !important;
        }

        .sidebar .sidebar-heading {
            font-size: .6rem !important;
            font-weight: 700 !important;
            letter-spacing: .12em !important;
            text-transform: uppercase !important;
            color: rgba(255, 255, 255, .4) !important;
            padding: 10px 20px 4px !important;
            font-family: 'Plus Jakarta Sans', 'Segoe UI', sans-serif !important;
        }

        #sidebarToggle {
            background: rgba(255, 255, 255, .1) !important;
        }

        /* ── TOPBAR ── */
        .topbar {
            background: #fff !important;
            border-bottom: 1px solid #e5e7eb !important;
            box-shadow: 0 1px 8px rgba(0, 0, 0, .06) !important;
            height: 58px !important;
            padding: 0 16px !important;
        }

        .topbar .navbar-search .form-control {
            font-size: .82rem !important;
            font-weight: 500 !important;
            background: #f9fafb !important;
            border: 1.5px solid #e5e7eb !important;
            border-radius: 10px 0 0 10px !important;
            font-family: 'Plus Jakarta Sans', 'Segoe UI', sans-serif !important;
        }

        .topbar .navbar-search .btn-primary {
            background: #1a56db !important;
            border-color: #1a56db !important;
            border-radius: 0 10px 10px 0 !important;
        }

        .topbar .nav-item .nav-link {
            color: #4b5563 !important;
            font-size: .82rem !important;
            font-weight: 600 !important;
        }

        .topbar .img-profile {
            width: 36px !important;
            height: 36px !important;
            border: 2px solid #e5e7eb !important;
        }

        /* Dropdown */
        .dropdown-menu.shadow {
            border-radius: 12px !important;
            border: 1px solid #e5e7eb !important;
            box-shadow: 0 8px 24px rgba(0, 0, 0, .10) !important;
        }

        .dropdown-item {
            font-size: .82rem !important;
            font-weight: 600 !important;
            color: #374151 !important;
            border-radius: 7px !important;
            margin: 2px 6px !important;
            width: calc(100% - 12px) !important;
            font-family: 'Plus Jakarta Sans', 'Segoe UI', sans-serif !important;
        }

        .dropdown-item:hover {
            background: #eff4ff !important;
            color: #1a56db !important;
        }

        .dropdown-divider {
            border-color: #e5e7eb !important;
        }

        /* ── CONTENT WRAPPER ── */
        #content-wrapper {
            background: #f1f5f9 !important;
        }

        #content {
            padding-top: 0 !important;
        }

        @media (max-width: 768px) {
            .topbar {
                padding: 0 12px !important;
            }
        }
    </style>
    @yield('styles')
</head>


<body id="page-top">

    <div id="wrapper">

        <!-- SIDEBAR  -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">

                <div class="sidebar-brand-icon">
                    <img src="{{ asset('assets/img/simkeu_logo2.png') }}" alt="logo" style="width: 42px;">
                </div>

                <div class="sidebar-brand-text mx-2">
                    SIMKEU
                </div>

            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                Keuangan Desa
            </div>

            <li class="nav-item {{ request()->is('pendapatan*') ? 'active' : '' }}">
                <a class="nav-link" href="/pendapatan">
                    <i class="fas fa-coins"></i>
                    <span>Pendapatan</span>
                </a>
            </li>

            <li class="nav-item {{ request()->is('belanja*') ? 'active' : '' }}">
                <a class="nav-link" href="/belanja">
                    <i class="fas fa-receipt"></i>
                    <span>Belanja</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('laporan.index') }}">
                    <i class="fas fa-print"></i>
                    <span>Laporan</span>
                </a>
            </li>
            @if(auth()->user()->role === 'superadmin')

                <li class="nav-item {{ request()->is('users*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('users.index') }}">
                        <i class="fas fa-fw fa-users-cog"></i>
                        <span>Kelola User</span>
                    </a>
                </li>

            @endif
            {{-- <li class="nav-item">
                <a class="nav-link" href="/settings">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Settings</span>
                </a>
            </li> --}}

            <hr class="sidebar-divider d-none d-md-block">

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>

        <!-- CONTENT -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <!-- top bar-->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- TOGGLE -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- 🔍 SEARCH DESKTOP -->
                    @if(request()->routeIs('dashboard'))
                        <form
                            class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <div class="input-group">
                                <input type="text" id="globalSearch" class="form-control bg-light border-0 small"
                                    placeholder="Cari...">
                                <div class="input-group-append">
                                    <button class="btn btn-primary">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    @endif

                    <!-- RIGHT SIDE -->
                    <ul class="navbar-nav ml-auto">

                        <!-- 🔍 SEARCH MOBILE -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                                <i class="fas fa-search fa-fw"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in">
                                <form class="form-inline w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" id="globalSearch"
                                            class="form-control bg-light border-0 small" placeholder="Search for...">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>


                        <!-- 🔔 ALERT -->
                        {{-- <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown">
                                <i class="fas fa-bell fa-fw"></i>
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>

                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in">
                                <h6 class="dropdown-header">Alerts Center</h6>

                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">Today</div>
                                        <span class="font-weight-bold">Laporan keuangan terbaru tersedia</span>
                                    </div>
                                </a>

                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        Pendapatan berhasil ditambahkan
                                    </div>
                                </a>

                                <a class="dropdown-item text-center small text-gray-500" href="#">
                                    Lihat semua notifikasi
                                </a>
                            </div>
                        </li>

                        <!-- ✉️ MESSAGE -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown">
                                <i class="fas fa-envelope fa-fw"></i>
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>

                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in">
                                <h6 class="dropdown-header">Message Center</h6>

                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle"
                                            src="{{ asset('sbadmin/img/undraw_profile_1.svg') }}">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Data keuangan sudah diperbarui</div>
                                        <div class="small text-gray-500">Admin · 10m</div>
                                    </div>
                                </a>

                                <a class="dropdown-item text-center small text-gray-500" href="#">
                                    Lihat semua pesan
                                </a>
                            </div>
                        </li>
                        <div class="topbar-divider d-none d-sm-block"></div> --}}

                        <!-- 👤 USER -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    {{ Auth::user()->name ?? 'User' }}
                                </span>
                                @if(Auth::user()->photo)
                                    <img class="img-profile rounded-circle"
                                        src="{{ asset('storage/' . Auth::user()->photo) }}">
                                @else
                                    <img class="img-profile rounded-circle"
                                        src="{{ asset('sbadmin/img/undraw_profile.svg') }}">
                                @endif
                            </a>

                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in">

                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>

                                {{-- <a class="dropdown-item" href="/settings">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a> --}}

                                <div class="dropdown-divider"></div>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </button>
                                </form>

                            </div>
                        </li>

                    </ul>

                </nav>

                <!-- CONTENT -->
                <div class="container-fluid">
                    @yield('content')
                </div>

            </div>
        </div>

    </div>

    <script src="{{ asset('sbadmin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('sbadmin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('sbadmin/js/sb-admin-2.min.js') }}"></script>

    <!-- DATATABLE -->
    <script src="{{ asset('sbadmin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('sbadmin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    {{--
    <script src="{{ asset('sbadmin/js/demo/datatables-demo.js') }}"></script> --}}

    {{-- script search --}}
    <script>

        $(document).ready(function () {

            $('#globalSearch').on('input', function () {

                let keyword =
                    $(this).val().toLowerCase().trim();

                // =========================
                // MODE NORMAL
                // =========================

                if (keyword === '') {

                    $('.dashboard-header').show();

                    $('.quick-action-section').show();

                    $('.search-section').show();

                    $('.search-section tbody tr').show();

                    $('.search-section .row.mb-4').show();

                    return;
                }

                // =========================
                // MODE SEARCH
                // =========================

                $('.dashboard-header').hide();

                $('.quick-action-section').hide();

                $('.search-section').each(function () {

                    let section =
                        $(this);

                    let rows =
                        section.find('tbody tr');

                    let visibleCount = 0;

                    rows.each(function () {

                        let rowText =
                            $(this).text().toLowerCase();

                        if (rowText.includes(keyword)) {

                            $(this).show();

                            visibleCount++;

                        } else {

                            $(this).hide();

                        }

                    });

                    // hide/show statistik card
                    if (visibleCount > 0) {

                        section.show();

                        section.find('.row.mb-4').show();

                    } else {

                        section.hide();

                    }

                });

            });

        });

    </script>

    <!-- INI WAJIB -->
    @yield('scripts')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.js"></script>
    <i class="fas fa-user"></i>
<i class="fas fa-home"></i>
<i class="fas fa-print"></i>
</body>

</html>