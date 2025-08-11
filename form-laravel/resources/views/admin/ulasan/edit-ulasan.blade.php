@extends('layouts.app')
<link href="{{ asset('css/ulasan.css') }}" rel="stylesheet">

@section('content')
<div class="payment-container">
    <div class="form-box">
        <h2 class="form-title">Beri Ulasan</h2>
        <p>Untuk <strong>[Nama Pengguna Freelancer/Klien]</strong> pada proyek: <strong>Desain Logo Perusahaan Baru</strong></p>

        <form action="{{ route('admin.ulasan.form-ulasan.update', $ulasan->id) }}" method="POST">
        @csrf
        @method('PUT')

            <label class="block font-medium mb-1">Rating:</label>
            <div class="rating mb-3">
                <span data-value="1">&#9733;</span>
                <span data-value="2">&#9733;</span>
                <span data-value="3">&#9733;</span>
                <span data-value="4">&#9733;</span>
                <span data-value="5">&#9733;</span>
            </div>
           <input type="hidden" name="rating" id="rating" required value="{{ $ulasan->rating }}">

            <x-textarea 
                label="Komentar / Ulasan Anda" 
                name="ulasan" 
                required 
                placeholder="Ceritakan pengalaman Anda..."
                value="{{ $ulasan->ulasan }}"
            />

             <div class="button-group">
                 <a href="{{ route('admin.ulasan.form-ulasan') }}" class="btn-cancel">Batal</a>
                 <button type="submit" class="btn-submit">Update</button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const stars = document.querySelectorAll('.rating span');
    const ratingInput = document.getElementById('rating');
    const currentRating = ratingInput.value;

    stars.forEach((star, index) => {
        const value = star.getAttribute('data-value');
        if (parseInt(value) <= currentRating) {
            star.classList.add('active');
        }

        star.addEventListener('click', () => {
            const value = star.getAttribute('data-value');
            ratingInput.value = value;

            stars.forEach((s, i) => {
                s.classList.toggle('active', i < value);
            });
        });
    });
});
</script>

<style>
.rating {
    display: flex;
    gap: 8px;
    cursor: pointer;
    font-size: 24px;
    user-select: none;
}
.rating span {
    color: #ccc;
    transition: color 0.2s ease;
}
.rating span.active {
    color: #f5b301;
}
</style>

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
