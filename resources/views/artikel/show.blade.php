@extends('layouts.app')

@section('title', $article->title . ' — Maro Adventure Indonesia')

@push('styles')
<style>
/* ── Article Hero ── */
.article-hero {
    position: relative;
    height: 480px;
    overflow: hidden;
    background: var(--color-navy);
}

.article-hero-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    opacity: 0.55;
}

.article-hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        to top,
        rgba(12, 74, 110, 0.95) 0%,
        rgba(12, 74, 110, 0.3) 60%,
        transparent 100%
    );
}

.article-hero-content {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 40px 0;
}

/* ── Breadcrumb ── */
.article-breadcrumb {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 1rem;
    font-family: var(--font-body);
    font-size: 0.82rem;
    color: rgba(255,255,255,0.7);
    flex-wrap: wrap;
}

.article-breadcrumb a {
    color: rgba(255,255,255,0.7);
    text-decoration: none;
    transition: color 0.2s;
}

.article-breadcrumb a:hover { color: var(--color-bright); }
.article-breadcrumb i { font-size: 0.65rem; opacity: 0.6; }

/* ── Article Content Layout ── */
.article-layout {
    padding: 60px 0 80px;
    background: var(--color-very-light-blue);
}

/* ── Article Body Card ── */
.article-body-card {
    background: white;
    border-radius: var(--radius-lg);
    border: 1.5px solid var(--color-light-blue);
    overflow: hidden;
    margin-bottom: 24px;
}

.article-meta-bar {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 16px;
    padding: 20px 32px;
    border-bottom: 1px solid var(--color-light-blue);
    background: var(--color-very-light-blue);
}

.article-author-avatar {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--color-primary), var(--color-primary-dark));
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-family: var(--font-heading);
    font-size: 1rem;
    font-weight: 700;
    flex-shrink: 0;
}

.article-author-info {
    flex: 1;
}

.article-author-name {
    font-family: var(--font-body);
    font-size: 0.92rem;
    font-weight: 700;
    color: var(--color-navy);
    margin: 0;
    line-height: 1.2;
}

.article-author-date {
    font-family: var(--font-body);
    font-size: 0.78rem;
    color: var(--color-text-light);
    margin: 0;
}

.article-meta-stats {
    display: flex;
    gap: 16px;
    font-family: var(--font-body);
    font-size: 0.82rem;
    color: var(--color-text-light);
}

.article-meta-stats span {
    display: inline-flex;
    align-items: center;
    gap: 4px;
}

.article-meta-stats i { color: var(--color-primary); }

/* Share buttons */
.article-share {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-left: auto;
}

.share-btn {
    width: 34px;
    height: 34px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.88rem;
    text-decoration: none;
    transition: var(--transition-fast);
    border: 1px solid var(--color-light-blue);
    color: var(--color-text-light);
    background: white;
}

