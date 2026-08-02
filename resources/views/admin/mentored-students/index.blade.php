@extends('admin.layouts.main')

@section('content')
    <!-- Top Header Banner -->
    <div class="card border-0 shadow-sm rounded-4 mb-4" style="background: linear-gradient(135deg, #fef8f5 0%, #ffffff 100%); border: 1px solid #f3e4dc !important;">
        <div class="card-body p-4">
            <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill mb-2" style="background: #fdf1ec; border: 1px solid #fcebe3;">
                <i class="bi bi-people-fill text-brand"></i>
                <span class="small fw-semibold text-brand">Assigned Advisees</span>
            </div>
            <h3 class="fw-bold text-dark mb-1">Mentored Students Directory</h3>
            <p class="text-muted mb-0 small">View and manage thesis advisee students assigned to your guidance supervision.</p>
        </div>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success border-0 rounded-3 mb-4 shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        </div>
    @endif

    <!-- Students Directory Table Card -->
    <div class="card border-0 shadow-sm rounded-4" style="border: 1px solid #f3e4dc !important;">
        <div class="card-header bg-white border-bottom p-4 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-2">
                <div class="p-2 rounded-3" style="background: #fdf1ec;">
                    <i class="bi bi-mortarboard-fill text-brand fs-5"></i>
                </div>
                <div>
                    <h5 class="fw-bold text-dark mb-0">Advisee Students List</h5>
                    <span class="small text-muted">Students currently assigned under your academic guidance</span>
                </div>
            </div>
        </div>

        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="60">No</th>
                            <th>Advisee Student</th>
                            <th width="160">NIM / ID Number</th>
                            <th width="160">Class Room</th>
                            <th width="140" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($students as $student)
                            <tr>
                                <td><span class="fw-semibold text-muted">{{ $loop->iteration + ($students->currentPage() - 1) * $students->perPage() }}</span></td>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="{{ $student->photo ? asset('storage/' . $student->photo) : asset('/admin/assets/images/profile/user-1.jpg') }}"
                                            alt="Student Avatar" class="rounded-circle border p-1 object-fit-cover" width="44" height="44">
                                        <div>
                                            <span class="fw-bold text-dark d-block">{{ $student->name }}</span>
                                            <span class="text-muted small">{{ $student->email }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="fw-semibold text-dark small">{{ $student->id_number ?? '-' }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border px-3 py-1.5 rounded-pill small fw-normal">
                                        {{ $student->classRoom->class ?? 'No Class' }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <a href="/admin/mentored-students/{{ $student->id }}" class="btn btn-sm btn-hero-primary rounded-pill px-3">
                                        <i class="bi bi-eye-fill me-1"></i> View Details
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="bi bi-person-x fs-1 d-block mb-3 text-muted"></i>
                                    <h6 class="fw-bold text-dark mb-1">No Advisee Students Found</h6>
                                    <p class="small text-muted mb-0">You currently have no advisee students assigned to your guidance workspace.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($students->hasPages())
                <div class="d-flex justify-content-end pt-4">
                    {{ $students->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
