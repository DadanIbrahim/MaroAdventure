<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'payment_method',
        'amount',
        'payment_date',
        'payment_proof',
        'status',
        'notes'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    // Helper untuk format Rupiah
    public function getFormattedAmountAttribute()
    {
        return 'Rp ' . number_format($this->amount, 0, ',', '.');
    }

    // Helper untuk badge status
    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'pending' => '<span class="badge bg-warning text-dark">Pending (Menunggu)</span>',
            'verified' => '<span class="badge bg-success">Verified (Valid)</span>',
            'rejected' => '<span class="badge bg-danger">Rejected (Ditolak)</span>',
            default => '<span class="badge bg-secondary">Unknown</span>',
        };
    }
}

