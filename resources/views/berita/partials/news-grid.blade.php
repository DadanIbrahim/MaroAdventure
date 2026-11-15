@if($search || $category)
    <div class="mb-4">
        <p class="text-muted" style="font-size: 0.9rem;">
            @if($news->total() > 0)
                Menampilkan <strong>{{ $news->total() }}</strong> berita
                @if($category) dalam kategori <strong>{{ $category }}</strong>@endif
                @if($search) untuk pencarian <strong>"{{ $search }}"</strong>@endif
            @else
                Tidak ada hasil
                @if($search) untuk "<strong>{{ $search }}</strong>"@endif
                @if($category) di kategori <strong>{{ $category }}</strong>@endif
            @endif
            — <a href="{{ route('berita.index') }}" class="reset-filter-btn" style="color:var(--color-primary); font-weight:600;">Lihat semua</a>
        </p>
    </div>
@endif

@if($news->count() > 0)
    <div class="row g-4">
        @foreach($news as $item)
            <div class="col-12 col-sm-6 col-xl-4">
                <div class="article-card">
                    <div class="article-card-img">
                        <img
                            src="{{ $item->thumbnail_url }}"
                            alt="{{ $item->title }}"
                            loading="lazy"
                        >
                    </div>

                    <div class="article-card-body">
                        <span class="article-cat-badge {{ \App\Models\Article::categoryColor($item->sub_category ?: 'Berita') }}">
                            {{ $item->sub_category ?: 'Berita' }}
                        </span>

                        <a href="{{ route('berita.show', $item->slug) }}" class="article-card-title">
                            {{ $item->title }}
                        </a>

                        <p class="article-card-excerpt">
                            {{ $item->short_excerpt }}
                        </p>

                        <div class="article-card-meta">
                            <span>
                                <i class="bi bi-person-fill"></i>
                                {{ $item->author_name }}
                            </span>
                            <span>
                                <i class="bi bi-clock"></i>
                                {{ $item->reading_time }}
                            </span>
                            <span>
                                <i class="bi bi-eye"></i>
                                {{ number_format($item->views) }}
                            </span>
                        </div>

                        <a href="{{ route('berita.show', $item->slug) }}" class="article-read-btn">
                            Baca Berita <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    @if($news->hasPages())
        <div class="d-flex justify-content-center mt-5 pagination-wrap">
            {{ $news->links() }}
        </div>
    @endif
@else
    <div class="no-results">
        <i class="bi bi-newspaper"></i>
        <h4 style="font-family: var(--font-heading); color: var(--color-navy);">Berita tidak ditemukan</h4>
        <p class="text-muted">Coba kata kunci atau kategori yang berbeda.</p>
        <a href="{{ route('berita.index') }}" class="btn-primary-custom mt-3 reset-filter-btn">
            <i class="bi bi-arrow-left"></i> Lihat Semua Berita
        </a>
    </div>
@endif
