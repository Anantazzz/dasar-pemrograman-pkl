@extends('layouts.app')

@section('content')

 <h2>Data Portofolio</h2>
    <form action="{{ route('admin.portofolio.index') }}" method="GET" 
          class="mb-3 d-flex" style="gap:10px; max-width:400px;">
        <input 
            type="text" 
            name="search" 
            value="{{ request('search') }}" 
            class="form-control" 
            placeholder="Cari berdasarkan judul..."
        >

         <select name="sort" class="form-control select2" onchange="this.form.submit()">
            <option value="id_desc" {{ request('sort') == 'id_desc' ? 'selected' : '' }}>ID Descending</option>
            <option value="id_asc" {{ request('sort') == 'id_asc' ? 'selected' : '' }}>ID Ascending</option>
        </select>
        
        <button type="submit" class="btn btn-primary">Cari</button>
    </form>

    <a href="{{ route('admin.portofolio.create') }}" class="btn btn-primary mb-3">
        + Tambah Data
    </a>

<div class="table-responsive">
    <table class="table table-bordered table-striped align-middle mb-0">
        <thead class="table-light">
            <tr>
                <th style="width: 50px; white-space: nowrap;">ID</th>
                <th style="width: 150px;">Judul</th>
                <th style="width: 150px;">Ringkasan</th>
                <th style="width: 150px;">Keahlian</th>
                <th style="width: 150px;">Warna Tema</th>
                <th style="width: 200px;">Koordinat</th>
                <th style="width: 150px;">Layanan</th>
                <th style="width: 150px;">Terbuka Klien</th>
                <th style="width: 150px;">Setuju</th>
                <th style="width: 150px;">Gambar</th>
                <th style="width: 150px;">Item Proyek</th>
                 <th style="width: 150px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($portofolio_satu as $portofolio)
                <tr>
                    <td>{{ $portofolio->id }}</td>
                    <td>{{ $portofolio->judul_portofolio }}</td>
                    <td class="text-truncate" style="max-width: 250px;">
                        {{ Str::limit(strip_tags($portofolio->ringkasan), 100) }}
                    </td>
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
                            @php $layanan = json_decode($portofolio->lpl->layanan, true); @endphp
                            {{ is_array($layanan) ? implode(', ', $layanan) : $layanan }}
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $portofolio->lpl ? ($portofolio->lpl->terbuka_klien ? 'Ya' : 'Tidak') : '-' }}</td>
                    <td>{{ $portofolio->lpl ? ($portofolio->lpl->setuju ? 'Ya' : 'Belum ada') : 'Belum ada' }}</td>
                    <td>
                        @if($portofolio->gambars && count($portofolio->gambars))
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($portofolio->gambars as $g)
                                    <img src="{{ asset('storage/' . $g->file_path) }}" class="img-thumbnail" style="max-width: 100px; height: auto;">
                                @endforeach
                            </div>
                        @else
                            Tidak ada gambar
                        @endif
                    </td>
                    <td>
                        @if($portofolio->items && count($portofolio->items))
                            @foreach($portofolio->items as $item)
                                <div class="mb-2 text-truncate" style="max-width:250px;">
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
                           class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.portofolio.destroy', $portofolio->id) }}" 
                              method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<style>
.table td, .table th {
    vertical-align: middle;
    white-space: normal;
    word-break: break-word;
}
</style>
@endsection