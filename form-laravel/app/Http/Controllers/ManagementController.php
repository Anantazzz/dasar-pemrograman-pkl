<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Management;

class ManagementController extends Controller
{
   public function index(Request $request)
    {
    $search = $request->input('search');
    $sort = $request->get('sort', 'id_desc'); 

    $tugas = \App\Models\Management::query()
        ->when($search, function($query, $search) {
            $query->where('judul_tugas', 'like', "%{$search}%")
                  ->orWhere('deskripsi_tugas', 'like', "%{$search}%");
        });

    if ($sort === 'id_asc') {
        $tugas->orderBy('id', 'asc');
    } else {
        $tugas->orderBy('id', 'desc');
    }

    $tugas = $tugas->paginate(10)->appends(request()->all()); 

    return view('admin.management.index', compact('tugas', 'search', 'sort'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_tugas.*'     => 'nullable|string|max:255',
            'deskripsi_tugas.*' => 'nullable|string',
            'batas_akhir.*'     => 'nullable|date',
            'status.*'          => 'nullable|string',
            'progress.*'        => 'nullable|integer|min:0|max:100'
        ]);

        Management::truncate();

        $judul_tugas     = $request->judul_tugas ?? [];
        $deskripsi_tugas = $request->deskripsi_tugas ?? [];
        $batas_akhir     = $request->batas_akhir ?? [];
        $status          = $request->status ?? [];
        $progress        = $request->progress ?? [];

        for ($i = 0; $i < count($judul_tugas); $i++) {
            if (trim($judul_tugas[$i]) === '') {
                continue;
            }

            Management::create([
                'judul_tugas'     => $judul_tugas[$i],
                'deskripsi_tugas' => $deskripsi_tugas[$i],
                'batas_akhir'     => $batas_akhir[$i],
                'status'          => $status[$i],
                'progress'        => $progress[$i],
            ]);
        }

        return redirect()
            ->route('admin.management.index')
            ->with('success', 'Tugas berhasil diperbarui!');
    }

    public function show($id)
    {
        $management = Management::findOrFail($id);
        return view('admin.management.show', compact('management'));
    }

    public function destroy($id)
    {
        $tugas = Management::find($id);

        if (!$tugas) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }

        $tugas->delete();

        return response()->json(['success' => true]);
    }
}
