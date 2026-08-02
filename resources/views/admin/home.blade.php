@extends('admin.layouts.main')

@section('content')
    @if (auth()->user()->role->role == 'admin')
        <!-- Admin Welcome Hero Banner -->
        <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden" style="background: linear-gradient(135deg, #fef8f5 0%, #ffffff 100%); border: 1px solid #f3e4dc !important;">
            <div class="card-body p-4">
                <div class="row align-items-center g-3">
                    <div class="col-12">
                        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill mb-2" style="background: #fdf1ec; border: 1px solid #fcebe3;">
                            <i class="bi bi-shield-lock-fill text-brand"></i>
                            <span class="small fw-semibold text-brand">System Administration Workspace</span>
                        </div>
                        <h3 class="fw-bold text-dark mb-1">Welcome back, Administrator {{ auth()->user()->name }}! 👋</h3>
                        <p class="text-muted mb-3 small">Manage faculty advisors, student enrollments, thesis topics, and academic guidance reports across all departments.</p>
                        <div class="d-flex flex-wrap gap-2 align-items-center">
                            <span class="badge bg-light text-dark border px-3 py-2"><i class="bi bi-person-badge text-brand me-1"></i> Role: Administrator</span>
                            <span class="badge bg-light text-dark border px-3 py-2"><i class="bi bi-envelope text-brand me-1"></i> {{ auth()->user()->email }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm rounded-4 h-100 p-2" style="border: 1px solid #f3e4dc !important; background: #ffffff;">
                    <div class="card-body d-flex align-items-center justify-content-between p-3">
                        <div>
                            <span class="text-muted small fw-semibold text-uppercase">All Questions</span>
                            <h2 class="fw-bold text-dark mt-1 mb-0">{{ $questionsAll }}</h2>
                            <span class="small text-muted">Total guidance topics</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-center rounded-3" style="background: #fdf1ec; width: 56px; height: 56px;">
                            <i class="bi bi-chat-left-text-fill fs-3 text-brand"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm rounded-4 h-100 p-2" style="border: 1px solid #e2e8f0 !important; background: #ffffff;">
                    <div class="card-body d-flex align-items-center justify-content-between p-3">
                        <div>
                            <span class="text-muted small fw-semibold text-uppercase">Today Questions</span>
                            <h2 class="fw-bold text-dark mt-1 mb-0">{{ $todayQuestions }}</h2>
                            <span class="small text-muted">Submitted today</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-center rounded-3" style="background: #e6f4ea; width: 56px; height: 56px;">
                            <i class="bi bi-pencil-square fs-3 text-success"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm rounded-4 h-100 p-2" style="border: 1px solid #e2e8f0 !important; background: #ffffff;">
                    <div class="card-body d-flex align-items-center justify-content-between p-3">
                        <div>
                            <span class="text-muted small fw-semibold text-uppercase">Teachers</span>
                            <h2 class="fw-bold text-dark mt-1 mb-0">{{ $teachers }}</h2>
                            <span class="small text-muted">Faculty advisors</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-center rounded-3" style="background: #eef2ff; width: 56px; height: 56px;">
                            <i class="bi bi-people-fill fs-3 text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm rounded-4 h-100 p-2" style="border: 1px solid #fef3c7 !important; background: #ffffff;">
                    <div class="card-body d-flex align-items-center justify-content-between p-3">
                        <div>
                            <span class="text-muted small fw-semibold text-uppercase">Students</span>
                            <h2 class="fw-bold text-dark mt-1 mb-0">{{ $students }}</h2>
                            <span class="small text-muted">Registered advisees</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-center rounded-3" style="background: #fffbeb; width: 56px; height: 56px;">
                            <i class="bi bi-mortarboard-fill fs-3 text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif (auth()->user()->role->role == 'student')
        <!-- Student Welcome Hero Banner -->
        <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden" style="background: linear-gradient(135deg, #fef8f5 0%, #ffffff 100%); border: 1px solid #f3e4dc !important;">
            <div class="card-body p-4">
                <div class="row align-items-center g-3">
                    <div class="col-md-8">
                        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill mb-2" style="background: #fdf1ec; border: 1px solid #fcebe3;">
                            <i class="bi bi-mortarboard-fill text-brand"></i>
                            <span class="small fw-semibold text-brand">Student Guidance Dashboard</span>
                        </div>
                        <h3 class="fw-bold text-dark mb-1">Welcome back, {{ auth()->user()->name }}! 👋</h3>
                        <p class="text-muted mb-3 small">Track your guidance progress, view advisor responses, and stay updated with administrative announcements.</p>
                        <div class="d-flex flex-wrap gap-2 align-items-center">
                            <span class="badge bg-light text-dark border px-3 py-2"><i class="bi bi-card-heading text-brand me-1"></i> NIM: {{ auth()->user()->id_number ?? '-' }}</span>
                            <span class="badge bg-light text-dark border px-3 py-2"><i class="bi bi-journal-bookmark text-brand me-1"></i> Major: {{ auth()->user()->major ?? '-' }}</span>
                            <span class="badge bg-light text-dark border px-3 py-2"><i class="bi bi-building text-brand me-1"></i> Class: {{ auth()->user()->classRoom->class ?? '-' }}</span>
                        </div>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <a href="/admin/your-questions" class="btn btn-hero-primary me-2 mb-2"><i class="bi bi-plus-circle me-1"></i> View Questions</a>
                        <a href="/admin/message" class="btn btn-outline-secondary rounded-pill mb-2" style="font-size: 14px;"><i class="bi bi-chat-dots me-1"></i> Messages</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Student Metrics Cards -->
        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded-4 h-100 p-2" style="border: 1px solid #f3e4dc !important; background: #ffffff;">
                    <div class="card-body d-flex align-items-center justify-content-between p-3">
                        <div>
                            <span class="text-muted small fw-semibold text-uppercase">Your Questions</span>
                            <h2 class="fw-bold text-dark mt-1 mb-0">{{ $studentQuestion }}</h2>
                            <span class="small text-muted">Submitted guidance topics</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-center rounded-3" style="background: #fdf1ec; width: 56px; height: 56px;">
                            <i class="bi bi-question-square-fill fs-3 text-brand"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded-4 h-100 p-2" style="border: 1px solid #e2e8f0 !important; background: #ffffff;">
                    <div class="card-body d-flex align-items-center justify-content-between p-3">
                        <div>
                            <span class="text-muted small fw-semibold text-uppercase">Answers Received</span>
                            <h2 class="fw-bold text-dark mt-1 mb-0">{{ $answerYourQuestion }}</h2>
                            <span class="small text-muted">Responses from supervisor</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-center rounded-3" style="background: #e6f4ea; width: 56px; height: 56px;">
                            <i class="bi bi-chat-left-check-fill fs-3 text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif (auth()->user()->role->role == 'teacher')
        <!-- Teacher Welcome Hero Banner -->
        <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden" style="background: linear-gradient(135deg, #fef8f5 0%, #ffffff 100%); border: 1px solid #f3e4dc !important;">
            <div class="card-body p-4">
                <div class="row align-items-center g-3">
                    <div class="col-md-7">
                        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill mb-2" style="background: #fdf1ec; border: 1px solid #fcebe3;">
                            <i class="bi bi-person-badge-fill text-brand"></i>
                            <span class="small fw-semibold text-brand">Faculty Advisor Workspace</span>
                        </div>
                        <h3 class="fw-bold text-dark mb-1">Welcome back, Advisor {{ auth()->user()->name }}! 👋</h3>
                        <p class="text-muted mb-3 small">Review student thesis inquiries, provide guidance feedback, and stay updated with faculty announcements.</p>
                        <div class="d-flex flex-wrap gap-2 align-items-center">
                            <span class="badge bg-light text-dark border px-3 py-2"><i class="bi bi-card-text text-brand me-1"></i> ID / NIP: {{ auth()->user()->id_number ?? '-' }}</span>
                            <span class="badge bg-light text-dark border px-3 py-2"><i class="bi bi-mortarboard text-brand me-1"></i> Faculty / Major: {{ auth()->user()->major ?? '-' }}</span>
                        </div>
                    </div>
                    <div class="col-md-5 text-md-end">
                        <a href="/admin/questions-to-answer" class="btn btn-hero-primary me-2 mb-2"><i class="bi bi-chat-left-dots-fill me-1"></i> Questions To Answer</a>
                        <a href="/admin/mass-messaging" class="btn btn-outline-secondary rounded-pill mb-2" style="font-size: 14px;"><i class="bi bi-send-fill me-1"></i> Broadcast</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Teacher Metrics Cards -->
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 h-100 p-2" style="border: 1px solid #e2e8f0 !important; background: #ffffff;">
                    <div class="card-body d-flex align-items-center justify-content-between p-3">
                        <div>
                            <span class="text-muted small fw-semibold text-uppercase">Total Answers</span>
                            <h2 class="fw-bold text-dark mt-1 mb-0">{{ $teacherAnswer }}</h2>
                            <span class="small text-muted">Guidance responses given</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-center rounded-3" style="background: #e6f4ea; width: 56px; height: 56px;">
                            <i class="bi bi-chat-left-check-fill fs-3 text-success"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 h-100 p-2" style="border: 1px solid #f3e4dc !important; background: #ffffff;">
                    <div class="card-body d-flex align-items-center justify-content-between p-3">
                        <div>
                            <span class="text-muted small fw-semibold text-uppercase">Questions Waiting</span>
                            <h2 class="fw-bold text-dark mt-1 mb-0">{{ $questionPending }}</h2>
                            <span class="small text-muted">Pending student inquiries</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-center rounded-3" style="background: #fdf1ec; width: 56px; height: 56px;">
                            <i class="bi bi-hourglass-split fs-3 text-brand"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 h-100 p-2" style="border: 1px solid #e2e8f0 !important; background: #ffffff;">
                    <div class="card-body d-flex align-items-center justify-content-between p-3">
                        <div>
                            <span class="text-muted small fw-semibold text-uppercase">Mentored Students</span>
                            <h2 class="fw-bold text-dark mt-1 mb-0">{{ $studentMentored }}</h2>
                            <span class="small text-muted">Assigned thesis advisees</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-center rounded-3" style="background: #eef2ff; width: 56px; height: 56px;">
                            <i class="bi bi-people-fill fs-3 text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (auth()->user()->role->role == 'student')
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4" style="border: 1px solid #f3e4dc !important;">
                    <div class="card-header bg-white border-bottom p-4 d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-2">
                            <div class="p-2 rounded-3" style="background: #fdf1ec;">
                                <i class="bi bi-bell-fill text-brand"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold text-dark mb-0">Admin Announcements & Notifications</h5>
                                <span class="small text-muted">Latest updates from faculty administration</span>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        @if (session()->has('success'))
                            <div class="alert alert-success border-0 rounded-3 mb-3" role="alert">
                                <i class="bi bi-check-circle-fill me-1"></i> {{ session('success') }}
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table id="table_id" class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th width="60">No</th>
                                        <th>Title</th>
                                        <th>Notification Message</th>
                                        <th width="160">Sent Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($notifications as $notification)
                                        <tr>
                                            <td><span class="fw-semibold text-muted">{{ $loop->iteration }}</span></td>
                                            <td><span class="fw-bold text-dark">{{ $notification->title }}</span></td>
                                            <td><span class="text-secondary">{{ $notification->notification }}</span></td>
                                            <td><span class="badge bg-light text-muted border fw-normal">{{ $notification->created_at->diffForHumans() }}</span></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-4 text-muted">
                                                <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                                No announcements available right now.
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
    @elseif (auth()->user()->role->role == 'teacher')
        <div class="row g-4 mb-4">
            <!-- Faculty Announcements -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 h-100" style="border: 1px solid #f3e4dc !important;">
                    <div class="card-header bg-white border-bottom p-4 d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-2">
                            <div class="p-2 rounded-3" style="background: #fdf1ec;">
                                <i class="bi bi-bell-fill text-brand"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold text-dark mb-0">Faculty Announcements</h5>
                                <span class="small text-muted">Notifications from admin</span>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table id="table_teacher_notifications" class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th width="50">No</th>
                                        <th>Title</th>
                                        <th>Notification Message</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($notifications as $notification)
                                        <tr>
                                            <td><span class="fw-semibold text-muted">{{ $loop->iteration }}</span></td>
                                            <td><span class="fw-bold text-dark">{{ $notification->title }}</span></td>
                                            <td><span class="text-secondary small">{{ $notification->notification }}</span></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center py-4 text-muted">
                                                <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                                No faculty announcements right now.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Admin Reminders -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 h-100" style="border: 1px solid #e2e8f0 !important;">
                    <div class="card-header bg-white border-bottom p-4 d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-2">
                            <div class="p-2 rounded-3" style="background: #fef3c7;">
                                <i class="bi bi-shield-exclamation text-warning"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold text-dark mb-0">Admin Reminders</h5>
                                <span class="small text-muted">Personalized admin reminder tasks</span>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table id="table_teacher_reminders" class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th width="50">No</th>
                                        <th>Reminder Message</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($reminderMessages as $reminderMessage)
                                        <tr>
                                            <td><span class="fw-semibold text-muted">{{ $loop->iteration }}</span></td>
                                            <td><span class="text-dark fw-medium small">{{ $reminderMessage->reminder }}</span></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="text-center py-4 text-muted">
                                                <i class="bi bi-check2-circle fs-3 d-block mb-2 text-success"></i>
                                                No pending admin reminders.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
          @elseif (auth()->user()->role->role == 'admin')
        <div class="card border-0 shadow-sm rounded-4 mb-4" style="border: 1px solid #f3e4dc !important;">
            <div class="card-header bg-white border-bottom p-4 d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-2">
                    <div class="p-2 rounded-3" style="background: #fdf1ec;">
                        <i class="bi bi-bar-chart-line-fill text-brand fs-5"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold text-dark mb-0">Weekly Guidance Activity Analytics</h5>
                        <span class="small text-muted">Comparison of student questions submitted vs advisor answers per day</span>
                    </div>
                </div>
            </div>
            <div class="card-body p-4">
                <div id="chart-container" style="height: 320px; position: relative;">
                    <canvas id="question-answer-chart"></canvas>
                </div>
            </div>
        </div>
    @endif

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var ctx = document.getElementById('question-answer-chart');

                if (ctx) {
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday',
                                'Saturday'
                            ],
                            datasets: [{
                                label: 'Questions Submitted',
                                data: {!! json_encode($questionsPerDay) !!},
                                backgroundColor: '#eb5d1e',
                                borderRadius: 6,
                            }, {
                                label: 'Answers Provided',
                                data: {!! json_encode($answersPerDay) !!},
                                backgroundColor: '#22c55e',
                                borderRadius: 6,
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    precision: 0,
                                    stepSize: 1,
                                    ticks: {
                                        callback: function(value) {
                                            if (value % 1 === 0) {
                                                return value;
                                            }
                                        }
                                    }
                                }
                            },
                            maintainAspectRatio: false, 
                            responsive: true 
                        }
                    });
                } else {
                    console.error('Canvas element not found.');
                }
            });
        </script>
    @endpush
@endsection
