@extends('admin.layouts.main')

@section('content')
    <!-- Top Header Banner -->
    <div class="card border-0 shadow-sm rounded-4 mb-4" style="background: linear-gradient(135deg, #fef8f5 0%, #ffffff 100%); border: 1px solid #f3e4dc !important;">
        <div class="card-body p-4">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill mb-2" style="background: #fdf1ec; border: 1px solid #fcebe3;">
                        <i class="bi bi-bell-fill text-brand"></i>
                        <span class="small fw-semibold text-brand">Advisor Reminder</span>
                    </div>
                    <h3 class="fw-bold text-dark mb-1">Send Guidance Reminder</h3>
                    <p class="text-muted mb-0 small">Notify faculty advisor {{ $question->teacher->name }} to review and respond to the student inquiry.</p>
                </div>
                <div>
                    <a href="/admin/questions" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="bi bi-arrow-left me-1"></i> Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Grid -->
    <div class="row g-4">
        <!-- Main Form Area (col-lg-8) -->
        <div class="col-lg-8">
            <!-- Question Summary Box -->
            <div class="card border-0 shadow-sm rounded-4 mb-4" style="border: 1px solid #e2e8f0 !important; background: #fafafa;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="badge text-white rounded-pill px-3 py-1" style="background-color: var(--brand-primary); font-size: 0.75rem;">
                            <i class="bi bi-journal-text me-1"></i> Referenced Student Inquiry
                        </span>
                        <span class="small text-muted"><i class="bi bi-clock me-1"></i> {{ $question->created_at->diffForHumans() }}</span>
                    </div>
                    <h5 class="fw-bold text-dark mb-2">{{ $question->title }}</h5>
                    <div class="d-flex align-items-center gap-3">
                        <div class="d-flex align-items-center gap-2">
                            <img src="{{ $question->user->photo ? asset('storage/' . $question->user->photo) : asset('/admin/assets/images/profile/user-1.jpg') }}"
                                alt="Student Avatar" class="rounded-circle border p-0.5 object-fit-cover" width="28" height="28">
                            <span class="small text-dark fw-semibold">{{ $question->user->name }}</span>
                        </div>
                        <span class="text-muted small">•</span>
                        <span class="small text-muted">Topic: {{ $question->topic->title ?? '-' }}</span>
                    </div>
                </div>
            </div>

            <!-- Reminder Form Card -->
            <div class="card border-0 shadow-sm rounded-4" style="border: 1px solid #f3e4dc !important;">
                <div class="card-header bg-white border-bottom p-4">
                    <div class="d-flex align-items-center gap-2">
                        <div class="p-2 rounded-3" style="background: #fdf1ec;">
                            <i class="bi bi-send-fill text-brand fs-5"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark mb-0">Reminder Notification Form</h5>
                            <span class="small text-muted">Compose a message to remind the advisor about this guidance request</span>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger border-0 rounded-3 mb-4 shadow-sm" role="alert">
                            <div class="fw-bold mb-1"><i class="bi bi-exclamation-triangle-fill me-2"></i> Failed to send reminder message!</div>
                            <ul class="mb-0 ps-3 small">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="/admin/questions">
                        @csrf
                        <input type="hidden" value="{{ $question->teacher_id }}" name="teacher_id">

                        <div class="mb-4">
                            <label for="reminder" class="form-label fw-semibold text-dark">Reminder Message <span class="text-danger">*</span></label>
                            <textarea class="form-control p-3 border" name="reminder" id="reminder" rows="6"
                                placeholder="Write a polite reminder message to the faculty advisor regarding this student's inquiry..." required>{{ old('reminder') }}</textarea>
                            @error('reminder')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex align-items-center justify-content-end gap-2 pt-3 border-top">
                            <a href="/admin/questions" class="btn btn-ghost-cancel">Cancel</a>
                            <button type="submit" class="btn btn-hero-primary px-4 py-2.5 rounded-pill">
                                <span>Send Reminder Message</span>
                                <i class="bi bi-send-fill ms-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar Advisor Profile (col-lg-4) -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 text-center" style="border: 1px solid #f3e4dc !important;">
                <h6 class="fw-bold text-dark mb-3"><i class="bi bi-person-workspace text-brand me-2"></i> Recipient Advisor</h6>
                <div class="mb-3 position-relative d-inline-block">
                    <img src="{{ $question->teacher->photo ? asset('storage/' . $question->teacher->photo) : asset('/admin/assets/images/profile/user-1.jpg') }}"
                        alt="Advisor Photo" class="rounded-circle border p-1 object-fit-cover shadow-sm" width="100" height="100">
                </div>
                <h6 class="fw-bold text-dark mb-1">{{ $question->teacher->name }}</h6>
                <span class="text-muted small d-block mb-3">{{ $question->teacher->email }}</span>

                <div class="p-3 bg-light rounded-3 text-start border mb-3">
                    <div class="d-flex justify-content-between mb-1 small">
                        <span class="text-muted">NIP / ID:</span>
                        <span class="fw-bold text-dark">{{ $question->teacher->id_number ?? '-' }}</span>
                    </div>
                    <div class="d-flex justify-content-between small">
                        <span class="text-muted">Department:</span>
                        <span class="fw-bold text-dark">{{ $question->teacher->major ?? '-' }}</span>
                    </div>
                </div>

                <div class="alert alert-warning border-0 small mb-0 text-start rounded-3" role="alert">
                    <i class="bi bi-info-circle-fill me-1"></i> This notification will appear in the advisor's dashboard workspace.
                </div>
            </div>
        </div>
    </div>
@endsection
