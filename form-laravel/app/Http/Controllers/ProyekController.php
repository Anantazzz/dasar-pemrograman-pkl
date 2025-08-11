<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProyekController extends Controller
{
     public function formAdmin()
    {
    $data = DB::table('proyek')->get();
    return view('admin.proyek.form-proyek', compact('data'));
    }

     public function create()
    {
        return view('admin.proyek.create-proyek');
    }

    public function store(Request $request)
{
    $request->validate([
        'detail' => 'required|string',
        'deskripsi' => 'required|string',
        'kategori' => 'required|string',
        'anggaran' => 'required|integer|min:0',
        'batas_akhir' => 'required|date',
        'lampiran' => 'nullable|file|mimes:png,jpg,jpeg,pdf|max:2048',
        'lokasi' => 'required|in:Remote,Onsite',
    ]);

    $lampiranPath = null;
    if ($request->hasFile('lampiran')) {
        $file = $request->file('lampiran');
        $namaFile = time() . '_' . $file->getClientOriginalName();
        $lampiranPath = $file->storeAs('public/lampiran', $namaFile);
    }

    DB::table('proyek')->insert([
        'detail' => $request->detail,
        'deskripsi' => $request->deskripsi,
        'kategori' => $request->kategori,
        'anggaran' => $request->anggaran,
        'batas_akhir' => $request->batas_akhir,
        'file_lampiran' => $lampiranPath,
        'lokasi' => $request->lokasi,
    ]);

    return redirect()->route('admin.proyek.form-proyek')->with('success', 'Proyek berhasil diposting!');
}

    public function edit($id)
    {
    $proyek = DB::table('proyek')->where('id', $id)->first();
    return view('admin.proyek.edit-proyek', compact('proyek'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'detail' => 'required|string',
        'deskripsi' => 'required|string',
        'kategori' => 'required',
        'anggaran' => 'required|numeric',
        'batas_akhir' => 'required|date',
        'lokasi' => 'required|in:Remote,Onsite',
        'lampiran' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    $data = [
        'detail' => $request->detail,
        'deskripsi' => $request->deskripsi,
        'kategori' => $request->kategori,
        'anggaran' => $request->anggaran,
        'batas_akhir' => $request->batas_akhir,
        'lokasi' => $request->lokasi,
    ];

    if ($request->hasFile('lampiran')) {
        $file = $request->file('lampiran');
        $namaFile = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('public/lampiran', $namaFile);

        $data['file_lampiran'] = $path;
    }

    DB::table('proyek')->where('id', $id)->update($data);

    return redirect()->route('admin.proyek.form-proyek')->with('success', 'Proyek berhasil diperbarui!');
}

     public function destroy($id)
    {
        DB::table('proyek')->where('id', $id)->delete();

        return redirect()->route('admin.proyek.form-proyek')->with('success', 'Data berhasil dihapus!');
    }
}
