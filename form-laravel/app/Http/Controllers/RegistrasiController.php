<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class RegistrasiController extends Controller
{
     public function formAdmin()
    {
    $data = DB::table('registrasi')->get();
    return view('admin.registrasi.form-registrasi', compact('data'));
    }

     public function create()
    {
        return view('admin.registrasi.create-registrasi');
    }

    public function store(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'email' => 'required|email|unique:registrasi,email',
        'password' => 'required|min:6|confirmed',
        'tipe_pengguna' => 'required|in:Klien,Freelancer',
        'telepon' => 'required|max:13',
        'bio' => 'required|string',
        'gambar' => 'required|image|max:2048',
    ]);

    if ($request->hasFile('gambar')) {
    $gambar = $request->file('gambar');
    $namaFile = time() . '_' . $gambar->getClientOriginalName();
    $path = $gambar->storeAs('public/gambar', $namaFile); 
    } else {
        return back()->with('error', 'Gambar tidak ditemukan.');
    }

    DB::table('registrasi')->insert([
        'nama' => $request->nama,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'tipe_pengguna' => $request->tipe_pengguna,
        'telepon' => $request->telepon,
        'bio' => $request->bio,
        'gambar' => $path,
    ]);

    return redirect('/form-registrasi')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
    $registrasi = DB::table('registrasi')->where('id', $id)->first();
    return view('admin.registrasi.edit-registrasi', compact('registrasi'));
    }

    public function update(Request $request, $id)
    {
         if ($request->hasFile('gambar')) {
        $gambar = $request->file('gambar');
        $namaFile = time() . '_' . $gambar->getClientOriginalName();
        $path = $gambar->storeAs('public/gambar', $namaFile); 
    } else {
        return back()->with('error', 'Gambar tidak ditemukan.');
    }
        DB::table('registrasi')->where('id', $id)->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'tipe_pengguna' => $request->tipe_pengguna,
            'telepon' => $request->telepon,
            'bio' => $request->bio,
            'gambar' => $path,
        ]);

        return redirect()->route('admin.registrasi.form-registrasi')->with('success', 'Data berhasil diperbarui!');
    }

     public function destroy($id)
    {
        DB::table('registrasi')->where('id', $id)->delete();

        return redirect()->route('admin.registrasi.form-registrasi')->with('success', 'Data berhasil dihapus!');
    }
}
