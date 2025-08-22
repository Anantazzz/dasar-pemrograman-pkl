@extends('layouts.app')

<link href="{{ asset('css/pembayaran.css') }}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@section('content')
<div class="payment-container">
    <div class="form-box">
        <h2 class="form-title">Edit Pembayaran</h2>

        <form action="{{ route('admin.pembayaran.update', $pembayaran->id) }}" method="POST">
            @csrf
            @method('PUT')

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
                class="select2"
            />

            <div class="agreement">
                <label for="setuju" class="setuju-text">Setuju?</label>
                <label class="switch">
                    <input 
                        type="checkbox" 
                        name="setuju" 
                        id="setuju" 
                        {{ $pembayaran->setuju ? 'checked' : '' }}
                    >
                    <span class="slider round"></span>
                </label>
            </div>

            <div class="button-group">
                <a href="{{ route('admin.pembayaran.index') }}" class="btn-cancel">Batal</a>
                <button type="submit" class="btn-submit">Update</button>
            </div>
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
