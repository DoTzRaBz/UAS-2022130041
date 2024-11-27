<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number',
        'customer_id',
        'film_id',
        'quantity',
        'total_price',
        'payment_status',
        'status',
        'rental_id'
    ];
    protected $dates = ['sale_date'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function film()
    {
        return $this->belongsTo(Film::class);
    }

    public function rental()
    {
        return $this->belongsTo(Rental::class);
    }
}
