<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
      public function index()
    {
    
        $users = User::orderBy('created_at', 'desc')->get();

        return view('admin.registrasi.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.registrasi.show', compact('user'));
    }

     public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.registrasi.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name'  => $request->name,
            'email' => $request->email
        ]);

        return redirect()->route('admin.index')->with('success', 'User berhasil diupdate.');
    }

      public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.index')->with('success', 'User berhasil dihapus');
    }
}
