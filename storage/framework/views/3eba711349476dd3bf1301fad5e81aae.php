

<?php $__env->startSection('content'); ?>

    <!-- HERO -->
    <div class="text-center mb-5">

        <h1 class="font-weight-bold text-gray-900 mb-3">
            Anggaran Pendapatan dan Belanja Desa
        </h1>

        <h2 class="h3 text-primary font-weight-bold mb-2">
            Desa Pandanlandung
        </h2>


        <p class="text-muted mb-1">
            Tahun Anggaran <?php echo e($tahun); ?>

        </p>

        <p class="text-gray-500 small">
            <?php echo e(\Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y')); ?>

        </p>

    </div>



    <!-- ========================= -->
    <!-- PENDAPATAN -->
    <!-- ========================= -->

    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Pendapatan
            </h6>
        </div>

        <div class="card-body">

            <!-- COUNTER -->
            <div class="row mb-4">

                <!-- TOTAL PAGU -->
                <div class="col-md-3 mb-3">

                    <div class="card border-left-primary shadow h-100 py-2">

                        <div class="card-body">

                            <div class="text-xs text-primary text-uppercase mb-1">
                                Total Pagu
                            </div>

                            <div class="h5 font-weight-bold text-gray-800">
                                Rp <?php echo e(number_format($totalPaguPendapatan)); ?>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- REALISASI -->
                <div class="col-md-3 mb-3">

                    <div class="card border-left-success shadow h-100 py-2">

                        <div class="card-body">

                            <div class="text-xs text-success text-uppercase mb-1">
                                Realisasi
                            </div>

                            <div class="h5 font-weight-bold text-gray-800">
                                Rp <?php echo e(number_format($totalRealisasiPendapatan)); ?>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- SISA -->
                <div class="col-md-3 mb-3">

                    <div class="card border-left-danger shadow h-100 py-2">

                        <div class="card-body">

                            <div class="text-xs text-danger text-uppercase mb-1">
                                Sisa
                            </div>

                            <div class="h5 font-weight-bold text-gray-800">
                                Rp <?php echo e(number_format($totalSisaPendapatan)); ?>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- PERSENTASE -->
                <div class="col-md-3 mb-3">

                    <div class="card border-left-info shadow h-100 py-2">

                        <div class="card-body">

                            <div class="text-xs text-info text-uppercase mb-1">
                                Persentase
                            </div>

                            <div class="h5 font-weight-bold text-gray-800">
                                <?php echo e(number_format($persenPendapatan, 2)); ?>%
                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <!-- TABLE -->
            <div class="table-responsive">

                <table class="table table-bordered table-hover">

                    <thead class="text-center thead-light">

                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Kategori Pendapatan</th>
                            <th>Jenis Pendapatan</th>
                            <th>Pagu</th>
                            <th>Realisasi</th>
                            <th>Sisa</th>
                            <th>Persentase</th>


                        </tr>

                    </thead>

                    <tbody>

                        <?php $__empty_1 = true; $__currentLoopData = $pendapatan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                                        <?php
                                            $realisasi = optional($item->realisasi)->realisasi ?? 0;
                                            $sisa = $item->pagu - $realisasi;
                                            $persen = $item->pagu > 0
                                                ? ($realisasi / $item->pagu) * 100
                                                : 0;
                                        ?>

                                        <tr>

                                            <td><?php echo e($i + 1); ?></td>

                                            <td>
                                                <?php echo e($item->tanggal
                            ? \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y')
                            : '-'); ?>

                                            </td>

                                            <td>
                                                <?php echo e($item->kategori_pendapatan); ?>

                                            </td>

                                            <td>
                                                <?php echo e($item->jenis_pendapatan); ?>

                                            </td>

                                            <td>
                                                Rp <?php echo e(number_format($item->pagu)); ?>

                                            </td>

                                            <td>
                                                Rp <?php echo e(number_format($realisasi)); ?>

                                            </td>

                                            <td>
                                                Rp <?php echo e(number_format($sisa)); ?>

                                            </td>

                                            <td class="text-center">
                                                <?php echo e(number_format($persen, 2)); ?> %
                                            </td>



                                        </tr>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                            <tr>

                                <td colspan="9" class="text-center">
                                    Tidak ada data
                                </td>

                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>




    <!-- ========================= -->
    <!-- BELANJA -->
    <!-- ========================= -->

    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-success">
                Belanja
            </h6>
        </div>

        <div class="card-body">

            <!-- COUNTER -->
            <div class="row mb-4">

                <!-- TOTAL PAGU -->
                <div class="col-md-3 mb-3">

                    <div class="card border-left-primary shadow h-100 py-2">

                        <div class="card-body">

                            <div class="text-xs text-primary text-uppercase mb-1">
                                Total Pagu
                            </div>

                            <div class="h5 font-weight-bold text-gray-800">
                                Rp <?php echo e(number_format($totalPaguBelanja)); ?>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- REALISASI -->
                <div class="col-md-3 mb-3">

                    <div class="card border-left-success shadow h-100 py-2">

                        <div class="card-body">

                            <div class="text-xs text-success text-uppercase mb-1">
                                Realisasi
                            </div>

                            <div class="h5 font-weight-bold text-gray-800">
                                Rp <?php echo e(number_format($totalRealisasiBelanja)); ?>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- SISA -->
                <div class="col-md-3 mb-3">

                    <div class="card border-left-danger shadow h-100 py-2">

                        <div class="card-body">

                            <div class="text-xs text-danger text-uppercase mb-1">
                                Sisa
                            </div>

                            <div class="h5 font-weight-bold text-gray-800">
                                Rp <?php echo e(number_format($totalSisaBelanja)); ?>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- PERSENTASE -->
                <div class="col-md-3 mb-3">

                    <div class="card border-left-info shadow h-100 py-2">

                        <div class="card-body">

                            <div class="text-xs text-info text-uppercase mb-1">
                                Persentase
                            </div>

                            <div class="h5 font-weight-bold text-gray-800">
                                <?php echo e(number_format($persenBelanja, 2)); ?>%
                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <!-- TABLE -->
            <div class="table-responsive">

                <table class="table table-bordered table-hover">

                    <thead class="text-center thead-light">

                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Bidang</th>
                            <th>Jenis Kegiatan</th>
                            <th>Pagu</th>
                            <th>Realisasi</th>
                            <th>Sisa</th>
                            <th>Persentase</th>
                            <th>Dokumentasi</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php $__empty_1 = true; $__currentLoopData = $belanja; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                                        <?php
                                            $realisasi = optional($item->realisasi)->realisasi ?? 0;
                                            $sisa = $item->pagu - $realisasi;
                                            $persen = $item->pagu > 0
                                                ? ($realisasi / $item->pagu) * 100
                                                : 0;
                                        ?>

                                        <tr>

                                            <td><?php echo e($i + 1); ?></td>

                                            <td>
                                                <?php echo e($item->tanggal
                            ? \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y')
                            : '-'); ?>

                                            </td>

                                            <td>
                                                <?php echo e($item->bidang); ?>

                                            </td>

                                            <td>
                                                <?php echo e($item->jenis_kegiatan); ?>

                                            </td>

                                            <td>
                                                Rp <?php echo e(number_format($item->pagu)); ?>

                                            </td>

                                            <td>
                                                Rp <?php echo e(number_format($realisasi)); ?>

                                            </td>

                                            <td>
                                                Rp <?php echo e(number_format($sisa)); ?>

                                            </td>

                                            <td class="text-center">
                                                <?php echo e(number_format($persen, 2)); ?> %
                                            </td>
                                            </td>
                                            <td class="text-center">

                                                <?php if($item->dokumentasi && $item->dokumentasi->isNotEmpty()): ?>

                                                    <button class="btn btn-sm btn-success" data-toggle="modal"
                                                        data-target="#modalDokumentasi<?php echo e($item->id); ?>">

                                                        <i class="fas fa-image"></i>
                                                        Lihat

                                                    </button>

                                                <?php else: ?>

                                                    <span class="badge badge-secondary">
                                                        Tidak Ada
                                                    </span>

                                                <?php endif; ?>

                                            </td>

                                        </tr>
                                        <?php if($item->dokumentasi && $item->dokumentasi->isNotEmpty()): ?>

                                            <div class="modal fade" id="modalDokumentasi<?php echo e($item->id); ?>" tabindex="-1">

                                                <div class="modal-dialog modal-lg modal-dialog-centered">

                                                    <div class="modal-content">

                                                        <div class="modal-header">

                                                            <h5 class="modal-title">
                                                                Dokumentasi Kegiatan
                                                            </h5>

                                                            <button type="button" class="close" data-dismiss="modal">

                                                                &times;

                                                            </button>

                                                        </div>

                                                        <div class="modal-body text-center">

                                                            <?php $__currentLoopData = $item->dokumentasi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                                <img src="<?php echo e(asset('storage/' . $doc->file)); ?>"
                                                                    class="img-fluid rounded mb-3 shadow">

                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        <?php endif; ?>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                            <tr>

                                <td colspan="9" class="text-center">
                                    Tidak ada data
                                </td>

                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Asti\Kuliah\SMT 8\skripsi\simkeu-desa\resources\views/public/index.blade.php ENDPATH**/ ?>