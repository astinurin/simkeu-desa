<?php $__env->startSection('content'); ?>
<div class="container">

    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">

                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>

                        <div class="col-lg-6">
                            <div class="p-5">

                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                                    <p class="mb-4">
                                        Just enter your email and we’ll send you a reset link!
                                    </p>
                                </div>

                                
                                <?php if(session('status')): ?>
                                    <div class="alert alert-success">
                                        <?php echo e(session('status')); ?>

                                    </div>
                                <?php endif; ?>

                                
                                <?php if($errors->any()): ?>
                                    <div class="alert alert-danger">
                                        <?php echo e($errors->first()); ?>

                                    </div>
                                <?php endif; ?>

                                <form method="POST" action="<?php echo e(route('password.email')); ?>" class="user">
                                    <?php echo csrf_field(); ?>

                                    <div class="form-group">
                                        <input type="email"
                                            name="email"
                                            class="form-control form-control-user"
                                            placeholder="Enter Email Address..."
                                            value="<?php echo e(old('email')); ?>"
                                            required autofocus>
                                    </div>

                                    <button type="submit"
                                        class="btn btn-primary btn-user btn-block">
                                        Reset Password
                                    </button>

                                </form>

                                <hr>

                                <div class="text-center">
                                    <a class="small" href="<?php echo e(route('register')); ?>">
                                        Create an Account!
                                    </a>
                                </div>

                                <div class="text-center">
                                    <a class="small" href="<?php echo e(route('login')); ?>">
                                        Already have an account? Login!
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
<?php echo $__env->make('layouts.auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Asti\Kuliah\SMT 8\skripsi\simkeu-desa\resources\views/auth/forgot-password.blade.php ENDPATH**/ ?>