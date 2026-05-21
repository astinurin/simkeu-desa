<?php $__env->startSection('content'); ?>

    <style>
        body {
            background: #f3f4f6;
            overflow-x: hidden;
        }

        .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        .login-card {
            width: 100%;
            max-width: 1180px;
            background: white;
            border-radius: 32px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, .08);
        }

        .login-image {
            position: relative;

            height: 100%;
            min-height: 760px;

            background:
                linear-gradient(rgba(0, 0, 0, .25),
                    rgba(0, 0, 0, .25)),
                url('<?php echo e(asset('assets/img/villageaerialphotography.jpg')); ?>');

            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;

            border-top-left-radius: 32px;
            border-bottom-left-radius: 32px;

            overflow: hidden;
        }

        .overlay-content {
            position: absolute;
            left: 40px;
            bottom: 40px;

            color: white;
            max-width: 420px;

            background: rgba(255, 255, 255, .08);
            backdrop-filter: blur(10px);

            padding: 28px;
            border-radius: 24px;

            border: 1px solid rgba(255, 255, 255, .15);
        }

        .overlay-content h1 {
            font-size: 34px;
            line-height: 1.25;
            font-weight: 700;
        }

        .overlay-content p {
            font-size: 14px;
            line-height: 1.7;
            margin-top: 14px;
        }

        .login-form-wrapper {
            padding: 70px 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100%;
        }

        .brand-logo {
            margin-bottom: 40px;
            margin-left: 40px;
        }

        .brand-logo img {
            width: 385px;
            max-width: 100%;
            display: block;
        }

        .login-title {
            font-size: 42px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 10px;
        }

        .login-subtitle {
            color: #6b7280;
            margin-bottom: 45px;
            font-size: 15px;
        }

        .form-label {
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 10px;
        }

        .custom-input {
            height: 58px;
            border-radius: 16px;
            border: 1px solid #e5e7eb;
            background: #f9fafb;
            padding: 0 20px;
            font-size: 15px;
            transition: .2s ease;
        }

        .custom-input:focus {
            background: white;
            border-color: #4e73df;
            box-shadow: 0 0 0 4px rgba(78, 115, 223, .12);
        }

        .login-btn {
            height: 58px;
            border-radius: 16px;
            background: #4e73df;
            border: none;
            font-size: 16px;
            font-weight: 600;
            transition: .2s ease;
        }

        .login-btn:hover {
            background: #3f63d3;
            transform: translateY(-1px);
        }

        .forgot-link {
            color: #4e73df;
            font-size: 14px;
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

        .footer-text {
            font-size: 14px;
            color: #9ca3af;
        }

        .footer-text a {
            color: #4e73df;
            font-weight: 600;
            text-decoration: none;
        }

        @media(max-width: 991px) {

            .login-image {
                display: none;
            }

            .login-form-wrapper {
                padding: 50px 35px;
            }

            .login-title {
                font-size: 34px;
            }

        }
    </style>


    <div class="login-wrapper">

        <div class="login-card">

            <div class="row no-gutters">

                <!-- LEFT IMAGE -->
                <div class="col-lg-6">

                    <div class="login-image">

                        <div class="overlay-content">

                            <h1>
                                Sistem Informasi
                                Manajemen
                                Keuangan Desa
                            </h1>

                            <p>
                                Kelola pendapatan, belanja,
                                realisasi, dan dokumentasi
                                kegiatan desa secara digital,
                                transparan, dan terstruktur.
                            </p>

                        </div>

                    </div>

                </div>


                <!-- RIGHT FORM -->
                <div class="col-lg-6">

                    <div class="login-form-wrapper">

                        <!-- LOGO -->
                        <div class="brand-logo">

                            <img src="<?php echo e(asset('assets/img/simkeu_logo3.png')); ?>" alt="SIMKEU" class="logo">

                        </div>


                        <!-- TITLE -->
                        <h2 class="login-title">

                            Login Admin

                        </h2>

                        <p class="login-subtitle">

                            Masuk ke dashboard

                        </p>


                        
                        <?php if($errors->any()): ?>

                            <div class="alert alert-danger border-0 rounded-lg">

                                <?php echo e($errors->first()); ?>


                            </div>

                        <?php endif; ?>


                        <!-- FORM -->
                        <form method="POST" action="<?php echo e(route('login')); ?>">

                            <?php echo csrf_field(); ?>


                            <!-- USERNAME -->
                            <div class="form-group mb-4">

                                <label class="form-label">

                                    Username

                                </label>

                                <input type="text" name="name" class="form-control custom-input"
                                    placeholder="Masukkan username" value="<?php echo e(old('name')); ?>" required autofocus>

                            </div>


                            <!-- PASSWORD -->
                            <div class="form-group mb-3">

                                <div class="d-flex justify-content-between align-items-center mb-2">

                                    <label class="form-label mb-0">

                                        Password

                                    </label>

                               <?php
    $superadmin = \App\Models\User::where('role', 'superadmin')->first();
?>

<?php if($superadmin && $superadmin->whatsapp): ?>

<a href="https://wa.me/<?php echo e($superadmin->whatsapp); ?>?text=Halo%20Superadmin%20SIMKEU,%20saya%20mengalami%20kendala%20login%20karena%20lupa%20password%20akun.%0A%0AUsername%20:%20%0A%0AMohon%20bantuannya%20untuk%20reset%20password.%20Terima%20kasih."
   target="_blank"
   class="forgot-link">

    Lupa password?

</a>

<?php endif; ?>

                                </div>

                                <input type="password" name="password" class="form-control custom-input"
                                    placeholder="Masukkan password" required>

                            </div>


                            <!-- REMEMBER -->
                            <div class="form-group mb-4">

                                <div class="custom-control custom-checkbox">

                                    <input type="checkbox" class="custom-control-input" id="remember" name="remember">

                                    <label class="custom-control-label remember-text" for="remember">

                                        Ingat saya

                                    </label>

                                </div>

                            </div>


                            <!-- BUTTON -->
                            <button type="submit" class="btn btn-primary btn-block login-btn shadow-sm">

                                <i class="fas fa-sign-in-alt mr-2"></i>

                                Masuk

                            </button>

                        </form>


                        <!-- FOOTER -->
                        <div class="text-center mt-5 footer-text">

                            SIMKEU Desa © <?php echo e(date('Y')); ?>


                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Asti\Kuliah\SMT 8\skripsi\simkeu-desa\resources\views/auth/login.blade.php ENDPATH**/ ?>