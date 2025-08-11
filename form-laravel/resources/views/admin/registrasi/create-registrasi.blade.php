@extends('layouts.app')
<link href="{{ asset('css/registrasi.css') }}" rel="stylesheet">

@section('content')
<div class="payment-container">
    <div class="form-box">
        <h2 class="form-title">Registrasi Pengguna</h2>

        <form method="POST" action="{{ route('admin.registrasi.store') }}" enctype="multipart/form-data">
            @csrf

            <h4>Informasi Akun</h4>

            <x-input label="Nama Lengkap" name="nama" required />

            <x-input label="Email" name="email" type="email" required />

            <x-input label="Kata Sandi" name="password" type="password" required id="password" />
            <span class="toggle-password" onclick="togglePassword()"></span>

            <x-input label="Konfirmasi Kata Sandi" name="password_confirmation" type="password" required id="confirm-password" />
            <span class="toggle-password" onclick="toggleConfirmPassword()"></span>

            <div class="form-group">
                <label class="form-label">Tipe Pengguna:</label><br>
                <label><input type="radio" name="tipe_pengguna" value="Klien" required> Klien</label>
                <label><input type="radio" name="tipe_pengguna" value="Freelancer"> Freelancer</label>
            </div>

            <h4>Detail Tambahan</h4>

            <x-input label="Nomor Telepon" name="telepon" type="text" maxlength="13" required />

            <x-textarea label="Bio (khusus Freelancer)" name="bio" required />

            <x-input label="Gambar Profil" name="gambar" type="file" accept="image/*" required />

            <button type="submit" class="btn-submit">Daftar Sekarang</button>
        </form>
    </div>
</div>

<script>
function togglePassword() {
    const input = document.getElementById("password");
    input.type = input.type === "password" ? "text" : "password";
}
function toggleConfirmPassword() {
    const input = document.getElementById("confirm-password");
    input.type = input.type === "password" ? "text" : "password";
}
</script>
@endsection
