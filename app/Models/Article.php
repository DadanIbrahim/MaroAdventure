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

    /** URL thumbnail dengan fallback ke placeholder instan (lokal SVG) */
    public function getThumbnailUrlAttribute(): string
    {
        if ($this->thumbnail) {
            if (Str::startsWith($this->thumbnail, ['http://', 'https://', 'data:'])) {
                return $this->thumbnail;
            }

            if (Str::startsWith($this->thumbnail, ['assets/', 'images/', 'css/'])) {
                return asset($this->thumbnail);
            }

            return asset('storage/'.$this->thumbnail);
        }

        // SVG Placeholder instan 0ms tanpa external network request
        $palette = [
            'Gunung' => ['bg' => '#E0F2FE', 'fg' => '#0369A1', 'text' => 'Gunung & Trekking'],
            'Tips' => ['bg' => '#D1FAE5', 'fg' => '#059669', 'text' => 'Tips & Panduan'],
            'Berita' => ['bg' => '#EDE9FE', 'fg' => '#7C3AED', 'text' => 'Kabar & Berita'],
            'Budaya' => ['bg' => '#FEF3C7', 'fg' => '#B45309', 'text' => 'Budaya & Alam'],
            'Destinasi' => ['bg' => '#E0F2FE', 'fg' => '#0EA5E9', 'text' => 'Destinasi Wisata'],
        ];

        $theme = $palette[$this->category] ?? ['bg' => '#F0F9FF', 'fg' => '#0EA5E9', 'text' => $this->category ?: 'Maro Adventure'];
        $cat = htmlspecialchars($theme['text'], ENT_QUOTES, 'UTF-8');
        $bg = $theme['bg'];
        $fg = $theme['fg'];

        $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="800" height="480" viewBox="0 0 800 480">'
            .'<rect width="100%" height="100%" fill="'.$bg.'"/>'
            .'<g fill="'.$fg.'" opacity="0.12">'
            .'<circle cx="700" cy="90" r="150"/>'
            .'<circle cx="100" cy="410" r="180"/>'
            .'</g>'
            .'<text x="50%" y="46%" dominant-baseline="middle" text-anchor="middle" fill="'.$fg.'" font-family="system-ui, -apple-system, sans-serif" font-weight="700" font-size="34">'.$cat.'</text>'
            .'<text x="50%" y="58%" dominant-baseline="middle" text-anchor="middle" fill="'.$fg.'" opacity="0.65" font-family="system-ui, -apple-system, sans-serif" font-weight="600" font-size="16">Maro Adventure Indonesia</text>'
            .'</svg>';

        return 'data:image/svg+xml;utf8,'.rawurlencode($svg);
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

    /**
     * Generate slug unik dari judul. Jika slug sudah ada, tambahkan angka suffix.
     *
     * Contoh: "Mendaki Rinjani" → "mendaki-rinjani"
     *         (jika sudah ada) → "mendaki-rinjani-2", "mendaki-rinjani-3", dst.
     *
     * @param  int|null  $excludeId  ID artikel yang sedang diedit (agar tidak bentrok dengan dirinya sendiri)
     */
    public static function generateUniqueSlug(string $title, ?int $excludeId = null): string
    {
        $base = Str::slug($title);
        $slug = $base;
        $counter = 2;

        while (
            static::where('slug', $slug)
                ->when($excludeId, fn ($q) => $q->where('id', '!=', $excludeId))
                ->exists()
        ) {
            $slug = $base.'-'.$counter;
            $counter++;
        }

        return $slug;
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
