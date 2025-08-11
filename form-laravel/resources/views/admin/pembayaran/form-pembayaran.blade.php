@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Data Pembayaran</h2>
        <a href="{{ route('admin.pembayaran.create-pembayaran') }}" class="btn btn-primary mb-3">+ Tambah Data</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Proyek</th>
                    <th>Jumlah</th>
                    <th>Metode</th>
                    <th>Setuju</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->proyek }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>{{ ucfirst($item->metode) }}</td>
                    <td>{{ $item->setuju ? 'Ya' : 'Tidak' }}</td>
                    <td>
                     <a href="{{ route('admin.pembayaran.form-pembayaran.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.pembayaran.form-pembayaran.destroy', $item->id) }}" method="POST" style="display:inline;">
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
