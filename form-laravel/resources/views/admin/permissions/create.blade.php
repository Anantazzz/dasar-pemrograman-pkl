@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Permission</h2>

    <form action="{{ route('permissions.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="name">Nama Permission</label>
            <input type="text" name="name" id="name" class="form-control" required>
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('permissions.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
