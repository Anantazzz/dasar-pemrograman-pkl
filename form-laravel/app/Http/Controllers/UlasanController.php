<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use Illuminate\Http\Request;

class UlasanController extends Controller
{
    public function index(Request $request)
    {
    $search = $request->input('search');
    $sort = $request->get('sort', 'id_desc');
    $data = \App\Models\Ulasan::query()
        ->when($search, function($query, $search) {
            $query->where('ulasan', 'like', "%{$search}%")
                  ->orWhere('rating', 'like', "%{$search}%");
        });

    if ($sort === 'id_asc') {
        $data->orderBy('id', 'asc');
    } else {
        $data->orderBy('id', 'desc');
    }

    $data = $data->paginate(10)->appends(request()->all()); 

    return view('admin.ulasan.index', compact('data', 'search', 'sort'));
    }

    public function show($id)
    {
        $ulasan = Ulasan::findOrFail($id);
        return view('admin.ulasan.show', compact('ulasan'));
    }

    public function create()
    {
        return view('admin.ulasan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'ulasan' => 'required|string',
        ]);

        Ulasan::create([
            'rating' => $request->rating,
            'ulasan' => $request->ulasan,
        ]);

        return redirect()->route('admin.ulasan.index')->with('success', 'Ulasan berhasil dikirim!');
    }

    public function edit($id)
    {
        $ulasan = Ulasan::findOrFail($id);
        return view('admin.ulasan.edit', compact('ulasan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'ulasan' => 'required|string',
        ]);

        $ulasan = Ulasan::findOrFail($id);

        $ulasan->update([
            'rating' => $request->rating,
            'ulasan' => $request->ulasan,
        ]);

        return redirect()->route('admin.ulasan.index')->with('success', 'Ulasan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $ulasan = Ulasan::findOrFail($id);
        $ulasan->delete();

        return redirect()->route('admin.ulasan.index')->with('success', 'Data berhasil dihapus!');
    }
}
