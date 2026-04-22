@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <h1 class="h3 mb-4 text-gray-800">Detail Belanja</h1>

        @php
            $realisasi = optional($data->realisasi)->realisasi ?? 0;
            $sisa = optional($data->realisasi)->sisa_belanja ?? ($data->pagu - $realisasi);
            $persentase = $data->pagu > 0 ? ($realisasi / $data->pagu) * 100 : 0;
        @endphp

        <div class="card shadow">
            <div class="card-body">

                <table class="table table-bordered">
                    <tr>
                        <th>Bidang</th>
                        <td>{{ $data->bidang }}</td>
                    </tr>
                    <tr>
                        <th>Kegiatan</th>
                        <td>{{ $data->nama_kegiatan }}</td>
                    </tr>
                    <tr>
                        <th>Pagu</th>
                        <td>Rp {{ number_format($data->pagu) }}</td>
                    </tr>
                    <tr>
                        <th>Realisasi</th>
                        <td>Rp {{ number_format($realisasi) }}</td>
                    </tr>
                    <tr>
                        <th>Sisa</th>
                        <td>Rp {{ number_format($sisa) }}</td>
                    </tr>
                    <tr>
                        <th>Persentase</th>
                        <td>{{ number_format($persentase, 2) }}%</td>
                    </tr>

                    <tr>
                        <th>Dokumentasi</th>
                        <td>
                            @foreach($data->dokumentasi as $doc)
                                <img src="{{ asset('storage/' . $doc->file) }}" style="max-width:100%;margin-bottom:10px;">
                            @endforeach
                        </td>
                    </tr>

                </table>

                <a href="{{ route('belanja.index') }}" class="btn btn-secondary">Kembali</a>

            </div>
        </div>

    </div>
@endsection