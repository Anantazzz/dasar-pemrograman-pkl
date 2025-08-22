@extends('layouts.app')

<link href="{{ asset('css/proyek.css') }}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">

@section('content')
<div class="payment-container">
    <div class="form-box">
        <h2 class="form-title">Posting Proyek Baru</h2>

        <form method="POST" action="{{ route('admin.proyek.store') }}" enctype="multipart/form-data">
            @csrf

            <x-textarea 
                label="Detail Proyek" 
                name="detail" 
                required
            >{{ old('detail') }}</x-textarea>
            @error('detail')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <x-textarea 
                label="Deskripsi Proyek" 
                name="deskripsi" 
                required
            >{{ old('deskripsi') }}</x-textarea>
            @error('deskripsi')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <div class="form-group mt-3">
                <label for="kategori" class="block mb-1 font-medium">Kategori Proyek</label>
                <select name="kategori" id="kategori" class="select2 w-full border rounded p-2" required>
                    <option value="" disabled selected>Pilih Kategori Proyek</option>
                    <option value="Penulisan Konten" {{ old('kategori')=='Penulisan Konten' ? 'selected' : '' }}>Penulisan Konten</option>
                    <option value="Desain Grafis" {{ old('kategori')=='Desain Grafis' ? 'selected' : '' }}>Desain Grafis</option>
                    <option value="Pengembangan Web" {{ old('kategori')=='Pengembangan Web' ? 'selected' : '' }}>Pengembangan Web</option>
                </select>
                @error('kategori')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <x-input 
                label="Anggaran Proyek (IDR)" 
                name="anggaran" 
                type="number" 
                required 
                min="0" 
                step="1000"
                :value="old('anggaran')"
            />
            @error('anggaran')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <x-input 
                label="Batas Akhir Penawaran" 
                name="batas_akhir" 
                type="datetime-local" 
                required
                :value="old('batas_akhir')"
            />
            @error('batas_akhir')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <x-input 
                label="Lampiran Proyek (PDF, DOCX, XLSX, ZIP)" 
                name="lampiran" 
                type="file" 
                accept=".pdf,.doc,.docx,.xls,.xlsx,.zip" 
                id="lampiran"
            />
            @error('lampiran')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <div class="form-group mt-3">
                <label class="block mb-1 font-medium">Lokasi Pengerjaan</label>
                <label>
                    <input type="radio" name="lokasi_pengerjaan" value="remote" {{ old('lokasi_pengerjaan')=='remote' ? 'checked' : '' }} required> Remote
                </label><br>
                <label>
                    <input type="radio" name="lokasi_pengerjaan" value="onsite" {{ old('lokasi_pengerjaan')=='onsite' ? 'checked' : '' }}> Onsite
                </label>
                @error('lokasi_pengerjaan')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn-submit mt-4">Posting Proyek</button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>

<script>
    $(document).ready(function() {
    
        $('#kategori').select2({
            placeholder: "Pilih Kategori Proyek",
            allowClear: true,
            width: '100%'
        });

        FilePond.create(document.querySelector('#lampiran'), {
            allowMultiple: false,
            allowFileTypeValidation: true,
            acceptedFileTypes: ['image/png', 'image/jpeg', 'application/pdf'],
            labelIdle: 'Drag & Drop atau <span class="filepond--label-action">Pilih File</span>'
        });
    });
</script>
@endpush
