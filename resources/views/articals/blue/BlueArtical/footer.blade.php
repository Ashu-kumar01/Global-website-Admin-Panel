{{-- ═══════════════════════════════════════════════════════
     BluePeak University — Footer
     Include: @include('articals.blue.BlueArtical.footer')
═══════════════════════════════════════════════════════ --}}

<style>
/* ════════════════════════════════════════
   UNIVERSITY FOOTER
════════════════════════════════════════ */
#uni-footer {
  background: var(--c-primary-dark, #001936);
  position: relative;
  overflow: hidden;
}

/* Decorative top accent */
.uni-footer-accent {
  height: 4px;
  background: linear-gradient(90deg,
    var(--c-accent, #F5A623) 0%,
    var(--c-accent-light, #ffc85a) 30%,
    var(--c-primary-light, #0e5a9e) 60%,
    var(--c-accent, #F5A623) 100%
  );
  background-size: 200% auto;
  animation: shimmer-bg 4s linear infinite;
}

@keyframes shimmer-bg {
  0%  { background-position: -200% center; }
  100%{ background-position:  200% center; }
}

/* Decorative background circles */
.uni-footer-bg-deco {
  position: absolute;
  pointer-events: none;
  user-select: none;
}

.uni-footer-bg-deco:nth-child(2) {
  top: -80px; right: -80px;
  width: 300px; height: 300px;
  border-radius: 50%;
  background: radial-gradient(ellipse, rgba(245,166,35,.06) 0%, transparent 65%);
}

.uni-footer-bg-deco:nth-child(3) {
  bottom: 40px; left: -60px;
  width: 250px; height: 250px;
  border-radius: 50%;
  background: radial-gradient(ellipse, rgba(7,41,77,.5) 0%, transparent 65%);
}

/* ─── NEWSLETTER STRIP ─── */
.uni-footer-nl-strip {
  background: rgba(245,166,35,.08);
  border-top: 1px solid rgba(245,166,35,.15);
  border-bottom: 1px solid rgba(255,255,255,.06);
  padding: 2.5rem 0;
}

.uni-footer-nl-inner {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 2rem;
  align-items: center;
}

.uni-footer-nl-text {}

.uni-footer-nl-title {
  font-family: 'Poppins', sans-serif;
  font-weight: 700;
  font-size: 1.2rem;
  color: white;
  margin-bottom: 0.4rem;
}

.uni-footer-nl-sub {
  font-size: 0.82rem;
  color: rgba(255,255,255,.45);
}

.uni-footer-nl-form {
  display: flex;
  gap: 0.6rem;
}

.uni-footer-nl-input {
  flex: 1;
  background: rgba(255,255,255,.08);
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 10px;
  padding: 0.7rem 1rem;
  font-size: 0.85rem;
  color: white;
  outline: none;
  font-family: 'Inter', sans-serif;
  transition: border-color .2s;
}

.uni-footer-nl-input::placeholder { color: rgba(255,255,255,.3); }
.uni-footer-nl-input:focus { border-color: rgba(245,166,35,.5); }

.uni-footer-nl-btn {
  background: var(--c-accent, #F5A623);
  color: var(--c-primary-dark, #001936);
  border: none;
  border-radius: 10px;
  padding: 0.7rem 1.4rem;
  font-family: 'Poppins', sans-serif;
  font-weight: 700;
  font-size: 0.82rem;
  cursor: pointer;
  transition: all .25s;
  white-space: nowrap;
}

.uni-footer-nl-btn:hover { background: var(--c-accent-light, #ffc85a); transform: translateY(-1px); }

/* ─── MAIN FOOTER ─── */
.uni-footer-main {
  padding: 4rem 0 2.5rem;
  position: relative;
  z-index: 2;
}

.uni-footer-grid {
  display: grid;
  grid-template-columns: 2.2fr 1fr 1fr 1fr 1.3fr;
  gap: 3rem;
  margin-bottom: 3.5rem;
}

/* Brand col */
.uni-footer-logo {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  text-decoration: none;
  margin-bottom: 1rem;
}

.uni-footer-logo-icon {
  width: 44px; height: 44px;
  background: var(--c-accent, #F5A623);
  border-radius: 11px;
  display: flex; align-items: center; justify-content: center;
  flex-shrink: 0;
}

.uni-footer-logo-name {
  font-family: 'Poppins', sans-serif;
  font-weight: 800;
  font-size: 1.1rem;
  color: white;
  line-height: 1.1;
}

.uni-footer-logo-name span { color: var(--c-accent, #F5A623); }

.uni-footer-logo-tag {
  font-size: 0.58rem;
  color: rgba(255,255,255,.4);
  text-transform: uppercase;
  letter-spacing: 0.12em;
  font-weight: 500;
}

.uni-footer-desc {
  font-size: 0.81rem;
  color: rgba(255,255,255,.38);
  line-height: 1.78;
  max-width: 280px;
  margin-bottom: 1.4rem;
}

/* Socials */
.uni-footer-socials { display: flex; gap: 0.5rem; margin-bottom: 1.4rem; }

.uni-soc-btn {
  width: 36px; height: 36px;
  border-radius: 10px;
  background: rgba(255,255,255,.06);
  border: 1px solid rgba(255,255,255,.08);
  display: flex; align-items: center; justify-content: center;
  text-decoration: none;
  transition: all .3s;
}

.uni-soc-btn:hover {
  background: var(--c-accent, #F5A623);
  border-color: var(--c-accent, #F5A623);
  transform: translateY(-3px);
}

/* Accreditation badges */
.uni-accred-row {
  display: flex;
  gap: 0.6rem;
  flex-wrap: wrap;
}

.uni-accred-badge {
  background: rgba(255,255,255,.06);
  border: 1px solid rgba(255,255,255,.1);
  border-radius: 8px;
  padding: 0.4rem 0.75rem;
  font-size: 0.65rem;
  font-weight: 700;
  color: rgba(255,255,255,.5);
  text-transform: uppercase;
  letter-spacing: 0.06em;
  transition: all .25s;
}

.uni-accred-badge:hover { border-color: rgba(245,166,35,.4); color: var(--c-accent, #F5A623); }

/* ─── COLUMN HEADINGS ─── */
.uni-footer-col-title {
  font-family: 'Poppins', sans-serif;
  font-size: 0.7rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.14em;
  color: rgba(255,255,255,.3);
  margin-bottom: 1.25rem;
  padding-bottom: 0.75rem;
  border-bottom: 1px solid rgba(255,255,255,.06);
}

/* ─── FOOTER LINKS ─── */
.uni-footer-links { display: flex; flex-direction: column; gap: 0; }

.uni-footer-link {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.42rem 0;
  color: rgba(255,255,255,.4);
  text-decoration: none;
  font-size: 0.82rem;
  font-weight: 400;
  transition: all .25s;
  border-bottom: 1px solid rgba(255,255,255,.04);
}

.uni-footer-link:last-child { border-bottom: none; }

.uni-footer-link::before {
  content: '';
  width: 0; height: 0;
  border-top: 4px solid transparent;
  border-bottom: 4px solid transparent;
  border-left: 5px solid rgba(245,166,35,.4);
  flex-shrink: 0;
  transition: border-left-color .2s;
}

.uni-footer-link:hover {
  color: var(--c-white, #fff);
  padding-left: 0.4rem;
}

.uni-footer-link:hover::before { border-left-color: var(--c-accent, #F5A623); }

/* ─── CONTACT COLUMN ─── */
.uni-footer-contact-items { display: flex; flex-direction: column; gap: 0.9rem; }

.uni-footer-contact-item {
  display: flex;
  align-items: flex-start;
  gap: 0.65rem;
  font-size: 0.8rem;
  color: rgba(255,255,255,.38);
  line-height: 1.58;
}

.uni-footer-ci-icon {
  width: 30px; height: 30px;
  border-radius: 8px;
  background: rgba(245,166,35,.1);
  border: 1px solid rgba(245,166,35,.15);
  display: flex; align-items: center; justify-content: center;
  flex-shrink: 0;
  margin-top: 0.1rem;
  color: var(--c-accent, #F5A623);
  transition: all .25s;
}

.uni-footer-contact-item:hover .uni-footer-ci-icon {
  background: var(--c-accent, #F5A623);
  color: var(--c-primary-dark, #001936);
}

.uni-footer-contact-item:hover { color: rgba(255,255,255,.65); }

/* ─── APPLY CTA ─── */
.uni-footer-cta-box {
  background: linear-gradient(135deg, rgba(245,166,35,.12), rgba(7,41,77,.3));
  border: 1px solid rgba(245,166,35,.2);
  border-radius: 16px;
  padding: 1.5rem;
  text-align: center;
  margin-top: 1rem;
}

.uni-footer-cta-icon { font-size: 2rem; margin-bottom: 0.6rem; }

.uni-footer-cta-title {
  font-family: 'Poppins', sans-serif;
  font-weight: 700;
  font-size: 0.95rem;
  color: white;
  margin-bottom: 0.35rem;
}

.uni-footer-cta-sub {
  font-size: 0.72rem;
  color: rgba(255,255,255,.4);
  line-height: 1.6;
  margin-bottom: 1rem;
}

.uni-footer-cta-btn {
  display: block;
  background: var(--c-accent, #F5A623);
  color: var(--c-primary-dark, #001936);
  font-family: 'Poppins', sans-serif;
  font-weight: 700;
  font-size: 0.8rem;
  padding: 0.7rem 1rem;
  border-radius: 10px;
  text-decoration: none;
  transition: all .25s;
}

.uni-footer-cta-btn:hover { background: var(--c-accent-light, #ffc85a); transform: translateY(-1px); }

/* ─── DIVIDER ─── */
.uni-footer-divider {
  border: none;
  border-top: 1px solid rgba(255,255,255,.07);
  margin: 0 0 2rem;
}

/* ─── BOTTOM BAR ─── */
.uni-footer-bottom {
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 1rem;
}

.uni-footer-copy {
  font-size: 0.75rem;
  color: rgba(255,255,255,.22);
}

.uni-footer-copy a { color: var(--c-accent, #F5A623); text-decoration: none; }

.uni-footer-bottom-links {
  display: flex;
  gap: 1.5rem;
  flex-wrap: wrap;
}

.uni-footer-bottom-links a {
  font-size: 0.73rem;
  color: rgba(255,255,255,.22);
  text-decoration: none;
  transition: color .25s;
}

.uni-footer-bottom-links a:hover { color: var(--c-accent, #F5A623); }

/* ─── RESPONSIVE ─── */
@media(max-width: 1200px) {
  .uni-footer-grid { grid-template-columns: 2fr 1fr 1fr 1.3fr; gap: 2.5rem; }
  .uni-footer-grid > div:nth-child(3) { display: none; }
}

@media(max-width: 900px) {
  .uni-footer-grid { grid-template-columns: 1fr 1fr; gap: 2rem; }
  .uni-footer-nl-inner { grid-template-columns: 1fr; }
}

@media(max-width: 600px) {
  .uni-footer-grid { grid-template-columns: 1fr; }
  .uni-footer-bottom { flex-direction: column; text-align: center; }
  .uni-footer-nl-form { flex-direction: column; }
  .uni-footer-nl-btn { width: 100%; }
}
</style>

<div class="uni-footer-accent"></div>

<footer id="uni-footer" id="contact">
  <div class="uni-footer-bg-deco"></div>
  <div class="uni-footer-bg-deco"></div>

  {{-- Newsletter strip --}}
  <div class="uni-footer-nl-strip">
    <div class="container">
      <div class="uni-footer-nl-inner">
        <div class="uni-footer-nl-text">
          <div class="uni-footer-nl-title">📬 Stay Connected with BluePeak</div>
          <div class="uni-footer-nl-sub">Get admission updates, campus news, and scholarship announcements delivered to your inbox.</div>
        </div>
        <div class="uni-footer-nl-form">
          <input type="email" class="uni-footer-nl-input" id="footer-nl-email" placeholder="Enter your email address">
          <button class="uni-footer-nl-btn" type="button" onclick="footerNLSubscribe()">Subscribe Free →</button>
        </div>
      </div>
    </div>
  </div>

  {{-- Main footer --}}
  <div class="uni-footer-main">
    <div class="container">
      <div class="uni-footer-grid">

        {{-- Brand column --}}
        <div>
          <a href="/" class="uni-footer-logo">
            <div class="uni-footer-logo-icon">
              <svg width="22" height="22" fill="none" viewBox="0 0 32 32">
                <path d="M16 3L3 10l13 7 13-7L16 3z" fill="var(--c-primary-dark,#001936)" stroke="var(--c-primary-dark,#001936)" stroke-width="1"/>
                <path d="M3 22l13 7 13-7" stroke="var(--c-primary-dark,#001936)" stroke-width="2.5" stroke-linecap="round"/>
                <path d="M3 16l13 7 13-7" stroke="var(--c-primary-dark,#001936)" stroke-width="2.5" stroke-linecap="round"/>
              </svg>
            </div>
            <div>
              <div class="uni-footer-logo-name">Blue<span>Peak</span></div>
              <div class="uni-footer-logo-tag">University of Excellence</div>
            </div>
          </a>

          <p class="uni-footer-desc">
            A premier institution of higher learning committed to academic excellence, groundbreaking research, and holistic student development since 1985. NAAC 'A++' Accredited.
          </p>

          <div class="uni-footer-socials">
            <a class="uni-soc-btn" href="#" aria-label="Facebook" title="Facebook">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="rgba(255,255,255,.65)"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
            </a>
            <a class="uni-soc-btn" href="#" aria-label="Twitter" title="Twitter / X">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="rgba(255,255,255,.65)"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.742l7.746-8.867L1.145 2.25H8.08l4.254 5.628 5.91-5.628zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
            </a>
            <a class="uni-soc-btn" href="#" aria-label="LinkedIn" title="LinkedIn">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="rgba(255,255,255,.65)"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
            </a>
            <a class="uni-soc-btn" href="#" aria-label="YouTube" title="YouTube">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="rgba(255,255,255,.65)"><path d="M23.495 6.205a3.007 3.007 0 0 0-2.088-2.088c-1.87-.501-9.396-.501-9.396-.501s-7.507-.01-9.396.501A3.007 3.007 0 0 0 .527 6.205a31.247 31.247 0 0 0-.522 5.805 31.247 31.247 0 0 0 .522 5.783 3.007 3.007 0 0 0 2.088 2.088c1.868.502 9.396.502 9.396.502s7.506 0 9.396-.502a3.007 3.007 0 0 0 2.088-2.088 31.247 31.247 0 0 0 .5-5.783 31.247 31.247 0 0 0-.5-5.805zM9.609 15.601V8.408l6.264 3.602z"/></svg>
            </a>
            <a class="uni-soc-btn" href="#" aria-label="Instagram" title="Instagram">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="rgba(255,255,255,.65)"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
            </a>
          </div>

          <div class="uni-accred-row">
            <span class="uni-accred-badge">NAAC A++</span>
            <span class="uni-accred-badge">NBA</span>
            <span class="uni-accred-badge">UGC</span>
            <span class="uni-accred-badge">AICTE</span>
          </div>
        </div>

        {{-- Quick Links --}}
        <div>
          <div class="uni-footer-col-title">Quick Links</div>
          <div class="uni-footer-links">
            <a href="/" class="uni-footer-link">Home</a>
            <a href="#about" class="uni-footer-link">About University</a>
            <a href="#faculties" class="uni-footer-link">Our Faculties</a>
            <a href="#programs" class="uni-footer-link">Programs &amp; Study</a>
            <a href="#apply" class="uni-footer-link">Admissions 2026</a>
            <a href="#gallery" class="uni-footer-link">Photo Gallery</a>
            <a href="#blog" class="uni-footer-link">News &amp; Events</a>
            <a href="#campus" class="uni-footer-link">Campus Life</a>
          </div>
        </div>

        {{-- Programs --}}
        <div>
          <div class="uni-footer-col-title">Top Programs</div>
          <div class="uni-footer-links">
            <a href="#" class="uni-footer-link">B.Tech Computer Science</a>
            <a href="#" class="uni-footer-link">MBBS — Medicine</a>
            <a href="#" class="uni-footer-link">MBA — Business Admin</a>
            <a href="#" class="uni-footer-link">BBA — Business Admin</a>
            <a href="#" class="uni-footer-link">B.Des — Visual Comm.</a>
            <a href="#" class="uni-footer-link">M.Sc Data Science</a>
            <a href="#" class="uni-footer-link">LLB — Law</a>
            <a href="#" class="uni-footer-link">B.Pharm — Pharmacy</a>
          </div>
        </div>

        {{-- Contact --}}
        <div>
          <div class="uni-footer-col-title">Contact &amp; Location</div>
          <div class="uni-footer-contact-items">
            <div class="uni-footer-contact-item">
              <div class="uni-footer-ci-icon">
                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
              </div>
              <span>BluePeak University Campus,<br>Knowledge Park, Phase II,<br>Greater Noida — 201310, India</span>
            </div>
            <div class="uni-footer-contact-item">
              <div class="uni-footer-ci-icon">
                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 11 19.79 19.79 0 0 1 1.61 2.4 2 2 0 0 1 3.58.22h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 7.91a16 16 0 0 0 6.18 6.18l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 14.92z"/></svg>
              </div>
              <span>Admissions: +91 98000 12345<br>Main Office: +91 90000 00000</span>
            </div>
            <div class="uni-footer-contact-item">
              <div class="uni-footer-ci-icon">
                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
              </div>
              <span>admissions@bluepeak.edu.in<br>info@bluepeak.edu.in</span>
            </div>
            <div class="uni-footer-contact-item">
              <div class="uni-footer-ci-icon">
                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
              </div>
              <span>Mon – Sat: 9:00 AM – 6:00 PM<br>Helpline 24/7 for Students</span>
            </div>
          </div>
        </div>

            

      </div>

      <hr class="uni-footer-divider">

      <div class="uni-footer-bottom">
        <p class="uni-footer-copy">
          © {{ date('Y') }} <a href="/">BluePeak University</a>. All rights reserved.
          Recognised by UGC &amp; AICTE, Government of India.
        </p>
        <div class="uni-footer-bottom-links">
          <a href="#">Privacy Policy</a>
          <a href="#">Terms of Service</a>
          <a href="#">Cookie Policy</a>
          <a href="#">Sitemap</a>
          <a href="#">Grievance Portal</a>
          <a href="#">RTI</a>
        </div>
      </div>

    </div>
  </div>
</footer>

<script>
function footerNLSubscribe() {
  const inp = document.getElementById('footer-nl-email');
  const val = (inp.value || '').trim();
  if (!val || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val)) {
    inp.style.borderColor = 'rgba(239,68,68,.6)';
    setTimeout(() => inp.style.borderColor = '', 2500);
    return;
  }
  inp.value = '';
  inp.placeholder = '✅ Subscribed! Thank you.';
  setTimeout(() => inp.placeholder = 'Enter your email address', 4500);
}
</script>
