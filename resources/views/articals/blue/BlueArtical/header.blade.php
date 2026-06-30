{{-- ═══════════════════════════════════════════════════════
     BluePeak University — Fixed Header / Navbar
     Include: @include('articals.blue.BlueArtical.header')
═══════════════════════════════════════════════════════ --}}

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
/* ─── GLOBAL CSS VARIABLES ─── */
:root {
  --c-primary:       #07294D;
  --c-primary-dark:  #001936;
  --c-primary-mid:   #0a3d6b;
  --c-primary-light: #0e5a9e;
  --c-accent:        #F5A623;
  --c-accent-dark:   #d4891a;
  --c-accent-light:  #ffc85a;
  --c-white:         #ffffff;
  --c-light:         #f0f5fb;
  --c-lighter:       #e8eff8;
  --c-text:          #1a2744;
  --c-text-muted:    #607090;
  --c-border:        rgba(7,41,77,0.12);

  --shadow-sm:  0 2px 12px rgba(7,41,77,0.08);
  --shadow-md:  0 8px 32px rgba(7,41,77,0.12);
  --shadow-lg:  0 20px 60px rgba(7,41,77,0.18);
  --shadow-xl:  0 32px 80px rgba(7,41,77,0.22);

  --radius-sm: 8px;
  --radius-md: 16px;
  --radius-lg: 24px;
  --radius-xl: 32px;

  --transition:      all 0.4s cubic-bezier(0.4,0,0.2,1);
  --transition-fast: all 0.25s ease;

  --section-py:      6rem;
  --container-max:   1280px;
  --container-px:    2rem;
  --nav-h:           80px;
}

/* ─── RESET ─── */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
html { scroll-behavior: smooth; }
body {
  font-family: 'Inter', sans-serif;
  color: var(--c-text);
  background: var(--c-white);
  overflow-x: hidden;
  line-height: 1.7;
}
h1,h2,h3,h4,h5,h6 { font-family: 'Poppins', sans-serif; line-height: 1.2; }
img { display: block; max-width: 100%; }
a { text-decoration: none; }

/* ─── HEADER ─── */
#uni-header {
  position: fixed;
  top: 0; left: 0; right: 0;
  z-index: 1000;
  background: var(--c-primary-dark);
  height: var(--nav-h);
  transition: var(--transition);
  border-bottom: 1px solid rgba(255,255,255,0.06);
}

#uni-header.scrolled {
  box-shadow: 0 8px 40px rgba(0,0,0,0.35);
  height: 68px;
  background: rgba(0,25,54,0.97);
  backdrop-filter: blur(20px);
}

/* Top announcement bar */
.uni-top-bar {
  background: var(--c-accent);
  text-align: center;
  padding: 0.4rem 1rem;
  font-size: 0.75rem;
  font-weight: 600;
  color: var(--c-primary-dark);
  position: fixed;
  top: 0; left: 0; right: 0;
  z-index: 1001;
  transition: transform 0.4s;
}

.uni-top-bar.hidden { transform: translateY(-100%); }

.uni-top-bar a { color: var(--c-primary-dark); font-weight: 700; text-decoration: underline; }

/* Push header down when top bar is visible */
body.has-topbar #uni-header { top: 32px; }
body.has-topbar .uni-nav-spacer { height: calc(var(--nav-h) + 32px); }

.uni-nav-inner {
  max-width: var(--container-max);
  margin: 0 auto;
  padding: 0 var(--container-px);
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 1rem;
}

/* ─── LOGO ─── */
.uni-logo {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  text-decoration: none;
  flex-shrink: 0;
}

.uni-logo-icon {
  width: 46px; height: 46px;
  background: var(--c-accent);
  border-radius: 12px;
  display: flex; align-items: center; justify-content: center;
  flex-shrink: 0;
  transition: var(--transition-fast);
  box-shadow: 0 4px 16px rgba(245,166,35,0.4);
}

.uni-logo:hover .uni-logo-icon { transform: rotate(-5deg) scale(1.05); }

.uni-logo-wordmark { line-height: 1.1; }

