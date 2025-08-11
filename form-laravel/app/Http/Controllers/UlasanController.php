<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UlasanController extends Controller
{
     public function formAdmin()
    {
    $data = DB::table('ulasan')->get();
    return view('admin.ulasan.form-ulasan', compact('data'));
    }

    public function create()
    {
        return view('admin.ulasan.create-ulasan');
    }

    public function store(Request $request)
{
    $request->validate([
        'rating' => 'required|integer|min:1|max:5',
        'ulasan' => 'required|string',
    ]);

    DB::table('ulasan')->insert([
        'rating' => $request->rating,
        'ulasan' => $request->ulasan,
    ]);

    return redirect()->route('admin.ulasan.form-ulasan')->with('success', 'Ulasan berhasil dikirim!');
}

    public function edit($id)
    {
    $ulasan = DB::table('ulasan')->where('id', $id)->first();
    return view('admin.ulasan.edit-ulasan', compact('ulasan'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'rating' => 'required|integer|min:1|max:5',
        'ulasan' => 'required|string'
    ]);

    $data = [
        'id' => $request->id,
        'rating' => $request->rating,
        'ulasan' => $request->ulasan,
    ];

    DB::table('ulasan')->where('id', $id)->update($data);

    return redirect()->route('admin.ulasan.form-ulasan')->with('success', 'Ulasan berhasil diperbarui!');
}

    public function destroy($id)
    {
        DB::table('ulasan')->where('id', $id)->delete();

        return redirect()->route('admin.ulasan.form-ulasan')->with('success', 'Data berhasil dihapus!');
    }
}
