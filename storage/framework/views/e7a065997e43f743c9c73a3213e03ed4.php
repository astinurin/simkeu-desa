<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SIMKEU</title>

    <link rel="icon" type="image/png" href="<?php echo e(asset('assets/img/simkeu_logo2.png')); ?>">

    <link href="<?php echo e(asset('sbadmin/vendor/fontawesome-free/css/all.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('sbadmin/css/sb-admin-2.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('sbadmin/vendor/datatables/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet">
</head>


<body id="page-top">

    <div id="wrapper">

        <!-- SIDEBAR  -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
                <div class="sidebar-brand-icon">
                    <img src="<?php echo e(asset('assets/img/simkeu_logo3.png')); ?>" alt="logo" style="width: 160px;">
                </div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item active">
                <a class="nav-link" href="/">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                Keuangan Desa
            </div>

            <li class="nav-item">
                <a class="nav-link" href="/pendapatan">
                    <i class="fas fa-fw fa-arrow-down"></i>
                    <span>Pendapatan</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/belanja">
                    <i class="fas fa-fw fa-arrow-up"></i>
                    <span>Belanja</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/settings">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Settings</span>
                </a>
            </li>

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
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-primary">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

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
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for...">
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
                        <!-- 🔔 ALERT -->
                        <li class="nav-item dropdown no-arrow mx-1">
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
                                            src="<?php echo e(asset('sbadmin/img/undraw_profile_1.svg')); ?>">
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
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- 👤 USER -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <?php echo e(Auth::user()->name ?? 'User'); ?>

                                </span>
                                <img class="img-profile rounded-circle"
                                    src="<?php echo e(asset('sbadmin/img/undraw_profile.svg')); ?>">
                            </a>

                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in">

                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>

                                <a class="dropdown-item" href="/settings">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>

                                <div class="dropdown-divider"></div>

                                <form method="POST" action="<?php echo e(route('logout')); ?>">
                                    <?php echo csrf_field(); ?>
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
                    <?php echo $__env->yieldContent('content'); ?>
                </div>

            </div>
        </div>

    </div>

    <script src="<?php echo e(asset('sbadmin/vendor/jquery/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('sbadmin/vendor/jquery-easing/jquery.easing.min.js')); ?>"></script>
    <script src="<?php echo e(asset('sbadmin/js/sb-admin-2.min.js')); ?>"></script>

    <!-- DATATABLE -->
    <script src="<?php echo e(asset('sbadmin/vendor/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('sbadmin/vendor/datatables/dataTables.bootstrap4.min.js')); ?>"></script>
    

    <!-- INI WAJIB -->
    <?php echo $__env->yieldContent('scripts'); ?>
</body>

</html><?php /**PATH C:\Asti\Kuliah\SMT 8\skripsi\simkeu-desa\resources\views/layouts/app.blade.php ENDPATH**/ ?>