<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'trip_id',
        'booking_code',
        'customer_name',
        'customer_phone',
        'booking_date',
        'participants',
        'total_price',
        'status',
        'payment_status',
        'notes'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    // Helper untuk menampilkan harga berformat Rupiah
    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->total_price, 0, ',', '.');
    }

    // Helper untuk badge status booking
    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'pending' => '<span class="badge bg-warning text-dark">Pending</span>',
            'confirmed' => '<span class="badge bg-primary">Confirmed</span>',
            'completed' => '<span class="badge bg-success">Completed</span>',
            'cancelled' => '<span class="badge bg-danger">Cancelled</span>',
            default => '<span class="badge bg-secondary">Unknown</span>',
        };
    }

    // Helper untuk badge status pembayaran
    public function getPaymentBadgeAttribute()
    {
        return $this->payment_status === 'paid' 
            ? '<span class="badge bg-success">Paid</span>' 
            : '<span class="badge bg-danger">Unpaid</span>';
    }

    // Generate Booking Code secara otomatis saat dibuat
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($booking) {
            if (empty($booking->booking_code)) {
                $booking->booking_code = 'BKG-' . strtoupper(uniqid());
            }
        });
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}

