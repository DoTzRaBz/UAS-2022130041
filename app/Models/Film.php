<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'genre',
        'director',
        'release_year',
        'rating',
        'description',
        'stock',
        'price',
        'rental_price',
        'poster'
    ];

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
