@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="card card-primary shadow-sm">
                <div class="card-header">
                    <h3 class="card-title">Edit Proyek</h3>
                </div>

                <form action="{{ route('admin.proyek.update', $proyek->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        
                        {{-- Detail Proyek --}}
                        <div class="form-group">
                            <label for="detail">Detail Proyek</label>
                            <textarea name="detail" id="detail" class="form-control" rows="3" required>{{ old('detail', $proyek->detail) }}</textarea>
                            @error('detail')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Deskripsi Proyek --}}
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi Proyek</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3" required>{{ old('deskripsi', $proyek->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Kategori --}}
                        <div class="form-group">
                            <label for="kategori">Kategori Proyek</label>
                            <select name="kategori" id="kategori" class="form-control select2" required>
                                <option value="Penulisan Konten" {{ old('kategori', $proyek->kategori) == 'Penulisan Konten' ? 'selected' : '' }}>Penulisan Konten</option>
                                <option value="Desain Grafis" {{ old('kategori', $proyek->kategori) == 'Desain Grafis' ? 'selected' : '' }}>Desain Grafis</option>
                                <option value="Pengembangan Web" {{ old('kategori', $proyek->kategori) == 'Pengembangan Web' ? 'selected' : '' }}>Pengembangan Web</option>
                            </select>
                            @error('kategori')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Anggaran --}}
                        <div class="form-group">
                            <label for="anggaran">Anggaran Proyek (IDR)</label>
                            <input type="number" name="anggaran" id="anggaran" class="form-control" 
                                min="0" step="1000" value="{{ old('anggaran', $proyek->anggaran) }}" required>
                            @error('anggaran')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Deadline --}}
                        <div class="form-group">
                            <label for="batas_akhir">Batas Akhir Penawaran</label>
                            <input type="datetime-local" name="batas_akhir" id="batas_akhir" class="form-control" 
                                value="{{ old('batas_akhir', $proyek->batas_akhir) }}" required>
                            @error('batas_akhir')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Lampiran --}}
                        <div class="form-group">
                            <label for="lampiran">Lampiran Proyek</label>
                            <input type="file" name="lampiran" id="lampiran" class="form-control-file"
                                accept=".png,.jpg,.jpeg,.pdf">
                            <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah lampiran.</small>
                            @error('lampiran')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Lokasi --}}
                        <div class="form-group">
                            <label>Lokasi Pengerjaan</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" 
                                    name="lokasi_pengerjaan" id="remote" value="remote" 
                                    {{ old('lokasi_pengerjaan', $proyek->lokasi_pengerjaan) == 'remote' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="remote">Remote</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" 
                                    name="lokasi_pengerjaan" id="onsite" value="onsite" 
                                    {{ old('lokasi_pengerjaan', $proyek->lokasi_pengerjaan) == 'onsite' ? 'checked' : '' }}>
                                <label class="form-check-label" for="onsite">Onsite</label>
                            </div>
                            @error('lokasi_pengerjaan')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('admin.proyek.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Update Proyek</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function () {
        $('#kategori').select2({
            placeholder: "Pilih Kategori Proyek",
            allowClear: true,
            width: '100%'
        });
    });
</script>
@endpush