.uni-logo-name {
  font-family: 'Poppins', sans-serif;
  font-weight: 800;
  font-size: 1.15rem;
  color: var(--c-white);
  letter-spacing: -0.02em;
}

.uni-logo-name span { color: var(--c-accent); }

.uni-logo-tagline {
  font-size: 0.58rem;
  font-weight: 500;
  letter-spacing: 0.15em;
  text-transform: uppercase;
  color: rgba(255,255,255,0.45);
}

/* ─── DESKTOP NAV ─── */
.uni-nav-menu {
  display: flex;
  align-items: center;
  gap: 0;
  list-style: none;
  flex: 1;
  justify-content: center;
}

.uni-nav-item { position: relative; }

.uni-nav-link {
  display: flex;
  align-items: center;
  gap: 0.25rem;
  color: rgba(255,255,255,0.78);
  text-decoration: none;
  font-size: 0.84rem;
  font-weight: 500;
  padding: 0.5rem 0.9rem;
  border-radius: 8px;
  transition: var(--transition-fast);
  white-space: nowrap;
  letter-spacing: 0.01em;
}

.uni-nav-link:hover { color: var(--c-white); background: rgba(255,255,255,0.1); }
.uni-nav-link.active { color: var(--c-accent); }
.uni-nav-link.active::after {
  content: '';
  position: absolute;
  bottom: -4px; left: 50%;
  transform: translateX(-50%);
  width: 4px; height: 4px;
  background: var(--c-accent);
  border-radius: 50%;
}

.uni-nav-arrow { transition: transform 0.3s; flex-shrink: 0; }
.uni-nav-item:hover .uni-nav-arrow { transform: rotate(180deg); }

/* ─── MEGA MENU ─── */
.uni-mega-wrap {
  position: absolute;
  top: calc(100% + 20px);
  left: 50%;
  transform: translateX(-50%);
  min-width: 560px;
  background: var(--c-white);
  border-radius: var(--radius-lg);
  box-shadow: var(--shadow-xl);
  padding: 1.5rem;
  opacity: 0;
  visibility: hidden;
  transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
  transform-origin: top center;
  pointer-events: none;
  border-top: 3px solid var(--c-accent);
  z-index: 200;
}

.uni-mega-wrap::before {
  content: '';
  position: absolute;
  top: -8px; left: 50%;
  transform: translateX(-50%);
  border: 8px solid transparent;
  border-bottom-color: var(--c-accent);
  border-top: none;
}

.uni-nav-item:hover .uni-mega-wrap {
  opacity: 1;
  visibility: visible;
  pointer-events: all;
  transform: translateX(-50%) translateY(0);
}

.uni-mega-title {
  font-size: 0.65rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.12em;
  color: var(--c-text-muted);
  padding: 0 0.5rem 0.75rem;
  border-bottom: 1px solid var(--c-border);
  margin-bottom: 0.75rem;
}

.uni-mega-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 0.35rem;
}

.uni-mega-item {
  display: flex;
  align-items: center;
  gap: 0.65rem;
  padding: 0.7rem 0.75rem;
  border-radius: var(--radius-sm);
  text-decoration: none;
  color: var(--c-text);
  font-size: 0.82rem;
  font-weight: 500;
  transition: var(--transition-fast);
}

.uni-mega-item:hover {
  background: rgba(7,41,77,0.05);
  color: var(--c-primary);
}

.uni-mega-icon {
  width: 34px; height: 34px;
  border-radius: 8px;
  background: var(--c-light);
  display: flex; align-items: center; justify-content: center;
  font-size: 0.95rem;
  flex-shrink: 0;
  transition: var(--transition-fast);
}

.uni-mega-item:hover .uni-mega-icon { background: var(--c-accent); }

/* ─── SIMPLE DROPDOWN ─── */
.uni-dropdown {
  position: absolute;
  top: calc(100% + 16px);
  left: 0;
  background: var(--c-white);
  border-radius: var(--radius-md);
  box-shadow: var(--shadow-xl);
  min-width: 210px;
  padding: 0.6rem;
  opacity: 0;
  visibility: hidden;
  transition: all 0.3s;
  z-index: 200;
  border-top: 3px solid var(--c-accent);
  pointer-events: none;
}

