@extends('layouts.app')

<link href="{{ asset('css/pembayaran.css') }}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@section('content')
<div class="payment-container">
    <div class="form-box">
        <h2 class="form-title">Pembayaran Proyek</h2>

        <form method="POST" action="{{ route('admin.pembayaran.store') }}">
            @csrf
            <p class="project-name">
                Proyek: <strong>Pembangunan Aplikasi E-commerce</strong>
            </p>
            <input type="hidden" name="form_pembayaran" value="1">

            <x-input 
                label="Jumlah Pembayaran" 
                name="jumlah" 
                type="number" 
                required 
                min="0" 
                step="100" 
            />
            @error('jumlah')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            <x-select 
                label="Metode" 
                name="metode" 
                :options="[
                    'transfer' => 'Transfer',
                    'tunai' => 'Tunai',
                ]" 
                class="select2"
            />

            @error('metode')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            <div class="agreement">
                <label for="setuju" class="setuju-text">Setuju?</label>
                <label class="switch">
                    <input type="checkbox" name="setuju" id="setuju">
                    <span class="slider round"></span>
                </label>
            </div>
            @error('setuju')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            <button type="submit" class="btn-submit">Lanjutkan Pembayaran</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        $('.select2').select2({
            placeholder: "Pilih metode pembayaran",
            allowClear: true
        });
    });
</script>
@endsection
