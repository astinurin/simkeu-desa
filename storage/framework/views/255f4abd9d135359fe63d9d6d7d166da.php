<?php $__env->startSection('content'); ?>
<div class="container-fluid">

    <!-- HEADER -->
    <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>




    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body d-flex justify-content-between align-items-center">

                    <div>
                        <h6 class="m-0 font-weight-bold text-gray-800">Quick Action</h6>
                        <small class="text-muted">Tambah data dengan cepat</small>
                    </div>

                    <div>
                        <a href="<?php echo e(route('pendapatan.create')); ?>" class="btn btn-success btn-sm mr-2">
                            + Pendapatan
                        </a>

                        <a href="<?php echo e(route('belanja.create')); ?>" class="btn btn-primary btn-sm">
                            + Belanja
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>




    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pendapatan</h6>
        </div>

        <div class="card-body">

            <!-- COUNTER -->
            <div class="row mb-4">

                <div class="col-md-3">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="text-xs text-primary">Total Pagu</div>
                            <div class="h5 font-weight-bold">
                                Rp <?php echo e(number_format($totalPaguPendapatan)); ?>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="text-xs text-success">Realisasi</div>
                            <div class="h5 font-weight-bold">
                                Rp <?php echo e(number_format($totalRealisasiPendapatan)); ?>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-body">
                            <div class="text-xs text-danger">Sisa</div>
                            <div class="h5 font-weight-bold">
                                Rp <?php echo e(number_format($totalSisaPendapatan)); ?>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="text-xs text-info">Persentase</div>
                            <div class="h5 font-weight-bold">
                                <?php echo e(number_format($persenPendapatan, 2)); ?>%
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- TABLE -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="text-center">
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
                                $persen = $item->pagu > 0 ? ($realisasi / $item->pagu) * 100 : 0;
                            ?>

                            <tr>
                                <td><?php echo e($i + 1); ?></td>
                                <td><?php echo e($item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') : '-'); ?></td>
                                <td><?php echo e($item->kategori_pendapatan); ?></td>
                                <td><?php echo e($item->jenis_pendapatan); ?></td>
                                <td>Rp <?php echo e(number_format($item->pagu)); ?></td>
                                <td>Rp <?php echo e(number_format($realisasi)); ?></td>
                                <td>Rp <?php echo e(number_format($sisa)); ?></td>
                                <td class="text-center">
                                    <?php echo e(number_format($persen, 2)); ?> %
                                </td>

                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada data</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>




    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Belanja</h6>
        </div>

        <div class="card-body">

            <!-- COUNTER -->
            <div class="row mb-4">

                <div class="col-md-3">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="text-xs text-primary">Total Pagu</div>
                            <div class="h5 font-weight-bold">
                                Rp <?php echo e(number_format($totalPaguBelanja)); ?>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="text-xs text-success">Realisasi</div>
                            <div class="h5 font-weight-bold">
                                Rp <?php echo e(number_format($totalRealisasiBelanja)); ?>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-body">
                            <div class="text-xs text-danger">Sisa</div>
                            <div class="h5 font-weight-bold">
                                Rp <?php echo e(number_format($totalSisaBelanja)); ?>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="text-xs text-info">Persentase</div>
                            <div class="h5 font-weight-bold">
                                <?php echo e(number_format($persenBelanja, 2)); ?>%
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- TABLE -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="text-center">
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
                                $persen = $item->pagu > 0 ? ($realisasi / $item->pagu) * 100 : 0;
                            ?>

                            <tr>
                                <td><?php echo e($i + 1); ?></td>
                                <td><?php echo e($item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') : '-'); ?></td>
                                <td><?php echo e($item->bidang); ?></td>
                                <td><?php echo e($item->jenis_kegiatan); ?></td>
                                <td>Rp <?php echo e(number_format($item->pagu)); ?></td>
                                <td>Rp <?php echo e(number_format($realisasi)); ?></td>
                                <td>Rp <?php echo e(number_format($sisa)); ?></td>
                                <td class="text-center">
                                    <?php echo e(number_format($persen, 2)); ?> %
                                </td>
                                <td class="text-center">
                                    <?php if($item->dokumentasi && $item->dokumentasi->isNotEmpty()): ?>
                                        <button class="btn btn-sm btn-success" data-toggle="modal"
                                            data-target="#modalDokumentasi<?php echo e($item->id); ?>">
                                            <i class="fas fa-image"></i> Lihat
                                        </button>
                                    <?php else: ?>
                                        <span class="badge badge-secondary">Tidak</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php if($item->dokumentasi && $item->dokumentasi->isNotEmpty()): ?>
                                <div class="modal fade" id="modalDokumentasi<?php echo e($item->id); ?>" tabindex="-1">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title">Dokumentasi Kegiatan</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body text-center">

                                                <?php $__currentLoopData = $item->dokumentasi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <img src="<?php echo e(asset('storage/' . $doc->file)); ?>"
                                                        style="max-width:100%; margin-bottom:15px; border-radius:10px;">
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>  
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada data</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php /**PATH C:\Asti\Kuliah\SMT 8\skripsi\simkeu-desa\resources\views/dashboard.blade.php ENDPATH**/ ?><?php /**PATH C:\Asti\Kuliah\SMT 8\skripsi\simkeu-desa\resources\views/dashboard.blade.php ENDPATH**/ ?>