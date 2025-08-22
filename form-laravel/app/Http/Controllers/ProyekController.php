<?php

namespace App\Http\Controllers;

use App\Models\Proyek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProyekController extends Controller
{
    public function index(Request $request)
    {
    $search = $request->input('search');
    $sort = $request->get('sort', 'id_desc');

    $data = \App\Models\Proyek::query()
        ->when($search, function($query, $search) {
            $query->where('detail', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%")
                  ->orWhere('kategori', 'like', "%{$search}%");
        });

    if ($sort === 'id_asc') {
        $data->orderBy('id', 'asc');
    } else {
        $data->orderBy('id', 'desc');
    }

    $data = $data->paginate(10)->appends(request()->all()); 

    return view('admin.proyek.index', compact('data', 'search', 'sort'));
    }

    public function show($id)
    {
        $proyek = Proyek::findOrFail($id);
        return view('admin.proyek.show', compact('proyek'));
    }

    public function create()
    {
        return view('admin.proyek.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'detail'            => 'required|string',
            'deskripsi'         => 'required|string',
            'kategori'          => 'required|string',
            'anggaran'          => 'required|integer|min:0',
            'batas_akhir'       => 'required|date',
            'lampiran'          => 'nullable|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar|max:5120',
            'lokasi_pengerjaan' => 'required|in:onsite,remote',
        ]);

        $lampiranPath = null;
        if ($request->hasFile('lampiran')) {
            $file      = $request->file('lampiran');
            $namaFile  = time() . '_' . $file->getClientOriginalName();
            $lampiranPath = $file->storeAs('public/lampiran', $namaFile);
        }

        Proyek::create([
            'detail'            => $request->detail,
            'deskripsi'         => $request->deskripsi,
            'kategori'          => $request->kategori,
            'anggaran'          => $request->anggaran,
            'batas_akhir'       => $request->batas_akhir,
            'lampiran'          => $lampiranPath,
            'lokasi_pengerjaan' => $request->lokasi_pengerjaan,
        ]);

        return redirect()->route('admin.proyek.index')
                         ->with('success', 'Proyek berhasil diposting!');
    }

    public function edit($id)
    {
        $proyek = Proyek::findOrFail($id);
        return view('admin.proyek.edit', compact('proyek'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'detail'            => 'required|string',
            'deskripsi'         => 'required|string',
            'kategori'          => 'required',
            'anggaran'          => 'required|numeric',
            'batas_akhir'       => 'required|date',
            'lokasi_pengerjaan' => 'required|in:onsite,remote',
            'lampiran'          => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $proyek = Proyek::findOrFail($id);

        if ($request->hasFile('lampiran')) {
            if ($proyek->lampiran && Storage::exists($proyek->lampiran)) {
                Storage::delete($proyek->lampiran);
            }
            $file      = $request->file('lampiran');
            $namaFile  = time() . '_' . $file->getClientOriginalName();
            $proyek->lampiran = $file->storeAs('public/lampiran', $namaFile);
        }

        $proyek->update([
            'detail'            => $request->detail,
            'deskripsi'         => $request->deskripsi,
            'kategori'          => $request->kategori,
            'anggaran'          => $request->anggaran,
            'batas_akhir'       => $request->batas_akhir,
            'lokasi_pengerjaan' => $request->lokasi_pengerjaan,
            'lampiran'          => $proyek->lampiran,
        ]);

        return redirect()->route('admin.proyek.index')
                         ->with('success', 'Proyek berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $proyek = Proyek::findOrFail($id);

        if ($proyek->lampiran && Storage::exists($proyek->lampiran)) {
            Storage::delete($proyek->lampiran);
        }

        $proyek->delete();

        return redirect()->route('admin.proyek.index')
                         ->with('success', 'Data berhasil dihapus!');
    }
}
