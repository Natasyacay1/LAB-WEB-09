@extends('layouts.app')

@section('content')
<h1>Detail Ikan: {{ $fish->name }}</h1>

<div>
    <p><strong>Rarity:</strong> {{ $fish->rarity }}</p>
    <p><strong>Berat:</strong> {{ $fish->weight_range }} kg</p>
    <p><strong>Harga/Kg:</strong> {{ $fish->formatted_price }}</p>
    <p><strong>Peluang Tangkap:</strong> {{ $fish->catch_probability }}%</p>
    <p><strong>Deskripsi:</strong> {{ $fish->description }}</p>
</div>

<a href="{{ route('fishes.index') }}" class="btn btn-secondary">Kembali</a>
<a href="{{ route('fishes.edit', $fish->id) }}" class="btn btn-primary">Edit</a>
<form action="{{ route('fishes.destroy', $fish->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin mau hapus ikan ini?')">Hapus</button>
</form>
@endsection
