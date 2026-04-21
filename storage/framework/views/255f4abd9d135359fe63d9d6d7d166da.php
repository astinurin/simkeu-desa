<?php $__env->startSection('content'); ?>

<!-- PAGE HEADING -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

<!-- ===================== -->
<!-- 🔥 COUNTER ATAS -->
<!-- ===================== -->
<div class="row">

    <!-- TOTAL PAGU -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                    Total Pagu
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                    Rp <?php echo e(number_format($totalPagu ?? 0)); ?>

                </div>
            </div>
        </div>
    </div>

    <!-- REALISASI -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                    Total Realisasi
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                    Rp <?php echo e(number_format($totalRealisasi ?? 0)); ?>

                </div>
            </div>
        </div>
    </div>

    <!-- SISA -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                    Sisa Anggaran
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                    Rp <?php echo e(number_format($totalSisa ?? 0)); ?>

                </div>
            </div>
        </div>
    </div>

    <!-- PERSENTASE -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                    Persentase Realisasi
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                    <?php echo e($persentaseTotal ?? 0); ?>%
                </div>
            </div>
        </div>
    </div>

</div>

<!-- ===================== -->
<!-- TABLE PENDAPATAN -->
<!-- ===================== -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Pendapatan</h6>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Jenis Pendapatan</th>
                        <th>Pagu</th>
                        <th>Realisasi</th>
                        <th>Sisa</th>
                        <th>%</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $pendapatan ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php
                            $pagu = $item->pagu ?? 0;
                            $realisasi = optional($item->realisasi)->realisasi ?? 0;
                            $sisa = $pagu - $realisasi;
                            $persen = $pagu > 0 ? ($realisasi / $pagu) * 100 : 0;
                        ?>

                        <tr>
                            <td><?php echo e($index + 1); ?></td>
                            <td><?php echo e($item->jenis_pendapatan); ?></td>
                            <td>Rp <?php echo e(number_format($pagu)); ?></td>
                            <td>Rp <?php echo e(number_format($realisasi)); ?></td>
                            <td>Rp <?php echo e(number_format($sisa)); ?></td>
                            <td><?php echo e(number_format($persen, 2)); ?>%</td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="text-center">Belum ada data</td>
                        </tr>
                    <?php endif; ?>
                </tbody>

                <!-- 🔥 TOTAL -->
                <tfoot>
                    <tr class="font-weight-bold">
                        <td colspan="2">Total</td>
                        <td>Rp <?php echo e(number_format($totalPagu ?? 0)); ?></td>
                        <td>Rp <?php echo e(number_format($totalRealisasi ?? 0)); ?></td>
                        <td>Rp <?php echo e(number_format($totalSisa ?? 0)); ?></td>
                        <td><?php echo e($persentaseTotal ?? 0); ?>%</td>
                    </tr>
                </tfoot>

            </table>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Asti\Kuliah\SMT 8\skripsi\simkeu-desa\resources\views/dashboard.blade.php ENDPATH**/ ?>