@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Data Registrasi pengguna</h2>
        <a href="{{ route('admin.registrasi.create-registrasi') }}" class="btn btn-primary mb-3">+ Tambah Data</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Tipe Pengguna</th>
                    <th>Telepon</th>
                    <th>Bio</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->password }}</td>
                    <td>{{ $item->tipe_pengguna }}</td>
                    <td>{{ $item->telepon }}</td>
                    <td>{{ $item->bio }}</td>
                    <td>{{ $item->gambar }}</td>
                    <td>
                      <a href="{{ route('admin.registrasi.form-registrasi.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.registrasi.form-registrasi.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
