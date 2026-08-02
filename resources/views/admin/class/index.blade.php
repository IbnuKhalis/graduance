@extends('admin.layouts.main')

@section('content')
    <!-- Top Header Banner -->
    <div class="card border-0 shadow-sm rounded-4 mb-4" style="background: linear-gradient(135deg, #fef8f5 0%, #ffffff 100%); border: 1px solid #f3e4dc !important;">
        <div class="card-body p-4">
            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                <div>
                    <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill mb-2" style="background: #fdf1ec; border: 1px solid #fcebe3;">
                        <i class="bi bi-building text-brand"></i>
                        <span class="small fw-semibold text-brand">Academic Workspace</span>
                    </div>
                    <h3 class="fw-bold text-dark mb-1">Academic Classes Directory</h3>
                    <p class="text-muted mb-0 small">Manage student class cohorts, cohort designations, and student group assignments.</p>
                </div>
                <div>
                    <a href="/admin/class/create" class="btn btn-hero-primary px-4 py-2.5 rounded-pill text-nowrap">
                        <i class="bi bi-plus-lg me-1"></i>
                        <span>Add New Class</span>
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

    <!-- Metric Overview Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 p-3" style="border: 1px solid #f3e4dc !important; background: #ffffff;">
                <div class="d-flex align-items-center gap-3">
                    <div class="p-3 rounded-4" style="background: #fdf1ec;">
                        <i class="bi bi-building-check fs-3 text-brand"></i>
                    </div>
                    <div>
                        <span class="text-muted small d-block">Total Academic Classes</span>
                        <h4 class="fw-bold text-dark mb-0">{{ $classes->count() }} <span class="fs-6 fw-normal text-muted">Cohorts</span></h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 p-3" style="border: 1px solid #f3e4dc !important; background: #ffffff;">
                <div class="d-flex align-items-center gap-3">
                    <div class="p-3 rounded-4" style="background: #e0f2fe;">
                        <i class="bi bi-people-fill fs-3 text-info"></i>
                    </div>
                    <div>
                        <span class="text-muted small d-block">Assigned Students</span>
                        <h4 class="fw-bold text-dark mb-0">
                            {{ \App\Models\User::whereNotNull('class_id')->count() }} <span class="fs-6 fw-normal text-muted">Active Students</span>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Class Table Card -->
    <div class="card border-0 shadow-sm rounded-4" style="border: 1px solid #f3e4dc !important;">
        <div class="card-header bg-white border-bottom p-4 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-2">
                <div class="p-2 rounded-3" style="background: #fdf1ec;">
                    <i class="bi bi-door-open-fill text-brand fs-5"></i>
                </div>
                <div>
                    <h5 class="fw-bold text-dark mb-0">Registered Class Rooms</h5>
                    <span class="small text-muted">List of active cohorts available for student assignment</span>
                </div>
            </div>
        </div>

        <div class="card-body p-4">
            <div class="table-responsive">
                <table id="table_id" class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="70">No</th>
                            <th>Class Room & Cohort Details</th>
                            <th width="200">Cohort Status</th>
                            <th width="140" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($classes as $class)
                            <tr>
                                <td>
                                    <span class="fw-semibold text-muted">{{ $loop->iteration }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center py-1">
                                        <div class="p-2.5 rounded-3 me-3 text-brand d-flex align-items-center justify-content-center" style="background: #fdf1ec; width: 44px; height: 44px;">
                                            <i class="bi bi-door-open-fill fs-5"></i>
                                        </div>
                                        <div>
                                            <span class="fw-bold text-dark fs-6 d-block mb-1">{{ $class->class }}</span>
                                            <span class="badge bg-light text-secondary border rounded-pill px-2.5 py-1 small fw-normal">
                                                <i class="bi bi-people-fill text-brand me-1"></i>
                                                {{ $class->users ? $class->users->count() : 0 }} Enrolled Students
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1.5 small fw-semibold">
                                        <i class="bi bi-check-circle-fill me-1"></i> Active Cohort
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="d-inline-flex gap-1">
                                        <a href="/admin/class/{{ $class->id }}/edit" class="btn btn-sm btn-outline-warning rounded-circle p-2 d-inline-flex align-items-center justify-content-center" style="width: 36px; height: 36px;" title="Edit Class">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <form id="delete-form-{{ $class->id }}" action="/admin/class/{{ $class->id }}" method="POST" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button type="button" class="btn btn-sm btn-outline-danger rounded-circle p-2 d-inline-flex align-items-center justify-content-center swal-delete-class" data-form="delete-form-{{ $class->id }}" data-name="{{ $class->class }}" style="width: 36px; height: 36px;" title="Delete Class">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    <i class="bi bi-building-x fs-1 d-block mb-3 text-muted"></i>
                                    <h6 class="fw-bold text-dark mb-1">No Academic Classes Found</h6>
                                    <p class="small text-muted mb-3">There are currently no class rooms created in the system.</p>
                                    <a href="/admin/class/create" class="btn btn-hero-primary btn-sm rounded-pill px-3">
                                        <i class="bi bi-plus-lg me-1"></i> Add First Class
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
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
                            "searchPlaceholder": "Search class room..."
                        }
                    });

                    // Wrap dataTables search box into modern input group style
                    $('.dataTables_filter input').addClass('form-control form-control-sm rounded-pill px-3 py-2 border');
                }

                $('.swal-delete-class').click(function(e) {
                    e.preventDefault();
                    var formId = $(this).attr('data-form');
                    var className = $(this).attr('data-name');

                    Swal.fire({
                        title: 'Delete Class Room?',
                        html: `Are you sure you want to delete class <strong class="text-danger">"${className}"</strong>?<br><span class="small text-muted mt-2 d-block">Students assigned to this class may need to be re-assigned.</span>`,
                        icon: 'warning',
                        showCancelButton: true,
                        reverseButtons: true,
                        buttonsStyling: false,
                        confirmButtonText: '<i class="bi bi-trash-fill me-1"></i> Yes, Delete Class',
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
