@include('navbar')

<?php
$cur_page_series = $series['current'];
$cur_page_movie = $movies['current'];
?>

<style>
    body {
        background-color: #111119;
        color: #ffffff;
    }

    .movie-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        border: 1px solid #2d2d3f !important;
    }

    .movie-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.5);
    }

    .poster-wrapper {
        position: relative;
        padding-top: 140%;
        /* 5:7 Cinematic Aspect Ratio */
        background-color: #1e1e2f;
        overflow: hidden;
    }

    .poster-img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .card-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        z-index: 2;
    }
</style>

<main class="container my-4">
    {{-- ================= MOVIES SECTION ================= --}}
    <section class="mb-5">

        <h1 class="fw-bold mb-3 text-warning">Movies</h1>

        <div class="mb-4">
            <h3 class="h3 fw-bold mb-1">Search Results</h3>
            <p class="text-white small mb-0">
                Found {{ ($movies['totalResults'] ?? 0) }} matches
            </p>

            <span class="d-flex gap-2 justify-content-center align-items-center mt-4">
                {{-- PREV --}}
                @if (!empty($movies['prev']))
                    <a href="{{ '/get_movie/' . request()->segment(2) . '/' . urlencode(base64_encode($movies['prev'] . '##' . $cur_page_series)) }}"
                    class="btn btn-outline-warning btn-sm px-3">
                        ← Prev
                    </a>
                @else
                    <span class="btn btn-outline-secondary btn-sm px-3 disabled opacity-50">
                        ← Prev
                    </span>
                @endif


                {{-- PAGE INDICATOR (optional but nice) --}}
                <span class="text-white small px-2">
                    Page {{ $cur_page_movie . "#" . ceil($movies['totalResults'] / 10) }}
                </span>


                {{-- NEXT --}}
                @if (!empty($movies['next']))
                    <a href="{{ '/get_movie/' . request()->segment(2) . '/' . urlencode(base64_encode($movies['next'] . '##' . $cur_page_series)) }}"
                    class="btn btn-outline-warning btn-sm px-3">
                        Next →
                    </a>
                @else
                    <span class="btn btn-outline-warning btn-sm px-3 disabled opacity-50">
                        Next →
                    </span>
                @endif

            </span>
        </div>

        <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 g-3">

            @if(isset($movies['Search']) && is_array($movies['Search']))
                @foreach($movies['Search'] as $movie)
                    <div class="col">
                        <div class="card h-100 bg-dark text-white movie-card position-relative">

                            <span class="badge bg-secondary card-badge text-uppercase font-monospace"
                                style="font-size: 0.65rem;">
                                {{ $movie['Type'] }}
                            </span>

                            <div class="poster-wrapper">
                                @if($movie['Poster'] !== 'N/A')
                                    <img src="{{ $movie['Poster'] }}"
                                        class="poster-img"
                                        alt="{{ $movie['Title'] }}"
                                        onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">

                                    <div class="poster-fallback flex-column align-items-center justify-content-center bg-dark text-warning poster-img" style="display:none;">
                                        <i class="bi bi-image" style="font-size: 2rem;"></i>
                                        <label>Image Load Failed</label>
                                    </div>
                                @else
                                    <div class="poster-fallback d-flex flex-column align-items-center justify-content-center bg-dark text-warning poster-img" style="display:none;">
                                        <i class="bi bi-image" style="font-size: 2rem;"></i>
                                        <label>Image Load Failed</label>
                                    </div>
                                @endif
                            </div>

                            <div class="card-body p-2 d-flex flex-column justify-content-between">

                                <div>
                                    <h6 class="card-title text-truncate mb-0" title="{{ $movie['Title'] }}">
                                        {{ $movie['Title'] }}
                                    </h6>
                                    <small class="text-white d-block mb-2">{{ $movie['Year'] }}</small>
                                </div>

                                <div class="mt-auto pt-1 border-top border-secondary border-opacity-25 d-flex justify-content-between align-items-center">
                                    <form action="/watchlist/add" method="POST" class="m-0">
                                        @csrf
                                        <input type="hidden" name="imdbID" value="{{ $movie['imdbID'] }}">
                                        <input type="hidden" name="title" value="{{ $movie['Title'] }}">
                                        <input type="hidden" name="year" value="{{ $movie['Year'] }}">
                                        <input type="hidden" name="type" value="{{ $movie['Type'] }}">
                                        <input type="hidden" name="poster" value="{{ $movie['Poster'] }}">

                                        <button type="submit"
                                            class="btn btn-sm btn-outline-warning py-0 px-2"
                                            title="Add to Watchlist">
                                            <i class="bi bi-plus"></i>
                                        </button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12 text-center py-4 text-white">
                    No movies found.
                </div>
            @endif

        </div>
    </section>

    {{-- ================= SERIES SECTION ================= --}}
    <section>

        <h1 class="fw-bold mb-3 text-info">Series</h1>

        <div class="mb-4">
            <h3 class="h3 fw-bold mb-1">Search Results</h3>
            <p class="text-white small mb-0">
                Found {{ ($series['totalResults'] ?? 0) }} matches
            </p>

            <span class="d-flex gap-2 justify-content-center align-items-center mt-4">
                {{-- PREV --}}
                @if (!empty($series['prev']))
                    <a href="{{ '/get_movie/' . request()->segment(2) . '/' . urlencode(base64_encode($cur_page_movie . '##' . $series['prev'])) }}"
                    class="btn btn-outline-warning btn-sm px-3">
                        ← Prev
                    </a>
                @else
                    <span class="btn btn-outline-secondary btn-sm px-3 disabled opacity-50">
                        ← Prev
                    </span>
                @endif


                {{-- PAGE INDICATOR (optional but nice) --}}
                <span class="text-white small px-2">
                    Page {{ $cur_page_series . "#" . ceil($series['totalResults'] / 10) }}
                </span>


                {{-- NEXT --}}
                @if (!empty($movies['next']))
                    <a href="{{ '/get_movie/' . request()->segment(2) . '/' . urlencode(base64_encode($cur_page_movie . '##' . $series['next'])) }}"
                    class="btn btn-outline-warning btn-sm px-3">
                        Next →
                    </a>
                @else
                    <span class="btn btn-outline-warning btn-sm px-3 disabled opacity-50">
                        Next →
                    </span>
                @endif

            </span>
        </div>

        <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 g-3">

            @if(isset($series['Search']) && is_array($series['Search']))
                @foreach($series['Search'] as $show)
                    <div class="col">
                        <div class="card h-100 bg-dark text-white movie-card position-relative">

                            <span class="badge bg-primary card-badge text-uppercase font-monospace"
                                style="font-size: 0.65rem;">
                                {{ $show['Type'] }}
                            </span>

                            <div class="poster-wrapper">
                                @if($show['Poster'] !== 'N/A')
                                    <img src="{{ $show['Poster'] }}"
                                        class="poster-img"
                                        alt="{{ $show['Title'] }}"
                                        onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">

                                    <div class="poster-fallback flex-column align-items-center justify-content-center bg-dark text-warning poster-img" style="display:none;">
                                        <i class="bi bi-image" style="font-size: 2rem;"></i>
                                        <label>Image Load Failed</label>
                                    </div>
                                @else
                                    <div class="poster-fallback d-flex flex-column align-items-center justify-content-center bg-dark text-warning poster-img" style="display:none;">
                                        <i class="bi bi-image" style="font-size: 2rem;"></i>
                                        <label>Image Load Failed</label>
                                    </div>
                                @endif
                            </div>

                            <div class="card-body p-2 d-flex flex-column justify-content-between">

                                <div>
                                    <h6 class="card-title text-truncate mb-0" title="{{ $show['Title'] }}">
                                        {{ $show['Title'] }}
                                    </h6>
                                    <small class="text-white d-block mb-2">{{ $show['Year'] }}</small>
                                </div>

                                <div class="mt-auto pt-1 border-top border-secondary border-opacity-25 d-flex justify-content-between align-items-center">
                                    <span class="text-muted small">TV Series</span>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12 text-center py-4 text-white">
                    No series found.
                </div>
            @endif

        </div>
    </section>

</main>


@include('footer')