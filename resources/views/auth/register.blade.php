<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up - Graduance</title>
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
            padding: 40px 36px;
            max-width: 720px;
            width: 100%;
        }
        .auth-input-group .input-group-text {
            background: var(--brand-subtle-bg);
            border-color: var(--card-border);
            color: var(--brand-primary);
        }
        .auth-input-group .form-control,
        .auth-input-group .form-select {
            border-color: var(--card-border);
            padding: 12px 14px;
            font-size: 0.95rem;
        }
        .auth-input-group .form-control:focus,
        .auth-input-group .form-select:focus {
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
        .back-home-link {
            color: var(--text-muted);
            font-size: 0.9rem;
            font-weight: 500;
            transition: color 0.2s ease;
        }
        .back-home-link:hover {
            color: var(--brand-primary);
        }
        .section-header-badge {
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 1px;
            color: var(--brand-primary);
            text-transform: uppercase;
            margin-bottom: 12px;
            display: block;
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

        <!-- Registration Card -->
        <div class="auth-card">
            <!-- Brand Logo -->
            <div class="text-center mb-4">
                <div class="d-inline-flex align-items-center justify-content-center brand-icon-wrapper mb-2" style="width: 52px; height: 52px;">
                    <i class="bi bi-mortarboard-fill fs-3 text-brand"></i>
                </div>
                <h3 class="fw-bold mb-1 text-dark">Create Student Account</h3>
                <p class="text-muted small">Register to connect with your advisor and track thesis guidance</p>
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

            <!-- Registration Form -->
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="row g-4">
                    <!-- Left Column: Academic Profile -->
                    <div class="col-md-6 border-end-md pe-md-4">
                        <span class="section-header-badge"><i class="bi bi-person-vcard me-1"></i> Academic Profile</span>

                        <!-- Full Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold small text-dark">Full Name</label>
                            <div class="input-group auth-input-group">
                                <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name') }}" placeholder="John Doe" required autofocus>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold small text-dark">Email Address</label>
                            <div class="input-group auth-input-group">
                                <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email') }}" placeholder="john@example.com" required>
                            </div>
                        </div>

                        <!-- Major -->
                        <div class="mb-3">
                            <label for="major" class="form-label fw-semibold small text-dark">Major / Study Program</label>
                            <div class="input-group auth-input-group">
                                <span class="input-group-text"><i class="bi bi-journal-bookmark-fill"></i></span>
                                <input type="text" class="form-control" id="major" name="major"
                                    value="{{ old('major') }}" placeholder="Informatics Engineering" required>
                            </div>
                        </div>

                        <!-- Student ID Number (NIM) -->
                        <div class="mb-3">
                            <label for="id_number" class="form-label fw-semibold small text-dark">Student ID Number (NIM)</label>
                            <div class="input-group auth-input-group">
                                <span class="input-group-text"><i class="bi bi-card-heading"></i></span>
                                <input type="number" class="form-control" id="id_number" name="id_number"
                                    value="{{ old('id_number') }}" placeholder="220101001" required>
                            </div>
                        </div>

                        <!-- Class Selection -->
                        <div class="mb-3">
                            <label for="class_id" class="form-label fw-semibold small text-dark">Assigned Class</label>
                            <div class="input-group auth-input-group">
                                <span class="input-group-text"><i class="bi bi-building"></i></span>
                                <select name="class_id" id="class_id" class="form-select" required>
                                    <option value="" disabled selected>Select your class</option>
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->id }}" {{ old('class_id') == $class->id ? 'selected' : '' }}>
                                            {{ $class->class }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Account & Security -->
                    <div class="col-md-6 ps-md-4 d-flex flex-column justify-content-between">
                        <div>
                            <span class="section-header-badge"><i class="bi bi-shield-lock me-1"></i> Security & Role</span>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label fw-semibold small text-dark">Password</label>
                                <div class="input-group auth-input-group">
                                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="••••••••" required>
                                    <button class="btn btn-toggle-password px-3" type="button" id="togglePassword">
                                        <i class="bi bi-eye-fill" id="togglePasswordIcon"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Password Confirmation -->
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label fw-semibold small text-dark">Confirm Password</label>
                                <div class="input-group auth-input-group">
                                    <span class="input-group-text"><i class="bi bi-shield-check"></i></span>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                                        placeholder="••••••••" required>
                                    <button class="btn btn-toggle-password px-3" type="button" id="toggleConfirmPassword">
                                        <i class="bi bi-eye-fill" id="toggleConfirmPasswordIcon"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Hidden Role Selection (Default: Student) -->
                            <input type="hidden" id="role_id" name="role_id" value="3">

                            <!-- Account Role Info Badge -->
                            <div class="p-3 rounded-3 mb-4" style="background-color: var(--brand-subtle-bg); border: 1px solid var(--brand-border);">
                                <div class="d-flex align-items-center gap-2 text-brand fw-semibold small mb-1">
                                    <i class="bi bi-mortarboard-fill"></i> Account Role: Student
                                </div>
                                <p class="small text-muted mb-0">You are registering as a student to submit guidance topics & Q&A.</p>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <button type="submit" class="btn btn-hero-primary w-100 justify-content-center py-2 mb-3">
                                <span>Complete Sign Up</span>
                                <i class="bi bi-arrow-right-circle ms-1"></i>
                            </button>

                            <!-- Footer Link -->
                            <div class="text-center">
                                <span class="small text-muted">Already have an account?</span>
                                <a class="text-brand fw-semibold small text-decoration-none ms-1" href="{{ route('login') }}">
                                    Log In
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        function setupPasswordToggle(buttonId, inputId, iconId) {
            const toggleBtn = document.getElementById(buttonId);
            const pwdInput = document.getElementById(inputId);
            const toggleIcon = document.getElementById(iconId);

            if (toggleBtn && pwdInput && toggleIcon) {
                toggleBtn.addEventListener('click', function () {
                    const type = pwdInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    pwdInput.setAttribute('type', type);
                    toggleIcon.classList.toggle('bi-eye-fill');
                    toggleIcon.classList.toggle('bi-eye-slash-fill');
                });
            }
        }

        setupPasswordToggle('togglePassword', 'password', 'togglePasswordIcon');
        setupPasswordToggle('toggleConfirmPassword', 'password_confirmation', 'toggleConfirmPasswordIcon');
    </script>
</body>

</html>
