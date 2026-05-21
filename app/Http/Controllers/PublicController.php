<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PendapatanModel;
use App\Models\BelanjaModel;

class PublicController extends Controller
{
    public function index(Request $request)
    {
        $tahun = $request->tahun ?? date('Y');

        // =======================
        // PENDAPATAN
        // =======================

        $pendapatan = PendapatanModel::with('realisasi')
            ->whereYear('tanggal', $tahun)
            ->latest()
            ->get();

        $totalPaguPendapatan = $pendapatan->sum('pagu');

        $totalRealisasiPendapatan = $pendapatan->sum(function ($item) {
            return optional($item->realisasi)->realisasi ?? 0;
        });

        $totalSisaPendapatan =
            $totalPaguPendapatan - $totalRealisasiPendapatan;

        $persenPendapatan =
            $totalPaguPendapatan > 0
            ? ($totalRealisasiPendapatan / $totalPaguPendapatan) * 100
            : 0;


        // =======================
        // BELANJA
        // =======================

        $belanja = BelanjaModel::with(['realisasi', 'dokumentasi'])
            ->whereYear('tanggal', $tahun)
            ->latest()
            ->get();

        $totalPaguBelanja = $belanja->sum('pagu');

        $totalRealisasiBelanja = $belanja->sum(function ($item) {
            return optional($item->realisasi)->realisasi ?? 0;
        });

        $totalSisaBelanja =
            $totalPaguBelanja - $totalRealisasiBelanja;

        $persenBelanja =
            $totalPaguBelanja > 0
            ? ($totalRealisasiBelanja / $totalPaguBelanja) * 100
            : 0;


        return view('public.index', compact(

            'tahun',

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