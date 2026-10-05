<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'category',
        'thumbnail',
        'author_name',
        'author_avatar',
        'views',
        'is_published',
        'published_at',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'views' => 'integer',
    ];

    // ── Scopes ──────────────────────────────────────────────────────

    /** Hanya artikel yang sudah dipublikasikan */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    /** Filter berdasarkan kategori */
    public function scopeCategory(Builder $query, string $category): Builder
    {
        return $query->where('category', $category);
    }

    // ── Accessors ────────────────────────────────────────────────────

    /** URL thumbnail dengan fallback ke placeholder */
    public function getThumbnailUrlAttribute(): string
    {
        if ($this->thumbnail && file_exists(public_path($this->thumbnail))) {
            return asset($this->thumbnail);
        }

        // Warna berbeda per kategori sebagai placeholder
        $colors = [
            'Gunung' => '0369A1/E0F2FE',
            'Tips' => '059669/D1FAE5',
            'Berita' => '7C3AED/EDE9FE',
            'Budaya' => 'B45309/FEF3C7',
            'Destinasi' => '0EA5E9/E0F2FE',
        ];

        $color = $colors[$this->category] ?? '0369A1/E0F2FE';
        $label = urlencode($this->category);

        return "https://placehold.co/800x480/{$color}?text={$label}";
    }

    /** Estimasi waktu baca berdasarkan panjang konten */
    public function getReadingTimeAttribute(): string
    {
        $wordCount = str_word_count(strip_tags($this->content));
        $minutes = max(1, (int) ceil($wordCount / 200));

        return "{$minutes} menit baca";
    }

    /** Excerpt singkat dengan fallback dari content */
    public function getShortExcerptAttribute(): string
    {
        if ($this->excerpt) {
            return Str::limit($this->excerpt, 120);
        }

        return Str::limit(strip_tags($this->content), 120);
    }

    /** Daftar semua kategori yang tersedia */
    public static function allCategories(): array
    {
        return ['Gunung', 'Tips', 'Berita', 'Budaya', 'Destinasi'];
    }

    /** Warna badge per kategori */
    public static function categoryColor(string $category): string
    {
        return match ($category) {
            'Gunung' => 'cat-gunung',
            'Tips' => 'cat-tips',
            'Berita' => 'cat-berita',
            'Budaya' => 'cat-budaya',
            'Destinasi' => 'cat-destinasi',
            default => 'cat-default',
        };
    }
}
