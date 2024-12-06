<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'genre_id',
        'director',
        'release_year',
        'rating',
        'description',
        'stock',
        'price',
        'rental_price',
        'poster'
    ];



    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
    public function isAvailable()
{
    return $this->stock > 0;
}

public function reduceStock()
{
    if ($this->isAvailable()) {
        $this->decrement('stock');
        return true;
    }
    return false;
}

public function increaseStock()
{
    $this->increment('stock');
}

}
