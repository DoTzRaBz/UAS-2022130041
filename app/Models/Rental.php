<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    // ...

    protected $fillable = [
        'customer_id',
        'film_id',
        'rental_date',
        'return_date',
        'actual_return_date',
        'rental_fee',
        'late_fee',
        'status'
    ];

    // ...

    public function sale()
    {
        return $this->hasOne(Sale::class);
    }


    protected $casts = [
        'rental_date' => 'date',
        'return_date' => 'date',
        'actual_return_date' => 'date',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function film()
    {
        return $this->belongsTo(Film::class);
    }
}
