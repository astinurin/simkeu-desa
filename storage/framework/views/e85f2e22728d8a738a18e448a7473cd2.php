

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">

        <h1 class="h3 mb-4 text-gray-800">Edit Belanja</h1>

        <div class="card shadow">
            <div class="card-body">

                <form action="<?php echo e(route('belanja.update', $data->id)); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>

                    
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" value="<?php echo e($data->tanggal); ?>" class="form-control">
                    </div>

                    
                    <div class="form-group">
                        <label>Bidang</label>
                        <select name="bidang" id="bidang" class="form-control" required></select>
                    </div>

                    
                    <div class="form-group">
                        <label>Jenis Kegiatan</label>
                        <select name="jenis_kegiatan" id="kegiatan" class="form-control" required></select>
                    </div>

                    
                    <div class="form-group">
                        <label>Pagu</label>
                        <input type="number" name="pagu" value="<?php echo e($data->pagu); ?>" class="form-control">
                    </div>

                    
                    <div class="form-group">
                        <label>Realisasi</label>
                        <input type="number" name="realisasi_belanja" value="<?php echo e(optional($data->realisasi)->realisasi); ?>"
                            class="form-control">
                    </div>

                    
                    <div class="form-group">
                        <label>Dokumentasi</label><br>

                        <?php $__currentLoopData = $data->dokumentasi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <img src="<?php echo e(asset('storage/' . $doc->file)); ?>"
                                style="max-width:800px; margin:10px; border-radius:8px;">
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <input type="file" name="dokumentasi[]" multiple class="form-control mt-2">
                    </div>

                    <button class="btn btn-primary">Update</button>
                    <a href="<?php echo e(route('belanja.index')); ?>" class="btn btn-secondary">Kembali</a>

                </form>

            </div>
        </div>

    </div>


    
    <script>
        const kegiatanMap = {

            "Bidang I - Penyelenggaraan Pemerintahan Desa": [
                "Penyediaan Penghasilan Tetap dan Tunjangan Kepala Desa",
                "Penyediaan Penghasilan Tetap dan Tunjangan Perangkat Desa",
                "Penyediaan Operasional Pemerintah Desa (ATK, Honor PKPKD dan PPKD dll)",
                "Penyediaan Tunjangan BPD",
                "Penyediaan Operasional BPD",
                "Penyediaan Insentif/Operasional RT/RW",
                "Penyediaan Operasional Pemerintah Desa yang bersumber dari Dana Desa",
                "Sarana Prasana Kantor Desa",
                "Penyelenggaraan Musdes",
                "Penyusunan RKPDes",
                "Penyusunan Kebijakan Desa",
                "Pemungutan SPPT PBB"
            ],

            "Bidang II - Pelaksanaan Pembangunan Desa": [
                "Insentif Guru TPQ dan PAUD",
                "Penyelenggaraan Posyandu",
                "Pembangunan Drainase RT 002 RW 001",
                "Pembangunan Jalan Hotmix RT 011 RW 002",
                "Pembangunan Drainase RT 015 RW 003",
                "Pembangunan Drainase/Gorong-Gorong RT 017 RW 004",
                "Pembangunan Gorong-Gorong dan Pavingisasi",
                "Pembangunan Drainase RT 026 RW 006",
                "Pembangunan Jalan Rabat RT 033 RW 007",
                "Pelaksanaan Kegiatan PKTD",
                "Peningkatan Perekonomian Desa (30%)",
                "Ketahanan Pangan 20%"
            ],

            "Bidang III - Pembinaan Kemasyarakatan": [
                "Pembinaan LPMD",
                "Pembinaan KIM",
                "Pembinaan PB PANDAN",
                "Pembinaan SSB PANDAWA",
                "Peningkatan Kapasitas Linmas",
                "Pembinaan Forum Anak Desa (FAD)",
                "Pembinaan Swadeshi",
                "Pembinaan Ilal Ahad",
                "Pembinaan Kelompok Kesenian",
                "Operasional RW",
                "Operasional PKK"
            ],

            "Bidang IV - Pemberdayaan Masyarakat": [
                "Pelatihan PKK Desa dan PKK RW",
                "Pelatihan PKK"
            ],

            "Bidang V - Penanggulangan Bencana": [
                "BLT DD"
            ]
        };

        const bidangSelect = document.getElementById('bidang');
        const kegiatanSelect = document.getElementById('kegiatan');

        const selectedBidang = <?php echo json_encode($data->bidang, 15, 512) ?>;
        const selectedKegiatan = <?php echo json_encode($data->jenis_kegiatan, 15, 512) ?>;

        // isi bidang
        bidangSelect.innerHTML = `<option value="">-- Pilih Bidang --</option>`;
        Object.keys(kegiatanMap).forEach(b => {
            bidangSelect.innerHTML += `<option value="${b}" ${b === selectedBidang ? 'selected' : ''}>${b}</option>`;
        });

        // isi kegiatan saat load
        function loadKegiatan(bidang) {
            kegiatanSelect.innerHTML = `<option value="">-- Pilih Kegiatan --</option>`;

            if (kegiatanMap[bidang]) {
                kegiatanMap[bidang].forEach(k => {
                    kegiatanSelect.innerHTML += `<option value="${k}" ${k === selectedKegiatan ? 'selected' : ''}>${k}</option>`;
                });
            }
        }

        // trigger awal
        if (selectedBidang) {
            loadKegiatan(selectedBidang);
        }

        // kalau ganti bidang
        bidangSelect.addEventListener('change', function () {
            loadKegiatan(this.value);
        });
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Asti\Kuliah\SMT 8\skripsi\simkeu-desa\resources\views/belanja/edit.blade.php ENDPATH**/ ?>