@extends('admin.layouts.main')

@section('content')
    <!-- Top Header Banner -->
    <div class="card border-0 shadow-sm rounded-4 mb-4" style="background: linear-gradient(135deg, #fef8f5 0%, #ffffff 100%); border: 1px solid #f3e4dc !important;">
        <div class="card-body p-4">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill mb-2" style="background: #fdf1ec; border: 1px solid #fcebe3;">
                        <i class="bi bi-bell-fill text-brand"></i>
                        <span class="small fw-semibold text-brand">Announcement Detail</span>
                    </div>
                    <h3 class="fw-bold text-dark mb-1">{{ $notification->title }}</h3>
                    <p class="text-muted mb-0 small">Published {{ $notification->created_at ? $notification->created_at->diffForHumans() : '' }}</p>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <a href="/admin/notification" class="btn btn-outline-secondary px-4 py-2.5 rounded-pill d-inline-flex align-items-center justify-content-center fw-semibold">
                        <i class="bi bi-arrow-left me-1.5"></i> Back to List
                    </a>
                    <a href="/admin/notification/{{ $notification->id }}/edit" class="btn btn-hero-primary px-4 py-2.5 rounded-pill d-inline-flex align-items-center justify-content-center">
                        <i class="bi bi-pencil-fill me-1.5"></i> Edit Notification
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Notification Content Card -->
    <div class="card border-0 shadow-sm rounded-4" style="border: 1px solid #f3e4dc !important;">
        <div class="card-header bg-white border-bottom p-4 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-3">
                <div class="p-3 rounded-3 text-brand d-flex align-items-center justify-content-center" style="background: #fdf1ec; width: 48px; height: 48px;">
                    <i class="bi bi-megaphone-fill fs-4"></i>
                </div>
                <div>
                    <h5 class="fw-bold text-dark mb-1">{{ $notification->title }}</h5>
                    <span class="badge bg-light text-secondary border rounded-pill px-3 py-1 small">
                        <i class="bi bi-calendar-event me-1 text-brand"></i>
                        Published: {{ $notification->created_at ? $notification->created_at->format('d M Y, H:i') : '-' }}
                    </span>
                </div>
            </div>
        </div>

        <div class="card-body p-4">
            <div class="p-4 rounded-4 bg-light border" style="white-space: pre-wrap; font-size: 0.95rem; line-height: 1.7; color: #2d2420;">
                {{ $notification->notification }}
            </div>
        </div>
    </div>
@endsection
