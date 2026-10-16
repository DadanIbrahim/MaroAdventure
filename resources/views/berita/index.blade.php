@extends('layouts.app')

@section('title', 'Berita & Kabar Terkini — Maro Adventure Indonesia')

@push('styles')
<style>
/* ================================================
   BERITA PAGE STYLES
   ================================================ */

.page-hero {
    background: linear-gradient(135deg, var(--color-navy) 0%, var(--color-primary-dark) 60%, var(--color-navy) 100%);
    padding: 130px 0 60px;
    color: var(--color-white);
    position: relative;
    overflow: hidden;
}

.page-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.03' fill-rule='evenodd'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/svg%3E");
    pointer-events: none;
}

.page-hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 6px 16px;
    background: rgba(255, 255, 255, 0.12);
    border: 1px solid rgba(255, 255, 255, 0.25);
    border-radius: var(--radius-full);
    font-size: 0.8rem;
    font-weight: 600;
    color: var(--color-bright);
    letter-spacing: 0.5px;
    margin-bottom: 16px;
}

.page-hero h1 {
    font-family: var(--font-heading);
    font-size: clamp(2rem, 4vw, 3rem);
    font-weight: 800;
    margin-bottom: 12px;
}

.page-hero p {
    font-family: var(--font-body);
    font-size: 1.05rem;
    color: var(--color-light-blue);
    max-width: 620px;
    margin-bottom: 0;
    line-height: 1.7;
}

/* ── Filter Bar ─────────────────────────────── */
.filter-bar {
    background: var(--color-white);
    border-bottom: 1px solid var(--color-light-blue);
    padding: 20px 0;
    position: sticky;
    top: 70px;
    z-index: 100;
    box-shadow: 0 2px 12px rgba(12, 74, 110, 0.06);
}

.search-input-wrap {
    position: relative;
    max-width: 450px;
    width: 100%;
}

.search-input-wrap i {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--color-muted);
    font-size: 0.95rem;
}

.search-input {
    width: 100%;
    padding: 10px 14px 10px 40px;
    border: 1.5px solid var(--color-light-blue);
    border-radius: var(--radius-full);
    font-family: var(--font-body);
    font-size: 0.9rem;
    color: var(--color-navy);
    background: var(--color-very-light-blue);
    transition: var(--transition-smooth);
    outline: none;
}

.search-input:focus {
    border-color: var(--color-primary);
    background: var(--color-white);
    box-shadow: 0 0 0 3px rgba(3, 105, 161, 0.12);
}

/* ── News Card ──────────────────────────────── */
.news-card {
    background: var(--color-white);
    border-radius: var(--radius-lg);
    border: 1px solid rgba(12, 74, 110, 0.08);
    overflow: hidden;
    transition: var(--transition-smooth);
    display: flex;
    flex-direction: column;
    height: 100%;
    box-shadow: var(--shadow-sm);
}

.news-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
    border-color: var(--color-light-blue);
}

.news-card-img {
    position: relative;
    height: 220px;
    overflow: hidden;
}

.news-card-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s ease;
}

.news-card:hover .news-card-img img {
    transform: scale(1.06);
}

.news-badge {
    position: absolute;
    top: 14px;
    left: 14px;
    background: #7C3AED;
    color: #FFFFFF;
    font-size: 0.75rem;
    font-weight: 700;
    padding: 4px 12px;
    border-radius: var(--radius-full);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.25);
}

.news-card-body {
    padding: 22px;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
}

.news-card-meta {
    display: flex;
    align-items: center;
    gap: 14px;
    font-size: 0.8rem;
    color: var(--color-muted);
    margin-bottom: 12px;
}

.news-card-meta i {
    color: var(--color-primary);
    margin-right: 4px;
}

.news-card-title {
    font-family: var(--font-heading);
    font-size: 1.15rem;
    font-weight: 700;
    color: var(--color-navy);
    line-height: 1.4;
    margin-bottom: 10px;
    text-decoration: none;
    transition: color 0.2s;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.news-card-title:hover {
    color: var(--color-primary);
}

.news-card-excerpt {
    font-family: var(--font-body);
    font-size: 0.88rem;
    color: var(--color-body);
    line-height: 1.6;
    margin-bottom: 18px;
    flex-grow: 1;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.news-card-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-top: 14px;
    border-top: 1px solid var(--color-light-blue);
    margin-top: auto;
}

.news-card-author {
    font-size: 0.82rem;
    font-weight: 600;
    color: var(--color-navy);
    display: flex;
    align-items: center;
    gap: 6px;
}

.news-card-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 0.85rem;
    font-weight: 700;
    color: var(--color-primary);
    text-decoration: none;
    transition: gap 0.2s;
}

