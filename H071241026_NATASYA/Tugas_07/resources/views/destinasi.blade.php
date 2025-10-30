@extends('layouts.master')

@section('content')
<section class="destinasi-page fade-in">
    <h1 class="destinasi-title"><i class="fas fa-map-marked-alt"></i>{{ $title }}</h1>
    <p class="destinasi-subtitle">{{ $subtitle }}</p>

    <div class="destinasi-grid">
        @foreach($destinasi as $item)
        <div class="destinasi-card">
            <div class="destinasi-img">
                <img src="{{ asset('assets/' . $item['gambar']) }}" alt="{{ $item['nama'] }}">
                <span class="destinasi-tag">{{ $item['tag'] }}</span>
            </div>
            <div class="destinasi-info">
                <div class="destinasi-header">
                    <h3>{{ $item['nama'] }}</h3>
                    <div class="location"><i class="fas fa-map-marker-alt"></i> {{ $item['lokasi'] }}</div>
                </div>
                <p>{{ $item['deskripsi'] }}</p>
                <div class="destinasi-footer">
                    <span class="price"><i class="fas fa-clock"></i> {{ $item['jam_operasional'] }}</span>
                    <span class="category">{{ $item['kategori'] }}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="destinasi-tour">
        <h2><i class="fas fa-compass"></i> Butuh Panduan Wisata?</h2>
        <p>Kami siap membantu perjalanan wisata Anda di Polewali Mandar</p>
        <button><i class="fas fa-headset"></i> Hubungi Guide</button>
    </div>
</section>
@endsection