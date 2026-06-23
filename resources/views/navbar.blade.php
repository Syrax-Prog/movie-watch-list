<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineTrack - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>

<body>
    <style>
        /* ── Navbar tokens (inherit from :root when available) ── */
        :root {
            --bg: #0A0A0F;
            --surface: #12121A;
            --surface-2: #1A1A26;
            --border: #1E1E2E;
            --border-2: #2A2A3E;
            --gold: #F5C518;
            --gold-dim: rgba(245, 197, 24, 0.15);
            --text: #E8E8F0;
            --text-muted: #8B8FA8;
            --text-faint: #3E3E56;
            --transition: 200ms cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* ── Shell ───────────────────────────────────────────── */
        .ct-nav {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: rgba(10, 10, 15, 0.85);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--border);
            height: 58px;
            display: flex;
            align-items: center;
        }

        .ct-nav .container-fluid {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 0 20px;
        }

        /* ── Brand ───────────────────────────────────────────── */
        .ct-brand {
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            color: var(--text);
            font-weight: 700;
            font-size: 1rem;
            letter-spacing: -0.02em;
            flex-shrink: 0;
            margin-right: 8px;
        }

        .ct-brand-icon {
            width: 30px;
            height: 30px;
            background: var(--gold);
            border-radius: 7px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #000;
            font-size: 0.85rem;
            flex-shrink: 0;
        }

        .ct-brand span em {
            color: var(--gold);
            font-style: normal;
        }

        /* ── Nav links ───────────────────────────────────────── */
        .ct-links {
            display: flex;
            align-items: center;
            gap: 2px;
            margin-right: auto;
            list-style: none;
            padding: 0;
            margin-bottom: 0;
        }

        .ct-links a {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 5px 11px;
            border-radius: 7px;
            font-size: 0.82rem;
            font-weight: 500;
            color: var(--text-muted);
            text-decoration: none;
            transition: background var(--transition), color var(--transition);
            white-space: nowrap;
        }

        .ct-links a:hover {
            background: var(--surface-2);
            color: var(--text);
        }

        .ct-links a.active {
            background: var(--gold-dim);
            color: var(--gold);
        }

        .ct-links a i {
            font-size: 0.8rem;
        }

        /* ── Search form ─────────────────────────────────────── */
        .ct-search {
            position: relative;
            flex-shrink: 0;
        }

        .ct-search-input {
            background: var(--surface-2);
            border: 1px solid var(--border);
            border-radius: 8px;
            color: var(--text);
            font-size: 0.82rem;
            height: 34px;
            padding: 0 36px 0 12px;
            width: 200px;
            outline: none;
            transition: border-color var(--transition), width var(--transition), background var(--transition);
        }

        .ct-search-input::placeholder {
            color: var(--text-faint);
        }

        .ct-search-input:focus {
            border-color: var(--gold);
            background: var(--surface);
            width: 260px;
            box-shadow: 0 0 0 3px var(--gold-dim);
        }

        .ct-search-btn {
            position: absolute;
            right: 8px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--text-faint);
            padding: 0;
            cursor: pointer;
            font-size: 0.8rem;
            display: flex;
            align-items: center;
            transition: color var(--transition);
        }

        .ct-search-input:focus+.ct-search-btn,
        .ct-search-btn:hover {
            color: var(--gold);
        }

        /* ── Divider ─────────────────────────────────────────── */
        .ct-divider {
            width: 1px;
            height: 20px;
            background: var(--border-2);
            flex-shrink: 0;
            margin: 0 4px;
        }

        /* ── Avatar + dropdown ───────────────────────────────── */
        .ct-profile {
            position: relative;
            flex-shrink: 0;
        }

        .ct-avatar-btn {
            background: none;
            border: none;
            padding: 0;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            border-radius: 8px;
            padding: 3px 6px;
            transition: background var(--transition);
        }

        .ct-avatar-btn:hover {
            background: var(--surface-2);
        }

        .ct-avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: var(--gold);
            color: #000;
            font-size: 0.75rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .ct-avatar-label {
            font-size: 0.8rem;
            font-weight: 500;
            color: var(--text-muted);
        }

        .ct-avatar-caret {
            font-size: 0.6rem;
            color: var(--text-faint);
            transition: transform var(--transition);
        }

        .ct-profile.open .ct-avatar-caret {
            transform: rotate(180deg);
        }

        /* ── Dropdown menu ───────────────────────────────────── */
        .ct-dropdown {
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            min-width: 200px;
            background: var(--surface);
            border: 1px solid var(--border-2);
            border-radius: 10px;
            padding: 6px;
            box-shadow: 0 16px 40px rgba(0, 0, 0, 0.6);
            opacity: 0;
            transform: translateY(-6px) scale(0.97);
            pointer-events: none;
            transition: opacity var(--transition), transform var(--transition);
            z-index: 100;
        }

        .ct-profile.open .ct-dropdown {
            opacity: 1;
            transform: translateY(0) scale(1);
            pointer-events: auto;
        }

        /* ── Dropdown header ─────────────────────────────────── */
        .ct-dd-header {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 10px 10px;
            border-bottom: 1px solid var(--border);
            margin-bottom: 6px;
        }

        .ct-dd-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--gold);
            color: #000;
            font-size: 0.85rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .ct-dd-name {
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--text);
            line-height: 1.2;
        }

        .ct-dd-email {
            font-size: 0.7rem;
            color: var(--text-muted);
            line-height: 1.2;
        }

        /* ── Dropdown items ──────────────────────────────────── */
        .ct-dd-item {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 7px 10px;
            border-radius: 7px;
            font-size: 0.8rem;
            color: var(--text-muted);
            text-decoration: none;
            transition: background var(--transition), color var(--transition);
        }

        .ct-dd-item:hover {
            background: var(--surface-2);
            color: var(--text);
        }

        .ct-dd-item.danger:hover {
            background: rgba(239, 68, 68, 0.12);
            color: #f87171;
        }

        .ct-dd-item i {
            font-size: 0.8rem;
            width: 14px;
            text-align: center;
        }

        .ct-dd-sep {
            height: 1px;
            background: var(--border);
            margin: 5px 0;
        }

        /* ── Mobile toggle ───────────────────────────────────── */
        .ct-mobile-toggle {
            display: none;
            background: none;
            border: 1px solid var(--border-2);
            color: var(--text-muted);
            border-radius: 7px;
            padding: 5px 8px;
            font-size: 0.9rem;
            cursor: pointer;
            margin-left: auto;
            transition: background var(--transition), color var(--transition);
        }

        .ct-mobile-toggle:hover {
            background: var(--surface-2);
            color: var(--text);
        }

        /* ── Mobile drawer ───────────────────────────────────── */
        .ct-mobile-drawer {
            display: none;
            flex-direction: column;
            gap: 2px;
            padding: 12px 16px 16px;
            border-top: 1px solid var(--border);
            background: rgba(10, 10, 15, 0.97);
        }

        .ct-mobile-drawer.open {
            display: flex;
        }

        .ct-mobile-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 12px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 500;
            color: var(--text-muted);
            text-decoration: none;
            transition: background var(--transition), color var(--transition);
        }

        .ct-mobile-link:hover {
            background: var(--surface-2);
            color: var(--text);
        }

        .ct-mobile-link.active {
            background: var(--gold-dim);
            color: var(--gold);
        }

        .ct-mobile-search {
            margin-top: 8px;
            display: flex;
            gap: 8px;
        }

        .ct-mobile-search input {
            flex: 1;
            background: var(--surface-2);
            border: 1px solid var(--border);
            border-radius: 8px;
            color: var(--text);
            font-size: 0.82rem;
            height: 36px;
            padding: 0 12px;
            outline: none;
        }

        .ct-mobile-search input:focus {
            border-color: var(--gold);
        }

        .ct-mobile-search button {
            height: 36px;
            padding: 0 14px;
            background: var(--gold-dim);
            border: 1px solid rgba(245, 197, 24, 0.3);
            border-radius: 8px;
            color: var(--gold);
            font-size: 0.8rem;
            cursor: pointer;
        }

        /* ── Responsive breakpoint ───────────────────────────── */
        @media (max-width: 768px) {

            .ct-links,
            .ct-divider,
            .ct-search,
            .ct-avatar-label,
            .ct-avatar-caret {
                display: none;
            }

            .ct-mobile-toggle {
                display: flex;
                align-items: center;
                gap: 6px;
            }

            .ct-nav {
                height: auto;
                flex-wrap: wrap;
                align-items: stretch;
                padding: 0;
            }

            .ct-nav .container-fluid {
                height: 54px;
            }
        }

        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                transition-duration: 0ms !important;
            }
        }
    </style>

    {{-- ═══════════════════════ NAVBAR ═══════════════════════ --}}
    <nav class="ct-nav" role="navigation" aria-label="Main navigation">
        <div class="container-fluid">

            {{-- Brand --}}
            <a class="ct-brand" href="/">
                <span class="ct-brand-icon"><i class="bi bi-film"></i></span>
                <span>Cine<em>Track</em></span>
            </a>

            {{-- Desktop nav links --}}
            <ul class="ct-links">
                <li>
                    <a href="/watchlist" class="{{ request()->is('watchlist*') ? 'active' : '' }}">
                        <i class="bi bi-bookmark-fill"></i> My List
                    </a>
                </li>
                <li>
                    <a href="/discovered" class="{{ request()->is('discovered*') ? 'active' : '' }}">
                        <i class="bi bi-compass"></i> Discovered
                    </a>
                </li>
                <li>
                    <a href="/stats" class="{{ request()->is('stats*') ? 'active' : '' }}">
                        <i class="bi bi-bar-chart-line"></i> Stats
                    </a>
                </li>
            </ul>

            {{-- Desktop search --}}
            <form class="ct-search" role="search" action="/get_movie/search" method="POST">
                @csrf
                <input class="ct-search-input" type="search" name="name" placeholder="Search movies & series…"
                    aria-label="Search movies and series" value="{{ request('name') }}" autocomplete="off">
                <button class="ct-search-btn" type="submit" aria-label="Submit search">
                    <i class="bi bi-search"></i>
                </button>
            </form>

            <div class="ct-divider" aria-hidden="true"></div>

            {{-- Profile dropdown --}}
            <div class="ct-profile" id="ctProfile">
                <button class="ct-avatar-btn" aria-haspopup="true" aria-expanded="false" id="ctAvatarBtn"
                    aria-label="Open profile menu">
                    <div class="ct-avatar">{{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}</div>
                    <span class="ct-avatar-label">{{ Auth::user()->name ?? 'Profile' }}</span>
                    <i class="bi bi-chevron-down ct-avatar-caret"></i>
                </button>

                <div class="ct-dropdown" role="menu" aria-labelledby="ctAvatarBtn">
                    {{-- User info header --}}
                    <div class="ct-dd-header">
                        <div class="ct-dd-avatar">{{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}</div>
                        <div>
                            <div class="ct-dd-name">{{ Auth::user()->name ?? 'Guest' }}</div>
                            <div class="ct-dd-email">{{ Auth::user()->email ?? '' }}</div>
                        </div>
                    </div>

                    <a href="/settings" class="ct-dd-item" role="menuitem">
                        <i class="bi bi-gear"></i> Settings
                    </a>
                    <a href="/watchlist" class="ct-dd-item" role="menuitem">
                        <i class="bi bi-bookmark"></i> My Watchlist
                    </a>
                    <a href="/stats" class="ct-dd-item" role="menuitem">
                        <i class="bi bi-bar-chart-line"></i> My Stats
                    </a>

                    <div class="ct-dd-sep" role="separator"></div>

                    <a href="/logout" class="ct-dd-item danger" role="menuitem"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right"></i> Sign out
                    </a>
                </div>
            </div>

            {{-- Mobile toggle --}}
            <button class="ct-mobile-toggle" id="ctMobileToggle" aria-controls="ctMobileDrawer" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="bi bi-list" id="ctMobileIcon"></i>
                <span style="font-size:0.75rem; font-weight:600; color:var(--text-muted)">Menu</span>
            </button>

        </div>{{-- /container-fluid --}}
    </nav>

    {{-- Hidden logout form (Laravel convention for POST /logout) --}}
    <form id="logout-form" action="/logout" method="POST" style="display:none">@csrf</form>

    <script>
        (function () {
            // ── Profile dropdown ─────────────────────────────────
            const profile = document.getElementById('ctProfile');
            const avatarBtn = document.getElementById('ctAvatarBtn');

            avatarBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                const isOpen = profile.classList.toggle('open');
                avatarBtn.setAttribute('aria-expanded', isOpen);
            });

            // Close when clicking outside
            document.addEventListener('click', function (e) {
                if (!profile.contains(e.target)) {
                    profile.classList.remove('open');
                    avatarBtn.setAttribute('aria-expanded', 'false');
                }
            });

            // Close on Escape
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') {
                    profile.classList.remove('open');
                    avatarBtn.setAttribute('aria-expanded', 'false');
                    avatarBtn.focus();
                }
            });

            // ── Mobile drawer ─────────────────────────────────────
            const mobileToggle = document.getElementById('ctMobileToggle');
            const mobileDrawer = document.getElementById('ctMobileDrawer');
            const mobileIcon = document.getElementById('ctMobileIcon');

            mobileToggle.addEventListener('click', function () {
                const isOpen = mobileDrawer.classList.toggle('open');
                mobileToggle.setAttribute('aria-expanded', isOpen);
                mobileDrawer.setAttribute('aria-hidden', !isOpen);
                mobileIcon.className = isOpen ? 'bi bi-x-lg' : 'bi bi-list';
            });
        })();
    </script>