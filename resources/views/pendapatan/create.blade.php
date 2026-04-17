@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        <h1 class="h3 mb-4 text-gray-800">Tambah Pendapatan</h1>

        <div class="card shadow">
            <div class="card-body">

                <form action="{{ route('pendapatan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- TANGGAL -->
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control">
                    </div>
                    <!-- KATEGORI -->
                    <div class="form-group">
                        <label>Kategori Pendapatan</label>
                        <select name="kategori_pendapatan" id="kategori" class="form-control" required>
                            <option value="">-- Pilih Kategori --</option>
                            <option value="Pendapatan Asli Desa">Pendapatan Asli Desa</option>
                            <option value="Pendapatan Transfer">Pendapatan Transfer</option>
                            <option value="Pendapatan Lain-lain">Pendapatan Lain-lain</option>
                        </select>
                    </div>

                    <!-- JENIS -->
                    <div class="form-group">
                        <label>Jenis Pendapatan</label>
                        <select name="jenis_pendapatan" id="jenis" class="form-control" required>
                            <option value="">-- Pilih Jenis --</option>
                        </select>
                    </div>

                    <!-- PAGU -->
                    <div class="form-group">
                        <label>Pagu</label>
                        <input type="number" name="pagu" id="pagu" class="form-control" required>
                    </div>

                    <!-- REALISASI -->
                    <div class="form-group">
                        <label>Realisasi</label>
                        <input type="number" name="realisasi" id="realisasi" class="form-control">
                    </div>

                    <!-- PREVIEW -->
                    <div class="form-group">
                        <label>Persentase</label>
                        <input type="text" id="persentase_preview" class="form-control" readonly>
                    </div>

                    {{-- DOKUMEN --}}
                    <div class="form-group">
                        <label>Unggah Dokumen Pendukung</label>
                        <input type="file" name="dokumen" class="form-control" accept="image/*,.pdf">
                        <small class="text-muted">
                            Upload foto dokumen / PDF
                        </small>
                    </div>

                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="{{ route('pendapatan.index') }}" class="btn btn-secondary">Kembali</a>

                </form>

            </div>
        </div>

    </div>

    <!-- SCRIPT DYNAMIC -->
    <script>
        const jenisOptions = {
            "Pendapatan Asli Desa": [
                "Tanah Kas Desa",
                "Lain-lain PADes"
            ],
            "Pendapatan Transfer": [
                "Dana Desa",
                "Alokasi Dana Desa",
                "Bagi Hasil Pajak & Retribusi"
            ],
            "Pendapatan Lain-lain": [
                "Kerjasama Antar Desa",
                "Bunga Bank"
            ]
        };

        document.getElementById('kategori').addEventListener('change', function () {
            const kategori = this.value;
            const jenisSelect = document.getElementById('jenis');

            // reset
            jenisSelect.innerHTML = '<option value="">-- Pilih Jenis --</option>';

            if (jenisOptions[kategori]) {
                jenisOptions[kategori].forEach(function (item) {
                    const option = document.createElement('option');
                    option.value = item;
                    option.text = item;
                    jenisSelect.appendChild(option);
                });
            }
        });
    </script>

    {{-- presentase realisasi --}}
    <script>
        const paguInput = document.getElementById('pagu');
        const realisasiInput = document.getElementById('realisasi');
        const preview = document.getElementById('persentase_preview');

        function hitung() {
            let pagu = parseFloat(paguInput.value) || 0;
            let realisasi = parseFloat(realisasiInput.value) || 0;

            let persen = pagu > 0 ? (realisasi / pagu) * 100 : 0;

            preview.value = persen.toFixed(2) + " %";
        }

        paguInput.addEventListener('input', hitung);
        realisasiInput.addEventListener('input', hitung);
    </script>

    {{-- kalender --}}
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const tanggalInput = document.getElementById("tanggal");

            // format YYYY-MM-DD
            const today = new Date().toISOString().split('T')[0];

            // set default
            tanggalInput.value = today;
        });
    </script>
@endsection