@extends('admin.layouts.main')

@section('content')
    <!-- Top Header Banner -->
    <div class="card border-0 shadow-sm rounded-4 mb-4" style="background: linear-gradient(135deg, #fef8f5 0%, #ffffff 100%); border: 1px solid #f3e4dc !important;">
        <div class="card-body p-4">
            <div class="d-flex align-items-center gap-2 px-3 py-1 rounded-pill mb-2 d-inline-flex" style="background: #fdf1ec; border: 1px solid #fcebe3;">
                <i class="bi bi-journal-bookmark-fill text-brand"></i>
                <span class="small fw-semibold text-brand">Topic Selection & Registration</span>
            </div>
            <h3 class="fw-bold text-dark mb-1">Select Your Thesis Topic</h3>
            <p class="text-muted mb-0 small">
                Explore research topics offered by faculty advisors. Choose a topic that aligns with your thesis interest to begin supervision.
            </p>
        </div>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success border-0 rounded-3 mb-4 shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger border-0 rounded-3 mb-4 shadow-sm" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
        </div>
    @endif

    @if ($existingRegistration)
        <!-- Registered Topic Info Card -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card border-0 shadow-sm rounded-4 p-4 text-center" style="border: 1px solid #f3e4dc !important; background: #ffffff;">
                    <div class="p-3 rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="background: #fdf1ec; width: 64px; height: 64px;">
                        <i class="bi bi-patch-check-fill text-brand fs-1"></i>
                    </div>
                    <h4 class="fw-bold text-dark mb-2">You Have Registered Your Thesis Topic!</h4>
                    <p class="text-muted mb-4 small">Below is the details of your selected thesis topic and assigned faculty advisor.</p>

                    <div class="p-4 rounded-4 text-start mx-auto mb-4" style="max-width: 650px; background: #fdf8f5; border: 1px solid #fcebe3;">
                        <div class="mb-3">
                            <span class="badge rounded-pill text-bg-warning px-3 py-2 text-white mb-2">Registered Topic</span>
                            <h5 class="fw-bold text-dark mb-1">{{ $existingRegistration->topic->topic ?? 'N/A' }}</h5>
                            <p class="text-muted small mb-0">{{ $existingRegistration->topic->description ?? '' }}</p>
                        </div>
                        <hr style="border-top: 1px dashed #e2cbd0;">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-circle p-2 d-flex align-items-center justify-content-center" style="background: #ffffff; width: 44px; height: 44px; border: 1px solid #f3e4dc;">
                                <i class="bi bi-person-fill text-brand fs-5"></i>
                            </div>
                            <div>
                                <span class="small text-muted d-block">Faculty Advisor / Teacher</span>
                                <strong class="text-dark fs-6">{{ $existingRegistration->teacher->name ?? 'N/A' }}</strong>
                            </div>
                        </div>
                    </div>

                    <div>
                        <a href="/admin/your-questions" class="btn btn-hero-primary px-4 py-2 rounded-pill">
                            <i class="bi bi-chat-square-text-fill me-2"></i> Go to Guidance & Questions
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
    <!-- Topics Table Container -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card border-0 shadow-sm rounded-4" style="border: 1px solid #f3e4dc !important;">
                <div class="card-header bg-white border-bottom p-4 d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2">
                        <div class="p-2 rounded-3" style="background: #fdf1ec;">
                            <i class="bi bi-list-stars text-brand fs-4"></i>
                        </div>
                        <div>
                            <h5 class="card-title fw-bold text-dark mb-0">Available Thesis Topics</h5>
                            <span class="small text-muted">Select one topic to pair with the advisor</span>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table id="table_id" class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th width="60">No</th>
                                    <th>Topic Title</th>
                                    <th>Description</th>
                                    <th>Faculty Advisor / Teacher</th>
                                    <th width="160" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($topics as $topic)
                                    <tr>
                                        <td><span class="fw-semibold text-muted">{{ $loop->iteration }}</span></td>
                                        <td>
                                            <span class="fw-bold text-dark d-block">{{ $topic->topic }}</span>
                                        </td>
                                        <td>
                                            <span class="text-secondary small">{{ $topic->description }}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="rounded-circle p-2 d-flex align-items-center justify-content-center" style="background: #fdf1ec; width: 34px; height: 34px;">
                                                    <i class="bi bi-person-fill text-brand"></i>
                                                </div>
                                                <span class="fw-semibold text-dark small">{{ $topic->teacher->name ?? 'Advisor' }}</span>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-hero-primary px-3 py-2 rounded-pill" onclick="selectTopic({{ $topic->id }}, '{{ addslashes($topic->topic) }}', '{{ addslashes($topic->teacher->name ?? 'Advisor') }}')">
                                                <span>Select Topic</span>
                                                <i class="bi bi-arrow-right-short ms-1"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5 text-muted">
                                            <i class="bi bi-journal-x fs-1 d-block mb-2 text-brand"></i>
                                            <p class="mb-0 fw-semibold text-dark">No Available Topics Found</p>
                                            <span class="small text-muted">Please contact your academic administrator for topic allocations.</span>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @push('scripts')
        <script>
            $(document).ready(function() {
                if ($.fn.DataTable.isDataTable('#table_id')) {
                    $('#table_id').DataTable().destroy();
                }
                $('#table_id').DataTable({
                    "pageLength": 10,
                    "ordering": true,
                    "language": {
                        "search": "Search topic:",
                        "lengthMenu": "Show _MENU_ topics per page"
                    }
                });
            });

            function selectTopic(topicId, topicName, teacherName) {
                Swal.fire({
                    title: '<h4 class="fw-bold text-dark m-0">Select This Thesis Topic?</h4>',
                    html: `
                        <div class="my-3 text-start p-3 rounded-3" style="background: #fdf1ec; border: 1px solid #fcebe3;">
                            <div class="fw-bold text-dark fs-6 mb-1">${topicName}</div>
                            <div class="small text-muted"><i class="bi bi-person-fill text-brand me-1"></i> Faculty Advisor: <strong class="text-dark">${teacherName}</strong></div>
                        </div>
                    `,
                    showCancelButton: true,
                    reverseButtons: true,
                    buttonsStyling: false,
                    confirmButtonText: '<i class="bi bi-check-lg me-1"></i> Yes, Select Topic',
                    cancelButtonText: 'Cancel',
                    customClass: {
                        popup: 'rounded-4 p-4 shadow-lg border-0',
                        confirmButton: 'btn btn-primary-confirm ms-2',
                        cancelButton: 'btn btn-ghost-cancel'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "/registration/" + topicId + "/confirm";
                    }
                });
            }
        </script>
    @endpush
@endsection
