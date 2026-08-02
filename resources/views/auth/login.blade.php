<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Graduance</title>
    <link rel="shortcut icon" type="image/svg+xml" href="/assets/img/favicon.svg" />
    <link rel="icon" type="image/svg+xml" href="/assets/img/favicon.svg" />
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Vendor & Main CSS -->
    <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/assets/css/style.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #fef8f5 0%, #fff 100%);
            min-height: 100vh;
        }
        .auth-card {
            background: #ffffff;
            border: 1px solid var(--card-border);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            padding: 40px 32px;
            max-width: 440px;
            width: 100%;
        }
        .auth-input-group .input-group-text {
            background: var(--brand-subtle-bg);
            border-color: var(--card-border);
            color: var(--brand-primary);
        }
        .auth-input-group .form-control {
            border-color: var(--card-border);
            padding: 12px 14px;
            font-size: 0.95rem;
        }
        .auth-input-group .form-control:focus {
            border-color: var(--brand-primary);
            box-shadow: 0 0 0 3px rgba(235, 93, 30, 0.15);
        }
        .btn-toggle-password {
            border-color: var(--card-border);
            background: #fff;
            color: var(--text-muted);
        }
        .btn-toggle-password:hover {
            color: var(--brand-primary);
            background: var(--brand-subtle-bg);
        }
        .form-check-input:checked {
            background-color: var(--brand-primary);
            border-color: var(--brand-primary);
        }
        .back-home-link {
            color: var(--text-muted);
            font-size: 0.9rem;
            font-weight: 500;
            transition: color 0.2s ease;
        }
        .back-home-link:hover {
            color: var(--brand-primary);
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center py-5">

    <div class="container d-flex flex-column align-items-center">
        <!-- Back to Home Link -->
        <div class="mb-4">
            <a href="/" class="back-home-link text-decoration-none">
                <i class="bi bi-arrow-left me-1"></i> Back to Graduance Home
            </a>
        </div>

        <!-- Login Card -->
        <div class="auth-card">
            <!-- Brand Logo -->
            <div class="text-center mb-4">
                <div class="d-inline-flex align-items-center justify-content-center brand-icon-wrapper mb-2" style="width: 52px; height: 52px;">
                    <i class="bi bi-mortarboard-fill fs-3 text-brand"></i>
                </div>
                <h3 class="fw-bold mb-1 text-dark">Welcome Back</h3>
                <p class="text-muted small">Sign in to manage your thesis guidance portal</p>
            </div>

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="alert alert-danger border-0 rounded-3 mb-4" style="background-color: #fdf2f2; color: #9b1c1c; font-size: 0.9rem;">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Input -->
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold small text-dark">Email Address</label>
                    <div class="input-group auth-input-group">
                        <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ old('email') }}" placeholder="name@domain.com" required autocomplete="email" autofocus>
                    </div>
                </div>

                <!-- Password Input -->
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <label for="password" class="form-label fw-semibold small text-dark mb-0">Password</label>
                        <a href="/password/reset" class="text-brand small text-decoration-none fw-medium">Forgot Password?</a>
                    </div>
                    <div class="input-group auth-input-group">
                        <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="••••••••" required autocomplete="current-password">
                        <button class="btn btn-toggle-password px-3" type="button" id="togglePassword">
                            <i class="bi bi-eye-fill" id="togglePasswordIcon"></i>
                        </button>
                    </div>
                </div>

                <!-- Remember Me Checkbox -->
                <div class="mb-4 d-flex align-items-center justify-content-between">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="rememberMe" checked>
                        <label class="form-check-label small text-muted" for="rememberMe">
                            Remember this device
                        </label>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-hero-primary w-100 justify-content-center py-2 mb-3">
                    <span>Sign In</span>
                    <i class="bi bi-box-arrow-in-right ms-1"></i>
                </button>

                <!-- Footer Link -->
                <div class="text-center">
                    <span class="small text-muted">Don't have an account yet?</span>
                    <a class="text-brand fw-semibold small text-decoration-none ms-1" href="{{ route('register') }}">
                        Register Now
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('togglePasswordIcon');

        if (togglePassword && passwordInput && toggleIcon) {
            togglePassword.addEventListener('click', function () {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                toggleIcon.classList.toggle('bi-eye-fill');
                toggleIcon.classList.toggle('bi-eye-slash-fill');
            });
        }
    </script>
</body>

</html>
