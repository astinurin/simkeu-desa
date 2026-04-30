<form method="post" action="<?php echo e(route('profile.destroy')); ?>">
    <?php echo csrf_field(); ?>
    <?php echo method_field('delete'); ?>

    <div class="alert alert-danger">
        <h5 class="font-weight-bold">Hapus Akun</h5>
        <p class="mb-3">
            Jika akun dihapus, seluruh data akan hilang permanen.
            Masukkan password untuk konfirmasi.
        </p>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" placeholder="Masukkan password">

            <?php $__errorArgs = ['password', 'userDeletion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <small class="text-danger"><?php echo e($message); ?></small>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <button type="submit" class="btn btn-danger">
            Hapus Akun
        </button>
    </div>
</form><?php /**PATH C:\Asti\Kuliah\SMT 8\skripsi\simkeu-desa\resources\views/profile/partials/delete-user-form.blade.php ENDPATH**/ ?>