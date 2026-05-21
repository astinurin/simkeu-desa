

<?php $__env->startSection('content'); ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">

    <h1 class="h3 mb-0 text-gray-800">

        Kelola User

    </h1>

    <a href="<?php echo e(route('users.create')); ?>"
       class="btn btn-primary shadow-sm">

        <i class="fas fa-plus fa-sm text-white-50 mr-1"></i>

        Tambah User

    </a>

</div>


<?php if(session('success')): ?>

    <div class="alert alert-success">

        <?php echo e(session('success')); ?>


    </div>

<?php endif; ?>


<div class="card shadow mb-4 border-0">

    <div class="card-header py-3 bg-white border-0">

        <h6 class="m-0 font-weight-bold text-primary">

            Data User

        </h6>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="thead-light">

                    <tr>

                        <th width="60">No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th width="160">Role</th>
                        <th width="220">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                        <tr>

                            <td>

                                <?php echo e($loop->iteration); ?>


                            </td>

                            <td class="font-weight-bold text-gray-800">

                                <?php echo e($item->name); ?>


                            </td>

                            <td>

                                <?php echo e($item->email); ?>


                            </td>

                            <td>

                                <?php if($item->role == 'superadmin'): ?>

                                    <span class="badge badge-primary px-3 py-2">

                                        Superadmin

                                    </span>

                                <?php else: ?>

                                    <span class="badge badge-success px-3 py-2">

                                        Bendahara

                                    </span>

                                <?php endif; ?>

                            </td>

                            <td>

                                <a href="<?php echo e(route('users.edit', $item->id)); ?>"
                                   class="btn btn-warning btn-sm">

                                    <i class="fas fa-edit"></i>

                                    Edit

                                </a>

                                <form action="<?php echo e(route('users.destroy', $item->id)); ?>"
                                      method="POST"
                                      class="d-inline">

                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>

                                    <button type="submit"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Hapus user ini?')">

                                        <i class="fas fa-trash"></i>

                                        Hapus

                                    </button>

                                </form>

                            </td>

                        </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                        <tr>

                            <td colspan="5"
                                class="text-center text-muted py-4">

                                Belum ada user

                            </td>

                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Asti\Kuliah\SMT 8\skripsi\simkeu-desa\resources\views/superadmin/index.blade.php ENDPATH**/ ?>