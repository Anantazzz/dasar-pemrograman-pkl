<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    public function formAdmin()
    {
    $data = DB::table('pengajuan')->get();
    return view('admin.pengajuan.form-pengajuan', compact('data'));
    }

     public function create()
    {
        return view('admin.pengajuan.create-pengajuan');
    }

    public function store(Request $request)
    {
    $request->validate([
        'proyek' => 'required|string|max:255',
        'penawaran' => 'required|numeric|min:0',
        'pesan' => 'nullable|string',
        'durasi' => 'required|integer|min:1',
    ]);

    DB::table('pengajuan')->insert([
        'proyek' => 'Desain Logo Perusahaan Baru',
        'penawaran' => $request->penawaran,
        'pesan' => $request->pesan,
        'durasi' => $request->durasi,
    ]);

    return redirect('/form-pengajuan')->with('success', 'Pengajuan berhasil disimpan.');
    }

     public function edit($id)
    {
    $pengajuan = DB::table('pengajuan')->where('id', $id)->first();
    return view('admin.pengajuan.edit-pengajuan', compact('pengajuan'));
    }

    public function update(Request $request, $id)
    {
        DB::table('pengajuan')->where('id', $id)->update([
            'penawaran' => $request->penawaran,
            'pesan' => $request->pesan,
            'durasi' => $request->durasi,
        ]);

        return redirect()->route('admin.pengajuan.form-pengajuan')->with('success', 'Data berhasil diperbarui!');
    }

     public function destroy($id)
    {
        DB::table('pengajuan')->where('id', $id)->delete();

        return redirect()->route('admin.pengajuan.form-pengajuan')->with('success', 'Data berhasil dihapus!');
    }
}