@extends('layouts.master')

@section('content')
<section class="home fade-in">
    <h1 class="home-title">{{ $title }}</h1>
    <p class="home-subtitle">{{ $subtitle }}</p>
    <p class="home-text">
        {{ $description }}
    </p>
    <a href="/destinasi" class="look-more">Jelajahi Sekarang <i class="fas fa-arrow-right"></i></a>
</section>

@endsection