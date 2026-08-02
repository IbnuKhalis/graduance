@extends('admin.layouts.main')

@section('content')
    <!-- Top Header Banner -->
    <div class="card border-0 shadow-sm rounded-4 mb-4" style="background: linear-gradient(135deg, #fef8f5 0%, #ffffff 100%); border: 1px solid #f3e4dc !important;">
        <div class="card-body p-4 d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
            <div>
                <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill mb-2" style="background: #fdf1ec; border: 1px solid #fcebe3;">
                    <i class="bi bi-pencil-square text-brand"></i>
                    <span class="small fw-semibold text-brand">Thesis Guidance System</span>
                </div>
                <h3 class="fw-bold text-dark mb-1">Edit Guidance Question</h3>
                <p class="text-muted mb-0 small">Update your question details or replace your attached thesis draft.</p>
            </div>
            <div>
                <a href="/admin/your-questions" class="btn btn-outline-secondary rounded-pill px-4 py-2">
                    <i class="bi bi-arrow-left me-1"></i> Back to Questions
                </a>
            </div>
        </div>
    </div>

    <!-- Main Form Container -->
    <form method="POST" action="/admin/your-questions/{{ $question->id }}" enctype="multipart/form-data">
        @method('put')
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
                                <h5 class="fw-bold text-dark mb-0">Edit Question Form</h5>
                                <span class="small text-muted">Modify question title, description, or attached draft file</span>
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
                                    value="{{ old('title', $question->title) }}" required>
                            </div>
                            @error('title')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Question Description / Body -->
                        <div class="mb-4">
                            <label for="body" class="form-label fw-semibold text-dark">Question Description <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="body" id="body" rows="8" required>{{ old('body', $question->body) }}</textarea>
                            @error('body')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Upload Thesis Draft File -->
                        <div class="mb-2">
                            <label for="file" class="form-label fw-semibold text-dark">Replace Attached Draft File</label>
                            @if ($question->file)
                                <div class="mb-2 p-2 rounded border bg-light d-flex align-items-center justify-content-between">
                                    <span class="small text-muted"><i class="bi bi-file-earmark-check-fill text-success me-1"></i> Current File Attached</span>
                                    <a href="{{ asset('storage/' . $question->file) }}" class="btn btn-sm btn-outline-secondary rounded-pill" download>
                                        <i class="bi bi-download me-1 text-brand"></i> Download Existing File
                                    </a>
                                </div>
                            @endif
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-file-earmark-arrow-up-fill text-brand"></i></span>
                                <input type="file" class="form-control border-start-0 ps-2" name="file" id="file">
                            </div>
                            <span class="form-text text-muted small"><i class="bi bi-info-circle me-1"></i> Leave blank if you don't want to replace the current file. (.pdf, .docx, .doc)</span>
                            @error('file')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Advisor Selection Sidebar -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 mb-4" style="border: 1px solid #f3e4dc !important;">
                    <div class="card-header bg-white border-bottom p-4">
                        <h6 class="fw-bold text-dark mb-0"><i class="bi bi-person-badge-fill text-brand me-2"></i> Advisor Selection</h6>
                    </div>

                    <div class="card-body p-4">
                        <div class="mb-3">
                            <label for="teacher_id" class="form-label text-muted small fw-semibold text-uppercase mb-2">Assigned Advisor <span class="text-danger">*</span></label>
                            <select id="teacher_id" class="form-select select-teacher" name="teacher_id" required>
                                <option value="" disabled>-- Select Faculty Advisor --</option>
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->id }}" {{ $teacher->id == $question->teacher_id ? 'selected' : '' }}>
                                        {{ $teacher->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('teacher_id')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-hero-primary w-100 justify-content-center py-3 rounded-pill">
                    <span>Save Changes</span>
                    <i class="bi bi-check-circle-fill ms-2"></i>
                </button>
            </div>
        </div>
    </form>
@endsection
