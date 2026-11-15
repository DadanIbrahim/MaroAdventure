@extends('layouts.app')

@section('title', 'Berita & Kabar Terkini — Maro Adventure Indonesia')

@push('styles')
    @include('layouts.partials.content-listing-styles')
@endpush

@section('content')

{{-- Page Hero --}}
<section class="page-hero">
    <div class="container">
        <div class="page-hero-badge">
            <i class="bi bi-newspaper"></i>
            Kabar & Berita Terkini
        </div>
        <h1>Update &amp; Berita Maro Adventure</h1>
        <p>Informasi kegiatan, pengumuman kuota pendakian, rilis jadwal open trip terbaru, dan kabar terkini seputar Maro Adventure Indonesia.</p>
    </div>
</section>

{{-- Filter Bar --}}
<div class="filter-bar">
    <div class="container">
        <form method="GET" action="{{ route('berita.index') }}" id="listing-filter-form" class="d-flex align-items-center gap-3 flex-wrap">

            {{-- Search --}}
            <div class="search-input-wrap">
                <i class="bi bi-search"></i>
                <input
                    type="text"
                    name="cari"
                    class="search-input"
                    placeholder="Cari berita..."
                    value="{{ $search ?? '' }}"
                    id="listing-search-input"
                    autocomplete="off"
                >
            </div>

            {{-- Category Pills --}}
            <div class="filter-pills" id="listing-category-pills">

                <a
                    href="{{ route('berita.index', $search ? ['cari' => $search] : []) }}"
                    class="filter-pill {{ !$category ? 'active' : '' }}"
                    data-category=""
                >
                    Semua
                </a>

                @foreach($categories as $cat)
                    <a
                        href="{{ route('berita.index', array_filter(['kategori' => $cat, 'cari' => $search])) }}"
                        class="filter-pill {{ $category === $cat ? 'active' : '' }}"
                        data-category="{{ $cat }}"
                    >
                        {{ $cat }}
                    </a>
                @endforeach

            </div>

        </form>
    </div>
</div>

{{-- Berita + Sidebar --}}
<section class="articles-section">
    <div class="container">
        <div class="row g-4">

            {{-- News Grid (AJAX updated) --}}
            <div class="col-lg-8" id="listing-container" style="transition: opacity 0.2s ease;">
                @include('berita.partials.news-grid')
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">

                {{-- Berita Terbaru --}}
                <div class="sidebar-card">
                    <div class="sidebar-card-header">
                        <i class="bi bi-clock-history"></i>
                        Berita Terbaru
                    </div>
                    @forelse($latestNews as $latest)
                        <a href="{{ route('berita.show', $latest->slug) }}" class="sidebar-article-item">
                            <div class="sidebar-article-img">
                                <img src="{{ $latest->thumbnail_url }}" alt="{{ $latest->title }}">
                            </div>
                            <div>
                                <div class="sidebar-article-title">{{ Str::limit($latest->title, 60) }}</div>
                                <div class="sidebar-article-date">
                                    <i class="bi bi-calendar3 me-1"></i>
                                    {{ $latest->published_at?->locale('id')->diffForHumans() ?? 'Terbaru' }}
                                </div>
                            </div>
                        </a>
                    @empty
                        <p class="sidebar-article-date p-3 mb-0">Belum ada berita terbaru.</p>
                    @endforelse
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
                                href="{{ route('berita.index', ['kategori' => $cat]) }}"
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

@push('scripts')
    @include('layouts.partials.content-listing-script', ['listingUrl' => route('berita.index')])
@endpush

@endsection
