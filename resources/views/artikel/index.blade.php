@extends('layouts.app')

@section('title', 'Artikel & Berita — Maro Adventure Indonesia')

@push('styles')
<style>
/* ── Page Hero ── */
.page-hero {
    background: linear-gradient(135deg, var(--color-navy) 0%, var(--color-primary-dark) 100%);
    padding: 120px 0 70px;
    position: relative;
    overflow: hidden;
}

.page-hero::before {
    content: '';
    position: absolute;
    top: -60%;
    right: -10%;
    width: 500px;
    height: 500px;
    background: radial-gradient(circle, rgba(56,189,248,0.1) 0%, transparent 70%);
    border-radius: 50%;
}

.page-hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    background: rgba(255,255,255,0.12);
    backdrop-filter: blur(8px);
    border: 1px solid rgba(255,255,255,0.2);
    color: white;
    font-family: var(--font-body);
    font-size: 0.78rem;
    font-weight: 600;
    letter-spacing: 2px;
    text-transform: uppercase;
    padding: 6px 16px;
    border-radius: 50px;
    margin-bottom: 1rem;
}

.page-hero h1 {
    font-family: var(--font-heading);
    font-size: clamp(2rem, 4vw, 3rem);
    font-weight: 800;
    color: white;
    margin-bottom: 0.75rem;
}

.page-hero p {
    color: rgba(255,255,255,0.8);
    font-size: 1.05rem;
    max-width: 540px;
}

/* ── Search & Filter Bar ── */
.filter-bar {
    background: var(--color-white);
    border-bottom: 1px solid var(--color-light-blue);
    padding: 20px 0;
    position: sticky;
    top: 70px;
    z-index: 100;
    box-shadow: 0 2px 12px rgba(12,74,110,0.06);
}

.search-input-wrap {
    position: relative;
    flex: 1;
    max-width: 340px;
}

.search-input-wrap i {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--color-primary);
    font-size: 1rem;
}

.search-input {
    width: 100%;
    padding: 10px 14px 10px 40px;
    border: 1.5px solid var(--color-light-blue);
    border-radius: 50px;
    font-family: var(--font-body);
    font-size: 0.9rem;
    color: var(--color-text);
    background: var(--color-very-light-blue);
    transition: var(--transition-fast);
    outline: none;
}

.search-input:focus {
    border-color: var(--color-primary);
    background: white;
    box-shadow: 0 0 0 3px rgba(14,165,233,0.12);
}

.filter-pills {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    align-items: center;
}

.filter-pill {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 7px 16px;
    border-radius: 50px;
    font-family: var(--font-body);
    font-size: 0.82rem;
    font-weight: 600;
    border: 1.5px solid var(--color-light-blue);
    color: var(--color-text-light);
    background: white;
    text-decoration: none;
    transition: var(--transition-fast);
    cursor: pointer;
}

.filter-pill:hover {
    border-color: var(--color-primary);
    color: var(--color-primary);
    background: var(--color-very-light-blue);
}

.filter-pill.active {
    background: var(--color-primary);
    border-color: var(--color-primary);
    color: white;
}

/* ── Article Cards ── */
.articles-section {
    padding: 60px 0 80px;
    background: var(--color-very-light-blue);
}

.article-card {
    background: white;
    border-radius: var(--radius-lg);
    overflow: hidden;
    border: 1.5px solid var(--color-light-blue);
    transition: var(--transition-smooth);
    height: 100%;
    display: flex;
    flex-direction: column;
}

.article-card:hover {
    transform: translateY(-6px);
    box-shadow: var(--shadow-xl);
    border-color: var(--color-primary);
}

.article-card-img {
    position: relative;
    height: 210px;
    overflow: hidden;
}

.article-card-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.article-card:hover .article-card-img img {
    transform: scale(1.06);
}

.article-card-body {
    padding: 22px 24px;
    display: flex;
    flex-direction: column;
    flex: 1;
}

.article-cat-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    font-family: var(--font-body);
    font-size: 0.72rem;
    font-weight: 700;
    padding: 4px 12px;
    border-radius: 50px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 10px;
    width: fit-content;
}

