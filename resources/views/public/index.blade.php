@extends('layouts.public')

@section('content')

    <!-- HERO -->
    <div class="text-center mb-5">

        <h1 class="font-weight-bold text-gray-900 mb-3">
            Anggaran Pendapatan dan Belanja Desa
        </h1>

        <h2 class="h3 text-primary font-weight-bold mb-2">
            Desa Pandanlandung
        </h2>


        <p class="text-muted mb-1">
            Tahun Anggaran {{ $tahun }}
        </p>

        <p class="text-gray-500 small">
            {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}
        </p>

    </div>



    <!-- ========================= -->
    <!-- PENDAPATAN -->
    <!-- ========================= -->

    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Pendapatan
            </h6>
        </div>

        <div class="card-body">

            <!-- COUNTER -->
            <div class="row mb-4">

                <!-- TOTAL PAGU -->
                <div class="col-md-3 mb-3">

                    <div class="card border-left-primary shadow h-100 py-2">

                        <div class="card-body">

                            <div class="text-xs text-primary text-uppercase mb-1">
                                Total Pagu
                            </div>

                            <div class="h5 font-weight-bold text-gray-800">
                                Rp {{ number_format($totalPaguPendapatan) }}
                            </div>

                        </div>

                    </div>

                </div>

                <!-- REALISASI -->
                <div class="col-md-3 mb-3">

                    <div class="card border-left-success shadow h-100 py-2">

                        <div class="card-body">

                            <div class="text-xs text-success text-uppercase mb-1">
                                Realisasi
                            </div>

                            <div class="h5 font-weight-bold text-gray-800">
                                Rp {{ number_format($totalRealisasiPendapatan) }}
                            </div>

                        </div>

                    </div>

                </div>

                <!-- SISA -->
                <div class="col-md-3 mb-3">

                    <div class="card border-left-danger shadow h-100 py-2">

                        <div class="card-body">

                            <div class="text-xs text-danger text-uppercase mb-1">
                                Sisa
                            </div>

                            <div class="h5 font-weight-bold text-gray-800">
                                Rp {{ number_format($totalSisaPendapatan) }}
                            </div>

                        </div>

                    </div>

                </div>

                <!-- PERSENTASE -->
                <div class="col-md-3 mb-3">

                    <div class="card border-left-info shadow h-100 py-2">

                        <div class="card-body">

                            <div class="text-xs text-info text-uppercase mb-1">
                                Persentase
                            </div>

                            <div class="h5 font-weight-bold text-gray-800">
                                {{ number_format($persenPendapatan, 2) }}%
                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <!-- TABLE -->
            <div class="table-responsive">

                <table class="table table-bordered table-hover">

                    <thead class="text-center thead-light">

                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Kategori Pendapatan</th>
                            <th>Jenis Pendapatan</th>
                            <th>Pagu</th>
                            <th>Realisasi</th>
                            <th>Sisa</th>
                            <th>Persentase</th>


                        </tr>

                    </thead>

                    <tbody>

                        @forelse($pendapatan as $i => $item)

                                        @php
                                            $realisasi = optional($item->realisasi)->realisasi ?? 0;
                                            $sisa = $item->pagu - $realisasi;
                                            $persen = $item->pagu > 0
                                                ? ($realisasi / $item->pagu) * 100
                                                : 0;
                                        @endphp

                                        <tr>

                                            <td>{{ $i + 1 }}</td>

                                            <td>
                                                {{ $item->tanggal
                            ? \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y')
                            : '-' }}
                                            </td>

                                            <td>
                                                {{ $item->kategori_pendapatan }}
                                            </td>

                                            <td>
                                                {{ $item->jenis_pendapatan }}
                                            </td>

                                            <td>
                                                Rp {{ number_format($item->pagu) }}
                                            </td>

                                            <td>
                                                Rp {{ number_format($realisasi) }}
                                            </td>

                                            <td>
                                                Rp {{ number_format($sisa) }}
                                            </td>

                                            <td class="text-center">
                                                {{ number_format($persen, 2) }} %
                                            </td>



                                        </tr>

                        @empty

                            <tr>

                                <td colspan="9" class="text-center">
                                    Tidak ada data
                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>




    <!-- ========================= -->
    <!-- BELANJA -->
    <!-- ========================= -->

    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-success">
                Belanja
            </h6>
        </div>

        <div class="card-body">

            <!-- COUNTER -->
            <div class="row mb-4">

                <!-- TOTAL PAGU -->
                <div class="col-md-3 mb-3">

                    <div class="card border-left-primary shadow h-100 py-2">

                        <div class="card-body">

                            <div class="text-xs text-primary text-uppercase mb-1">
                                Total Pagu
                            </div>

                            <div class="h5 font-weight-bold text-gray-800">
                                Rp {{ number_format($totalPaguBelanja) }}
                            </div>

                        </div>

                    </div>

                </div>

                <!-- REALISASI -->
                <div class="col-md-3 mb-3">

                    <div class="card border-left-success shadow h-100 py-2">

                        <div class="card-body">

                            <div class="text-xs text-success text-uppercase mb-1">
                                Realisasi
                            </div>

                            <div class="h5 font-weight-bold text-gray-800">
                                Rp {{ number_format($totalRealisasiBelanja) }}
                            </div>

                        </div>

                    </div>

                </div>

                <!-- SISA -->
                <div class="col-md-3 mb-3">

                    <div class="card border-left-danger shadow h-100 py-2">

                        <div class="card-body">

                            <div class="text-xs text-danger text-uppercase mb-1">
                                Sisa
                            </div>

                            <div class="h5 font-weight-bold text-gray-800">
                                Rp {{ number_format($totalSisaBelanja) }}
                            </div>

                        </div>

                    </div>

                </div>

                <!-- PERSENTASE -->
                <div class="col-md-3 mb-3">

                    <div class="card border-left-info shadow h-100 py-2">

                        <div class="card-body">

                            <div class="text-xs text-info text-uppercase mb-1">
                                Persentase
                            </div>

                            <div class="h5 font-weight-bold text-gray-800">
                                {{ number_format($persenBelanja, 2) }}%
                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <!-- TABLE -->
            <div class="table-responsive">

                <table class="table table-bordered table-hover">

                    <thead class="text-center thead-light">

                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Bidang</th>
                            <th>Jenis Kegiatan</th>
                            <th>Pagu</th>
                            <th>Realisasi</th>
                            <th>Sisa</th>
                            <th>Persentase</th>
                            <th>Dokumentasi</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($belanja as $i => $item)

                                        @php
                                            $realisasi = optional($item->realisasi)->realisasi ?? 0;
                                            $sisa = $item->pagu - $realisasi;
                                            $persen = $item->pagu > 0
                                                ? ($realisasi / $item->pagu) * 100
                                                : 0;
                                        @endphp

                                        <tr>

                                            <td>{{ $i + 1 }}</td>

                                            <td>
                                                {{ $item->tanggal
                            ? \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y')
                            : '-' }}
                                            </td>

                                            <td>
                                                {{ $item->bidang }}
                                            </td>

                                            <td>
                                                {{ $item->jenis_kegiatan }}
                                            </td>

                                            <td>
                                                Rp {{ number_format($item->pagu) }}
                                            </td>

                                            <td>
                                                Rp {{ number_format($realisasi) }}
                                            </td>

                                            <td>
                                                Rp {{ number_format($sisa) }}
                                            </td>

                                            <td class="text-center">
                                                {{ number_format($persen, 2) }} %
                                            </td>
                                            </td>
                                            <td class="text-center">

                                                @if($item->dokumentasi && $item->dokumentasi->isNotEmpty())

                                                    <button class="btn btn-sm btn-success" data-toggle="modal"
                                                        data-target="#modalDokumentasi{{ $item->id }}">

                                                        <i class="fas fa-image"></i>
                                                        Lihat

                                                    </button>

                                                @else

                                                    <span class="badge badge-secondary">
                                                        Tidak Ada
                                                    </span>

                                                @endif

                                            </td>

                                        </tr>
                                        @if($item->dokumentasi && $item->dokumentasi->isNotEmpty())

                                            <div class="modal fade" id="modalDokumentasi{{ $item->id }}" tabindex="-1">

                                                <div class="modal-dialog modal-lg modal-dialog-centered">

                                                    <div class="modal-content">

                                                        <div class="modal-header">

                                                            <h5 class="modal-title">
                                                                Dokumentasi Kegiatan
                                                            </h5>

                                                            <button type="button" class="close" data-dismiss="modal">

                                                                &times;

                                                            </button>

                                                        </div>

                                                        <div class="modal-body text-center">

                                                            @foreach($item->dokumentasi as $doc)

                                                                <img src="{{ asset('storage/' . $doc->file) }}"
                                                                    class="img-fluid rounded mb-3 shadow">

                                                            @endforeach

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        @endif

                        @empty

                            <tr>

                                <td colspan="9" class="text-center">
                                    Tidak ada data
                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

@endsection