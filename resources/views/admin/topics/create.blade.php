@extends('admin.layouts.main')

@section('content')
    <!-- Top Header Banner -->
    <div class="card border-0 shadow-sm rounded-4 mb-4" style="background: linear-gradient(135deg, #fef8f5 0%, #ffffff 100%); border: 1px solid #f3e4dc !important;">
        <div class="card-body p-4">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill mb-2" style="background: #fdf1ec; border: 1px solid #fcebe3;">
                        <i class="bi bi-plus-circle-fill text-brand"></i>
                        <span class="small fw-semibold text-brand">Create Topic</span>
                    </div>
                    <h3 class="fw-bold text-dark mb-1">Add New Thesis Topic</h3>
                    <p class="text-muted mb-0 small">Define a new research area and description for student guidance selection.</p>
                </div>
                <div>
                    <a href="/admin/topics" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="bi bi-arrow-left me-1"></i> Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Form & Guidelines Grid -->
    <div class="row g-4">
        <!-- Main Form Area (col-lg-8) -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4" style="border: 1px solid #f3e4dc !important;">
                <div class="card-header bg-white border-bottom p-4">
                    <div class="d-flex align-items-center gap-2">
                        <div class="p-2 rounded-3" style="background: #fdf1ec;">
                            <i class="bi bi-journal-plus text-brand fs-5"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark mb-0">Topic Specifications</h5>
                            <span class="small text-muted">Enter the details for this thesis topic</span>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="/admin/topics">
                        @csrf

                        <!-- Topic Name -->
                        <div class="mb-4">
                            <label for="topic" class="form-label fw-semibold text-dark">Topic Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="topic" id="topic"
                                value="{{ old('topic') }}" placeholder="e.g. Artificial Intelligence & Machine Learning in Healthcare" required>
                            @error('topic')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label for="description" class="form-label fw-semibold text-dark">Topic Description <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 align-items-start pt-2.5"><i class="bi bi-card-text text-brand"></i></span>
                                <textarea name="description" id="description" rows="6" class="form-control border-start-0 ps-2"
                                    placeholder="Provide a comprehensive summary of research focus, scope, and expected methodologies..." required>{{ old('description') }}</textarea>
                            </div>
                            <span class="form-text text-muted small"><i class="bi bi-info-circle me-1"></i> Give students clear expectations regarding this topic's scope.</span>
                            @error('description')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex align-items-center justify-content-end gap-2 pt-3 border-top">
                            <a href="/admin/topics" class="btn btn-ghost-cancel">Cancel</a>
                            <button type="submit" class="btn btn-hero-primary px-4 py-2.5 rounded-pill">
                                <span>Save Thesis Topic</span>
                                <i class="bi bi-check-circle-fill ms-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Guidelines Sidebar (col-lg-4) -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4" style="border: 1px solid #e2e8f0 !important; background: #fafafa;">
                <h6 class="fw-bold text-dark mb-3"><i class="bi bi-lightbulb-fill text-warning me-2"></i> Topic Creation Tips</h6>
                <ul class="list-unstyled mb-0 small text-secondary">
                    <li class="mb-2.5 d-flex gap-2">
                        <i class="bi bi-check2 text-brand fw-bold"></i>
                        <span><strong>Clear Title:</strong> Keep the topic title concise yet descriptive of the research field.</span>
                    </li>
                    <li class="mb-2.5 d-flex gap-2">
                        <i class="bi bi-check2 text-brand fw-bold"></i>
                        <span><strong>Scope Definition:</strong> Outline key sub-fields, tools, or methodologies students can explore.</span>
                    </li>
                    <li class="d-flex gap-2">
                        <i class="bi bi-check2 text-brand fw-bold"></i>
                        <span><strong>Availability:</strong> Once published, students can select this topic during registration.</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
