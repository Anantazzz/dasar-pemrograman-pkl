@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Data Proyek</h2>
        <a href="{{ route('admin.proyek.create-proyek') }}" class="btn btn-primary mb-3">+ Tambah Data</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Detail</th>
                    <th>Deskripsi</th>
                    <th>Kategori</th>
                    <th>Anggaran</th>
                    <th>Batas_Akhir</th>
                    <th>File_Lampiran</th>
                    <th>Lokasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->detail }}</td>
                    <td>{{ $item->deskripsi }}</td>
                    <td>{{ ucfirst($item->kategori) }}</td>
                    <td>{{ $item->anggaran }}</td>
                    <td>{{ $item->batas_akhir }}</td>
                    <td>{{ $item->file_lampiran }}</td>
                    <td>{{ $item->lokasi }}</td>
                    <td>
                      <a href="{{ route('admin.proyek.form-proyek.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.proyek.form-proyek.destroy', $item->id) }}" method="POST" style="display:inline;">
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
