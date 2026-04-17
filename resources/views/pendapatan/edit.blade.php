@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        <h1 class="h3 mb-4 text-gray-800">Edit Pendapatan</h1>

        <div class="card shadow">
            <div class="card-body">

                <form action="{{ route('pendapatan.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- TANGGAL -->
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" value="{{ $data->tanggal }}">
                    </div>

                    <!-- KATEGORI -->
                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="kategori_pendapatan" id="kategori" class="form-control">
                            <option value="Pendapatan Asli Desa" {{ $data->kategori_pendapatan == 'Pendapatan Asli Desa' ? 'selected' : '' }}>Pendapatan Asli Desa</option>
                            <option value="Pendapatan Transfer" {{ $data->kategori_pendapatan == 'Pendapatan Transfer' ? 'selected' : '' }}>Pendapatan Transfer</option>
                            <option value="Pendapatan Lain-lain" {{ $data->kategori_pendapatan == 'Pendapatan Lain-lain' ? 'selected' : '' }}>Pendapatan Lain-lain</option>
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
                        <input type="number" name="pagu" value="{{ $data->pagu }}" class="form-control">
                    </div>

                    {{-- Realisasi --}}
                    <div class="form-group">
                        <label>Realisasi</label>
                        <input type="number" name="realisasi" value="{{ optional($data->realisasi)->realisasi }}"
                            class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Persentase</label>
                        <input type="text" id="persentase_preview" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label>Dokumen Pendukung</label>

                        {{-- 🔥 PREVIEW DOKUMEN LAMA --}}
                        @if($data->dokumen)
                            @php
                                $ext = pathinfo($data->dokumen, PATHINFO_EXTENSION);
                            @endphp

                            <div class="mb-2">
                                @if(in_array($ext, ['jpg', 'jpeg', 'png']))
                                    <img src="{{ asset('storage/' . $data->dokumen) }}" style="max-width:200px; border-radius:5px;">
                                @elseif($ext == 'pdf')
                                    <iframe src="{{ asset('storage/' . $data->dokumen) }}" width="100%" height="200px"
                                        style="border:1px solid #ddd;"></iframe>
                                @endif
                            </div>
                        @endif

                        {{-- INPUT BARU --}}
                        <input type="file" name="dokumen" id="dokumenInput" class="form-control" accept="image/*,.pdf">
                        {{--
                        <small class="text-muted">
                            Kosongkan jika tidak ingin mengganti dokumen
                        </small> --}}
                        <div id="previewDokumen" class="mt-2"></div>
                    </div>

                    <button class="btn btn-primary">Update</button>
                    <a href="{{ route('pendapatan.index') }}" class="btn btn-secondary">Kembali</a>

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
        loadJenis("{{ $data->kategori_pendapatan }}", "{{ $data->jenis_pendapatan }}");

        kategoriSelect.addEventListener('change', function () {
            loadJenis(this.value);
        });
    </script>

    {{-- PRESENTASE --}}
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

    {{-- preview dokumen --}}
    <script>
        document.getElementById('dokumenInput').addEventListener('change', function (e) {
            const file = e.target.files[0];
            const preview = document.getElementById('previewDokumen');

            preview.innerHTML = '';

            if (!file) return;

            const url = URL.createObjectURL(file);

            // 🔥 IMAGE
            if (file.type.startsWith('image/')) {
                preview.innerHTML = `
                <div style="max-width:600px;">
                    <img src="${url}" 
                        style="width:100%; max-height:500px; object-fit:contain; border-radius:8px;">
                </div>
            `;
            }

            // 🔥 PDF
            else if (file.type === 'application/pdf') {
                preview.innerHTML = `
                <div style="width:100%;">
                    <iframe src="${url}" 
                        width="100%" height="600px"
                        style="border:1px solid #ddd; border-radius:8px;">
                    </iframe>
                </div>
            `;
            }

            // 🔥 FILE LAIN
            else {
                preview.innerHTML = `
                <small class="text-danger">
                    File tidak didukung 😅 (gunakan gambar / PDF)
                </small>
            `;
            }
        });
    </script>
@endsection