<aside class="sidebar" id="sidebar">

    <!-- Brand -->
    <div class="sidebar-brand">
        {{-- {{ dd(auth()->user()->name) }} --}}
        <div class="brand-icon"> <img src="{{ $user && $user->logo ? asset($user->logo) : asset('logo.png') }}"
                alt="logo" width="45px" height="45px">
        </div>
        <div class="brand-text">
            <div class="brand-name">
                {{ strtoupper(strlen($user->organisation_name) > 20 ? substr($user->organisation_name, 0, 20) . '...' : strtoupper($user->organisation_name)) }}
            </div>
            <div class="brand-sub">Admin</div>
        </div>
    </div>

    <!-- Nav -->
    <nav class="sidebar-nav">
        <ul style="list-style:none;padding:0;margin:0;">

            <!-- Dashboard -->
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}">
                    <div class="nav-link-wrap active" data-tooltip="Dashboard">
                        <span class="nav-icon"><i class="fas fa-gauge-high"></i></span>
                        <span class="nav-label">Dashboard</span>
                    </div>
                </a>
            </li>

            <!-- Home Page Builder -->
            <li class="nav-item">
                <a href="{{ route('admin.home-builder') }}">
                    <div class="nav-link-wrap" data-tooltip="Home Page Builder" onclick="setActive(this)">
                        <span class="nav-icon"><i class="fas fa-wand-magic-sparkles"></i></span>
                        <span class="nav-label">Home Page Builder</span>
                    </div>
                </a>
            </li>

            <!-- ── ACADEMIC section ── -->
            <div class="nav-section-label">Academic</div>

            <!-- Students (L1 → L2 → L3) -->
            <li class="nav-item">
                <div class="nav-link-wrap" data-tooltip="Students" onclick="toggleNav(this)">
                    <span class="nav-icon"><i class="fas fa-user-graduate"></i></span>
                    <span class="nav-label">Layout</span>
                    <i class="fas fa-chevron-right nav-arrow"></i>
                </div>
                <ul class="nav-dropdown">

                    <!-- Student Details L2 -->
                    <li class="nav-item">
                        <div class="nav-link-wrap" onclick="toggleNav(this)">
                            <span class="nav-icon"><i class="fas fa-id-card"></i></span>
                            <span class="nav-label">Header</span>
                            <i class="fas fa-chevron-right nav-arrow"></i>
                        </div>
                        <ul class="nav-dropdown-l2">
                            <li>
                                <a href="{{ route('admin.menu') }}">
                                    <div class="nav-link-wrap" onclick="setActive(this)"><span class="nav-label">Menu
                                            Setup</span></div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.ribbon') }}">
                                    <div class="nav-link-wrap" onclick="setActive(this)"><span class="nav-label">Highlight
                                            Ribbon</span></div>
                                </a>
                            </li>

                        </ul>
                    </li>
                    {{-- <li class="nav-item">
                        <div class="nav-link-wrap" onclick="toggleNav(this)">
                            <span class="nav-icon"><i class="fas fa-id-card"></i></span>
                            <span class="nav-label">Header</span>
                            <i class="fas fa-chevron-right nav-arrow"></i>
                        </div>
                        <ul class="nav-dropdown-l2">
                            <li>
                                <div class="nav-link-wrap" onclick="setActive(this)"><span class="nav-label">Academic
                                        Info</span></div>
                            </li>
                            <li>
                                <div class="nav-link-wrap" onclick="setActive(this)"><span
                                        class="nav-label">Attendance</span></div>
                            </li>
                            <li>
                                <div class="nav-link-wrap" onclick="setActive(this)"><span
                                        class="nav-label">Performance</span></div>
                            </li>
                        </ul>
                    </li> --}}
                </ul>
            </li>

            {{-- <li class="nav-item">
                <div class="nav-link-wrap" data-tooltip="Leader" onclick="toggleNav(this)">
                    <span class="nav-icon"><i class="fas fa-user-tie"></i></span>
                    <span class="nav-label">Leader</span>
                    <i class="fas fa-chevron-right nav-arrow"></i>
                </div>
                <ul class="nav-dropdown">
                    <li class="nav-item">
                        <div class="nav-link-wrap"data-tooltip="Vice Chancellor" onclick="setActive(this)">

                            <span class="nav-label">Vice Chancellor</span>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class="nav-link-wrap"data-tooltip="Executive Directors & Pro Chancellor"
                            onclick="setActive(this)">

                            <span class="nav-label">Executive Directors & Pro Chancellor</span>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class="nav-link-wrap"data-tooltip="Categories" onclick="setActive(this)">

                            <span class="nav-label">Categories</span>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class="nav-link-wrap" data-tooltip="Registar" onclick="setActive(this)">

                            <span class="nav-label">Registar</span>
                        </div>
                    </li>
                </ul>
            </li> --}}
            <li class="nav-item">
                <div class="nav-link-wrap" data-tooltip="Leader" onclick="toggleNav(this)">

                    <span class="nav-icon"><i class="fas fa-circle-half-stroke"></i></span>
                    <span class="nav-label">Appearance</span>
                    <i class="fas fa-chevron-right nav-arrow"></i>
                </div>
                <ul class="nav-dropdown">
                    <li class="nav-item">
                        <div class="nav-link-wrap" onclick="toggleNav(this)">
                            <span class="nav-icon"><i class="fas fa-house"></i></span>
                            <span class="nav-label">Home Page</span>
                            <i class="fas fa-chevron-right nav-arrow"></i>
                        </div>
                        <ul class="nav-dropdown-l2">
                            <li>
                                <a href="{{ route('admin.landing-sections') }}">
                                    <div class="nav-link-wrap" onclick="setActive(this)"><span class="nav-label">Landing
                                            Section</span></div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.about-section') }}">
                                    <div class="nav-link-wrap" onclick="setActive(this)"><span class="nav-label">About
                                            Section</span></div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.WhyChooseUs') }}">
                                    <div class="nav-link-wrap" onclick="setActive(this)"><span class="nav-label">Why Choose Us</span></div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.courses') }}">
                                    <div class="nav-link-wrap" onclick="setActive(this)"><span class="nav-label">Courses</span></div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.admission-process') }}">
                                    <div class="nav-link-wrap" onclick="setActive(this)"><span class="nav-label">Admission Process</span></div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.placement') }}">
                                    <div class="nav-link-wrap" onclick="setActive(this)"><span class="nav-label">Placement</span></div>
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </li>



            {{-- <li class="nav-item">
                <div class="nav-link-wrap" data-tooltip="Campus Buzz" onclick="setActive(this)">
                    <span class="nav-icon"><i class="fas fa-clipboard-question"></i></span>
                    <span class="nav-label">Campus Buzz</span>
                </div>
            </li> --}}

            <!-- Logout -->
            <li class="nav-item" style="margin-top:8px;">
                <a href="{{ route('logout') }}">
                    <div class="nav-link-wrap" data-tooltip="Logout" style="--text-clr: #ef4444;"
                        onclick="setActive(this)">
                        <span class="nav-icon" style="color:rgba(239,68,68,.7);"><i
                                class="fas fa-right-from-bracket"></i></span>
                        <span class="nav-label" style="color:rgba(239,68,68,.8);">Logout</span>
                    </div>
                </a>
            </li>
        </ul>
    </nav>

    <!-- User Footer -->
    <div class="sidebar-footer">
        <div class="sidebar-user">

            <div class="user-av">
                {{ collect(explode(' ', $user->organisation_name))->filter()->map(fn($word) => strtoupper(substr($word, 0, 1)))->take(2)->implode('') }}
            </div>
            <div class="user-info">
                <div class="user-name">{{ strtoupper($user->organisation_name) }}</div>
                <div class="user-role">Admin</div>
            </div>
        </div>
    </div>

</aside><!-- .sidebar -->
