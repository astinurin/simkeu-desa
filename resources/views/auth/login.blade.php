@extends('layouts.auth')

@section('content')

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            overflow: hidden;
            background: white;
        }

        .login-container {
            width: 100%;
            height: 100vh;
            display: flex;
        }

        /*
                ====================================
                LEFT SIDE
                ====================================
                */

        .login-left {
            width: 55%;
            position: relative;

            background:
                linear-gradient(rgba(0, 0, 0, .28),
                    rgba(0, 0, 0, .28)),
                url('{{ asset('assets/img/villageaerialphotography.jpg') }}');

            background-size: cover;
            background-position: center;

            display: flex;
            align-items: flex-end;
            padding: 55px;
        }

        .left-content {

            max-width: 480px;

            backdrop-filter: blur(14px);

            background: rgba(255, 255, 255, .08);

            border: 1px solid rgba(255, 255, 255, .15);

            border-radius: 28px;

            padding: 34px;
        }

        .left-content h1 {
            color: white;
            font-size: 52px;
            line-height: 1.1;
            font-weight: 700;
            margin-bottom: 18px;
        }

        .left-content p {
            color: rgba(255, 255, 255, .88);
            line-height: 1.8;
            font-size: 15px;
        }


        /*
                ====================================
                RIGHT SIDE
                ====================================
                */

        .login-right {
            width: 45%;
            background: white;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 70px;
        }

        .login-box {
            width: 100%;
            max-width: 460px;
            background: rgba(255, 255, 255, .72);

            /* backdrop-filter: blur(18px); */

            /* border: 1px solid rgba(255, 255, 255, .8); */

            border-radius: 32px;

            padding: 48px;


        }

        .brand-logo {
            margin-bottom: 55px;
        }

        .brand-logo img {
            width: 320px;
            max-width: 100%;
        }

        .login-title {
            /* font-size: 54px; */
            /* font-weight: 700; */
            color: #111827;

            margin-bottom: 10px;
            font-size: 42px;

            font-weight: 800;

            letter-spacing: -1px;

            line-height: 1.1;
        }

        .login-subtitle {
            color: #6b7280;
            font-size: 15px;

            margin-bottom: 28px;

            line-height: 1.7;

            max-width: 320px;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-label {
            display: block;

            margin-bottom: 10px;

            font-size: 14px;
            font-weight: 600;
            color: #374151;
        }

        .custom-input {
            width: 100%;
            height: 62px;

            border: none;

            background: #f3f4f6;

            border-radius: 18px;

            padding: 0 22px;

            font-size: 15px;

            transition: .2s;
        }

        .custom-input:focus {
            outline: none;

            background: white;

            box-shadow:
                0 0 0 4px rgba(78, 115, 223, .12);

            border: 1px solid #4e73df;
        }

        .forgot-link {
            font-size: 14px;
            color: #4e73df;
            text-decoration: none;
        }

        .forgot-link:hover {
            text-decoration: none;
            color: #2e59d9;
        }

        .remember-text {
            font-size: 14px;
            color: #6b7280;
        }

        .login-btn {
            width: 100%;
            height: 62px;

            border: none;

            border-radius: 18px;

            background: #4e73df;

            color: white;

            font-size: 16px;
            font-weight: 600;

            transition: .2s;
        }

        .login-btn:hover {
            background: #3f63d3;
            transform: translateY(-2px);
        }

        .footer-text {
            margin-top: 40px;

            text-align: center;

            color: #9ca3af;
            font-size: 14px;
        }

        /*
                ====================================
                MOBILE
                ====================================
                */

        @media(max-width:991px) {

            .login-left {
                display: none;
            }

            .login-right {
                width: 100%;
                padding: 40px 28px;
            }

            .login-title {
                font-size: 42px;
            }

        }
    </style>


    <div class="login-container">

        <!-- LEFT -->
        <div class="login-left">

            <div class="left-content">

                <h1>
                    Sistem Informasi
                    Manajemen
                    Keuangan Desa
                </h1>

                {{-- <p>
                    Kelola pendapatan, belanja,
                    realisasi, dan dokumentasi
                    kegiatan desa secara digital,
                    transparan, dan terstruktur.
                </p> --}}

            </div>

        </div>



        <!-- RIGHT -->
        <div class="login-right">

            <div class="login-box">

                <!-- LOGO -->
                <div class="brand-logo">

                    <img src="{{ asset('assets/img/simkeu_logo3.png') }}">

                </div>


                <!-- TITLE -->
                <h2 class="login-title">

                    Login

                </h2>

                <p class="login-subtitle">

                    Masuk ke dashboard SIMKEU

                </p>


                <!-- ERROR -->
                @if ($errors->any())

                    <div class="alert alert-danger mb-4">

                        {{ $errors->first() }}

                    </div>

                @endif


                <!-- FORM -->
                <form method="POST" action="{{ route('login') }}">

                    @csrf


                    <!-- USERNAME -->
                    <div class="form-group">

                        <label class="form-label">

                            Username

                        </label>

                        <input type="text" name="name" class="custom-input" placeholder="Masukkan username" required>

                    </div>


                    <!-- PASSWORD -->
                    <div class="form-group">

                        <div class="d-flex justify-content-between align-items-center mb-2">

                            <label class="form-label mb-0">

                                Password

                            </label>

                            @php
                                $superadmin = \App\Models\User::where('role', 'superadmin')->first();
                            @endphp

                            @if($superadmin && $superadmin->whatsapp)

                                <a href="https://wa.me/{{ $superadmin->whatsapp }}?text=Halo%20Superadmin,%20saya%20mengalami%20kendala%20login%20karena%20lupa%20password%20akun.%0A%0AUsername%20:%20%0A%0AMohon%20bantuannya%20untuk%20reset%20password.%20Terima%20kasih."
                                    target="_blank" class="forgot-link">

                                    Lupa password?

                                </a>

                            @endif

                        </div>

                        <input type="password" name="password" class="custom-input" placeholder="Masukkan password"
                            required>

                    </div>


                    <!-- REMEMBER -->
                    <div class="form-group">

                        <div class="custom-control custom-checkbox">

                            <input type="checkbox" class="custom-control-input" id="remember" name="remember">

                            <label class="custom-control-label remember-text" for="remember">

                                Ingat saya

                            </label>

                        </div>

                    </div>


                    <!-- BUTTON -->
                    <button type="submit" class="login-btn">

                        <i class="fas fa-sign-in-alt mr-2"></i>

                        Masuk

                    </button>

                </form>


                <!-- FOOTER -->
                <div class="footer-text">

                    SIMKEU © {{ date('Y') }}

                </div>

            </div>

        </div>

    </div>

@endsection