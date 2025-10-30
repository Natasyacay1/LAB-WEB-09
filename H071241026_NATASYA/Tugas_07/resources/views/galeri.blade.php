@extends('layouts.master')

@section('content')
<section class="galeri-page fade-in">
    <h1 class="galeri-title"><i class="fas fa-images"></i>{{ $title }}</h1>
    <p class="galeri-subtitle">{{ $subtitle }}</p>

    <div class="galeri-grid">
        @foreach($galeri as $foto)
        <div class="galeri-card">
            <div class="galeri-img">
                <img src="{{ asset('assets/' . $foto['gambar']) }}" alt="{{ $foto['judul'] }}">
                <div class="galeri-overlay">
                    <i class="fas fa-search-plus"></i>
                    <p>Lihat Detail</p>
                </div>
            </div>
            <div class="galeri-info">
                <h3>{{ $foto['judul'] }}</h3>
                <p>{{ $foto['deskripsi'] }}</p>
            </div>
        </div>
        @endforeach
    </div>

    <div class="galeri-cta">
        <h2><i class="fas fa-camera-retro"></i> Bagikan Momen Anda!</h2>
        <p>Tag @ExplorePolman di media sosial untuk ditampilkan di galeri kami</p>
        <div class="social-buttons">
            <button><i class="fab fa-instagram"></i> Instagram</button>
            <button><i class="fab fa-facebook"></i> Facebook</button>
        </div>
    </div>
</section>
@endsection