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
            — <a href="{{ route('artikel.index') }}" class="reset-filter-btn" style="color:var(--color-primary); font-weight:600;">Lihat semua</a>
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
        <a href="{{ route('artikel.index') }}" class="btn-primary-custom mt-3 reset-filter-btn">
            <i class="bi bi-arrow-left"></i> Lihat Semua Artikel
        </a>
    </div>
@endif

