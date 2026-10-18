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
     * URL Avatar user atau fallback inisial UI Avatars.
     */
    public function getAvatarUrlAttribute(): string
    {
        if ($this->avatar) {
            return asset('storage/'.$this->avatar);
        }

        return 'https://ui-avatars.com/api/?name='.urlencode($this->name).'&background=0EA5E9&color=fff&size=200&bold=true';
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