.uni-nav-item:hover .uni-dropdown {
  opacity: 1;
  visibility: visible;
  pointer-events: all;
}

.uni-dd-link {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.6rem 0.9rem;
  border-radius: 8px;
  color: var(--c-text);
  text-decoration: none;
  font-size: 0.83rem;
  font-weight: 500;
  transition: var(--transition-fast);
}

.uni-dd-link:hover { background: rgba(7,41,77,0.05); color: var(--c-primary); }

.uni-dd-link::before {
  content: '';
  width: 5px; height: 5px;
  border-radius: 50%;
  background: var(--c-accent);
  flex-shrink: 0;
}

/* ─── APPLY NOW BUTTON ─── */
.uni-apply-btn {
  background: var(--c-accent);
  color: var(--c-primary-dark) !important;
  font-weight: 700 !important;
  font-family: 'Poppins', sans-serif;
  padding: 0.6rem 1.5rem !important;
  border-radius: 50px;
  font-size: 0.84rem !important;
  transition: var(--transition) !important;
  white-space: nowrap;
  box-shadow: 0 4px 20px rgba(245,166,35,0.4);
  flex-shrink: 0;
  letter-spacing: 0.01em;
  border: none;
}

.uni-apply-btn:hover {
  background: var(--c-accent-light) !important;
  transform: translateY(-2px);
  box-shadow: 0 10px 32px rgba(245,166,35,0.55) !important;
  color: var(--c-primary-dark) !important;
}

/* ─── RIGHT ACTIONS ─── */
.uni-nav-actions {
  display: flex;
  align-items: center;
  gap: 0.6rem;
  flex-shrink: 0;
}

.uni-nav-tel {
  display: flex;
  align-items: center;
  gap: 0.4rem;
  color: rgba(255,255,255,0.6);
  font-size: 0.78rem;
  font-weight: 500;
  transition: color 0.2s;
}

.uni-nav-tel:hover { color: var(--c-accent); }

/* ─── HAMBURGER ─── */
.uni-hamburger {
  display: none;
  flex-direction: column;
  gap: 5px;
  cursor: pointer;
  padding: 0.5rem;
  background: none;
  border: none;
  flex-shrink: 0;
}

.uni-hamburger span {
  display: block;
  width: 24px; height: 2px;
  background: var(--c-white);
  border-radius: 2px;
  transition: all 0.35s;
}

.uni-hamburger.open span:nth-child(1) { transform: rotate(45deg) translate(5px, 5px); }
.uni-hamburger.open span:nth-child(2) { opacity: 0; transform: translateX(-8px); }
.uni-hamburger.open span:nth-child(3) { transform: rotate(-45deg) translate(5px, -5px); }

/* ─── MOBILE NAV ─── */
#uni-mobile-nav {
  display: none;
  position: fixed;
  inset: 0;
  z-index: 1100;
  background: rgba(0,10,25,0.65);
  backdrop-filter: blur(6px);
}

#uni-mobile-nav.open { display: block; }

.uni-mobile-panel {
  position: absolute;
  top: 0; left: 0; bottom: 0;
  width: min(340px, 90vw);
  background: var(--c-primary-dark);
  overflow-y: auto;
  transform: translateX(-100%);
  transition: transform 0.4s cubic-bezier(0.4,0,0.2,1);
}

#uni-mobile-nav.open .uni-mobile-panel { transform: translateX(0); }

.uni-mobile-head {
  padding: 1.25rem 1.5rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
  border-bottom: 1px solid rgba(255,255,255,0.08);
  background: rgba(0,0,0,0.2);
}

.uni-mobile-close {
  background: rgba(255,255,255,0.1);
  border: 1px solid rgba(255,255,255,0.15);
  border-radius: 50%;
  width: 36px; height: 36px;
  color: white;
  cursor: pointer;
  display: flex; align-items: center; justify-content: center;
  transition: var(--transition-fast);
}

