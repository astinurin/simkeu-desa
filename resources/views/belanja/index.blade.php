@extends('layouts.app')

@section('styles')
    <style>
        .page-header {

            display: flex;

            justify-content: space-between;

            align-items: center;

            margin-bottom: 24px;

            flex-wrap: wrap;

            gap: 16px;

        }

        .page-title {

            font-size: 2rem;

            font-weight: 700;

            color: #1f2937;

            margin: 0;
        }

        .page-subtitle {

            color: #6b7280;

            margin-top: 4px;
        }

        .summary-grid {

            display: grid;

            grid-template-columns:
                repeat(auto-fit, minmax(220px, 1fr));

            gap: 16px;

            margin-bottom: 24px;
        }

        .summary-card {

            background: white;

            border-radius: 20px;

            padding: 20px;

            box-shadow:
                0 8px 25px rgba(0, 0, 0, .06);
        }

        .table-card {

            background: white;

            border-radius: 20px;

            overflow: hidden;

            box-shadow:
                0 8px 25px rgba(0, 0, 0, .06);
        }

        .btn-action {

            width: 36px;

            height: 36px;

            border-radius: 10px;

            display: inline-flex;

            align-items: center;

            justify-content: center;
        }
    </style>

@endsection
@section('content')
    <div class="container-fluid">

        <div class="page-header">

            <div>

                <h1 class="page-title">
                    Data Belanja
                </h1>

                <div class="page-subtitle">
                    Kelola data belanja desa
                </div>

            </div>

            <a href="{{ route('belanja.create') }}" class="btn btn-primary">

                <i class="fas fa-plus mr-2"></i>
                Tambah Data

            </a>

        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @php
            $totalPagu = 0;
            $totalPajak = 0;
            $totalRealisasi = 0;
            $totalSisa = 0;
        @endphp

        <div class="card shadow mb-4">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%">
                        <thead class="text-center">
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Bidang</th>
                                <th>Jenis Kegiatan</th>
                                <th>Sumber Dana</th>
                                <th>Pagu Kegiatan</th>
                                <th>Pajak</th>
                                <th>Realisasi Belanja</th>
                                <th>Sisa Anggaran</th>
                                <th>Persentase</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($data as $item)
                                @php
                                    $realisasi = optional($item->realisasi)->realisasi ?? $item->realisasi_belanja ?? 0;
                                    $sisa = optional($item->realisasi)->sisa_belanja ?? ($item->pagu - $realisasi);
                                    $persentase = $item->pagu > 0 ? ($realisasi / $item->pagu) * 100 : 0;

                                    $totalPagu += $item->pagu;
                                    $totalPajak += is_numeric($item->pajak)
                                        ? $item->pajak
                                        : 0;
                                    $totalRealisasi += $realisasi;
                                    $totalSisa += $sisa;
                                @endphp

                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">
                                        {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}
                                    </td>
                                    <td>{{ $item->bidang }}</td>
                                    <td>{{ $item->jenis_kegiatan }}</td>
                                    <td>

                                        @foreach($item->sumberDana as $sd)

                                            <span class="badge badge-info mr-1">

                                                {{ $sd->kode }}

                                            </span>

                                        @endforeach

                                    </td>
                                    <td>Rp {{ number_format($item->pagu) }}</td>
                                    <td>
                                        Rp {{ $item->pajak ?? '-' }}
                                    </td>
                                    <td>Rp {{ number_format($realisasi) }}</td>
                                    <td>Rp {{ number_format($sisa) }}</td>
                                    <td class="text-center">
                                        <span class="badge
                                                                                                                @if($persentase >= 80) badge-success
                                                                                                                @elseif($persentase >= 50) badge-warning
                                                                                                                @else badge-danger
                                                                                                                @endif">
                                            {{ number_format($persentase, 2) }} %
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('belanja.show', $item->id) }}" class="btn btn-info btn-action"><i
                                                class="fas fa-eye"></i></a>
                                        <a href="{{ route('belanja.edit', $item->id) }}" class="btn btn-warning btn-action"><i
                                                class="fas fa-edit"></i></a>
                                        <form action="{{ route('belanja.destroy', $item->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-danger btn-action" onclick="return confirm('Hapus?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Data kosong</td>
                                </tr>
                            @endforelse
                        </tbody>

                        @php
                            $totalPersen = $totalPagu > 0 ? ($totalRealisasi / $totalPagu) * 100 : 0;
                        @endphp
                        <div class="summary-grid">

                            <div class="summary-card">

                                <div class="summary-label">
                                    Total Pagu
                                </div>

                                <div class="summary-value">
                                    Rp {{ number_format($totalPagu) }}
                                </div>

                            </div>

                            <div class="summary-card">

                                <div class="summary-label">
                                    Total Realisasi
                                </div>

                                <div class="summary-value">
                                    Rp {{ number_format($totalRealisasi) }}
                                </div>

                            </div>

                        </div>

                        <tfoot>
                            <tr style="font-weight:bold;background:#f8f9fc;">

                                <td colspan="6" class="text-center">

                                    Total

                                </td>

                                <td>

                                    Rp {{ number_format($totalPagu) }}

                                </td>

                                <td>

                                    Rp {{ number_format($totalPajak) }}

                                </td>

                                <td>

                                    Rp {{ number_format($totalRealisasi) }}

                                </td>

                                <td>

                                    Rp {{ number_format($totalSisa) }}

                                </td>

                                <td>

                                    {{ number_format($totalPersen, 2) }} %

                                </td>

                                <td></td>

                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {

            var table = $('#dataTable').DataTable({
                pageLength: 5,
                lengthMenu: [5, 10, 25, 50],
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                }
            });

            // 🔥 TAMBAH DROPDOWN TAHUN + BULAN
            $('.dataTables_length').append(`
                                    <select id="filterTahun" class="form-control form-control-sm ml-2" style="width:130px; display:inline-block;">
                                        <option value="">Semua Tahun</option>
                                        @foreach($tahunList as $th)
                                            <option value="{{ $th }}">{{ $th }}</option>
                                        @endforeach
                                    </select>

                                    <select id="filterBulan" class="form-control form-control-sm ml-2" style="width:130px; display:inline-block;">
                                        <option value="">Semua Bulan</option>
                                        <option value="01">Jan</option>
                                        <option value="02">Feb</option>
                                        <option value="03">Mar</option>
                                        <option value="04">Apr</option>
                                        <option value="05">Mei</option>
                                        <option value="06">Jun</option>
                                        <option value="07">Jul</option>
                                        <option value="08">Agu</option>
                                        <option value="09">Sep</option>
                                        <option value="10">Okt</option>
                                        <option value="11">Nov</option>
                                        <option value="12">Des</option>
                                    </select>
                                `);

            // 🔥 FILTER LOGIC
            $.fn.dataTable.ext.search.push(function (settings, data) {

                let bulan = $('#filterBulan').val();
                let tahun = $('#filterTahun').val();

                let tanggal = data[1]; // kolom tanggal

                if (!tanggal) return true;

                let parts = tanggal.split('-'); // format: dd-mm-yyyy
                let bln = parts[1];
                let thn = parts[2];

                return (bulan === "" || bln === bulan) &&
                    (tahun === "" || thn === tahun);
            });

            $('#filterTahun, #filterBulan').on('change', function () {
                table.draw();
            });

        });
    </script>
@endsection