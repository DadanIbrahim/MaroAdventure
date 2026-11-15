{{-- Gaya bersama untuk halaman daftar Artikel & Berita --}}
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

/* ── Cards ── */
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

/* Sub-kategori berita memakai palet yang sama */
.cat-pengumuman  { background: #DBEAFE; color: #1D4ED8; }
.cat-kegiatan    { background: #D1FAE5; color: #065F46; }
.cat-jadwal-trip { background: #E0F2FE; color: #0369A1; }
.cat-info-gunung { background: #FEF3C7; color: #92400E; }

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
