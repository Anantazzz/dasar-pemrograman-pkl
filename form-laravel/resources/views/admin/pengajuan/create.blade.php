@extends('layouts.app')

<link href="{{ asset('css/pengajuan.css') }}" rel="stylesheet">

@section('content')
<div class="payment-container">
    <div class="form-box">
        <h2 class="form-title">Pengajuan Penawaran</h2>

        <form method="POST" action="{{ route('admin.pengajuan.store') }}">
            @csrf

            <p class="project-name">
                Proyek: <strong>Desain Logo Perusahaan Baru</strong>
            </p>
            <input type="hidden" name="proyek" value="Desain Logo Perusahaan Baru">

            <x-input
                label="Jumlah Penawaran Anda (IDR)"
                name="penawaran"
                type="number"
                required
                min="0"
                step="1000"
            />

            @error('penawaran')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            <x-textarea
                label="Pesan / Proposal Anda"
                name="pesan"
                required
            />

            @error('pesan')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            <x-input
                label="Perkiraan Durasi Pengerjaan (Hari)"
                name="durasi"
                type="number"
                required
                min="1"
                step="1"
            />

            @error('durasi')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            <button type="submit" class="btn-submit">
                Ajukan Penawaran
            </button>
        </form>
    </div>
</div>
@endsection
