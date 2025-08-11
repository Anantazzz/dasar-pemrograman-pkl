@extends('layouts.app')
<link href="{{ asset('css/ulasan.css') }}" rel="stylesheet">

@section('content')
<div class="payment-container">
    <div class="form-box">
        <h2 class="form-title">Beri Ulasan</h2>
        <p>Untuk <strong>[Nama Pengguna Freelancer/Klien]</strong> pada proyek: <strong>Desain Logo Perusahaan Baru</strong></p>

        <form method="POST" action="{{ route('admin.ulasan.store') }}">
            @csrf

            <label class="block font-medium mb-1">Rating:</label>
            <div class="rating mb-3">
                <span data-value="1">&#9733;</span>
                <span data-value="2">&#9733;</span>
                <span data-value="3">&#9733;</span>
                <span data-value="4">&#9733;</span>
                <span data-value="5">&#9733;</span>
            </div>
            <input type="hidden" name="rating" id="rating" required>

            <x-textarea 
                label="Komentar / Ulasan Anda" 
                name="ulasan" 
                required 
                placeholder="Ceritakan pengalaman Anda..."
            />

            <button type="submit" class="btn-submit mt-4">Kirim Ulasan</button>
        </form>
    </div>
</div>

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

<script>
document.addEventListener('DOMContentLoaded', function () {
    const stars = document.querySelectorAll('.rating span');
    const ratingInput = document.getElementById('rating');

    stars.forEach((star, index) => {
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
@endsection
