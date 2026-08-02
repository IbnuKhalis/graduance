@extends('admin.layouts.main')

@section('content')
    <!-- Top Header Banner -->
    <div class="card border-0 shadow-sm rounded-4 mb-4" style="background: linear-gradient(135deg, #fef8f5 0%, #ffffff 100%); border: 1px solid #f3e4dc !important;">
        <div class="card-body p-4">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill mb-2" style="background: #fdf1ec; border: 1px solid #fcebe3;">
                        <i class="bi bi-person-fill text-brand"></i>
                        <span class="small fw-semibold text-brand">Advisee Student Details</span>
                    </div>
                    <h3 class="fw-bold text-dark mb-1">{{ $student->name }}</h3>
                    <p class="text-muted mb-0 small">Review advisee credentials and submitted thesis guidance inquiries.</p>
                </div>
                <div>
                    <a href="/admin/mentored-students" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="bi bi-arrow-left me-1"></i> Back to Advisees List
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main 2-Column Grid -->
    <div class="row g-4">
        <!-- Left Sidebar: Student Profile Card (col-lg-4) -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 text-center mb-4" style="border: 1px solid #f3e4dc !important;">
                <div class="mb-3 position-relative d-inline-block">
                    <img src="{{ $student->photo ? asset('storage/' . $student->photo) : asset('/admin/assets/images/profile/user-1.jpg') }}"
                        alt="Student Photo" class="rounded-circle border p-1 object-fit-cover shadow-sm" width="110" height="110">
                </div>

                <h5 class="fw-bold text-dark mb-1">{{ $student->name }}</h5>
                <span class="text-muted small d-block mb-2">{{ $student->email }}</span>
                <span class="badge text-white px-3 py-1 rounded-pill mb-4" style="background-color: var(--brand-primary); font-size: 0.75rem;">
                    <i class="bi bi-mortarboard-fill me-1"></i> Advisee Student
                </span>

                <div class="border-top pt-3 text-start">
                    <div class="d-flex justify-content-between py-2 border-bottom small">
                        <span class="text-muted">NIM / ID Number:</span>
                        <span class="fw-bold text-dark">{{ $student->id_number ?? '-' }}</span>
                    </div>
                    <div class="d-flex justify-content-between py-2 border-bottom small">
                        <span class="text-muted">Academic Major:</span>
                        <span class="fw-bold text-dark">{{ $student->major ?? '-' }}</span>
                    </div>
                    <div class="d-flex justify-content-between py-2 border-bottom small">
                        <span class="text-muted">Class Room:</span>
                        <span class="fw-bold text-dark">{{ $student->classRoom->class ?? '-' }}</span>
                    </div>
                    <div class="d-flex justify-content-between py-2 small">
                        <span class="text-muted">Total Questions:</span>
                        <span class="fw-bold text-brand">{{ $questionsCount }} Inquiries</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Content Area: Guidance Inquiries List (col-lg-8) -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4" style="border: 1px solid #f3e4dc !important;">
                <div class="card-header bg-white border-bottom p-4 d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2">
                        <div class="p-2 rounded-3" style="background: #fdf1ec;">
                            <i class="bi bi-journal-text text-brand fs-5"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark mb-0">Submitted Guidance Inquiries</h5>
                            <span class="small text-muted">History of guidance questions submitted by {{ $student->name }}</span>
                        </div>
                    </div>
                    <span class="badge bg-light text-dark border px-3 py-2 rounded-pill fw-semibold">
                        {{ $questionsCount }} Items
                    </span>
                </div>

                <div class="card-body p-4">
                    @forelse ($questions as $question)
                        <div class="card border-0 shadow-sm rounded-4 mb-3" style="border: 1px solid #e2e8f0 !important; background: #ffffff;">
                            <div class="card-body p-4">
                                <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-2 mb-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="p-2 rounded-3" style="background: #fdf1ec;">
                                            <i class="bi bi-question-circle-fill text-brand"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold text-dark mb-0">{{ $question->title }}</h6>
                                            <span class="small text-muted"><i class="bi bi-clock me-1"></i> Submitted {{ $question->created_at->format('d M Y, H:i') }}</span>
                                        </div>
                                    </div>
                                    <div>
                                        @if ($question->status == 'approved')
                                            <span class="badge text-white px-3 py-1.5 rounded-pill" style="background-color: #22c55e; font-size: 0.75rem;">
                                                <i class="bi bi-check-circle-fill me-1"></i> Approved
                                            </span>
                                        @else
                                            <span class="badge text-white px-3 py-1.5 rounded-pill" style="background-color: #eb5d1e; font-size: 0.75rem;">
                                                <i class="bi bi-hourglass-split me-1"></i> {{ ucfirst($question->status) }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="text-secondary small mb-3 p-3 rounded-3 bg-light" style="line-height: 1.6;">
                                    {!! Str::limit(strip_tags($question->body), 200) !!}
                                </div>

                                <div class="d-flex align-items-center justify-content-between pt-2 border-top">
                                    <span class="small text-muted">
                                        <i class="bi bi-chat-dots me-1"></i> {{ $question->answers->count() }} Messages Exchanged
                                    </span>
                                    <a href="/admin/questions-to-answer/{{ $question->id }}" class="btn btn-sm btn-hero-primary rounded-pill px-3">
                                        <i class="bi bi-chat-right-text-fill me-1"></i> Review Thread
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-5 text-muted">
                            <i class="bi bi-journal-x fs-1 d-block mb-3 text-muted"></i>
                            <h6 class="fw-bold text-dark mb-1">No Inquiries Submitted</h6>
                            <p class="small text-muted mb-0">This advisee student has not submitted any thesis questions yet.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
