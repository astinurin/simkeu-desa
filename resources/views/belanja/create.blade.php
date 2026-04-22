@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <h1 class="h3 mb-4 text-gray-800">Tambah Belanja</h1>

        <div class="card shadow">
            <div class="card-body">

                <form action="{{ route('belanja.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control">
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
                        <input type="number" name="pagu" id="pagu" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Realisasi</label>
                        <input type="number" name="realisasi_belanja" id="realisasi" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Persentase</label>
                        <input type="text" id="persen_preview" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label>Dokumentasi (gambar)</label>
                        <input type="file" name="dokumentasi[]" multiple accept="image/*" class="form-control">
                        <div id="preview" class="mt-2"></div>
                    </div>

                    <button class="btn btn-success">Simpan</button>
                    <a href="{{ route('belanja.index') }}" class="btn btn-secondary">Kembali</a>

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

        bidangSelect.innerHTML = `<option value="">-- Pilih Bidang --</option>`;
        kegiatanSelect.innerHTML = `<option value="">-- Pilih Jenis Kegiatan --</option>`;

        Object.keys(kegiatanMap).forEach(b => {
            bidangSelect.innerHTML += `<option value="${b}">${b}</option>`;
        });

        bidangSelect.addEventListener('change', function () {
            const selected = this.value;

            kegiatanSelect.innerHTML = `<option value="">-- Pilih Kegiatan --</option>`;

            if (kegiatanMap[selected]) {
                kegiatanMap[selected].forEach(k => {
                    kegiatanSelect.innerHTML += `<option value="${k}">${k}</option>`;
                });
            }
        });

        function hitung() {
            let p = parseFloat(pagu.value) || 0;
            let r = parseFloat(realisasi.value) || 0;
            persen_preview.value = (p > 0 ? (r / p) * 100 : 0).toFixed(2) + " %";
        }
        pagu.oninput = hitung;
        realisasi.oninput = hitung;

        document.querySelector('input[name="dokumentasi[]"]').addEventListener('change', e => {
            preview.innerHTML = '';
            [...e.target.files].forEach(f => {
                let r = new FileReader();
                r.onload = ev => preview.innerHTML += `<img src="${ev.target.result}" style="max-width:120px;margin:5px;">`;
                r.readAsDataURL(f);
            });
        });

        // tanggal
        document.addEventListener("DOMContentLoaded", function () {
            const tanggalInput = document.getElementById("tanggal");
            const today = new Date().toISOString().split('T')[0];
            tanggalInput.value = today;
        });
    </script>
@endsection