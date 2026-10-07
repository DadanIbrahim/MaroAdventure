<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = [
        'mountain_id',
        'name',
        'duration',
        'price',
        'status',
        'description',
        'image',
    ];

    public function mountain()
    {
        return $this->belongsTo(Mountain::class);
    }
    
    // Helper function for formatted price
    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}

