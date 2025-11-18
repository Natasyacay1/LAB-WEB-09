@extends('layouts.app')

@section('content')
<h1>Edit Ikan: {{ $fish->name }}</h1>

@if ($errors->any())
<div class="alert">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('fishes.update', $fish->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div>
        <label>Nama Ikan:</label>
        <input type="text" name="name" value="{{ old('name', $fish->name) }}" required>
    </div>
    <div>
        <label>Rarity:</label>
        <select name="rarity" required>
            @foreach($rarities as $r)
                <option value="{{ $r }}" {{ old('rarity', $fish->rarity)==$r ? 'selected' : '' }}>{{ $r }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label>Berat Minimum (kg):</label>
        <input type="number" step="0.01" name="base_weight_min" value="{{ old('base_weight_min', $fish->base_weight_min) }}" required>
    </div>
    <div>
        <label>Berat Maksimum (kg):</label>
        <input type="number" step="0.01" name="base_weight_max" value="{{ old('base_weight_max', $fish->base_weight_max) }}" required>
    </div>
    <div>
        <label>Harga per Kg:</label>
        <input type="number" name="sell_price_per_kg" value="{{ old('sell_price_per_kg', $fish->sell_price_per_kg) }}" required>
    </div>
    <div>
        <label>Peluang Tangkap (%):</label>
        <input type="number" step="0.01" name="catch_probability" value="{{ old('catch_probability', $fish->catch_probability) }}" required>
    </div>
    <div>
        <label>Deskripsi:</label>
        <textarea name="description">{{ old('description', $fish->description) }}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    <a href="{{ route('fishes.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
