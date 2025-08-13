@extends('layouts.guest')

@section('content')
<div class="register-box">
    <div class="register-logo">
        <a href="{{ url('/') }}"><b>My</b>App</a>
    </div>
    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg">Daftar akun baru</p>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Nama Lengkap --}}
                <div class="input-group mb-3">
                    <input type="text" name="name" class="form-control" placeholder="Nama Lengkap" value="{{ old('name') }}" required autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-user"></span></div>
                    </div>
                </div>

                {{-- Email --}}
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                    </div>
                </div>

                {{-- Password --}}
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-lock"></span></div>
                    </div>
                </div>

                {{-- Konfirmasi Password --}}
                <div class="input-group mb-3">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password" required>
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-lock"></span></div>
                    </div>
                </div>

                {{-- Tipe Pengguna --}}
                <div class="form-group">
                    <label><strong>Tipe Pengguna</strong></label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tipe_pengguna" value="klien" {{ old('tipe_pengguna') == 'klien' ? 'checked' : '' }} required>
                            <label class="form-check-label">Klien</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tipe_pengguna" value="freelancer" {{ old('tipe_pengguna') == 'freelancer' ? 'checked' : '' }}>
                            <label class="form-check-label">Freelancer</label>
                        </div>
                    </div>
                </div>

                {{-- Telepon --}}
                <div class="input-group mb-3">
                    <input type="text" name="telepon" class="form-control" placeholder="Nomor Telepon" maxlength="13" value="{{ old('telepon') }}">
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-phone"></span></div>
                    </div>
                </div>

                {{-- Bio --}}
                <div class="form-group">
                    <label>Bio (khusus Freelancer)</label>
                    <textarea name="bio" class="form-control" rows="3">{{ old('bio') }}</textarea>
                </div>

                {{-- Gambar Profil --}}
                <div class="form-group">
                    <label>Gambar Profil</label>
                    <input type="file" name="gambar" class="form-control-file">
                </div>

                <div class="row">
                    <div class="col-4 offset-8">
                        <button type="submit" class="btn btn-primary btn-block">Daftar</button>
                    </div>
                </div>
            </form>

            <a href="{{ route('login') }}" class="text-center">Saya sudah punya akun</a>
        </div>
    </div>
</div>
@endsection
