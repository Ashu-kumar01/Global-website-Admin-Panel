<!-- ── TOPBAR ── -->
<header class="topbar">
    <!-- Toggle -->
    <button class="btn-toggle" id="sidebarToggle" aria-label="Toggle sidebar">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Breadcrumb -->
    {{-- <div class="topbar-breadcrumb">
        <i class="fas fa-home" style="font-size:.7rem;color:var(--grey-400);"></i>
        <span class="bc-sep">/</span>
        <span class="bc-current">Dashboard</span>
    </div> --}}

    <!-- Search -->
    {{-- <div class="topbar-search">
        <i class="fas fa-magnifying-glass"></i>
        <input type="text" placeholder="Search students, courses, reports…" />
    </div> --}}

    <!-- Right actions -->
    <div class="topbar-actions">

        {{-- <!-- Notifications -->
        <button class="topbar-btn" aria-label="Notifications">
            <i class="fas fa-bell"></i>
            <span class="notif-badge"></span>
        </button>

        <!-- Messages -->
        <button class="topbar-btn" aria-label="Messages">
            <i class="fas fa-envelope"></i>
        </button>

        <!-- Help -->
        <button class="topbar-btn" aria-label="Help" style="margin-right:6px;">
            <i class="fas fa-circle-question"></i>
        </button> --}}

        <!-- Preview -->
        <a href="{{ route('admin.preview') }}" target="_blank" rel="noopener" class="btn-save topbar-btn" aria-label="Preview site" style="text-decoration:none;display:inline-flex;align-items:center;gap:6px;padding:0 14px;font-size:.82rem;font-weight:600;">
            <i class="fas fa-eye"></i> Preview
        </a>

        <!-- Profile -->
        <div class="profile-wrap">
            <button class="profile-btn" id="profileBtn" aria-expanded="false">
                <div class="profile-avatar">AP</div>
                <div class="profile-info">
                    <div class="p-name">
                        {{ strtoupper(strlen($user->organisation_name) > 10 ? substr($user->organisation_name, 0, 10) . '...' : strtoupper($user->organisation_name)) }}
                    </div>
                    <div class="p-role">Administrator</div>
                </div>
                <i class="fas fa-chevron-down caret"></i>
            </button>

            <div class="profile-dropdown" id="profileDropdown">
                <div class="pd-header">
                    <div class="pd-name">Admin Portal</div>
                    <div class="pd-email">{{ $user->email }}</div>
                </div>
                <div class="pd-body">
                    <a href="{{ route('admin.profile') }}"><i class="fas fa-user"></i> My Profile</a>
                    <a href="{{ route('admin.password.edit') }}"><i class="fas fa-shield-halved"></i> Change
                        Password</a>
                    {{-- <a href="{{ route('admin.account-settings') }}"><i class="fas fa-gear"></i> Account Settings</a> --}}
                </div>
                <div class="pd-footer pd-body">
                    <a href="{{ route('logout') }}"><i class="fas fa-right-from-bracket"></i> Logout</a>
                </div>
            </div>
        </div>

    </div><!-- .topbar-actions -->
</header><!-- .topbar -->
