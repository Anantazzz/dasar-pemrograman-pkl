@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Data Pembayaran</h2>

    <form action="{{ route('admin.pembayaran.index') }}" method="GET" 
          class="mb-3 d-flex" style="gap:10px; max-width:400px;">
        <input 
            type="text" 
            name="search" 
            value="{{ request('search') }}" 
            class="form-control" 
            placeholder="Cari berdasarkan proyek atau jumlah..."
        >

         <select name="sort" class="form-control select2" onchange="this.form.submit()">
            <option value="id_desc" {{ request('sort') == 'id_desc' ? 'selected' : '' }}>ID Descending</option>
            <option value="id_asc" {{ request('sort') == 'id_asc' ? 'selected' : '' }}>ID Ascending</option>
        </select>
        
        <button type="submit" class="btn btn-primary">Cari</button>
    </form>

    <a href="{{ route('admin.pembayaran.create') }}" class="btn btn-primary mb-3">
        + Tambah Data
    </a>

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
            @forelse($data as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->proyek }}</td>
                    <td>{{ number_format($item->jumlah, 0, ',', '.') }}</td>
                    <td>{{ ucfirst($item->metode) }}</td>
                    <td>{{ $item->setuju ? 'Ya' : 'Tidak' }}</td>
                    <td class="d-flex gap-2">
                        <a 
                            href="{{ route('admin.pembayaran.edit', $item->id) }}" 
                            class="btn btn-sm btn-warning"
                        >
                            Edit
                        </a>

                        <form 
                            action="{{ route('admin.pembayaran.destroy', $item->id) }}" 
                            method="POST" 
                            onsubmit="return confirm('Yakin hapus?')"
                        >
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada data pembayaran.</td>
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
