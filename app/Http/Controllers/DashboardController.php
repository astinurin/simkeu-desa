<?php

namespace App\Http\Controllers;

use App\Models\PendapatanModel;

class DashboardController extends Controller
{
    public function index()
    {
        $data = PendapatanModel::with('realisasi')->get();

        $totalPagu = 0;
        $totalRealisasi = 0;

        foreach ($data as $item) {
            $pagu = $item->pagu;
            $realisasi = optional($item->realisasi)->realisasi ?? 0;

            $totalPagu += $pagu;
            $totalRealisasi += $realisasi;
        }

        $totalSisa = $totalPagu - $totalRealisasi;

        $persentaseTotal = $totalPagu > 0
            ? ($totalRealisasi / $totalPagu) * 100
            : 0;

        return view('dashboard', [
            'pendapatan' => $data,
            'totalPagu' => $totalPagu,
            'totalRealisasi' => $totalRealisasi,
            'totalSisa' => $totalSisa,
            'persentaseTotal' => number_format($persentaseTotal, 2)
        ]);
    }
}