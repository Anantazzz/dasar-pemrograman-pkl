<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;

class PengajuanController extends Controller
{
    public function index(Request $request)
    {
    $query = Pengajuan::query();

    if ($request->filled('search')) {
        $query->where('proyek', 'like', '%' . $request->search . '%')
              ->orWhere('penawaran', 'like', '%' . $request->search . '%');
    }

      $sort = $request->get('sort', 'id_desc');
    if ($sort === 'id_asc') {
        $query->orderBy('id', 'asc');
    } else { 
        $query->orderBy('id', 'desc');
    }

    $data = $query->paginate(10); 

    return view('admin.pengajuan.index', compact('data'));
    }

    public function show($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        return view('admin.pengajuan.show', compact('pengajuan'));
    }

    public function create()
    {
        return view('admin.pengajuan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'proyek'    => 'required|string|max:255',
            'penawaran' => 'required|numeric|min:0',
            'pesan'     => 'nullable|string',
            'durasi'    => 'required|integer|min:1',
        ]);

        Pengajuan::create([
            'proyek'    => 'Desain Logo Perusahaan Baru', 
            'penawaran' => $request->penawaran,
            'pesan'     => $request->pesan,
            'durasi'    => $request->durasi,
        ]);

        return redirect()->route('admin.pengajuan.index')
                         ->with('success', 'Pengajuan berhasil disimpan.');
    }

    public function edit($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        return view('admin.pengajuan.edit', compact('pengajuan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'penawaran' => 'required|numeric|min:0',
            'pesan'     => 'nullable|string',
            'durasi'    => 'required|integer|min:1',
        ]);

        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->update([
            'penawaran' => $request->penawaran,
            'pesan'     => $request->pesan,
            'durasi'    => $request->durasi,
        ]);

        return redirect()->route('admin.pengajuan.index')
                         ->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->deleted_at = now();
        $pengajuan->save();

        return redirect()->route('admin.pengajuan.index')
                         ->with('success', 'Data berhasil dihapus (soft delete)!');
    }
}
