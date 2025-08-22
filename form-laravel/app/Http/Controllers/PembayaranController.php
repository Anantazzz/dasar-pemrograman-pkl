<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;

class PembayaranController extends Controller
{
   public function index(Request $request)
    {
    $query = Pembayaran::query();

    if ($request->filled('search')) {
        $query->where(function($q) use ($request) {
            $q->where('proyek', 'like', '%' . $request->search . '%')
              ->orWhere('jumlah', 'like', '%' . $request->search . '%');
        });
    }

    $sort = $request->get('sort', 'id_desc');
    if ($sort === 'id_asc') {
        $query->orderBy('id', 'asc');
    } else { 
        $query->orderBy('id', 'desc');
    }

    $data = $query->paginate(10);

    $data->appends($request->all());

    return view('admin.pembayaran.index', compact('data')); 
    }

    public function show($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        return view('admin.pembayaran.show', compact('pembayaran'));
    }

    public function create()
    {
        return view('admin.pembayaran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jumlah' => 'required|numeric|min:0',
            'metode' => 'required|string',
            'setuju' => 'accepted',
        ]);

        Pembayaran::create([
            'proyek' => 'Pembangunan Aplikasi E-commerce',
            'jumlah' => $request->jumlah,
            'metode' => $request->metode,
            'setuju' => 1,
        ]);

        return redirect()
            ->route('admin.pembayaran.index')
            ->with('success', 'Pembayaran berhasil disimpan.');
    }

    public function edit($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        return view('admin.pembayaran.edit', compact('pembayaran'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jumlah' => 'required|numeric|min:0',
            'metode' => 'required|string',
            'setuju' => 'accepted',
        ]);

        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->update([
            'jumlah' => $request->jumlah,
            'metode' => $request->metode,
            'setuju' => 1,
        ]);

        return redirect()
            ->route('admin.pembayaran.index')
            ->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->deleted_at = now();
        $pembayaran->save();

        return redirect()
            ->route('admin.pembayaran.index')
            ->with('success', 'Data berhasil dihapus (soft delete)!');
    }
}