.share-btn:hover { transform: translateY(-2px); }
.share-btn.wa:hover { background: #25D366; border-color: #25D366; color: white; }
.share-btn.ig:hover { background: #E4405F; border-color: #E4405F; color: white; }
.share-btn.link:hover { background: var(--color-primary); border-color: var(--color-primary); color: white; }

/* Content */
.article-content {
    padding: 36px 32px 40px;
    font-family: var(--font-body);
    font-size: 1rem;
    color: var(--color-text);
    line-height: 1.85;
}

.article-content h2,
.article-content h3,
.article-content h4 {
    font-family: var(--font-heading);
    color: var(--color-navy);
    margin-top: 2rem;
    margin-bottom: 0.75rem;
    line-height: 1.35;
}

.article-content h2 { font-size: 1.5rem; font-weight: 700; }
.article-content h3 { font-size: 1.2rem; font-weight: 700; }
.article-content h4 { font-size: 1.05rem; font-weight: 600; }

.article-content p {
    color: var(--color-text);
    margin-bottom: 1.1rem;
}

.article-content ul,
.article-content ol {
    padding-left: 1.5rem;
    margin-bottom: 1.2rem;
}

.article-content li {
    margin-bottom: 0.5rem;
    color: var(--color-text);
}

.article-content strong {
    color: var(--color-navy);
    font-weight: 700;
}

.article-content a {
    color: var(--color-primary);
    text-decoration: underline;
    text-underline-offset: 3px;
}

/* ── Tags ── */
.article-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    padding: 20px 32px;
    border-top: 1px solid var(--color-light-blue);
}

.article-tag {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 5px 14px;
    border-radius: 50px;
    font-family: var(--font-body);
    font-size: 0.78rem;
    font-weight: 600;
    border: 1px solid var(--color-light-blue);
    color: var(--color-primary-dark);
    background: var(--color-very-light-blue);
    text-decoration: none;
    transition: var(--transition-fast);
}

.article-tag:hover {
    background: var(--color-primary);
    border-color: var(--color-primary);
    color: white;
}

/* ── Related Articles ── */
.related-section {
    background: white;
    border-radius: var(--radius-lg);
    border: 1.5px solid var(--color-light-blue);
    padding: 24px;
    margin-bottom: 24px;
}

.related-section h5 {
    font-family: var(--font-heading);
    font-size: 1rem;
    font-weight: 700;
    color: var(--color-navy);
    margin-bottom: 18px;
    padding-bottom: 12px;
    border-bottom: 1px solid var(--color-light-blue);
    display: flex;
    align-items: center;
    gap: 8px;
}

.related-section h5 i { color: var(--color-primary); }

.related-article-card {
    display: flex;
    gap: 14px;
    padding: 12px 0;
    border-bottom: 1px solid var(--color-light-blue);
    text-decoration: none;
    transition: var(--transition-fast);
    align-items: flex-start;
}

.related-article-card:last-child { border-bottom: none; padding-bottom: 0; }

.related-article-card:hover { transform: translateX(4px); }

.related-article-img {
    width: 80px;
    height: 62px;
    border-radius: var(--radius-sm);
    overflow: hidden;
    flex-shrink: 0;
}

.related-article-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.related-article-title {
    font-family: var(--font-body);
    font-size: 0.87rem;
    font-weight: 600;
    color: var(--color-navy);
    line-height: 1.4;
    margin-bottom: 4px;
    transition: color 0.2s;
}

.related-article-card:hover .related-article-title { color: var(--color-primary); }

.related-article-cat {
    font-family: var(--font-body);
    font-size: 0.75rem;
    color: var(--color-text-light);
}

/* Sidebar identical to index */
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

.sidebar-card-header i { color: var(--color-primary); }

.sidebar-article-item {
    display: flex;
    gap: 12px;
    padding: 14px 20px;
    border-bottom: 1px solid var(--color-light-blue);
    text-decoration: none;
    transition: var(--transition-fast);
    align-items: flex-start;
}

.sidebar-article-item:last-child { border-bottom: none; }
.sidebar-article-item:hover { background: var(--color-very-light-blue); }

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
}
.cat-gunung    { background: #DBEAFE; color: #1D4ED8; }
.cat-tips      { background: #D1FAE5; color: #065F46; }
.cat-berita    { background: #EDE9FE; color: #5B21B6; }
.cat-budaya    { background: #FEF3C7; color: #92400E; }
.cat-destinasi { background: #E0F2FE; color: #0369A1; }
.cat-default   { background: #F1F5F9; color: #475569; }
</style>
@endpush

@section('content')

{{-- Article Hero --}}
<div class="article-hero">
    <img
        src="{{ $article->thumbnail_url }}"
        alt="{{ $article->title }}"
        class="article-hero-img"
    >
    <div class="article-hero-overlay"></div>

    <div class="article-hero-content">
        <div class="container">

            {{-- Breadcrumb --}}
            <div class="article-breadcrumb">
                <a href="{{ url('/') }}"><i class="bi bi-house-fill"></i> Home</a>
                <i class="bi bi-chevron-right"></i>
                <a href="{{ route('artikel.index') }}">Artikel</a>
                <i class="bi bi-chevron-right"></i>
                <a href="{{ route('artikel.index', ['kategori' => $article->category]) }}">{{ $article->category }}</a>
                <i class="bi bi-chevron-right"></i>
                <span style="color: rgba(255,255,255,0.9);">{{ Str::limit($article->title, 50) }}</span>
            </div>

            {{-- Category Badge --}}
            <span class="article-cat-badge {{ \App\Models\Article::categoryColor($article->category) }} mb-3 d-inline-flex">
                {{ $article->category }}
            </span>

            {{-- Title --}}
            <h1 style="
                font-family: var(--font-heading);
                font-size: clamp(1.6rem, 3.5vw, 2.5rem);
                font-weight: 800;
                color: white;
                line-height: 1.25;
                max-width: 760px;
                text-shadow: 0 2px 20px rgba(0,0,0,0.3);
            ">
                {{ $article->title }}
            </h1>

        </div>
    </div>
</div>

{{-- Content --}}
<section class="article-layout">
    <div class="container">
        <div class="row g-4">

            {{-- Main Content --}}
            <div class="col-lg-8">

                {{-- Article Body Card --}}
                <div class="article-body-card">

                    {{-- Meta Bar --}}
                    <div class="article-meta-bar">

                        <div class="article-author-avatar">
                            {{ strtoupper(substr($article->author_name, 0, 1)) }}
                        </div>

                        <div class="article-author-info">
                            <p class="article-author-name">{{ $article->author_name }}</p>
                            <p class="article-author-date">
                                {{ $article->published_at->locale('id')->isoFormat('D MMMM Y') }}
                            </p>
                        </div>

                        <div class="article-meta-stats">
                            <span><i class="bi bi-clock"></i> {{ $article->reading_time }}</span>
                            <span><i class="bi bi-eye"></i> {{ number_format($article->views) }} dibaca</span>
                        </div>

                        <div class="article-share">
                            <a
                                href="https://wa.me/?text={{ urlencode($article->title . ' — ' . request()->url()) }}"
                                class="share-btn wa"
                                target="_blank"
                                title="Bagikan ke WhatsApp"
                            >
                                <i class="bi bi-whatsapp"></i>
                            </a>
                            <button
                                class="share-btn link"
                                onclick="copyLink()"
                                title="Salin link"
                                id="copy-link-btn"
                            >
                                <i class="bi bi-link-45deg"></i>
                            </button>
                        </div>

                    </div>

                    {{-- Excerpt --}}
                    @if($article->excerpt)
                        <div style="
                            padding: 20px 32px;
                            background: var(--color-very-light-blue);
                            border-bottom: 1px solid var(--color-light-blue);
                            font-family: var(--font-body);
                            font-size: 1.05rem;
                            color: var(--color-navy);
                            font-style: italic;
                            font-weight: 500;
                            line-height: 1.7;
                            border-left: 4px solid var(--color-primary);
                        ">
                            {{ $article->excerpt }}
                        </div>
                    @endif

                    {{-- Article Content --}}
                    <div class="article-content">
                        {!! $article->content !!}
                    </div>

                    {{-- Tags --}}
                    <div class="article-tags">
                        <span style="font-family: var(--font-body); font-size: 0.82rem; color: var(--color-text-light); margin-right: 4px;">
                            <i class="bi bi-tags me-1"></i>Tag:
                        </span>
                        <a href="{{ route('artikel.index', ['kategori' => $article->category]) }}" class="article-tag">
                            {{ $article->category }}
                        </a>
                        <a href="{{ route('artikel.index') }}" class="article-tag">Maro Adventure</a>
                        <a href="{{ route('artikel.index') }}" class="article-tag">Wisata Alam</a>
                    </div>

                </div>

                {{-- Related Articles --}}
                @if($related->count() > 0)
                    <div class="related-section">
                        <h5>
                            <i class="bi bi-journals"></i>
                            Artikel Terkait — {{ $article->category }}
                        </h5>

                        @foreach($related as $rel)
                            <a href="{{ route('artikel.show', $rel->slug) }}" class="related-article-card">
                                <div class="related-article-img">
                                    <img src="{{ $rel->thumbnail_url }}" alt="{{ $rel->title }}">
                                </div>
                                <div>
                                    <div class="related-article-title">{{ $rel->title }}</div>
                                    <div class="related-article-cat">
                                        <i class="bi bi-clock me-1"></i>{{ $rel->reading_time }}
                                        &nbsp;·&nbsp;
                                        {{ $rel->published_at->locale('id')->diffForHumans() }}
                                    </div>
                                </div>
                            </a>
                        @endforeach

                    </div>
                @endif

                {{-- Back to Articles --}}
                <a href="{{ route('artikel.index') }}" class="btn-outline-custom" style="color: var(--color-primary) !important; border-color: var(--color-primary);">
                    <i class="bi bi-arrow-left"></i>
                    Kembali ke Semua Artikel
                </a>

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

                {{-- CTA --}}
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
                            id="article-wa-btn"
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

@push('scripts')
<script>
function copyLink() {
    navigator.clipboard.writeText(window.location.href).then(() => {
        const btn = document.getElementById('copy-link-btn');
        btn.innerHTML = '<i class="bi bi-check-lg"></i>';
        btn.style.background = 'var(--color-primary)';
        btn.style.borderColor = 'var(--color-primary)';
        btn.style.color = 'white';
        setTimeout(() => {
            btn.innerHTML = '<i class="bi bi-link-45deg"></i>';
            btn.style.background = '';
            btn.style.borderColor = '';
            btn.style.color = '';
        }, 2000);
    });
}
</script>
@endpush
