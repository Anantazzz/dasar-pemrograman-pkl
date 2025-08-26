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
            placeholder="Cari berdasarkan proyek atau jumlah..."
        >

         <select name="sort" class="form-control select2" onchange="this.form.submit()">
            <option value="id_desc" {{ request('sort') == 'id_desc' ? 'selected' : '' }}>ID Descending</option>
            <option value="id_asc" {{ request('sort') == 'id_asc' ? 'selected' : '' }}>ID Ascending</option>
        </select>
        
        <button type="submit" class="btn btn-primary">Cari</button>
    </form>

    <a href="{{ route('admin.proyek.create') }}" class="btn btn-primary mb-3">
        + Tambah Data
    </a>

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-bordered align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Detail</th>
                    <th style="min-width:150px;">Deskripsi</th>
                    <th>Kategori</th>
                    <th>Anggaran</th>
                    <th>Batas Akhir</th>
                    <th style="min-width:200px;">Lampiran</th>
                    <th>Lokasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->detail }}</td>
                        <td class="text-wrap">{{ $item->deskripsi }}</td>
                        <td>{{ ucfirst($item->kategori) }}</td>
                        <td>{{ number_format($item->anggaran, 0, ',', '.') }}</td>
                        <td>{{ $item->batas_akhir }}</td>
                        <td class="text-wrap" style="word-break:break-word;">
                            {{ $item->lampiran ?? '-' }}
                        </td>
                        <td>{{ ucfirst($item->lokasi_pengerjaan) }}</td>
                        <td class="d-flex gap-2 flex-wrap">
                            <a href="{{ route('admin.proyek.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                Edit
                            </a>

                            <form action="{{ route('admin.proyek.destroy', $item->id) }}" method="POST" 
                                  onsubmit="return confirm('Yakin hapus?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
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
    </div>

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
        td.text-wrap, th.text-wrap {
            white-space: normal !important;
            word-break: break-word;
        }
    </style>
</div>
@endsection
