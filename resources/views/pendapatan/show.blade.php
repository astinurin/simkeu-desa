@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        <h1 class="h3 mb-4 text-gray-800">Detail Pendapatan</h1>

        @php
            $realisasi = optional($data->realisasi)->realisasi ?? 0;
            $sisa = optional($data->realisasi)->sisa ?? ($data->pagu - $realisasi);

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
                        <th>Persentase Realisasi</th>
                        <td>
                            <span class="badge 
                                                                        @if($persentase >= 80) badge-success
                                                                        @elseif($persentase >= 50) badge-warning
                                                                        @else badge-danger
                                                                        @endif">
                                {{ number_format($persentase, 2) }} %
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

                                {{-- 🔥 PREVIEW --}}
                                @if(in_array($ext, ['jpg', 'jpeg', 'png']))
                                    <img src="{{ asset('storage/' . $data->dokumen) }}"
                                        style="width:100%; max-height:500px; object-fit:contain; border-radius:8px;">
                                @elseif($ext == 'pdf')
                                                        <div id="pdf-preview" style="
                                        width:100%;
                                        max-height:500px;
                                        overflow:auto;
                                        border:1px solid #ddd;
                                        border-radius:8px;
                                        padding:10px;
                                        background:#f8f9fc;
                                    "></div>

                                                        <a href="{{ route('pendapatan.download', $data->id) }}" class="btn btn-success btn-sm mt-2">
                                                            <i class="fas fa-download"></i> Unduh
                                                        </a>

                                                        <script>
                                                            const url = "{{ asset('storage/' . $data->dokumen) }}";

                                                            const pdfjsLib = window['pdfjs-dist/build/pdf'];
                                                            pdfjsLib.GlobalWorkerOptions.workerSrc =
                                                                'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

                                                            const container = document.getElementById('pdf-preview');

                                                            pdfjsLib.getDocument(url).promise.then(pdf => {

                                                                for (let pageNum = 1; pageNum <= pdf.numPages; pageNum++) {

                                                                    pdf.getPage(pageNum).then(page => {

                                                                        const scale = 1.2;
                                                                        const viewport = page.getViewport({ scale });

                                                                        const canvas = document.createElement('canvas');
                                                                        const context = canvas.getContext('2d');

                                                                        canvas.height = viewport.height;
                                                                        canvas.width = viewport.width;
                                                                        canvas.style.marginBottom = "10px";

                                                                        container.appendChild(canvas);

                                                                        page.render({
                                                                            canvasContext: context,
                                                                            viewport: viewport
                                                                        });

                                                                    });

                                                                }

                                                            });
                                                        </script>
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