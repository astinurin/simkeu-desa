

<?php $__env->startSection('styles'); ?>
    <style>
        .main-form-card {
            background: #fff;
            border-radius: 24px;
            padding: 28px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, .06);
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            font-weight: 600;
            color: #4b5563;
        }

        .btn-success,
        .btn-secondary {

            height: 48px;

            min-width: 120px;

            border-radius: 14px;

            font-weight: 600;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            padding: 0 24px;

        }

        .doc-action-btn {
            width: 42px;
            height: 42px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            margin-left: 6px;

            border-radius: 12px;

            transition: .2s;
        }

        .btn-preview {
            background: #4e73df;
            color: #fff;
        }

        .btn-download {
            background: #2ecc71;
            color: #fff;
        }

        .btn-preview:hover,
        .btn-download:hover {
            color: #fff;
            opacity: .9;
        }
    </style>
    <style>
        .folder-content {
            background: #fafafa;
            border: 1px solid #ececec;
            border-radius: 16px;
            padding: 16px;
            margin-bottom: 16px;
        }

        .form-control {

            border-radius: 10px;

            min-height: 42px;

            border: 1px solid #d7dce3;
        }

        .form-control:focus {

            border-color: #1a56db;

            box-shadow:
                0 0 0 0.15rem rgba(26, 86, 219, .15);
        }

        .ocr-section {
            margin-bottom: 24px;
        }

        .ocr-upload-box {
            max-width: 820px;
            padding: 18px;
            margin: auto;
            background: #f8fbff;
            border: 2px dashed #4e73df !important;
        }

        .folder-tabs {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .folder-tab {
            border: none;
            background: #eef4ff;
            color: #1a56db;
            border-radius: 999px;
            padding: 10px 18px;
            font-weight: 600;
            cursor: pointer;
        }

        .folder-tab.active {
            background: #1a56db;
            color: #fff;
        }

        .jenis-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .jenis-card {
            background: #fff;
            border: 1px solid #dfe3ea;
            border-radius: 12px;
            min-width: 220px;
            padding: 12px 18px;
            text-align: center;
            cursor: pointer;
        }

        .jenis-card.active {
            background: #eff6ff;
            border: 2px solid #1a56db;
            color: #1a56db;
        }

        .folder-tabs {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .folder-tab {
            border: none;
            background: #eef4ff;
            color: #1a56db;
            border-radius: 999px;
            padding: 10px 18px;
            font-weight: 600;
        }

        .folder-tab.active {
            background: #1a56db;
            color: #fff;
        }

        .folder-content {
            background: #fafafa;
            border: 1px solid #ececec;
            border-radius: 16px;
            padding: 16px;
            margin-bottom: 20px;
        }

        .jenis-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .jenis-card {
            background: #fff;
            border: 1px solid #dfe3ea;
            border-radius: 12px;
            padding: 12px 18px;
            min-width: 220px;
            text-align: center;
            cursor: pointer;
        }

        .jenis-card.active {
            background: #eff6ff;
            border: 2px solid #1a56db;
            color: #1a56db;
            font-weight: 600;
        }
    </style>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="container-fluid">

        <h1 class="h3 mb-4 text-gray-800">Edit Pendapatan</h1>

        <div class="main-form-card">


            <form action="<?php echo e(route('pendapatan.update', $data->id)); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <!-- TANGGAL -->
                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" value="<?php echo e($data->tanggal); ?>">
                </div>
                <div class="folder-content">

                    <label class="font-weight-bold mb-3">
                        Pilih Kategori Pendapatan
                    </label>

                    <input type="hidden" name="kategori_pendapatan" id="kategori" value="<?php echo e($data->kategori_pendapatan); ?>">

                    <div class="folder-tabs mb-4">

                        <button type="button" class="folder-tab" data-kategori="Pendapatan Asli Desa">
                            Pendapatan Asli Desa
                        </button>

                        <button type="button" class="folder-tab" data-kategori="Pendapatan Transfer">
                            Pendapatan Transfer
                        </button>

                        <button type="button" class="folder-tab" data-kategori="Pendapatan Lain-lain">
                            Pendapatan Lain-lain
                        </button>

                    </div>

                    

                        <label class="font-weight-bold mb-4">
                            Pilih Jenis Pendapatan
                        </label>

                        <input type="hidden" name="jenis_pendapatan" id="jenis" value="<?php echo e($data->jenis_pendapatan); ?>">

                        <div id="jenisContainer" class="jenis-grid"></div>

                        
                    <div class="mb-3">
                        <br>
                        <label class="form-label">Tahap</label>
                        <input type="text" name="tahap" class="form-control" value="<?php echo e(old('tahap', $data->tahap)); ?>">
                    </div>
                </div>
                <div class="folder-content mt-3">

                    <p class="font-weight-bold mb-4">
                        Detail Pendapatan
                    </p>

                    <!-- PAGU -->
                    <div class="form-group">

                        <label>Pagu Pendapatan</label>

                        <input type="text" id="pagu_display" class="form-control">

                        <input type="hidden" name="pagu" id="pagu" value="<?php echo e($data->pagu); ?>">

                    </div>

                    
                    <div class="form-group">

                        <label>Realisasi Pendapatan</label>

                        <input type="text" id="realisasi_display" class="form-control">

                        <input type="hidden" name="realisasi" id="realisasi"
                            value="<?php echo e(optional($data->realisasi)->realisasi); ?>">

                    </div>

                </div>



                
                <div class="folder-content mt-3">

                    <p class="font-weight-bold mb-4">
                        Dokumen Pendukung
                    </p>

                    <div class="form-group">
                        

                        <?php if($data->dokumen): ?>
                            <?php
                                $ext = pathinfo($data->dokumen, PATHINFO_EXTENSION);
                            ?>

                            <?php if(in_array(strtolower($ext), ['jpg', 'jpeg', 'png'])): ?>
                                <img src="<?php echo e(asset('storage/' . $data->dokumen)); ?>"
                                    style="max-width:800px; margin:10px 0 20px 0; border-radius:8px; display:block;">


                            <?php endif; ?>
                        <?php endif; ?>
                        


                        <div class="border rounded p-2 text-center ocr-upload-box">

                            <div class="d-flex justify-content-center align-items-center mb-3">

                                <span class="text-muted">
                                    Unggah dokumen baru (opsional)
                                </span>



                            </div>

                            <input type="file" name="dokumen" id="dokumenInput" class="form-control" accept="image/*,.pdf"
                                style="max-width:500px;margin:auto;">


                        </div>
                        <?php if($data->dokumen): ?>

                            <a href="<?php echo e(asset('storage/' . $data->dokumen)); ?>" target="_blank"
                                class="doc-action-btn btn-preview ml-2">

                                <i class="fas fa-eye"></i>

                            </a>

                            <a href="<?php echo e(route('pendapatan.download', $data->id)); ?>" class="doc-action-btn btn-download ml-1">

                                <i class="fas fa-download"></i>

                            </a>

                        <?php endif; ?>

                        
                        <div id="previewDokumen" class="mt-2"></div>
                    </div>
                </div>


                <button class="btn btn-success px-4">
                    Update
                </button>
                <a href="<?php echo e(route('pendapatan.index')); ?>" class="btn btn-secondary ">Kembali</a>

            </form>


        </div>

    </div>



    
    

    
    <script>
        document.getElementById('dokumenInput').addEventListener('change', function (e) {
            const file = e.target.files[0];
            const preview = document.getElementById('previewDokumen');

            preview.innerHTML = '';

            if (!file) return;

            preview.innerHTML = `
                                                                                                                                <div class="card border-left-secondary shadow-sm">
                                                                                                                                    <div class="card-body d-flex justify-content-between align-items-center">
                                                                                                                                        <div>
                                                                                                                                            <i class="fas fa-file"></i>
                                                                                                                                            <span class="ml-2">${file.name}</span>
                                                                                                                                        </div>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                            `;
        });
    </script>

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const paguDisplay =
                document.getElementById('pagu_display');

            const paguHidden =
                document.getElementById('pagu');

            const realisasiDisplay =
                document.getElementById('realisasi_display');

            const realisasiHidden =
                document.getElementById('realisasi');

            // load awal
            if (paguHidden.value) {

                paguDisplay.value =
                    'Rp ' +
                    Number(paguHidden.value)
                        .toLocaleString('id-ID');
            }

            if (realisasiHidden.value) {

                realisasiDisplay.value =
                    'Rp ' +
                    Number(realisasiHidden.value)
                        .toLocaleString('id-ID');
            }

            // pagu
            paguDisplay.addEventListener('input', function () {

                let angka =
                    this.value.replace(/\D/g, '');

                paguHidden.value = angka;

                this.value =
                    angka
                        ? 'Rp ' +
                        Number(angka)
                            .toLocaleString('id-ID')
                        : '';

            });

            // realisasi
            realisasiDisplay.addEventListener('input', function () {

                let angka =
                    this.value.replace(/\D/g, '');

                realisasiHidden.value = angka;

                this.value =
                    angka
                        ? 'Rp ' +
                        Number(angka)
                            .toLocaleString('id-ID')
                        : '';

            });

        });

    </script>

    <script>

        const jenisOptions = {

            "Pendapatan Asli Desa": [
                "Hasil Pengelolaan TKD"
            ],

            "Pendapatan Transfer": [
                "Alokasi Dana Desa",
                "Dana Desa",
                "Pendapatan Bagi Hasil Pajak dan Retribusi"
            ],

            "Pendapatan Lain-lain": [
                "Bagi Hasil Kerjasama Antar Desa",
                "Bunga Bank"
            ]
        };

        const kategoriInput =
            document.getElementById('kategori');

        const jenisInput =
            document.getElementById('jenis');

        const jenisContainer =
            document.getElementById('jenisContainer');

        function renderJenis(kategori, selectedJenis = null) {

            jenisContainer.innerHTML = '';

            jenisOptions[kategori].forEach(item => {

                const card =
                    document.createElement('div');

                card.className = 'jenis-card';

                card.innerText = item;

                if (item === selectedJenis) {
                    card.classList.add('active');
                }

                card.addEventListener('click', function () {

                    document
                        .querySelectorAll('.jenis-card')
                        .forEach(el =>
                            el.classList.remove('active')
                        );

                    card.classList.add('active');

                    jenisInput.value = item;
                });

                jenisContainer.appendChild(card);

            });
        }

        document
            .querySelectorAll('.folder-tab')
            .forEach(tab => {

                if (
                    tab.dataset.kategori ===
                    kategoriInput.value
                ) {
                    tab.classList.add('active');
                }

                tab.addEventListener('click', function () {

                    document
                        .querySelectorAll('.folder-tab')
                        .forEach(el =>
                            el.classList.remove('active')
                        );

                    tab.classList.add('active');

                    kategoriInput.value =
                        tab.dataset.kategori;

                    jenisInput.value = '';

                    renderJenis(
                        tab.dataset.kategori
                    );
                });
            });

        renderJenis(
            kategoriInput.value,
            jenisInput.value
        );

    </script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Asti\Kuliah\SMT 8\skripsi\simkeu-desa\resources\views/pendapatan/edit.blade.php ENDPATH**/ ?>