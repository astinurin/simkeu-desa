

<?php $__env->startSection('content'); ?>

    <div class="container-fluid">

        <h1 class="h3 mb-4 text-gray-800">Edit Pendapatan</h1>

        <div class="card shadow">
            <div class="card-body">

                <form action="<?php echo e(route('pendapatan.update', $data->id)); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <!-- TANGGAL -->
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" value="<?php echo e($data->tanggal); ?>">
                    </div>

                    <!-- KATEGORI -->
                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="kategori_pendapatan" id="kategori" class="form-control">
                            <option value="Pendapatan Asli Desa" <?php echo e($data->kategori_pendapatan == 'Pendapatan Asli Desa' ? 'selected' : ''); ?>>Pendapatan Asli Desa</option>
                            <option value="Pendapatan Transfer" <?php echo e($data->kategori_pendapatan == 'Pendapatan Transfer' ? 'selected' : ''); ?>>Pendapatan Transfer</option>
                            <option value="Pendapatan Lain-lain" <?php echo e($data->kategori_pendapatan == 'Pendapatan Lain-lain' ? 'selected' : ''); ?>>Pendapatan Lain-lain</option>
                        </select>
                    </div>

                    <!-- JENIS -->
                    <div class="form-group">
                        <label>Jenis</label>
                        <select name="jenis_pendapatan" id="jenis" class="form-control"></select>
                    </div>

                    <!-- PAGU -->
                    <div class="form-group">
                        <label>Pagu</label>
                        <input type="number" name="pagu" value="<?php echo e($data->pagu); ?>" class="form-control">
                    </div>

                    
                    <div class="form-group">
                        <label>Realisasi</label>
                        <input type="number" name="realisasi" value="<?php echo e(optional($data->realisasi)->realisasi); ?>"
                            class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Persentase</label>
                        <input type="text" id="persentase_preview" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label>Dokumen Pendukung</label>

                        <?php if($data->dokumen): ?>
                            <div class="card border-left-info shadow-sm mb-3">
                                <div class="card-body d-flex justify-content-between align-items-center">

                                    <div>
                                        <i class="fas fa-file-alt text-primary"></i>
                                        <span class="ml-2"><?php echo e(basename($data->dokumen)); ?></span>
                                    </div>

                                    <div>
                                        <a href="<?php echo e(asset('storage/' . $data->dokumen)); ?>" target="_blank"
                                            class="btn btn-primary btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <a href="<?php echo e(route('pendapatan.download', $data->id)); ?>" class="btn btn-success btn-sm">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        <?php endif; ?>

                        
                        <input type="file" name="dokumen" id="dokumenInput" class="form-control" accept="image/*,.pdf">
                        
                        <div id="previewDokumen" class="mt-2"></div>
                    </div>

                    <button class="btn btn-primary">Update</button>
                    <a href="<?php echo e(route('pendapatan.index')); ?>" class="btn btn-secondary">Kembali</a>

                </form>

            </div>
        </div>

    </div>

    <script>
        const jenisOptions = {
            "Pendapatan Asli Desa": ["Tanah Kas Desa", "Lain-lain PADes"],
            "Pendapatan Transfer": ["Dana Desa", "Alokasi Dana Desa", "Bagi Hasil Pajak & Retribusi"],
            "Pendapatan Lain-lain": ["Kerjasama Antar Desa", "Bunga Bank"]
        };

        const kategoriSelect = document.getElementById('kategori');
        const jenisSelect = document.getElementById('jenis');

        function loadJenis(selectedKategori, selectedJenis = null) {
            jenisSelect.innerHTML = '';

            if (jenisOptions[selectedKategori]) {
                jenisOptions[selectedKategori].forEach(item => {
                    let selected = item === selectedJenis ? 'selected' : '';
                    jenisSelect.innerHTML += `<option value="${item}" ${selected}>${item}</option>`;
                });
            }
        }

        // load awal
        loadJenis("<?php echo e($data->kategori_pendapatan); ?>", "<?php echo e($data->jenis_pendapatan); ?>");

        kategoriSelect.addEventListener('change', function () {
            loadJenis(this.value);
        });
    </script>

    
    <script>
        const pagu = document.querySelector('input[name="pagu"]');
        const realisasi = document.querySelector('input[name="realisasi"]');
        const preview = document.getElementById('persentase_preview');

        function hitung() {
            let p = parseFloat(pagu.value) || 0;
            let r = parseFloat(realisasi.value) || 0;

            let persen = p > 0 ? (r / p) * 100 : 0;
            preview.value = persen.toFixed(2) + " %";
        }

        pagu.addEventListener('input', hitung);
        realisasi.addEventListener('input', hitung);

        hitung(); // load awal
    </script>

    
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Asti\Kuliah\SMT 8\skripsi\simkeu-desa\resources\views/pendapatan/edit.blade.php ENDPATH**/ ?>