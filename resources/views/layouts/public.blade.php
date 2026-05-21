<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SIMKEU</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/simkeu_logo2.png') }}">

    <link href="{{ asset('sbadmin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">

    <link href="{{ asset('sbadmin/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        body {
            background: #f4f6fb;
        }

        .rounded-lg {
            border-radius: 20px;
        }
    </style>

</head>

<body class="bg-light">

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">

        <div class="container">

            <a class="navbar-brand d-flex align-items-center font-weight-bold" href="/">

                <img src="{{ asset('assets/img/simkeu_logo2.png') }}" alt="logo"
                    style="width: 42px; margin-right: 10px;">

                <span>
                    Sistem Informasi Manajemen Keuangan Desa
                </span>

            </a>

            <div class="ml-auto d-flex align-items-center">

                <!-- FILTER TAHUN -->
                <form method="GET" class="mb-0">

                    <select name="tahun" class="form-control border-0 shadow-sm" onchange="this.form.submit()" style="
                    border-radius: 12px;
                    min-width: 160px;
                    height: 42px;
                ">

                        @for($i = date('Y'); $i >= 2020; $i--)

                            <option value="{{ $i }}" {{ request('tahun', date('Y')) == $i ? 'selected' : '' }}>

                                Tahun {{ $i }}

                            </option>

                        @endfor

                    </select>

                </form>


                <!-- LOGIN -->
                <a href="{{ route('login') }}" class="ml-3 text-white small font-weight-bold text-decoration-none">

                    <i class="fas fa-sign-in-alt mr-1"></i>

                    Login

                </a>

            </div>

        </div>

    </nav>

    <!-- CONTENT -->
    <div class="container py-5">

        @yield('content')

    </div>

    <script src="{{ asset('sbadmin/vendor/jquery/jquery.min.js') }}"></script>

    <script src="{{ asset('sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('sbadmin/js/sb-admin-2.min.js') }}"></script>

</body>

</html>