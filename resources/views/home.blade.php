@include('navbar')

<?php
$cur_page_series = $series['current'];
$cur_page_movie  = $movies['current'];
$total_movie_pages = (int) ceil(($movies['totalResults'] ?? 0) / 10);
$total_series_pages = (int) ceil(($series['totalResults'] ?? 0) / 10);
?>

<style>
    /* ── Tokens ─────────────────────────────────────── */
    :root {
        --bg:          #0A0A0F;
        --surface:     #12121A;
        --surface-2:   #1A1A26;
        --border:      #1E1E2E;
        --border-2:    #2A2A3E;
        --gold:        #F5C518;
        --gold-dim:    rgba(245, 197, 24, 0.15);
        --blue:        #4FC3F7;
        --blue-dim:    rgba(79, 195, 247, 0.15);
        --text:        #E8E8F0;
        --text-muted:  #8B8FA8;
        --text-faint:  #3E3E56;
        --radius:      10px;
        --radius-sm:   6px;
        --transition:  200ms cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* ── Base ───────────────────────────────────────── */
    body {
        background-color: var(--bg);
        color: var(--text);
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    }

    /* ── Section headers ────────────────────────────── */
    .section-header {
        display: flex;
        align-items: baseline;
        gap: 12px;
        margin-bottom: 20px;
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 700;
        letter-spacing: -0.02em;
        line-height: 1;
    }

    .section-title.movies { color: var(--gold); }
    .section-title.series { color: var(--blue); }

    .section-count {
        font-size: 0.78rem;
        color: var(--text-muted);
        font-variant-numeric: tabular-nums;
        background: var(--surface-2);
        border: 1px solid var(--border);
        padding: 2px 8px;
        border-radius: 20px;
        white-space: nowrap;
    }

    /* ── Film-strip divider (signature element) ─────── */
    .filmstrip-divider {
        position: relative;
        height: 28px;
        background: var(--surface);
        border-top: 1px solid var(--border-2);
        border-bottom: 1px solid var(--border-2);
        margin: 48px 0 40px;
        overflow: hidden;
        display: flex;
        align-items: center;
        gap: 0;
    }

    .filmstrip-divider::before,
    .filmstrip-divider::after {
        content: '';
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        height: 14px;
        width: 100%;
        background-image: repeating-linear-gradient(
            90deg,
            transparent 0,
            transparent 14px,
            var(--border-2) 14px,
            var(--border-2) 16px,
            transparent 16px,
            transparent 30px
        );
    }

    .filmstrip-label {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        background: var(--surface);
        padding: 0 16px;
        font-size: 0.7rem;
        font-weight: 600;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        color: var(--text-faint);
        z-index: 1;
        white-space: nowrap;
    }

    /* ── Cards ──────────────────────────────────────── */
    .movie-card {
        background: var(--surface) !important;
        border: 1px solid var(--border) !important;
        border-radius: var(--radius) !important;
        overflow: hidden;
        transition:
            transform var(--transition),
            border-color var(--transition),
            box-shadow var(--transition);
        cursor: pointer;
    }

    .movie-card:hover {
        transform: translateY(-4px);
        border-color: var(--border-2) !important;
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.6);
    }

    .movies-section .movie-card:hover { border-color: rgba(245, 197, 24, 0.3) !important; }
    .series-section .movie-card:hover  { border-color: rgba(79, 195, 247, 0.3) !important; }

    /* ── Poster ─────────────────────────────────────── */
    .poster-wrapper {
        position: relative;
        padding-top: 148%; /* 2:3 ratio */
        background: var(--surface-2);
        overflow: hidden;
    }

    .poster-img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform var(--transition);
    }

    .movie-card:hover .poster-img { transform: scale(1.04); }

    .poster-fallback {
        position: absolute;
        inset: 0;
        display: none;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: var(--surface-2);
        color: var(--text-faint);
    }

    .poster-fallback i { font-size: 2rem; }
    .poster-fallback span { font-size: 0.65rem; letter-spacing: 0.05em; }

    /* ── Overlay on hover (quick-add prompt) ────────── */
    .poster-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(10,10,15,0.92) 0%, transparent 55%);
        opacity: 0;
        transition: opacity var(--transition);
        display: flex;
        align-items: flex-end;
        padding: 12px;
    }

    .movie-card:hover .poster-overlay { opacity: 1; }

    /* ── Type badge ─────────────────────────────────── */
    .type-badge {
        position: absolute;
        top: 8px;
        left: 8px;
        z-index: 3;
        font-size: 0.6rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        padding: 3px 7px;
        border-radius: 4px;
    }

    .badge-movie  { background: var(--gold-dim);  color: var(--gold); border: 1px solid rgba(245,197,24,0.3); }
    .badge-series { background: var(--blue-dim);  color: var(--blue); border: 1px solid rgba(79,195,247,0.3); }
    .badge-other  { background: rgba(160,160,200,0.15); color: var(--text-muted); border: 1px solid var(--border-2); }

    /* ── Card body ──────────────────────────────────── */
    .card-body {
        padding: 10px !important;
        background: var(--surface);
    }

    .card-title {
        font-size: 0.82rem;
        font-weight: 600;
        line-height: 1.3;
        color: var(--text);
        margin-bottom: 2px;
        /* two-line clamp */
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
        overflow: hidden;
        white-space: normal !important;
        text-overflow: unset !important;
    }

    .card-year {
        font-size: 0.72rem;
        color: var(--text-muted);
        font-variant-numeric: tabular-nums;
    }

    /* ── Watchlist button ───────────────────────────── */
    .btn-watchlist {
        background: none;
        border: 1px solid var(--border-2);
        border-radius: var(--radius-sm);
        color: var(--text-muted);
        font-size: 0.72rem;
        padding: 3px 8px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        transition: background var(--transition), color var(--transition), border-color var(--transition);
        cursor: pointer;
        white-space: nowrap;
    }

    .movies-section .btn-watchlist:hover {
        background: var(--gold-dim);
        color: var(--gold);
        border-color: rgba(245,197,24,0.4);
    }

    .series-section .btn-watchlist:hover {
        background: var(--blue-dim);
        color: var(--blue);
        border-color: rgba(79,195,247,0.4);
    }

    /* ── Pagination ─────────────────────────────────── */
    .pagination-bar {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 24px;
    }

    .page-info {
        font-size: 0.75rem;
        color: var(--text-muted);
        font-variant-numeric: tabular-nums;
        background: var(--surface-2);
        border: 1px solid var(--border);
        padding: 5px 14px;
        border-radius: 20px;
        flex: 0 0 auto;
    }

    .btn-page {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 0.75rem;
        font-weight: 600;
        padding: 5px 14px;
        border-radius: 20px;
        border: 1px solid var(--border);
        background: var(--surface-2);
        color: var(--text);
        text-decoration: none;
        transition: background var(--transition), border-color var(--transition), color var(--transition);
        white-space: nowrap;
    }

    .movies-section .btn-page:hover:not(.disabled) {
        background: var(--gold-dim);
        border-color: rgba(245,197,24,0.4);
        color: var(--gold);
    }

    .series-section .btn-page:hover:not(.disabled) {
        background: var(--blue-dim);
        border-color: rgba(79,195,247,0.4);
        color: var(--blue);
    }

    .btn-page.disabled {
        opacity: 0.35;
        pointer-events: none;
        cursor: default;
    }

    /* ── Empty state ────────────────────────────────── */
    .empty-state {
        grid-column: 1 / -1;
        text-align: center;
        padding: 48px 16px;
        color: var(--text-faint);
    }

    .empty-state i { font-size: 2.5rem; display: block; margin-bottom: 12px; }
    .empty-state p { font-size: 0.85rem; margin: 0; }

    /* ── Responsive grid ────────────────────────────── */
    .cards-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
    }

    @media (min-width: 480px)  { .cards-grid { grid-template-columns: repeat(3, 1fr); } }
    @media (min-width: 768px)  { .cards-grid { grid-template-columns: repeat(4, 1fr); } }
    @media (min-width: 1024px) { .cards-grid { grid-template-columns: repeat(5, 1fr); } }

    @media (prefers-reduced-motion: reduce) {
        *, *::before, *::after { transition-duration: 0ms !important; }
    }