.uni-mobile-close:hover { background: rgba(255,255,255,0.2); }

.uni-mobile-links { padding: 1rem 0.75rem; }

.uni-mobile-link {
  display: flex;
  align-items: center;
  gap: 0.65rem;
  color: rgba(255,255,255,0.75);
  text-decoration: none;
  font-size: 0.9rem;
  font-weight: 500;
  padding: 0.85rem 1rem;
  border-radius: 10px;
  transition: var(--transition-fast);
  margin-bottom: 0.2rem;
}

.uni-mobile-link:hover { background: rgba(255,255,255,0.08); color: white; }
.uni-mobile-link.active { color: var(--c-accent); background: rgba(245,166,35,0.1); }

.uni-mobile-sub {
  padding: 0.35rem 1rem 0.35rem 2.5rem;
  font-size: 0.8rem;
  color: rgba(255,255,255,0.5);
  display: block;
  border-radius: 8px;
  transition: var(--transition-fast);
  text-decoration: none;
}

.uni-mobile-sub:hover { color: rgba(255,255,255,0.8); background: rgba(255,255,255,0.05); }

.uni-mobile-divider {
  height: 1px;
  background: rgba(255,255,255,0.07);
  margin: 0.75rem 1rem;
}

.uni-mobile-apply {
  display: block;
  margin: 1rem;
  background: var(--c-accent);
  color: var(--c-primary-dark);
  text-align: center;
  font-weight: 700;
  font-family: 'Poppins', sans-serif;
  padding: 0.9rem;
  border-radius: 12px;
  text-decoration: none;
  font-size: 0.9rem;
  transition: var(--transition-fast);
}

.uni-mobile-apply:hover { background: var(--c-accent-light); }

/* ─── NAV SPACER ─── */
.uni-nav-spacer { height: var(--nav-h); }

/* ─── PROGRESS BAR ─── */
#uni-progress {
  position: fixed;
  top: 0; left: 0;
  height: 3px;
  background: linear-gradient(90deg, var(--c-accent), var(--c-accent-light));
  z-index: 2000;
  transition: width 0.1s;
  width: 0;
}

/* ─── RESPONSIVE ─── */
@media(max-width: 1100px) {
  .uni-nav-menu { display: none; }
  .uni-nav-tel { display: none; }
  .uni-apply-btn { display: none; }
  .uni-hamburger { display: flex; }
}
</style>

<div id="uni-progress"></div>

{{-- Top announcement bar --}}
<div class="uni-top-bar" id="uni-top-bar">
  🎓 Admissions 2026 Open! — Applications now being accepted for B.Tech, MBBS, MBA &amp; more.
  <a href="#apply"> Apply Now ↗</a>
  &nbsp;&nbsp;
  <button onclick="document.getElementById('uni-top-bar').classList.add('hidden');document.body.classList.remove('has-topbar');"
    style="background:none;border:none;cursor:pointer;color:var(--c-primary-dark);font-size:1rem;margin-left:1rem;opacity:0.6;">✕</button>
</div>

