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
                        <th>Tanggal</th>
                        <td>
                            {{ $data->tanggal ? \Carbon\Carbon::parse($data->tanggal)->format('d-m-Y') : '-' }}
                        </td>
                    </tr>
                    <tr>
                        <th>Bidang</th>
                        <td>{{ $data->bidang }}</td>
                    </tr>
                    <tr>
                        <th>Nama Kegiatan</th>
                        <td>{{ $data->jenis_kegiatan }}</td>
                    </tr>
                    <tr>
                        <th>Sumber Dana</th>

                        <td>

                            @forelse($data->sumberDana as $sd)

                                <div class="mb-2">

                                    <strong>
                                        {{ $sd->kode }}
                                    </strong>

                                    :
                                 Rp {{ number_format($sd->pivot->nominal, 0, ',', '.') }}

                                </div>

                            @empty

                                -

                            @endforelse

                        </td>
                    </tr>
                    <tr>
                        <th>Anggaran Kegiatan (Pagu)</th>
                        <td>Rp {{ number_format($data->pagu, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Realisasi Belanja</th>

                        <td>

                            Rp {{ number_format($realisasi, 0, ',', '.') }}

                        </td>
                    </tr>
                    <tr>
                        <th>Pajak</th>

                        <td>
                            {{ $data->pajak
        ? 'Rp ' . number_format($data->pajak, 0, ',', '.')
        : '-' }}
                        </td>
                    </tr>
                    <tr>
                        <th>Sisa Anggaran
                            <br>
                            <small class="text-muted">
                                Lebih/(Kurang)
                            </small>
                        </th>
                        <td>
                            Rp {{ number_format($sisa, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Persentase</th>
                        <td>
                           {{ number_format($persentase, 2, ',', '.') }} %</td>
                    </tr>

                    <tr>
                        <th>Dokumentasi Kegiatan</th>
                        <td>
                            @foreach($data->dokumentasi as $doc)
                                <img src="{{ asset('storage/' . $doc->file) }}"
                                    style="max-width:100%; height:auto; border-radius:8px;">
                            @endforeach
                        </td>
                    </tr>

                </table>

                <a href="{{ route('belanja.index') }}" class="btn btn-secondary">Kembali</a>

            </div>
        </div>

    </div>
@endsection