@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Permission</h2>

    <form action="{{ route('permissions.update', $permission->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label for="name">Nama Permission</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $permission->name }}" required>
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('permissions.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
