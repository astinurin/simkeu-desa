<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PendapatanModel;
use App\Models\BelanjaModel;

class LaporanController extends Controller
{
    public function index()
    {
        return view('laporan.index');
    }

    public function cetak(Request $request)
    {
        $tahun = $request->tahun ?? date('Y');

        $pendapatan = PendapatanModel::with('realisasi')
            ->whereYear('tanggal', $tahun)
            ->get();

        $belanja = BelanjaModel::with('realisasi')
            ->whereYear('tanggal', $tahun)
            ->get();

        $totalPendapatan = $pendapatan->sum(function ($item) {
            return optional($item->realisasi)->realisasi ?? 0;
        });

        $totalBelanja = $belanja->sum(function ($item) {
            return optional($item->realisasi)->realisasi ?? 0;
        });

        $sisaAnggaran = $totalPendapatan - $totalBelanja;

        return view(
            'laporan.cetak',
            compact(
                'tahun',
                'pendapatan',
                'belanja',
                'totalPendapatan',
                'totalBelanja',
                'sisaAnggaran'
            )
        );
    }
}