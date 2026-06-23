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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom border-secondary">
        <div class="container-fluid px-4">

            <!-- Brand / Logo -->
            <a class="navbar-brand fw-bold text-warning d-flex align-items-center" href="#">
                <i class="bi bi-film me-2"></i>CineTrack
            </a>

            <!-- Mobile Toggle Button -->
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#watchlistNavbar" aria-controls="watchlistNavbar" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Links & Actions -->
            <div class="collapse navbar-collapse" id="watchlistNavbar">

                <!-- Navigation Links -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">My List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Discovered</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Stats</a>
                    </li>
                </ul>

                <!-- Search Bar & Profile -->
                <div class="d-flex flex-column flex-lg-row align-items-lg-center gap-3">

                    <!-- Quick Search Input -->
                    <form class="d-flex" role="search" action="/test" method="post">
                        <div class="input-group input-group-sm">
                            <input class="form-control bg-secondary bg-opacity-25 border-secondary text-white"
                                type="search" placeholder="Search watchlist..." aria-label="Search" name="name">
                            <button class="btn btn-outline-secondary border-secondary text-white" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>

                    <!-- Profile Dropdown -->
                    <div class="dropdown">
                        <a class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" href="#"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="bg-warning text-dark rounded-circle d-flex align-items-center justify-content-center fw-bold me-2"
                                style="width: 32px; height: 32px;">
                                M
                            </div>
                            <span class="d-lg-none">Profile</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark bg-dark border-secondary">
                            <li><a class="dropdown-menu-item dropdown-item" href="#"><i
                                        class="bi bi-gear me-2"></i>Settings</a></li>
                            <li>
                                <hr class="dropdown-divider border-secondary">
                            </li>
                            <li><a class="dropdown-menu-item dropdown-item text-danger" href="#"><i
                                        class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                        </ul>
                    </div>

                </div>

            </div>
        </div>
    </nav>