<header id="uni-header">
  <nav class="uni-nav-inner">

    {{-- Logo --}}
    <a href="/" class="uni-logo">
      <div class="uni-logo-icon">
        <svg width="26" height="26" fill="none" viewBox="0 0 32 32">
          <path d="M16 3L3 10l13 7 13-7L16 3z" fill="var(--c-primary-dark)" stroke="var(--c-primary-dark)" stroke-width="1"/>
          <path d="M3 22l13 7 13-7" stroke="var(--c-primary-dark)" stroke-width="2.5" stroke-linecap="round"/>
          <path d="M3 16l13 7 13-7" stroke="var(--c-primary-dark)" stroke-width="2.5" stroke-linecap="round"/>
        </svg>
      </div>
      <div class="uni-logo-wordmark">
        <div class="uni-logo-name">Blue<span>Peak</span></div>
        <div class="uni-logo-tagline">University of Excellence</div>
      </div>
    </a>

    {{-- Desktop Navigation --}}
    <ul class="uni-nav-menu">

      <li class="uni-nav-item">
        <a href="/" class="uni-nav-link active">Home</a>
      </li>

      <li class="uni-nav-item">
        <a href="#about" class="uni-nav-link">
          About
          <svg class="uni-nav-arrow" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="m6 9 6 6 6-6"/></svg>
        </a>
        <div class="uni-dropdown">
          <a href="#" class="uni-dd-link">About University</a>
          <a href="#" class="uni-dd-link">Vision &amp; Mission</a>
          <a href="#" class="uni-dd-link">Leadership &amp; Board</a>
          <a href="#" class="uni-dd-link">Accreditations</a>
          <a href="#" class="uni-dd-link">Campus Infrastructure</a>
        </div>
      </li>

      <li class="uni-nav-item">
        <a href="#faculties" class="uni-nav-link">
          Academics
          <svg class="uni-nav-arrow" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="m6 9 6 6 6-6"/></svg>
        </a>
        <div class="uni-mega-wrap">
          <div class="uni-mega-title">Explore Our Faculties &amp; Departments</div>
          <div class="uni-mega-grid">
            <a href="#" class="uni-mega-item"><div class="uni-mega-icon">⚙️</div><span>Engineering &amp; Tech</span></a>
            <a href="#" class="uni-mega-item"><div class="uni-mega-icon">🏥</div><span>Medical Sciences</span></a>
            <a href="#" class="uni-mega-item"><div class="uni-mega-icon">💼</div><span>Business &amp; Commerce</span></a>
            <a href="#" class="uni-mega-item"><div class="uni-mega-icon">🎨</div><span>Arts &amp; Design</span></a>
            <a href="#" class="uni-mega-item"><div class="uni-mega-icon">🔬</div><span>Pure Sciences</span></a>
            <a href="#" class="uni-mega-item"><div class="uni-mega-icon">⚖️</div><span>Law &amp; Governance</span></a>
            <a href="#" class="uni-mega-item"><div class="uni-mega-icon">💻</div><span>Computer Science</span></a>
            <a href="#" class="uni-mega-item"><div class="uni-mega-icon">📚</div><span>Education</span></a>
            <a href="#" class="uni-mega-item"><div class="uni-mega-icon">🌍</div><span>Social Sciences</span></a>
          </div>
        </div>
      </li>

      <li class="uni-nav-item">
        <a href="#programs" class="uni-nav-link">
          Admissions
          <svg class="uni-nav-arrow" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="m6 9 6 6 6-6"/></svg>
        </a>
        <div class="uni-dropdown">
          <a href="#apply" class="uni-dd-link">How to Apply</a>
          <a href="#" class="uni-dd-link">Fee Structure</a>
          <a href="#" class="uni-dd-link">Scholarships</a>
          <a href="#" class="uni-dd-link">Important Dates</a>
          <a href="#" class="uni-dd-link">International Students</a>
        </div>
      </li>

      <li class="uni-nav-item">
        <a href="#gallery" class="uni-nav-link">Gallery</a>
      </li>

      <li class="uni-nav-item">
        <a href="#blog" class="uni-nav-link">News</a>
      </li>

      <li class="uni-nav-item">
        <a href="#contact" class="uni-nav-link">Contact</a>
      </li>

    </ul>

    {{-- Right actions --}}
    <div class="uni-nav-actions">
      <a href="tel:+919000000000" class="uni-nav-tel">
        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 11 19.79 19.79 0 0 1 1.61 2.4 2 2 0 0 1 3.58.22h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 7.91a16 16 0 0 0 6.18 6.18l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 14.92z"/>
        </svg>
        +91 90000 00000
      </a>
      <a href="#apply" class="uni-nav-link uni-apply-btn">Apply Now ↗</a>
    </div>

    {{-- Hamburger --}}
    <button class="uni-hamburger" id="uni-hamburger" aria-label="Open menu">
      <span></span><span></span><span></span>
    </button>

  </nav>
</header>

