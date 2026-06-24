

<?php $__env->startSection('content'); ?>

    <div class="container-fluid">

        <h1 class="h3 mb-4 text-gray-800">Tambah Pendapatan</h1>

        <div class="main-form-card">

            <form action="<?php echo e(route('pendapatan.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <!-- TANGGAL -->
                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control">
                </div>
                
                <div class="ocr-section mb-4">

                    <label class="font-weight-bold">

                        Unggah Dokumen Pendukung (PDF)

                    </label>

                    <div class="border rounded p-2 text-center ocr-upload-box"
                        style="
                                                                                                                                                                                                                                                border:2px dashed #4e73df !important;
                                                                                                                                                                                                                                                background:#f8fbff;
                                                                                                                                                                                                                                            ">

                        <i class="fas fa-file-upload mb-2 text-primary"
                            style="
                                                                                                                             font-size:20px;
                                                                                                                                                                                                                                            ">
                        </i>



                        <div class="text-muted small mb-2">

                            Sistem akan membantu mengisi data otomatis

                        </div>

                        <input type="file" name="dokumen" id="dokumen" class="form-control" accept="image/*,.pdf"
                            style="max-width:500px;margin:auto;">

                    </div>

                    <div id="previewContainer" class="mt-3"></div>

                </div>


                
                <input type="hidden" name="kategori_pendapatan" id="kategori" required>

                <input type="hidden" name="jenis_pendapatan" id="jenis" required>

                <div class="folder-wrapper">
                    <label class="font-weight-bold ">

                        Pilih Kategori Pendapatan

                    </label>

                    <div class="folder-tabs">

                        <button type="button" class="folder-tab active" data-kategori="Pendapatan Asli Desa">

                            Pendapatan Asli Desa

                        </button>

                        <button type="button" class="folder-tab" data-kategori="Pendapatan Transfer">

                            Pendapatan Transfer

                        </button>

                        <button type="button" class="folder-tab" data-kategori="Pendapatan Lain-lain">

                            Pendapatan Lain-lain

                        </button>

                    </div>

                    <div class="folder-content">

                        <p class="font-weight-bold mb-3">

                            Pilih Jenis Pendapatan

                        </p>
                        

                        <div id="jenisContainer"></div>
                        <br>
                        <div class="mb-3">
                            <p class="font-weight-bold mb-3">Tahap</p>
                            <input type="text" name="tahap" class="form-control" placeholder="Contoh: Tahap 1">
                        </div>

                    </div>

                </div>

                <div class="folder-content mt-3">
                    <p class="font-weight-bold mb-4">

                        Detail Pendapatan

                    </p>
                    <!-- REALISASI -->
                    <div class="form-group">

                        <label class="font-weight-bold">
                            Realisasi Pendapatan
                        </label>

                        <input type="hidden" id="detected_realisasi">

                        <div id="warningNominal" class="alert alert-warning mt-2 py-3 px-3"
                            style="display:none; border-radius:10px;">

                            <div class="mb-2">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                <strong>Nominal berbeda dengan dokumen pendukung.</strong>
                            </div>

                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="verifikasiNominal">

                                <label class="custom-control-label" for="verifikasiNominal">
                                    Saya telah memeriksa kesesuaian data dengan dokumen pendukung.
                                </label>
                            </div>

                        </div>

                        <!-- tampil ke user -->
                        <input type="text" id="realisasi_display" class="form-control" placeholder="Rp 0">

                        <!-- dikirim ke database -->
                        <input type="hidden" name="realisasi" id="realisasi">

                    </div>


                    <!-- PAGU -->
                    <div class="form-group">

                        <label class="font-weight-bold">

                            Pagu Pendapatan

                        </label>

                        <input type="text" id="pagu_display" class="form-control" placeholder="Rp 0" required>

                        <input type="hidden" name="pagu" id="pagu">

                        <small class="text-muted">

                            Masukkan sesuai APBDes

                        </small>

                    </div>
                </div>





                <div class="action-buttons">

                    <button type="submit" class="btn btn-success" id="btnSimpan">
                        Simpan
                    </button>

                    <a href="<?php echo e(route('pendapatan.index')); ?>" class="btn btn-secondary">
                        Kembali
                    </a>

                </div>

            </form>


        </div>

    </div>

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

        function renderJenis(kategori) {

            document
                .getElementById('kategori')
                .value = kategori;

            const container =
                document.getElementById('jenisContainer');

            let html =
                '<div class="jenis-grid">';

            jenisOptions[kategori]
                .forEach(jenis => {

                    html += `

                                                                                                                                                    <div
                                                                                                                                                        class="jenis-card"
                                                                                                                                                        data-jenis="${jenis}">

                                                                                                                                                        <strong>

                                                                                                                                                            ${jenis}

                                                                                                                                                        </strong>

                                                                                                                                                    </div>

                                                                                                                                                `;

                });

            html += '</div>';

            container.innerHTML = html;
            const firstCard =
                container.querySelector('.jenis-card');

            if (firstCard) {

                firstCard.classList.add('active');

                document
                    .getElementById('jenis')
                    .value =
                    firstCard.dataset.jenis;
            }

            document
                .querySelectorAll('.jenis-card')
                .forEach(card => {

                    card.addEventListener('click', function () {

                        document
                            .querySelectorAll('.jenis-card')
                            .forEach(c =>
                                c.classList.remove('active'));

                        this.classList.add('active');

                        document
                            .getElementById('jenis')
                            .value =
                            this.dataset.jenis;

                    });

                });

        }

        document
            .querySelectorAll('.folder-tab')
            .forEach(tab => {

                tab.addEventListener('click', function () {

                    document
                        .querySelectorAll('.folder-tab')
                        .forEach(t =>
                            t.classList.remove('active'));

                    this.classList.add('active');

                    renderJenis(
                        this.dataset.kategori
                    );

                });

            });

        renderJenis('Pendapatan Asli Desa');

    </script>

    
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const tanggalInput = document.getElementById("tanggal");

            // format YYYY-MM-DD
            const today = new Date().toISOString().split('T')[0];

            // set default
            tanggalInput.value = today;
        });
    </script>

    <script>

        document.getElementById('dokumen')
            .addEventListener('change', async function (e) {

                const file = e.target.files[0];

                const previewContainer =
                    document.getElementById('previewContainer');

                previewContainer.innerHTML = '';

                if (!file) return;

                const ext =
                    file.name.split('.').pop().toLowerCase();

                // =========================
                // IMAGE PREVIEW
                // =========================

                if (['jpg', 'jpeg', 'png'].includes(ext)) {

                    const reader = new FileReader();

                    reader.onload = function (event) {

                        previewContainer.innerHTML = `

                                                                                                                                                                            <img src="${event.target.result}"
                                                                                                                                                                                 style="
                                                                                                                                                                                    max-width:100%;
                                                                                                                                                                                    border-radius:10px;
                                                                                                                                                                                 ">

                                                                                                                                                                        `;
                    };

                    reader.readAsDataURL(file);
                }

                // =========================
                // PDF PREVIEW
                // =========================

                else if (ext === 'pdf') {

                    const fileUrl =
                        URL.createObjectURL(file);

                    const fileSize =
                        (file.size / 1024 / 1024).toFixed(2);

                    previewContainer.innerHTML = `

                                                                                                                                                                    <div class="border rounded p-4"
                                                                                                                                                                         style="
                                                                                                                                                                            background:#f8fbff;
                                                                                                                                                                            border:1px solid #dbe8ff;
                                                                                                                                                                         ">

                                                                                                                                                                        <div class="d-flex align-items-center justify-content-between">

                                                                                                                                                                            <!-- LEFT -->
                                                                                                                                                                            <div class="d-flex align-items-center">

                                                                                                                                                                                <div class="mr-4">

                                                                                                                                                                                    <i class="fas fa-file-pdf"
                                                                                                                                                                                       style="
                                                                                                                                                                                            font-size:50px;
                                                                                                                                                                                            color:#dc3545;
                                                                                                                                                                                       ">
                                                                                                                                                                                    </i>

                                                                                                                                                                                </div>

                                                                                                                                                                                <div>

                                                                                                                                                                                    <div class="font-weight-bold text-dark"
                                                                                                                                                                                         style="font-size:18px;">

                                                                                                                                                                                        ${file.name}

                                                                                                                                                                                    </div>

                                                                                                                                                                                    <div class="text-muted small mb-2">

                                                                                                                                                                                        Ukuran file:
                                                                                                                                                                                        ${fileSize} MB

                                                                                                                                                                                    </div>

                                                                                                                                                                                    <div id="loadingText"
                                                                                                                                                                                         class="d-flex align-items-center text-primary">

                                                                                                                                                                                        <div class="spinner-border spinner-border-sm mr-2"
                                                                                                                                                                                             role="status">
                                                                                                                                                                                        </div>

                                                                                                                                                                                        <span>

                                                                                                                                                                                            Sedang membaca dokumen...

                                                                                                                                                                                        </span>

                                                                                                                                                                                    </div>

                                                                                                                                                                                </div>

                                                                                                                                                                            </div>

                                                                                                                                                                            <!-- RIGHT -->
                                                                                                                                                                            <div>

                                                                                                                                                                                <a href="${fileUrl}"
                                                                                                                                                                                   target="_blank"
                                                                                                                                                                                   class="btn btn-outline-primary btn-sm">

                                                                                                                                                                                    <i class="fas fa-eye mr-1"></i>

                                                                                                                                                                                    Preview

                                                                                                                                                                                </a>

                                                                                                                                                                            </div>

                                                                                                                                                                        </div>

                                                                                                                                                                    </div>

                                                                                                                                                                    `;

                    // =========================
                    // AUTO DETECT PDF
                    // =========================

                    const formData = new FormData();

                    formData.append('dokumen', file);

                    try {

                        const response = await fetch(
                            "<?php echo e(route('pendapatan.detect')); ?>",
                            {
                                method: 'POST',

                                headers: {
                                    'X-CSRF-TOKEN':
                                        '<?php echo e(csrf_token()); ?>'
                                },

                                body: formData
                            }
                        );

                        await new Promise(resolve =>
                            setTimeout(resolve, 1000)
                        );

                        const result = await response.json();

                        console.log(result);

                        // =========================
                        // SUCCESS
                        // =========================

                        if (result.success) {

                            const loadingText =
                                document.getElementById('loadingText');

                            if (loadingText) {

                                loadingText.innerHTML = `

                                                                                                                                                                                    <i class="fas fa-check-circle text-success mr-2"></i>

                                                                                                                                                                                    <span class="text-success">

                                                                                                                                                                                        Data berhasil dibaca

                                                                                                                                                                                    </span>

                                                                                                                                                                                `;
                            }

                            // kategori
                            if (result.kategori) {

                                const kategori =
                                    document.getElementById('kategori');

                                renderJenis(result.kategori);
                                document
                                    .querySelectorAll('.folder-tab')
                                    .forEach(tab => {

                                        tab.classList.remove('active');

                                        if (
                                            tab.dataset.kategori
                                            === result.kategori
                                        ) {
                                            tab.classList.add('active');
                                        }

                                    });

                                document
                                    .getElementById('kategori')
                                    .value =
                                    result.kategori;

                                setTimeout(() => {

                                    if (result.jenis) {

                                        document
                                            .getElementById('jenis')
                                            .value =
                                            result.jenis;

                                        document
                                            .querySelectorAll('.jenis-card')
                                            .forEach(card => {

                                                if (
                                                    card.dataset.jenis ===
                                                    result.jenis
                                                ) {

                                                    card.classList.add('active');

                                                }

                                            });
                                    }

                                }, 200);
                            }

                            // realisasi
                            if (result.realisasi) {

                                console.log('SEBELUM', document.getElementById('realisasi_display').value);

                                document.getElementById('realisasi').value =
                                    result.realisasi;

                                document.getElementById('detected_realisasi').value =
                                    result.realisasi;

                                document.getElementById('realisasi_display').value =
                                    'Rp ' + Number(result.realisasi).toLocaleString('id-ID');

                                console.log('SESUDAH', document.getElementById('realisasi_display').value);
                            }

                            const paguDisplay =
                                document.getElementById('pagu_display');

                            const paguHidden =
                                document.getElementById('pagu');

                            paguDisplay.addEventListener('input', function () {

                                let angka = this.value.replace(/\D/g, '');

                                paguHidden.value = angka;

                                this.value = angka
                                    ? 'Rp ' + Number(angka).toLocaleString('id-ID')
                                    : '';

                            });

                        }

                    } catch (error) {

                        console.error(error);

                        const loadingText =
                            document.getElementById('loadingText');

                        if (loadingText) {

                            loadingText.innerHTML = `

                                                                                                                                                                                <i class="fas fa-times-circle text-danger mr-2"></i>

                                                                                                                                                                                <span class="text-danger">

                                                                                                                                                                                    Gagal membaca dokumen

                                                                                                                                                                                </span>

                                                                                                                                                                            `;
                        }

                    }

                }

            });

    </script>

    <script>
        const realisasiDisplay =
            document.getElementById('realisasi_display');

        const realisasiHidden =
            document.getElementById('realisasi');

        realisasiDisplay.addEventListener('input', function () {

            let angka = this.value.replace(/\D/g, '');

            realisasiHidden.value = angka;

            this.value = angka
                ? 'Rp ' + Number(angka).toLocaleString('id-ID')
                : '';

        });

        const warningNominal =
            document.getElementById('warningNominal');

        const detectedRealisasi =
            document.getElementById('detected_realisasi');

        const btnSimpan =
            document.getElementById('btnSimpan');

        document.addEventListener('input', function () {

            const nominalDokumen =
                detectedRealisasi.value;

            const nominalInput =
                realisasiHidden.value;

            // belum ada hasil OCR
            if (!nominalDokumen) {
                warningNominal.style.display = 'none';
                btnSimpan.disabled = false;
                return;
            }

            if (nominalInput && nominalInput !== nominalDokumen) {

                warningNominal.style.display = 'block';

                const checkbox =
                    document.getElementById('verifikasiNominal');

                btnSimpan.disabled =
                    !checkbox.checked;

            } else {

                warningNominal.style.display = 'none';

                btnSimpan.disabled = false;

                const checkbox =
                    document.getElementById('verifikasiNominal');

                if (checkbox) {
                    checkbox.checked = false;
                }
            }

        });

        document.addEventListener('change', function (e) {

            if (e.target.id === 'verifikasiNominal') {

                btnSimpan.disabled =
                    !e.target.checked;

            }

        });
    </script>

    <style>
        .main-form-card {
            background: #fff;
            border-radius: 24px;
            padding: 28px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, .06);
        }

        .ocr-section {
            margin-bottom: 24px;
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

            font-size: .95rem;

            font-weight: 600;

            transition: .2s;

            cursor: pointer;
        }

        .folder-tab:hover {
            background: #dbe8ff;
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
            margin-bottom: 16px;
        }

        .folder-content h5 {
            margin-bottom: 8px !important;
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
            min-height: 48px;
            padding: 12px 18px;

            display: flex;

            width: 100%;

            align-items: center;
            justify-content: center;

            text-align: center;

            overflow-wrap: break-word;
            word-break: break-word;
        }

        .jenis-card:hover {
            border-color: #1a56db;
        }

        .jenis-card.active {

            background: #eff6ff;

            border: 2px solid #1a56db;

            color: #1a56db;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            font-weight: 600;
            color: #4b5563;
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

        h5 {
            font-weight: 700;
            color: #374151;
        }

        @media(max-width:768px) {

            .main-form-card {
                padding: 20px;
            }

            .folder-tabs {
                flex-direction: column;
            }

            .folder-tab {
                width: 100%;
            }

            .jenis-grid {
                grid-template-columns: 1fr;
            }

            .jenis-card {
                width: 100%;
                min-width: unset;
            }

            .jenis-card strong {
                font-size: .95rem;
                line-height: 1.4;
            }
        }

        .ocr-upload-box {
            max-width: 760px;
            margin: auto;
            background: #f8fbff;
            border: 2px dashed #4e73df !important;
        }

        .action-buttons {
            display: flex;
            gap: 12px;
            margin-top: 24px;
        }

        .action-buttons .btn {
            flex: 1;
        }

        @media(max-width:768px) {

            .action-buttons {
                flex-direction: column;
            }

            .action-buttons .btn {
                width: 100%;
            }

        }
    </style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Asti\Kuliah\SMT 8\skripsi\simkeu-desa\resources\views/pendapatan/create.blade.php ENDPATH**/ ?>