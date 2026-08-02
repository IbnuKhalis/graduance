@extends('admin.layouts.main')

@section('content')
    <!-- Top Header Banner -->
    <div class="card border-0 shadow-sm rounded-4 mb-4" style="background: linear-gradient(135deg, #fef8f5 0%, #ffffff 100%); border: 1px solid #f3e4dc !important;">
        <div class="card-body p-4">
            <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill mb-2" style="background: #fdf1ec; border: 1px solid #fcebe3;">
                <i class="bi bi-send-fill text-brand"></i>
                <span class="small fw-semibold text-brand">Advisor Mass Communication</span>
            </div>
            <h3 class="fw-bold text-dark mb-1">Broadcast Messages to Advisee Students</h3>
            <p class="text-muted mb-0 small">Send important guidance announcements, deadlines, or revision reminders to your mentored students.</p>
        </div>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success border-0 rounded-3 mb-4 shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        </div>
    @endif

    <!-- Main Container -->
    <form method="POST" action="/admin/mass-messaging" enctype="multipart/form-data">
        @csrf
        <div class="row g-4">
            <!-- Student Selection Sidebar (col-lg-4) -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 h-100" style="border: 1px solid #f3e4dc !important;">
                    <div class="card-header bg-white border-bottom p-4 d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-people-fill text-brand fs-5"></i>
                            <h6 class="fw-bold text-dark mb-0">Select Recipients</h6>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <div class="mb-3 p-2 rounded-3 bg-light border d-flex align-items-center justify-content-between">
                            <label class="fw-bold text-dark small mb-0 cursor-pointer" for="select-all">
                                Select All Advisees
                            </label>
                            <input type="checkbox" class="form-check-input" id="select-all">
                        </div>

                        <div class="student-list-container pe-1" style="max-height: 340px; overflow-y: auto;">
                            @forelse ($students as $student)
                                <div class="d-flex align-items-center justify-content-between p-2 rounded-3 mb-2 border bg-white">
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="{{ $student->photo ? asset('storage/' . $student->photo) : asset('/admin/assets/images/profile/user-1.jpg') }}"
                                            alt="User Photo" class="rounded-circle border" width="34" height="34">
                                        <div>
                                            <span class="fw-semibold text-dark d-block small mb-0">{{ $student->name }}</span>
                                            <span class="text-muted small" style="font-size: 0.75rem;">Student Advisee</span>
                                        </div>
                                    </div>
                                    <input type="checkbox" class="form-check-input student-checkbox" name="student_id[]" value="{{ $student->id }}">
                                </div>
                            @empty
                                <div class="text-center py-4 text-muted small">
                                    <i class="bi bi-people fs-3 d-block mb-1 text-brand"></i>
                                    No mentored students found.
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- Message Form Body (col-lg-8) -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 h-100" style="border: 1px solid #f3e4dc !important;">
                    <div class="card-header bg-white border-bottom p-4">
                        <div class="d-flex align-items-center gap-2">
                            <div class="p-2 rounded-3" style="background: #fdf1ec;">
                                <i class="bi bi-pencil-square text-brand fs-4"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold text-dark mb-0">Broadcast Message Details</h5>
                                <span class="small text-muted">Compose your announcement or guidance notice</span>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-4 d-flex flex-column justify-content-between">
                        <div class="mb-4">
                            <label for="message" class="form-label fw-semibold text-dark">Message Content <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="message" id="message" rows="9" placeholder="Type your broadcast announcement or instructions here..." required></textarea>
                            <span class="form-text text-muted small"><i class="bi bi-info-circle me-1"></i> This message will be delivered directly to the inbox of all selected students.</span>
                            @error('message')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-hero-primary px-4 py-2 rounded-pill">
                                <span>Send Broadcast Message</span>
                                <i class="bi bi-send-fill ms-2"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#select-all').change(function() {
                    $('.student-checkbox').prop('checked', $(this).prop('checked'));
                });

                $('.student-checkbox').change(function() {
                    var allChecked = $('.student-checkbox:checked').length === $('.student-checkbox').length;
                    $('#select-all').prop('checked', allChecked);
                });
            });
        </script>
    @endpush
@endsection
