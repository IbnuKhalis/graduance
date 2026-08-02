@extends('admin.layouts.main')

@section('content')
    <!-- Top Header Banner -->
    <div class="card border-0 shadow-sm rounded-4 mb-4" style="background: linear-gradient(135deg, #fef8f5 0%, #ffffff 100%); border: 1px solid #f3e4dc !important;">
        <div class="card-body p-4">
            <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill mb-2" style="background: #fdf1ec; border: 1px solid #fcebe3;">
                <i class="bi bi-person-workspace text-brand"></i>
                <span class="small fw-semibold text-brand">Faculty Advisor Workspace</span>
            </div>
            <h3 class="fw-bold text-dark mb-1">Student Inquiries To Answer</h3>
            <p class="text-muted mb-0 small">Review thesis guidance questions submitted by your assigned advisee students and provide feedback responses.</p>
        </div>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success border-0 rounded-3 mb-4 shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        </div>
    @endif

    <!-- Main Questions Table Card -->
    <div class="card border-0 shadow-sm rounded-4" style="border: 1px solid #f3e4dc !important;">
        <div class="card-header bg-white border-bottom p-4 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-2">
                <div class="p-2 rounded-3" style="background: #fdf1ec;">
                    <i class="bi bi-chat-left-dots-fill text-brand fs-5"></i>
                </div>
                <div>
                    <h5 class="fw-bold text-dark mb-0">Assigned Advisee Questions</h5>
                    <span class="small text-muted">Guidance threads requiring advisor review</span>
                </div>
            </div>
        </div>

        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="60">No</th>
                            <th>Guidance Inquiry Title</th>
                            <th>Student & Class</th>
                            <th width="160">Question Date</th>
                            <th width="140">Status</th>
                            <th width="150">Draft File</th>
                            <th width="140" class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($questions as $question)
                            <tr>
                                <td><span class="fw-semibold text-muted">{{ $loop->iteration + ($questions->currentPage() - 1) * $questions->perPage() }}</span></td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="p-2 rounded-3" style="background: #fdf1ec;">
                                            <i class="bi bi-question-circle-fill text-brand"></i>
                                        </div>
                                        <div>
                                            <span class="fw-bold text-dark d-block">{{ $question->title }}</span>
                                            <span class="small text-muted"><i class="bi bi-journal-text me-1"></i> {{ $question->topic->topic ?? 'Thesis Topic' }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="fw-bold text-dark d-block small">{{ $question->user->name ?? 'Student' }}</span>
                                    <span class="badge bg-light text-dark border small fw-normal">{{ $question->user->classRoom->class ?? 'Class' }}</span>
                                </td>
                                <td>
                                    <span class="small text-muted"><i class="bi bi-clock me-1"></i> {{ $question->created_at->diffForHumans() }}</span>
                                </td>
                                <td>
                                    @if ($question->answers->count() > 0)
                                        <span class="badge text-white px-3 py-1.5 rounded-pill" style="background-color: #22c55e; font-size: 0.75rem;">
                                            <i class="bi bi-check-circle-fill me-1"></i> Answered ({{ $question->answers->count() }})
                                        </span>
                                    @else
                                        <span class="badge text-white px-3 py-1.5 rounded-pill" style="background-color: #eb5d1e; font-size: 0.75rem;">
                                            <i class="bi bi-hourglass-split me-1"></i> Pending
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if ($question->file)
                                        <a href="{{ asset('storage/' . $question->file) }}" target="_blank" class="btn btn-sm btn-light border rounded-pill px-3 text-brand">
                                            <i class="bi bi-file-earmark-arrow-down-fill me-1"></i> Download
                                        </a>
                                    @else
                                        <span class="text-muted small">No File</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a href="/admin/questions-to-answer/{{ $question->id }}" class="btn btn-sm btn-hero-primary rounded-pill px-3 text-nowrap">
                                        <i class="bi bi-chat-right-text-fill me-1"></i> Answer Now
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="bi bi-check2-circle fs-1 d-block mb-3 text-success"></i>
                                    <h6 class="fw-bold text-dark mb-1">All Questions Answered!</h6>
                                    <p class="small text-muted mb-0">You currently have no pending guidance inquiries from advisee students.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($questions->hasPages())
                <div class="d-flex justify-content-end pt-4">
                    {{ $questions->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
