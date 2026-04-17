@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        <!-- HEADER -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Pendapatan</h1>

            <a href="{{ route('pendapatan.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Data
            </a>
        </div>

        <!-- ALERT -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @php
            $totalPagu = 0;
            $totalRealisasi = 0;
            $totalSisa = 0;
        @endphp

        <div class="card shadow mb-4">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%">

                        <!-- HEADER -->
                        <thead class="text-center">
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Kategori Pendapatan</th>
                                <th>Jenis</th>
                                <th>Pagu</th>
                                <th>Realisasi</th>
                                <th>Sisa</th>
                                <th>Persentase</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <!-- BODY -->
                        <tbody>
                            @forelse($data as $item)

                                                @php
                                                    $realisasi = optional($item->realisasi)->realisasi ?? 0;
                                                    $sisa = optional($item->realisasi)->sisa ?? ($item->pagu - $realisasi);

                                                    $persentase = $item->pagu > 0
                                                        ? ($realisasi / $item->pagu) * 100
                                                        : 0;

                                                    $totalPagu += $item->pagu;
                                                    $totalRealisasi += $realisasi;
                                                    $totalSisa += $sisa;
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
                                                    <td>Rp {{ number_format($item->pagu) }}</td>
                                                    <td>Rp {{ number_format($realisasi) }}</td>
                                                    <td>Rp {{ number_format($sisa) }}</td>

                                                    <!-- PERSENTASE -->
                                                    <td class="text-center">
                                                        <span
                                                            class="badge 
                                                                                                                                                                                                                                                                                                                @if($persentase >= 80) badge-success
                                                                                                                                                                                                                                                                                                                @elseif($persentase >= 50) badge-warning
                                                                                                                                                                                                                                                                                                                @else badge-danger
                                                                                                                                                                                                                                                                                                                @endif">
                                                            {{ number_format($persentase, 2) }} %
                                                        </span>
                                                    </td>

                                                    <!-- AKSI -->
                                                    <td class="text-center">
                                                        <a href="{{ route('pendapatan.show', $item->id) }}" class="btn btn-info btn-sm p-1">
                                                            <i class="fas fa-eye"></i>
                                                        </a>

                                                        <a href="{{ route('pendapatan.edit', $item->id) }}" class="btn btn-warning btn-sm p-1">
                                                            <i class="fas fa-edit"></i>
                                                        </a>

                                                        <form action="{{ route('pendapatan.destroy', $item->id) }}" method="POST"
                                                            style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm p-1"
                                                                onclick="return confirm('Yakin menghapus data ini?')">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>

                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">Data kosong</td>
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
                                <td colspan="4" class="text-center">Total</td>
                                <td>Rp {{ number_format($totalPagu) }}</td>
                                <td>Rp {{ number_format($totalRealisasi) }}</td>
                                <td>Rp {{ number_format($totalSisa) }}</td>
                                <td>{{ number_format($totalPersentase, 2) }} %</td>
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

            // TAMBAH FILTER DATE
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

            // FILTER LOGIC
            $.fn.dataTable.ext.search.push(function (settings, data) {
                let bulan = $('#filterBulan').val();
                let tahun = $('#filterTahun').val();

                let tanggal = data[1];

                // 🔥 HANDLE NULL
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