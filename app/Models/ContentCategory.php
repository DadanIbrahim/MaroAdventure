<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ContentCategory extends Model
{
    protected $fillable = [
        'name',
        'type',
    ];

    /**
     * Scope kategori khusus artikel.
     */
    public function scopeArtikel(Builder $query): Builder
    {
        return $query->where('type', 'artikel');
    }

    /**
     * Scope kategori khusus berita.
     */
    public function scopeBerita(Builder $query): Builder
    {
        return $query->where('type', 'berita');
    }
}
