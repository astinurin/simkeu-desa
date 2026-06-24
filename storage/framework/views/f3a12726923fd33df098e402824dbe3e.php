

<?php $__env->startSection('styles'); ?>
    <style>
        .sumber-item {
            margin-bottom: 15px;
        }

        .bidang-tabs {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 10px;
        }

        .bidang-tab {
            border: none;
            padding: 12px 22px;
            border-radius: 999px;
            background: #eef2ff;
            color: #1d4ed8;
            font-weight: 600;
            transition: .2s;
        }

        .bidang-tab.active {
            background: #1d4ed8;
            color: white;
        }

        .bidang-info {
            margin-top: 12px;
            background: #f8fafc;
            border-radius: 12px;
            padding: 12px 16px;
            color: #64748b;
        }

        .sumber-dana-grid {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .sumber-card {
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            padding: 14px;
            cursor: pointer;
            margin-bottom: 0;
        }

        .sumber-card:hover {
            border-color: #2563eb;
        }

        .sumber-card input {
            margin-right: 8px;
        }

        @media(max-width:768px) {

            .bidang-tabs {
                display: grid;
                grid-template-columns: 1fr;/
            }

            .sumber-dana-grid {
                grid-template-columns: 1fr;
            }

        }

        .placeholder-kecil::placeholder {
            font-size: 13px;

            color: #9CA3AF;
            opacity: .8;
        }

        .text-muted {
            font-size: 13px;
            color: #9CA3AF;
            opacity: .8;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">

        <h1 class="h3 mb-4 text-gray-800">Tambah Belanja</h1>

        <div class="card shadow">
            <div class="card-body">

                <form action="<?php echo e(route('belanja.store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control">
                    </div>

                    

                    <div class="form-group">

                        <label class="font-weight-bold">
                            Pilih Bidang
                        </label>

                        <input type="hidden" name="bidang" id="bidang" required>

                        <div class="bidang-tabs">

                            <button type="button" class="bidang-tab"
                                data-value="Bidang I - Penyelenggaraan Pemerintahan Desa">
                                Bidang I
                            </button>

                            <button type="button" class="bidang-tab" data-value="Bidang II - Pelaksanaan Pembangunan Desa">
                                Bidang II
                            </button>

                            <button type="button" class="bidang-tab" data-value="Bidang III - Pembinaan Kemasyarakatan">
                                Bidang III
                            </button>

                            <button type="button" class="bidang-tab" data-value="Bidang IV - Pemberdayaan Masyarakat">
                                Bidang IV
                            </button>

                            <button type="button" class="bidang-tab" data-value="Bidang V - Penanggulangan Bencana">
                                Bidang V
                            </button>

                        </div>

                        <div id="bidang-info" class="bidang-info text-gray-500">
                            Pilih bidang terlebih dahulu
                        </div>

                    </div>

                    

                    <div class="form-group">

                        <label class="font-weight-bold">Nama Kegiatan</label>

                        <input type="text" name="jenis_kegiatan" class="form-control placeholder-kecil"
                            placeholder="Contoh: Pembangunan Drainase RT 015 RW 003" required>

                    </div>

                    <div class="form-group">

                        <label class="font-weight-bold">
                            Pilih Sumber Dana
                        </label> <br>
                        <small class="text-muted">

                            (Pilih semua sumber dana yang relevan dengan kegiatan belanja ini)

                        </small>

                        <div class="sumber-dana-grid">

                            <?php $__currentLoopData = $sumberDana; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="sumber-item">

                                    <label class="sumber-card">

                                        <input type="checkbox" class="sumber-checkbox" data-id="<?php echo e($item->id); ?>"
                                            name="sumber_dana[]" value="<?php echo e($item->id); ?>">

                                        <?php echo e($item->kode); ?> - <?php echo e($item->nama); ?>


                                    </label>

                                    <div class="nominal-wrapper d-none mt-2" id="nominal-<?php echo e($item->id); ?>">

                                        <label>
                                            Nominal <?php echo e($item->kode); ?>

                                        </label>

                                        <input type="text" class="form-control rupiah"
                                            name="nominal[<?php echo e($item->id); ?>]" min="0">

                                    </div>

                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </div>

                    </div>

                    <?php if($errors->any()): ?>
    <div class="alert alert-danger">

        <ul class="mb-0">

            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </ul>

    </div>
<?php endif; ?>  

                    <div class="form-group">
                        <label class="font-weight-bold">Anggaran Kegiatan (Pagu)</label>


                        <input type="text" name="pagu" id="pagu" class="form-control rupiah placeholder-kecil"
                            placeholder="Rp0">
                    </div>

                    <div class="form-group">

                        <label class="font-weight-bold">

                            Pajak (pbn, pbh, pajak daerah)

                        </label>


                        <input type="text" name="pajak" class="form-control rupiah placeholder-kecil"
                            placeholder="Rp0">

                      

                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Realisasi Belanja</label><br>

                        <small class="text-muted">
                            Masukkan total dana yang telah dibelanjakan untuk kegiatan ini.
                        </small>
                        <input type="text" name="realisasi_belanja" id="realisasi"
                            class="form-control rupiah placeholder-kecil" placeholder="Contoh: Rp12000000">
                        

                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Sisa Anggaran</label> <br>
                        <small class="text-muted">
                            Lebih/(Kurang)
                        </small>
                        <input type="text" id="sisa_preview" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Persentase Realisasi Belanja</label>
                        <input type="text" id="persen_preview" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Dokumentasi kegiatan (gambar)</label>
                        <input type="file" name="dokumentasi[]" multiple accept="image/*" class="form-control">
                        <div id="preview" class="mt-2"></div>
                    </div>

                    <button class="btn btn-success">Simpan</button>
                    <a href="<?php echo e(route('belanja.index')); ?>" class="btn btn-secondary">Kembali</a>

                </form>

            </div>
        </div>

    </div>

    <script>
        const bidangInfo = document.getElementById('bidang-info');
        const bidangInput = document.getElementById('bidang');

        document.querySelectorAll('.bidang-tab')
            .forEach(btn => {

                btn.addEventListener('click', function() {

                    document.querySelectorAll('.bidang-tab')
                        .forEach(x => x.classList.remove('active'));

                    this.classList.add('active');

                    bidangInput.value = this.dataset.value;

                    bidangInfo.innerHTML = this.dataset.value;

                });

            });

        // bidangSelect.innerHTML = `<option value="">-- Pilih Bidang --</option>`;
        // kegiatanSelect.innerHTML = `<option value="">-- Pilih Jenis Kegiatan --</option>`;

        // Object.keys(kegiatanMap).forEach(b => {
        //     bidangSelect.innerHTML += `<option value="${b}">${b}</option>`;
        // });

        // bidangSelect.addEventListener('change', function () {
        //     const selected = this.value;

        //     kegiatanSelect.innerHTML = `<option value="">-- Pilih Kegiatan --</option>`;

        //     if (kegiatanMap[selected]) {
        //         kegiatanMap[selected].forEach(k => {
        //             kegiatanSelect.innerHTML += `<option value="${k}">${k}</option>`;
        //         });
        //     }
        // });

        function hitung() {

            let p = Number(
                pagu.value.replace(/\D/g, '')
            ) || 0;

            let r = Number(
                realisasi.value.replace(/\D/g, '')
            ) || 0;

            let sisa = p - r;

            if (sisa < 0) {
                sisa = 0;
            }

            document.getElementById('sisa_preview').value =
                'Rp ' + sisa.toLocaleString('id-ID');

            document.getElementById('persen_preview').value =
                (p > 0 ? (r / p) * 100 : 0).toFixed(2) + " %";
        }
        pagu.oninput = hitung;
        realisasi.oninput = hitung;

        document.querySelector('input[name="dokumentasi[]"]').addEventListener('change', e => {
            preview.innerHTML = '';
            [...e.target.files].forEach(f => {
                let r = new FileReader();
                r.onload = ev => preview.innerHTML +=
                    `<img src="${ev.target.result}"  style="max-width:800px; margin:10px; border-radius:8px;">`;
                r.readAsDataURL(f);
            });
        });

        // tanggal
        document.addEventListener("DOMContentLoaded", function() {
            const tanggalInput = document.getElementById("tanggal");
            const today = new Date().toISOString().split('T')[0];
            tanggalInput.value = today;
        });

        // sbr dana
        document
            .querySelectorAll('.sumber-checkbox')
            .forEach(cb => {

                cb.addEventListener('change', function() {

                    const target =
                        document.getElementById(
                            'nominal-' + this.dataset.id
                        );

                    if (this.checked) {
                        target.classList.remove('d-none');
                    } else {
                        target.classList.add('d-none');

                        target
                            .querySelector('input')
                            .value = '';
                    }

                });

            });


        // nambah rp 
        document.querySelectorAll('.rupiah')
            .forEach(input => {

                input.addEventListener('input', function() {

                    let angka =
                        this.value.replace(/\D/g, '');

                    this.value =
                        angka ?
                        'Rp ' + Number(angka).toLocaleString('id-ID') :
                        '';

                });

            });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Asti\Kuliah\SMT 8\skripsi\simkeu-desa\resources\views/belanja/create.blade.php ENDPATH**/ ?>