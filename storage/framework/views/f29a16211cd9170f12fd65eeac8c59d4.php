<?php $__env->startSection('content'); ?>

    <div class="container-fluid">

        <h1 class="h3 mb-4 text-gray-800">Detail Pendapatan</h1>

        <?php
            $realisasi = optional($data->realisasi)->realisasi ?? 0;
            $sisa = optional($data->realisasi)->sisa ?? ($data->pagu - $realisasi);

            $persentase = $data->pagu > 0
                ? ($realisasi / $data->pagu) * 100
                : 0;
        ?>

        <div class="card shadow">
            <div class="card-body">

                <table class="table table-bordered">
                    <tr>
                        <th>Tanggal</th>
                        <td>
                            <?php echo e($data->tanggal
        ? \Carbon\Carbon::parse($data->tanggal)->format('d-m-Y')
        : '-'); ?>

                        </td>
                    </tr>

                    <tr>
                        <th width="30%">Kategori Pendapatan</th>
                        <td><?php echo e($data->kategori_pendapatan); ?></td>
                    </tr>

                    <tr>
                        <th>Jenis Pendapatan</th>
                        <td><?php echo e($data->jenis_pendapatan); ?></td>
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
                        <th>Persentase Realisasi</th>
                        <td>
                            <span class="badge 
                                                                                        <?php if($persentase >= 80): ?> badge-success
                                                                                        <?php elseif($persentase >= 50): ?> badge-warning
                                                                                        <?php else: ?> badge-danger
                                                                                        <?php endif; ?>">
                                <?php echo e(number_format($persentase, 2)); ?> %
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Dokumen Pendukung</th>
                        <td>
                            <?php if($data->dokumen): ?>

                                <?php
                                    $ext = pathinfo($data->dokumen, PATHINFO_EXTENSION);
                                ?>

                                
                                <?php if(in_array($ext, ['jpg', 'jpeg', 'png'])): ?>
                                    <img src="<?php echo e(asset('storage/' . $data->dokumen)); ?>"
                                        style="max-width:100%; height:auto; border-radius:8px;">
                                <?php elseif($ext == 'pdf'): ?>
                                    <div class="border rounded p-3 bg-light">

                                        <p class="mb-2 text-gray-800">
                                            <i class="fas fa-file-pdf text-danger mr-2"></i>
                                            <?php echo e(basename($data->dokumen)); ?>

                                        </p>

                                        <a href="<?php echo e(asset('storage/' . $data->dokumen)); ?>" target="_blank"
                                            class="btn btn-primary btn-sm">
                                            <i class="fas fa-eye"></i> Lihat
                                        </a>

                                        <a href="<?php echo e(route('pendapatan.download', $data->id)); ?>" class="btn btn-success btn-sm">
                                            <i class="fas fa-download"></i> Unduh
                                        </a>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>

                            <br><br>

                            
                            


                        </td>
                    </tr>

                </table>

                <a href="<?php echo e(route('pendapatan.index')); ?>" class="btn btn-secondary">
                    Kembali
                </a>

            </div>
        </div>

    </div>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('scripts'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Asti\Kuliah\SMT 8\skripsi\simkeu-desa\resources\views/pendapatan/show.blade.php ENDPATH**/ ?>