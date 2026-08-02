@extends('admin.layouts.main')

@section('content')
    <!-- Top Header Banner -->
    <div class="card border-0 shadow-sm rounded-4 mb-4" style="background: linear-gradient(135deg, #fef8f5 0%, #ffffff 100%); border: 1px solid #f3e4dc !important;">
        <div class="card-body p-4">
            <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill mb-2" style="background: #fdf1ec; border: 1px solid #fcebe3;">
                <i class="bi bi-archive-fill text-brand"></i>
                <span class="small fw-semibold text-brand">Thesis Archives</span>
            </div>
            <h3 class="fw-bold text-dark mb-1">Approved Thesis Reports Archive</h3>
            <p class="text-muted mb-0 small">Browse, filter, and review completed and approved thesis guidance reports across academic classes.</p>
        </div>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success border-0 rounded-3 mb-4 shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        </div>
    @endif

    <!-- Main Content Card -->
    <div class="card border-0 shadow-sm rounded-4" style="border: 1px solid #f3e4dc !important;">
        <!-- Filter & Header Bar -->
        <div class="card-header bg-white border-bottom p-4">
            <form action="/admin/archive/filter-data" method="GET">
                <div class="row g-3 align-items-end">
                    <div class="col-md-6 col-lg-4">
                        <label for="class_id" class="form-label fw-semibold text-dark small mb-1">
                            <i class="bi bi-funnel-fill text-brand me-1"></i> Filter By Academic Class
                        </label>
                        <select class="form-select border-start-0 ps-2" name="class_id" id="class_id">
                            <option value="">All Classes</option>
                            @foreach ($classes as $class)
                                <option value="{{ $class->id }}" {{ request('class_id') == $class->id ? 'selected' : '' }}>
                                    {{ $class->class }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 col-lg-5 d-flex align-items-center gap-2">
                        <button type="submit" class="btn btn-hero-primary px-4 py-2.5 rounded-pill text-nowrap">
                            <i class="bi bi-funnel me-1"></i> Apply Filter
                        </button>
                        <a href="/admin/archive" class="btn btn-outline-secondary px-4 py-2.5 rounded-pill text-nowrap">
                            <i class="bi bi-arrow-counterclockwise me-1"></i> Reset Filter
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <!-- Archive Table -->
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="60">No</th>
                            <th>Thesis Guidance Title</th>
                            <th>Student & Class</th>
                            <th width="140">Status</th>
                            <th width="160">Thesis File</th>
                            <th width="140" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($questions as $question)
                            <tr>
                                <td><span class="fw-semibold text-muted">{{ $loop->iteration + ($questions->currentPage() - 1) * $questions->perPage() }}</span></td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="p-2 rounded-3" style="background: #e6f4ea;">
                                            <i class="bi bi-journal-check text-success"></i>
                                        </div>
                                        <div>
                                            <span class="fw-bold text-dark d-block">{{ $question->title }}</span>
                                            <span class="small text-muted"><i class="bi bi-clock me-1"></i> Approved: {{ $question->updated_at->format('d M Y') }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="fw-bold text-dark d-block small">{{ $question->user->name ?? 'Student' }}</span>
                                    <span class="badge bg-light text-dark border small fw-normal">{{ $question->user->classRoom->class ?? 'Class' }}</span>
                                </td>
                                <td>
                                    @if ($question->status == 'accepted' || $question->status == 'approved')
                                        <span class="badge text-white px-3 py-1.5 rounded-pill" style="background-color: #22c55e; font-size: 0.75rem;">
                                            <i class="bi bi-check-circle-fill me-1"></i> Approved
                                        </span>
                                    @else
                                        <span class="badge text-white px-3 py-1.5 rounded-pill" style="background-color: #f59e0b; font-size: 0.75rem;">
                                            <i class="bi bi-exclamation-triangle-fill me-1"></i> {{ ucfirst($question->status) }}
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if ($question->file)
                                        <a href="{{ asset('storage/' . $question->file) }}" download="Draft_Thesis_{{ \Illuminate\Support\Str::slug($question->title) }}.{{ pathinfo($question->file, PATHINFO_EXTENSION) }}" target="_blank" class="btn btn-sm btn-light border rounded-pill px-3 text-brand">
                                            <i class="bi bi-file-earmark-arrow-down-fill me-1"></i> Download
                                        </a>
                                    @else
                                        <span class="text-muted small">No File</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a href="/admin/archive/{{ $question->id }}" class="btn btn-sm btn-hero-primary rounded-pill px-3">
                                        <i class="bi bi-eye-fill me-1"></i> Details
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="bi bi-archive fs-1 d-block mb-3 text-muted"></i>
                                    <h6 class="fw-bold text-dark mb-1">No Archived Reports Found</h6>
                                    <p class="small text-muted mb-0">No approved thesis guidance reports match your search criteria.</p>
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