.news-card-btn:hover {
    color: var(--color-primary-dark);
    gap: 10px;
}

/* ── Sidebar Styles ─────────────────────────── */
.sidebar-widget {
    background: var(--color-white);
    border-radius: var(--radius-lg);
    border: 1px solid rgba(12, 74, 110, 0.08);
    padding: 24px;
    margin-bottom: 24px;
    box-shadow: var(--shadow-sm);
}

.sidebar-widget-title {
    font-family: var(--font-heading);
    font-size: 1.05rem;
    font-weight: 700;
    color: var(--color-navy);
    display: flex;
    align-items: center;
    gap: 10px;
    padding-bottom: 14px;
    border-bottom: 1.5px solid var(--color-light-blue);
    margin-bottom: 16px;
}

.sidebar-widget-title i {
    color: var(--color-primary);
}

.sidebar-news-item {
    display: flex;
    gap: 14px;
    align-items: center;
    text-decoration: none;
    padding: 10px 0;
    border-bottom: 1px solid rgba(12, 74, 110, 0.05);
    transition: var(--transition-smooth);
}

.sidebar-news-item:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

.sidebar-news-item:hover .sidebar-news-title {
    color: var(--color-primary);
}

.sidebar-news-thumb {
    width: 68px;
    height: 68px;
    border-radius: var(--radius-md);
    overflow: hidden;
    flex-shrink: 0;
}

