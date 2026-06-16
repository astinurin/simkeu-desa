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

        .summary-label {

            color: #6b7280;

            font-size: .9rem;
        }

        .summary-value {

            font-size: 1.4rem;

            font-weight: 700;

            margin-top: 6px;
        }

        .table-card {

            background: white;

            border-radius: 20px;

            overflow: hidden;

            box-shadow:
                0 8px 25px rgba(0, 0, 0, .06);
        }

        .table-card .card-body {
            padding: 24px;
        }

        #dataTable {

            margin-top: 10px !important;
        }

        #dataTable thead th {

            background: #f8fafc;

            border: none;

            font-weight: 700;

            color: #374151;
        }

        #dataTable td {

            vertical-align: middle;
        }

        .badge {

            border-radius: 999px;

            padding: 8px 12px;
        }

        .btn-action {

            width: 36px;

            height: 36px;

            border-radius: 10px;

            display: inline-flex;

            align-items: center;

            justify-content: center;
        }

        @media(max-width:768px) {

            .page-title {
                font-size: 1.5rem;
            }

            .summary-grid {
                grid-template-columns: 1fr;
            }

        }
    </style>

@endsection

@section('content')

    <div class="container-fluid">

        <!-- HEADER -->
        <div class="page-header">

            <div>

                <h1 class="page-title">

                    Data Pendapatan

                </h1>

                <div class="page-subtitle">

                    Kelola data pendapatan desa

                </div>

            </div>

            <a href="{{ route('pendapatan.create') }}" class="btn btn-primary">

                <i class="fas fa-plus mr-2"></i>
                Tambah Data

            </a>

        </div>

        <!-- ALERT -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @php
$totalPagu = $data->sum('pagu');

$totalRealisasi = $data->sum(function($item){
    return optional($item->realisasi)->realisasi ?? 0;
});

// $totalSisa = $totalPagu - $totalRealisasi;

$totalPersentase =
    $totalPagu > 0
    ? ($totalRealisasi / $totalPagu) * 100
    : 0;
@endphp

        <div class="summary-grid">

            <div class="summary-card">

                <div class="summary-label">
                    Total Pagu
                </div>

                <div class="summary-value">
                    Rp {{ number_format($totalPagu, 0, ',', '.') }}
                </div>

            </div>

            <div class="summary-card">

                <div class="summary-label">
                    Total Realisasi
                </div>

                <div class="summary-value">
                    Rp {{ number_format($totalRealisasi, 0, ',', '.') }}
                </div>

            </div>

            {{-- <div class="summary-card">

                <div class="summary-label">
                    Total Sisa
                </div>

                <div class="summary-value">
                    Rp {{ number_format($totalSisa, 0, ',', '.'     ) }}
                </div>

            </div> --}}

            {{-- <div class="summary-card">

                <div class="summary-label">
                    Persentase
                </div>

                <div class="summary-value">
                    {{ number_format($totalPersentase, 2) }}%
                </div>

            </div> --}}

        </div>


        <div class="table-card">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%">

                        <!-- HEADER -->
                        <thead class="text-center">
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Kategori Pendapatan</th>
                                <th>Jenis Pendapatan</th>
                                <th>Tahap</th>
                                <th>Pagu Pendapatan</th>
                                <th>Realisasi Pendapatan</th>
                                {{-- <th>Sisa</th> --}}
                                <th>Persentase</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <!-- BODY -->
                        <tbody>
                            @forelse($data as $item)

                                                @php
                                                    $realisasi = optional($item->realisasi)->realisasi ?? 0;
                                                    // $sisa = optional($item->realisasi)->sisa ?? ($item->pagu - $realisasi);

                                                    $persentase = $item->pagu > 0
                                                        ? ($realisasi / $item->pagu) * 100
                                                        : 0;

                                                    // $totalPagu += $item->pagu;
                                                    // $totalRealisasi += $realisasi;
                                                    // $totalSisa += $sisa;
                                                @endphp

                                                <tr>
                                                    <td class="text-center">{{ $loop->iteration }}</td>

                                                    <!-- TANGGAL -->
                                                    <td>
                                                        {{ $item->tanggal
                                ? \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y')
                                : '-' }}
                                                    </td>

                                                    <td>{{ $item->kategori_pendapatan }}</td>
                                                    <td>{{ $item->jenis_pendapatan }}</td>
                                                    <td>{{ $item->tahap ?? '-' }}</td>
                                                    <td>Rp {{ number_format($item->pagu, 0, ',', '.') }}</td>
                                                    <td>Rp {{ number_format($realisasi, 0, ',', '.') }}</td>
                                                    {{-- <td>Rp {{ number_format($sisa, 0, ',', '.') }}</td> --}}

                                                    <!-- PERSENTASE -->
                                                    <td class="text-center">
                                                        <span
                                                            class="badge 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        @if($persentase >= 80) badge-success
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        @elseif($persentase >= 50) badge-warning
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        @else badge-danger
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        @endif">
                                                            {{ number_format($persentase, 2, ',', '.') }} %
                                                        </span>
                                                    </td>

                                                    <!-- AKSI -->
                                                    <td class="text-center">
                                                        <a href="{{ route('pendapatan.show', $item->id) }}" class="btn btn-info btn-action">
                                                            <i class="fas fa-eye"></i>
                                                        </a>

                                                        <a href="{{ route('pendapatan.edit', $item->id) }}" class="btn btn-warning btn-action">
                                                            <i class="fas fa-edit"></i>
                                                        </a>

                                                        <form action="{{ route('pendapatan.destroy', $item->id) }}" method="POST"
                                                            style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-action"
                                                                onclick="return confirm('Yakin menghapus data ini?')">
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

                        <!-- FOOTER -->
                        @php
                            $totalPersentase = $totalPagu > 0
                                ? ($totalRealisasi / $totalPagu) * 100
                                : 0;


                        @endphp



                        <tfoot>
                            <tr style="font-weight:bold; background:#f8f9fc;">
                                <td colspan="5" class="text-center">Total</td>
                                <td>Rp {{ number_format($totalPagu, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($totalRealisasi, 0, ',', '.') }}</td>
                                {{-- <td>Rp {{ number_format($totalSisa, 0, ',', '.') }}</td> --}}
                                <td>{{ number_format($totalPersentase, 2, ',', '.') }} %</td>
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

            // 🔥 TAMBAH FILTER TAHUN + BULAN
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

            // 🔥 FILTER LOGIC (SAMA KAYAK PENDAPATAN)
            $.fn.dataTable.ext.search.push(function (settings, data) {

                let bulan = $('#filterBulan').val();
                let tahun = $('#filterTahun').val();

                let tanggal = data[1]; // kolom tanggal

                // handle kosong
                if (!tanggal || tanggal === '-') {
                    return (bulan === "" && tahun === "");
                }

                let parts = tanggal.split('-');
                let bln = parts[1];
                let thn = parts[2];

                return (bulan === "" || bln === bulan) &&
                    (tahun === "" || thn === tahun);
            });

            $(document).on('change', '#filterBulan, #filterTahun', function () {
                table.draw();
            });

        });
    </script>


@endsection