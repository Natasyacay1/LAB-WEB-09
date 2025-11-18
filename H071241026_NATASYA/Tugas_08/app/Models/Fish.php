<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fish extends Model
{
    use HasFactory;

    // Nama tabel (optional kalau model pluralnya sama dengan tabel)
    protected $table = 'fishes';

    // Kolom yang bisa diisi massal
    protected $fillable = [
        'name',
        'rarity',
        'base_weight_min',
        'base_weight_max',
        'sell_price_per_kg',
        'catch_probability',
        'description',
    ];

    // Accessor untuk format harga
    public function getFormattedPriceAttribute()
    {
        return number_format($this->sell_price_per_kg, 0, ',', '.');
    }

    // Accessor untuk rentang berat
    public function getWeightRangeAttribute()
    {
        return $this->base_weight_min . ' - ' . $this->base_weight_max . ' kg';
    }
}