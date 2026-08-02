@extends('admin.layouts.main')

@section('content')
    <!-- Top Header Banner -->
    <div class="card border-0 shadow-sm rounded-4 mb-4" style="background: linear-gradient(135deg, #fef8f5 0%, #ffffff 100%); border: 1px solid #f3e4dc !important;">
        <div class="card-body p-4 d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
            <div>
                <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill mb-2" style="background: #fdf1ec; border: 1px solid #fcebe3;">
                    <i class="bi bi-question-circle-fill text-brand"></i>
                    <span class="small fw-semibold text-brand">Thesis Guidance System</span>
                </div>
                <h3 class="fw-bold text-dark mb-1">Submit Guidance Question</h3>
                <p class="text-muted mb-0 small">Formulate your question and attach your thesis draft for your assigned advisor.</p>
            </div>
            <div>
                <a href="/admin/your-questions" class="btn btn-outline-secondary rounded-pill px-4 py-2">
                    <i class="bi bi-arrow-left me-1"></i> Back to Questions
                </a>
            </div>
        </div>
    </div>

    <!-- Main Form Container -->
    <form method="POST" action="/admin/your-questions" enctype="multipart/form-data">
        @csrf
        <div class="row g-4">
            <!-- Left Column: Question Details -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4" style="border: 1px solid #f3e4dc !important;">
                    <div class="card-header bg-white border-bottom p-4">
                        <div class="d-flex align-items-center gap-2">
                            <div class="p-2 rounded-3" style="background: #fdf1ec;">
                                <i class="bi bi-pencil-square text-brand fs-4"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold text-dark mb-0">Question Details</h5>
                                <span class="small text-muted">Fill in your question details and attach your latest thesis draft</span>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <!-- Validation Summary Errors -->
                        @if ($errors->any())
                            <div class="alert alert-danger border-0 rounded-3 mb-4" style="background-color: #fdf2f2; color: #9b1c1c; font-size: 0.9rem;">
                                <ul class="mb-0 ps-3">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Question Title -->
                        <div class="mb-4">
                            <label for="title" class="form-label fw-semibold text-dark">Question Title <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-fonts text-brand"></i></span>
                                <input type="text" class="form-control border-start-0 ps-2" name="title" id="title"
                                    value="{{ old('title') }}" placeholder="e.g., Chapter 1 Research Methodology & Scope Inquiries" required autofocus>
                            </div>
                            @error('title')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Question Description / Body -->
                        <div class="mb-4">
                            <label for="body" class="form-label fw-semibold text-dark">Question Description <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="body" id="body" rows="8"
                                placeholder="Describe your question or thesis difficulty in detail so your supervisor can provide accurate feedback..." required>{{ old('body') }}</textarea>
                            <span class="form-text text-muted small"><i class="bi bi-info-circle me-1"></i> Be specific about the pages or chapters you are inquiring about.</span>
                            @error('body')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Upload Thesis Draft File -->
                        <div class="mb-2">
                            <label for="file" class="form-label fw-semibold text-dark">Upload Thesis Draft File <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-file-earmark-arrow-up-fill text-brand"></i></span>
                                <input type="file" class="form-control border-start-0 ps-2" name="file" id="file" required>
                            </div>
                            <span class="form-text text-muted small"><i class="bi bi-paperclip me-1"></i> Allowed document formats: <strong>.pdf, .docx, .doc</strong> (Max 10MB)</span>
                            @error('file')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Advisor Info & Submission Sidebar -->
            <div class="col-lg-4">
                <!-- Advisor & Topic Card -->
                <div class="card border-0 shadow-sm rounded-4 mb-4" style="border: 1px solid #f3e4dc !important;">
                    <div class="card-header bg-white border-bottom p-4">
                        <h6 class="fw-bold text-dark mb-0"><i class="bi bi-person-badge-fill text-brand me-2"></i> Advisor & Topic Info</h6>
                    </div>

                    <div class="card-body p-4">
                        <!-- Hidden Inputs -->
                        <input type="hidden" value="{{ $registrations->teacher->id ?? '' }}" name="teacher_id">
                        <input type="hidden" value="{{ $registrations->topic->id ?? '' }}" name="topic_id">

                        <!-- Advisor Name -->
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-semibold text-uppercase mb-1">Thesis Advisor</label>
                            <div class="p-3 rounded-3 d-flex align-items-center gap-2" style="background: #fdf1ec; border: 1px solid #fcebe3;">
                                <div class="rounded-circle bg-white p-2 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                                    <i class="bi bi-person-fill text-brand fs-5"></i>
                                </div>
                                <div>
                                    <span class="fw-bold text-dark d-block small">{{ $registrations->teacher->name ?? 'Not Assigned' }}</span>
                                    <span class="text-muted small" style="font-size: 0.75rem;">Faculty Supervisor</span>
                                </div>
                            </div>
                        </div>

                        <!-- Topic Title -->
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-semibold text-uppercase mb-1">Registered Topic</label>
                            <div class="p-3 rounded-3" style="background: #ffffff; border: 1px solid #e2e8f0;">
                                <div class="d-flex align-items-start gap-2">
                                    <i class="bi bi-journal-bookmark-fill text-brand mt-1"></i>
                                    <span class="fw-bold text-dark small">{{ $registrations->topic->topic ?? 'No Topic Selected' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Guidance Tips Card -->
                <div class="card border-0 shadow-sm rounded-4 mb-4" style="border: 1px solid #e2e8f0 !important; background: #fafafa;">
                    <div class="card-body p-4">
                        <h6 class="fw-bold text-dark mb-2"><i class="bi bi-lightbulb-fill text-warning me-1"></i> Guidance Checklist</h6>
                        <ul class="list-unstyled small text-muted mb-0">
                            <li class="mb-2"><i class="bi bi-check2 text-success me-1"></i> Ensure your title summarizes your main question.</li>
                            <li class="mb-2"><i class="bi bi-check2 text-success me-1"></i> Check that your draft file opens properly before upload.</li>
                            <li><i class="bi bi-check2 text-success me-1"></i> Your advisor will be notified immediately upon submission.</li>
                        </ul>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-hero-primary w-100 justify-content-center py-3 rounded-pill">
                    <span>Submit Question</span>
                    <i class="bi bi-send-fill ms-2"></i>
                </button>
            </div>
        </div>
    </form>
@endsection
