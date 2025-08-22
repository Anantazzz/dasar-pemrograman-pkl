@extends('layouts.app')
<link href="{{ asset('css/proyek.css') }}" rel="stylesheet">

@section('content')
<div class="payment-container">
    <div class="form-box">
        <h2 class="form-title">Posting Proyek Baru</h2>

         <form action="{{ route('admin.proyek.update', $proyek->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <x-textarea 
                label="Detail Proyek" 
                name="detail" 
                required 
                value="{{ $proyek->detail }}"
            />

            <x-textarea 
                label="Deskripsi Proyek" 
                name="deskripsi" 
                required 
                value="{{ $proyek->deskripsi }}"
            />

            <x-select 
                label="Kategori Proyek" 
                name="kategori" 
                :options="[
                    'Penulisan Konten' => 'Penulisan Konten',
                    'Desain Grafis' => 'Desain Grafis',
                    'Pengembangan Web' => 'Pengembangan Web'
                ]" 
                required
                selected="{{ $proyek->kategori }}"
            />

            <x-input 
                label="Anggaran Proyek (IDR)" 
                name="anggaran" 
                type="number" 
                required 
                min="0" 
                step="1000"
                value="{{ $proyek->anggaran }}"
            />

            <x-input 
                label="Batas Akhir Penawaran" 
                name="batas_akhir" 
                type="datetime-local" 
                required 
                value="{{ $proyek->batas_akhir }}"
            />

            <x-input 
                label="Lampiran Proyek (PNG, JPG, PDF)" 
                name="lampiran" 
                type="file" 
                accept=".png,.jpg,.jpeg,.pdf" 
            />

            <div class="form-group mt-3">
                <label class="block mb-1 font-medium">Lokasi Pengerjaan</label>
                <label><input type="radio" name="lokasi_pengerjaan" value="remote" required> Remote</label><br>
                <label><input type="radio" name="lokasi_pengerjaan" value="onsite"> Onsite</label>
            </div>

            <div class="button-group">
                 <a href="{{ route('admin.proyek.index') }}" class="btn-cancel">Batal</a>
                 <button type="submit" class="btn-submit">Update</button>
            </div>
        </form>
    </div>
</div>
<style>
    .button-group {
    display: flex;
    gap: 10px;
    margin-top: 20px;
}

.btn-submit {
    flex: 1; 
    padding: 10px 20px;
    background-color: #28a745;
    color: white;
    border: none;
    border-radius: 5px;
    text-align: center;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-submit:hover {
    background-color: #218838;
}

.btn-cancel {
    flex: 1; 
    display: inline-block;
    padding: 10px 20px;
    background-color: #ccc;
    color: #000;
    text-align: center;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.btn-cancel:hover {
    background-color: #999;
}
</style>
@endsection
