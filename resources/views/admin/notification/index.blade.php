@extends('admin.layouts.main')

@section('content')
    <!-- Top Header Banner -->
    <div class="card border-0 shadow-sm rounded-4 mb-4" style="background: linear-gradient(135deg, #fef8f5 0%, #ffffff 100%); border: 1px solid #f3e4dc !important;">
        <div class="card-body p-4">
            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                <div>
                    <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill mb-2" style="background: #fdf1ec; border: 1px solid #fcebe3;">
                        <i class="bi bi-bell-fill text-brand"></i>
                        <span class="small fw-semibold text-brand">System Announcements</span>
                    </div>
                    <h3 class="fw-bold text-dark mb-1">System Notifications & Broadcasts</h3>
                    <p class="text-muted mb-0 small">Publish system-wide notifications, announcements, and portal alerts for users.</p>
                </div>
                <div>
                    <a href="/admin/notification/create" class="btn btn-hero-primary px-4 py-2.5 rounded-pill text-nowrap">
                        <i class="bi bi-plus-lg me-1"></i>
                        <span>Add New Notification</span>
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

    <!-- Notifications Table Card -->
    <div class="card border-0 shadow-sm rounded-4" style="border: 1px solid #f3e4dc !important;">
        <div class="card-header bg-white border-bottom p-4 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-2">
                <div class="p-2 rounded-3" style="background: #fdf1ec;">
                    <i class="bi bi-megaphone-fill text-brand fs-5"></i>
                </div>
                <div>
                    <h5 class="fw-bold text-dark mb-0">Published Notifications</h5>
                    <span class="small text-muted">All active broadcasts and system announcements</span>
                </div>
            </div>
        </div>

        <div class="card-body p-4">
            <div class="table-responsive">
                <table id="table_id" class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="60">No</th>
                            <th>Notification Title & Content Preview</th>
                            <th width="180">Published Date</th>
                            <th width="140" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($notifications as $notification)
                            <tr>
                                <td><span class="fw-semibold text-muted">{{ $loop->iteration }}</span></td>
                                <td>
                                    <div class="d-flex align-items-start gap-3 py-1">
                                        <div class="p-2.5 rounded-3 me-1 text-brand d-flex align-items-center justify-content-center" style="background: #fdf1ec; width: 40px; height: 40px;">
                                            <i class="bi bi-megaphone-fill fs-5"></i>
                                        </div>
                                        <div>
                                            <a href="/admin/notification/{{ $notification->id }}" class="fw-bold text-dark fs-6 text-decoration-none d-block mb-1">
                                                {{ $notification->title }}
                                            </a>
                                            <span class="text-muted small d-block text-truncate" style="max-width: 480px;">
                                                {{ \Illuminate\Support\Str::limit(strip_tags($notification->notification), 110) }}
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="small text-muted" title="{{ $notification->created_at ? $notification->created_at->format('d M Y, H:i') : '' }}">
                                        <i class="bi bi-clock me-1"></i> {{ $notification->created_at ? $notification->created_at->diffForHumans() : '-' }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="d-inline-flex gap-1">
                                        <a href="/admin/notification/{{ $notification->id }}" class="btn btn-sm btn-outline-info rounded-circle p-2 d-inline-flex align-items-center justify-content-center" style="width: 36px; height: 36px;" title="View Notification">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        <a href="/admin/notification/{{ $notification->id }}/edit" class="btn btn-sm btn-outline-warning rounded-circle p-2 d-inline-flex align-items-center justify-content-center" style="width: 36px; height: 36px;" title="Edit Notification">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <form id="delete-form-{{ $notification->id }}" action="/admin/notification/{{ $notification->id }}" method="POST" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button type="button" class="btn btn-sm btn-outline-danger rounded-circle p-2 d-inline-flex align-items-center justify-content-center swal-delete-notification" data-form="delete-form-{{ $notification->id }}" data-title="{{ $notification->title }}" style="width: 36px; height: 36px;" title="Delete Notification">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    <i class="bi bi-bell-slash fs-1 d-block mb-3 text-muted"></i>
                                    <h6 class="fw-bold text-dark mb-1">No System Notifications Found</h6>
                                    <p class="small text-muted mb-3">There are currently no active announcements created.</p>
                                    <a href="/admin/notification/create" class="btn btn-hero-primary btn-sm rounded-pill px-3">
                                        <i class="bi bi-plus-lg me-1"></i> Create First Notification
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($notifications instanceof \Illuminate\Pagination\LengthAwarePaginator && $notifications->hasPages())
                <div class="d-flex justify-content-end pt-4">
                    {{ $notifications->links() }}
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
                            "searchPlaceholder": "Search notification..."
                        }
                    });

                    $('.dataTables_filter input').addClass('form-control form-control-sm rounded-pill px-3 py-2 border');
                }

                $('.swal-delete-notification').click(function(e) {
                    e.preventDefault();
                    var formId = $(this).attr('data-form');
                    var title = $(this).attr('data-title');

                    Swal.fire({
                        title: 'Delete Notification?',
                        html: `Are you sure you want to delete notification <strong class="text-danger">"${title}"</strong>?<br><span class="small text-muted mt-2 d-block">This action cannot be undone and will remove it from all user dashboards.</span>`,
                        icon: 'warning',
                        showCancelButton: true,
                        reverseButtons: true,
                        buttonsStyling: false,
                        confirmButtonText: '<i class="bi bi-trash-fill me-1"></i> Yes, Delete',
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
