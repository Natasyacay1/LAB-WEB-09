@extends('layouts.app')

@section('content')
<h1>Daftar Ikan</h1>

@if(session('success'))
    <div class="alert">{{ session('success') }}</div>
@endif

<div>
    <a href="{{ route('fishes.create') }}" class="btn btn-primary">+ Tambah Ikan</a>
</div>

<form method="GET" style="margin-top:15px;">
    <label for="rarity">Filter berdasarkan rarity:</label>
    <select name="rarity" onchange="this.form.submit()">
        <option value="">Semua</option>
        @foreach(['Common','Uncommon','Rare','Epic','Legendary','Mythic','Secret'] as $r)
            <option value="{{ $r }}" {{ request('rarity')==$r ? 'selected' : '' }}>{{ $r }}</option>
        @endforeach
    </select>

    <input type="text" name="search" placeholder="Cari nama ikan..." value="{{ request('search') }}">
    <button type="submit" class="btn btn-secondary">Cari</button>
</form>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Rarity</th>
            <th>Berat (kg)</th>
            <th>Harga/Kg</th>
            <th>Peluang (%)</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($fishes as $index => $fish)
        <tr>
            {{-- Nomor urut otomatis (tidak pakai id database) --}}
            <td>{{ $fishes->firstItem() + $index }}</td>
            <td>{{ $fish->name }}</td>
            <td>{{ $fish->rarity }}</td>
            <td>{{ $fish->weight_range }}</td>
            <td>{{ $fish->formatted_price }}</td>
            <td>{{ $fish->catch_probability }}</td>
            <td>
                <a href="{{ route('fishes.show', $fish->id) }}" class="btn btn-success btn-small">Detail</a>
                <a href="{{ route('fishes.edit', $fish->id) }}" class="btn btn-secondary btn-small">Edit</a>
                <form action="{{ route('fishes.destroy', $fish->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-small" onclick="return confirm('Yakin mau hapus ikan ini?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{-- pagination --}}
{{ $fishes->links() }}
@endsection
