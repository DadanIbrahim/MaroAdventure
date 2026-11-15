<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'google_id',
        'phone',
        'password',
        'role',
        'points',
        'avatar',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * URL Avatar user atau fallback inisial SVG instan.
     */
    public function getAvatarUrlAttribute(): string
    {
        if ($this->avatar) {
            return asset('storage/'.$this->avatar);
        }

        $initial = strtoupper(mb_substr($this->name ?: 'U', 0, 1));
        $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="128" height="128" viewBox="0 0 128 128">'
            .'<rect width="100%" height="100%" rx="64" fill="#0EA5E9"/>'
            .'<text x="50%" y="54%" dominant-baseline="middle" text-anchor="middle" fill="#ffffff" font-family="system-ui, -apple-system, sans-serif" font-weight="700" font-size="52">'.htmlspecialchars($initial, ENT_QUOTES, 'UTF-8').'</text>'
            .'</svg>';

        return 'data:image/svg+xml;utf8,'.rawurlencode($svg);
    }

    /**
     * Cek apakah user adalah Superadmin.
     */
    public function isSuperadmin(): bool
    {
        return $this->role === 'superadmin' || $this->email === 'superadmin123@maroadventure.com';
    }

    /**
     * Cek apakah user adalah Admin atau Superadmin.
     */
    public function isAdmin(): bool
    {
        return in_array($this->role, ['admin', 'superadmin'])
            || in_array($this->email, ['admin123@maroadventure.com', 'superadmin123@maroadventure.com']);
    }

    /**
     * Cek apakah user adalah pelanggan biasa (Member).
     */
    public function isRegularUser(): bool
    {
        return in_array($this->role, ['user', 'customer']) && ! $this->isAdmin();
    }
}
