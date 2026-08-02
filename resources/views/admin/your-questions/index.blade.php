@extends('admin.layouts.main')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card border-0 shadow-sm rounded-4" style="border: 1px solid #f3e4dc !important;">
                <div class="card-header bg-white border-bottom p-4 d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2">
                        <div class="p-2 rounded-3" style="background: #fdf1ec;">
                            <i class="bi bi-question-square-fill text-brand fs-4"></i>
                        </div>
                        <div>
                            <h5 class="card-title fw-bold text-dark mb-0">Your Guidance Questions</h5>
                            <span class="small text-muted">Manage your thesis questions and view supervisor feedback</span>
                        </div>
                    </div>
                    <div>
                        <a href="/admin/your-questions/create" class="btn btn-hero-primary py-2 px-3">
                            <i class="bi bi-plus-lg me-1"></i> Ask New Question
                        </a>
                    </div>
                </div>

                <div class="card-body p-4">
                    @if (session()->has('success'))
                        <div class="alert alert-success border-0 rounded-3 mb-3" role="alert">
                            <i class="bi bi-check-circle-fill me-1"></i> {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th width="60">No</th>
                                    <th>Question Title</th>
                                    <th>Submitted Date</th>
                                    <th>Status</th>
                                    <th>Attached Draft</th>
                                    <th>Supervisor Answer</th>
                                    <th width="120">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($questions as $question)
                                    <tr>
                                        <td><span class="fw-semibold text-muted">{{ $loop->iteration }}</span></td>
                                        <td><span class="fw-bold text-dark">{{ $question->title }}</span></td>
                                        <td><span class="badge bg-light text-muted border fw-normal">{{ $question->created_at->diffForHumans() }}</span></td>
                                        <td>
                                            @if ($question->status == 'revision')
                                                <span class="badge bg-warning-subtle text-warning border border-warning px-3 py-2 rounded-pill fw-semibold">{{ ucfirst($question->status) }}</span>
                                            @else
                                                <span class="badge bg-success-subtle text-success border border-success px-3 py-2 rounded-pill fw-semibold">{{ ucfirst($question->status) }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($question->file)
                                                <a href="{{ asset('storage/' . $question->file) }}" download="Draft_Thesis_{{ \Illuminate\Support\Str::slug($question->title) }}.{{ pathinfo($question->file, PATHINFO_EXTENSION) }}" class="btn btn-sm btn-outline-secondary rounded-pill">
                                                    <i class="bi bi-download me-1 text-brand"></i> Download Draft
                                                </a>
                                            @else
                                                <span class="text-muted small">No file</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="/admin/your-questions/{{ $question->id }}" class="btn btn-sm btn-outline-success rounded-pill px-3">
                                                <i class="bi bi-chat-text me-1"></i> View Feedback
                                            </a>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-1">
                                                <a href="/admin/your-questions/{{ $question->id }}/edit" class="btn btn-sm btn-light border text-dark" title="Edit">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </a>
                                                <form id="{{ $question->id }}" action="/admin/your-questions/{{ $question->id }}" method="POST" class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="button" class="btn btn-sm btn-light border text-danger swal-confirm" data-form="{{ $question->id }}" title="Delete">
                                                        <i class="bi bi-trash-fill"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5 text-muted">
                                            <i class="bi bi-chat-left-dots fs-1 d-block mb-2 text-brand"></i>
                                            <p class="mb-1 fw-semibold text-dark">No Questions Submitted Yet</p>
                                            <span class="small text-muted d-block mb-3">Ask your first question to get guidance from your thesis advisor.</span>
                                            <a href="/admin/your-questions/create" class="btn btn-sm btn-hero-primary">
                                                <i class="bi bi-plus-lg me-1"></i> Ask New Question
                                            </a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $questions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
