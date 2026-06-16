<?php

namespace App\Http\Controllers;

use App\Models\PendapatanModel;
use App\Models\BelanjaModel;

class DashboardController extends Controller
{
    public function index()
    {
        // =======================
        // 🔵 PENDAPATAN
        // =======================
        $pendapatan = PendapatanModel::with('realisasi')
            ->latest()
            ->take(5) // tampilkan 5 terbaru
            ->get();


        $totalPaguPendapatan = $pendapatan->sum('pagu');

        $totalRealisasiPendapatan = $pendapatan->sum(function ($item) {
            return optional($item->realisasi)->realisasi ?? 0;
        });

        $totalSisaPendapatan = $totalPaguPendapatan - $totalRealisasiPendapatan;

        $persenPendapatan = $totalPaguPendapatan > 0
            ? ($totalRealisasiPendapatan / $totalPaguPendapatan) * 100
            : 0;

        // =======================
        // 🟣 BELANJA
        // =======================
        $belanja = BelanjaModel::with(['realisasi', 'dokumentasi'])
            ->latest()
            ->take(5)
            ->get();

        $totalPaguBelanja = $belanja->sum('pagu');

        $totalRealisasiBelanja = $belanja->sum(function ($item) {
            return optional($item->realisasi)->realisasi ?? 0;
        });

        $totalSisaBelanja = $totalPaguBelanja - $totalRealisasiBelanja;
        $totalSisaAnggaran =
    $totalRealisasiPendapatan -
    $totalRealisasiBelanja;

        $persenBelanja = $totalPaguBelanja > 0
            ? ($totalRealisasiBelanja / $totalPaguBelanja) * 100
            : 0;
        $chartBelanja = BelanjaModel::selectRaw(
            'bidang, SUM(realisasi_belanja) as total'
        )
            ->groupBy('bidang')
            ->get();

        $chartBelanjaLabels = $chartBelanja->pluck('bidang');
        $chartBelanjaData = $chartBelanja->pluck('total');
       

        // =====================================
// PEMAKAIAN SUMBER DANA UNTUK BELANJA
// =====================================

$penggunaanSumberDana = [];

$belanjaSemua = BelanjaModel::with('sumberDana')->get();

foreach ($belanjaSemua as $belanjaItem) {

    $totalAlokasi = $belanjaItem->sumberDana->sum(function ($sd) {
        return $sd->pivot->nominal;
    });

    if ($totalAlokasi <= 0) {
        continue;
    }

    foreach ($belanjaItem->sumberDana as $sd) {

        $proporsi =
            $sd->pivot->nominal / $totalAlokasi;

        $terpakai =
            $belanjaItem->realisasi_belanja * $proporsi;

        if (!isset($penggunaanSumberDana[$sd->kode])) {
            $penggunaanSumberDana[$sd->kode] = 0;
        }

        $penggunaanSumberDana[$sd->kode] += $terpakai;
    }
}


// =====================================
// REALISASI PENDAPATAN YANG DITERIMA
// =====================================

$realisasiPendapatan = [];

$pendapatanSemua = PendapatanModel::with('realisasi')->get();

foreach ($pendapatanSemua as $item) {

    $jenis = $item->jenis_pendapatan;

    $nilai =
        optional($item->realisasi)->realisasi ?? 0;

    if (!isset($realisasiPendapatan[$jenis])) {
        $realisasiPendapatan[$jenis] = 0;
    }

    $realisasiPendapatan[$jenis] += $nilai;
}


// =====================================
// DATA DASHBOARD
// =====================================

$dashboardSumberDana = [

    [
        'nama' => 'Dana Desa',
        'diterima' => $realisasiPendapatan['Dana Desa'] ?? 0,
        'terpakai' => $penggunaanSumberDana['DD'] ?? 0,
    ],

    [
        'nama' => 'Alokasi Dana Desa',
        'diterima' => $realisasiPendapatan['Alokasi Dana Desa'] ?? 0,
        'terpakai' => $penggunaanSumberDana['ADD'] ?? 0,
    ],

    [
        'nama' => 'Bagi Hasil Pajak dan Retribusi',
        'diterima' => $realisasiPendapatan['Bagi Hasil Pajak dan Retribusi'] ?? 0,
        'terpakai' => $penggunaanSumberDana['PBH'] ?? 0,
    ],

    [
        'nama' => 'Pendapatan Asli Desa',
        'diterima' => $realisasiPendapatan['Pendapatan Asli Desa'] ?? 0,
        'terpakai' => $penggunaanSumberDana['PAD'] ?? 0,
    ],

    [
        'nama' => 'Pendapatan Lain-lain',
        'diterima' => $realisasiPendapatan['Pendapatan Lain-lain'] ?? 0,
        'terpakai' => $penggunaanSumberDana['DLL'] ?? 0,
    ]

];

foreach ($dashboardSumberDana as &$item) {

    $item['persentase'] =
        $item['diterima'] > 0
            ? ($item['terpakai'] / $item['diterima']) * 100
            : 0;
}
        return view('dashboard', compact(
            'pendapatan',
            'belanja',

            'totalPaguPendapatan',
            'totalRealisasiPendapatan',
            'totalSisaPendapatan',
            'persenPendapatan',

            'totalPaguBelanja',
            'totalRealisasiBelanja',
            'totalSisaBelanja',
            'persenBelanja',
            'chartBelanjaLabels',
            'chartBelanjaData',

            'dashboardSumberDana',
            'totalSisaAnggaran',
            
        ));
    }
}
