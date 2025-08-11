<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\PortofolioSatu;
use App\Models\PortofolioGambar1;
use App\Models\PortofolioItem;
use App\Models\Lpl;
class PortofolioController extends Controller
{

   public function formAdmin()
{
    $portofolio_satu = PortofolioSatu::with(['gambar', 'item', 'lpl'])->get();
    return view('admin.portofolio.form-portofolio', compact('portofolio_satu'));
}

    public function create()
{
    return view('admin.portofolio.create-portofolio');
}

    public function store(Request $request)
{
    $request->validate([
        'judul' => 'required',
        'ringkasan' => 'required',
        'keahlian' => 'required|array',
        'warna_tema' => 'required',
        'gambar.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
        'longitude' => 'required',
        'latitude' => 'required',
        'setuju' => 'accepted',
    ]);

    $portofolio = PortofolioSatu::create([
        'judul_portofolio' => $request->judul,
        'ringkasan' => $request->ringkasan,
        'keahlian' => implode(', ', $request->keahlian),
        'warna_tema' => $request->warna_tema,
    ]);

    if ($request->hasFile('gambar')) {
        foreach ($request->file('gambar') as $file) {
            $path = $file->store('portofolio_gambar', 'public');
            PortofolioGambar1::create([
                'portofolio_id' => $portofolio->id,
                'file_path' => $path,
            ]);
        }
    }

    if ($request->data_proyek) {
        $items = json_decode($request->data_proyek, true);
        foreach ($items as $item) {
            PortofolioItem::create([
                'portofolio_id' => $portofolio->id,
                'judul_proyek' => $item['judul'],
                'deskripsi_singkat' => $item['deskripsi'],
                'url_proyek' => $item['url'] ?? null,
            ]);
        }
    }

    Lpl::create([
        'portofolio_id' => $portofolio->id,
        'longitude' => $request->longitude,
        'latitude' => $request->latitude,
        'terbuka_klien' => $request->has('terbuka'),
        'layanan' => json_encode($request->layanan),
        'setuju' => true,
    ]);

    return redirect()->route('admin.portofolio.form-portofolio')->with('success', 'Portofolio berhasil disimpan!');
}

public function edit($id)
{
    $portofolio = PortofolioSatu::with(['lpl', 'item', 'gambar'])->findOrFail($id);
    return view('admin.portofolio.edit-portofolio', compact('portofolio'));
}

public function update(Request $request, $id)
{
    $portofolio = PortofolioSatu::findOrFail($id);

    $request->validate([
        'judul' => 'required',
        'ringkasan' => 'required',
        'keahlian' => 'required|array',
        'warna_tema' => 'required',
        'gambar.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
        'longitude' => 'required',
        'latitude' => 'required',
        'setuju' => 'accepted',
    ]);

    $portofolio->update([
        'judul_portofolio' => $request->judul,
        'ringkasan' => $request->ringkasan,
        'keahlian' => implode(', ', $request->keahlian ?? []),
        'warna_tema' => $request->warna_tema,
        'setuju' => $request->has('setuju'), 
    ]);

    if ($request->hasFile('gambar')) {
        foreach ($portofolio->gambar as $gambarLama) {
            Storage::disk('public')->delete($gambarLama->file_path);
            $gambarLama->delete();
        }

        foreach ($request->file('gambar') as $file) {
            $path = $file->store('portofolio_gambar', 'public');
            PortofolioGambar1::create([
                'portofolio_id' => $portofolio->id,
                'file_path' => $path,
            ]);
        }
    }

    if ($request->data_proyek) {
        foreach ($portofolio->item as $item) {
            $item->delete();
        }

        $items = json_decode($request->data_proyek, true);
        foreach ($items as $item) {
            PortofolioItem::create([
                'portofolio_id' => $portofolio->id,
                'judul_proyek' => $item['judul'],
                'deskripsi_singkat' => $item['deskripsi'],
                'url_proyek' => $item['url'] ?? null,
            ]);
        }
    }

    if ($portofolio->lpl) {
        $portofolio->lpl->update([
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
            'terbuka_klien' => $request->has('terbuka'),
            'layanan' => json_encode($request->layanan ?? []),
            'setuju' => $request->has('setuju'),
        ]);
    } else {
        Lpl::create([
            'portofolio_id' => $portofolio->id,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
            'terbuka_klien' => $request->has('terbuka'),
            'layanan' => json_encode($request->layanan ?? []),
            'setuju' => $request->has('setuju'),
        ]);
    }

    return redirect()->route('admin.portofolio.form-portofolio')->with('success', 'Portofolio berhasil diperbarui');
}

   public function destroy($id)
{
    $portofolio = PortofolioSatu::findOrFail($id);

    foreach ($portofolio->gambar as $gambar) {
        Storage::disk('public')->delete($gambar->file_path);
        $gambar->delete();
    }

    foreach ($portofolio->item as $item) {
        $item->delete();
    }

    if ($portofolio->lpl) {
        $portofolio->lpl->delete();
    }

    $portofolio->delete();

    return redirect()->route('admin.portofolio.form-portofolio')->with('success', 'Data berhasil dihapus.');
}
}
