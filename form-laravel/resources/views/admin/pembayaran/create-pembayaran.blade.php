@extends('layouts.app')
<link href="{{ asset('css/pembayaran.css') }}" rel="stylesheet">
@section('content')
<div class="payment-container">
    <div class="form-box">
        <h2 class="form-title">Pembayaran Proyek</h2>
        <form method="POST" action="{{ route('admin.pembayaran.store') }}">
            @csrf
            <p class="project-name">Proyek: <strong>Pembangunan Aplikasi E-commerce</strong></p>
            <input type="hidden" name="form_pembayaran" value="1">

            <x-input label="Jumlah Pembayaran" name="jumlah" type="number" required min="0" step="100"/>

            <x-select 
            label="Metode" 
            name="metode" 
            :options="[
                'transfer' => 'Transfer',
                'tunai' => 'Tunai',
            ]" 
            />
            <div class="agreement">
                <label for="setuju" class="setuju-text">Setuju?</label>
                <label class="switch">
                    <input type="checkbox" name="setuju" id="setuju">
                    <span class="slider round"></span>
                </label>
            </div>

            <button type="submit" class="btn-submit">Lanjutkan Pembayaran</button>
        </form>
    </div>
</div>
@endsection
