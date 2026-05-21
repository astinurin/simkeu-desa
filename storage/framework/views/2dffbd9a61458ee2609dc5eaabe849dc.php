

<?php $__env->startSection('content'); ?>

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">

        <h1 class="h3 mb-0 text-gray-800">

            Tambah User

        </h1>

        <a href="<?php echo e(route('users.index')); ?>"
           class="btn btn-secondary shadow-sm">

            <i class="fas fa-arrow-left fa-sm mr-1"></i>

            Kembali

        </a>

    </div>


    <?php if($errors->any()): ?>

        <div class="alert alert-danger border-0 shadow-sm">

            <?php echo e($errors->first()); ?>


        </div>

    <?php endif; ?>


    <div class="card shadow border-0">

        <div class="card-body p-4">

            <form action="<?php echo e(route('users.store')); ?>"
                  method="POST" autocomplete="off">

                <?php echo csrf_field(); ?>


                <!-- USERNAME -->
                <div class="form-group mb-4">

                    <label class="font-weight-bold text-gray-700">

                        Username

                    </label>

                    <input type="text"
                           name="name"
                           class="form-control"
                           placeholder="Masukkan username" autocomplete="off"
                           required>

                </div>


                <!-- PASSWORD -->
                <div class="form-group mb-4">

                    <label class="font-weight-bold text-gray-700">

                        Password

                    </label>

                    <input type="password"
                           name="password"
                           class="form-control"
                           placeholder="Masukkan password" autocomplete="new-password"
                           required>

                </div>


                <!-- ROLE -->
                <div class="form-group mb-4">

                    <label class="font-weight-bold text-gray-700">

                        Role

                    </label>

                    <select name="role"
                            class="form-control"
                            required>

                        <option value="bendahara">

                            Bendahara

                        </option>

                        <option value="superadmin">

                            Superadmin

                        </option>

                    </select>

                </div>


                <!-- BUTTON -->
                <button class="btn btn-primary shadow-sm">

                    <i class="fas fa-save mr-1"></i>

                    Simpan User

                </button>

            </form>

        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Asti\Kuliah\SMT 8\skripsi\simkeu-desa\resources\views/superadmin/create.blade.php ENDPATH**/ ?>