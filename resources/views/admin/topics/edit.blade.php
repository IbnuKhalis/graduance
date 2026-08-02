@extends('admin.layouts.main')

@section('content')
    <!-- Top Header Banner -->
    <div class="card border-0 shadow-sm rounded-4 mb-4" style="background: linear-gradient(135deg, #fef8f5 0%, #ffffff 100%); border: 1px solid #f3e4dc !important;">
        <div class="card-body p-4">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill mb-2" style="background: #fdf1ec; border: 1px solid #fcebe3;">
                        <i class="bi bi-pencil-square text-brand"></i>
                        <span class="small fw-semibold text-brand">Edit Topic</span>
                    </div>
                    <h3 class="fw-bold text-dark mb-1">Edit Thesis Topic</h3>
                    <p class="text-muted mb-0 small">Update research topic details and guidance scope.</p>
                </div>
                <div>
                    <a href="/admin/topics" class="btn btn-outline-secondary rounded-pill px-4">
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
                            <i class="bi bi-journal-text text-brand fs-5"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark mb-0">Topic Details</h5>
                            <span class="small text-muted">Modify the details for topic ID #{{ $topic->id }}</span>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="/admin/topics/{{ $topic->id }}">
                        @method('put')
                        @csrf

                        <!-- Topic Name -->
                        <div class="mb-4">
                            <label for="topic" class="form-label fw-semibold text-dark">Topic Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="topic" id="topic"
                                value="{{ old('topic', $topic->topic) }}" required>
                            @error('topic')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label for="description" class="form-label fw-semibold text-dark">Topic Description <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 align-items-start pt-2.5"><i class="bi bi-card-text text-brand"></i></span>
                                <textarea name="description" id="description" rows="6" class="form-control border-start-0 ps-2" required>{{ old('description', $topic->description) }}</textarea>
                            </div>
                            @error('description')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex align-items-center justify-content-end gap-2 pt-3 border-top">
                            <a href="/admin/topics" class="btn btn-ghost-cancel">Cancel</a>
                            <button type="submit" class="btn btn-hero-primary px-4 py-2.5 rounded-pill">
                                <span>Update Thesis Topic</span>
                                <i class="bi bi-check-circle-fill ms-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar Details Card (col-lg-4) -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 p-4" style="border: 1px solid #e2e8f0 !important; background: #fafafa;">
                <h6 class="fw-bold text-dark mb-2"><i class="bi bi-info-circle-fill text-brand me-2"></i> Topic Info</h6>
                <p class="small text-muted mb-3">Updating this topic title or description will automatically reflect across student registration options.</p>
                <div class="p-3 bg-white rounded-3 border">
                    <span class="small text-muted d-block mb-1">Created At:</span>
                    <span class="fw-bold text-dark small">{{ $topic->created_at ? $topic->created_at->format('d M Y, H:i') : '-' }}</span>
                </div>
            </div>
        </div>
    </div>
@endsection
