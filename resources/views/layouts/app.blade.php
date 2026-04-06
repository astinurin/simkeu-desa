<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SIMKEU Desa</title>

    <!-- Fonts -->
    <link href="{{ asset('sbadmin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('sbadmin/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body id="page-top">

    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-coins"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SIMKEU</div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item">
                <a class="nav-link" href="/">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-money-bill"></i>
                    <span>Pendapatan</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-shopping-cart"></i>
                    <span>Belanja</span>
                </a>
            </li>

            <hr class="sidebar-divider">

        </ul>
        <!-- End Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Search -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search...">
                            <div class="input-group-append">
                                <button class="btn btn-primary">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Right -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" data-toggle="dropdown">
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
                                        <span class="font-weight-bold">Data berhasil ditambahkan</span>
                                    </div>
                                </a>

                                <a class="dropdown-item text-center small text-gray-500" href="#">
                                    Show All Alerts
                                </a>
                            </div>
                        </li>

                        <!-- Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" data-toggle="dropdown">
                                <i class="fas fa-envelope fa-fw"></i>
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>

                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in">
                                <h6 class="dropdown-header">Message Center</h6>

                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle"
                                            src="{{ asset('sbadmin/img/undraw_profile_1.svg') }}">
                                    </div>
                                    <div>
                                        <div class="text-truncate">Halo, sistem siap digunakan 👀</div>
                                        <div class="small text-gray-500">System · Now</div>
                                    </div>
                                </a>

                                <a class="dropdown-item text-center small text-gray-500" href="#">
                                    Read More Messages
                                </a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- User -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" data-toggle="dropdown">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    Admin
                                </span>
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('sbadmin/img/undraw_profile.svg') }}">
                            </a>

                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>

                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>

                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>

                <!-- Main Content -->
                <div class="container-fluid">
                    @yield('content')
                </div>

            </div>

            <!-- Footer -->
            <footer class="bg-white text-center py-3">
                <small>© SIMKEU Desa</small>
            </footer>

        </div>

    </div>

    <!-- JS -->
    <script src="{{ asset('sbadmin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('sbadmin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('sbadmin/js/sb-admin-2.min.js') }}"></script>

</body>

</html>