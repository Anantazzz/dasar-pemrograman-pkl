@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Data Portofolio</h2>
    <a href="{{ route('admin.portofolio.create') }}" class="btn btn-primary mb-3">
        + Tambah Portofolio
    </a>

 <form action="{{ route('admin.portofolio.index') }}" method="GET" class="mb-3 d-flex" style="gap:10px; max-width:400px;">
    <input 
        type="text" 
        name="search" 
        value="{{ request('search') }}" 
        class="form-control" 
        placeholder="Cari judul atau keahlian..."
    >

     <select name="sort" class="form-control select2" onchange="this.form.submit()">
        <option value="id_desc" {{ request('sort') == 'id_desc' ? 'selected' : '' }}>ID Descending</option>
        <option value="id_asc" {{ request('sort') == 'id_asc' ? 'selected' : '' }}>ID Ascending</option>
    </select>

    <button type="submit" class="btn btn-primary">Cari</button>
</form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>Ringkasan</th>
                <th>Keahlian</th>
                <th>Warna Tema</th>
                <th>Koordinat</th>
                <th>Layanan</th>
                <th>Terbuka Klien</th>
                <th>Setuju</th>
                <th>Gambar</th>
                <th>Item Proyek</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($portofolio_satu as $portofolio)
                <tr>
                    <td>{{ $portofolio->id }}</td>
                    <td>{{ $portofolio->judul_portofolio }}</td>
                    <td>{{ Str::limit(strip_tags($portofolio->ringkasan), 50) }}</td>
                    <td>{{ $portofolio->keahlian }}</td>
                    <td>
                        <span style="display:inline-block;width:20px;height:20px;
                            background-color:{{ $portofolio->warna_tema }}"></span>
                        {{ $portofolio->warna_tema }}
                    </td>
                    <td>
                        @if($portofolio->lpl)
                            {{ $portofolio->lpl->latitude }}, {{ $portofolio->lpl->longitude }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if($portofolio->lpl && $portofolio->lpl->layanan)
                            @php 
                                $layanan = json_decode($portofolio->lpl->layanan, true); 
                            @endphp
                            {{ is_array($layanan) ? implode(', ', $layanan) : $layanan }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        {{ $portofolio->lpl ? ($portofolio->lpl->terbuka_klien ? 'Ya' : 'Tidak') : '-' }}
                    </td>
                    <td>
                        {{ $portofolio->lpl ? ($portofolio->lpl->setuju ? 'Ya' : 'Belum ada') : 'Belum ada' }}
                    </td>
                    <td>
                        @if($portofolio->gambars && count($portofolio->gambars))
                            @foreach($portofolio->gambars as $g)
                                <img src="{{ asset('storage/' . $g->file_path) }}" width="100">
                            @endforeach
                        @else
                            Tidak ada gambar
                        @endif
                    </td>
                    <td>
                        @if($portofolio->items && count($portofolio->items))
                            @foreach($portofolio->items as $item)
                                <div style="margin-bottom:10px;">
                                    <strong>{{ $item->judul_proyek }}</strong><br>
                                    {{ $item->deskripsi_singkat }}<br>
                                    <a href="{{ $item->url_proyek }}" target="_blank">
                                        {{ $item->url_proyek }}
                                    </a>
                                </div>
                            @endforeach
                        @else
                            Tidak ada item
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.portofolio.edit', $portofolio->id) }}" 
                           class="btn btn-sm btn-warning">
                            Edit
                        </a>
                        <form action="{{ route('admin.portofolio.destroy', $portofolio->id) }}" 
                              method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" 
                                    onclick="return confirm('Yakin hapus?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
        <div class="mt-3">
        {{ $portofolio_satu->withQueryString()->onEachSide(1)->links('pagination::bootstrap-4') }}
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