@extends('admin.layouts.main')

@section('content')
    <!-- Top Header Banner -->
    <div class="card border-0 shadow-sm rounded-4 mb-4" style="background: linear-gradient(135deg, #fef8f5 0%, #ffffff 100%); border: 1px solid #f3e4dc !important;">
        <div class="card-body p-4">
            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                <div>
                    <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill mb-2" style="background: #fdf1ec; border: 1px solid #fcebe3;">
                        <i class="bi bi-chat-left-quote-fill text-brand"></i>
                        <span class="small fw-semibold text-brand">Thesis Inquiry Overview</span>
                    </div>
                    <h3 class="fw-bold text-dark mb-1">All Student Guidance Inquiries</h3>
                    <p class="text-muted mb-0 small">Monitor all thesis questions submitted by students, track response progress, and send reminders to faculty advisors.</p>
                </div>
            </div>
        </div>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success border-0 rounded-3 mb-4 shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        </div>
    @endif

    <!-- Questions Table Card -->
    <div class="card border-0 shadow-sm rounded-4" style="border: 1px solid #f3e4dc !important;">
        <div class="card-header bg-white border-bottom p-4 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-2">
                <div class="p-2 rounded-3" style="background: #fdf1ec;">
                    <i class="bi bi-journal-text text-brand fs-5"></i>
                </div>
                <div>
                    <h5 class="fw-bold text-dark mb-0">Guidance Inquiries Repository</h5>
                    <span class="small text-muted">Complete list of student thesis guidance submissions</span>
                </div>
            </div>
        </div>

        <div class="card-body p-4">
            <div class="table-responsive">
                <table id="table_id" class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="60">No</th>
                            <th>Thesis Question Title</th>
                            <th>Student Advisee</th>
                            <th>Assigned Advisor</th>
                            <th width="160">Submitted Date</th>
                            <th width="140">Status</th>
                            <th width="160" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($questions as $question)
                            <tr>
                                <td><span class="fw-semibold text-muted">{{ $loop->iteration }}</span></td>
                                <td>
                                    <span class="fw-bold text-dark d-block text-truncate" style="max-width: 260px;" title="{{ $question->title }}">
                                        {{ $question->title }}
                                    </span>
                                    <span class="text-muted small">Topic: {{ $question->topic->topic ?? '-' }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="{{ $question->user->photo ? asset('storage/' . $question->user->photo) : asset('/admin/assets/images/profile/user-1.jpg') }}"
                                            alt="Student Avatar" class="rounded-circle border p-0.5 object-fit-cover" width="32" height="32">
                                        <div>
                                            <span class="fw-semibold text-dark small d-block">{{ $question->user->name }}</span>
                                            <span class="text-muted" style="font-size: 0.75rem;">{{ $question->user->classRoom->class ?? 'No Class' }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="{{ $question->teacher->photo ? asset('storage/' . $question->teacher->photo) : asset('/admin/assets/images/profile/user-1.jpg') }}"
                                            alt="Advisor Avatar" class="rounded-circle border p-0.5 object-fit-cover" width="32" height="32">
                                        <div>
                                            <span class="fw-semibold text-dark small d-block">{{ $question->teacher->name }}</span>
                                            <span class="text-muted" style="font-size: 0.75rem;">Advisor</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="small text-muted" title="{{ $question->created_at->format('d M Y, H:i') }}">
                                        <i class="bi bi-clock me-1"></i> {{ $question->created_at->diffForHumans() }}
                                    </span>
                                </td>
                                <td>
                                    @if ($question->answers->count() > 0 || $question->status == 'accepted' || $question->status == 'approved')
                                        <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1.5 small fw-semibold">
                                            <i class="bi bi-check-circle-fill me-1"></i> Answered
                                        </span>
                                    @else
                                        <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-3 py-1.5 small fw-semibold">
                                            <i class="bi bi-clock-history me-1"></i> Pending
                                        </span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a href="/admin/questions/send-message/{{ $question->id }}" class="btn btn-hero-primary btn-sm rounded-pill px-3 py-1.5 small text-nowrap">
                                        <i class="bi bi-bell-fill me-1"></i> Remind Advisor
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="bi bi-chat-left-dots fs-1 d-block mb-3 text-muted"></i>
                                    <h6 class="fw-bold text-dark mb-1">No Guidance Inquiries Found</h6>
                                    <p class="small text-muted mb-0">There are currently no thesis questions submitted by students.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($questions instanceof \Illuminate\Pagination\LengthAwarePaginator && $questions->hasPages())
                <div class="d-flex justify-content-end pt-4">
                    {{ $questions->links() }}
                </div>
            @endif
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                if ($('#table_id tbody tr').length > 0 && !$('#table_id tbody tr td').hasClass('dataTables_empty')) {
                    $('#table_id').DataTable({
                        "paging": true,
                        "ordering": true,
                        "info": true,
                        "lengthChange": false,
                        "language": {
                            "search": "_INPUT_",
                            "searchPlaceholder": "Search question, student, advisor..."
                        }
                    });

                    $('.dataTables_filter input').addClass('form-control form-control-sm rounded-pill px-3 py-2 border');
                }
            });
        </script>
    @endpush
@endsection
