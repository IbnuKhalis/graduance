@extends('admin.layouts.main')

@section('content')
    <!-- Top Header Banner -->
    <div class="card border-0 shadow-sm rounded-4 mb-4" style="background: linear-gradient(135deg, #fef8f5 0%, #ffffff 100%); border: 1px solid #f3e4dc !important;">
        <div class="card-body p-4">
            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                <div>
                    <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill mb-2" style="background: #fdf1ec; border: 1px solid #fcebe3;">
                        <i class="bi bi-person-workspace text-brand"></i>
                        <span class="small fw-semibold text-brand">Advisor Management</span>
                    </div>
                    <h3 class="fw-bold text-dark mb-1">Faculty Advisors Directory</h3>
                    <p class="text-muted mb-0 small">Manage faculty advisor accounts, assign academic majors, and maintain guidance supervisor credentials.</p>
                </div>
                <div>
                    <a href="/admin/teachers/create" class="btn btn-hero-primary px-4 py-2.5 rounded-pill text-nowrap">
                        <i class="bi bi-plus-lg me-1"></i>
                        <span>Add New Advisor</span>
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

    <!-- Teachers Table Card -->
    <div class="card border-0 shadow-sm rounded-4" style="border: 1px solid #f3e4dc !important;">
        <div class="card-header bg-white border-bottom p-4 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-2">
                <div class="p-2 rounded-3" style="background: #fdf1ec;">
                    <i class="bi bi-people-fill text-brand fs-5"></i>
                </div>
                <div>
                    <h5 class="fw-bold text-dark mb-0">Registered Faculty Advisors</h5>
                    <span class="small text-muted">Active thesis advisors and guidance supervisors</span>
                </div>
            </div>
        </div>

        <div class="card-body p-4">
            <div class="table-responsive">
                <table id="table_id" class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="60">No</th>
                            <th>Faculty Advisor Name & Email</th>
                            <th width="180">NIP / ID Number</th>
                            <th width="200">Academic Major</th>
                            <th width="140" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($teachers as $teacher)
                            <tr>
                                <td><span class="fw-semibold text-muted">{{ $loop->iteration }}</span></td>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="{{ $teacher->photo ? asset('storage/' . $teacher->photo) : asset('/admin/assets/images/profile/user-1.jpg') }}"
                                            alt="Teacher Photo" class="rounded-circle border p-1 object-fit-cover" width="42" height="42">
                                        <div>
                                            <span class="fw-bold text-dark d-block">{{ $teacher->name }}</span>
                                            <span class="text-muted small">{{ $teacher->email }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="fw-semibold text-dark small">{{ $teacher->id_number ?? '-' }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border px-3 py-1.5 rounded-pill small fw-normal">
                                        <i class="bi bi-journal-bookmark text-brand me-1"></i> {{ $teacher->major ?? '-' }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="d-inline-flex gap-1">
                                        <a href="/admin/teachers/{{ $teacher->id }}" class="btn btn-sm btn-outline-info rounded-circle p-2 d-inline-flex align-items-center justify-content-center" style="width: 34px; height: 34px;" title="View Advisor Profile">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        <a href="/admin/teachers/{{ $teacher->id }}/edit" class="btn btn-sm btn-outline-warning rounded-circle p-2 d-inline-flex align-items-center justify-content-center" style="width: 34px; height: 34px;" title="Edit Advisor">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <form id="delete-form-{{ $teacher->id }}" action="/admin/teachers/{{ $teacher->id }}" method="POST" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button type="button" class="btn btn-sm btn-outline-danger rounded-circle p-2 d-inline-flex align-items-center justify-content-center swal-delete-teacher" data-form="delete-form-{{ $teacher->id }}" data-name="{{ $teacher->name }}" style="width: 34px; height: 34px;" title="Delete Advisor">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="bi bi-person-x fs-1 d-block mb-3 text-muted"></i>
                                    <h6 class="fw-bold text-dark mb-1">No Faculty Advisors Found</h6>
                                    <p class="small text-muted mb-3">There are currently no faculty advisors registered in the system.</p>
                                    <a href="/admin/teachers/create" class="btn btn-hero-primary btn-sm rounded-pill px-3">
                                        <i class="bi bi-plus-lg me-1"></i> Add First Advisor
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
                            "searchPlaceholder": "Search advisor name, email, NIP, major..."
                        }
                    });

                    // Wrap dataTables search box into modern input group style
                    $('.dataTables_filter input').addClass('form-control form-control-sm rounded-pill px-3 py-2 border');
                }

                $('.swal-delete-teacher').click(function(e) {
                    e.preventDefault();
                    var formId = $(this).attr('data-form');
                    var teacherName = $(this).attr('data-name');

                    Swal.fire({
                        title: 'Delete Faculty Advisor?',
                        html: `Are you sure you want to delete advisor <strong class="text-danger">"${teacherName}"</strong>?<br><span class="small text-muted mt-2 d-block">This action cannot be undone and will remove their advisor privileges.</span>`,
                        icon: 'warning',
                        showCancelButton: true,
                        reverseButtons: true,
                        buttonsStyling: false,
                        confirmButtonText: '<i class="bi bi-trash-fill me-1"></i> Yes, Delete Advisor',
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
