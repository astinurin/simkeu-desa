

<?php $__env->startSection('styles'); ?>

    <style>
        .page-header {

            display: flex;

            justify-content: space-between;

            align-items: center;

            margin-bottom: 24px;

            flex-wrap: wrap;

            gap: 16px;

        }

        .page-title {

            font-size: 2rem;

            font-weight: 700;

            color: #1f2937;

            margin: 0;
        }

        .page-subtitle {

            color: #6b7280;

            margin-top: 4px;
        }

        .summary-grid {

            display: grid;

            grid-template-columns:
                repeat(auto-fit, minmax(220px, 1fr));

            gap: 16px;

            margin-bottom: 24px;
        }

        .summary-card {

            background: white;

            border-radius: 20px;

            padding: 20px;

            box-shadow:
                0 8px 25px rgba(0, 0, 0, .06);
        }

        .summary-label {

            color: #6b7280;

            font-size: .9rem;
        }

        .summary-value {

            font-size: 1.4rem;

            font-weight: 700;

            margin-top: 6px;
        }

        .table-card {

            background: white;

            border-radius: 20px;

            overflow: hidden;

            box-shadow:
                0 8px 25px rgba(0, 0, 0, .06);
        }

        .table-card .card-body {
            padding: 24px;
        }

        #dataTable {

            margin-top: 10px !important;
        }

        #dataTable thead th {

            background: #f8fafc;

            border: none;

            font-weight: 700;

            color: #374151;
        }

        #dataTable td {

            vertical-align: middle;
        }

        .badge {

            border-radius: 999px;

            padding: 8px 12px;
        }

        .btn-action {

            width: 36px;

            height: 36px;

            border-radius: 10px;

            display: inline-flex;

            align-items: center;

            justify-content: center;
        }

        @media(max-width:768px) {

            .page-title {
                font-size: 1.5rem;
            }

            .summary-grid {
                grid-template-columns: 1fr;
            }

        }
    </style>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="container-fluid">

        <!-- HEADER -->
        <div class="page-header">

            <div>

                <h1 class="page-title">

                    Data Pendapatan

                </h1>

                <div class="page-subtitle">

                    Kelola data pendapatan desa

                </div>

            </div>

            <a href="<?php echo e(route('pendapatan.create')); ?>" class="btn btn-primary">

                <i class="fas fa-plus mr-2"></i>
                Tambah Data

            </a>

        </div>

        <!-- ALERT -->
        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <?php
$totalPagu = $data->sum('pagu');

$totalRealisasi = $data->sum(function($item){
    return optional($item->realisasi)->realisasi ?? 0;
});

// $totalSisa = $totalPagu - $totalRealisasi;

$totalPersentase =
    $totalPagu > 0
    ? ($totalRealisasi / $totalPagu) * 100
    : 0;
?>

        <div class="summary-grid">

            <div class="summary-card">

                <div class="summary-label">
                    Total Pagu
                </div>

                <div class="summary-value">
                    Rp <?php echo e(number_format($totalPagu)); ?>

                </div>

            </div>

            <div class="summary-card">

                <div class="summary-label">
                    Total Realisasi
                </div>

                <div class="summary-value">
                    Rp <?php echo e(number_format($totalRealisasi)); ?>

                </div>

            </div>

            

            

        </div>


        <div class="table-card">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%">

                        <!-- HEADER -->
                        <thead class="text-center">
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Kategori Pendapatan</th>
                                <th>Jenis</th>
                                <th>Tahap</th>
                                <th>Pagu</th>
                                <th>Realisasi Pendapatan</th>
                                
                                <th>Persentase</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <!-- BODY -->
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                                                <?php
                                                    $realisasi = optional($item->realisasi)->realisasi ?? 0;
                                                    // $sisa = optional($item->realisasi)->sisa ?? ($item->pagu - $realisasi);

                                                    $persentase = $item->pagu > 0
                                                        ? ($realisasi / $item->pagu) * 100
                                                        : 0;

                                                    // $totalPagu += $item->pagu;
                                                    // $totalRealisasi += $realisasi;
                                                    // $totalSisa += $sisa;
                                                ?>

                                                <tr>
                                                    <td class="text-center"><?php echo e($loop->iteration); ?></td>

                                                    <!-- TANGGAL -->
                                                    <td>
                                                        <?php echo e($item->tanggal
                                ? \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y')
                                : '-'); ?>

                                                    </td>

                                                    <td><?php echo e($item->kategori_pendapatan); ?></td>
                                                    <td><?php echo e($item->jenis_pendapatan); ?></td>
                                                    <td><?php echo e($item->tahap ?? '-'); ?></td>
                                                    <td>Rp <?php echo e(number_format($item->pagu)); ?></td>
                                                    <td>Rp <?php echo e(number_format($realisasi)); ?></td>
                                                    

                                                    <!-- PERSENTASE -->
                                                    <td class="text-center">
                                                        <span
                                                            class="badge 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <?php if($persentase >= 80): ?> badge-success
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <?php elseif($persentase >= 50): ?> badge-warning
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <?php else: ?> badge-danger
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <?php endif; ?>">
                                                            <?php echo e(number_format($persentase, 2)); ?> %
                                                        </span>
                                                    </td>

                                                    <!-- AKSI -->
                                                    <td class="text-center">
                                                        <a href="<?php echo e(route('pendapatan.show', $item->id)); ?>" class="btn btn-info btn-action">
                                                            <i class="fas fa-eye"></i>
                                                        </a>

                                                        <a href="<?php echo e(route('pendapatan.edit', $item->id)); ?>" class="btn btn-warning btn-action">
                                                            <i class="fas fa-edit"></i>
                                                        </a>

                                                        <form action="<?php echo e(route('pendapatan.destroy', $item->id)); ?>" method="POST"
                                                            style="display:inline;">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('DELETE'); ?>
                                                            <button type="submit" class="btn btn-danger btn-action"
                                                                onclick="return confirm('Yakin menghapus data ini?')">
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

                        <!-- FOOTER -->
                        <?php
                            $totalPersentase = $totalPagu > 0
                                ? ($totalRealisasi / $totalPagu) * 100
                                : 0;


                        ?>



                        <tfoot>
                            <tr style="font-weight:bold; background:#f8f9fc;">
                                <td colspan="5" class="text-center">Total</td>
                                <td>Rp <?php echo e(number_format($totalPagu)); ?></td>
                                <td>Rp <?php echo e(number_format($totalRealisasi)); ?></td>
                                
                                <td><?php echo e(number_format($totalPersentase, 2)); ?> %</td>
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

            // 🔥 TAMBAH FILTER TAHUN + BULAN
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

            // 🔥 FILTER LOGIC (SAMA KAYAK PENDAPATAN)
            $.fn.dataTable.ext.search.push(function (settings, data) {

                let bulan = $('#filterBulan').val();
                let tahun = $('#filterTahun').val();

                let tanggal = data[1]; // kolom tanggal

                // handle kosong
                if (!tanggal || tanggal === '-') {
                    return (bulan === "" && tahun === "");
                }

                let parts = tanggal.split('-');
                let bln = parts[1];
                let thn = parts[2];

                return (bulan === "" || bln === bulan) &&
                    (tahun === "" || thn === tahun);
            });

            $(document).on('change', '#filterBulan, #filterTahun', function () {
                table.draw();
            });

        });
    </script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Asti\Kuliah\SMT 8\skripsi\simkeu-desa\resources\views/pendapatan/index.blade.php ENDPATH**/ ?>