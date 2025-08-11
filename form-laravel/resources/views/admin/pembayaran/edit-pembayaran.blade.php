@extends('layouts.app')
<link href="{{ asset('css/pembayaran.css') }}" rel="stylesheet">

@section('content')
<div class="payment-container">
    <div class="form-box">
        <h2 class="form-title">Edit Pembayaran</h2>
        <form action="{{ route('admin.pembayaran.form-pembayaran.update', $pembayaran->id) }}" method="POST">
            @csrf
            @method('PUT')

            <p class="project-name">Proyek: <strong>Pembangunan Aplikasi E-commerce</strong></p>
            <input type="hidden" name="form_pembayaran" value="1">

            <x-input 
                label="Jumlah Pembayaran" 
                name="jumlah" 
                type="number" 
                required 
                min="0" 
                step="100" 
                :value="$pembayaran->jumlah"
            />

            <x-select 
                label="Metode" 
                name="metode" 
                :options="[
                    'transfer' => 'Transfer',
                    'tunai' => 'Tunai',
                ]"
                :selected="$pembayaran->metode"
            />

            <div class="agreement">
                <label for="setuju" class="setuju-text">Setuju?</label>
                <label class="switch">
                    <input type="checkbox" name="setuju" id="setuju" {{ $pembayaran->setuju ? 'checked' : '' }}>
                    <span class="slider round"></span>
                </label>
            </div>
                <div class="button-group">
                    <a href="{{ route('admin.pembayaran.form-pembayaran') }}" class="btn-cancel">Batal</a>
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
