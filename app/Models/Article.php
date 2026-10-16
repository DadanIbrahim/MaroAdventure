<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
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
        'gallery',
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
        'gallery' => 'array',
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
        if ($this->thumbnail) {
            if (Str::startsWith($this->thumbnail, ['http://', 'https://'])) {
                return $this->thumbnail;
            }

            if (file_exists(public_path($this->thumbnail))) {
                return asset($this->thumbnail);
            }

            if (file_exists(public_path('storage/'.$this->thumbnail)) || Storage::disk('public')->exists($this->thumbnail)) {
                return asset('storage/'.$this->thumbnail);
            }

            return asset('storage/'.$this->thumbnail);
        }

        // Warna berbeda per kategori sebagai placeholder jika tidak ada thumbnail
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

    /** Format konten agar paragraf, judul, dan bullet points tersusun rapi */
    public function getFormattedContentAttribute(): string
    {
        if (empty($this->content)) {
            return '';
        }

        // Jika sudah mengandung format tag HTML terstruktur
        if (preg_match('/<(?:p|h[1-6]|ul|ol|div|blockquote|table)[\s>]/i', $this->content)) {
            return $this->content;
        }

        // Konversi markdown / baris baru ke HTML yang rapi
        return Str::markdown($this->content, [
            'renderer' => [
                'soft_break' => "<br>\n",
            ],
        ]);
    }

    /** Kumpulan semua foto artikel (thumbnail + galeri foto tambahan) untuk slideshow */
    public function getAllImagesAttribute(): array
    {
        $images = [];

        // 1. Gambar utama
        if ($this->thumbnail_url) {
            $images[] = $this->thumbnail_url;
        }

        // 2. Gambar tambahan dari galeri (jika diupload)
        $gallery = $this->gallery;
        if (is_string($gallery)) {
            $gallery = json_decode($gallery, true) ?: [];
        }
        if (! empty($gallery) && is_array($gallery)) {
            foreach ($gallery as $img) {
                if ($img) {
                    $images[] = Str::startsWith($img, ['http://', 'https://']) ? $img : asset('storage/'.$img);
                }
            }
        }

        // 3. Jika hanya ada 1 gambar, coba cari foto pendukung dari gunung terkait
        if (count($images) <= 1) {
            $mountain = Mountain::where('name', 'like', '%Burangrang%')
                ->orWhere(function ($q) {
                    $words = explode(' ', (string) $this->title);
                    foreach ($words as $w) {
                        if (strlen($w) >= 4) {
                            $q->orWhere('name', 'like', "%{$w}%");
                        }
                    }
                })
                ->whereNotNull('image')
                ->first();

            if ($mountain && $mountain->image) {
                $mountainImg = asset('storage/'.$mountain->image);
                if (! in_array($mountainImg, $images)) {
                    $images[] = $mountainImg;
                }
            }
        }

        return array_values(array_unique(array_filter($images)));
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

    /** Kategori khusus artikel (tanpa Berita) */
    public static function articleCategories(): array
    {
        return ['Gunung', 'Tips', 'Budaya', 'Destinasi'];
    }

    /** Scope khusus artikel umum (non-berita) */
    public function scopeOnlyArticles(Builder $query): Builder
    {
        return $query->where('category', '!=', 'Berita');
    }

    /** Scope khusus berita */
    public function scopeOnlyBerita(Builder $query): Builder
    {
        return $query->where('category', 'Berita');
    }

    /** URL detail dinamis sesuai kategori (artikel atau berita) */
    public function getUrlAttribute(): string
    {
        return $this->category === 'Berita'
            ? route('berita.show', $this->slug)
            : route('artikel.show', $this->slug);
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
