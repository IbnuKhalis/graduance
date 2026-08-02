@extends('admin.layouts.main')

@section('content')
    <!-- Top Header Banner -->
    <div class="card border-0 shadow-sm rounded-4 mb-4" style="background: linear-gradient(135deg, #fef8f5 0%, #ffffff 100%); border: 1px solid #f3e4dc !important;">
        <div class="card-body p-4">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill mb-2" style="background: #fdf1ec; border: 1px solid #fcebe3;">
                        <i class="bi bi-person-workspace text-brand"></i>
                        <span class="small fw-semibold text-brand">Advisor Overview</span>
                    </div>
                    <h3 class="fw-bold text-dark mb-1">{{ $teacher->name }}</h3>
                    <p class="text-muted mb-0 small">View complete faculty advisor profile, NIP credentials, and department assignment.</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="/admin/teachers/{{ $teacher->id }}/edit" class="btn btn-hero-primary rounded-pill px-4">
                        <i class="bi bi-pencil-fill me-1"></i> Edit Profile
                    </a>
                    <a href="/admin/teachers" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="bi bi-arrow-left me-1"></i> Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main 2-Column Grid -->
    <div class="row g-4">
        <!-- Left Sidebar: Avatar & Status Card (col-lg-4) -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 text-center mb-4" style="border: 1px solid #f3e4dc !important;">
                <div class="mb-3 position-relative d-inline-block">
                    <img src="{{ $teacher->photo ? asset('storage/' . $teacher->photo) : asset('/admin/assets/images/profile/user-1.jpg') }}"
                        alt="Teacher Avatar" class="rounded-circle border p-1 object-fit-cover shadow-sm" width="120" height="120">
                </div>

                <h5 class="fw-bold text-dark mb-1">{{ $teacher->name }}</h5>
                <span class="text-muted small d-block mb-3">{{ $teacher->email }}</span>

                <div class="d-flex justify-content-center gap-2 mb-3">
                    <span class="badge text-white px-3 py-1.5 rounded-pill" style="background-color: var(--brand-primary); font-size: 0.75rem;">
                        <i class="bi bi-person-workspace me-1"></i> Faculty Advisor
                    </span>
                    <span class="badge bg-success text-white px-3 py-1.5 rounded-pill" style="font-size: 0.75rem;">
                        <i class="bi bi-check-circle-fill me-1"></i> Active
                    </span>
                </div>
            </div>
        </div>

        <!-- Right Content Area: Detailed Credentials Card (col-lg-8) -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4" style="border: 1px solid #f3e4dc !important;">
                <div class="card-header bg-white border-bottom p-4 d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2">
                        <div class="p-2 rounded-3" style="background: #fdf1ec;">
                            <i class="bi bi-person-vcard-fill text-brand fs-5"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark mb-0">Academic Profile & Credentials</h5>
                            <span class="small text-muted">Complete information for faculty advisor #{{ $teacher->id }}</span>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="p-3 rounded-3 border bg-light">
                                <span class="text-muted small d-block mb-1"><i class="bi bi-person me-1 text-brand"></i> Full Name & Title</span>
                                <span class="fw-bold text-dark">{{ $teacher->name }}</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="p-3 rounded-3 border bg-light">
                                <span class="text-muted small d-block mb-1"><i class="bi bi-envelope me-1 text-brand"></i> Email Address</span>
                                <span class="fw-bold text-dark">{{ $teacher->email }}</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="p-3 rounded-3 border bg-light">
                                <span class="text-muted small d-block mb-1"><i class="bi bi-card-text me-1 text-brand"></i> NIP / Advisor ID Number</span>
                                <span class="fw-bold text-dark">{{ $teacher->id_number ?? '-' }}</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="p-3 rounded-3 border bg-light">
                                <span class="text-muted small d-block mb-1"><i class="bi bi-journal-bookmark me-1 text-brand"></i> Academic Major / Department</span>
                                <span class="fw-bold text-dark">{{ $teacher->major ?? '-' }}</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="p-3 rounded-3 border bg-light">
                                <span class="text-muted small d-block mb-1"><i class="bi bi-shield-check me-1 text-brand"></i> System Role</span>
                                <span class="fw-bold text-dark">Faculty Advisor / Supervisor</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="p-3 rounded-3 border bg-light">
                                <span class="text-muted small d-block mb-1"><i class="bi bi-calendar-event me-1 text-brand"></i> Account Registration Date</span>
                                <span class="fw-bold text-dark">{{ $teacher->created_at ? $teacher->created_at->format('d M Y, H:i') : '-' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
