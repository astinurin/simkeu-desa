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

        $persenBelanja = $totalPaguBelanja > 0
            ? ($totalRealisasiBelanja / $totalPaguBelanja) * 100
            : 0;

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
            'persenBelanja'
        ));
    }
}
