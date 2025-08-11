@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Data Ulasan</h2>
        <a href="{{ route('admin.ulasan.create-ulasan') }}" class="btn btn-primary mb-3">+ Tambah Data</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Rating</th>
                    <th>Ulasan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->rating }}</td>
                    <td>{{ $item->ulasan }}</td>
                    <td>
                      <a href="{{ route('admin.ulasan.form-ulasan.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.ulasan.form-ulasan.destroy', $item->id) }}" method="POST" style="display:inline;">
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