</style>

<main class="container py-5">

    {{-- ═══════════════════════════════════════
         MOVIES SECTION
    ═══════════════════════════════════════ --}}
    <section class="movies-section">

        <div class="section-header">
            <h2 class="section-title movies">Movies</h2>
            <span class="section-count">
                {{ number_format($movies['totalResults'] ?? 0) }} results
            </span>
        </div>

        <div class="pagination-bar">
            {{-- PREV --}}
            @if (!empty($movies['prev']))
                <a href="{{ '/get_movie/' . request()->segment(2) . '/' . urlencode(base64_encode($movies['prev'] . '##' . $cur_page_series)) }}"
                   class="btn-page">
                    ← Prev
                </a>
            @else
                <span class="btn-page disabled">← Prev</span>
            @endif

            <span class="page-info">
                Page {{ $cur_page_movie }} of {{ max(1, $total_movie_pages) }}
            </span>

            @if (!empty($movies['next']))
                <a href="{{ '/get_movie/' . request()->segment(2) . '/' . urlencode(base64_encode($movies['next'] . '##' . $cur_page_series)) }}"
                   class="btn-page">
                    Next →
                </a>
            @else
                <span class="btn-page disabled">Next →</span>
            @endif
        </div>

        <div class="cards-grid">
            @if(isset($movies['Search']) && is_array($movies['Search']) && count($movies['Search']) > 0)
                @foreach($movies['Search'] as $movie)
                    @php
                        $typeClass = match(strtolower($movie['Type'] ?? '')) {
                            'movie'  => 'badge-movie',
                            'series' => 'badge-series',
                            default  => 'badge-other',
                        };
                        $hasPoster = isset($movie['Poster']) && $movie['Poster'] !== 'N/A';
                    @endphp

                    <div class="movie-card">
                        <div class="poster-wrapper">

                            <span class="type-badge {{ $typeClass }}">
                                {{ $movie['Type'] ?? 'unknown' }}
                            </span>

                            @if($hasPoster)
                                <img
                                    src="{{ $movie['Poster'] }}"
                                    class="poster-img"
                                    alt="{{ $movie['Title'] }}"
                                    loading="lazy"
                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            @endif

                            <div class="poster-fallback" @if(!$hasPoster) style="display:flex" @endif>
                                <i class="bi bi-film"></i>
                                <span>No poster</span>
                            </div>

                            {{-- Hover overlay with watchlist button --}}
                            <div class="poster-overlay">
                                <form action="/watchlist/add" method="POST" class="m-0 w-100">
                                    @csrf
                                    <input type="hidden" name="imdbID" value="{{ $movie['imdbID'] }}">
                                    <input type="hidden" name="title"  value="{{ $movie['Title'] }}">
                                    <input type="hidden" name="year"   value="{{ $movie['Year'] }}">
                                    <input type="hidden" name="type"   value="{{ $movie['Type'] }}">
                                    <input type="hidden" name="poster" value="{{ $movie['Poster'] }}">
                                    <button type="submit" class="btn-watchlist w-100 justify-content-center">
                                        <i class="bi bi-plus-lg"></i> Add to Watchlist
                                    </button>
                                </form>
                            </div>

                        </div>

                        <div class="card-body">
                            <p class="card-title" title="{{ $movie['Title'] }}">
                                {{ $movie['Title'] }}
                            </p>
                            <span class="card-year">{{ $movie['Year'] }}</span>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="empty-state">
                    <i class="bi bi-film"></i>
                    <p>No movies found for this search.</p>
                </div>
            @endif
        </div>

    </section>

    {{-- ═══════════════════════════════════════
         FILM-STRIP DIVIDER
    ═══════════════════════════════════════ --}}
    <div class="filmstrip-divider" role="separator" aria-hidden="true">
        <span class="filmstrip-label">TV Series</span>
    </div>

    {{-- ═══════════════════════════════════════
         SERIES SECTION
    ═══════════════════════════════════════ --}}
    <section class="series-section">

        <div class="section-header">
            <h2 class="section-title series">Series</h2>
            <span class="section-count">
                {{ number_format($series['totalResults'] ?? 0) }} results
            </span>
        </div>

        <div class="pagination-bar">
            @if (!empty($series['prev']))
                <a href="{{ '/get_movie/' . request()->segment(2) . '/' . urlencode(base64_encode($cur_page_movie . '##' . $series['prev'])) }}"
                   class="btn-page">
                    ← Prev
                </a>
            @else
                <span class="btn-page disabled">← Prev</span>
            @endif

            <span class="page-info">
                Page {{ $cur_page_series }} of {{ max(1, $total_series_pages) }}
            </span>

            {{-- BUG FIX: was checking $movies['next'] instead of $series['next'] --}}
            @if (!empty($series['next']))
                <a href="{{ '/get_movie/' . request()->segment(2) . '/' . urlencode(base64_encode($cur_page_movie . '##' . $series['next'])) }}"
                   class="btn-page">
                    Next →
                </a>
            @else
                <span class="btn-page disabled">Next →</span>
            @endif
        </div>

        <div class="cards-grid">
            @if(isset($series['Search']) && is_array($series['Search']) && count($series['Search']) > 0)
                @foreach($series['Search'] as $show)
                    @php $hasPoster = isset($show['Poster']) && $show['Poster'] !== 'N/A'; @endphp

                    <div class="movie-card">
                        <div class="poster-wrapper">

                            <span class="type-badge badge-series">
                                series
                            </span>

                            @if($hasPoster)
                                <img
                                    src="{{ $show['Poster'] }}"
                                    class="poster-img"
                                    alt="{{ $show['Title'] }}"
                                    loading="lazy"
                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            @endif

                            <div class="poster-fallback" @if(!$hasPoster) style="display:flex" @endif>
                                <i class="bi bi-tv"></i>
                                <span>No poster</span>
                            </div>

                        </div>

                        <div class="card-body">
                            <p class="card-title" title="{{ $show['Title'] }}">
                                {{ $show['Title'] }}
                            </p>
                            <span class="card-year">{{ $show['Year'] }}</span>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="empty-state">
                    <i class="bi bi-tv"></i>
                    <p>No series found for this search.</p>
                </div>
            @endif
        </div>

    </section>

</main>

@include('footer')