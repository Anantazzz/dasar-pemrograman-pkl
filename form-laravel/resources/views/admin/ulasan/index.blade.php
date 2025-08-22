@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Data Ulasan</h2>

    <form action="{{ route('admin.ulasan.index') }}" method="GET" 
          class="mb-3 d-flex" style="gap:10px; max-width:400px;">
        <input 
            type="text" 
            name="search" 
            value="{{ request('search') }}" 
            class="form-control" 
            placeholder="Cari ulasan atau rating..."
        >

        <select name="sort" class="form-control select2" onchange="this.form.submit()">
            <option value="id_desc" {{ request('sort') == 'id_desc' ? 'selected' : '' }}>ID Descending</option>
            <option value="id_asc" {{ request('sort') == 'id_asc' ? 'selected' : '' }}>ID Ascending</option>
        </select>
        
        <button type="submit" class="btn btn-primary">Cari</button>
    </form>

    <a href="{{ route('admin.ulasan.create') }}" class="btn btn-primary mb-3">+ Tambah Data</a>

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
            @forelse($data as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->rating }}</td>
                <td>{{ $item->ulasan }}</td>
                <td>
                    <a href="{{ route('admin.ulasan.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.ulasan.destroy', $item->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">Belum ada data ulasan.</td>
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
