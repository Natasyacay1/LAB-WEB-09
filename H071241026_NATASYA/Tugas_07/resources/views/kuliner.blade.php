@extends('layouts.master')

@section('content')
<section class="kuliner-page fade-in">
    <h1 class="kuliner-title"><i class="fas fa-utensils"></i>{{ $title }}</h1>
    <p class="kuliner-subtitle">{{ $subtitle }}</p>

    <div class="kuliner-grid">
        @foreach($kuliner as $item)
        <div class="kuliner-card">
            <div class="kuliner-img">
                <img src="{{ asset('assets/' . $item['gambar']) }}" alt="{{ $item['nama'] }}">
                <span class="kuliner-tag">{{ $item['tag'] }}</span>
            </div>
            <div class="kuliner-info">
                <div class="kuliner-header">
                    <h3>{{ $item['nama'] }}</h3>
                    <div class="stars">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= floor($item['rating']))
                                <i class="fas fa-star"></i>
                            @elseif($i - 0.5 <= $item['rating'])
                                <i class="fas fa-star-half-alt"></i>
                            @else
                                <i class="far fa-star"></i>
                            @endif
                        @endfor
                    </div>
                </div>
                <p>{{ $item['deskripsi'] }}</p>
                <div class="kuliner-footer">
                    <span class="price">{{ $item['harga'] }}</span>
                    <span class="category">{{ $item['kategori'] }}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="kuliner-tour">
        <h2><i class="fas fa-map-signs"></i> Tour Kuliner Polewali Mandar</h2>
        <p>Ikuti tur kuliner untuk menjelajahi semua makanan khas Polewali Mandar</p>
        <button><i class="fas fa-route"></i> Jadwalkan Tour</button>
    </div>
</section>
@endsection