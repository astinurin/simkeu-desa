<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">

    <title>Laporan Realisasi APBDes</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            color: #000;
            font-size: 12px;
        }

        .header {
            text-align: center;
            margin-bottom: 15px;
        }

        .header h1 {
            margin: 0;
            font-size: 26px;
        }

        .header h2 {
            margin: 5px 0;
            font-size: 18px;
            font-weight: normal;
        }

        .header h3 {
            margin: 5px 0;
            font-size: 16px;
        }

        .line {
            border-top: 3px solid #000;
            margin-top: 15px;
            margin-bottom: 20px;
        }

        .info {
            margin-bottom: 20px;
        }

        .info table {
            border: none;
            width: auto;
        }

        .info td {
            border: none;
            padding: 3px 8px 3px 0;
        }

        .section-title {
            background: #f2f2f2;
            padding: 8px;
            font-weight: bold;
            margin-top: 25px;
            margin-bottom: 10px;
            border-left: 5px solid #000;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th {
            background: #f5f5f5;
            text-align: center;
        }

        table,
        th,
        td {
            border: 1px solid #000;
        }

        th,
        td {
            padding: 8px;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .summary-table th {
            width: 50%;
        }

        .footer-sign {
            margin-top: 60px;
            width: 100%;
        }

        .signature {
            width: 280px;
            float: right;
            text-align: center;
        }

        .signature-space {
            height: 70px;
        }

        .print-info {
            margin-top: 10px;
            font-size: 11px;
            color: #555;
        }
    </style>
</head>

<body>

    {{-- HEADER --}}
    <div class="header">

        <h2>SISTEM INFORMASI MANAJEMEN KEUANGAN DESA</h2>

        <h1>LAPORAN REALISASI APBDes</h1>

        <h3>TAHUN ANGGARAN {{ $tahun }}</h3>

    </div>

    <div class="line"></div>

    {{-- INFO --}}
    <div class="info">

        <table>
            <tr>
                <td><strong>Tahun Anggaran</strong></td>
                <td>: {{ $tahun }}</td>
            </tr>

            <tr>
                <td><strong>Tanggal Cetak</strong></td>
                <td>: {{ now()->locale('id')->translatedFormat('d F Y') }}</td>
            </tr>
        </table>

    </div>

    {{-- RINGKASAN --}}
    <div class="section-title">
        I. RINGKASAN REALISASI APBDes
    </div>

    <table class="summary-table">

        <tr>
            <th>Total Realisasi Pendapatan</th>
            <td class="text-right">
                Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
            </td>
        </tr>

        <tr>
            <th>Total Realisasi Belanja</th>
            <td class="text-right">
                Rp {{ number_format($totalBelanja, 0, ',', '.') }}
            </td>
        </tr>

        <tr>
            <th>Sisa Anggaran</th>
            <td class="text-right">
                Rp {{ number_format($sisaAnggaran, 0, ',', '.') }}
            </td>
        </tr>

    </table>

    {{-- PENDAPATAN --}}
    <div class="section-title">
        II. RINCIAN PENDAPATAN
    </div>

    <table>

        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Tanggal</th>
                <th>Kategori</th>
                <th>Jenis Pendapatan</th>
                <th>Pagu</th>
                <th>Realisasi</th>
            </tr>
        </thead>

        <tbody>

            @forelse($pendapatan as $item)

                <tr>

                    <td class="text-center">
                        {{ $loop->iteration }}
                    </td>

                    <td class="text-center">
                        {{ \Carbon\Carbon::parse($item->tanggal)->locale('id')->translatedFormat('d F Y') }}
                    </td>

                    <td>
                        {{ $item->kategori_pendapatan }}
                    </td>

                    <td>
                        {{ $item->jenis_pendapatan }}
                    </td>

                    <td class="text-right">
                        Rp {{ number_format($item->pagu, 0, ',', '.') }}
                    </td>

                    <td class="text-right">
                        Rp {{ number_format(optional($item->realisasi)->realisasi ?? 0, 0, ',', '.') }}
                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="6" class="text-center">
                        Tidak ada data
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

    {{-- BELANJA --}}
    <div class="section-title">
        III. RINCIAN BELANJA
    </div>

    <table>

        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Tanggal</th>
                <th>Bidang</th>
                <th>Kegiatan</th>
                <th>Pagu</th>
                <th>Realisasi</th>
            </tr>
        </thead>

        <tbody>

            @forelse($belanja as $item)

                <tr>

                    <td class="text-center">
                        {{ $loop->iteration }}
                    </td>

                    <td class="text-center">
                        {{ \Carbon\Carbon::parse($item->tanggal)->locale('id')->translatedFormat('d F Y') }}
                    </td>

                    <td>
                        {{ $item->bidang }}
                    </td>

                    <td>
                        {{ $item->jenis_kegiatan }}
                    </td>

                    <td class="text-right">
                        Rp {{ number_format($item->pagu, 0, ',', '.') }}
                    </td>

                    <td class="text-right">
                        Rp {{ number_format(optional($item->realisasi)->realisasi ?? 0, 0, ',', '.') }}
                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="6" class="text-center">
                        Tidak ada data
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

    {{-- TTD --}}
    <div class="footer-sign">

        <div class="signature">

            Pandanlandung,
            {{ now()->locale('id')->translatedFormat('d F Y') }}

            <br><br>

            Administrator Desa Pandanlandung

            <div class="signature-space"></div>

            <strong>
                ________________________
            </strong>

        </div>

    </div>

    <script>
        window.onload = function () {

            window.print();

        };

        window.onafterprint = function () {

            window.history.back();

        };
    </script>

</body>

</html>