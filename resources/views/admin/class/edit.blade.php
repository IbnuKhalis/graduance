@extends('admin.layouts.main')

@section('content')
    <!-- Top Header Banner -->
    <div class="card border-0 shadow-sm rounded-4 mb-4" style="background: linear-gradient(135deg, #fef8f5 0%, #ffffff 100%); border: 1px solid #f3e4dc !important;">
        <div class="card-body p-4">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill mb-2" style="background: #fdf1ec; border: 1px solid #fcebe3;">
                        <i class="bi bi-pencil-square text-brand"></i>
                        <span class="small fw-semibold text-brand">Edit Class</span>
                    </div>
                    <h3 class="fw-bold text-dark mb-1">Edit Academic Class</h3>
                    <p class="text-muted mb-0 small">Update class room designation and cohort information.</p>
                </div>
                <div>
                    <a href="/admin/class" class="btn btn-outline-secondary rounded-pill px-4">
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
                            <i class="bi bi-door-open-fill text-brand fs-5"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark mb-0">Class Room Form</h5>
                            <span class="small text-muted">Update information for class "{{ $class->class }}"</span>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger border-0 rounded-3 mb-4 shadow-sm" role="alert">
                            <div class="fw-bold mb-1"><i class="bi bi-exclamation-triangle-fill me-2"></i> Failed to update class room!</div>
                            <ul class="mb-0 ps-3 small">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="/admin/class/{{ $class->id }}">
                        @method('put')
                        @csrf

                        <!-- Class Name -->
                        <div class="mb-4">
                            <label for="class" class="form-label fw-semibold text-dark">Class Name / Cohort Code <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-building text-brand"></i></span>
                                <input type="text" class="form-control border-start-0 ps-2" name="class" id="class"
                                    value="{{ old('class', $class->class) }}" required>
                            </div>
                            @error('class')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex align-items-center justify-content-end gap-2 pt-3 border-top">
                            <a href="/admin/class" class="btn btn-ghost-cancel">Cancel</a>
                            <button type="submit" class="btn btn-hero-primary px-4 py-2.5 rounded-pill">
                                <span>Update Class Room</span>
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
                <h6 class="fw-bold text-dark mb-3"><i class="bi bi-info-circle-fill text-brand me-2"></i> Class Modification Note</h6>
                <p class="small text-muted mb-3">Renaming this class room will automatically update the cohort name for all students currently enrolled in this class.</p>
                <div class="p-3 bg-white rounded-3 border">
                    <span class="small text-muted d-block mb-1">Current Class Name:</span>
                    <span class="fw-bold text-dark fs-6">{{ $class->class }}</span>
                </div>
            </div>
        </div>
    </div>
@endsection
