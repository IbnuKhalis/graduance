@extends('admin.layouts.main')

@section('content')
    <!-- Top Header Banner -->
    <div class="card border-0 shadow-sm rounded-4 mb-4" style="background: linear-gradient(135deg, #fef8f5 0%, #ffffff 100%); border: 1px solid #f3e4dc !important;">
        <div class="card-body p-4">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill mb-2" style="background: #fdf1ec; border: 1px solid #fcebe3;">
                        <i class="bi bi-archive-fill text-brand"></i>
                        <span class="small fw-semibold text-brand">Archived Report Details</span>
                    </div>
                    <h3 class="fw-bold text-dark mb-1">Thesis Guidance Archive #{{ $question->id }}</h3>
                    <p class="text-muted mb-0 small">Review complete guidance inquiry, attached thesis draft, and advisor responses.</p>
                </div>
                <div>
                    <a href="/admin/archive" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="bi bi-arrow-left me-1"></i> Back to Archives
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Left Main Area: Question & Discussion Thread (col-lg-8) -->
        <div class="col-lg-8">
            <!-- Main Question Card -->
            <div class="card border-0 shadow-sm rounded-4 mb-4" style="border: 1px solid #f3e4dc !important;">
                <div class="card-header bg-white border-bottom p-4 d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2">
                        <div class="p-2 rounded-3" style="background: #fdf1ec;">
                            <i class="bi bi-journal-check text-brand fs-5"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark mb-0">{{ $question->title }}</h5>
                            <span class="small text-muted"><i class="bi bi-clock me-1"></i> Submitted {{ $question->created_at->format('d M Y, H:i') }}</span>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    <div class="mb-4">
                        <h6 class="fw-bold text-dark mb-2">Guidance Inquiry Details</h6>
                        <div class="p-3 rounded-3 bg-light text-secondary" style="line-height: 1.6;">
                            {!! $question->body !!}
                        </div>
                    </div>

                    <!-- Thesis File Attachment -->
                    <div class="p-3 rounded-3 border d-flex align-items-center justify-content-between" style="background: #fafafa;">
                        <div class="d-flex align-items-center gap-3">
                            <div class="p-2.5 rounded-3 bg-white border text-brand">
                                <i class="bi bi-file-earmark-pdf-fill fs-4"></i>
                            </div>
                            <div>
                                <span class="fw-bold text-dark d-block small">Thesis Draft Attachment</span>
                                <span class="text-muted small">File submitted for guidance review</span>
                            </div>
                        </div>
                        <div>
                            @if ($question->file)
                                <a href="{{ asset('storage/' . $question->file) }}" download="Draft_Thesis_{{ \Illuminate\Support\Str::slug($question->title) }}.{{ pathinfo($question->file, PATHINFO_EXTENSION) }}" target="_blank" class="btn btn-hero-primary btn-sm rounded-pill px-3">
                                    <i class="bi bi-download me-1"></i> Download Draft
                                </a>
                            @else
                                <span class="badge bg-light text-muted border">No File Attached</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Discussion Thread Header -->
            <div class="d-flex align-items-center justify-content-between mb-3 px-1">
                <h5 class="fw-bold text-dark mb-0">
                    <i class="bi bi-chat-left-text-fill text-brand me-2"></i> Guidance Discussion History ({{ $question->answers->count() }})
                </h5>
            </div>

            <!-- Discussion Cards Feed -->
            @forelse ($question->answers as $answer)
                @if ($answer->user->role->role === 'teacher')
                    <!-- Advisor Response Card (Coral Subtle BG) -->
                    <div class="card border-0 shadow-sm rounded-4 mb-3" style="background: #fdf1ec; border: 1px solid #fcebe3 !important;">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="d-flex align-items-center gap-3">
                                    <img src="{{ $answer->user->photo ? asset('storage/' . $answer->user->photo) : asset('/admin/assets/images/profile/user-1.jpg') }}"
                                        alt="Advisor Photo" class="rounded-circle border p-1 object-fit-cover" width="44" height="44">
                                    <div>
                                        <div class="d-flex align-items-center gap-2">
                                            <h6 class="fw-bold text-dark mb-0">{{ $answer->user->name }}</h6>
                                            <span class="badge text-white px-2 py-0.5 rounded-pill" style="background-color: var(--brand-primary); font-size: 0.68rem;">Faculty Advisor</span>
                                        </div>
                                        <span class="text-muted small">{{ $answer->user->email }}</span>
                                    </div>
                                </div>
                                <span class="small text-muted"><i class="bi bi-clock me-1"></i> {{ $answer->created_at->diffForHumans() }}</span>
                            </div>

                            <p class="text-dark mb-3" style="line-height: 1.6;">{{ $answer->body }}</p>

                            @if ($answer->file)
                                <div class="pt-2 border-top border-warning-subtle">
                                    <a href="{{ asset('storage/' . $answer->file) }}" download="Advisor_Attachment_{{ $answer->id }}.{{ pathinfo($answer->file, PATHINFO_EXTENSION) }}" target="_blank" class="btn btn-sm btn-white border rounded-pill text-brand bg-white px-3">
                                        <i class="bi bi-file-earmark-arrow-down-fill me-1"></i> Download Advisor Attachment
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                @else
                    <!-- Student Response Card (White BG) -->
                    <div class="card border-0 shadow-sm rounded-4 mb-3" style="border: 1px solid #e2e8f0 !important; background: #ffffff;">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="d-flex align-items-center gap-3">
                                    <img src="{{ $answer->user->photo ? asset('storage/' . $answer->user->photo) : asset('/admin/assets/images/profile/user-1.jpg') }}"
                                        alt="Student Photo" class="rounded-circle border p-1 object-fit-cover" width="44" height="44">
                                    <div>
                                        <div class="d-flex align-items-center gap-2">
                                            <h6 class="fw-bold text-dark mb-0">{{ $answer->user->name }}</h6>
                                            <span class="badge bg-light text-dark border px-2 py-0.5 rounded-pill" style="font-size: 0.68rem;">Student</span>
                                        </div>
                                        <span class="text-muted small">{{ $answer->user->email }}</span>
                                    </div>
                                </div>
                                <span class="small text-muted"><i class="bi bi-clock me-1"></i> {{ $answer->created_at->diffForHumans() }}</span>
                            </div>

                            <p class="text-dark mb-3" style="line-height: 1.6;">{{ $answer->body }}</p>

                            @if ($answer->file)
                                <div class="pt-2 border-top">
                                    <a href="{{ asset('storage/' . $answer->file) }}" download="Student_Attachment_{{ $answer->id }}.{{ pathinfo($answer->file, PATHINFO_EXTENSION) }}" target="_blank" class="btn btn-sm btn-light border rounded-pill px-3">
                                        <i class="bi bi-file-earmark-arrow-down-fill me-1"></i> Download Attachment
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            @empty
                <div class="card border-0 shadow-sm rounded-4 p-5 text-center text-muted" style="border: 1px solid #e2e8f0 !important;">
                    <i class="bi bi-chat-left-dots fs-1 d-block mb-2 text-muted"></i>
                    <h6 class="fw-bold text-dark mb-1">No Discussion Responses</h6>
                    <p class="small text-muted mb-0">No comments or responses recorded for this archived item.</p>
                </div>
            @endforelse
        </div>

        <!-- Right Sidebar Area: Metadata Cards (col-lg-4) -->
        <div class="col-lg-4">
            <!-- Approval Status Card -->
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4" style="border: 1px solid #f3e4dc !important;">
                <h6 class="fw-bold text-dark mb-3"><i class="bi bi-shield-check text-brand me-2"></i> Report Status</h6>
                @if ($question->status == 'approved')
                    <div class="p-3 rounded-3 text-center" style="background: #e6f4ea; border: 1px solid #c6f6d5;">
                        <i class="bi bi-check-circle-fill fs-2 text-success d-block mb-1"></i>
                        <span class="fw-bold text-success d-block">Approved Thesis Report</span>
                        <span class="small text-muted">Completed and archived by faculty advisor</span>
                    </div>
                @else
                    <div class="p-3 rounded-3 text-center" style="background: #fef3c7; border: 1px solid #fde68a;">
                        <i class="bi bi-exclamation-triangle-fill fs-2 text-warning d-block mb-1"></i>
                        <span class="fw-bold text-warning d-block">{{ ucfirst($question->status) }}</span>
                        <span class="small text-muted">Pending final approval</span>
                    </div>
                @endif
            </div>

            <!-- Student Info Card -->
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4" style="border: 1px solid #e2e8f0 !important;">
                <h6 class="fw-bold text-dark mb-3"><i class="bi bi-person-fill text-brand me-2"></i> Student Details</h6>
                <div class="d-flex align-items-center gap-3 mb-3">
                    <img src="{{ $question->user->photo ? asset('storage/' . $question->user->photo) : asset('/admin/assets/images/profile/user-1.jpg') }}"
                        alt="Student Photo" class="rounded-circle border p-1 object-fit-cover" width="50" height="50">
                    <div>
                        <h6 class="fw-bold text-dark mb-0 small">{{ $question->user->name }}</h6>
                        <span class="text-muted small d-block">{{ $question->user->email }}</span>
                    </div>
                </div>
                <div class="border-top pt-3">
                    <div class="d-flex justify-content-between mb-2 small">
                        <span class="text-muted">NIM / ID Number:</span>
                        <span class="fw-bold text-dark">{{ $question->user->id_number ?? '-' }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2 small">
                        <span class="text-muted">Academic Major:</span>
                        <span class="fw-bold text-dark">{{ $question->user->major ?? '-' }}</span>
                    </div>
                    <div class="d-flex justify-content-between small">
                        <span class="text-muted">Class Room:</span>
                        <span class="fw-bold text-dark">{{ $question->user->classRoom->class ?? '-' }}</span>
                    </div>
                </div>
            </div>

            <!-- Faculty Advisor Info Card -->
            <div class="card border-0 shadow-sm rounded-4 p-4" style="border: 1px solid #e2e8f0 !important;">
                <h6 class="fw-bold text-dark mb-3"><i class="bi bi-person-workspace text-brand me-2"></i> Assigned Advisor</h6>
                @if ($question->teacher)
                    <div class="d-flex align-items-center gap-3">
                        <img src="{{ $question->teacher->photo ? asset('storage/' . $question->teacher->photo) : asset('/admin/assets/images/profile/user-1.jpg') }}"
                            alt="Advisor Photo" class="rounded-circle border p-1 object-fit-cover" width="50" height="50">
                        <div>
                            <h6 class="fw-bold text-dark mb-0 small">{{ $question->teacher->name }}</h6>
                            <span class="text-muted small d-block">{{ $question->teacher->email }}</span>
                            <span class="badge text-white small mt-1" style="background-color: var(--brand-primary); font-size: 0.68rem;">Faculty Advisor</span>
                        </div>
                    </div>
                @else
                    <span class="text-muted small">No advisor assigned</span>
                @endif
            </div>
        </div>
    </div>
@endsection
