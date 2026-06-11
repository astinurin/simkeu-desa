

<?php $__env->startSection('content'); ?>

<div class="container-fluid">

    <h1 class="h3 mb-4">
        Cetak Laporan
    </h1>

    <div class="card shadow">

        <div class="card-body">

            <form action="<?php echo e(route('laporan.cetak')); ?>" method="GET">

                <div class="form-group">

                    <label>Tahun</label>

                    <input
                        type="number"
                        name="tahun"
                        class="form-control"
                        value="<?php echo e(date('Y')); ?>"
                    >

                </div>

                <button class="btn btn-primary">
                    Cetak Laporan
                </button>

            </form>

        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Asti\Kuliah\SMT 8\skripsi\simkeu-desa\resources\views/laporan/index.blade.php ENDPATH**/ ?>