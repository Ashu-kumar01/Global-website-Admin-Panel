<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=1280" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Page Title -->
    <title>@yield('title', 'Admin Portal ')</title>

    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous"> --}}
    <!-- Favicon -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}?v=3" />

    <!-- ── Libraries ─────────────────────────────────── -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600&display=swap"
        rel="stylesheet" />
</head>

<body>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    <div class="app-shell">
        @include('adminlayout.sidebar')
        <div class="main-area" id="mainArea">
            @include('adminlayout.header')
            @yield('adminContent')
        </div>

    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

    <script>
        /* ─────────────────────────────────────────────
                                                                                1. SIDEBAR TOGGLE
                                                                            ───────────────────────────────────────────── */
        const sidebar = document.getElementById('sidebar');
        const mainArea = document.getElementById('mainArea');
        const toggleBtn = document.getElementById('sidebarToggle');
        const overlay = document.getElementById('sidebarOverlay');

        let isMobile = () => false;

        toggleBtn.addEventListener('click', () => {
            if (isMobile()) {
                // Mobile: slide in/out
                sidebar.classList.toggle('mobile-open');
                overlay.classList.toggle('show');
            } else {
                // Desktop: collapse/expand width
                sidebar.classList.toggle('collapsed');
                mainArea.classList.toggle('expanded');
            }
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.remove('mobile-open');
            overlay.classList.remove('show');
        });

        window.addEventListener('resize', () => {
            if (!isMobile()) {
                sidebar.classList.remove('mobile-open');
                overlay.classList.remove('show');
            }
        });

        /* ─────────────────────────────────────────────
           2. MULTI-LEVEL NAV DROPDOWN TOGGLE
        ───────────────────────────────────────────── */
        function toggleNav(el) {
            // Find the immediate next sibling dropdown
            const dropdown = el.nextElementSibling;
            if (!dropdown) return;

            const isOpen = dropdown.classList.contains('open');

            // If it's a L1 nav-link-wrap (direct child of ul), close ALL sibling L1 dropdowns
            if (dropdown.classList.contains('nav-dropdown')) {
                document.querySelectorAll('.nav-dropdown.open').forEach(d => {
                    if (d !== dropdown) {
                        d.classList.remove('open');
                        d.previousElementSibling.classList.remove('open');
                    }
                });
            }

            // Toggle the clicked one
            dropdown.classList.toggle('open', !isOpen);
            el.classList.toggle('open', !isOpen);
        }

        /* ─────────────────────────────────────────────
           3. ACTIVE STATE
        ───────────────────────────────────────────── */
        function setActive(el) {
            document.querySelectorAll('.nav-link-wrap.active').forEach(a => a.classList.remove('active'));
            el.classList.add('active');
        }

        // Allow plain links inside .nav-link-wrap with no dropdown
        document.querySelectorAll('.nav-link-wrap:not([onclick])').forEach(el => {
            el.addEventListener('click', function() {
                setActive(this);
            });
        });

        /* ─────────────────────────────────────────────
           4. PROFILE DROPDOWN
        ───────────────────────────────────────────── */
        const profileBtn = document.getElementById('profileBtn');
        const profileDropdown = document.getElementById('profileDropdown');

        profileBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            const isShown = profileDropdown.classList.toggle('show');
            profileBtn.setAttribute('aria-expanded', isShown);
        });

        document.addEventListener('click', () => {
            profileDropdown.classList.remove('show');
            profileBtn.setAttribute('aria-expanded', 'false');
        });

        profileDropdown.addEventListener('click', e => e.stopPropagation());

        /* ─────────────────────────────────────────────
           5. LIVE DATE
        ───────────────────────────────────────────── */
        const dateEl = document.getElementById('currentDate');
        if (dateEl) {
            const now = new Date();
            dateEl.textContent = now.toLocaleDateString('en-IN', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
        }

        /* ─────────────────────────────────────────────
           6. SIDEBAR TOOLTIP — inject data-tooltip on all collapsed items
        ───────────────────────────────────────────── */
        document.querySelectorAll('.nav-link-wrap').forEach(el => {
            if (!el.dataset.tooltip) {
                const label = el.querySelector('.nav-label');
                if (label) el.dataset.tooltip = label.textContent.trim();
            }
        });
    </script>

</body>
@stack('scripts')

</html>
