<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function formAdmin()
    {
    $data = DB::table('pembayaran')->get();
    return view('admin.pembayaran.form-pembayaran', compact('data'));
    }

    public function create()
    {
        return view('admin.pembayaran.create-pembayaran');
    }

    public function store(Request $request)
    {
    $request->validate([
        'jumlah' => 'required|numeric|min:0',
        'metode' => 'required|string',
        'setuju' => 'nullable',
    ]);

    DB::table('pembayaran')->insert([
        'proyek' => 'Pembangunan Aplikasi E-commerce',
        'jumlah' => $request->jumlah,
        'metode' => $request->metode,
        'setuju' => $request->has('setuju') ? 1 : 0,
    ]);

    return redirect('/form-pembayaran')->with('success', 'Pembayaran berhasil disimpan.');
    }

    public function edit($id)
    {
    $pembayaran = DB::table('pembayaran')->where('id', $id)->first();
    return view('admin.pembayaran.edit-pembayaran', compact('pembayaran'));
    }

    public function update(Request $request, $id)
    {
        DB::table('pembayaran')->where('id', $id)->update([
            'jumlah' => $request->jumlah,
            'metode' => $request->metode,
            'setuju' => $request->has('setuju') ? 1 : 0,
        ]);

        return redirect()->route('admin.pembayaran.form-pembayaran')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        DB::table('pembayaran')->where('id', $id)->delete();

        return redirect()->route('admin.pembayaran.form-pembayaran')->with('success', 'Data berhasil dihapus!');
    }
}