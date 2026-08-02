<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <!-- Brand Logo Header -->
        <div class="brand-logo d-flex align-items-center justify-content-between py-3 px-3">
            <a href="/" class="text-nowrap logo-img d-flex align-items-center gap-2 text-decoration-none">
                <div class="rounded-3 p-2 d-flex align-items-center justify-content-center shadow-sm" style="background: #eb5d1e; width: 36px; height: 36px;">
                    <i class="bi bi-mortarboard-fill text-white fs-5"></i>
                </div>
                <span class="fw-bold fs-4 text-dark" style="letter-spacing: -0.5px;">Graduance</span>
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>

        <!-- Sidebar Navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <!-- Dashboard Main Link -->
            <ul id="sidebarnav" class="mb-0">
                <li class="nav-small-cap">
                    <span class="hide-menu">Main Navigation</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::is('admin/home*') ? 'active' : '' }}" href="/admin/home" aria-expanded="false">
                        <i class="bi bi-speedometer2"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
            </ul>

            <!-- Role-Based Navigation Links -->
            <ul id="sidebarnav">
                @if (auth()->user()->role->role == 'admin')
                    <!-- ADMIN ROLE -->
                    <li class="nav-small-cap">
                        <span class="hide-menu">Master Data</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('admin/students*') ? 'active' : '' }}" href="/admin/students" aria-expanded="false">
                            <i class="bi bi-mortarboard-fill"></i>
                            <span class="hide-menu">Students</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('admin/teachers*') ? 'active' : '' }}" href="/admin/teachers" aria-expanded="false">
                            <i class="bi bi-people-fill"></i>
                            <span class="hide-menu">Teachers / Mentors</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('admin/class*') ? 'active' : '' }}" href="/admin/class" aria-expanded="false">
                            <i class="bi bi-building-fill"></i>
                            <span class="hide-menu">Classes</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('admin/archive*') ? 'active' : '' }}" href="/admin/archive" aria-expanded="false">
                            <i class="bi bi-archive-fill"></i>
                            <span class="hide-menu">Archives</span>
                        </a>
                    </li>

                    <li class="nav-small-cap">
                        <span class="hide-menu">Guidance Questions</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('admin/questions') ? 'active' : '' }}" href="/admin/questions" aria-expanded="false">
                            <i class="bi bi-chat-left-quote-fill"></i>
                            <span class="hide-menu">All Student Questions</span>
                        </a>
                    </li>

                    <li class="nav-small-cap">
                        <span class="hide-menu">System Notices</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('admin/notification*') ? 'active' : '' }}" href="/admin/notification" aria-expanded="false">
                            <i class="bi bi-bell-fill"></i>
                            <span class="hide-menu">Send Notification</span>
                        </a>
                    </li>

                @elseif (auth()->user()->role->role == 'teacher')
                    <!-- TEACHER / ADVISOR ROLE -->
                    <li class="nav-small-cap">
                        <span class="hide-menu">Topic Management</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('admin/topics*') ? 'active' : '' }}" href="/admin/topics" aria-expanded="false">
                            <i class="bi bi-journal-bookmark-fill"></i>
                            <span class="hide-menu">Thesis Topics</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('admin/archive*') ? 'active' : '' }}" href="/admin/archive" aria-expanded="false">
                            <i class="bi bi-archive-fill"></i>
                            <span class="hide-menu">Archives</span>
                        </a>
                    </li>

                    <li class="nav-small-cap">
                        <span class="hide-menu">Guidance Review</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('admin/questions-to-answer*') ? 'active' : '' }}" href="/admin/questions-to-answer" aria-expanded="false">
                            <i class="bi bi-chat-square-dots-fill"></i>
                            <span class="hide-menu">Questions To Answer</span>
                        </a>
                    </li>

                    <li class="nav-small-cap">
                        <span class="hide-menu">Advisees & Broadcast</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('admin/mentored-students*') ? 'active' : '' }}" href="/admin/mentored-students" aria-expanded="false">
                            <i class="bi bi-person-workspace"></i>
                            <span class="hide-menu">Mentored Students</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('admin/mass-messaging*') ? 'active' : '' }}" href="/admin/mass-messaging" aria-expanded="false">
                            <i class="bi bi-send-fill"></i>
                            <span class="hide-menu">Mass Messaging</span>
                        </a>
                    </li>

                    <li class="nav-small-cap">
                        <span class="hide-menu">Account Settings</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('admin/profile*') ? 'active' : '' }}" href="/admin/profile" aria-expanded="false">
                            <i class="bi bi-person-gear"></i>
                            <span class="hide-menu">Profile Settings</span>
                        </a>
                    </li>

                @elseif (auth()->user()->role->role == 'student')
                    <!-- STUDENT ROLE -->
                    @php
                        $studentId = auth()->user()->id;
                        $registrationCount = \App\Models\Registration::where('student_id', $studentId)->count();
                    @endphp

                    @if ($registrationCount > 0)
                        <li class="nav-small-cap">
                            <span class="hide-menu">Thesis Guidance</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link {{ Request::is('admin/your-questions*') ? 'active' : '' }}" href="/admin/your-questions" aria-expanded="false">
                                <i class="bi bi-chat-left-quote-fill"></i>
                                <span class="hide-menu">Your Questions</span>
                            </a>
                        </li>
                    @else
                        <li class="nav-small-cap">
                            <span class="hide-menu">Topic Registration</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link {{ Request::is('admin/registration*') ? 'active' : '' }}" href="/admin/registration" aria-expanded="false">
                                <i class="bi bi-journal-check"></i>
                                <span class="hide-menu">Select Topics</span>
                            </a>
                        </li>
                    @endif

                    <!-- Message Inbox -->
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('admin/message*') ? 'active' : '' }}" href="/admin/message" aria-expanded="false">
                            <i class="bi bi-envelope-paper-fill"></i>
                            <span class="hide-menu">Advisor Messages</span>
                            @php
                                $messageUnread = \App\Models\Message::where('student_id', auth()->user()->id)
                                    ->where('is_read', false)
                                    ->count();
                            @endphp
                            @if ($messageUnread > 0)
                                <span id="notification-badge" class="badge rounded-pill text-white ms-auto" style="background-color: var(--brand-primary); font-size: 0.7rem;">
                                    {{ $messageUnread }} New
                                </span>
                            @endif
                        </a>
                    </li>

                    <!-- Account Settings -->
                    <li class="nav-small-cap">
                        <span class="hide-menu">Account Settings</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('admin/profile*') ? 'active' : '' }}" href="/admin/profile" aria-expanded="false">
                            <i class="bi bi-person-gear"></i>
                            <span class="hide-menu">Profile Settings</span>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
</aside>
