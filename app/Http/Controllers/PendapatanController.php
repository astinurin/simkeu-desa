<?php

namespace App\Http\Controllers;

use App\Models\PendapatanModel;
use App\Models\RealisasiPendapatanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PendapatanController extends Controller
{
    public function index()
    {
        $data = PendapatanModel::with('realisasi')->get();
        $tahunList = PendapatanModel::selectRaw('YEAR(tanggal) as tahun')
            ->whereNotNull('tanggal')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        return view('pendapatan.index', compact('data', 'tahunList'));
    }

    public function create()
    {
        return view('pendapatan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_pendapatan' => 'required',
            'jenis_pendapatan' => 'required',
            'pagu' => 'required|numeric',
            'realisasi' => 'nullable|numeric',
            'tanggal' => 'nullable|date'
        ]);
        $dokumenPath = null;

        if ($request->hasFile('dokumen')) {
            $file = $request->file('dokumen');
            $ext = strtolower($file->getClientOriginalExtension());

            if (in_array($ext, ['jpg', 'jpeg', 'png'])) {

                try {
                    $manager = new ImageManager(new Driver());
                    $img = $manager->read($file);

                    // batas ukuran file (2MB)
                    $maxBytes = 2 * 1024 * 1024;

                    // hanya kompres/resize kalau file terlalu besar
                    if ($file->getSize() > $maxBytes) {
                        // jaga rasio, hanya mengecilkan jika melebihi batas
                        $img->scaleDown(width: 1600);
                    }

                    // tolak kalau resolusi terlalu kecil (terlalu jelek)
                    if ($img->width() < 400 || $img->height() < 400) {
                        return back()->with('error', 'Resolusi gambar terlalu kecil');
                    }
                    $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $originalName = str_replace(' ', '_', $originalName);

                    $filename = $originalName . '_' . time() . '.jpg';
                    $path = 'dokumen/' . $filename;

                    Storage::disk('public')->put($path, (string) $img->toJpeg(80));

                    $dokumenPath = $path;
                } catch (\Exception $e) {
                    return back()->with('error', 'Gagal membaca gambar 😭');
                }
            } else {
                // PDF (biarin aja, ga usah diubah)
                $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $originalName = str_replace(' ', '_', $originalName);

                $extension = $file->getClientOriginalExtension();

                $filename = $originalName . '_' . time() . '.' . $extension;
                $path = 'dokumen/' . $filename;

                Storage::disk('public')->putFileAs('dokumen', $file, $filename);

                $dokumenPath = $path;
            }
        }
        // 1. SIMPAN KE TABEL PENDAPATAN
        $pendapatan = PendapatanModel::create([
            'user_id' => Auth::id(),
            'kategori_pendapatan' => $request->kategori_pendapatan,
            'jenis_pendapatan' => $request->jenis_pendapatan,
            'pagu' => $request->pagu,
            'tanggal' => $request->tanggal ?? now()->toDateString(),
            'dokumen' => $dokumenPath,
        ]);

        // 2. HITUNG REALISASI
        $realisasi = $request->realisasi ?? 0;
        $sisa = $request->pagu - $realisasi;

        $persentase = $request->pagu > 0
            ? ($realisasi / $request->pagu) * 100
            : 0;

        // 3. SIMPAN KE TABEL REALISASI
        RealisasiPendapatanModel::create([
            'pendapatan_id' => $pendapatan->id,
            'realisasi' => $realisasi,
            'sisa' => $sisa,
            'persentase' => $persentase,
        ]);

        return redirect()->route('pendapatan.index')
            ->with('success', 'Data berhasil ditambahkan');
    }

    public function show($id)
    {
        $data = PendapatanModel::findOrFail($id);
        return view('pendapatan.show', compact('data'));
    }

    public function edit($id)
    {
        $data = PendapatanModel::findOrFail($id);
        return view('pendapatan.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori_pendapatan' => 'required',
            'jenis_pendapatan' => 'required',
            'pagu' => 'required|numeric',
            'tanggal' => 'nullable|date',
            'dokumen' => 'nullable|file|mimes:jpg,jpeg,png,pdf'
        ]);

        $data = PendapatanModel::findOrFail($id);

        //  DEFAULT: pakai dokumen lama
        $dokumenPath = $data->dokumen;

        //  CEK ADA UPLOAD BARU
        if ($request->hasFile('dokumen')) {

            // HAPUS FILE LAMA
            if ($data->dokumen && Storage::exists('public/' . $data->dokumen)) {
                Storage::delete('public/' . $data->dokumen);
            }

            $file = $request->file('dokumen');
            $ext = strtolower($file->getClientOriginalExtension());

            if (in_array($ext, ['jpg', 'jpeg', 'png'])) {

                $manager = new ImageManager(new Driver());
                $img = $manager->read($file);

                // VALIDASI RESOLUSI
                if ($img->width() < 400 || $img->height() < 400) {
                    return back()->with('error', 'Resolusi gambar terlalu kecil');
                }

                // BATAS UKURAN FILE (2MB)
                $maxBytes = 2 * 1024 * 1024;

                // HANYA RESIZE KALAU TERLALU BESAR (TANPA MERUSAK RASIO)
                if ($file->getSize() > $maxBytes) {
                    $img->scaleDown(width: 1600);
                }

                $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $originalName = str_replace(' ', '_', $originalName); // biar rapi

                $filename = $originalName . '_' . time() . '.jpg';
                $path = 'dokumen/' . $filename;

                Storage::disk('public')->put($path, (string) $img->encode());

                $dokumenPath = $path;
            } else {
                // PDF
                $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $originalName = str_replace(' ', '_', $originalName);

                $extension = $file->getClientOriginalExtension();

                $filename = $originalName . '_' . time() . '.' . $extension;

                $path = 'dokumen/' . $filename;

                Storage::disk('public')->putFileAs('dokumen', $file, $filename);

                $dokumenPath = $path;
            }
        }

        $data->update([
            'kategori_pendapatan' => $request->kategori_pendapatan,
            'jenis_pendapatan' => $request->jenis_pendapatan,
            'pagu' => $request->pagu,
            'tanggal' => $request->tanggal,
            'dokumen' => $dokumenPath,
        ]);

        return redirect()->route('pendapatan.index')
            ->with('success', 'Data berhasil diupdate');
    }

    public function download($id)
    {
        $data = PendapatanModel::findOrFail($id);

        $path = storage_path('app/public/' . $data->dokumen);

        return response()->download($path);
    }
    public function destroy($id)
    {
        $data = PendapatanModel::findOrFail($id);
        $data->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }
}
