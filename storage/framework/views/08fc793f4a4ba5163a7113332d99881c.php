

<?php $__env->startSection('content'); ?>

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">

        <h1 class="h3 mb-0 text-gray-800">

            Edit User

        </h1>

        <a href="<?php echo e(route('users.index')); ?>"
           class="btn btn-secondary shadow-sm">

            <i class="fas fa-arrow-left fa-sm"></i>

            Kembali

        </a>

    </div>

    <?php if($errors->any()): ?>

        <div class="alert alert-danger">

            <?php echo e($errors->first()); ?>


        </div>

    <?php endif; ?>

    <div class="card shadow border-0">

        <div class="card-body p-4">

            <form action="<?php echo e(route('users.update', $user->id)); ?>"
                  method="POST">

                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <!-- NAMA -->
                <div class="form-group mb-4">

                    <label>Nama</label>

                    <input type="text"
                           name="name"
                           class="form-control"
                           value="<?php echo e($user->name); ?>"
                           required>

                </div>

                <!-- EMAIL -->
                

                <!-- ROLE -->
                <div class="form-group mb-4">

                    <label>Role</label>

                    <select name="role"
                            class="form-control">

                        <option value="bendahara"
                            <?php echo e($user->role == 'bendahara' ? 'selected' : ''); ?>>

                            Bendahara

                        </option>

                        <option value="superadmin"
                            <?php echo e($user->role == 'superadmin' ? 'selected' : ''); ?>>

                            Superadmin

                        </option>

                    </select>

                </div>

                <button class="btn btn-primary">

                    <i class="fas fa-save mr-1"></i>

                    Update

                </button>

            </form>

        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Asti\Kuliah\SMT 8\skripsi\simkeu-desa\resources\views/superadmin/edit.blade.php ENDPATH**/ ?>