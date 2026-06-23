<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineTrack - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #1e1e2f 0%, #111119 100%);
            min-height: 100vh;
        }

        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-8 col-md-6 col-lg-4">

                <div class="card bg-dark text-white p-4">
                    <div class="card-body">

                        <div class="text-center mb-4">
                            <h2 class="fw-bold text-warning">
                                <i class="bi bi-film me-2"></i>Movie 
                            </h2>
                            <p class="text-wite small">Manage your personal movie watchlist</p>
                        </div>

                        <form action="login_process.php" method="POST">

                            <div class="mb-3">
                                <label for="email" class="form-label text-light">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-secondary border-secondary text-white">
                                        <i class="bi bi-envelope"></i>
                                    </span>
                                    <input type="email" class="form-control bg-dark border-secondary text-white" id="email" name="email" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label text-light">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-secondary border-secondary text-white">
                                        <i class="bi bi-lock"></i>
                                    </span>
                                    <input type="password" class="form-control bg-dark border-secondary text-white" id="password" name="password" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-warning w-100 fw-bold mb-3">
                                Sign In
                            </button>

                        </form>

                        <div class="text-center mt-3">
                            <p class="mb-0 text-white small">Don't have an account?
                                <a href="#" class="text-warning text-decoration-none fw-bold">Sign Up</a>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>