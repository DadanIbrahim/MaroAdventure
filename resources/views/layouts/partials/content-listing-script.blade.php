{{--
    Script filter AJAX bersama untuk halaman daftar Artikel & Berita.
    Parameter: $listingUrl (string) — URL dasar halaman daftar.
--}}
<script>
document.addEventListener('DOMContentLoaded', () => {
    const baseUrl = @json($listingUrl);
    const container = document.getElementById('listing-container');
    const pillsContainer = document.getElementById('listing-category-pills');
    const searchInput = document.getElementById('listing-search-input');
    const filterForm = document.getElementById('listing-filter-form');
    let debounceTimer = null;
    let abortController = null;

    if (!container) return;

    const buildUrl = () => {
        const query = searchInput ? searchInput.value.trim() : '';
        const activePill = pillsContainer ? pillsContainer.querySelector('.filter-pill.active') : null;
        const cat = activePill ? (activePill.dataset.category || '') : '';

        const url = new URL(baseUrl, window.location.origin);
        if (cat) url.searchParams.set('kategori', cat);
        if (query) url.searchParams.set('cari', query);

        return url.toString();
    };

    const syncFilterState = (urlStr) => {
        try {
            const url = new URL(urlStr, window.location.origin);
            const currentCat = url.searchParams.get('kategori') || '';
            const currentSearch = url.searchParams.get('cari') || '';

            if (pillsContainer) {
                pillsContainer.querySelectorAll('.filter-pill').forEach(pill => {
                    pill.classList.toggle('active', (pill.dataset.category || '') === currentCat);
                });
            }

            if (searchInput && document.activeElement !== searchInput) {
                searchInput.value = currentSearch;
            }
        } catch (e) {}
    };

    const fetchListing = (url, pushState = true) => {
        if (abortController) {
            abortController.abort();
        }
        abortController = new AbortController();

        container.style.opacity = '0.4';
        container.style.pointerEvents = 'none';

        fetch(url, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            signal: abortController.signal
        })
        .then(response => {
            if (!response.ok) throw new Error('Network error');
            return response.text();
        })
        .then(html => {
            container.innerHTML = html;
            container.style.opacity = '1';
            container.style.pointerEvents = 'auto';

            if (pushState) {
                history.pushState(null, '', url);
            }

            syncFilterState(url);
        })
        .catch(err => {
            if (err.name !== 'AbortError') {
                container.style.opacity = '1';
                container.style.pointerEvents = 'auto';
                console.error('AJAX load error:', err);
            }
        });
    };

    if (pillsContainer) {
        pillsContainer.addEventListener('click', (e) => {
            const pill = e.target.closest('.filter-pill');
            if (!pill) return;

            e.preventDefault();
            pillsContainer.querySelectorAll('.filter-pill').forEach(p => p.classList.remove('active'));
            pill.classList.add('active');

            fetchListing(buildUrl(), true);
        });
    }

    if (searchInput) {
        searchInput.addEventListener('input', () => {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => fetchListing(buildUrl(), true), 250);
        });
    }

    if (filterForm) {
        filterForm.addEventListener('submit', (e) => {
            e.preventDefault();
            clearTimeout(debounceTimer);
            fetchListing(buildUrl(), true);
        });
    }

    container.addEventListener('click', (e) => {
        const pageLink = e.target.closest('.pagination a');
        if (pageLink) {
            e.preventDefault();
            fetchListing(pageLink.href, true);
            container.scrollIntoView({ behavior: 'smooth', block: 'start' });
            return;
        }

        const resetBtn = e.target.closest('.reset-filter-btn');
        if (resetBtn) {
            e.preventDefault();
            if (searchInput) searchInput.value = '';
            fetchListing(baseUrl, true);
        }
    });

    window.addEventListener('popstate', () => {
        fetchListing(window.location.href, false);
    });
});
</script>
