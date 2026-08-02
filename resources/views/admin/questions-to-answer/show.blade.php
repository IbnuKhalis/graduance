@extends('admin.layouts.main')

@section('content')
    <!-- Top Header Banner -->
    <div class="card border-0 shadow-sm rounded-4 mb-4" style="background: linear-gradient(135deg, #fef8f5 0%, #ffffff 100%); border: 1px solid #f3e4dc !important;">
        <div class="card-body p-4 d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
            <div>
                <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill mb-2" style="background: #fdf1ec; border: 1px solid #fcebe3;">
                    <i class="bi bi-person-workspace text-brand"></i>
                    <span class="small fw-semibold text-brand">Advisor Guidance Dashboard</span>
                </div>
                <h3 class="fw-bold text-dark mb-1">Student Question & Review Thread</h3>
                <p class="text-muted mb-0 small">Examine student thesis inquiries, download attached drafts, post feedback, and approve thesis progress.</p>
            </div>
            <div>
                <a href="/admin/questions-to-answer" class="btn btn-outline-secondary rounded-pill px-4 py-2">
                    <i class="bi bi-arrow-left me-1"></i> Back to Questions List
                </a>
            </div>
        </div>
    </div>

    <!-- Question Overview & Metadata Row -->
    <div class="row g-4 mb-4">
        <!-- Question Details Card (col-lg-8) -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 h-100" style="border: 1px solid #f3e4dc !important;">
                <div class="card-header bg-white border-bottom p-4 d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2">
                        <div class="p-2 rounded-3" style="background: #fdf1ec;">
                            <i class="bi bi-question-circle-fill text-brand fs-4"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark mb-0">{{ $question->title }}</h5>
                            <span class="small text-muted">Submitted by <strong>{{ $question->user->name }}</strong> on {{ $question->created_at->format('M d, Y \a\t H:i') }}</span>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    <div class="mb-4">
                        <label class="form-label text-muted small fw-semibold text-uppercase mb-2">Student Inquiry Description</label>
                        <div class="p-3 rounded-3 bg-light border text-dark" style="font-size: 0.95rem; line-height: 1.6;">
                            {!! $question->body !!}
                        </div>
                    </div>

                    <!-- Attached File Box -->
                    <div>
                        <label class="form-label text-muted small fw-semibold text-uppercase mb-2">Student Draft Attachment</label>
                        @if ($question->file)
                            <div class="p-3 rounded-3 border bg-white d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bi bi-file-earmark-text-fill fs-3 text-brand"></i>
                                    <div>
                                        <span class="fw-semibold text-dark d-block small">Student Thesis Draft File</span>
                                        <span class="text-muted small" style="font-size: 0.75rem;">Download file to review student work</span>
                                    </div>
                                </div>
                                <a href="{{ asset('storage/' . $question->file) }}" class="btn btn-sm btn-hero-primary rounded-pill px-3 py-2" download>
                                    <i class="bi bi-download me-1"></i> Download Draft File
                                </a>
                            </div>
                        @else
                            <div class="p-3 rounded-3 bg-light border text-muted small">
                                <i class="bi bi-info-circle me-1"></i> No draft file attached by student.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Question Metadata & Approval Sidebar (col-lg-4) -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100" style="border: 1px solid #f3e4dc !important;">
                <div class="card-header bg-white border-bottom p-4">
                    <h6 class="fw-bold text-dark mb-0"><i class="bi bi-sliders text-brand me-2"></i> Review Actions & Info</h6>
                </div>

                <div class="card-body p-4 d-flex flex-column justify-content-between">
                    <div>
                        <!-- Status & Approve Action -->
                        <div class="mb-4">
                            <label class="form-label text-muted small fw-semibold text-uppercase mb-2">Guidance Status</label>
                            <div class="d-flex align-items-center justify-content-between p-3 rounded-3 bg-light border">
                                @if ($question->status == 'revision')
                                    <span class="badge bg-warning-subtle text-warning border border-warning px-3 py-2 rounded-pill fw-bold">
                                        <i class="bi bi-exclamation-triangle-fill me-1"></i> {{ ucfirst($question->status) }}
                                    </span>
                                    <button class="btn btn-sm btn-success rounded-pill px-3 py-2 fw-semibold" onclick="confirmApprove({{ $question->id }})">
                                        <i class="bi bi-check-circle-fill me-1"></i> Approve Thesis
                                    </button>
                                @else
                                    <span class="badge bg-success-subtle text-success border border-success px-3 py-2 rounded-pill fw-bold fs-6">
                                        <i class="bi bi-check-circle-fill me-1"></i> {{ ucfirst($question->status) }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Thesis Topic -->
                        <div class="mb-4">
                            <label class="form-label text-muted small fw-semibold text-uppercase mb-1">Thesis Topic</label>
                            <div class="p-3 rounded-3 border bg-white">
                                <span class="fw-bold text-dark small"><i class="bi bi-journal-bookmark-fill text-brand me-1"></i> {{ $question->topic->topic ?? '-' }}</span>
                            </div>
                        </div>

                        <!-- Student Profile -->
                        <div class="mb-0">
                            <label class="form-label text-muted small fw-semibold text-uppercase mb-1">Student</label>
                            <div class="p-3 rounded-3 d-flex align-items-center gap-2" style="background: #fdf1ec; border: 1px solid #fcebe3;">
                                <div class="rounded-circle bg-white p-2 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                                    <i class="bi bi-mortarboard-fill text-brand fs-5"></i>
                                </div>
                                <div>
                                    <span class="fw-bold text-dark d-block small">{{ $question->user->name ?? 'Student' }}</span>
                                    <span class="text-muted small" style="font-size: 0.75rem;">Advisee Student</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Discussion Thread & Reply Section -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card border-0 shadow-sm rounded-4" style="border: 1px solid #f3e4dc !important;">
                <div class="card-header bg-white border-bottom p-4 d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2">
                        <div class="p-2 rounded-3" style="background: #fdf1ec;">
                            <i class="bi bi-chat-dots-fill text-brand fs-4"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark mb-0">Guidance Thread</h5>
                            <span class="small text-muted">Exchange feedback and revisions with student</span>
                        </div>
                    </div>
                    <span class="badge bg-light text-dark border px-3 py-2 rounded-pill fw-semibold">
                        {{ $question->answers->count() }} Messages
                    </span>
                </div>

                <div class="card-body p-4">
                    @if (session()->has('success'))
                        <div class="alert alert-success border-0 rounded-3 mb-4" role="alert">
                            <i class="bi bi-check-circle-fill me-1"></i> {{ session('success') }}
                        </div>
                    @endif

                    <!-- Thread Messages -->
                    <div class="discussion-timeline mb-4">
                        @forelse ($question->answers as $answer)
                            @if ($answer->user->role->role === 'teacher')
                                <!-- Advisor Message Card -->
                                <div class="card border-0 shadow-sm rounded-4 mb-3" style="background: #fdf1ec; border-left: 4px solid var(--brand-primary) !important;">
                                    <div class="card-body p-4">
                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                            <div class="d-flex align-items-center gap-2">
                                                <img src="{{ $answer->user->photo ? asset('storage/' . $answer->user->photo) : asset('/admin/assets/images/profile/user-1.jpg') }}"
                                                    alt="Advisor Photo" class="rounded-circle border" width="42" height="42">
                                                <div>
                                                    <span class="fw-bold text-dark d-block">{{ $answer->user->name }}</span>
                                                    <span class="badge text-white small" style="background-color: var(--brand-primary); font-size: 0.7rem;">Faculty Advisor (You)</span>
                                                </div>
                                            </div>
                                            <span class="text-muted small"><i class="bi bi-clock me-1"></i> {{ $answer->created_at->diffForHumans() }}</span>
                                        </div>

                                        <div class="text-dark mb-3" style="font-size: 0.95rem; line-height: 1.6;">
                                            {!! nl2br(e($answer->body)) !!}
                                        </div>

                                        @if ($answer->file)
                                            <div class="pt-3 border-top border-warning-subtle">
                                                <a href="{{ asset('storage/' . $answer->file) }}" class="btn btn-sm btn-hero-primary rounded-pill px-3 py-1" download>
                                                    <i class="bi bi-download me-1"></i> Download Attached Revision File
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @else
                                <!-- Student Message Card -->
                                <div class="card border-0 shadow-sm rounded-4 mb-3" style="background: #ffffff; border: 1px solid #e2e8f0 !important; border-left: 4px solid #64748b !important;">
                                    <div class="card-body p-4">
                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                            <div class="d-flex align-items-center gap-2">
                                                <img src="{{ $answer->user->photo ? asset('storage/' . $answer->user->photo) : asset('/admin/assets/images/profile/user-1.jpg') }}"
                                                    alt="User Photo" class="rounded-circle border" width="42" height="42">
                                                <div>
                                                    <span class="fw-bold text-dark d-block">{{ $answer->user->name }}</span>
                                                    <span class="badge bg-secondary text-white small" style="font-size: 0.7rem;">Advisee Student</span>
                                                </div>
                                            </div>
                                            <span class="text-muted small"><i class="bi bi-clock me-1"></i> {{ $answer->created_at->diffForHumans() }}</span>
                                        </div>

                                        <div class="text-dark mb-3" style="font-size: 0.95rem; line-height: 1.6;">
                                            {!! nl2br(e($answer->body)) !!}
                                        </div>

                                        @if ($answer->file)
                                            <div class="pt-3 border-top">
                                                <a href="{{ asset('storage/' . $answer->file) }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1" download>
                                                    <i class="bi bi-download me-1 text-brand"></i> Download Student Draft File
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @empty
                            <div class="text-center py-5 text-muted bg-light rounded-4 border">
                                <i class="bi bi-chat-square-dots fs-1 d-block mb-2 text-brand"></i>
                                <p class="mb-0 fw-semibold text-dark">No Messages Exchanged Yet</p>
                                <span class="small text-muted">Use the feedback form below to send revision guidance to the student.</span>
                            </div>
                        @endforelse
                    </div>

                    <!-- Post Advisor Feedback Form -->
                    <div class="card border-0 rounded-4 p-4 mt-4" style="background: #fdf1ec; border: 1px solid #fcebe3 !important;">
                        <h6 class="fw-bold text-dark mb-3"><i class="bi bi-reply-fill text-brand me-1"></i> Post Advisor Feedback & Revision</h6>

                        <form action="/admin/questions-to-answer/{{ $question->id }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $question->id }}" name="question_id">

                            <div class="mb-3">
                                <label for="body" class="form-label fw-semibold text-dark small">Feedback Notes <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="body" name="body" rows="4" placeholder="Provide guidance, required revisions, or approval notes for the student..." required></textarea>
                                @error('body')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="file" class="form-label fw-semibold text-dark small">Attach Feedback File <span class="text-muted fw-normal">(Optional)</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0"><i class="bi bi-paperclip text-brand"></i></span>
                                    <input type="file" class="form-control border-start-0 ps-2" name="file" id="file">
                                </div>
                                <span class="form-text text-muted small"><i class="bi bi-info-circle me-1"></i> Formats: .docx, .doc, .pdf (Max 10MB)</span>
                                @error('file')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-hero-primary px-4 py-2 rounded-pill">
                                    <span>Send Feedback</span>
                                    <i class="bi bi-send-fill ms-1"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function confirmApprove(questionId) {
                Swal.fire({
                    title: '<h4 class="fw-bold text-dark m-0">Approve Thesis Progress?</h4>',
                    html: '<p class="text-muted small mt-2 mb-0">By approving, this student thesis question will be marked as approved and archived.</p>',
                    icon: 'question',
                    showCancelButton: true,
                    reverseButtons: true,
                    buttonsStyling: false,
                    confirmButtonText: '<i class="bi bi-check-circle-fill me-1"></i> Yes, Approve Thesis',
                    cancelButtonText: 'Cancel',
                    customClass: {
                        popup: 'rounded-4 p-4 shadow-lg border-0',
                        confirmButton: 'btn btn-success px-4 py-2 rounded-pill ms-2 fw-semibold',
                        cancelButton: 'btn btn-ghost-cancel'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        var form = document.createElement("form");
                        form.setAttribute("method", "POST");
                        form.setAttribute("action", "/questions/" + questionId + "/approve");

                        var csrfToken = document.createElement("input");
                        csrfToken.setAttribute("type", "hidden");
                        csrfToken.setAttribute("name", "_token");
                        csrfToken.setAttribute("value", "{{ csrf_token() }}");

                        form.appendChild(csrfToken);
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            }
        </script>
    @endpush
@endsection
