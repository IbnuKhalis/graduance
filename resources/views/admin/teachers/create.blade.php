@extends('admin.layouts.main')

@section('content')
    <!-- Top Header Banner -->
    <div class="card border-0 shadow-sm rounded-4 mb-4" style="background: linear-gradient(135deg, #fef8f5 0%, #ffffff 100%); border: 1px solid #f3e4dc !important;">
        <div class="card-body p-4">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill mb-2" style="background: #fdf1ec; border: 1px solid #fcebe3;">
                        <i class="bi bi-person-plus-fill text-brand"></i>
                        <span class="small fw-semibold text-brand">Create Advisor</span>
                    </div>
                    <h3 class="fw-bold text-dark mb-1">Add New Faculty Advisor</h3>
                    <p class="text-muted mb-0 small">Create a new faculty advisor account for thesis supervision.</p>
                </div>
                <div>
                    <a href="/admin/teachers" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="bi bi-arrow-left me-1"></i> Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Grid -->
    <div class="row g-4">
        <!-- Main Form Area (col-lg-8) -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4" style="border: 1px solid #f3e4dc !important;">
                <div class="card-header bg-white border-bottom p-4">
                    <div class="d-flex align-items-center gap-2">
                        <div class="p-2 rounded-3" style="background: #fdf1ec;">
                            <i class="bi bi-person-badge-fill text-brand fs-5"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark mb-0">Faculty Advisor Account Details</h5>
                            <span class="small text-muted">Enter personal & academic credentials for the new advisor</span>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger border-0 rounded-3 mb-4 shadow-sm" role="alert">
                            <div class="fw-bold mb-1"><i class="bi bi-exclamation-triangle-fill me-2"></i> Failed to create advisor account!</div>
                            <ul class="mb-0 ps-3 small">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="/admin/teachers">
                        @csrf
                        <input type="hidden" value="2" name="role_id">

                        <!-- Name -->
                        <div class="mb-4">
                            <label for="name" class="form-label fw-semibold text-dark">Full Name & Title <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-person-fill text-brand"></i></span>
                                <input type="text" class="form-control border-start-0 ps-2" name="name" id="name"
                                    value="{{ old('name') }}" placeholder="e.g. Dr. John Doe, M.Kom" required>
                            </div>
                            @error('name')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="form-label fw-semibold text-dark">Email Address <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-envelope-fill text-brand"></i></span>
                                <input type="email" class="form-control border-start-0 ps-2" name="email" id="email"
                                    value="{{ old('email') }}" placeholder="advisor@university.ac.id" required>
                            </div>
                            @error('email')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- NIP / ID Number -->
                        <div class="mb-4">
                            <label for="id_number" class="form-label fw-semibold text-dark">NIP / Advisor ID Number <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-card-text text-brand"></i></span>
                                <input type="text" class="form-control border-start-0 ps-2" name="id_number" id="id_number"
                                    value="{{ old('id_number') }}" placeholder="e.g. 198503152010121003" required>
                            </div>
                            @error('id_number')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Major -->
                        <div class="mb-4">
                            <label for="major" class="form-label fw-semibold text-dark">Academic Major / Department <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-journal-bookmark-fill text-brand"></i></span>
                                <input type="text" class="form-control border-start-0 ps-2" name="major" id="major"
                                    value="{{ old('major') }}" placeholder="e.g. Computer Science / Software Engineering" required>
                            </div>
                            @error('major')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <label for="password" class="form-label fw-semibold text-dark">Account Password <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-lock-fill text-brand"></i></span>
                                <input type="password" class="form-control border-start-0 border-end-0 ps-2" name="password" id="password" required>
                                <button class="btn btn-light border border-start-0" type="button" id="togglePassword">
                                    <i class="bi bi-eye-slash-fill text-muted" id="toggleIcon"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex align-items-center justify-content-end gap-2 pt-3 border-top">
                            <a href="/admin/teachers" class="btn btn-ghost-cancel">Cancel</a>
                            <button type="submit" class="btn btn-hero-primary px-4 py-2.5 rounded-pill">
                                <span>Save Advisor Account</span>
                                <i class="bi bi-check-circle-fill ms-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar Guidelines (col-lg-4) -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 p-4" style="border: 1px solid #e2e8f0 !important; background: #fafafa;">
                <h6 class="fw-bold text-dark mb-3"><i class="bi bi-lightbulb-fill text-warning me-2"></i> Advisor Account Note</h6>
                <p class="small text-muted mb-3">Adding a faculty advisor account enables them to log into the advisor workspace, review assigned student thesis questions, and approve guidance reports.</p>
                <div class="p-3 bg-white rounded-3 border mb-3">
                    <span class="small text-muted d-block mb-1">Assigned Role:</span>
                    <span class="badge text-white rounded-pill px-3 py-1" style="background-color: var(--brand-primary);">Faculty Advisor</span>
                </div>
                <div class="alert alert-warning border-0 small mb-0 rounded-3" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-1"></i> Ensure NIP and email address are correct before saving.
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.getElementById('togglePassword')?.addEventListener('click', function() {
                const passwordInput = document.getElementById('password');
                const toggleIcon = document.getElementById('toggleIcon');
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    toggleIcon.classList.replace('bi-eye-slash-fill', 'bi-eye-fill');
                } else {
                    passwordInput.type = 'password';
                    toggleIcon.classList.replace('bi-eye-fill', 'bi-eye-slash-fill');
                }
            });
        </script>
    @endpush
@endsection
