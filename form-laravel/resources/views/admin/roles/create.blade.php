@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Role</h2>

    <form action="{{ route('roles.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="name">Nama Role</label>
            <input type="text" name="name" id="name" class="form-control" required>
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group mb-3">
            <label>Permission</label><br>
            @foreach($permissions as $permission)
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" class="form-check-input">
                    <label class="form-check-label">{{ $permission->name }}</label>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('roles.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
