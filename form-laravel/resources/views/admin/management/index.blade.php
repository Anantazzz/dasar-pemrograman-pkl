@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Manajemen Tugas Proyek</h2>
    <p>Proyek: <strong>Pembangunan Aplikasi E-commerce</strong></p>

    <form action="{{ route('admin.management.index') }}" method="GET" class="mb-3 d-flex gap-2" style="max-width:400px;">
        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari judul atau deskripsi tugas...">
        <select name="sort" class="form-control select2" onchange="this.form.submit()">
            <option value="id_desc" {{ request('sort') == 'id_desc' ? 'selected' : '' }}>ID Descending</option>
            <option value="id_asc" {{ request('sort') == 'id_asc' ? 'selected' : '' }}>ID Ascending</option>
        </select>
        <button type="submit" class="btn btn-primary">Cari</button>
    </form>

    <form action="{{ route('admin.management.store') }}" method="POST">
        @csrf
        <div class="card">
            <table class="table table-bordered" id="taskTable">
                <thead>
                    <tr>
                        <th>Judul Tugas</th>
                        <th>Deskripsi Tugas</th>
                        <th>Batas Akhir</th>
                        <th>Status</th>
                        <th>Progress (%)</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="taskBody">
                    @forelse ($tugas as $row)
                        <tr>
                            <td><input type="text" name="judul_tugas[]" value="{{ $row->judul_tugas }}" class="form-control"></td>
                            <td><input type="text" name="deskripsi_tugas[]" value="{{ $row->deskripsi_tugas }}" class="form-control"></td>
                            <td><input type="date" name="batas_akhir[]" value="{{ $row->batas_akhir }}" class="form-control"></td>
                            <td>
                                <select name="status[]" class="form-control">
                                    <option {{ $row->status == 'Belum Mulai' ? 'selected' : '' }}>Belum Mulai</option>
                                    <option {{ $row->status == 'Dalam Proses' ? 'selected' : '' }}>Dalam Proses</option>
                                    <option {{ $row->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                </select>
                            </td>
                            <td>
                                <input type="hidden" name="progress[]" value="{{ $row->progress }}">
                                <input type="range" min="0" max="100" value="{{ $row->progress }}" oninput="this.previousElementSibling.value=this.value">
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm" onclick="hapusTugas({{ $row->id }}, this)">Hapus</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada tugas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-start gap-2 mt-3">
                <button type="button" class="btn btn-primary" onclick="tambahTugas()">+ Tambah Tugas</button>
                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            </div>

            <div class="mt-3">
                {{ $tugas->withQueryString()->onEachSide(1)->links('pagination::bootstrap-4') }}
            </div>

            @if(session('success'))
                <p class="text-success mt-2">✅ {{ session('success') }}</p>
            @endif
        </div>
    </form>
</div>

<script>
    function hapusTugas(id, el) {
        if (confirm('Yakin mau hapus tugas ini?')) {
            fetch(`/admin/management/delete/${id}`, {
                method: 'DELETE',
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
            })
            .then(res => res.json())
            .then(data => {
                if(data.success) el.closest('tr').remove();
                else alert('Gagal hapus data!');
            });
        }
    }

    function tambahTugas() {
        const tbody = document.getElementById('taskBody');
        const row = tbody.rows[tbody.rows.length - 1].cloneNode(true);
        const inputs = row.querySelectorAll('input, select');
        inputs.forEach(input => {
            if (input.type === 'text' || input.tagName === 'SELECT') input.value = '';
            if (input.type === 'date') input.value = '';
            if (input.type === 'hidden') input.value = '0';
            if (input.type === 'range') input.value = 0;
        });
        tbody.appendChild(row);
    }

    function hapusBaris(el) {
        const row = el.closest('tr');
        if(document.querySelectorAll('#taskBody tr').length > 1) row.remove();
    }
</script>
@endsection
