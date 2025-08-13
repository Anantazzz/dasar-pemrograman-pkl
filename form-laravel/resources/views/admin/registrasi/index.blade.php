@extends('layouts.app')

@section('content')
<div class="container">

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Tipe Pengguna</th>
                <th>Telepon</th>
                <th>Bio</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->tipe_pengguna }}</td>
                <td>{{ $user->telepon ?? '-' }}</td>
                <td>{{ Str::limit(strip_tags($user->bio), 50) ?? '-' }}</td>
                <td>
                    @if($user->gambar)
                        <img src="{{ asset('storage/' . $user->gambar) }}" width="80">
                    @else
                        Tidak ada gambar
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.destroy', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus user ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
