@extends('admin.layouts.main')

@section('content')
    <!-- Top Header Banner -->
    <div class="card border-0 shadow-sm rounded-4 mb-4" style="background: linear-gradient(135deg, #fef8f5 0%, #ffffff 100%); border: 1px solid #f3e4dc !important;">
        <div class="card-body p-4">
            <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill mb-2" style="background: #fdf1ec; border: 1px solid #fcebe3;">
                <i class="bi bi-person-bounding-box text-brand"></i>
                <span class="small fw-semibold text-brand">Account Settings</span>
            </div>
            <h3 class="fw-bold text-dark mb-1">My Profile & Account Details</h3>
            <p class="text-muted mb-0 small">Manage your personal information, academic credentials, profile photo, and password settings.</p>
        </div>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success border-0 rounded-3 mb-4 shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        </div>
    @endif

    <!-- Profile Form Container -->
    <form method="POST" action="/admin/profile" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="row g-4">
            <!-- Left Sidebar: Profile Photo & Overview (col-lg-4) -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 text-center p-4 mb-4" style="border: 1px solid #f3e4dc !important;">
                    <div class="position-relative d-inline-block mx-auto mb-3">
                        @if ($profile->photo)
                            <img src="{{ asset('storage/' . $profile->photo) }}" alt="Profile Photo" id="preview"
                                class="rounded-circle shadow-sm border p-1 object-fit-cover" width="130" height="130">
                        @else
                            <img src="/admin/assets/images/profile/user-1.jpg" alt="Profile Photo" id="preview"
                                class="rounded-circle shadow-sm border p-1 object-fit-cover" width="130" height="130">
                        @endif
                    </div>

                    <h5 class="fw-bold text-dark mb-1">{{ $profile->name }}</h5>
                    <span class="badge text-white px-3 py-1 rounded-pill mb-3" style="background-color: var(--brand-primary); font-size: 0.75rem;">
                        <i class="bi bi-person-badge me-1"></i> {{ ucfirst($profile->role->role ?? 'User') }}
                    </span>

                    <div class="mb-2 text-start">
                        <label for="photo" class="form-label fw-semibold text-dark small">Update Profile Picture</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="bi bi-camera-fill text-brand"></i></span>
                            <input type="file" class="form-control border-start-0 ps-2" name="photo" id="photo" onchange="previewImage(event)">
                        </div>
                        <span class="form-text text-muted small"><i class="bi bi-info-circle me-1"></i> Formats: JPG, PNG (Max 2MB)</span>
                        @error('photo')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Password Info Box -->
                <div class="card border-0 shadow-sm rounded-4 p-4" style="border: 1px solid #e2e8f0 !important; background: #fafafa;">
                    <h6 class="fw-bold text-dark mb-2"><i class="bi bi-shield-lock-fill text-warning me-1"></i> Security Note</h6>
                    <p class="small text-muted mb-0">Leave the password field blank if you do not wish to update your current account password.</p>
                </div>
            </div>

            <!-- Right Form Area: Personal Details (col-lg-8) -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4" style="border: 1px solid #f3e4dc !important;">
                    <div class="card-header bg-white border-bottom p-4">
                        <div class="d-flex align-items-center gap-2">
                            <div class="p-2 rounded-3" style="background: #fdf1ec;">
                                <i class="bi bi-person-vcard-fill text-brand fs-4"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold text-dark mb-0">Personal & Academic Credentials</h5>
                                <span class="small text-muted">Update your details below</span>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <!-- Name Field -->
                        <div class="mb-4">
                            <label for="name" class="form-label fw-semibold text-dark">Full Name <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-person-fill text-brand"></i></span>
                                <input type="text" class="form-control border-start-0 ps-2" name="name" id="name"
                                    value="{{ old('name', $profile->name) }}" required>
                            </div>
                            @error('name')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email Field -->
                        <div class="mb-4">
                            <label for="email" class="form-label fw-semibold text-dark">Email Address <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-envelope-fill text-brand"></i></span>
                                <input type="email" class="form-control border-start-0 ps-2" name="email" id="email"
                                    value="{{ old('email', $profile->email) }}" required>
                            </div>
                            @error('email')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- ID Number / NIM -->
                        <div class="mb-4">
                            <label for="id_number" class="form-label fw-semibold text-dark">ID Number / NIM <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-card-text text-brand"></i></span>
                                <input type="text" class="form-control border-start-0 ps-2" name="id_number" id="id_number"
                                    value="{{ old('id_number', $profile->id_number) }}" required>
                            </div>
                            @error('id_number')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Major -->
                        <div class="mb-4">
                            <label for="major" class="form-label fw-semibold text-dark">Academic Major <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-mortarboard-fill text-brand"></i></span>
                                <input type="text" class="form-control border-start-0 ps-2" name="major" id="major"
                                    value="{{ old('major', $profile->major) }}" required>
                            </div>
                            @error('major')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password Field with Toggle -->
                        <div class="mb-4">
                            <label for="password" class="form-label fw-semibold text-dark">New Password <span class="text-muted fw-normal">(Optional)</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-lock-fill text-brand"></i></span>
                                <input type="password" class="form-control border-start-0 border-end-0 ps-2" name="password" id="password"
                                    placeholder="Enter new password to change">
                                <button class="btn btn-outline-secondary border-start-0" type="button" id="togglePassword">
                                    <i class="bi bi-eye-slash-fill" id="toggleIcon"></i>
                                </button>
                            </div>
                            <span class="form-text text-muted small"><i class="bi bi-info-circle me-1"></i> Minimum 8 characters. Leave blank to keep current password.</span>
                            @error('password')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-end pt-2">
                            <button type="submit" class="btn btn-hero-primary px-4 py-3 rounded-pill">
                                <span>Save Profile Changes</span>
                                <i class="bi bi-check-circle-fill ms-2"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @push('scripts')
        <script>
            function previewImage(event) {
                var reader = new FileReader();
                reader.onload = function() {
                    var output = document.getElementById('preview');
                    output.src = reader.result;
                }
                if(event.target.files[0]) {
                    reader.readAsDataURL(event.target.files[0]);
                }
            }

            $(document).ready(function() {
                $('#togglePassword').click(function() {
                    const passwordInput = $('#password');
                    const toggleIcon = $('#toggleIcon');
                    if (passwordInput.attr('type') === 'password') {
                        passwordInput.attr('type', 'text');
                        toggleIcon.removeClass('bi-eye-slash-fill').addClass('bi-eye-fill');
                    } else {
                        passwordInput.attr('type', 'password');
                        toggleIcon.removeClass('bi-eye-fill').addClass('bi-eye-slash-fill');
                    }
                });
            });
        </script>
    @endpush
@endsection
