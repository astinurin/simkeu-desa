

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Belanja</h1>
            <a href="<?php echo e(route('belanja.create')); ?>" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Data
            </a>
        </div>

        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <?php
            $totalPagu = 0;
            $totalRealisasi = 0;
            $totalSisa = 0;
        ?>

        <div class="card shadow mb-4">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%">
                        <thead class="text-center">
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Bidang</th>
                                <th>Nama Kegiatan</th>
                                <th>Pagu</th>
                                <th>Realisasi</th>
                                <th>Sisa</th>
                                <th>Persentase</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <?php
                                    $realisasi = optional($item->realisasi)->realisasi ?? $item->realisasi_belanja ?? 0;
                                    $sisa = optional($item->realisasi)->sisa_belanja ?? ($item->pagu - $realisasi);
                                    $persentase = $item->pagu > 0 ? ($realisasi / $item->pagu) * 100 : 0;

                                    $totalPagu += $item->pagu;
                                    $totalRealisasi += $realisasi;
                                    $totalSisa += $sisa;
                                ?>

                                <tr>
                                    <td class="text-center"><?php echo e($loop->iteration); ?></td>
                                    <td class="text-center">
                                        <?php echo e(\Carbon\Carbon::parse($item->tanggal)->format('d-m-Y')); ?>

                                    </td>
                                    <td><?php echo e($item->bidang); ?></td>
                                    <td><?php echo e($item->jenis_kegiatan); ?></td>
                                    <td>Rp <?php echo e(number_format($item->pagu)); ?></td>
                                    <td>Rp <?php echo e(number_format($realisasi)); ?></td>
                                    <td>Rp <?php echo e(number_format($sisa)); ?></td>
                                    <td class="text-center">
                                        <span class="badge
                                                                <?php if($persentase >= 80): ?> badge-success
                                                                <?php elseif($persentase >= 50): ?> badge-warning
                                                                <?php else: ?> badge-danger
                                                                <?php endif; ?>">
                                            <?php echo e(number_format($persentase, 2)); ?> %
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?php echo e(route('belanja.show', $item->id)); ?>" class="btn btn-info btn-sm p-1"><i
                                                class="fas fa-eye"></i></a>
                                        <a href="<?php echo e(route('belanja.edit', $item->id)); ?>" class="btn btn-warning btn-sm p-1"><i
                                                class="fas fa-edit"></i></a>
                                        <form action="<?php echo e(route('belanja.destroy', $item->id)); ?>" method="POST"
                                            style="display:inline;">
                                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                            <button class="btn btn-danger btn-sm p-1" onclick="return confirm('Hapus?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="8" class="text-center">Data kosong</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>

                        <?php
                            $totalPersen = $totalPagu > 0 ? ($totalRealisasi / $totalPagu) * 100 : 0;
                        ?>

                        <tfoot>
                            <tr style="font-weight:bold;background:#f8f9fc;">
                                <td colspan="4" class="text-center">Total</td>
                                <td>Rp <?php echo e(number_format($totalPagu)); ?></td>
                                <td>Rp <?php echo e(number_format($totalRealisasi)); ?></td>
                                <td>Rp <?php echo e(number_format($totalSisa)); ?></td>
                                <td><?php echo e(number_format($totalPersen, 2)); ?> %</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        $(document).ready(function () {

            var table = $('#dataTable').DataTable({
                pageLength: 5,
                lengthMenu: [5, 10, 25, 50],
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                }
            });

            // 🔥 TAMBAH DROPDOWN TAHUN + BULAN
            $('.dataTables_length').append(`
            <select id="filterTahun" class="form-control form-control-sm ml-2" style="width:130px; display:inline-block;">
                <option value="">Semua Tahun</option>
                <?php $__currentLoopData = $tahunList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $th): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($th); ?>"><?php echo e($th); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

            <select id="filterBulan" class="form-control form-control-sm ml-2" style="width:130px; display:inline-block;">
                <option value="">Semua Bulan</option>
                <option value="01">Jan</option>
                <option value="02">Feb</option>
                <option value="03">Mar</option>
                <option value="04">Apr</option>
                <option value="05">Mei</option>
                <option value="06">Jun</option>
                <option value="07">Jul</option>
                <option value="08">Agu</option>
                <option value="09">Sep</option>
                <option value="10">Okt</option>
                <option value="11">Nov</option>
                <option value="12">Des</option>
            </select>
        `);

            // 🔥 FILTER LOGIC
            $.fn.dataTable.ext.search.push(function (settings, data) {

                let bulan = $('#filterBulan').val();
                let tahun = $('#filterTahun').val();

                let tanggal = data[1]; // kolom tanggal

                if (!tanggal) return true;

                let parts = tanggal.split('-'); // format: dd-mm-yyyy
                let bln = parts[1];
                let thn = parts[2];

                return (bulan === "" || bln === bulan) &&
                    (tahun === "" || thn === tahun);
            });

            $('#filterTahun, #filterBulan').on('change', function () {
                table.draw();
            });

        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Asti\Kuliah\SMT 8\skripsi\simkeu-desa\resources\views/belanja/index.blade.php ENDPATH**/ ?>