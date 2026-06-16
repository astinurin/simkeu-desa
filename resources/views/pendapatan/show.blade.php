@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        <h1 class="h3 mb-4 text-gray-800">Detail Pendapatan</h1>

        @php
            $realisasi = optional($data->realisasi)->realisasi ?? 0;
            // $sisa = optional($data->realisasi)->sisa ?? ($data->pagu - $realisasi);

            $persentase = $data->pagu > 0
                ? ($realisasi / $data->pagu) * 100
                : 0;
        @endphp

        <div class="card shadow">
            <div class="card-body">

                <table class="table table-bordered">
                    <tr>
                        <th>Tanggal</th>
                        <td>
                            {{ $data->tanggal
        ? \Carbon\Carbon::parse($data->tanggal)->format('d-m-Y')
        : '-' }}
                        </td>
                    </tr>

                    <tr>
                        <th width="30%">Kategori Pendapatan</th>
                        <td>{{ $data->kategori_pendapatan }}</td>
                    </tr>

                    <tr>
                        <th>Jenis Pendapatan</th>
                        <td>{{ $data->jenis_pendapatan }}</td>
                    </tr>
                    <tr>
                        <th>Tahap</th>
                        <td>{{ $data->tahap ?? '-' }}</td>
                    </tr>

                    <tr>
                        <th>Pagu Pendapatan</th>
                        <td>Rp {{ number_format($data->pagu, 0, ',', '.') }}</td>
                    </tr>

                    <tr>
                        <th>Realisasi Pendapatan</th>
                        <td>Rp {{ number_format($realisasi, 0, ',', '.') }}</td>
                    </tr>

                    {{-- <tr>
                        <th>Sisa</th>
                        <td>Rp {{ number_format($sisa, 0, ',', '.' ) }}</td>
                    </tr> --}}

                    <tr>
                        <th>Persentase Realisasi</th>
                        <td>
                            <span class="badge 
                                                                                            @if($persentase >= 80) badge-success
                                                                                            @elseif($persentase >= 50) badge-warning
                                                                                            @else badge-danger
                                                                                            @endif">
                                {{ number_format($persentase, 2, ',', '.') }} %
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Dokumen Pendukung</th>
                        <td>
                            @if($data->dokumen)

                                @php
                                    $ext = pathinfo($data->dokumen, PATHINFO_EXTENSION);
                                @endphp

                                {{-- preview --}}
                                @if(in_array($ext, ['jpg', 'jpeg', 'png']))
                                    <img src="{{ asset('storage/' . $data->dokumen) }}"
                                        style="max-width:100%; height:auto; border-radius:8px;">
                                @elseif($ext == 'pdf')
                                    <div class="border rounded p-3 bg-light">

                                        <p class="mb-2 text-gray-800">
                                            <i class="fas fa-file-pdf text-danger mr-2"></i>
                                            {{ basename($data->dokumen) }}
                                        </p>

                                        <a href="{{ asset('storage/' . $data->dokumen) }}" target="_blank"
                                            class="btn btn-primary btn-sm">
                                            <i class="fas fa-eye"></i> Lihat
                                        </a>

                                        <a href="{{ route('pendapatan.download', $data->id) }}" class="btn btn-success btn-sm">
                                            <i class="fas fa-download"></i> Unduh
                                        </a>
                                    </div>
                                @endif
                            @endif

                            <br><br>

                            {{-- download --}}
                            {{-- <a href="{{ route('pendapatan.download', $data->id) }}" class="btn btn-success btn-sm">
                                <i class="fas fa-download"></i> Unduh
                            </a> --}}


                        </td>
                    </tr>

                </table>

                <a href="{{ route('pendapatan.index') }}" class="btn btn-secondary">
                    Kembali
                </a>

            </div>
        </div>

    </div>

@endsection



@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
@endsection