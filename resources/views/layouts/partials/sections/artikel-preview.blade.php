<section id="artikel-preview" style="padding: 90px 0; background: var(--color-white);">

    <div class="container">

        <div class="section-header fade-up">

            <div class="badge-tag">
                <i class="bi bi-newspaper me-1"></i>
                Artikel & Berita
            </div>

            <h2 class="section-title">
                Cerita & Inspirasi Perjalanan
            </h2>

            <div class="divider-line mt-3 mb-3"></div>

            <p class="section-subtitle">
                Tips mendaki, kisah perjalanan, info destinasi, dan berita terbaru
                dari dunia petualangan alam Indonesia.
            </p>

        </div>


        @php
            $previews = \App\Models\Article::published()
                ->latest('published_at')
                ->take(3)
                ->get();
        @endphp

        @if($previews->count() > 0)

            <div class="row g-4 stagger-children">

                @foreach($previews as $index => $artikel)

                    <div class="col-12 {{ $index === 0 ? 'col-lg-6' : 'col-md-6 col-lg-3' }} fade-up">

                        <div class="article-prev-card {{ $index === 0 ? 'article-prev-card--featured' : '' }}">

                            <div class="article-prev-img">
                                <img
                                    src="{{ $artikel->thumbnail_url }}"
                                    alt="{{ $artikel->title }}"
                                    loading="lazy"
                                >
                                <span class="article-prev-cat {{ \App\Models\Article::categoryColor($artikel->category) }}">
                                    {{ $artikel->category }}
                                </span>
                            </div>

                            <div class="article-prev-body">

                                <a
                                    href="{{ route('artikel.show', $artikel->slug) }}"
                                    class="article-prev-title"
                                >
                                    {{ $artikel->title }}
                                </a>

                                @if($index === 0)
                                    <p class="article-prev-excerpt">
                                        {{ $artikel->short_excerpt }}
                                    </p>
                                @endif

                                <div class="article-prev-meta">
                                    <span>
                                        <i class="bi bi-person-fill"></i>
                                        {{ $artikel->author_name }}
                                    </span>
                                    <span>
                                        <i class="bi bi-clock"></i>
                                        {{ $artikel->reading_time }}
                                    </span>
                                </div>

                                <a
                                    href="{{ route('artikel.show', $artikel->slug) }}"
                                    class="article-prev-link"
                                >
                                    Baca Selengkapnya
                                    <i class="bi bi-arrow-right"></i>
                                </a>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

            <div class="text-center mt-5 fade-up">
                <a href="{{ route('artikel.index') }}" class="btn-primary-custom">
                    <i class="bi bi-newspaper"></i>
                    Lihat Semua Artikel
                </a>
            </div>

        @endif

    </div>

</section>
