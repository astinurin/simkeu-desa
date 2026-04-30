<?php $__env->startSection('content'); ?>
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">

                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>

                            <div class="col-lg-6">
                                <div class="p-5">

                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>

                                    
                                    <?php if($errors->any()): ?>
                                        <div class="alert alert-danger">
                                            <?php echo e($errors->first()); ?>

                                        </div>
                                    <?php endif; ?>

                                    
                                    <?php if(session('status')): ?>
                                        <div class="alert alert-success">
                                            <?php echo e(session('status')); ?>

                                        </div>
                                    <?php endif; ?>

                                    <form method="POST" action="<?php echo e(route('login')); ?>" class="user">
                                        <?php echo csrf_field(); ?>

                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control form-control-user"
                                                placeholder="Username" value="<?php echo e(old('name')); ?>" required autofocus>
                                        </div>

                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user"
                                                placeholder="Password" required>
                                        </div>

                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" name="remember" class="custom-control-input"
                                                    id="remember">
                                                <label class="custom-control-label" for="remember">
                                                    Remember Me
                                                </label>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>

                                    </form>

                                    <hr>

                                    <?php if(Route::has('password.request')): ?>
                                        <div class="text-center">
                                            <a class="small" href="<?php echo e(route('password.request')); ?>">
                                                Forgot Password?
                                            </a>
                                        </div>
                                    <?php endif; ?>

                                    <div class="text-center">
                                        <a class="small" href="<?php echo e(route('register')); ?>">
                                            Create an Account!
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Asti\Kuliah\SMT 8\skripsi\simkeu-desa\resources\views/auth/login.blade.php ENDPATH**/ ?>