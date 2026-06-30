<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <title>Site Preview</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; color: #1a0a2e; }

        .preview-topbar {
            position: sticky;
            top: 0;
            z-index: 100;
            background: #12203A;
            color: #fff;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: .85rem;
        }
        .preview-topbar a {
            color: #fff;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .preview-menu .preview-dropdown { display: none; }
        .preview-menu:hover .preview-dropdown { display: block; }

        #previewHeaderNav { padding: 14px 18px; border-bottom: 1px solid #e5e7eb; }

        @keyframes ribbonSlide {
            0% { transform: translateX(100%); }
            100% { transform: translateX(-100%); }
        }

        /* ── Premium "Message" section ── */
        .cm-section {
            position: relative;
            overflow: hidden;
            background: linear-gradient(180deg, #ffffff 0%, #F8FAFC 100%);
            font-family: 'Inter', sans-serif;
            padding: 56px 40px;
        }
        .cm-shape {
            position: absolute;
            border-radius: 50%;
            opacity: .06;
            pointer-events: none;
        }
        .cm-shape.s1 { width: 320px; height: 320px; background: #12203A; top: -120px; left: -100px; }
        .cm-shape.s2 { width: 220px; height: 220px; background: #8B1E24; bottom: -80px; left: 38%; }

        .cm-grid {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            gap: 48px;
            max-width: 1180px;
            margin: 0 auto;
        }
        .cm-left { flex: 1 1 60%; min-width: 280px; }
        .cm-right { flex: 1 1 40%; min-width: 240px; display: flex; justify-content: center; }

        .cm-badge {
            display: inline-block;
            background: rgba(139, 30, 36, .08);
            color: #8B1E24;
            font-size: .72rem;
            font-weight: 700;
            letter-spacing: .05em;
            text-transform: uppercase;
            padding: 8px 18px;
            border-radius: 999px;
            margin-bottom: 18px;
        }
        .cm-heading {
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            font-size: clamp(1.6rem, 2.4vw, 2.4rem);
            line-height: 1.25;
            color: #12203A;
            margin: 0 0 20px;
        }
        .cm-desc {
            border-left: 3px solid #F59E0B;
            padding-left: 18px;
            margin: 0 0 28px;
        }
        .cm-desc p {
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.75;
            color: #4b5563;
            margin: 0 0 14px;
        }
        .cm-desc p:last-child { margin-bottom: 0; }

        .cm-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: #ffffff;
            color: #8B1E24;
            border: 1.5px solid #8B1E24;
            border-radius: 10px;
            padding: 13px 26px;
            font-weight: 600;
            font-size: .92rem;
            text-decoration: none;
            transition: background .25s ease, color .25s ease, transform .25s ease;
        }
        .cm-btn i { transition: transform .25s ease; }
        .cm-btn:hover {
            background: #8B1E24;
            color: #ffffff;
            transform: translateY(-1px);
        }
        .cm-btn:hover i { transform: translateX(3px); }

        .cm-img-wrap {
            position: relative;
            width: 100%;
            max-width: 380px;
            display: flex;
            align-items: flex-end;
            justify-content: center;
        }
        .cm-glow {
            position: absolute;
            width: 90%;
            height: 70%;
            bottom: 0;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(245, 158, 11, .18), transparent 70%);
            z-index: 0;
        }
        .cm-img {
            position: relative;
            z-index: 1;
            width: 100%;
            max-height: 340px;
            object-fit: contain;
            object-position: bottom;
            filter: drop-shadow(0 18px 28px rgba(18, 32, 58, .18));
        }
        .cm-img-placeholder {
            position: relative;
            z-index: 1;
            width: 100%;
            height: 260px;
            border: 1.5px dashed #e5e7eb;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #9ca3af;
            font-size: .85rem;
        }

        @media (max-width: 1024px) {
            .cm-grid { flex-direction: column; }
            .cm-left, .cm-right { flex: 1 1 100%; }
            .cm-btn { width: 100%; justify-content: center; }
        }
        @media (max-width: 640px) {
            .cm-section { padding: 40px 20px; }
            .cm-left { text-align: center; }
            .cm-desc { border-left: none; border-top: 3px solid #F59E0B; padding-left: 0; padding-top: 14px; }
            .cm-badge { margin-left: auto; margin-right: auto; }
        }

        .btn-save {
            background: #2563eb;
            color: #fff;
            border-radius: 8px;
            padding: 10px 20px;
            font-size: .85rem;
            font-weight: 600;
        }
    </style>
</head>
<body>

    <div class="preview-topbar">
        <span><i class="fas fa-eye"></i> Live Site Preview — Ribbon, Header, Landing Section &amp; Message Section</span>
        <a href="{{ url()->previous() }}"><i class="fas fa-xmark"></i> Close Preview</a>
    </div>

    <div id="previewRibbonTop"></div>
    <div id="previewHeaderNav"></div>
    <div id="previewLandingArea"></div>
    <div id="previewAboutArea"></div>
    @if ($sectionHeader)
        @include('sections.section-header', ['section' => $sectionHeader])
    @endif

    @if ($courseSection)
        @include('sections.course-section', ['section' => $courseSection])
    @endif
    <div id="previewRibbonBottom"></div>

    <script>
        const headerPreview = @json($headerPreview);
        const landingPreview = @json($landingPreview);
        const aboutPreview = @json($aboutPreview);
        const ribbonPreview = @json($ribbonPreview);

        function escapeHtml(str) {
            return (str || '').replace(/[&<>"']/g, c => ({
                '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;'
            }[c]));
        }

        // ── Header ──

        function linkAttrs(link, isExternal) {
            const href = link ? escapeHtml(link) : '#';
            return isExternal ? `href="${href}" target="_blank" rel="noopener"` : `href="${href}"`;
        }

        function renderPreviewLink(item) {
            return `
                <a ${linkAttrs(item.link, item.is_external)} style="display:block;padding:6px 14px;font-size:.82rem;color:#374151;text-decoration:none;white-space:nowrap;">
                    ${escapeHtml(item.label) || '(untitled)'} ${item.is_external ? '<i class="fas fa-arrow-up-right-from-square" style="font-size:.65rem;"></i>' : ''}
                </a>
            `;
        }

        function renderDropdownContent(menu) {
            if (!menu.items || !menu.items.length) return '';

            if (menu.type === 'split') {
                return `<div style="display:flex;gap:24px;padding:14px;">${menu.items.map(item => `
                    <div style="min-width:140px;">
                        <div style="font-weight:600;font-size:.8rem;margin-bottom:6px;color:#1f2937;">${escapeHtml(item.label) || '(untitled)'}</div>
                        ${(item.submenu || []).map(renderPreviewLink).join('') || '<span style="font-size:.78rem;color:#9ca3af;">No items</span>'}
                    </div>
                `).join('')}</div>`;
            }

            if (menu.type === 'mega') {
                return `<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:4px;padding:14px;min-width:320px;">
                    ${menu.items.map(renderPreviewLink).join('')}
                </div>`;
            }

            return `<div style="padding:6px 0;min-width:160px;">${menu.items.map(renderPreviewLink).join('')}</div>`;
        }

        function renderTopMenu(menu) {
            const hasDropdown = menu.items && menu.items.length > 0;
            return `
                <div class="preview-menu" style="position:relative;">
                    <span style="display:flex;align-items:center;gap:4px;padding:8px 8px;font-size:.85rem;font-weight:600;cursor:pointer;">
                        ${escapeHtml(menu.name) || '(untitled)'} ${hasDropdown ? '<i class="fas fa-chevron-down" style="font-size:.65rem;"></i>' : ''}
                    </span>
                    ${hasDropdown ? `
                        <div class="preview-dropdown" style="position:absolute;top:100%;left:0;background:#fff;border:1px solid #e5e7eb;border-radius:8px;margin-top:0px;box-shadow:0 8px 24px rgba(0,0,0,.08);z-index:10;">
                            ${renderDropdownContent(menu)}
                        </div>
                    ` : ''}
                </div>
            `;
        }

        function renderMenuGroup(menus) {
            return `<div style="display:flex;gap:6px;flex-wrap:wrap;align-items:flex-start;">${menus.map(renderTopMenu).join('')}</div>`;
        }

        function renderHeaderNav() {
            const logo = `<div style="display:flex;align-items:center;gap:8px;white-space:nowrap;"><img src="${headerPreview.logoUrl}" alt="logo" style="height:${headerPreview.logoSize || 40}px;width:auto;object-fit:contain;"></div>`;
            const buttonsInner = (headerPreview.buttons || []).map(btn => `
                <a ${linkAttrs(btn.link, btn.is_external)} class="btn-save" style="text-decoration:none;display:inline-flex;">
                    ${escapeHtml(btn.label) || '(untitled)'}
                </a>
            `).join('');
            const buttons = `<div style="display:flex;gap:8px;flex-wrap:wrap;">${buttonsInner}</div>`;
            const menus = headerPreview.menus || [];

            if (headerPreview.logoPosition === 'center') {
                const half = Math.ceil(menus.length / 2);
                return `
                    <div style="display:grid;grid-template-columns:1fr auto 1fr;align-items:center;gap:16px;">
                        <div style="display:flex;align-items:center;gap:16px;justify-self:start;">${renderMenuGroup(menus.slice(0, half))}</div>
                        <div style="justify-self:center;">${logo}</div>
                        <div style="display:flex;align-items:center;gap:16px;justify-self:end;">${renderMenuGroup(menus.slice(half))}${buttons}</div>
                    </div>
                `;
            }

            if (headerPreview.logoPosition === 'right') {
                return `
                    <div style="display:grid;grid-template-columns:1fr auto 1fr;align-items:center;gap:16px;">
                        <div style="justify-self:start;">${buttons}</div>
                        <div style="justify-self:center;">${renderMenuGroup(menus)}</div>
                        <div style="justify-self:end;">${logo}</div>
                    </div>
                `;
            }

            return `
                <div style="display:grid;grid-template-columns:1fr auto 1fr;align-items:center;gap:16px;">
                    <div style="justify-self:start;">${logo}</div>
                    <div style="justify-self:center;">${renderMenuGroup(menus)}</div>
                    <div style="justify-self:end;">${buttons}</div>
                </div>
            `;
        }

        // ── Landing section ──

        function hexToRgb(hex) {
            hex = (hex || '#000000').replace('#', '');
            if (hex.length === 3) hex = hex.split('').map(c => c + c).join('');
            return {
                r: parseInt(hex.substring(0, 2), 16) || 0,
                g: parseInt(hex.substring(2, 4), 16) || 0,
                b: parseInt(hex.substring(4, 6), 16) || 0,
            };
        }

        function gradientOverlayCss(gradient, hex, opacityPct) {
            const { r, g, b } = hexToRgb(hex);
            const opacity = (opacityPct ?? 50) / 100;
            const solid = `rgba(${r},${g},${b},${opacity})`;
            const transparent = `rgba(${r},${g},${b},0)`;

            switch (gradient) {
                case 'top': return `linear-gradient(to bottom, ${solid}, ${transparent})`;
                case 'bottom': return `linear-gradient(to top, ${solid}, ${transparent})`;
                case 'left': return `linear-gradient(to right, ${solid}, ${transparent})`;
                case 'right': return `linear-gradient(to left, ${solid}, ${transparent})`;
                case 'diagonal': return `linear-gradient(135deg, ${solid}, ${transparent})`;
                case 'radial': return `radial-gradient(circle, ${solid}, ${transparent})`;
                default: return solid;
            }
        }

        function renderHeroBlockHtml(slide) {
            const justify = slide.position === 'center' ? 'center' : (slide.position === 'right' ? 'flex-end' : 'flex-start');
            const textAlign = slide.position === 'center' ? 'center' : (slide.position === 'right' ? 'right' : 'left');
            const bg = slide.background || {};

            let backgroundStyle = `background:${bg.color || '#2563eb'};`;
            let overlayHtml = '';

            if (bg.type === 'image' && slide.imageUrl) {
                backgroundStyle = `background:#111 url('${slide.imageUrl}') center/cover no-repeat;`;
            } else if (bg.type === 'image_fade') {
                backgroundStyle = slide.imageUrl ? `background:#111 url('${slide.imageUrl}') center/cover no-repeat;` : `background:${bg.color || '#2563eb'};`;
                const overlayCss = gradientOverlayCss(bg.gradient || 'solid', bg.color || '#000000', bg.fade_opacity);
                overlayHtml = `<div style="position:absolute;inset:0;background:${overlayCss};"></div>`;
            }

            const buttonsHtml = (slide.buttons || []).map(b => `
                <a href="${b.link ? escapeHtml(b.link) : '#'}" class="btn-save" style="text-decoration:none;display:inline-flex;margin:6px;">
                    ${escapeHtml(b.label) || '(untitled)'}
                </a>
            `).join('');

            return `
                <div style="position:relative;height:100%;min-height:420px;box-sizing:border-box;display:flex;align-items:center;justify-content:${justify};padding:40px;${backgroundStyle}overflow:hidden;">
                    ${overlayHtml}
                    <div style="position:relative;z-index:1;max-width:100%;text-align:${textAlign};color:#fff;">
                        <h2 style="margin:0 0 10px;font-size:2rem;font-family:'Poppins',sans-serif;">${escapeHtml(slide.heading) || '(heading)'}</h2>
                        <p style="margin:0 0 14px;opacity:.92;">${escapeHtml(slide.subheading) || ''}</p>
                        <div style="display:flex;flex-wrap:wrap;justify-content:${justify};margin:0 -6px;">${buttonsHtml}</div>
                    </div>
                </div>
            `;
        }

        const LANDING_VIEWPORT_HEIGHT = 480;
        let landingSliderState = null;
        let landingSlideInterval = null;

        function renderTrackSliderHtml(slides, direction) {
            const n = slides.length;
            const slideBasis = 100 / n;
            const trackDimStyle = direction === 'horizontal'
                ? `flex-direction:row;width:${n * 100}%;height:100%;`
                : `flex-direction:column;width:100%;height:${n * 100}%;`;
            const slideDimStyle = direction === 'horizontal'
                ? `width:${slideBasis}%;height:100%;`
                : `width:100%;height:${slideBasis}%;`;

            const slidesHtml = slides.map(s => `<div style="flex-shrink:0;${slideDimStyle}">${renderHeroBlockHtml(s)}</div>`).join('');
            const dotsHtml = slides.map((_, i) => `
                <span class="landing-dot" data-i="${i}" onclick="goToLandingSlide(${i})"
                    style="width:8px;height:8px;border-radius:50%;background:rgba(255,255,255,.5);cursor:pointer;display:block;"></span>
            `).join('');

            return `
                <div style="position:relative;overflow:hidden;height:${LANDING_VIEWPORT_HEIGHT}px;width:100%;">
                    <div class="landing-track" style="display:flex;${trackDimStyle}transition:transform .6s ease;">
                        ${slidesHtml}
                    </div>
                    <div style="position:absolute;z-index:2;display:flex;gap:6px;
                        ${direction === 'horizontal' ? 'bottom:12px;left:0;right:0;justify-content:center;' : 'right:12px;top:0;bottom:0;flex-direction:column;align-items:center;justify-content:center;'}">
                        ${dotsHtml}
                    </div>
                </div>
            `;
        }

        function applyLandingSlideTransform() {
            if (!landingSliderState) return;
            const { track, slideBasis, direction, current } = landingSliderState;
            const offset = current * slideBasis;
            track.style.transform = direction === 'horizontal' ? `translateX(-${offset}%)` : `translateY(-${offset}%)`;
            document.querySelectorAll('#previewLandingArea .landing-dot').forEach((d, idx) => {
                d.style.background = idx === current ? '#fff' : 'rgba(255,255,255,.5)';
            });
        }

        function goToLandingSlide(i) {
            if (!landingSliderState) return;
            landingSliderState.current = i;
            applyLandingSlideTransform();
        }

        function setupLandingSlider(direction, n) {
            const track = document.querySelector('#previewLandingArea .landing-track');
            landingSliderState = { track, slideBasis: 100 / n, direction, current: 0, n };
            applyLandingSlideTransform();
            landingSlideInterval = setInterval(() => {
                landingSliderState.current = (landingSliderState.current + 1) % n;
                applyLandingSlideTransform();
            }, 3500);
        }

        function renderLandingArea() {
            const area = document.getElementById('previewLandingArea');
            const slides = landingPreview.slides || [];

            if (!slides.length) {
                area.innerHTML = '<p style="padding:60px;text-align:center;color:#6b7280;">No landing section content has been added yet.</p>';
                return;
            }

            if (slides.length > 1 && (landingPreview.screen_type === 'slider' || landingPreview.screen_type === 'scroll')) {
                const direction = landingPreview.screen_type === 'slider' ? 'horizontal' : 'vertical';
                area.innerHTML = renderTrackSliderHtml(slides, direction);
                setupLandingSlider(direction, slides.length);
                return;
            }

            area.innerHTML = `<div style="height:${LANDING_VIEWPORT_HEIGHT}px;">${renderHeroBlockHtml(slides[0])}</div>`;
        }

        // ── Message section ──

        function renderAboutPreview() {
            const a = aboutPreview || {};

            const paragraphsHtml = (a.description || '')
                .split(/\n+/)
                .map(p => p.trim())
                .filter(Boolean)
                .map(p => `<p>${escapeHtml(p)}</p>`)
                .join('');

            if (!a.heading && !paragraphsHtml && !a.image) {
                return '<p style="padding:60px;text-align:center;color:#6b7280;">No message section content has been added yet.</p>';
            }

            const imageHtml = a.image
                ? `<img src="${a.image}" alt="" class="cm-img">`
                : `<div class="cm-img-placeholder">No image uploaded</div>`;

            return `
                <div class="cm-section">
                    <span class="cm-shape s1"></span>
                    <span class="cm-shape s2"></span>
                    <div class="cm-grid">
                        <div class="cm-left">
                            ${a.badge ? `<span class="cm-badge">${escapeHtml(a.badge)}</span>` : ''}
                            <h2 class="cm-heading">${escapeHtml(a.heading) || '(heading)'}</h2>
                            <div class="cm-desc">${paragraphsHtml || '<p>(description)</p>'}</div>
                            ${a.buttonLabel ? `<a href="${a.buttonLink ? escapeHtml(a.buttonLink) : '#'}" class="cm-btn">${escapeHtml(a.buttonLabel)} <i class="fas fa-arrow-right"></i></a>` : ''}
                        </div>
                        <div class="cm-right">
                            <div class="cm-img-wrap">
                                <span class="cm-glow"></span>
                                ${imageHtml}
                            </div>
                        </div>
                    </div>
                </div>
            `;
        }

        // ── Highlight ribbon ──

        function renderRibbonBarHtml() {
            const notices = (ribbonPreview.notices && ribbonPreview.notices.length) ? ribbonPreview.notices : [{
                text: 'Your highlight ribbon text will appear here', href: ''
            }];
            const gap = 100;
            const textSpans = notices.map((n, i) => `
                <a href="${n.href ? escapeHtml(n.href) : '#'}" ${n.href ? 'target="_blank" rel="noopener"' : 'onclick="return false;"'}
                    style="display:inline-block;color:inherit;text-decoration:${n.href ? 'underline' : 'none'};${i < notices.length - 1 ? `margin-right:${gap}px;` : ''}">${escapeHtml(n.text)}</a>
            `).join('');

            const animationStyle = ribbonPreview.isSlide
                ? `animation: ribbonSlide ${ribbonPreview.sliderSpeed || 10}s linear infinite;white-space:nowrap;`
                : 'white-space:normal;';

            const fixedStyle = ribbonPreview.cssPosition === 'fixed'
                ? `position:fixed;${ribbonPreview.ribbonPosition === 'bottom' ? 'bottom:0;' : 'top:0;'}left:0;right:0;z-index:50;`
                : 'position:relative;';

            return `
                <div id="ribbonBarEl" style="${fixedStyle}background:${ribbonPreview.backgroundColor};color:${ribbonPreview.textColor};padding:10px 16px;display:flex;align-items:center;gap:12px;overflow:hidden;">
                    <div style="flex:1;overflow:hidden;">
                        <span style="${animationStyle}display:inline-block;font-size:.86rem;font-weight:600;">${textSpans}</span>
                    </div>
                    ${ribbonPreview.showClose ? `<i class="fas fa-xmark" style="flex-shrink:0;cursor:pointer;" onclick="closeRibbon()"></i>` : ''}
                </div>
            `;
        }

        function closeRibbon() {
            const el = document.getElementById('ribbonBarEl');
            if (!el) return;
            const wasFixed = ribbonPreview.cssPosition === 'fixed';
            el.remove();
            if (wasFixed) document.body.style[ribbonPreview.ribbonPosition === 'bottom' ? 'paddingBottom' : 'paddingTop'] = '0';
        }

        function renderRibbon() {
            if (!ribbonPreview.enabled) return;

            const html = renderRibbonBarHtml();
            const topSlot = document.getElementById('previewRibbonTop');
            const bottomSlot = document.getElementById('previewRibbonBottom');

            if (ribbonPreview.ribbonPosition === 'bottom') {
                bottomSlot.innerHTML = html;
            } else {
                topSlot.innerHTML = html;
            }

            if (ribbonPreview.cssPosition === 'fixed') {
                const height = document.getElementById('ribbonBarEl').offsetHeight;
                document.body.style[ribbonPreview.ribbonPosition === 'bottom' ? 'paddingBottom' : 'paddingTop'] = height + 'px';
            }
        }

        document.getElementById('previewHeaderNav').innerHTML = renderHeaderNav();
        renderLandingArea();
        document.getElementById('previewAboutArea').innerHTML = renderAboutPreview();
        renderRibbon();
    </script>
</body>
</html>
