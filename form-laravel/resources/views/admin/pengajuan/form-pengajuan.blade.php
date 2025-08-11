@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Data Pengajuan</h2>
        <a href="{{ route('admin.pengajuan.create-pengajuan') }}" class="btn btn-primary mb-3">+ Tambah Data</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Proyek</th>
                    <th>Penawaran</th>
                    <th>Pesan</th>
                    <th>Durasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->proyek }}</td>
                    <td>{{ $item->penawaran }}</td>
                    <td>{{ ucfirst($item->pesan) }}</td>
                    <td>{{ $item->durasi }}</td>
                    <td>
                      <a href="{{ route('admin.pengajuan.form-pengajuan.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.pengajuan.form-pengajuan.destroy', $item->id) }}" method="POST" style="display:inline;">
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
