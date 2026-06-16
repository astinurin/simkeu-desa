@extends('layouts.app')
@section('styles')
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
                grid-template-columns: 1fr;
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
@endsection
@section('content')
    <div class="container-fluid">

        <h1 class="h3 mb-4 text-gray-800">Edit Belanja</h1>

        <div class="card shadow">
            <div class="card-body">

                <form action="{{ route('belanja.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control"
                            value="{{ old('tanggal', $data->tanggal) }}">
                    </div>

                    {{-- <div class="form-group">
                        <label>Bidang</label>
                        <select name="bidang" id="bidang" class="form-control" required></select>
                    </div> --}}

                    <div class="form-group">

                        <label class="font-weight-bold">
                            Pilih Bidang
                        </label>

                        <input type="hidden" name="bidang" id="bidang" value="{{ old('bidang', $data->bidang) }}" required>

                        <div class="bidang-tabs">

                            <button type="button"
                                class="bidang-tab {{ $data->bidang == 'Bidang I - Penyelenggaraan Pemerintahan Desa' ? 'active' : '' }}"
                                data-value="Bidang I - Penyelenggaraan Pemerintahan Desa">
                                Bidang I
                            </button>

                            <button type="button"
                                class="bidang-tab {{ $data->bidang == 'Bidang II - Pelaksanaan Pembangunan Desa' ? 'active' : '' }}"
                                data-value="Bidang II - Pelaksanaan Pembangunan Desa">
                                Bidang II
                            </button>

                            <button type="button"
                                class="bidang-tab {{ $data->bidang == 'Bidang III - Pembinaan Kemasyarakatan' ? 'active' : '' }}"
                                data-value="Bidang III - Pembinaan Kemasyarakatan">
                                Bidang III
                            </button>

                            <button type="button"
                                class="bidang-tab {{ $data->bidang == 'Bidang IV - Pemberdayaan Masyarakat' ? 'active' : '' }}"
                                data-value="Bidang IV - Pemberdayaan Masyarakat">
                                Bidang IV
                            </button>

                            <button type="button"
                                class="bidang-tab {{ $data->bidang == 'Bidang V - Penanggulangan Bencana' ? 'active' : '' }}"
                                data-value="Bidang V - Penanggulangan Bencana">
                                Bidang V
                            </button>

                        </div>

                        <div id="bidang-info" class="bidang-info">
                            {{ $data->bidang }}
                        </div>

                    </div>

                    {{-- <div class="form-group">
                        <label>Jenis Kegiatan</label>
                        <select name="jenis_kegiatan" id="kegiatan" class="form-control" required></select>
                    </div> --}}

                    <div class="form-group">

                        <label class="font-weight-bold">Nama Kegiatan</label>

                        <input type="text" name="jenis_kegiatan" class="form-control"
                            value="{{ old('jenis_kegiatan', $data->jenis_kegiatan) }}" required>

                    </div>

                    <div class="form-group">

                        <label class="font-weight-bold">
                            Pilih Sumber Dana
                        </label> <br>
                        <small class="text-muted">

                            (Pilih semua sumber dana yang relevan dengan kegiatan belanja ini)

                        </small>

                        <div class="sumber-dana-grid">
                            @php
                                $selectedDana = $data->sumberDana->pluck('id')->toArray();
                            @endphp

                            @foreach($sumberDana as $item)

                                <div class="sumber-item">

                                    <label class="sumber-card">

                                        <input type="checkbox" class="sumber-checkbox" data-id="{{ $item->id }}"
                                            name="sumber_dana[]" value="{{ $item->id }}" {{ in_array($item->id, $selectedDana) ? 'checked' : '' }}>

                                        {{ $item->kode }} - {{ $item->nama }}

                                    </label>

                                    <div class="nominal-wrapper mt-2 {{ in_array($item->id, $selectedDana) ? '' : 'd-none' }}"
                                        id="nominal-{{ $item->id }}">

                                        <label>
                                            Nominal {{ $item->kode }}
                                        </label>
                                        <input type="text" class="form-control rupiah" name="nominal[{{ $item->id }}]" min="0"
                                            value="{{ optional(optional($data->sumberDana->find($item->id))->pivot)->nominal }}">
                                    </div>

                                </div>

                            @endforeach

                        </div>

                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Anggaran Kegiatan (Pagu)</label>
                        <input type="text" name="pagu" id="pagu" class="form-control rupiah"
                            value="{{ old('pagu', $data->pagu) }}">
                    </div>

                    <div class="form-group">

                        <label class="font-weight-bold">

                            Pajak (pbn, pbh, pajak daerah)

                        </label>

                        <input type="text" name="pajak" class="form-control rupiah placeholder-kecil"
                            value="{{ old('pajak', $data->pajak) }}">

                        {{-- <small class="text-muted">

                            Pajak sudah termasuk dalam nominal realisasi

                        </small> --}}

                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Realisasi Belanja</label> <br>
                        <small class="text-muted">
                            Masukkan total dana yang telah dibelanjakan untuk kegiatan ini.
                        </small>
                        <input type="text" name="realisasi_belanja" id="realisasi"
                            class="form-control rupiah placeholder-kecil" value="{{ old(
        'realisasi_belanja',
        optional($data->realisasi)->realisasi
    ) }}">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Sisa Anggaran</label> <br>
                         <small class="text-muted">
                            Lebih/(Kurang)
                        </small>
                        <input type="text" id="sisa_preview" class="form-control placeholder-kecil" readonly>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Persentase Realisasi Belanja</label>
                        <input type="text" id="persen_preview" class="form-control placeholder-kecil" readonly>
                    </div>

                    <div class="form-group">
                        @if($data->dokumentasi->count())

                            <div class="mb-3">

                                <label class="font-weight-bold">
                                    Dokumentasi Saat Ini
                                </label>

                                <div>

                                    @foreach($data->dokumentasi as $doc)

                                        <img src="{{ asset('storage/' . $doc->file) }}"
                                            style="
                                                                                                                                                                                max-width:250px;
                                                                                                                                                                                margin:10px;
                                                                                                                                                                                border-radius:10px;
                                                                                                                                                                            ">

                                    @endforeach

                                </div>

                            </div>

                        @endif
                        <label class="font-weight-bold">Dokumentasi kegiatan (gambar)</label>
                        <input type="file" name="dokumentasi[]" multiple accept="image/*" class="form-control">
                        <div id="preview" class="mt-2"></div>
                    </div>

                    <button class="btn btn-success">Simpan</button>
                    <a href="{{ route('belanja.index') }}" class="btn btn-secondary">Kembali</a>

                </form>

            </div>
        </div>

    </div>


    {{-- SCRIPT BIDANG + KEGIATAN --}}
    <script>
        const bidangInfo = document.getElementById('bidang-info');
        const bidangInput = document.getElementById('bidang');

        document.querySelectorAll('.bidang-tab')
            .forEach(btn => {

                btn.addEventListener('click', function () {

                    document.querySelectorAll('.bidang-tab')
                        .forEach(x => x.classList.remove('active'));

                    this.classList.add('active');

                    bidangInput.value = this.dataset.value;

                    bidangInfo.innerHTML = this.dataset.value;

                });

            });
        const pagu = document.getElementById('pagu');
        const realisasi = document.getElementById('realisasi');

        function hitung() {

            let p = parseInt(
                pagu.value.replace(/\D/g, '')
            ) || 0;

            let r = parseInt(
                realisasi.value.replace(/\D/g, '')
            ) || 0;

            let sisa = p - r;

            if (sisa < 0) {
                sisa = 0;
            }

            document.getElementById('sisa_preview').value =
                'Rp ' + sisa.toLocaleString('id-ID');

            document.getElementById('persen_preview').value =
                (p > 0 ? (r / p) * 100 : 0).toFixed(2) + ' %';
        }

        pagu.oninput = hitung;
        realisasi.oninput = hitung;

        document
            .querySelector('input[name="dokumentasi[]"]')
            .addEventListener('change', e => {

                const preview = document.getElementById('preview');

                preview.innerHTML = '';

                [...e.target.files].forEach(f => {

                    let r = new FileReader();

                    r.onload = ev =>
                        preview.innerHTML +=
                        `<img src="${ev.target.result}"
                                    style="max-width:800px;
                                    margin:10px;
                                    border-radius:8px;">`;

                    r.readAsDataURL(f);

                });

            });

        document
            .querySelectorAll('.sumber-checkbox')
            .forEach(cb => {

                cb.addEventListener('change', function () {

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


        document.querySelectorAll('.rupiah').forEach(input => {

            // format value lama saat edit dibuka
            if (input.value) {

                let angka = input.value.replace(/\D/g, '');

                input.value =
                    'Rp ' + Number(angka).toLocaleString('id-ID');
            }

            // format saat user mengetik
            input.addEventListener('input', function () {

                let angka = this.value.replace(/\D/g, '');

                this.value = angka
                    ? 'Rp ' + Number(angka).toLocaleString('id-ID')
                    : '';

                hitung();
            });

        });

        hitung();
    </script>

@endsection