{{-- Mobile Navigation --}}
<div id="uni-mobile-nav">
  <div class="uni-mobile-panel">

    <div class="uni-mobile-head">
      <div style="font-family:'Poppins',sans-serif;font-weight:800;font-size:1rem;color:white;">
        Blue<span style="color:var(--c-accent);">Peak</span> University
      </div>
      <button class="uni-mobile-close" id="uni-mobile-close">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
          <path d="M18 6 6 18M6 6l12 12"/>
        </svg>
      </button>
    </div>

    <div class="uni-mobile-links">
      <a href="/" class="uni-mobile-link active">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
        Home
      </a>
      <a href="#about" class="uni-mobile-link">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4M12 8h.01"/></svg>
        About University
      </a>
      <a href="#faculties" class="uni-mobile-link">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22 10v6M2 10l10-5 10 5-10 5-10-5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
        Academics
      </a>
      <a href="#" class="uni-mobile-sub">Engineering &amp; Technology</a>
      <a href="#" class="uni-mobile-sub">Medical Sciences</a>
      <a href="#" class="uni-mobile-sub">Business &amp; Commerce</a>
      <div class="uni-mobile-divider"></div>
      <a href="#programs" class="uni-mobile-link">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
        Admissions
      </a>
      <a href="#gallery" class="uni-mobile-link">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
        Gallery
      </a>
      <a href="#blog" class="uni-mobile-link">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-2 2zm0 0a2 2 0 0 1-2-2v-9c0-1.1.9-2 2-2h2"/><path d="M18 14h-8M15 18h-5M10 6h8v4h-8z"/></svg>
        News &amp; Events
      </a>
      <a href="#contact" class="uni-mobile-link">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 11 19.79 19.79 0 0 1 1.61 2.4 2 2 0 0 1 3.58.22h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 7.91a16 16 0 0 0 6.18 6.18l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 14.92z"/></svg>
        Contact
      </a>
    </div>

    <a href="#apply" class="uni-mobile-apply">Apply Now — Admissions 2026 ↗</a>

    <div style="padding: 1rem 1.5rem; border-top: 1px solid rgba(255,255,255,0.07); margin-top: 0.5rem;">
      <div style="font-size: 0.72rem; color: rgba(255,255,255,0.35); margin-bottom: 0.5rem; text-transform: uppercase; letter-spacing: 0.1em;">Contact</div>
      <div style="font-size: 0.82rem; color: rgba(255,255,255,0.6);">📞 +91 90000 00000</div>
      <div style="font-size: 0.82rem; color: rgba(255,255,255,0.6); margin-top: 0.25rem;">📧 admissions@bluepeak.edu.in</div>
    </div>

  </div>
</div>

<div class="uni-nav-spacer"></div>

<script>
(function () {
  // Top bar
  const topBar = document.getElementById('uni-top-bar');
  if (topBar) document.body.classList.add('has-topbar');

  // Progress bar
  window.addEventListener('scroll', () => {
    const doc = document.documentElement;
    const pct = (doc.scrollTop / (doc.scrollHeight - doc.clientHeight)) * 100;
    document.getElementById('uni-progress').style.width = pct + '%';
  });

  // Header scroll
  const hdr = document.getElementById('uni-header');
  window.addEventListener('scroll', () => {
    hdr.classList.toggle('scrolled', window.scrollY > 30);
  });

  // Mobile nav
  const mobileNav = document.getElementById('uni-mobile-nav');
  const hamburger  = document.getElementById('uni-hamburger');
  const closeBtn   = document.getElementById('uni-mobile-close');

  hamburger.addEventListener('click', () => {
    mobileNav.classList.add('open');
    hamburger.classList.add('open');
    document.body.style.overflow = 'hidden';
  });

  function closeMobileNav() {
    mobileNav.classList.remove('open');
    hamburger.classList.remove('open');
    document.body.style.overflow = '';
  }

  closeBtn.addEventListener('click', closeMobileNav);
  mobileNav.addEventListener('click', e => { if (e.target === mobileNav) closeMobileNav(); });
  document.querySelectorAll('.uni-mobile-link, .uni-mobile-apply').forEach(l => l.addEventListener('click', closeMobileNav));
})();
</script>
