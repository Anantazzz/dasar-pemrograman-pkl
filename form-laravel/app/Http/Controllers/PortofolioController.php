<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\PortofolioSatu;
use App\Models\PortofolioGambar1;
use App\Models\PortofolioItem;
use App\Models\Lpl;

class PortofolioController extends Controller
{
   public function index(Request $request)
    {
    $search = $request->input('search');
    $sort = $request->get('sort', 'id_desc'); 

    $portofolio_satu = PortofolioSatu::query()
        ->when($search, function($query, $search) {
            $query->where('judul_portofolio', 'like', "%{$search}%")
                  ->orWhere('keahlian', 'like', "%{$search}%");
        })
        ->with(['lpl', 'gambars', 'items']);

    if ($sort === 'id_asc') {
        $portofolio_satu->orderBy('id', 'asc');
    } else {
        $portofolio_satu->orderBy('id', 'desc');
    }

    $portofolio_satu = $portofolio_satu->paginate(10)->appends(request()->all());

    return view('admin.portofolio.index', compact('portofolio_satu', 'search', 'sort'));
    }

    public function show($id)
    {
        $portofolio = PortofolioSatu::findOrFail($id);
        return view('admin.portofolio.show', compact('portofolio'));
    }

    public function create()
    {
        return view('admin.portofolio.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'      => 'required|string|max:255',
            'ringkasan'  => 'required|string',
            'keahlian'   => 'required|array|min:1',
            'warna_tema' => 'required|string|max:7',
            'gambar.*'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'longitude'  => 'required|numeric',
            'latitude'   => 'required|numeric',
            'setuju'     => 'accepted',
        ]);

        DB::beginTransaction();

        try {
            $portofolio = PortofolioSatu::create([
                'judul_portofolio' => $request->judul,
                'ringkasan'        => $request->ringkasan,
                'keahlian'         => implode(', ', $request->keahlian),
                'warna_tema'       => $request->warna_tema,
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
                    $portofolio->items()->create([
                        'judul_proyek'     => $item['judul'],
                        'deskripsi_singkat'=> $item['deskripsi'],
                        'url_proyek'       => $item['url'] ?? null,
                    ]);
                }
            }
            
            $portofolio->lpl()->create([
                'longitude'     => $request->longitude,
                'latitude'      => $request->latitude,
                'terbuka_klien' => $request->has('terbuka'),
                'layanan'       => json_encode($request->layanan ?? []),
                'setuju'        => true,
            ]);

            DB::commit();

            return redirect()
                ->route('admin.portofolio.index')
                ->with('success', 'Portofolio berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan: '.$e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $portofolio = PortofolioSatu::with(['lpl', 'items', 'gambars'])->findOrFail($id);
        return view('admin.portofolio.edit', compact('portofolio'));
    }

    public function update(Request $request, $id)
    {
        $portofolio = PortofolioSatu::findOrFail($id);

        $request->validate([
            'judul'      => 'required',
            'ringkasan'  => 'required',
            'keahlian'   => 'required|array',
            'warna_tema' => 'required',
            'gambar.*'   => 'image|mimes:jpeg,png,jpg,gif|max:5120',
            'longitude'  => 'required',
            'latitude'   => 'required',
            'setuju'     => 'accepted',
        ]);

        $portofolio->update([
            'judul_portofolio' => $request->judul,
            'ringkasan'        => $request->ringkasan,
            'keahlian'         => implode(', ', $request->keahlian ?? []),
            'warna_tema'       => $request->warna_tema,
            'setuju'           => $request->has('setuju'),
        ]);

        // Update gambar
        if ($request->hasFile('gambar')) {
            foreach ($portofolio->gambars as $gambarLama) {
                Storage::disk('public')->delete($gambarLama->file_path);
                $gambarLama->delete();
            }

            foreach ($request->file('gambar') as $file) {
                $path = $file->store('portofolio_gambar', 'public');
                PortofolioGambar1::create([
                    'portofolio_id' => $portofolio->id,
                    'file_path'     => $path,
                ]);
            }
        }

        // Update proyek
        if ($request->data_proyek) {
            foreach ($portofolio->items as $item) {
                $item->delete();
            }

            $items = json_decode($request->data_proyek, true);
            foreach ($items as $item) {
                PortofolioItem::create([
                    'portofolio_id'    => $portofolio->id,
                    'judul_proyek'     => $item['judul'],
                    'deskripsi_singkat'=> $item['deskripsi'],
                    'url_proyek'       => $item['url'] ?? null,
                ]);
            }
        }

        // Update lokasi & layanan
        if ($portofolio->lpl) {
            $portofolio->lpl->update([
                'longitude'     => $request->longitude,
                'latitude'      => $request->latitude,
                'terbuka_klien' => $request->has('terbuka'),
                'layanan'       => json_encode($request->layanan ?? []),
                'setuju'        => $request->has('setuju'),
            ]);
        } else {
            Lpl::create([
                'portofolio_id' => $portofolio->id,
                'longitude'     => $request->longitude,
                'latitude'      => $request->latitude,
                'terbuka_klien' => $request->has('terbuka'),
                'layanan'       => json_encode($request->layanan ?? []),
                'setuju'        => $request->has('setuju'),
            ]);
        }

        return redirect()
            ->route('admin.portofolio.index')
            ->with('success', 'Portofolio berhasil diperbarui');
    }

    public function destroy($id)
    {
        $portofolio = PortofolioSatu::findOrFail($id);

        foreach ($portofolio->gambars as $gambar) {
            Storage::disk('public')->delete($gambar->file_path);
            $gambar->delete();
        }

        foreach ($portofolio->items as $item) {
            $item->delete();
        }

        if ($portofolio->lpl) {
            $portofolio->lpl->delete();
        }

        $portofolio->delete();

        return redirect()
            ->route('admin.portofolio.index')
            ->with('success', 'Data berhasil dihapus.');
    }
}
