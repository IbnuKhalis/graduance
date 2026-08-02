<header class="app-header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <ul class="navbar-nav align-items-center">
            <li class="nav-item d-block d-xl-none">
                <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                    <i class="ti ti-menu-2"></i>
                </a>
            </li>
            <li class="nav-item d-none d-md-flex align-items-center ms-2">
                <span class="badge rounded-pill text-brand d-inline-flex align-items-center gap-2 px-3 py-2 fw-semibold" style="background: #fdf1ec; border: 1px solid #fcebe3; font-size: 0.8rem; line-height: 1;">
                    <i class="bi bi-shield-lock-fill text-brand fs-6"></i>
                    <span>{{ ucfirst(auth()->user()->role->role ?? 'User') }} Workspace</span>
                </span>
            </li>
        </ul>

        <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end gap-2">
                <!-- User Name & Email Info (Left of Avatar) -->
                <li class="nav-item text-end d-none d-sm-block me-1">
                    <span class="fw-bold text-dark d-block small lh-1 mb-1">{{ auth()->user()->name }}</span>
                    <span class="text-muted d-block small lh-1" style="font-size: 0.72rem;">{{ auth()->user()->email }}</span>
                </li>

                <!-- Profile Dropdown Avatar -->
                <li class="nav-item dropdown">
                    <a class="nav-link nav-icon-hover p-0" href="javascript:void(0)" id="drop2"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        @if (auth()->user()->photo)
                            <img src="{{ asset('storage/' . auth()->user()->photo) }}" alt="Photo Profile"
                                class="rounded-circle object-fit-cover border" width="38" height="38">
                        @else
                            <img src="/admin/assets/images/profile/user-1.jpg" alt="Photo Profile"
                                class="rounded-circle object-fit-cover border" width="38" height="38">
                        @endif
                    </a>

                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up shadow-lg rounded-4 border-0 p-3" aria-labelledby="drop2" style="min-width: 250px;">
                        <div class="message-body">
                            <!-- Dropdown User Header -->
                            <div class="d-flex align-items-center gap-3 pb-3 mb-2 border-bottom">
                                @if (auth()->user()->photo)
                                    <img src="{{ asset('storage/' . auth()->user()->photo) }}" alt="Photo Profile"
                                        class="rounded-circle border p-1 object-fit-cover" width="44" height="44">
                                @else
                                    <img src="/admin/assets/images/profile/user-1.jpg" alt="Photo Profile"
                                        class="rounded-circle border p-1 object-fit-cover" width="44" height="44">
                                @endif
                                <div>
                                    <h6 class="fw-bold text-dark mb-0 small">{{ auth()->user()->name }}</h6>
                                    <span class="text-muted d-block small mb-1" style="font-size: 0.72rem;">{{ auth()->user()->email }}</span>
                                    <span class="badge text-white small" style="background-color: var(--brand-primary); font-size: 0.68rem;">
                                        {{ ucfirst(auth()->user()->role->role ?? 'User') }}
                                    </span>
                                </div>
                            </div>

                            <!-- Menu Items -->
                            <a href="#" class="d-flex align-items-center gap-2 dropdown-item rounded-3 py-2 small text-danger"
                                onclick="event.preventDefault(); 
                                Swal.fire({
                                    title: 'Sign Out Account?',
                                    text: 'Are you sure you want to log out of your session?',
                                    icon: 'question',
                                    showCancelButton: true,
                                    reverseButtons: true,
                                    buttonsStyling: false,
                                    confirmButtonText: 'Yes, Sign Out',
                                    cancelButtonText: 'Cancel',
                                    customClass: {
                                        popup: 'rounded-4 p-4 shadow-lg border-0',
                                        confirmButton: 'btn btn-primary-confirm ms-2',
                                        cancelButton: 'btn btn-ghost-cancel'
                                    }
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        document.getElementById('logout-form').submit();
                                    }
                                });">
                                <i class="bi bi-box-arrow-right fs-6"></i>
                                <span>Sign Out</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>
