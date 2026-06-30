<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles — WebAdmin Insights</title>
    <meta name="description" content="Explore expert articles on web design, SEO, business growth, and digital marketing from WebAdmin.">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* ── Reveal animation ── */
        .ba-reveal {
            opacity: 0;
            transform: translateY(28px);
            transition: opacity .65s, transform .65s;
        }

        .ba-reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* ════════ HERO BANNER ════════ */
        #ba-hero {
            background: linear-gradient(135deg, #0f172a 0%, #0c2044 50%, #0f172a 100%);
            padding: 4.5rem 0 5rem;
            position: relative;
            overflow: hidden;
        }

        #ba-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 60% 80% at 20% 50%, rgba(0, 116, 209, .22) 0%, transparent 60%),
                radial-gradient(ellipse 50% 60% at 80% 40%, rgba(56, 189, 248, .12) 0%, transparent 55%);
        }

        .ba-hero-grid {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(56, 189, 248, .05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(56, 189, 248, .05) 1px, transparent 1px);
            background-size: 48px 48px;
            mask-image: radial-gradient(ellipse 80% 80% at 50% 50%, #000 30%, transparent 100%);
        }

        .ba-hero-inner {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 2rem;
            position: relative;
            z-index: 2;
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 3rem;
            align-items: center;
        }

        .ba-hero-tag {
            display: inline-flex;
            align-items: center;
            gap: .45rem;
            background: rgba(56, 189, 248, .12);
            border: 1px solid rgba(56, 189, 248, .25);
            color: #38bdf8;
            font-size: .7rem;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            padding: .35rem .9rem;
            border-radius: 50px;
            margin-bottom: .9rem;
        }

        .ba-hero-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #38bdf8;
            animation: baPing 1.5s ease-in-out infinite;
        }

        @keyframes baPing {

            0%,
            100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: .4;
                transform: scale(1.6);
            }
        }

        .ba-hero-h1 {
            font-family: 'Poppins', sans-serif;
            font-size: clamp(2rem, 4vw, 3.2rem);
            font-weight: 800;
            color: #fff;
            line-height: 1.12;
            letter-spacing: -.025em;
            margin-bottom: .9rem;
        }

        .ba-hero-h1 span {
            background: linear-gradient(120deg, #38bdf8 0%, #60a5fa 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .ba-hero-sub {
            color: rgba(255, 255, 255, .55);
            font-size: .97rem;
            line-height: 1.72;
            max-width: 520px;
            margin-bottom: 2rem;
        }

        .ba-hero-stats {
            display: flex;
            gap: 2.5rem;
            flex-wrap: wrap;
        }

        .ba-hero-stat-val {
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            font-size: 1.7rem;
            background: linear-gradient(135deg, #38bdf8, #60a5fa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1;
        }

        .ba-hero-stat-lbl {
            font-size: .73rem;
            color: rgba(255, 255, 255, .35);
            margin-top: .2rem;
        }

        /* Right: featured pill cards */
        .ba-hero-quick {
            display: flex;
            flex-direction: column;
            gap: .7rem;
            min-width: 230px;
        }

        .ba-hero-quick-card {
            display: flex;
            align-items: center;
            gap: .75rem;
            background: rgba(255, 255, 255, .06);
            border: 1px solid rgba(255, 255, 255, .09);
            border-radius: 14px;
            padding: .75rem 1rem;
            text-decoration: none;
            transition: all .25s;
            backdrop-filter: blur(8px);
        }

        .ba-hero-quick-card:hover {
            background: rgba(56, 189, 248, .1);
            border-color: rgba(56, 189, 248, .25);
            transform: translateX(4px);
        }

        .ba-hero-qc-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: linear-gradient(135deg, #0074d1, #38bdf8);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: .9rem;
        }

        .ba-hero-qc-title {
            font-size: .8rem;
            font-weight: 600;
            color: #fff;
            line-height: 1.3;
        }

        .ba-hero-qc-meta {
            font-size: .68rem;
            color: rgba(255, 255, 255, .35);
            margin-top: .1rem;
        }

        /* ════════ LAYOUT ════════ */
        .ba-layout {
            max-width: 1280px;
            margin: 0 auto;
            padding: 3.5rem 2rem;
            display: grid;
            grid-template-columns: 1fr 320px;
            gap: 3rem;
            align-items: start;
        }

        /* ════════ SECTION LABEL ════════ */
        .ba-section-label {
            display: flex;
            align-items: center;
            gap: .75rem;
            margin-bottom: 1.8rem;
        }

        .ba-section-label-badge {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            background: linear-gradient(135deg, rgba(0, 116, 209, .1), rgba(56, 189, 248, .07));
            border: 1px solid rgba(0, 116, 209, .18);
            color: #0074d1;
            font-size: .68rem;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            padding: .3rem .85rem;
            border-radius: 50px;
        }

        .ba-section-label hr {
            flex: 1;
            border: none;
            border-top: 1.5px dashed #e2e8f0;
        }

        /* ════════ FEATURED ARTICLE ════════ */
        .ba-featured {
            border-radius: 22px;
            overflow: hidden;
            border: 1.5px solid #e2e8f0;
            background: #fff;
            display: grid;
            grid-template-columns: 1.1fr 1fr;
            margin-bottom: 2.5rem;
            transition: all .4s cubic-bezier(.4, 0, .2, 1);
            box-shadow: 0 2px 20px rgba(0, 0, 0, .05);
        }

        .ba-featured:hover {
            border-color: rgba(0, 116, 209, .25);
            box-shadow: 0 20px 60px rgba(0, 116, 209, .1);
            transform: translateY(-4px);
        }

        .ba-feat-img {
            position: relative;
            overflow: hidden;
            min-height: 300px;
        }

        .ba-feat-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform .55s;
        }

        .ba-featured:hover .ba-feat-img img {
            transform: scale(1.06);
        }

        .ba-feat-img-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(0, 116, 209, .25), transparent);
        }

        .ba-feat-img-badge {
            position: absolute;
            top: 1rem;
            left: 1rem;
            background: linear-gradient(135deg, #0074d1, #38bdf8);
            color: #fff;
            font-size: .65rem;
            font-weight: 700;
            letter-spacing: .06em;
            text-transform: uppercase;
            padding: .3rem .85rem;
            border-radius: 50px;
            box-shadow: 0 4px 14px rgba(0, 116, 209, .4);
        }

        .ba-feat-body {
            padding: 2.2rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .ba-feat-cat {
            font-size: .68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .08em;
            color: #0074d1;
            margin-bottom: .6rem;
        }

        .ba-feat-title {
            font-family: 'Poppins', sans-serif;
            font-size: 1.35rem;
            font-weight: 800;
            color: #0f172a;
            line-height: 1.3;
            margin-bottom: .75rem;
        }

        .ba-feat-title a {
            color: inherit;
            text-decoration: none;
            transition: color .2s;
        }

        .ba-feat-title a:hover {
            color: #0074d1;
        }

        .ba-feat-excerpt {
            font-size: .855rem;
            color: #64748b;
            line-height: 1.72;
            margin-bottom: 1.4rem;
        }

        .ba-feat-meta {
            display: flex;
            align-items: center;
            gap: .6rem;
            flex-wrap: wrap;
        }

        .ba-author-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .65rem;
            font-weight: 700;
            color: #fff;
            flex-shrink: 0;
        }

        .ba-author-name {
            font-size: .78rem;
            font-weight: 600;
            color: #0f172a;
        }

        .ba-meta-dot {
            width: 3px;
            height: 3px;
            border-radius: 50%;
            background: #cbd5e1;
        }

        .ba-meta-date,
        .ba-meta-read {
            font-size: .74rem;
            color: #94a3b8;
        }

        .ba-read-btn {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            margin-top: 1.2rem;
            color: #0074d1;
            font-size: .8rem;
            font-weight: 700;
            font-family: 'Poppins', sans-serif;
            text-decoration: none;
            transition: gap .2s;
        }

        .ba-read-btn:hover {
            gap: .7rem;
        }

        /* ════════ ARTICLE GRID ════════ */
        .ba-articles-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.4rem;
        }

        .ba-art-card {
            border-radius: 18px;
            overflow: hidden;
            border: 1.5px solid #e2e8f0;
            background: #fff;
            transition: all .38s cubic-bezier(.4, 0, .2, 1);
            box-shadow: 0 2px 14px rgba(0, 0, 0, .04);
            display: flex;
            flex-direction: column;
        }

        .ba-art-card:hover {
            border-color: rgba(0, 116, 209, .22);
            box-shadow: 0 16px 48px rgba(0, 116, 209, .1);
            transform: translateY(-6px);
        }

        .ba-art-thumb {
            height: 185px;
            overflow: hidden;
            position: relative;
        }

        .ba-art-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform .5s;
        }

        .ba-art-card:hover .ba-art-thumb img {
            transform: scale(1.08);
        }

        .ba-art-thumb-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(15, 23, 42, .35) 0%, transparent 50%);
        }

        .ba-art-cat-badge {
            position: absolute;
            bottom: .75rem;
            left: .75rem;
            background: rgba(255, 255, 255, .92);
            backdrop-filter: blur(8px);
            border-radius: 50px;
            padding: .22rem .7rem;
            font-size: .63rem;
            font-weight: 700;
            color: #0074d1;
            letter-spacing: .04em;
            text-transform: uppercase;
        }

        .ba-art-body {
            padding: 1.2rem 1.35rem 1.4rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .ba-art-title {
            font-family: 'Poppins', sans-serif;
            font-size: .97rem;
            font-weight: 700;
            color: #0f172a;
            line-height: 1.38;
            margin-bottom: .5rem;
        }

        .ba-art-title a {
            color: inherit;
            text-decoration: none;
            transition: color .2s;
        }

        .ba-art-title a:hover {
            color: #0074d1;
        }

        .ba-art-excerpt {
            font-size: .79rem;
            color: #64748b;
            line-height: 1.65;
            flex: 1;
            margin-bottom: 1rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .ba-art-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: .75rem;
            border-top: 1px solid #f1f5f9;
        }

        .ba-art-author {
            display: flex;
            align-items: center;
            gap: .5rem;
        }

        .ba-art-author-name {
            font-size: .73rem;
            font-weight: 600;
            color: #334155;
        }

        .ba-art-date {
            font-size: .69rem;
            color: #94a3b8;
            margin-top: .05rem;
        }

        .ba-art-read {
            font-size: .7rem;
            font-weight: 600;
            color: #0074d1;
            display: flex;
            align-items: center;
            gap: .25rem;
        }

        /* ════════ LOAD MORE ════════ */
        .ba-load-more {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .6rem;
            margin-top: 2rem;
            padding: .85rem 2.5rem;
            border-radius: 50px;
            border: 1.5px solid rgba(0, 116, 209, .25);
            background: transparent;
            color: #0074d1;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: .85rem;
            cursor: pointer;
            transition: all .3s;
            width: 100%;
        }

        .ba-load-more:hover {
            background: #0074d1;
            color: #fff;
            box-shadow: 0 8px 28px rgba(0, 116, 209, .3);
            transform: translateY(-2px);
        }

        /* ════════ SIDEBAR ════════ */
        .ba-sidebar {
            display: flex;
            flex-direction: column;
            gap: 1.6rem;
        }

        .ba-widget {
            background: #fff;
            border: 1.5px solid #e2e8f0;
            border-radius: 18px;
            padding: 1.5rem;
            box-shadow: 0 2px 14px rgba(0, 0, 0, .04);
        }

        .ba-widget-title {
            font-family: 'Poppins', sans-serif;
            font-size: .82rem;
            font-weight: 700;
            color: #0f172a;
            text-transform: uppercase;
            letter-spacing: .08em;
            margin-bottom: 1.1rem;
            display: flex;
            align-items: center;
            gap: .5rem;
        }

        .ba-widget-title::after {
            content: '';
            flex: 1;
            height: 2px;
            background: linear-gradient(90deg, rgba(0, 116, 209, .3), transparent);
            border-radius: 2px;
        }

        /* Trending posts */
        .ba-trending-item {
            display: flex;
            gap: .9rem;
            align-items: flex-start;
            padding: .75rem 0;
            border-bottom: 1px solid #f1f5f9;
            text-decoration: none;
            transition: opacity .2s;
        }

        .ba-trending-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .ba-trending-item:first-child {
            padding-top: 0;
        }

        .ba-trending-item:hover {
            opacity: .75;
        }

        .ba-trending-num {
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            font-size: 1.3rem;
            color: #e2e8f0;
            line-height: 1;
            flex-shrink: 0;
            min-width: 28px;
        }

        .ba-trending-title {
            font-size: .82rem;
            font-weight: 600;
            color: #0f172a;
            line-height: 1.4;
            margin-bottom: .25rem;
        }

        .ba-trending-meta {
            font-size: .68rem;
            color: #94a3b8;
        }

        /* Categories widget */
        .ba-cat-list {
            display: flex;
            flex-direction: column;
            gap: .5rem;
        }

        .ba-cat-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: .55rem .75rem;
            border-radius: 10px;
            background: #f8fafc;
            text-decoration: none;
            transition: all .25s;
        }

        .ba-cat-row:hover {
            background: rgba(0, 116, 209, .07);
        }

        .ba-cat-row-label {
            font-size: .8rem;
            font-weight: 500;
            color: #334155;
            display: flex;
            align-items: center;
            gap: .4rem;
        }

        .ba-cat-row-count {
            font-size: .7rem;
            font-weight: 700;
            color: #0074d1;
            background: rgba(0, 116, 209, .1);
            border-radius: 50px;
            padding: .15rem .55rem;
        }

        /* Newsletter widget */
        .ba-widget-nl input {
            width: 100%;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            padding: .65rem .9rem;
            font-size: .8rem;
            color: #0f172a;
            background: #f8fafc;
            outline: none;
            font-family: 'Inter', sans-serif;
            margin-bottom: .6rem;
            transition: border-color .2s, box-shadow .2s;
        }

        .ba-widget-nl input:focus {
            border-color: #0074d1;
            box-shadow: 0 0 0 3px rgba(0, 116, 209, .1);
            background: #fff;
        }

        .ba-widget-nl button {
            width: 100%;
            background: linear-gradient(135deg, #0074d1, #38bdf8);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: .7rem;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: .82rem;
            cursor: pointer;
            transition: opacity .2s, transform .2s;
        }

        .ba-widget-nl button:hover {
            opacity: .88;
            transform: translateY(-1px);
        }

        /* Tags widget */
        .ba-tag-cloud {
            display: flex;
            flex-wrap: wrap;
            gap: .4rem;
        }

        .ba-tag {
            display: inline-flex;
            padding: .28rem .75rem;
            border-radius: 50px;
            border: 1.5px solid #e2e8f0;
            font-size: .73rem;
            font-weight: 500;
            color: #64748b;
            text-decoration: none;
            transition: all .2s;
            background: #fff;
        }

        .ba-tag:hover {
            border-color: #0074d1;
            color: #0074d1;
            background: rgba(0, 116, 209, .06);
        }

        /* ════════ RESPONSIVE ════════ */
        @media(max-width:1024px) {
            .ba-layout {
                grid-template-columns: 1fr;
            }

            .ba-sidebar {
                display: none;
            }
        }

        @media(max-width:768px) {
            .ba-hero-inner {
                grid-template-columns: 1fr;
            }

            .ba-hero-quick {
                display: none;
            }

            .ba-featured {
                grid-template-columns: 1fr;
            }

            .ba-feat-img {
                min-height: 220px;
            }

            .ba-articles-grid {
                grid-template-columns: 1fr;
            }
        }

        @media(max-width:480px) {
            .ba-hero-stats {
                gap: 1.5rem;
            }
        }
    </style>
</head>

<body>
    @include('articals.blue.BlueArtical.header')
    @yield('Section')
    @include('articals.blue.BlueArtical.footer')
    <script>
        // ── Scroll reveal ──
        const baReveal = () => {
            document.querySelectorAll('.ba-reveal').forEach(el => {
                if (el.getBoundingClientRect().top < window.innerHeight - 60)
                    el.classList.add('visible');
            });
        };
        window.addEventListener('scroll', baReveal, {
            passive: true
        });
        baReveal();

        // ── Load more (simple show-hidden stub) ──
        function loadMore() {
            const btn = document.getElementById('ba-load-more-btn');
            btn.innerHTML = `<svg class="spin" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg> Loading…`;
            btn.disabled = true;
            setTimeout(() => {
                btn.innerHTML = 'All articles loaded ✓';
                btn.style.opacity = '.5';
                btn.style.cursor = 'default';
            }, 1800);
        }

        // ── Sidebar newsletter ──
        function sideSubscribe() {
            const em = document.getElementById('side-nl-email');
            if (!em.value || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(em.value)) {
                em.style.borderColor = 'rgba(239,68,68,.6)';
                setTimeout(() => em.style.borderColor = '', 2000);
                return;
            }
            em.value = '';
            document.getElementById('side-nl-name').value = '';
            em.placeholder = '✓ You\'re subscribed!';
            setTimeout(() => em.placeholder = 'your@email.com', 4000);
        }

        // Spin keyframe for load-more
        const st = document.createElement('style');
        st.textContent = '@keyframes spin{to{transform:rotate(360deg)}}.spin{animation:spin .8s linear infinite}';
        document.head.appendChild(st);
    </script>
</body>

</html>