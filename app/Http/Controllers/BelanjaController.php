<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BelanjaModel;
use App\Models\RealisasiBelanjaModel;
use App\Models\DokumentasiKegiatanModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class BelanjaController extends Controller
{
    public function index()
    {
        $data = BelanjaModel::with('realisasi')->latest()->get();

        // ini ambil tahun
        $tahunList = BelanjaModel::selectRaw('YEAR(tanggal) as tahun')
            ->whereNotNull('tanggal')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        return view('belanja.index', compact('data', 'tahunList'));
    }

    public function create()
    {
        return view('belanja.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'nullable|date',
            'bidang' => 'required',
            'jenis_kegiatan' => 'required',
            'pagu' => 'required|numeric',
            'realisasi_belanja' => 'nullable|numeric',
            'dokumentasi.*' => 'nullable|image|mimes:jpg,jpeg,png'
        ]);

        // 1) BELANJA
        $belanja = BelanjaModel::create([
            'user_id' => Auth::id(),
            'tanggal' => $request->tanggal ?? now()->toDateString(),
            'bidang' => $request->bidang,
            'jenis_kegiatan' => $request->jenis_kegiatan,
            'pagu' => $request->pagu,
            'realisasi_belanja' => $request->realisasi_belanja ?? 0,
        ]);

        // 2) REALISASI_BELANJA (sesuai kolom kamu)
        $realisasi = $request->realisasi_belanja ?? 0;
        $sisa = $request->pagu - $realisasi;
        $persen = $request->pagu > 0 ? ($realisasi / $request->pagu) * 100 : 0;

        RealisasiBelanjaModel::create([
            'belanja_id' => $belanja->id,
            'realisasi' => $realisasi,
            'sisa_belanja' => $sisa,
            'total_pagu_belanja' => $request->pagu,
            'total_sisa_belanja' => $sisa,
            'persentase' => $persen,
            'total_persentase' => $persen,
        ]);

        // 3) DOKUMENTASI (MULTI IMAGE + AUTO COMPRESS)
        if ($request->hasFile('dokumentasi')) {
            $manager = new ImageManager(new Driver());

            foreach ($request->file('dokumentasi') as $file) {
                try {
                    $img = $manager->read($file);

                    // tolak yg terlalu kecil
                    if ($img->width() < 400 || $img->height() < 400) {
                        continue;
                    }

                    // kompres kalau >2MB
                    if ($file->getSize() > 2 * 1024 * 1024) {
                        $img->scaleDown(width: 1600);
                    }

                    $name = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
                    $filename = $name . '_' . time() . '_' . Str::random(4) . '.jpg';
                    $path = 'dokumentasi/' . $filename;

                    Storage::disk('public')->put($path, (string) $img->toJpeg(80));

                    DokumentasiKegiatanModel::create([
                        'belanja_id' => $belanja->id,
                        'file' => $path
                    ]);
                } catch (\Exception $e) {
                    continue;
                }
            }
        }

        return redirect()->route('belanja.index')->with('success', 'Data belanja berhasil ditambahkan');
    }

    public function show($id)
    {
        $data = BelanjaModel::with(['realisasi', 'dokumentasi'])->findOrFail($id);
        return view('belanja.show', compact('data'));
    }

    public function edit($id)
    {
        $data = BelanjaModel::with('realisasi')->findOrFail($id);
        return view('belanja.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'nullable|date',
            'bidang' => 'required',
            'jenis_kegiatan' => 'required',
            'pagu' => 'required|numeric',
            'realisasi_belanja' => 'nullable|numeric',
            'dokumentasi.*' => 'nullable|image|mimes:jpg,jpeg,png'
        ]);

        $data = BelanjaModel::findOrFail($id);

        $data->update([
            'bidang' => $request->bidang,
            'tanggal' => $request->tanggal ?? $data->tanggal,
            'jenis_kegiatan' => $request->jenis_kegiatan,
            'pagu' => $request->pagu,
            'realisasi_belanja' => $request->realisasi_belanja ?? 0,
        ]);

        // update realisasi
        $realisasi = $request->realisasi_belanja ?? 0;
        $sisa = $request->pagu - $realisasi;
        $persen = $request->pagu > 0 ? ($realisasi / $request->pagu) * 100 : 0;

        $data->realisasi()->updateOrCreate(
            ['belanja_id' => $data->id],
            [
                'realisasi' => $realisasi,
                'sisa_belanja' => $sisa,
                'total_pagu_belanja' => $request->pagu,
                'total_sisa_belanja' => $sisa,
                'persentase' => $persen,
                'total_persentase' => $persen,
            ]
        );

        // tambah dokumentasi baru (optional)
        if ($request->hasFile('dokumentasi')) {
            $manager = new ImageManager(new Driver());

            foreach ($request->file('dokumentasi') as $file) {
                try {
                    $img = $manager->read($file);

                    if ($img->width() < 400 || $img->height() < 400) continue;

                    if ($file->getSize() > 2 * 1024 * 1024) {
                        $img->scaleDown(width: 1600);
                    }

                    $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
                        . '_' . time() . '.jpg';

                    $path = 'dokumentasi/' . $filename;

                    Storage::disk('public')->put($path, (string) $img->toJpeg(80));

                    DokumentasiKegiatanModel::create([
                        'belanja_id' => $data->id,
                        'file' => $path
                    ]);
                } catch (\Exception $e) {
                    continue;
                }
            }
        }

        return redirect()->route('belanja.index')->with('success', 'Data belanja berhasil diupdate');
    }

    public function destroy($id)
    {
        $data = BelanjaModel::with('dokumentasi')->findOrFail($id);

        foreach ($data->dokumentasi as $doc) {
            Storage::disk('public')->delete($doc->file);
            $doc->delete();
        }

        $data->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }
}
