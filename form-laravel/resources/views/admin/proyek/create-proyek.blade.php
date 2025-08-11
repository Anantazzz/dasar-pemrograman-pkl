@extends('layouts.app')
<link href="{{ asset('css/proyek.css') }}" rel="stylesheet">

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
            />

            <x-textarea 
                label="Deskripsi Proyek" 
                name="deskripsi" 
                required 
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
            />

            <x-input 
                label="Anggaran Proyek (IDR)" 
                name="anggaran" 
                type="number" 
                required 
                min="0" 
                step="1000"
            />

            <x-input 
                label="Batas Akhir Penawaran" 
                name="batas_akhir" 
                type="datetime-local" 
                required 
            />

            <x-input 
                label="Lampiran Proyek (PNG, JPG, PDF)" 
                name="lampiran" 
                type="file" 
                accept=".png,.jpg,.jpeg,.pdf" 
            />

            <div class="form-group mt-3">
                <label class="block mb-1 font-medium">Lokasi Pengerjaan</label>
                <label><input type="radio" name="lokasi" value="Remote" required> Remote</label><br>
                <label><input type="radio" name="lokasi" value="Onsite"> Onsite</label>
            </div>

            <button type="submit" class="btn-submit mt-4">Posting Proyek</button>
        </form>
    </div>
</div>
@endsection
