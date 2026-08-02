@extends('admin.layouts.main')

@section('content')
    <!-- Top Header Banner -->
    <div class="card border-0 shadow-sm rounded-4 mb-4" style="background: linear-gradient(135deg, #fef8f5 0%, #ffffff 100%); border: 1px solid #f3e4dc !important;">
        <div class="card-body p-4">
            <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill mb-2" style="background: #fdf1ec; border: 1px solid #fcebe3;">
                <i class="bi bi-chat-quote-fill text-brand"></i>
                <span class="small fw-semibold text-brand">Advisor Communication</span>
            </div>
            <h3 class="fw-bold text-dark mb-1">Advisor Broadcasts & Messages</h3>
            <p class="text-muted mb-0 small">Direct announcements, guidance notices, and updates sent by your faculty supervisor.</p>
        </div>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success border-0 rounded-3 mb-4 shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        </div>
    @endif

    <!-- Messages Container -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card border-0 shadow-sm rounded-4" style="border: 1px solid #f3e4dc !important;">
                <div class="card-header bg-white border-bottom p-4 d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2">
                        <div class="p-2 rounded-3" style="background: #fdf1ec;">
                            <i class="bi bi-inbox-fill text-brand fs-4"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark mb-0">Message Inbox</h5>
                            <span class="small text-muted">Announcements from your assigned mentor teacher</span>
                        </div>
                    </div>
                    <span class="badge bg-light text-dark border px-3 py-2 rounded-pill fw-semibold">
                        {{ $messages->count() }} Messages
                    </span>
                </div>

                <div class="card-body p-4">
                    <div class="message-feed">
                        @forelse ($messages as $message)
                            <div class="card border-0 shadow-sm rounded-4 mb-3" style="background: #fdf1ec; border: 1px solid #fcebe3 !important; border-left: 4px solid var(--brand-primary) !important;">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <div class="d-flex align-items-center gap-2">
                                            <img src="{{ $message->teacher->photo ? asset('storage/' . $message->teacher->photo) : asset('/admin/assets/images/profile/user-1.jpg') }}"
                                                alt="Advisor Photo" class="rounded-circle border" width="44" height="44">
                                            <div>
                                                <span class="fw-bold text-dark d-block mb-0">{{ $message->teacher->name }}</span>
                                                <span class="badge text-white small" style="background-color: var(--brand-primary); font-size: 0.7rem;">
                                                    <i class="bi bi-person-badge me-1"></i> Faculty Advisor
                                                </span>
                                            </div>
                                        </div>
                                        <span class="text-muted small"><i class="bi bi-clock me-1"></i> {{ $message->created_at->diffForHumans() }}</span>
                                    </div>

                                    <div class="text-dark" style="font-size: 0.95rem; line-height: 1.6;">
                                        {!! nl2br(e($message->message)) !!}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-5 text-muted bg-light rounded-4 border">
                                <i class="bi bi-chat-left-text fs-1 d-block mb-2 text-brand"></i>
                                <p class="mb-0 fw-semibold text-dark">No Advisor Messages Yet</p>
                                <span class="small text-muted">Your faculty supervisor has not sent any direct messages or broadcast announcements yet.</span>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
