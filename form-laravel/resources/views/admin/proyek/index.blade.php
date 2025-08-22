@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Data Proyek</h2>

    <form action="{{ route('admin.proyek.index') }}" method="GET" 
          class="mb-3 d-flex" style="gap:10px; max-width:400px;">
        <input 
            type="text" 
            name="search" 
            value="{{ request('search') }}" 
            class="form-control" 
            placeholder="Cari detail, deskripsi, atau kategori..."
        >

         <select name="sort" class="form-control select2" onchange="this.form.submit()">
            <option value="id_desc" {{ request('sort') == 'id_desc' ? 'selected' : '' }}>ID Descending</option>
            <option value="id_asc" {{ request('sort') == 'id_asc' ? 'selected' : '' }}>ID Ascending</option>
        </select>
        
        <button type="submit" class="btn btn-primary">Cari</button>
    </form>

    <a href="{{ route('admin.proyek.create') }}" class="btn btn-primary mb-3">+ Tambah Data</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Detail</th>
                <th>Deskripsi</th>
                <th>Kategori</th>
                <th>Anggaran</th>
                <th>Batas Akhir</th>
                <th>Lampiran</th>
                <th>Lokasi Pengerjaan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->detail }}</td>
                <td>{{ $item->deskripsi }}</td>
                <td>{{ ucfirst($item->kategori) }}</td>
                <td>{{ $item->anggaran }}</td>
                <td>{{ $item->batas_akhir }}</td>
                <td>{{ $item->lampiran }}</td>
                <td>{{ $item->lokasi_pengerjaan }}</td>
                <td>
                    <a href="{{ route('admin.proyek.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.proyek.destroy', $item->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9" class="text-center">Belum ada data proyek.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-3">
        {{ $data->withQueryString()->onEachSide(1)->links('pagination::bootstrap-4') }}
    </div>

    <style>
        .pagination {
            justify-content: center;
        }
        .pagination .page-item .page-link {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;     
        }
    </style>
</div>
@endsection
