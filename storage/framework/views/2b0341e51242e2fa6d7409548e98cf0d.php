

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">

        <h1 class="h3 mb-4 text-gray-800">Detail Belanja</h1>

        <?php
            $realisasi = optional($data->realisasi)->realisasi ?? 0;
            $sisa = optional($data->realisasi)->sisa_belanja ?? ($data->pagu - $realisasi);
            $persentase = $data->pagu > 0 ? ($realisasi / $data->pagu) * 100 : 0;
        ?>

        <div class="card shadow">
            <div class="card-body">

                <table class="table table-bordered">
                    <tr>
                        <th>Tanggal</th>
                        <td>
                            <?php echo e($data->tanggal ? \Carbon\Carbon::parse($data->tanggal)->format('d-m-Y') : '-'); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>Bidang</th>
                        <td><?php echo e($data->bidang); ?></td>
                    </tr>
                    <tr>
                        <th>Kegiatan</th>
                        <td><?php echo e($data->jenis_kegiatan); ?></td>
                    </tr>
                    <tr>
                        <th>Pagu</th>
                        <td>Rp <?php echo e(number_format($data->pagu)); ?></td>
                    </tr>
                    <tr>
                        <th>Realisasi</th>
                        <td>Rp <?php echo e(number_format($realisasi)); ?></td>
                    </tr>
                    <tr>
                        <th>Sisa</th>
                        <td>Rp <?php echo e(number_format($sisa)); ?></td>
                    </tr>
                    <tr>
                        <th>Persentase</th>
                        <td><?php echo e(number_format($persentase, 2)); ?>%</td>
                    </tr>

                    <tr>
                        <th>Dokumentasi Kegiatan</th>
                        <td>
                            <?php $__currentLoopData = $data->dokumentasi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <img src="<?php echo e(asset('storage/' . $doc->file)); ?>" style="max-width:100%; height:auto; border-radius:8px;">
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </td>
                    </tr>

                </table>

                <a href="<?php echo e(route('belanja.index')); ?>" class="btn btn-secondary">Kembali</a>

            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Asti\Kuliah\SMT 8\skripsi\simkeu-desa\resources\views/belanja/show.blade.php ENDPATH**/ ?>