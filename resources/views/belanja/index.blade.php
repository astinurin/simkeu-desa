@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Belanja</h1>
        <a href="{{ route('belanja.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Tambah Data
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
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
                    <thead class="text-center">
                        <tr>
                            <th>No</th>
                            <th>Bidang</th>
                            <th>Nama Kegiatan</th>
                            <th>Pagu</th>
                            <th>Realisasi</th>
                            <th>Sisa</th>
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
                                $totalRealisasi += $realisasi;
                                $totalSisa += $sisa;
                            @endphp

                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->bidang }}</td>
                                <td>{{ $item->nama_kegiatan }}</td>
                                <td>Rp {{ number_format($item->pagu) }}</td>
                                <td>Rp {{ number_format($realisasi) }}</td>
                                <td>Rp {{ number_format($sisa) }}</td>
                                <td class="text-center">
                                    <span class="badge
                                        @if($persentase >= 80) badge-success
                                        @elseif($persentase >= 50) badge-warning
                                        @else badge-danger
                                        @endif">
                                        {{ number_format($persentase,2) }} %
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('belanja.show', $item->id) }}" class="btn btn-info btn-sm p-1"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('belanja.edit', $item->id) }}" class="btn btn-warning btn-sm p-1"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('belanja.destroy', $item->id) }}" method="POST" style="display:inline;">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-danger btn-sm p-1" onclick="return confirm('Hapus?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="8" class="text-center">Data kosong</td></tr>
                        @endforelse
                    </tbody>

                    @php
                        $totalPersen = $totalPagu > 0 ? ($totalRealisasi / $totalPagu) * 100 : 0;
                    @endphp

                    <tfoot>
                        <tr style="font-weight:bold;background:#f8f9fc;">
                            <td colspan="3" class="text-center">Total</td>
                            <td>Rp {{ number_format($totalPagu) }}</td>
                            <td>Rp {{ number_format($totalRealisasi) }}</td>
                            <td>Rp {{ number_format($totalSisa) }}</td>
                            <td>{{ number_format($totalPersen,2) }} %</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div>
    </div>

</div>
@endsection