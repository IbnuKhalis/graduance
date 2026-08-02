@extends('admin.layouts.main')

@section('content')
    <!-- Top Header Banner -->
    <div class="card border-0 shadow-sm rounded-4 mb-4" style="background: linear-gradient(135deg, #fef8f5 0%, #ffffff 100%); border: 1px solid #f3e4dc !important;">
        <div class="card-body p-4">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill mb-2" style="background: #fdf1ec; border: 1px solid #fcebe3;">
                        <i class="bi bi-pencil-square text-brand"></i>
                        <span class="small fw-semibold text-brand">Edit Advisor</span>
                    </div>
                    <h3 class="fw-bold text-dark mb-1">Edit Faculty Advisor Credentials</h3>
                    <p class="text-muted mb-0 small">Update advisor profile information, academic major assignment, and security settings.</p>
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
                            <i class="bi bi-person-gear text-brand fs-5"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark mb-0">Advisor Account Form</h5>
                            <span class="small text-muted">Update information for {{ $teacher->name }}</span>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger border-0 rounded-3 mb-4 shadow-sm" role="alert">
                            <div class="fw-bold mb-1"><i class="bi bi-exclamation-triangle-fill me-2"></i> Failed to update advisor account!</div>
                            <ul class="mb-0 ps-3 small">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="/admin/teachers/{{ $teacher->id }}">
                        @method('put')
                        @csrf

                        <!-- Full Name -->
                        <div class="mb-4">
                            <label for="name" class="form-label fw-semibold text-dark">Full Name & Title <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-person-fill text-brand"></i></span>
                                <input type="text" class="form-control border-start-0 ps-2" name="name" id="name"
                                    value="{{ old('name', $teacher->name) }}" required>
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
                                    value="{{ old('email', $teacher->email) }}" required>
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
                                    value="{{ old('id_number', $teacher->id_number) }}" required>
                            </div>
                            @error('id_number')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Academic Major -->
                        <div class="mb-4">
                            <label for="major" class="form-label fw-semibold text-dark">Academic Major / Department <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-journal-bookmark-fill text-brand"></i></span>
                                <input type="text" class="form-control border-start-0 ps-2" name="major" id="major"
                                    value="{{ old('major', $teacher->major) }}" required>
                            </div>
                            @error('major')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- New Password Optional -->
                        <div class="mb-4">
                            <label for="password" class="form-label fw-semibold text-dark">New Password <span class="text-muted fw-normal">(Optional)</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-lock-fill text-brand"></i></span>
                                <input type="password" class="form-control border-start-0 border-end-0 ps-2" name="password" id="password"
                                    placeholder="Leave blank to keep current password">
                                <button class="btn btn-light border border-start-0" type="button" id="togglePassword">
                                    <i class="bi bi-eye-slash-fill text-muted" id="toggleIcon"></i>
                                </button>
                            </div>
                            <span class="form-text text-muted small"><i class="bi bi-info-circle me-1"></i> Only fill this field if you wish to reset the advisor's password.</span>
                            @error('password')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex align-items-center justify-content-end gap-2 pt-3 border-top">
                            <a href="/admin/teachers" class="btn btn-ghost-cancel">Cancel</a>
                            <button type="submit" class="btn btn-hero-primary px-4 py-2.5 rounded-pill">
                                <span>Update Advisor Account</span>
                                <i class="bi bi-check-circle-fill ms-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar Profile Preview (col-lg-4) -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 text-center" style="border: 1px solid #f3e4dc !important;">
                <h6 class="fw-bold text-dark mb-3"><i class="bi bi-person-bounding-box text-brand me-2"></i> Avatar Preview</h6>
                <div class="mb-3 position-relative d-inline-block">
                    <img src="{{ $teacher->photo ? asset('storage/' . $teacher->photo) : asset('/admin/assets/images/profile/user-1.jpg') }}"
                        alt="Teacher Photo" class="rounded-circle border p-1 object-fit-cover shadow-sm" width="120" height="120">
                </div>
                <h6 class="fw-bold text-dark mb-1">{{ $teacher->name }}</h6>
                <span class="text-muted small d-block mb-3">{{ $teacher->email }}</span>
                <div class="p-3 bg-light rounded-3 text-start border">
                    <div class="d-flex justify-content-between mb-1 small">
                        <span class="text-muted">Account Status:</span>
                        <span class="badge bg-success text-white rounded-pill">Active</span>
                    </div>
                    <div class="d-flex justify-content-between small">
                        <span class="text-muted">Role:</span>
                        <span class="fw-semibold text-dark">Faculty Advisor</span>
                    </div>
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