.sidebar-news-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.sidebar-news-title {
    font-family: var(--font-heading);
    font-size: 0.88rem;
    font-weight: 600;
    color: var(--color-navy);
    line-height: 1.4;
    margin-bottom: 4px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.sidebar-news-date {
    font-size: 0.75rem;
    color: var(--color-muted);
}
</style>
@endpush

@section('content')

{{-- Page Hero --}}
<section class="page-hero">
    <div class="container">
        <div class="page-hero-badge">
            <i class="bi bi-newspaper"></i>
            Kabar &amp; Berita Terkini
        </div>
        <h1>Update &amp; Berita Maro Adventure</h1>
        <p>Informasi kegiatan, pengumuman kuota pendakian, rilis jadwal open trip terbaru, dan kabar terkini seputar Maro Adventure Indonesia.</p>
    </div>
</section>

{{-- Filter Bar --}}
<div class="filter-bar">
    <div class="container">
        <form method="GET" action="{{ route('berita.index') }}" class="d-flex align-items-center justify-content-between gap-3 flex-wrap">
            
            {{-- Search Bar --}}
            <div class="search-input-wrap">
                <i class="bi bi-search"></i>
                <input
                    type="text"
                    name="cari"
                    class="search-input"
                    placeholder="Cari berita atau pengumuman..."
                    value="{{ $search ?? '' }}"
                    id="news-search-input"
                >
            </div>

            {{-- Quick Stats / Info --}}
            <div class="text-muted small">
                @if($search)
                    Hasil pencarian untuk "<strong>{{ $search }}</strong>" — 
                    <a href="{{ route('berita.index') }}" class="text-primary text-decoration-none fw-semibold">Reset Pencarian</a>
                @else
                    Menampilkan <strong>{{ $news->total() }}</strong> rilis berita
                @endif
            </div>

        </form>
    </div>
</div>

{{-- Main Content Section --}}
<section style="padding: 60px 0; background: #F8FAFC; min-height: 60vh;">
    <div class="container">
        <div class="row g-4">

            {{-- News Feed Column --}}
            <div class="col-lg-8">
                
                @if($news->count() > 0)
                    <div class="row g-4">
                        @foreach($news as $item)
                            <div class="col-md-6">
                                <article class="news-card">
                                    <div class="news-card-img">
                                        <img src="{{ $item->thumbnail_url }}" alt="{{ $item->title }}" loading="lazy">
                                        <span class="news-badge">Berita</span>
                                    </div>
                                    <div class="news-card-body">
                                        <div class="news-card-meta">
                                            <span>
                                                <i class="bi bi-calendar3"></i>
                                                {{ $item->published_at ? $item->published_at->format('d M Y') : 'Terbaru' }}
                                            </span>
                                            <span>
                                                <i class="bi bi-clock"></i>
                                                {{ $item->reading_time }}
                                            </span>
                                        </div>
                                        <a href="{{ route('berita.show', $item->slug) }}" class="news-card-title">
                                            {{ $item->title }}
                                        </a>
                                        <p class="news-card-excerpt">
                                            {{ $item->short_excerpt }}
                                        </p>
                                        <div class="news-card-footer">
                                            <span class="news-card-author">
                                                <i class="bi bi-person-circle text-primary"></i>
                                                {{ $item->author_name }}
                                            </span>
                                            <a href="{{ route('berita.show', $item->slug) }}" class="news-card-btn">
                                                Baca Rilis <i class="bi bi-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        @endforeach
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-5 d-flex justify-content-center">
                        {{ $news->links() }}
                    </div>
                @else
                    <div class="text-center py-5 bg-white rounded-4 border p-5">
                        <i class="bi bi-newspaper text-muted display-4 d-block mb-3"></i>
                        <h4 class="fw-bold text-dark">Belum Ada Berita Ditemukan</h4>
                        <p class="text-muted mb-4">
                            @if($search)
                                Tidak ada berita yang cocok dengan kata kunci "{{ $search }}". Silakan coba kata kunci lain.
                            @else
                                Saat ini belum ada artikel berita atau pengumuman yang dipublikasikan.
                            @endif
                        </p>
                        @if($search)
                            <a href="{{ route('berita.index') }}" class="btn btn-outline-primary rounded-pill px-4">
                                <i class="bi bi-arrow-counterclockwise me-1"></i> Tampilkan Semua Berita
                            </a>
                        @endif
                    </div>
                @endif

            </div>

            {{-- Sidebar Column --}}
            <div class="col-lg-4">
                
                {{-- Berita Terbaru Widget --}}
                <div class="sidebar-widget">
                    <h5 class="sidebar-widget-title">
                        <i class="bi bi-broadcast"></i>
                        Kabar Terbaru
                    </h5>
                    @forelse($latestNews as $latest)
                        <a href="{{ route('berita.show', $latest->slug) }}" class="sidebar-news-item">
                            <div class="sidebar-news-thumb">
                                <img src="{{ $latest->thumbnail_url }}" alt="{{ $latest->title }}">
                            </div>
                            <div>
                                <h6 class="sidebar-news-title">{{ $latest->title }}</h6>
                                <span class="sidebar-news-date">
                                    <i class="bi bi-calendar3 me-1"></i>
                                    {{ $latest->published_at ? $latest->published_at->format('d M Y') : 'Terbaru' }}
                                </span>
                            </div>
                        </a>
                    @empty
                        <p class="text-muted small mb-0">Belum ada berita terbaru lainnya.</p>
                    @endforelse
                </div>

                {{-- CTA Explore Trips --}}
                <div class="sidebar-widget text-white overflow-hidden position-relative" style="background: linear-gradient(135deg, var(--color-navy) 0%, var(--color-primary-dark) 100%);">
                    <div class="position-relative" style="z-index: 2;">
                        <span class="badge bg-white bg-opacity-25 text-white rounded-pill px-3 py-1 mb-2 font-monospace" style="font-size: 0.75rem;">
                            MARO ADVENTURE
                        </span>
                        <h5 class="fw-bold mb-2">Ingin Ikut Petualangan Mendaki?</h5>
                        <p class="text-white-50 small mb-3">
                            Jelajahi paket open trip &amp; private trip bersama guide berlisensi Maro Adventure.
                        </p>
                        <a href="{{ route('trips.index') }}" class="btn btn-light rounded-pill px-4 py-2 fw-bold text-primary w-100 shadow-sm">
                            <i class="bi bi-compass me-1"></i> Lihat Jadwal Trip
                        </a>
                    </div>
                </div>

                {{-- Banner Link to Articles --}}
                <div class="sidebar-widget">
                    <h5 class="sidebar-widget-title">
                        <i class="bi bi-journal-text"></i>
                        Baca Artikel &amp; Tips
                    </h5>
                    <p class="text-muted small mb-3">
                        Temukan tips mendaki, panduan packing, dan ulasan rute gunung dari tim kami.
                    </p>
                    <a href="{{ route('artikel.index') }}" class="btn btn-outline-primary rounded-pill w-100 fw-semibold">
                        Kunjungi Halaman Artikel &rarr;
                    </a>
                </div>

            </div>

        </div>
    </div>
</section>

@endsection
