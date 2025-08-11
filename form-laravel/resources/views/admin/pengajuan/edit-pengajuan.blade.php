@extends('layouts.app')
<link href="{{ asset('css/pengajuan.css') }}" rel="stylesheet">

@section('content')
<div class="payment-container">
    <div class="form-box">
        <h2 class="form-title">Edit Pengajuan</h2>
        <form action="{{ route('admin.pengajuan.form-pengajuan.update', $pengajuan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <p class="project-name">Proyek: <strong>Desain Logo Perusahaan Baru</strong></p>
            <input type="hidden" name="form_pengajuan" value="1">

           <x-input 
                label="Jumlah Penawaran Anda (IDR)" 
                name="penawaran" 
                type="number" 
                required 
                min="0" 
                step="1000"
                value="{{ $pengajuan->penawaran }}"
            />

            <x-textarea 
                label="Pesan / Proposal Anda" 
                name="pesan" 
                required 
                value="{{ $pengajuan->pesan }}"
            />

            <x-input 
                label="Perkiraan Durasi Pengerjaan (Hari)" 
                name="durasi" 
                type="number" 
                required 
                min="1" 
                step="1"
                 value="{{ $pengajuan->durasi }}"
            />
                <div class="button-group">
                    <a href="{{ route('admin.pengajuan.form-pengajuan') }}" class="btn-cancel">Batal</a>
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
