<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <title>WebLaunch Pro — Register Your Professional Website</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <style>
        /* #0074d1 */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #fff;
            color: #1a0a2e;
            overflow-x: hidden;
        }

        h1,
        h2,
        h3,
        h4,
        h5 {
            font-family: 'Poppins', sans-serif;
        }

        ::-webkit-scrollbar {
            width: 5px;
        }

        ::-webkit-scrollbar-track {
            background: #fdf4f9;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #FF2D9B, #FF6B35);
            border-radius: 9px;
        }

        /* ── Tokens ── */
        :root {
            --pink: #FF2D9B;
            --orange: #FF6B35;
            --pink-soft: rgba(255, 45, 155, .08);
            --orange-soft: rgba(255, 107, 53, .08);
            --text: #1a0a2e;
            --muted: #6b7280;
            --border: rgba(0, 0, 0, .07);
            --card: #fff;
        }

        /* ── Progress ── */
        #progress {
            position: fixed;
            top: 0;
            left: 0;
            height: 3px;
            background: linear-gradient(90deg, #FF2D9B, #FF6B35);
            z-index: 9999;
            transition: width .1s;
            width: 0;
        }

        /* ═══════════ NAVBAR ═══════════ */
        #navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            padding: 1.1rem 0;
            transition: all .4s;
        }

        #navbar.scrolled {
            background: rgba(255, 255, 255, .88);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border-bottom: 1px solid rgba(255, 45, 155, .1);
            box-shadow: 0 4px 30px rgba(255, 45, 155, .06);
        }

        .nav-inner {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: .55rem;
            text-decoration: none;
        }

        .logo-icon {
            width: 38px;
            height: 38px;
            border-radius: 11px;
            background: linear-gradient(135deg, #FF2D9B, #FF6B35);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 16px rgba(255, 45, 155, .3);
        }

        .logo-text {
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            font-size: 1.15rem;
            color: #1a0a2e;
        }

        .logo-text span {
            background: linear-gradient(120deg, #FF2D9B, #FF6B35);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: .2rem;
        }

        .nav-link {
            color: #6b7280;
            font-size: .85rem;
            font-weight: 500;
            padding: .45rem .9rem;
            border-radius: 50px;
            text-decoration: none;
            transition: all .3s;
        }

        .nav-link:hover {
            color: #FF2D9B;
            background: rgba(255, 45, 155, .06);
        }

        .nav-cta {
            background: linear-gradient(135deg, #FF2D9B, #FF6B35);
            color: #fff !important;
            padding: .5rem 1.4rem !important;
            font-weight: 700 !important;
            font-family: 'Poppins', sans-serif;
            border-radius: 50px;
            box-shadow: 0 4px 18px rgba(255, 45, 155, .3);
            transition: all .3s !important;
        }

        .nav-cta:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 26px rgba(255, 45, 155, .45) !important;
            background: rgba(255, 45, 155, .06) !important;
            background: linear-gradient(135deg, #ff4dab, #ff7d4d) !important;
        }

        .hamburger {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            padding: .4rem;
        }

        .hamburger span {
            display: block;
            width: 22px;
            height: 2px;
            background: #1a0a2e;
            border-radius: 2px;
            transition: all .3s;
        }

        #mobile-nav {
            display: none;
            background: rgba(255, 255, 255, .96);
            backdrop-filter: blur(20px);
            border-top: 1px solid rgba(255, 45, 155, .08);
            padding: 1rem 2rem 1.5rem;
        }

        #mobile-nav.open {
            display: block;
        }

        #mobile-nav a {
            display: block;
            color: #6b7280;
            padding: .6rem 0;
            font-size: .9rem;
            text-decoration: none;
            border-bottom: 1px solid rgba(0, 0, 0, .05);
        }

        /* ═══════════ HERO ═══════════ */
        #hero {
            min-height: 100vh;
            position: relative;
            display: flex;
            align-items: center;
            overflow: hidden;
            padding-top: 90px;
            background: #fff;
        }

        #hero-canvas {
            position: absolute;
            inset: 0;
            z-index: 0;
        }

        .hero-bg-layer {
            position: absolute;
            inset: 0;
            z-index: 1;
            background:
                radial-gradient(ellipse 70% 60% at 75% 40%, rgba(255, 45, 155, .07) 0%, transparent 65%),
                radial-gradient(ellipse 50% 50% at 20% 80%, rgba(255, 107, 53, .05) 0%, transparent 55%),
                radial-gradient(ellipse 40% 40% at 5% 15%, rgba(255, 45, 155, .04) 0%, transparent 50%);
        }

        .hero-grid {
            position: absolute;
            inset: 0;
            z-index: 1;
            background-image:
                linear-gradient(rgba(255, 45, 155, .04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 45, 155, .04) 1px, transparent 1px);
            background-size: 50px 50px;
            mask-image: radial-gradient(ellipse 80% 80% at 50% 50%, #000 30%, transparent 100%);
        }

        .glow-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(70px);
            pointer-events: none;
            z-index: 1;
        }

        .orb-1 {
            width: 450px;
            height: 450px;
            background: rgba(255, 45, 155, .1);
            top: -80px;
            right: 8%;
            animation: orbPulse 7s ease-in-out infinite;
        }

        .orb-2 {
            width: 320px;
            height: 320px;
            background: rgba(255, 107, 53, .08);
            bottom: -40px;
            right: 18%;
            animation: orbPulse 9s ease-in-out infinite 1s;
        }

        .orb-3 {
            width: 200px;
            height: 200px;
            background: rgba(255, 45, 155, .06);
            top: 45%;
            left: 2%;
            animation: orbPulse 6s ease-in-out infinite 2s;
        }

        @keyframes orbPulse {

            0%,
            100% {
                transform: scale(1);
                opacity: .6;
            }

            50% {
                transform: scale(1.2);
                opacity: 1;
            }
        }

        .hero-inner {
            position: relative;
            z-index: 10;
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 2rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
            width: 100%;
        }

        /* Left */
        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            background: linear-gradient(135deg, rgba(255, 45, 155, .1), rgba(255, 107, 53, .07));
            border: 1px solid rgba(255, 45, 155, .2);
            color: #FF2D9B;
            font-size: .72rem;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            padding: .4rem 1rem;
            border-radius: 50px;
            margin-bottom: 1rem;
            animation: fadeUp .6s .1s both;
        }

        .badge-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #FF2D9B;
            animation: ping 1.5s infinite;
        }

        @keyframes ping {

            0%,
            100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: .4;
                transform: scale(1.5);
            }
        }

        .hero-h1 {
            font-size: clamp(2.3rem, 4.2vw, 3.7rem);
            font-weight: 800;
            line-height: 1.1;
            letter-spacing: -.025em;
            color: #1a0a2e;
            margin-bottom: 1rem;
            animation: fadeUp .6s .2s both;
        }

        .grad {
            background: linear-gradient(120deg, #FF2D9B 0%, #FF6B35 70%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-sub {
            color: #6b7280;
            font-size: 1.02rem;
            line-height: 1.75;
            max-width: 480px;
            margin-bottom: 2rem;
            animation: fadeUp .6s .3s both;
        }

        .feature-pills {
            display: flex;
            flex-wrap: wrap;
            gap: .55rem;
            margin-bottom: 2.2rem;
            animation: fadeUp .6s .4s both;
        }

        .pill {
            display: flex;
            align-items: center;
            gap: .4rem;
            padding: .38rem .85rem;
            border-radius: 50px;
            font-size: .76rem;
            font-weight: 500;
            border: 1.5px solid rgba(255, 45, 155, .15);
            background: rgba(255, 45, 155, .04);
            color: #FF2D9B;
            transition: all .3s;
            cursor: default;
        }

        .pill:hover {
            background: rgba(255, 45, 155, .1);
            border-color: rgba(255, 45, 155, .3);
        }

        .hero-btns {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: .9rem;
            animation: fadeUp .6s .5s both;
        }

        /* Primary CTA */
        .btn-register {
            display: inline-flex;
            align-items: center;
            gap: .6rem;
            background: linear-gradient(135deg, #FF2D9B, #FF6B35);
            color: #fff;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: .92rem;
            padding: .88rem 2.1rem;
            border-radius: 50px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            box-shadow: 0 6px 28px rgba(255, 45, 155, .35), 0 0 0 0 rgba(255, 45, 155, .2);
            transition: all .35s;
            position: relative;
            overflow: hidden;
        }

        .btn-register::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, .18), transparent);
            opacity: 0;
            transition: opacity .3s;
        }

        .btn-register:hover {
            transform: translateY(-4px);
            box-shadow: 0 14px 40px rgba(255, 45, 155, .45), 0 0 0 8px rgba(255, 45, 155, .07);
        }

        .btn-register:hover::before {
            opacity: 1;
        }

        .btn-register::after {
            content: '';
            position: absolute;
            inset: -2px;
            border-radius: 52px;
            border: 2px solid rgba(255, 45, 155, .4);
            animation: pulseRing 2.5s ease-out infinite;
            pointer-events: none;
        }

        @keyframes pulseRing {
            0% {
                opacity: .8;
                transform: scale(1);
            }

            100% {
                opacity: 0;
                transform: scale(1.2);
            }
        }

        .btn-contact {
            display: inline-flex;
            align-items: center;
            gap: .55rem;
            background: transparent;
            color: #1a0a2e;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: .88rem;
            padding: .85rem 1.8rem;
            border-radius: 50px;
            border: 1.5px solid rgba(0, 0, 0, .12);
            cursor: pointer;
            text-decoration: none;
            transition: all .35s;
        }

        .btn-contact:hover {
            border-color: rgba(255, 107, 53, .5);
            color: #FF6B35;
            background: rgba(255, 107, 53, .05);
            transform: translateY(-4px);
        }

        /* Social proof */
        .social-proof {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-top: 2rem;
            animation: fadeUp .6s .65s both;
        }

        .avatars {
            display: flex;
        }

        .ava {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            border: 2.5px solid #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .65rem;
            font-weight: 700;
            color: #fff;
            margin-left: -9px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .12);
        }

        .ava:first-child {
            margin-left: 0;
        }

        .proof-text {
            font-size: .78rem;
            color: #9ca3af;
        }

        .proof-text strong {
            color: #1a0a2e;
        }

        .proof-stars {
            color: #FF6B35;
            font-size: .72rem;
            letter-spacing: 1px;
            margin-bottom: .15rem;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(24px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeRight {
            from {
                opacity: 0;
                transform: translateX(36px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* ── Hero Right: Girl ── */
        .hero-right {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: flex-end;
            animation: fadeRight .8s .3s both;
        }

        .girl-wrap {
            position: relative;
            width: 100%;
            max-width: 490px;
        }

        /* Clip-path frame */
        .girl-border {
            position: absolute;
            inset: -3px;
            z-index: 2;
            clip-path: polygon(16% 0%, 100% 0%, 100% 84%, 84% 100%, 0% 100%, 0% 16%);
            background: linear-gradient(135deg, #FF2D9B, #FF6B35, #FF2D9B);
            border-radius: 4px;
            animation: gradShift 4s linear infinite;
            background-size: 200% 200%;
        }

        @keyframes gradShift {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .girl-border-inner {
            position: absolute;
            inset: 3px;
            clip-path: polygon(16% 0%, 100% 0%, 100% 84%, 84% 100%, 0% 100%, 0% 16%);
            background: #fff;
            border-radius: 3px;
        }

        .girl-clip {
            position: relative;
            z-index: 3;
            clip-path: polygon(16% 0%, 100% 0%, 100% 84%, 84% 100%, 0% 100%, 0% 16%);
            overflow: hidden;
            background: #f9f0fa;
        }

        .girl-clip img {
            width: 100%;
            height: 570px;
            object-fit: cover;
            object-position: top center;
            display: block;
            filter: contrast(1.04) saturate(1.08);
        }

        .girl-clip::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(255, 245, 250, .25) 0%, transparent 50%);
            z-index: 1;
        }

        /* Background blob behind girl */
        .girl-blob {
            position: absolute;
            width: 110%;
            height: 110%;
            top: -5%;
            left: -5%;
            z-index: 0;
            background: radial-gradient(ellipse 70% 70% at 50% 50%, rgba(255, 45, 155, .07) 0%, transparent 70%);
            border-radius: 50%;
            filter: blur(30px);
        }

        /* Floating cards */
        .float-card {
            position: absolute;
            z-index: 10;
            background: rgba(255, 255, 255, .92);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            border: 1px solid rgba(255, 255, 255, .9);
            border-radius: 16px;
            padding: .9rem 1.1rem;
            box-shadow: 0 8px 40px rgba(0, 0, 0, .1), 0 2px 8px rgba(255, 45, 155, .06);
            animation: floatY 4s ease-in-out infinite;
            min-width: 140px;
        }

        .float-card:nth-child(2) {
            animation-delay: .7s;
        }

        .float-card:nth-child(3) {
            animation-delay: 1.5s;
        }

        .float-card:nth-child(4) {
            animation-delay: 2.3s;
        }

        @keyframes floatY {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .fc-label {
            font-size: .62rem;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: .07em;
            margin-bottom: .25rem;
        }

        .fc-val {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: .9rem;
            color: #1a0a2e;
        }

        .fc-bar {
            height: 4px;
            border-radius: 2px;
            background: linear-gradient(90deg, #FF2D9B, #FF6B35);
            margin-top: .4rem;
        }

        .fc-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            display: inline-block;
            margin-right: .35rem;
        }

        /* ═══════════ SHARED SECTION STYLES ═══════════ */
        section {
            padding: 6rem 0;
        }

        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .section-tag {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            background: linear-gradient(135deg, rgba(255, 45, 155, .08), rgba(255, 107, 53, .06));
            border: 1px solid rgba(255, 45, 155, .18);
            color: #FF2D9B;
            font-size: .7rem;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            padding: .35rem .9rem;
            border-radius: 50px;
            margin-bottom: 1rem;
        }

        .grad-text {
            background: linear-gradient(120deg, #FF2D9B, #FF6B35);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .section-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .section-header h2 {
            font-size: clamp(1.8rem, 3.2vw, 2.7rem);
            font-weight: 800;
            color: #1a0a2e;
            margin-bottom: .75rem;
            letter-spacing: -.02em;
        }

        .section-header p {
            color: #9ca3af;
            max-width: 520px;
            margin: 0 auto;
            line-height: 1.7;
            font-size: .95rem;
        }

        /* ═══════════ BENEFITS ═══════════ */
        #benefits {
            background: #fdfafe;
        }

        .benefits-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 1.5rem;
        }

        .b-card {
            background: #fff;
            border: 1.5px solid rgba(0, 0, 0, .05);
            border-radius: 22px;
            padding: 2rem;
            position: relative;
            overflow: hidden;
            transition: all .4s cubic-bezier(.4, 0, .2, 1);
            cursor: default;
            box-shadow: 0 2px 16px rgba(0, 0, 0, .04);
        }

        .b-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255, 45, 155, .04), rgba(255, 107, 53, .03));
            opacity: 0;
            transition: opacity .4s;
        }

        .b-card:hover {
            transform: translateY(-8px);
            border-color: rgba(255, 45, 155, .2);
            box-shadow: 0 20px 60px rgba(255, 45, 155, .1);
        }

        .b-card:hover::before {
            opacity: 1;
        }

        .b-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, rgba(255, 45, 155, .1), rgba(255, 107, 53, .07));
            font-size: 1.3rem;
            margin-bottom: 1.2rem;
            border: 1px solid rgba(255, 45, 155, .12);
        }

        .b-card h3 {
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: .55rem;
            color: #1a0a2e;
        }

        .b-card p {
            font-size: .84rem;
            color: #9ca3af;
            line-height: 1.65;
        }

        /* ═══════════ SHOWCASE ═══════════ */
        #showcase {
            background: #fff;
        }

        .showcase-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        .s-card {
            border-radius: 22px;
            overflow: hidden;
            position: relative;
            border: 1.5px solid rgba(0, 0, 0, .05);
            transition: all .4s cubic-bezier(.4, 0, .2, 1);
            box-shadow: 0 2px 16px rgba(0, 0, 0, .04);
        }

        .s-card:hover {
            transform: translateY(-9px);
            box-shadow: 0 24px 60px rgba(255, 45, 155, .13);
            border-color: rgba(255, 45, 155, .25);
        }

        .s-img-wrap {
            height: 210px;
            overflow: hidden;
            position: relative;
        }

        .s-card:nth-child(3n+1) .s-img-wrap {
            clip-path: polygon(0 0, 100% 0, 100% 88%, 88% 100%, 0 100%);
        }

        .s-card:nth-child(3n+2) .s-img-wrap {
            clip-path: polygon(12% 0, 100% 0, 100% 100%, 0 100%, 0 12%);
        }

        .s-card:nth-child(3n+3) .s-img-wrap {
            clip-path: polygon(0 0, 88% 0, 100% 12%, 100% 100%, 0 100%);
        }

        .s-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .5s;
            display: block;
        }

        .s-card:hover .s-img-wrap img {
            transform: scale(1.07);
        }

        .s-overlay {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: .8rem;
            background: rgba(26, 10, 46, .65);
            backdrop-filter: blur(3px);
            opacity: 0;
            transition: opacity .4s;
        }

        .s-card:hover .s-overlay {
            opacity: 1;
        }

        .btn-preview {
            display: inline-flex;
            align-items: center;
            gap: .45rem;
            background: linear-gradient(135deg, #FF2D9B, #FF6B35);
            color: #fff;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: .78rem;
            padding: .55rem 1.3rem;
            border-radius: 50px;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 18px rgba(255, 45, 155, .4);
            transition: all .3s;
        }

        .btn-preview:hover {
            transform: scale(1.06);
        }

        .btn-preview-ol {
            background: rgba(255, 255, 255, .1);
            color: #fff;
            border: 1.5px solid rgba(255, 255, 255, .4);
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: .75rem;
            padding: .48rem 1.1rem;
            border-radius: 50px;
            cursor: pointer;
            transition: all .3s;
            display: inline-flex;
            align-items: center;
            gap: .35rem;
            backdrop-filter: blur(4px);
        }

        .btn-preview-ol:hover {
            border-color: rgba(255, 107, 53, .7);
            color: #FF9F5A;
        }

        .s-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            z-index: 3;
            background: rgba(255, 255, 255, .92);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, .9);
            border-radius: 50px;
            padding: .26rem .75rem;
            font-size: .68rem;
            font-weight: 700;
            color: #1a0a2e;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .08);
        }

        .s-meta {
            padding: 1.2rem 1.4rem;
            background: #fff;
        }

        .s-cat {
            font-size: .67rem;
            color: #FF2D9B;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .08em;
            margin-bottom: .3rem;
        }

        .s-title {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: .95rem;
            color: #1a0a2e;
        }

        .s-desc {
            font-size: .77rem;
            color: #9ca3af;
            margin-top: .22rem;
        }

        /* ═══════════ PROCESS ═══════════ */
        #process {
            background: #fdfafe;
        }

        .process-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 2.5rem;
            position: relative;
        }

        .process-grid::before {
            content: '';
            position: absolute;
            top: 38px;
            left: 12%;
            right: 12%;
            height: 2px;
            background: linear-gradient(90deg, rgba(255, 45, 155, .2), rgba(255, 107, 53, .2), rgba(255, 45, 155, .2));
            z-index: 0;
        }

        @media(max-width:768px) {
            .process-grid::before {
                display: none;
            }
        }

        .p-step {
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .p-num {
            width: 76px;
            height: 76px;
            border-radius: 50%;
            margin: 0 auto 1.3rem;
            background: #fff;
            border: 2px solid rgba(255, 45, 155, .2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            font-size: 1.3rem;
            color: #FF2D9B;
            box-shadow: 0 6px 24px rgba(255, 45, 155, .1);
            transition: all .35s;
        }

        .p-step:hover .p-num {
            background: linear-gradient(135deg, #FF2D9B, #FF6B35);
            border-color: transparent;
            color: #fff;
            transform: scale(1.08);
            box-shadow: 0 10px 30px rgba(255, 45, 155, .35);
        }

        .p-step h3 {
            font-weight: 700;
            font-size: 1rem;
            margin-bottom: .5rem;
            color: #1a0a2e;
        }

        .p-step p {
            font-size: .83rem;
            color: #9ca3af;
            line-height: 1.65;
        }

        /* ═══════════ WHY US ═══════════ */
        #why {
            background: #fff;
        }

        .why-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 5rem;
            align-items: center;
        }

        .why-cards {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .w-card {
            background: #fdfafe;
            border: 1.5px solid rgba(0, 0, 0, .05);
            border-radius: 16px;
            padding: 1.3rem;
            transition: all .35s;
            cursor: default;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .03);
        }

        .w-card:hover {
            border-color: rgba(255, 45, 155, .2);
            background: #fff;
            transform: translateY(-4px);
            box-shadow: 0 12px 36px rgba(255, 45, 155, .08);
        }

        .w-emoji {
            font-size: 1.4rem;
            margin-bottom: .6rem;
        }

        .w-card h4 {
            font-size: .87rem;
            font-weight: 700;
            margin-bottom: .2rem;
            color: #1a0a2e;
        }

        .w-card p {
            font-size: .74rem;
            color: #9ca3af;
        }

        .stat-row {
            display: flex;
            gap: 2.5rem;
            flex-wrap: wrap;
            margin: 2rem 0;
        }

        .stat-val {
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            font-size: 2.2rem;
            background: linear-gradient(135deg, #FF2D9B, #FF6B35);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .stat-lbl {
            font-size: .78rem;
            color: #9ca3af;
            margin-top: .1rem;
        }

        /* ═══════════ TESTIMONIALS ═══════════ */
        #testimonials {
            background: #fdfafe;
        }

        .t-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        .t-card {
            background: #fff;
            border: 1.5px solid rgba(0, 0, 0, .05);
            border-radius: 22px;
            padding: 2rem;
            position: relative;
            overflow: hidden;
            transition: all .4s;
            box-shadow: 0 2px 16px rgba(0, 0, 0, .04);
        }

        .t-card:hover {
            border-color: rgba(255, 45, 155, .18);
            transform: translateY(-7px);
            box-shadow: 0 20px 50px rgba(255, 45, 155, .09);
        }

        .t-card::before {
            content: '"';
            position: absolute;
            top: .5rem;
            right: 1.3rem;
            font-size: 5rem;
            line-height: 1;
            font-family: Georgia, serif;
            color: rgba(255, 45, 155, .08);
        }

        .t-stars {
            font-size: .88rem;
            letter-spacing: 2px;
            margin-bottom: .8rem;
            background: linear-gradient(90deg, #FF2D9B, #FF6B35);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .t-text {
            font-size: .86rem;
            color: #6b7280;
            line-height: 1.72;
            margin-bottom: 1.4rem;
        }

        .t-author {
            display: flex;
            align-items: center;
            gap: .75rem;
        }

        .t-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: .78rem;
            color: #fff;
            flex-shrink: 0;
        }

        .t-name {
            font-weight: 700;
            font-size: .87rem;
            color: #1a0a2e;
        }

        .t-role {
            font-size: .74rem;
            color: #9ca3af;
            margin-top: .1rem;
        }

        /* ═══════════ FAQ ═══════════ */
        #faq {
            background: #fff;
        }

        .faq-wrap {
            max-width: 720px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: .7rem;
        }

        .faq-item {
            background: #fdfafe;
            border: 1.5px solid rgba(0, 0, 0, .05);
            border-radius: 16px;
            overflow: hidden;
            transition: all .3s;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .03);
        }

        .faq-item.active {
            border-color: rgba(255, 45, 155, .2);
            box-shadow: 0 6px 28px rgba(255, 45, 155, .08);
            background: #fff;
        }

        .faq-btn {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.2rem 1.5rem;
            background: transparent;
            border: none;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: .9rem;
            color: #1a0a2e;
            text-align: left;
            gap: 1rem;
        }

        .faq-icon {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: rgba(255, 45, 155, .07);
            border: 1.5px solid rgba(255, 45, 155, .15);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: all .35s;
        }

        .faq-icon svg {
            stroke: #FF2D9B;
            transition: stroke .3s;
        }

        .faq-item.active .faq-icon {
            background: linear-gradient(135deg, #FF2D9B, #FF6B35);
            border-color: transparent;
            transform: rotate(45deg);
        }

        .faq-item.active .faq-icon svg {
            stroke: #fff;
        }

        .faq-body {
            max-height: 0;
            overflow: hidden;
            transition: max-height .45s cubic-bezier(.4, 0, .2, 1);
        }

        .faq-inner {
            padding: 0 1.5rem 1.2rem;
            font-size: .86rem;
            color: #6b7280;
            line-height: 1.72;
        }

        /* ═══════════ CTA ═══════════ */
        #cta {
            background: linear-gradient(135deg, #fff5fb 0%, #fffaf6 50%, #fff5fb 100%);
            position: relative;
            overflow: hidden;
            padding: 6rem 0;
        }

        #cta::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 60% 70% at 20% 50%, rgba(255, 45, 155, .07) 0%, transparent 60%),
                radial-gradient(ellipse 60% 70% at 80% 50%, rgba(255, 107, 53, .06) 0%, transparent 60%);
        }

        .cta-inner {
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .cta-inner h2 {
            font-size: clamp(1.9rem, 3.5vw, 3rem);
            font-weight: 800;
            color: #1a0a2e;
            margin-bottom: 1rem;
            letter-spacing: -.02em;
        }

        .cta-inner p {
            color: #9ca3af;
            font-size: .97rem;
            max-width: 480px;
            margin: 0 auto 2.5rem;
            line-height: 1.7;
        }

        /* CTA decorative card row */
        .cta-cards {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 2.5rem;
            flex-wrap: wrap;
        }

        .cta-mini-card {
            background: #fff;
            border: 1.5px solid rgba(255, 45, 155, .15);
            border-radius: 14px;
            padding: .7rem 1.2rem;
            font-size: .78rem;
            font-weight: 600;
            color: #FF2D9B;
            box-shadow: 0 4px 16px rgba(255, 45, 155, .08);
            display: flex;
            align-items: center;
            gap: .45rem;
        }

        /* ═══════════ FOOTER ═══════════ */
        footer {
            background: #1a0a2e;
            padding: 4rem 0 2rem;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1.5fr;
            gap: 3rem;
            margin-bottom: 3rem;
        }

        .footer-brand p {
            font-size: .83rem;
            color: rgba(255, 255, 255, .4);
            line-height: 1.7;
            margin-top: .75rem;
            max-width: 250px;
        }

        .f-heading {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: .75rem;
            text-transform: uppercase;
            letter-spacing: .1em;
            color: rgba(255, 255, 255, .3);
            margin-bottom: 1.2rem;
        }

        .f-links {
            display: flex;
            flex-direction: column;
            gap: .6rem;
        }

        .f-link {
            color: rgba(255, 255, 255, .45);
            font-size: .83rem;
            text-decoration: none;
            transition: color .3s;
        }

        .f-link:hover {
            color: #FF7CC4;
        }

        .f-contact p {
            display: flex;
            align-items: flex-start;
            gap: .5rem;
            font-size: .82rem;
            color: rgba(255, 255, 255, .4);
            margin-bottom: .65rem;
            line-height: 1.5;
        }

        .socials {
            display: flex;
            gap: .55rem;
            margin-top: 1.2rem;
        }

        .soc-btn {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .06);
            border: 1px solid rgba(255, 255, 255, .08);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all .3s;
            text-decoration: none;
        }

        .soc-btn:hover {
            background: linear-gradient(135deg, #FF2D9B, #FF6B35);
            border-color: transparent;
            transform: translateY(-3px);
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, .06);
            padding-top: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: .75rem;
        }

        .footer-bottom p {
            font-size: .78rem;
            color: rgba(255, 255, 255, .25);
        }

        .footer-bottom-links {
            display: flex;
            gap: 1.5rem;
        }

        .footer-bottom-links a {
            font-size: .76rem;
            color: rgba(255, 255, 255, .25);
            text-decoration: none;
            transition: color .3s;
        }

        .footer-bottom-links a:hover {
            color: #FF7CC4;
        }

        /* Logo in footer (light version) */
        .logo-light .logo-text {
            color: #fff;
        }

        /* ═══════════ DIVIDERS ═══════════ */
        .wave-divider {
            height: 60px;
            overflow: hidden;
            line-height: 0;
        }

        .wave-divider svg {
            display: block;
            width: 100%;
            height: 60px;
        }

        /* ═══════════ REVEAL ═══════════ */
        .reveal {
            opacity: 0;
            transform: translateY(28px);
            transition: opacity .7s, transform .7s;
        }

        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .reveal-l {
            opacity: 0;
            transform: translateX(-28px);
            transition: opacity .7s, transform .7s;
        }

        .reveal-l.visible {
            opacity: 1;
            transform: translateX(0);
        }

        .reveal-r {
            opacity: 0;
            transform: translateX(28px);
            transition: opacity .7s, transform .7s;
        }

        .reveal-r.visible {
            opacity: 1;
            transform: translateX(0);
        }

        /* ═══════════ RESPONSIVE ═══════════ */
        @media(max-width:1024px) {
            .hero-inner {
                grid-template-columns: 1fr;
                gap: 3.5rem;
                text-align: center;
                padding-top: 2rem;
            }

            .hero-sub,
            .feature-pills,
            .hero-btns,
            .social-proof {
                max-width: 100%;
                justify-content: center;
                margin-left: auto;
                margin-right: auto;
            }

            .hero-sub {
                margin-left: auto;
                margin-right: auto;
            }

            .girl-wrap {
                max-width: 370px;
                margin: 0 auto;
            }

            .why-grid {
                grid-template-columns: 1fr;
                gap: 2.5rem;
            }

            .footer-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media(max-width:768px) {

            .nav-links,
            .nav-cta-wrap {
                display: none;
            }

            .hamburger {
                display: flex;
            }

            section {
                padding: 4rem 0;
            }

            .girl-clip img {
                height: 400px;
            }

            .float-card {
                display: none;
            }

            .footer-grid {
                grid-template-columns: 1fr;
            }

            .why-cards {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media(max-width:480px) {
            .hero-h1 {
                font-size: 2rem;
            }

            .why-cards {
                grid-template-columns: 1fr;
            }

            .cta-cards {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>

<body>

    <div id="progress"></div>

    <!-- ══════════════ NAVBAR ══════════════ -->
    <nav id="navbar">
        <div class="nav-inner">
            <a href="#" class="logo">
                <div class="logo-icon"><svg width="17" height="17" fill="none" stroke="#fff" stroke-width="2.5" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" />
                        <path d="M12 2a15 15 0 0 1 4 10 15 15 0 0 1-4 10 15 15 0 0 1-4-10 15 15 0 0 1 4-10z" />
                        <path d="M2 12h20" />
                    </svg></div>
                <span class="logo-text">WebLaunch<span>Pro</span></span>
            </a>
            <div class="nav-links">
                <a href="#benefits" class="nav-link">Benefits</a>
                <a href="#showcase" class="nav-link">Showcase</a>
                <a href="#process" class="nav-link">Process</a>
                <a href="#why" class="nav-link">Why Us</a>
                <a href="#faq" class="nav-link">FAQ</a>
            </div>
            <div class="nav-cta-wrap" style="display:flex;gap:.75rem;align-items:center;">
                <!-- <a href="tel:+919000000000" class="nav-link" style="font-size:.82rem;">📞 +91 90000 00000</a> -->
                <a href="{{route('register')}}" class="nav-link nav-cta">Register Now</a>
            </div>
            <div class="hamburger" id="hamburger"><span></span><span></span><span></span></div>
        </div>
        <div id="mobile-nav">
            <a href="#benefits">Benefits</a>
            <a href="#showcase">Showcase</a>
            <a href="#process">Process</a>
            <a href="#why">Why Us</a>
            <a href="#faq">FAQ</a>
            <a href="{{route('register')}}" style="color:#FF2D9B!important;font-weight:700;">🚀 Register Now</a>
        </div>
    </nav>

    <!-- ══════════════ HERO ══════════════ -->
    <section id="hero">
        <canvas id="hero-canvas"></canvas>
        <div class="hero-bg-layer"></div>
        <div class="hero-grid"></div>
        <div class="glow-orb orb-1"></div>
        <div class="glow-orb orb-2"></div>
        <div class="glow-orb orb-3"></div>

        <div class="hero-inner">
            <!-- LEFT -->
            <div class="hero-left">
                <div class="hero-badge">
                    <span class="badge-dot"></span>
                    ✦ One-Time Registration · Go Live in 48 Hours
                </div>

                <h1 class="hero-h1">
                    Launch Your<br />
                    <span class="grad">Professional Website</span><br />
                    in Minutes
                </h1>

                <p class="hero-sub">
                    Register once, provide your business details — and we'll build, configure, and activate your fully branded website. Professional, fast, and ready to grow.
                </p>

                <div class="feature-pills">
                    <div class="pill">✦ Domain Setup</div>
                    <div class="pill">✦ SEO Ready</div>
                    <div class="pill">✦ Mobile First</div>
                    <div class="pill">✦ Social Integration</div>
                    <div class="pill">✦ Custom Branding</div>
                    <div class="pill">✦ Fast Activation</div>
                </div>

                <div class="hero-btns">
                    <a href="{{route('register')}}" class="btn-register" id="register-cta">
                        <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path d="M5 12h14M12 5l7 7-7 7" />
                        </svg>
                        Register Now — Free
                    </a>
                    <a href="tel:+919000000000" class="btn-contact">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 11 19.79 19.79 0 0 1 1.61 2.4 2 2 0 0 1 3.58.22h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 7.91a16 16 0 0 0 6.18 6.18l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 14.92z" />
                        </svg>
                        Contact Support
                    </a>
                </div>

                <div class="social-proof">
                    <div class="avatars">
                        <div class="ava" style="background:linear-gradient(135deg,#FF2D9B,#FF6B35);">RK</div>
                        <div class="ava" style="background:linear-gradient(135deg,#FF6B35,#FF9F5A);">PS</div>
                        <div class="ava" style="background:linear-gradient(135deg,#a855f7,#ec4899);">AM</div>
                        <div class="ava" style="background:linear-gradient(135deg,#06b6d4,#3b82f6);">SG</div>
                    </div>
                    <div>
                        <div class="proof-stars">★★★★★</div>
                        <p class="proof-text"><strong>500+</strong> websites launched &amp; trusted across India</p>
                    </div>
                </div>
            </div>

            <!-- RIGHT: Girl image -->
            <div class="hero-right">
                <div class="girl-wrap">
                    <div class="girl-blob"></div>
                    <div class="girl-border">
                        <div class="girl-border-inner"></div>
                    </div>
                    <div class="girl-clip" style="position:relative;z-index:3;">
                        <img
                            src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=700&h=760&fit=crop&crop=top&q=85"
                            alt="Professional web designer excited about website launch"
                            loading="eager" />
                    </div>

                    <!-- Floating stat cards -->
                    <div class="float-card" style="top:8%;left:-20%;">
                        <div class="fc-label">Live Traffic</div>
                        <div class="fc-val">2,847 <span style="font-size:.68rem;color:#FF2D9B;font-weight:700;">↑ 24%</span></div>
                        <div class="fc-bar" style="width:76%;"></div>
                    </div>

                    <div class="float-card" style="top:30%;right:-18%;min-width:132px;">
                        <div class="fc-label">Status</div>
                        <div class="fc-val" style="font-size:.83rem;"><span class="fc-dot" style="background:#22c55e;animation:ping 1.5s infinite;box-shadow:0 0 6px rgba(34,197,94,.5);"></span>Live &amp; Active</div>
                    </div>

                    <div class="float-card" style="bottom:30%;left:-22%;min-width:148px;">
                        <div class="fc-label">SEO Score</div>
                        <div class="fc-val">98 <span style="font-size:.7rem;color:#9ca3af;">/ 100</span></div>
                        <div class="fc-bar" style="width:98%;background:linear-gradient(90deg,#22c55e,#4ade80);"></div>
                    </div>

                    <div class="float-card" style="bottom:8%;right:-17%;min-width:138px;">
                        <div class="fc-label">Setup</div>
                        <div class="fc-val" style="font-size:.83rem;color:#FF2D9B;">✓ Complete!</div>
                        <div class="fc-bar" style="width:100%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- wave divider -->
    <div class="wave-divider" style="background:#fdfafe;"><svg viewBox="0 0 1440 60" preserveAspectRatio="none" fill="#fff">
            <path d="M0,60L48,50C96,40,192,20,288,16.7C384,13,480,27,576,33.3C672,40,768,40,864,33.3C960,27,1056,13,1152,10C1248,7,1344,13,1392,16.7L1440,20L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z" />
        </svg></div>

    <!-- ══════════════ BENEFITS ══════════════ -->
    <section id="benefits">
        <div class="container">
            <div class="section-header reveal">
                <div class="section-tag">✦ Why Register</div>
                <h2>Everything You Need to <span class="grad-text">Go Live</span></h2>
                <p>One registration unlocks a complete done-for-you website solution crafted precisely for your business goals.</p>
            </div>
            <div class="benefits-grid">
                <div class="b-card reveal" style="transition-delay:.05s">
                    <div class="b-icon">🌐</div>
                    <h3>Complete Website Setup</h3>
                    <p>Every element professionally configured — layout, content, navigation, and full functionality.</p>
                </div>
                <div class="b-card reveal" style="transition-delay:.1s">
                    <div class="b-icon">📱</div>
                    <h3>Social Media Integration</h3>
                    <p>Facebook, Instagram, LinkedIn, YouTube and more — seamlessly connected and synced.</p>
                </div>
                <div class="b-card reveal" style="transition-delay:.15s">
                    <div class="b-icon">🎨</div>
                    <h3>Domain & Branding</h3>
                    <p>Custom domain with premium branding perfectly aligned to your business identity.</p>
                </div>
                <div class="b-card reveal" style="transition-delay:.2s">
                    <div class="b-icon">🔍</div>
                    <h3>SEO Ready</h3>
                    <p>Meta tags, structured data, sitemap, and full on-page SEO baked into every single page.</p>
                </div>
                <div class="b-card reveal" style="transition-delay:.25s">
                    <div class="b-icon">⚡</div>
                    <h3>Mobile Responsive</h3>
                    <p>Pixel-perfect experience across all smartphones, tablets, and desktop screens.</p>
                </div>
                <div class="b-card reveal" style="transition-delay:.3s">
                    <div class="b-icon">🚀</div>
                    <h3>Fast Activation</h3>
                    <p>Quick verification, configuration, and your website goes live within just 48 hours.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- wave divider -->
    <div class="wave-divider" style="background:#fff;"><svg viewBox="0 0 1440 60" preserveAspectRatio="none" fill="#fdfafe">
            <path d="M0,0L48,10C96,20,192,40,288,43.3C384,47,480,33,576,26.7C672,20,768,20,864,26.7C960,33,1056,47,1152,50C1248,53,1344,47,1392,43.3L1440,40L1440,60L1392,60C1344,60,1248,60,1152,60C1056,60,960,60,864,60C768,60,672,60,576,60C480,60,384,60,288,60C192,60,96,60,48,60L0,60Z" />
        </svg></div>

    <!-- ══════════════ SHOWCASE ══════════════ -->
    <section id="showcase">
        <div class="container">
            <div class="section-header reveal">
                <div class="section-tag">✦ Website Showcase</div>
                <h2>Beautifully Crafted <span class="grad-text">Page Templates</span></h2>
                <p>Every page designed with precision, modern aesthetics, and conversion in mind — hover to preview.</p>
            </div>
            <div class="showcase-grid">

                <!-- <div class="s-card reveal" style="transition-delay:.05s">
                    <div class="s-img-wrap">
                        <span class="s-badge">🏠 Corporate</span>
                        <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=600&h=400&fit=crop&q=80" alt="Corporate homepage" loading="lazy" />
                        <div class="s-overlay">
                            <button class="btn-preview" onclick="showPreview('Home Page')">👁 Live Preview</button>
                            <button class="btn-preview-ol">+ View Details</button>
                        </div>
                    </div>
                    <div class="s-meta">
                        <div class="s-cat">Corporate</div>
                        <div class="s-title">Home Page</div>
                        <div class="s-desc">Hero · Features · CTA · Testimonials</div>
                    </div>
                </div>

                <div class="s-card reveal" style="transition-delay:.1s">
                    <div class="s-img-wrap">
                        <span class="s-badge">🛒 E-commerce</span>
                        <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=600&h=400&fit=crop&q=80" alt="Online store" loading="lazy" />
                        <div class="s-overlay">
                            <button class="btn-preview" onclick="showPreview('Online Store')">👁 Live Preview</button>
                            <button class="btn-preview-ol">+ View Details</button>
                        </div>
                    </div>
                    <div class="s-meta">
                        <div class="s-cat">E-commerce</div>
                        <div class="s-title">Online Store</div>
                        <div class="s-desc">Products · Cart · Checkout · Filters</div>
                    </div>
                </div>

                <div class="s-card reveal" style="transition-delay:.15s">
                    <div class="s-img-wrap">
                        <span class="s-badge">💼 Portfolio</span>
                        <img src="https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?w=600&h=400&fit=crop&q=80" alt="Portfolio website" loading="lazy" />
                        <div class="s-overlay">
                            <button class="btn-preview" onclick="showPreview('Creative Portfolio')">👁 Live Preview</button>
                            <button class="btn-preview-ol">+ View Details</button>
                        </div>
                    </div>
                    <div class="s-meta">
                        <div class="s-cat">Portfolio</div>
                        <div class="s-title">Creative Portfolio</div>
                        <div class="s-desc">Work · About · Skills · Contact</div>
                    </div>
                </div>

                <div class="s-card reveal" style="transition-delay:.2s">
                    <div class="s-img-wrap">
                        <span class="s-badge">🏥 Healthcare</span>
                        <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=600&h=400&fit=crop&q=80" alt="Healthcare website" loading="lazy" />
                        <div class="s-overlay">
                            <button class="btn-preview" onclick="showPreview('Medical Clinic')">👁 Live Preview</button>
                            <button class="btn-preview-ol">+ View Details</button>
                        </div>
                    </div>
                    <div class="s-meta">
                        <div class="s-cat">Healthcare</div>
                        <div class="s-title">Medical Clinic</div>
                        <div class="s-desc">Services · Booking · Doctors · FAQ</div>
                    </div>
                </div>

                <div class="s-card reveal" style="transition-delay:.25s">
                    <div class="s-img-wrap">
                        <span class="s-badge">🍽 Restaurant</span>
                        <img src="https://images.unsplash.com/photo-1552566626-52f8b828add9?w=600&h=400&fit=crop&q=80" alt="Restaurant website" loading="lazy" />
                        <div class="s-overlay">
                            <button class="btn-preview" onclick="showPreview('Food & Dining')">👁 Live Preview</button>
                            <button class="btn-preview-ol">+ View Details</button>
                        </div>
                    </div>
                    <div class="s-meta">
                        <div class="s-cat">Restaurant</div>
                        <div class="s-title">Food & Dining</div>
                        <div class="s-desc">Menu · Gallery · Reservations · Map</div>
                    </div>
                </div>

                <div class="s-card reveal" style="transition-delay:.3s">
                    <div class="s-img-wrap">
                        <span class="s-badge">🏢 Real Estate</span>
                        <img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?w=600&h=400&fit=crop&q=80" alt="Real estate website" loading="lazy" />
                        <div class="s-overlay">
                            <button class="btn-preview" onclick="showPreview('Property Listings')">👁 Live Preview</button>
                            <button class="btn-preview-ol">+ View Details</button>
                        </div>
                    </div>
                    <div class="s-meta">
                        <div class="s-cat">Real Estate</div>
                        <div class="s-title">Property Listings</div>
                        <div class="s-desc">Listings · Search · Agent · Tours</div>
                    </div>
                </div> -->

                <div class="s-card reveal" style="transition-delay:.35s">
                    <div class="s-img-wrap">
                        <span class="s-badge">🏫 Education</span>
                        <img src="https://images.unsplash.com/photo-1580582932707-520aed937b7b?w=600&h=400&fit=crop&q=80" alt="School website" loading="lazy" />
                        <div class="s-overlay">
                            <button class="btn-preview" onclick="showEduOffer('School Website')">👁 Live Preview</button>
                            <button class="btn-preview-ol" onclick="showEduOffer('School Website')">+ View Details</button>
                        </div>
                    </div>
                    <div class="s-meta">
                        <div class="s-cat">Education</div>
                        <div class="s-title">School Website</div>
                        <div class="s-desc">Admissions · Classes · Staff · Gallery</div>
                    </div>
                </div>

                <div class="s-card reveal" style="transition-delay:.4s">
                    <div class="s-img-wrap">
                        <span class="s-badge">🎓 Education</span>
                        <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=600&h=400&fit=crop&q=80" alt="College website" loading="lazy" />
                        <div class="s-overlay">
                            <button class="btn-preview" onclick="showEduOffer('College Website')">👁 Live Preview</button>
                            <button class="btn-preview-ol" onclick="showEduOffer('College Website')">+ View Details</button>
                        </div>
                    </div>
                    <div class="s-meta">
                        <div class="s-cat">Education</div>
                        <div class="s-title">College Website</div>
                        <div class="s-desc">Courses · Faculty · Events · Apply</div>
                    </div>
                </div>

                <div class="s-card reveal" style="transition-delay:.45s">
                    <div class="s-img-wrap">
                        <span class="s-badge">🏛 Education</span>
                        <img src="https://images.unsplash.com/photo-1541339907198-e08756dedf3f?w=600&h=400&fit=crop&q=80" alt="University website" loading="lazy" />
                        <div class="s-overlay">
                            <button class="btn-preview" onclick="showEduOffer('University Website')">👁 Live Preview</button>
                            <button class="btn-preview-ol" onclick="showEduOffer('University Website')">+ View Details</button>
                        </div>
                    </div>
                    <div class="s-meta">
                        <div class="s-cat">Education</div>
                        <div class="s-title">University Website</div>
                        <div class="s-desc">Departments · Research · Campus · Alumni</div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- wave -->
    <div class="wave-divider" style="background:#fdfafe;"><svg viewBox="0 0 1440 60" preserveAspectRatio="none" fill="#fff">
            <path d="M0,60L48,50C96,40,192,20,288,16.7C384,13,480,27,576,33.3C672,40,768,40,864,33.3C960,27,1056,13,1152,10C1248,7,1344,13,1392,16.7L1440,20L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z" />
        </svg></div>

    <!-- ══════════════ PROCESS ══════════════ -->
    <section id="process" style="background:#fdfafe;">
        <div class="container">
            <div class="section-header reveal">
                <div class="section-tag">✦ How It Works</div>
                <h2>Your Website in <span class="grad-text">4 Simple Steps</span></h2>
                <p>A transparent, guided journey from registration to a fully live, professional website.</p>
            </div>
            <div class="process-grid">
                <div class="p-step reveal" style="transition-delay:.05s">
                    <div class="p-num">01</div>
                    <h3>Submit Form</h3>
                    <p>Fill in your business and website details through our simple registration form.</p>
                </div>
                <div class="p-step reveal" style="transition-delay:.12s">
                    <div class="p-num">02</div>
                    <h3>Verification</h3>
                    <p>Our team reviews and verifies your submitted information within 24 hours.</p>
                </div>
                <div class="p-step reveal" style="transition-delay:.2s">
                    <div class="p-num">03</div>
                    <h3>Configuration</h3>
                    <p>We build your website with full branding, SEO, and all requested features.</p>
                </div>
                <div class="p-step reveal" style="transition-delay:.27s">
                    <div class="p-num">04</div>
                    <h3>Go Live! 🚀</h3>
                    <p>Your website launches and you receive full access, credentials, and support.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- wave -->
    <div class="wave-divider" style="background:#fff;"><svg viewBox="0 0 1440 60" preserveAspectRatio="none" fill="#fdfafe">
            <path d="M0,0L48,10C96,20,192,40,288,43.3C384,47,480,33,576,26.7C672,20,768,20,864,26.7C960,33,1056,47,1152,50C1248,53,1344,47,1392,43.3L1440,40L1440,60L1392,60C1344,60,1248,60,1152,60C1056,60,960,60,864,60C768,60,672,60,576,60C480,60,384,60,288,60C192,60,96,60,48,60L0,60Z" />
        </svg></div>

    <!-- ══════════════ WHY US ══════════════ -->
    <section id="why">
        <div class="container">
            <div class="why-grid">
                <div class="reveal-l">
                    <div class="section-tag">✦ Why Choose Us</div>
                    <h2 style="font-size:clamp(1.8rem,3.2vw,2.7rem);font-weight:800;color:#1a0a2e;margin-bottom:1rem;line-height:1.2;letter-spacing:-.02em;">Built by Experts,<br /><span class="grad-text">Delivered with Precision</span></h2>
                    <p style="color:#9ca3af;line-height:1.75;margin-bottom:1.5rem;max-width:430px;font-size:.95rem;">We combine top-tier design, technical excellence, and business strategy to deliver websites that truly perform.</p>
                    <div class="stat-row">
                        <div>
                            <div class="stat-val">500+</div>
                            <div class="stat-lbl">Websites Launched</div>
                        </div>
                        <div>
                            <div class="stat-val">48h</div>
                            <div class="stat-lbl">Avg Activation</div>
                        </div>
                        <div>
                            <div class="stat-val">98%</div>
                            <div class="stat-lbl">Satisfaction Rate</div>
                        </div>
                    </div>
                    <a href="{{route('register')}}" class="btn-register" style="display:inline-flex;">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path d="M5 12h14M12 5l7 7-7 7" />
                        </svg>
                        Start Your Project
                    </a>
                </div>
                <div class="why-cards reveal-r">
                    <div class="w-card">
                        <div class="w-emoji">🎨</div>
                        <h4>Professional Design</h4>
                        <p>Award-worthy visuals</p>
                    </div>
                    <div class="w-card">
                        <div class="w-emoji">📱</div>
                        <h4>Mobile First</h4>
                        <p>Perfect on all screens</p>
                    </div>
                    <div class="w-card">
                        <div class="w-emoji">🔍</div>
                        <h4>SEO Optimized</h4>
                        <p>Rank higher on Google</p>
                    </div>
                    <div class="w-card">
                        <div class="w-emoji">⚡</div>
                        <h4>Fast Loading</h4>
                        <p>Sub-2s page speed</p>
                    </div>
                    <div class="w-card">
                        <div class="w-emoji">🔒</div>
                        <h4>Secure Hosting</h4>
                        <p>SSL + daily backups</p>
                    </div>
                    <div class="w-card">
                        <div class="w-emoji">🛠</div>
                        <h4>Tech Support</h4>
                        <p>Dedicated help desk</p>
                    </div>
                    <div class="w-card">
                        <div class="w-emoji">💡</div>
                        <h4>Custom Dev</h4>
                        <p>Tailored to your needs</p>
                    </div>
                    <div class="w-card">
                        <div class="w-emoji">🔄</div>
                        <h4>Maintenance</h4>
                        <p>Always kept fresh</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- wave -->
    <div class="wave-divider" style="background:#fdfafe;"><svg viewBox="0 0 1440 60" preserveAspectRatio="none" fill="#fff">
            <path d="M0,60L48,50C96,40,192,20,288,16.7C384,13,480,27,576,33.3C672,40,768,40,864,33.3C960,27,1056,13,1152,10C1248,7,1344,13,1392,16.7L1440,20L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z" />
        </svg></div>

    <!-- ══════════════ TESTIMONIALS ══════════════ -->
    <section id="testimonials" style="background:#fdfafe;">
        <div class="container">
            <div class="section-header reveal">
                <div class="section-tag">✦ Testimonials</div>
                <h2>Loved by <span class="grad-text">Business Owners</span></h2>
                <p>Real results, real clients, real growth — across India.</p>
            </div>
            <div class="t-grid">
                <div class="t-card reveal" style="transition-delay:.05s">
                    <div class="t-stars">★★★★★</div>
                    <p class="t-text">"The entire process was seamless. Within 48 hours I had a professional website that truly represents my brand. Absolutely worth every rupee!"</p>
                    <div class="t-author">
                        <div class="t-avatar" style="background:linear-gradient(135deg,#FF2D9B,#FF6B35);">RK</div>
                        <div>
                            <div class="t-name">Rajesh Kumar</div>
                            <div class="t-role">Founder, TechStart India</div>
                        </div>
                    </div>
                </div>
                <div class="t-card reveal" style="transition-delay:.1s">
                    <div class="t-stars">★★★★★</div>
                    <p class="t-text">"I was skeptical at first, but the team delivered beyond expectations. SEO setup alone has increased my inquiries by 3x within two months!"</p>
                    <div class="t-author">
                        <div class="t-avatar" style="background:linear-gradient(135deg,#FF6B35,#FF9F5A);">PS</div>
                        <div>
                            <div class="t-name">Priya Sharma</div>
                            <div class="t-role">Owner, Bliss Salon</div>
                        </div>
                    </div>
                </div>
                <div class="t-card reveal" style="transition-delay:.15s">
                    <div class="t-stars">★★★★★</div>
                    <p class="t-text">"Professional, punctual, and stunning on mobile. The social media integration was handled perfectly without any technical hassle on my end!"</p>
                    <div class="t-author">
                        <div class="t-avatar" style="background:linear-gradient(135deg,#a855f7,#ec4899);">AM</div>
                        <div>
                            <div class="t-name">Arjun Mehta</div>
                            <div class="t-role">Director, Mehta Exports</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- wave -->
    <div class="wave-divider" style="background:#fff;"><svg viewBox="0 0 1440 60" preserveAspectRatio="none" fill="#fdfafe">
            <path d="M0,0L48,10C96,20,192,40,288,43.3C384,47,480,33,576,26.7C672,20,768,20,864,26.7C960,33,1056,47,1152,50C1248,53,1344,47,1392,43.3L1440,40L1440,60L1392,60C1344,60,1248,60,1152,60C1056,60,960,60,864,60C768,60,672,60,576,60C480,60,384,60,288,60C192,60,96,60,48,60L0,60Z" />
        </svg></div>

    <!-- ══════════════ FAQ ══════════════ -->
    <section id="faq">
        <div class="container">
            <div class="section-header reveal">
                <div class="section-tag">✦ FAQ</div>
                <h2>Frequently Asked <span class="grad-text">Questions</span></h2>
                <p>Everything you need to know before registering.</p>
            </div>
            <div class="faq-wrap">
                <div class="faq-item reveal" style="transition-delay:.05s">
                    <button class="faq-btn" onclick="toggleFaq(this)">How long does website setup take?<div class="faq-icon"><svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <line x1="12" y1="5" x2="12" y2="19" />
                                <line x1="5" y1="12" x2="19" y2="12" />
                            </svg></div></button>
                    <div class="faq-body">
                        <div class="faq-inner">After submission and verification, configuration typically takes 24–72 hours. You'll receive updates at every stage via email and WhatsApp throughout the process.</div>
                    </div>
                </div>
                <div class="faq-item reveal" style="transition-delay:.1s">
                    <button class="faq-btn" onclick="toggleFaq(this)">Can I use my own domain?<div class="faq-icon"><svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <line x1="12" y1="5" x2="12" y2="19" />
                                <line x1="5" y1="12" x2="19" y2="12" />
                            </svg></div></button>
                    <div class="faq-body">
                        <div class="faq-inner">Absolutely. If you already own a domain, we configure your website directly on it. If you need a new domain, we assist with registration and DNS setup at no extra charge.</div>
                    </div>
                </div>
                <div class="faq-item reveal" style="transition-delay:.15s">
                    <button class="faq-btn" onclick="toggleFaq(this)">Can I update my information later?<div class="faq-icon"><svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <line x1="12" y1="5" x2="12" y2="19" />
                                <line x1="5" y1="12" x2="19" y2="12" />
                            </svg></div></button>
                    <div class="faq-body">
                        <div class="faq-inner">Yes. After activation you can request content updates via our support channel. Minor edits like text, images, and contact info are always free of charge.</div>
                    </div>
                </div>
                <div class="faq-item reveal" style="transition-delay:.2s">
                    <button class="faq-btn" onclick="toggleFaq(this)">Is hosting included?<div class="faq-icon"><svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <line x1="12" y1="5" x2="12" y2="19" />
                                <line x1="5" y1="12" x2="19" y2="12" />
                            </svg></div></button>
                    <div class="faq-body">
                        <div class="faq-inner">Yes — managed cloud hosting with SSL certificate, daily backups, and uptime monitoring is included. We use enterprise-grade servers for maximum speed and reliability.</div>
                    </div>
                </div>
                <div class="faq-item reveal" style="transition-delay:.25s">
                    <button class="faq-btn" onclick="toggleFaq(this)">Is SEO setup included?<div class="faq-icon"><svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <line x1="12" y1="5" x2="12" y2="19" />
                                <line x1="5" y1="12" x2="19" y2="12" />
                            </svg></div></button>
                    <div class="faq-body">
                        <div class="faq-inner">Yes. On-page SEO including meta tags, Schema.org structured data, sitemap, robots.txt, and Open Graph tags are configured for every website. Advanced SEO campaigns available as add-ons.</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ══════════════ CTA ══════════════ -->
    <section id="cta">
        <div class="container">
            <div class="cta-inner reveal">
                <div class="section-tag" style="display:inline-flex;margin-bottom:1.2rem;">✦ Ready to Launch?</div>
                <h2>Launch Your <span class="grad-text">Dream Website</span> Today</h2>
                <p>Complete your registration — our expert team takes care of everything from design to going live.</p>
                <div class="cta-cards">
                    <div class="cta-mini-card">✓ Free Setup Consultation</div>
                    <div class="cta-mini-card" style="color:#FF6B35;border-color:rgba(255,107,53,.2);background:linear-gradient(135deg,rgba(255,107,53,.08),rgba(255,45,155,.06));">✓ Live in 48 Hours</div>
                    <div class="cta-mini-card">✓ No Hidden Charges</div>
                </div>
                <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;">
                    <a href="#hero" class="btn-register">
                        <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path d="M5 12h14M12 5l7 7-7 7" />
                        </svg>
                        Start Registration — Free
                    </a>
                    <a href="{{route('login')}}" class="btn-contact">
                        <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path d="M5 12h14M12 5l7 7-7 7" />
                        </svg>
                        Login
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ══════════════ FOOTER ══════════════ -->
    <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <a href="#" class="logo logo-light">
                        <div class="logo-icon"><svg width="16" height="16" fill="none" stroke="#fff" stroke-width="2.5" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10" />
                                <path d="M12 2a15 15 0 0 1 4 10 15 15 0 0 1-4 10 15 15 0 0 1-4-10 15 15 0 0 1 4-10z" />
                                <path d="M2 12h20" />
                            </svg></div>
                        <span class="logo-text" style="color:#fff;">WebLaunch<span>Pro</span></span>
                    </a>
                    <p>Professional website setup services for businesses of all sizes across India. Launch fast, grow faster.</p>
                    <div class="socials">
                        <a class="soc-btn" href="#"><svg width="14" height="14" fill="none" stroke="#fff" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
                            </svg></a>
                        <a class="soc-btn" href="#"><svg width="14" height="14" fill="none" stroke="#fff" stroke-width="2" viewBox="0 0 24 24">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5" />
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" />
                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" />
                            </svg></a>
                        <a class="soc-btn" href="#"><svg width="14" height="14" fill="none" stroke="#fff" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-4 0v7h-4v-7a6 6 0 0 1 6-6z" />
                                <rect x="2" y="9" width="4" height="12" />
                                <circle cx="4" cy="4" r="2" />
                            </svg></a>
                        <a class="soc-btn" href="#"><svg width="14" height="14" fill="none" stroke="#fff" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M22.54 6.42a2.78 2.78 0 0 0-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46a2.78 2.78 0 0 0-1.95 1.96A29 29 0 0 0 1 12a29 29 0 0 0 .46 5.58A2.78 2.78 0 0 0 3.41 19.6C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 0 0 1.95-1.95A29 29 0 0 0 23 12a29 29 0 0 0-.46-5.58z" />
                                <polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02" />
                            </svg></a>
                    </div>
                </div>
                <div>
                    <div class="f-heading">Navigation</div>
                    <div class="f-links"><a href="#benefits" class="f-link">Benefits</a><a href="#showcase" class="f-link">Showcase</a><a href="#process" class="f-link">Process</a><a href="#why" class="f-link">Why Us</a><a href="#faq" class="f-link">FAQ</a></div>
                </div>
                <div>
                    <div class="f-heading">Services</div>
                    <div class="f-links"><a href="#" class="f-link">Website Design</a><a href="#" class="f-link">Domain Setup</a><a href="#" class="f-link">SEO Services</a><a href="#" class="f-link">Social Media</a><a href="#" class="f-link">Maintenance</a></div>
                </div>
                <div class="f-contact">
                    <div class="f-heading">Contact</div>
                    <p><svg width="14" height="14" fill="none" stroke="rgba(255,255,255,.35)" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                            <polyline points="22,6 12,13 2,6" />
                        </svg>hello@weblaunchpro.com</p>
                    <p><svg width="14" height="14" fill="none" stroke="rgba(255,255,255,.35)" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 11 19.79 19.79 0 0 1 1.61 2.4 2 2 0 0 1 3.58.22h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 7.91a16 16 0 0 0 6.18 6.18l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 14.92z" />
                        </svg>+91 90000 00000</p>
                    <p><svg width="14" height="14" fill="none" stroke="rgba(255,255,255,.35)" stroke-width="2" viewBox="0 0 24 24" style="flex-shrink:0;margin-top:2px;">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                            <circle cx="12" cy="10" r="3" />
                        </svg>Raipur, Chhattisgarh, India</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>© 2025 WebLaunch Pro. All rights reserved.</p>
                <div class="footer-bottom-links"><a href="#">Privacy Policy</a><a href="#">Terms of Service</a><a href="#">Sitemap</a></div>
            </div>
        </div>
    </footer>

    <!-- Preview Modal -->
    <!-- Education Offer Modal -->
    <div id="edu-modal" onclick="closeEduModal()" style="display:none;position:fixed;inset:0;background:rgba(26,10,46,.6);backdrop-filter:blur(6px);z-index:9999;align-items:center;justify-content:center;">
        <div onclick="event.stopPropagation()" style="background:#fff;border-radius:24px;padding:2.5rem;text-align:center;max-width:420px;margin:1rem;box-shadow:0 30px 80px rgba(0,0,0,.25);">
            <div style="font-size:3rem;margin-bottom:.75rem;">🎓</div>
            <div style="display:inline-block;background:linear-gradient(135deg,#7c3aed,#FF2D9B);color:#fff;font-size:.72rem;font-weight:700;letter-spacing:.08em;padding:.3rem .9rem;border-radius:50px;margin-bottom:.9rem;text-transform:uppercase;">Special Education Offer</div>
            <h3 id="edu-modal-title" style="font-family:'Poppins',sans-serif;font-weight:700;font-size:1.25rem;color:#1a0a2e;margin-bottom:.5rem;"></h3>
            <p style="color:#6b7280;font-size:.88rem;line-height:1.6;margin-bottom:1.6rem;">Get this template fully customised and live for your institution. <strong style="color:#7c3aed;">Register now</strong> to claim your exclusive offer, or log in if you already have an account.</p>
            <a href="{{route('register')}}" onclick="closeEduModal()" class="btn-register" style="width:100%;justify-content:center;margin-bottom:.75rem;display:flex;">🚀 Register &amp; Get Offer</a>
            <a href="{{route('login')}}" onclick="closeEduModal()" style="display:flex;align-items:center;justify-content:center;gap:.4rem;width:100%;padding:.75rem 1.5rem;border:2px solid #e5e7eb;border-radius:50px;font-family:'Poppins',sans-serif;font-weight:600;font-size:.9rem;color:#1a0a2e;text-decoration:none;transition:border-color .2s,color .2s;" onmouseover="this.style.borderColor='#7c3aed';this.style.color='#7c3aed'" onmouseout="this.style.borderColor='#e5e7eb';this.style.color='#1a0a2e'">🔑 Already Registered? Login Now</a>
            <button onclick="closeEduModal()" style="margin-top:1rem;background:none;border:none;color:#9ca3af;font-size:.8rem;cursor:pointer;">Maybe later</button>
        </div>
    </div>

    <div id="modal" onclick="closeModal()" style="display:none;position:fixed;inset:0;background:rgba(26,10,46,.5);backdrop-filter:blur(6px);z-index:9998;align-items:center;justify-content:center;">
        <div onclick="event.stopPropagation()" style="background:#fff;border-radius:24px;padding:2.5rem;text-align:center;max-width:380px;margin:1rem;box-shadow:0 30px 80px rgba(0,0,0,.2);">
            <div style="font-size:3rem;margin-bottom:1rem;">🖥️</div>
            <h3 id="modal-title" style="font-family:'Poppins',sans-serif;font-weight:700;font-size:1.2rem;color:#1a0a2e;margin-bottom:.5rem;"></h3>
            <p style="color:#9ca3af;font-size:.85rem;margin-bottom:1.5rem;">Register now to get this template configured for your business — fully customized and live in 48 hours.</p>
            <a href="{{route('register')}}" onclick="closeModal()" class="btn-register" style="width:100%;justify-content:center;">Register to Get This Template</a>
            <button onclick="closeModal()" style="margin-top:.9rem;background:none;border:none;color:#9ca3af;font-size:.82rem;cursor:pointer;">Maybe later</button>
        </div>
    </div>

    <script>
        /* ── Canvas: Light Particles for white BG ── */
        const canvas = document.getElementById('hero-canvas');
        const ctx = canvas.getContext('2d');
        let W, H;

        function resize() {
            W = canvas.width = innerWidth;
            H = canvas.height = innerHeight;
        }
        resize();
        window.addEventListener('resize', resize);

        class Dot {
            constructor() {
                this.reset(true);
            }
            reset(init = false) {
                this.x = Math.random() * W;
                this.y = init ? Math.random() * H : Math.random() * H;
                this.r = Math.random() * 2.2 + .5;
                this.vx = (Math.random() - .5) * .25;
                this.vy = (Math.random() - .5) * .25;
                this.alpha = 0;
                this.targetAlpha = Math.random() * .35 + .08;
                this.growing = true;
                this.speed = Math.random() * .012 + .004;
                const c = ['255,45,155', '255,107,53', '255,160,100'];
                this.c = c[Math.floor(Math.random() * c.length)];
            }
            update() {
                this.x += this.vx;
                this.y += this.vy;
                if (this.growing) {
                    this.alpha += this.speed;
                    if (this.alpha >= this.targetAlpha) this.growing = false;
                } else {
                    this.alpha -= this.speed * .6;
                }
                if (this.alpha <= 0) this.reset();
            }
            draw() {
                ctx.save();
                ctx.globalAlpha = this.alpha;
                const g = ctx.createRadialGradient(this.x, this.y, 0, this.x, this.y, this.r * 3);
                g.addColorStop(0, `rgba(${this.c},${this.alpha})`);
                g.addColorStop(1, `rgba(${this.c},0)`);
                ctx.fillStyle = g;
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.r * 3, 0, Math.PI * 2);
                ctx.fill();
                ctx.restore();
            }
        }

        /* Light streaks */
        class Streak {
            constructor() {
                this.reset();
            }
            reset() {
                this.x = Math.random() * W;
                this.y = Math.random() * H;
                this.len = Math.random() * 60 + 20;
                this.angle = Math.random() * Math.PI * 2;
                this.speed = Math.random() * .4 + .1;
                this.alpha = 0;
                this.maxAlpha = Math.random() * .08 + .02;
                this.growing = true;
                this.gs = .006;
                this.c = Math.random() > .5 ? '255,45,155' : '255,107,53';
            }
            update() {
                this.x += Math.cos(this.angle) * this.speed;
                this.y += Math.sin(this.angle) * this.speed;
                if (this.growing) {
                    this.alpha += this.gs;
                    if (this.alpha >= this.maxAlpha) this.growing = false;
                } else {
                    this.alpha -= this.gs * .6;
                }
                if (this.alpha <= 0 || this.x < -200 || this.x > W + 200 || this.y < -200 || this.y > H + 200) this.reset();
            }
            draw() {
                ctx.save();
                ctx.globalAlpha = this.alpha;
                ctx.strokeStyle = `rgba(${this.c},${this.alpha})`;
                ctx.lineWidth = .7;
                ctx.beginPath();
                ctx.moveTo(this.x, this.y);
                ctx.lineTo(this.x - Math.cos(this.angle) * this.len, this.y - Math.sin(this.angle) * this.len);
                ctx.stroke();
                ctx.restore();
            }
        }

        const dots = [],
            streaks = [];
        for (let i = 0; i < 90; i++) dots.push(new Dot());
        for (let i = 0; i < 20; i++) streaks.push(new Streak());

        (function loop() {
            ctx.clearRect(0, 0, W, H);
            dots.forEach(d => {
                d.update();
                d.draw();
            });
            streaks.forEach(s => {
                s.update();
                s.draw();
            });
            requestAnimationFrame(loop);
        })();

        /* ── Scroll ── */
        window.addEventListener('scroll', () => {
            const p = scrollY / (document.body.scrollHeight - innerHeight) * 100;
            document.getElementById('progress').style.width = p + '%';
            document.getElementById('navbar').classList.toggle('scrolled', scrollY > 60);
        });

        /* ── Reveal ── */
        const obs = new IntersectionObserver(e => e.forEach(en => {
            if (en.isIntersecting) {
                en.target.classList.add('visible');
                obs.unobserve(en.target);
            }
        }), {
            threshold: .1
        });
        document.querySelectorAll('.reveal,.reveal-l,.reveal-r').forEach(el => obs.observe(el));

        /* ── Mobile menu ── */
        document.getElementById('hamburger').addEventListener('click', () => document.getElementById('mobile-nav').classList.toggle('open'));

        /* ── Smooth scroll ── */
        document.querySelectorAll('a[href^="#"]').forEach(a => a.addEventListener('click', e => {
            const id = a.getAttribute('href');
            if (id === '#') return;
            const el = document.querySelector(id);
            if (el) {
                e.preventDefault();
                el.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
            document.getElementById('mobile-nav').classList.remove('open');
        }));

        /* ── FAQ ── */
        function toggleFaq(btn) {
            const item = btn.closest('.faq-item'),
                body = item.querySelector('.faq-body'),
                open = item.classList.contains('active');
            document.querySelectorAll('.faq-item').forEach(i => {
                i.classList.remove('active');
                i.querySelector('.faq-body').style.maxHeight = '0';
            });
            if (!open) {
                item.classList.add('active');
                body.style.maxHeight = body.scrollHeight + 40 + 'px';
            }
        }

        /* ── Preview modal ── */
        function showPreview(title) {
            document.getElementById('modal-title').textContent = title + ' — Live Preview';
            document.getElementById('modal').style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('modal').style.display = 'none';
            document.body.style.overflow = '';
        }

        function showEduOffer(title) {
            document.getElementById('edu-modal-title').textContent = title + ' — Exclusive Offer';
            document.getElementById('edu-modal').style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function closeEduModal() {
            document.getElementById('edu-modal').style.display = 'none';
            document.body.style.overflow = '';
        }
    </script>
</body>

</html>