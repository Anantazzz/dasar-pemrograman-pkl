<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManagementController extends Controller
{
    public function formAdmin()
    {
        $tugas = DB::table('management')->where('proyek', 'Pembangunan Aplikasi E-commerce')->get();
        return view('admin.management.form-management', compact('tugas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_tugas.*' => 'nullable|string|max:255',
            'deskripsi_tugas.*' => 'nullable|string',
            'batas_akhir.*' => 'nullable|date',
            'status.*' => 'nullable|string',
            'progress.*' => 'nullable|integer|min:0|max:100'
        ]);

        DB::table('management')->where('proyek', 'Pembangunan Aplikasi E-commerce')->delete();

        $judul_tugas = $request->judul_tugas ?? [];
        $deskripsi_tugas = $request->deskripsi_tugas ?? [];
        $batas_akhir = $request->batas_akhir ?? [];
        $status = $request->status ?? [];
        $progress = $request->progress ?? [];

        for ($i = 0; $i < count($judul_tugas); $i++) {
            if (trim($judul_tugas[$i]) == '') continue;

            DB::table('management')->insert([
                'proyek' => 'Pembangunan Aplikasi E-commerce',
                'judul_tugas' => $judul_tugas[$i],
                'deskripsi_tugas' => $deskripsi_tugas[$i],
                'batas_akhir' => $batas_akhir[$i],
                'status' => $status[$i],
                'progress' => $progress[$i],
            ]);
        }

        return redirect()->route('admin.management.form-management')->with('success', 'Tugas berhasil diperbarui!');
    }

        public function destroy($id)
        {
            $deleted = DB::table('management')->where('id', $id)->delete();
            return response()->json(['success' => $deleted]);
        }
}
