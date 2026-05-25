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
                    {{-- DOKUMEN --}}
                    <div class="form-group mb-4">

                        <label class="font-weight-bold text-primary">

                            Upload Dokumen Pendukung

                        </label>

                        <div class="border rounded p-4 text-center" style="
                                                                                                        border:2px dashed #4e73df !important;
                                                                                                        background:#f8fbff;
                                                                                                    ">

                            <i class="fas fa-file-upload mb-3" style="
                                                                                                            font-size:42px;
                                                                                                            color:#4e73df;
                                                                                                    ">
                            </i>

                            <div class="font-weight-bold mb-2">

                                Unggah Dokumen (PDF)

                            </div>

                            <div class="text-muted small mb-3">

                                Sistem akan membantu mengisi data otomatis

                            </div>

                            <input type="file" name="dokumen" id="dokumen" class="form-control" accept="image/*,.pdf">

                        </div>

                        <div id="previewContainer" class="mt-3"></div>

                    </div>


                    <!-- KATEGORI -->
                    <div class="form-group">

                        <label class="font-weight-bold">

                            Kategori Pendapatan

                        </label>

                        <select name="kategori_pendapatan" id="kategori" class="form-control" required>

                            <option value="">-- Pilih Kategori --</option>

                            <option value="Pendapatan Asli Desa">

                                Pendapatan Asli Desa

                            </option>

                            <option value="Pendapatan Transfer">

                                Pendapatan Transfer

                            </option>

                            <option value="Pendapatan Lain-lain">

                                Pendapatan Lain-lain

                            </option>

                        </select>

                    </div>


                    <!-- JENIS -->
                    <div class="form-group">

                        <label class="font-weight-bold">

                            Jenis Pendapatan

                        </label>

                        <select name="jenis_pendapatan" id="jenis" class="form-control" required>

                            <option value="">-- Pilih Jenis --</option>

                        </select>

                    </div>


                    <!-- REALISASI -->
                    <div class="form-group">

                        <label class="font-weight-bold">

                            Realisasi

                        </label>
                        <input type="hidden" id="detected_realisasi">

                        <div id="warningNominal" class="alert alert-warning mt-2 py-2 px-3" style="
                    display:none;
                    border-radius:10px;
                 ">

                            <i class="fas fa-exclamation-triangle mr-2"></i>

                            Nominal telah diubah dari hasil pembacaan dokumen

                        </div>

                        <input type="number" name="realisasi" id="realisasi" class="form-control">

                    </div>


                    <!-- PAGU -->
                    <div class="form-group">

                        <label class="font-weight-bold">

                            Pagu

                        </label>

                        <input type="number" name="pagu" id="pagu" class="form-control" required>

                        <small class="text-muted">

                            Isi sesuai pagu/APBDes

                        </small>

                    </div>


                    <!-- PREVIEW -->
                    <div class="form-group">

                        <label class="font-weight-bold">

                            Persentase

                        </label>

                        <input type="text" id="persentase_preview" class="form-control" readonly>

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

        // =========================
        // VALIDASI NOMINAL
        // =========================

        realisasiInput.addEventListener('input', function () {

            const detected =
                parseFloat(
                    document.getElementById('detected_realisasi').value
                ) || 0;

            const current =
                parseFloat(this.value) || 0;

            const warning =
                document.getElementById('warningNominal');

            if (detected > 0 && current !== detected) {

                warning.style.display = 'block';

            } else {

                warning.style.display = 'none';
            }

        });
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
                            "{{ route('pendapatan.detect') }}",
                            {
                                method: 'POST',

                                headers: {
                                    'X-CSRF-TOKEN':
                                        '{{ csrf_token() }}'
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

                                kategori.value =
                                    result.kategori;

                                kategori.dispatchEvent(
                                    new Event('change')
                                );

                                setTimeout(() => {

                                    if (result.jenis) {

                                        document.getElementById('jenis')
                                            .value = result.jenis;
                                    }

                                }, 200);
                            }

                            // realisasi
                            if (result.realisasi) {

                                document.getElementById('realisasi')
                                    .value = result.realisasi;

                                // simpan nominal asli detect
                                document.getElementById('detected_realisasi')
                                    .value = result.realisasi;

                                hitung();
                            }

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
@endsection