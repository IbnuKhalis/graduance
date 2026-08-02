@extends('admin.layouts.main')

@section('content')
    <!-- Top Header Banner -->
    <div class="card border-0 shadow-sm rounded-4 mb-4" style="background: linear-gradient(135deg, #fef8f5 0%, #ffffff 100%); border: 1px solid #f3e4dc !important;">
        <div class="card-body p-4">
            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                <div>
                    <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill mb-2" style="background: #fdf1ec; border: 1px solid #fcebe3;">
                        <i class="bi bi-journal-bookmark-fill text-brand"></i>
                        <span class="small fw-semibold text-brand">Thesis Topic Repository</span>
                    </div>
                    <h3 class="fw-bold text-dark mb-1">Thesis Topics Management</h3>
                    <p class="text-muted mb-0 small">Create, organize, and maintain academic research topics available for student guidance selection.</p>
                </div>
                <div>
                    <a href="/admin/topics/create" class="btn btn-hero-primary px-4 py-2.5 rounded-pill text-nowrap">
                        <i class="bi bi-plus-lg me-1"></i>
                        <span>Add New Topic</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success border-0 rounded-3 mb-4 shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        </div>
    @endif

    <!-- Topics Table Card -->
    <div class="card border-0 shadow-sm rounded-4" style="border: 1px solid #f3e4dc !important;">
        <div class="card-header bg-white border-bottom p-4 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-2">
                <div class="p-2 rounded-3" style="background: #fdf1ec;">
                    <i class="bi bi-list-stars text-brand fs-5"></i>
                </div>
                <div>
                    <h5 class="fw-bold text-dark mb-0">Active Thesis Topics</h5>
                    <span class="small text-muted">List of topics currently available for students</span>
                </div>
            </div>
        </div>

        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="60">No</th>
                            <th width="280">Topic Name</th>
                            <th>Description</th>
                            <th width="140" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($topics as $topic)
                            <tr>
                                <td><span class="fw-semibold text-muted">{{ $loop->iteration + ($topics->currentPage() - 1) * $topics->perPage() }}</span></td>
                                <td>
                                    <span class="fw-bold text-dark">{{ $topic->topic }}</span>
                                </td>
                                <td><span class="text-secondary small">{{ Str::limit($topic->description, 120) }}</span></td>
                                <td class="text-end">
                                    <div class="d-inline-flex gap-1">
                                        <a href="/admin/topics/{{ $topic->id }}/edit" class="btn btn-sm btn-outline-warning rounded-circle p-2 d-inline-flex align-items-center justify-content-center" style="width: 34px; height: 34px;" title="Edit Topic">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <form id="delete-form-{{ $topic->id }}" action="/admin/topics/{{ $topic->id }}" method="POST" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button type="button" class="btn btn-sm btn-outline-danger rounded-circle p-2 d-inline-flex align-items-center justify-content-center swal-delete-topic" data-form="delete-form-{{ $topic->id }}" data-topic="{{ $topic->topic }}" style="width: 34px; height: 34px;" title="Delete Topic">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    <i class="bi bi-journal-x fs-1 d-block mb-3 text-muted"></i>
                                    <h6 class="fw-bold text-dark mb-1">No Thesis Topics Found</h6>
                                    <p class="small text-muted mb-3">You haven't created any thesis topics yet.</p>
                                    <a href="/admin/topics/create" class="btn btn-hero-primary btn-sm rounded-pill px-3">
                                        <i class="bi bi-plus-lg me-1"></i> Add First Topic
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($topics->hasPages())
                <div class="d-flex justify-content-end pt-4">
                    {{ $topics->links() }}
                </div>
            @endif
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('.swal-delete-topic').click(function(e) {
                    e.preventDefault();
                    var formId = $(this).attr('data-form');
                    var topicTitle = $(this).attr('data-topic');

                    Swal.fire({
                        title: 'Delete Thesis Topic?',
                        html: `Are you sure you want to delete <strong class="text-danger">"${topicTitle}"</strong>?<br><span class="small text-muted mt-2 d-block">This action cannot be undone and will remove the topic from registration.</span>`,
                        icon: 'warning',
                        showCancelButton: true,
                        reverseButtons: true,
                        buttonsStyling: false,
                        confirmButtonText: '<i class="bi bi-trash-fill me-1"></i> Yes, Delete Topic',
                        cancelButtonText: 'Cancel',
                        customClass: {
                            popup: 'rounded-4 p-4 shadow-lg border-0',
                            confirmButton: 'btn btn-danger-confirm ms-2',
                            cancelButton: 'btn btn-ghost-cancel'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#' + formId).submit();
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