.cat-gunung    { background: #DBEAFE; color: #1D4ED8; }
.cat-tips      { background: #D1FAE5; color: #065F46; }
.cat-berita    { background: #EDE9FE; color: #5B21B6; }
.cat-budaya    { background: #FEF3C7; color: #92400E; }
.cat-destinasi { background: #E0F2FE; color: #0369A1; }
.cat-default   { background: #F1F5F9; color: #475569; }

.article-card-title {
    font-family: var(--font-heading);
    font-size: 1.05rem;
    font-weight: 700;
    color: var(--color-navy);
    line-height: 1.4;
    margin-bottom: 10px;
    text-decoration: none;
    display: block;
    transition: var(--transition-fast);
}

.article-card-title:hover {
    color: var(--color-primary);
}

.article-card-excerpt {
    font-family: var(--font-body);
    font-size: 0.88rem;
    color: var(--color-text-light);
    line-height: 1.65;
    margin-bottom: 16px;
    flex: 1;
}

.article-card-meta {
    display: flex;
    align-items: center;
    gap: 12px;
    padding-top: 14px;
    border-top: 1px solid var(--color-light-blue);
    font-family: var(--font-body);
    font-size: 0.78rem;
    color: var(--color-text-light);
    flex-wrap: wrap;
}

.article-card-meta span {
    display: inline-flex;
    align-items: center;
    gap: 4px;
}

.article-card-meta i {
    color: var(--color-primary);
    font-size: 0.8rem;
}

.article-read-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    color: var(--color-primary);
    font-family: var(--font-body);
    font-size: 0.85rem;
    font-weight: 600;
    text-decoration: none;
    margin-top: auto;
    padding-top: 12px;
    transition: var(--transition-fast);
}

.article-read-btn:hover {
    gap: 10px;
    color: var(--color-primary-dark);
}

/* ── Sidebar ── */
.sidebar-card {
    background: white;
    border-radius: var(--radius-lg);
    border: 1.5px solid var(--color-light-blue);
    overflow: hidden;
    margin-bottom: 24px;
}

.sidebar-card-header {
    padding: 16px 20px;
    border-bottom: 1px solid var(--color-light-blue);
    font-family: var(--font-heading);
    font-size: 0.95rem;
    font-weight: 700;
    color: var(--color-navy);
    display: flex;
    align-items: center;
    gap: 8px;
}

.sidebar-card-header i {
    color: var(--color-primary);
}

.sidebar-article-item {
    display: flex;
    gap: 12px;
    padding: 14px 20px;
    border-bottom: 1px solid var(--color-light-blue);
    text-decoration: none;
    transition: var(--transition-fast);
    align-items: flex-start;
}

.sidebar-article-item:last-child {
    border-bottom: none;
}

.sidebar-article-item:hover {
    background: var(--color-very-light-blue);
}

.sidebar-article-img {
    width: 64px;
    height: 54px;
    border-radius: var(--radius-sm);
    overflow: hidden;
    flex-shrink: 0;
}

.sidebar-article-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.sidebar-article-title {
    font-family: var(--font-body);
    font-size: 0.85rem;
    font-weight: 600;
    color: var(--color-navy);
    line-height: 1.4;
    margin-bottom: 4px;
}

.sidebar-article-date {
    font-family: var(--font-body);
    font-size: 0.75rem;
    color: var(--color-text-light);
}

/* Pagination */
.pagination-wrap .page-link {
    border-color: var(--color-light-blue);
    color: var(--color-primary-dark);
    font-family: var(--font-body);
    font-size: 0.9rem;
    border-radius: var(--radius-sm);
    margin: 0 2px;
}

.pagination-wrap .page-item.active .page-link {
    background: var(--color-primary);
    border-color: var(--color-primary);
    color: white;
}

.pagination-wrap .page-link:hover {
    background: var(--color-very-light-blue);
    color: var(--color-primary);
    border-color: var(--color-primary);
}

/* No results */
.no-results {
    text-align: center;
    padding: 80px 20px;
}

.no-results i {
    font-size: 3.5rem;
    color: var(--color-primary);
    opacity: 0.3;
    margin-bottom: 1rem;
}
</style>
@endpush

@section('content')

{{-- Page Hero --}}
<section class="page-hero">
    <div class="container">
        <div class="page-hero-badge">
            <i class="bi bi-newspaper"></i>
            Artikel & Berita
        </div>
        <h1>Cerita dari Alam &amp; Perjalanan</h1>
        <p>Tips mendaki, info destinasi, berita terbaru, dan kisah-kisah inspiratif dari perjalanan bersama Maro Adventure.</p>
    </div>
</section>

{{-- Filter Bar --}}
<div class="filter-bar">
    <div class="container">
        <form method="GET" action="{{ route('artikel.index') }}" class="d-flex align-items-center gap-3 flex-wrap">

            {{-- Search --}}
            <div class="search-input-wrap">
                <i class="bi bi-search"></i>
                <input
                    type="text"
                    name="cari"
                    class="search-input"
                    placeholder="Cari artikel..."
                    value="{{ $search ?? '' }}"
                    id="article-search-input"
                >
            </div>

            {{-- Category Pills --}}
            <div class="filter-pills">

                <a
                    href="{{ route('artikel.index', $search ? ['cari' => $search] : []) }}"
                    class="filter-pill {{ !$category ? 'active' : '' }}"
                >
                    Semua
                </a>

                @foreach($categories as $cat)
                    <a
                        href="{{ route('artikel.index', array_filter(['kategori' => $cat, 'cari' => $search])) }}"
                        class="filter-pill {{ $category === $cat ? 'active' : '' }}"
                    >
                        {{ $cat }}
                    </a>
                @endforeach

            </div>

        </form>
    </div>
</div>

{{-- Articles + Sidebar --}}
<section class="articles-section">
    <div class="container">
        <div class="row g-4">

            {{-- Articles Grid --}}
            <div class="col-lg-8">

                @if($search || $category)
                    <div class="mb-4">
                        <p class="text-muted" style="font-size: 0.9rem;">
                            @if($articles->total() > 0)
                                Menampilkan <strong>{{ $articles->total() }}</strong> artikel
                                @if($category) dalam kategori <strong>{{ $category }}</strong>@endif
                                @if($search) untuk pencarian <strong>"{{ $search }}"</strong>@endif
                            @else
                                Tidak ada hasil
                                @if($search) untuk "<strong>{{ $search }}</strong>"@endif
                                @if($category) di kategori <strong>{{ $category }}</strong>@endif
                            @endif
                            — <a href="{{ route('artikel.index') }}" style="color:var(--color-primary); font-weight:600;">Lihat semua</a>
                        </p>
                    </div>
                @endif

                @if($articles->count() > 0)

                    <div class="row g-4">
                        @foreach($articles as $article)
                            <div class="col-12 col-sm-6 col-xl-4">
                                <div class="article-card">

                                    <div class="article-card-img">
                                        <img
                                            src="{{ $article->thumbnail_url }}"
                                            alt="{{ $article->title }}"
                                            loading="lazy"
                                        >
                                    </div>

                                    <div class="article-card-body">

                                        <span class="article-cat-badge {{ \App\Models\Article::categoryColor($article->category) }}">
                                            {{ $article->category }}
                                        </span>

                                        <a href="{{ route('artikel.show', $article->slug) }}" class="article-card-title">
                                            {{ $article->title }}
                                        </a>

                                        <p class="article-card-excerpt">
                                            {{ $article->short_excerpt }}
                                        </p>

                                        <div class="article-card-meta">
                                            <span>
                                                <i class="bi bi-person-fill"></i>
                                                {{ $article->author_name }}
                                            </span>
                                            <span>
                                                <i class="bi bi-clock"></i>
                                                {{ $article->reading_time }}
                                            </span>
                                            <span>
                                                <i class="bi bi-eye"></i>
                                                {{ number_format($article->views) }}
                                            </span>
                                        </div>

                                        <a href="{{ route('artikel.show', $article->slug) }}" class="article-read-btn">
                                            Baca Artikel <i class="bi bi-arrow-right"></i>
                                        </a>

                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Pagination --}}
                    @if($articles->hasPages())
                        <div class="d-flex justify-content-center mt-5 pagination-wrap">
                            {{ $articles->links() }}
                        </div>
                    @endif

                @else
                    <div class="no-results">
                        <i class="bi bi-journal-x"></i>
                        <h4 style="font-family: var(--font-heading); color: var(--color-navy);">Artikel tidak ditemukan</h4>
                        <p class="text-muted">Coba kata kunci atau kategori yang berbeda.</p>
                        <a href="{{ route('artikel.index') }}" class="btn-primary-custom mt-3">
                            <i class="bi bi-arrow-left"></i> Lihat Semua Artikel
                        </a>
                    </div>
                @endif

            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">

                {{-- Artikel Terbaru --}}
                <div class="sidebar-card">
                    <div class="sidebar-card-header">
                        <i class="bi bi-clock-history"></i>
                        Artikel Terbaru
                    </div>
                    @foreach($latestArticles as $latest)
                        <a href="{{ route('artikel.show', $latest->slug) }}" class="sidebar-article-item">
                            <div class="sidebar-article-img">
                                <img src="{{ $latest->thumbnail_url }}" alt="{{ $latest->title }}">
                            </div>
                            <div>
                                <div class="sidebar-article-title">{{ Str::limit($latest->title, 60) }}</div>
                                <div class="sidebar-article-date">
                                    <i class="bi bi-calendar3 me-1"></i>
                                    {{ $latest->published_at->locale('id')->diffForHumans() }}
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                {{-- Kategori --}}
                <div class="sidebar-card">
                    <div class="sidebar-card-header">
                        <i class="bi bi-grid-3x3-gap"></i>
                        Kategori
                    </div>
                    <div class="p-3 d-flex flex-wrap gap-2">
                        @foreach($categories as $cat)
                            <a
                                href="{{ route('artikel.index', ['kategori' => $cat]) }}"
                                class="filter-pill {{ $category === $cat ? 'active' : '' }}"
                            >
                                {{ $cat }}
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- CTA Box --}}
                <div class="sidebar-card" style="background: linear-gradient(135deg, var(--color-navy), var(--color-primary-dark)); border-color: transparent;">
                    <div class="p-4 text-center">
                        <i class="bi bi-compass-fill" style="font-size: 2rem; color: var(--color-bright);"></i>
                        <h6 class="mt-3 mb-2" style="font-family: var(--font-heading); color: white; font-weight: 700;">
                            Siap Melangkah?
                        </h6>
                        <p style="font-family: var(--font-body); font-size: 0.85rem; color: rgba(255,255,255,0.8); margin-bottom: 1rem;">
                            Bergabunglah dengan Open Trip Maro Adventure berikutnya.
                        </p>
                        <a
                            href="https://wa.me/6285894535172"
                            class="btn-booking-nav btn-wa"
                            target="_blank"
                            rel="noopener noreferrer"
                            style="display: inline-flex; width: 100%; justify-content: center;"
                            id="sidebar-wa-btn"
                        >
                            <i class="bi bi-whatsapp me-1"></i>
                            Hubungi Maro
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>

@endsection
