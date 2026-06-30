@extends('layouts.app')

@section('title', 'BluePeak University — Excellence in Education Since 1985')
@section('description', 'BluePeak University offers world-class education across Engineering, Medical, Business, Arts &
    Sciences. Apply for Admissions 2026 today.')

    @push('styles')
        {{-- Slick Carousel --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">

        <style>
            /* ═══════════════════════════════════════
           UNIVERSITY PAGE — GLOBAL STYLES
        ═══════════════════════════════════════ */

            /* ─── ANIMATIONS ─── */
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(40px)
                }

                to {
                    opacity: 1;
                    transform: translateY(0)
                }
            }

            @keyframes fadeInLeft {
                from {
                    opacity: 0;
                    transform: translateX(-50px)
                }

                to {
                    opacity: 1;
                    transform: translateX(0)
                }
            }

            @keyframes fadeInRight {
                from {
                    opacity: 0;
                    transform: translateX(50px)
                }

                to {
                    opacity: 1;
                    transform: translateX(0)
                }
            }

            @keyframes scaleIn {
                from {
                    opacity: 0;
                    transform: scale(0.88)
                }

                to {
                    opacity: 1;
                    transform: scale(1)
                }
            }

            @keyframes float {

                0%,
                100% {
                    transform: translateY(0)
                }

                50% {
                    transform: translateY(-12px)
                }
            }

            @keyframes floatX {

                0%,
                100% {
                    transform: translateX(0)
                }

                50% {
                    transform: translateX(-8px)
                }
            }

            @keyframes pulse-dot {

                0%,
                100% {
                    opacity: 1;
                    transform: scale(1)
                }

                50% {
                    opacity: .4;
                    transform: scale(1.7)
                }
            }

            @keyframes spin {
                to {
                    transform: rotate(360deg)
                }
            }

            @keyframes shimmer-bg {
                0% {
                    background-position: -200% center
                }

                100% {
                    background-position: 200% center
                }
            }

            @keyframes countUp {
                from {
                    opacity: 0;
                    transform: translateY(6px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @keyframes hero-ken-burns {
                0% {
                    transform: scale(1.1)
                }

                100% {
                    transform: scale(1)
                }
            }

            /* ─── SCROLL REVEAL ─── */
            .reveal {
                opacity: 0;
                transform: translateY(32px);
                transition: opacity .75s ease, transform .75s ease;
            }

            .reveal-left {
                opacity: 0;
                transform: translateX(-40px);
                transition: opacity .75s ease, transform .75s ease;
            }

            .reveal-right {
                opacity: 0;
                transform: translateX(40px);
                transition: opacity .75s ease, transform .75s ease;
            }

            .reveal-scale {
                opacity: 0;
                transform: scale(0.9);
                transition: opacity .75s ease, transform .75s ease;
            }

            .reveal.visible,
            .reveal-left.visible,
            .reveal-right.visible,
            .reveal-scale.visible {
                opacity: 1;
                transform: translateY(0) translateX(0) scale(1);
            }

            .delay-1 {
                transition-delay: .1s
            }

            .delay-2 {
                transition-delay: .2s
            }

            .delay-3 {
                transition-delay: .3s
            }

            .delay-4 {
                transition-delay: .4s
            }

            .delay-5 {
                transition-delay: .5s
            }

            .delay-6 {
                transition-delay: .6s
            }

            /* ─── UTILITIES ─── */
            .container {
                max-width: var(--container-max, 1280px);
                margin: 0 auto;
                padding: 0 var(--container-px, 2rem);
            }

            .container1 {
                width: 95%;
                margin: -7rem auto 0rem auto;
                padding: 0 var(--container-px, 2rem);
            }

            .section-py {
                padding: var(--section-py, 6rem) 0;
            }

            /* ─── SECTION HEADER ─── */
            .sec-head {
                text-align: center;
                margin-bottom: 3.5rem;
            }

            .sec-tag {
                display: inline-flex;
                align-items: center;
                gap: 0.4rem;
                background: rgba(7, 41, 77, 0.06);
                border: 1px solid rgba(7, 41, 77, 0.13);
                color: var(--c-primary);
                font-size: 0.7rem;
                font-weight: 700;
                letter-spacing: 0.12em;
                text-transform: uppercase;
                padding: 0.32rem 1rem;
                border-radius: 50px;
                margin-bottom: 1rem;
            }

            .sec-tag .dot-pulse {
                width: 6px;
                height: 6px;
                background: var(--c-accent);
                border-radius: 50%;
                animation: pulse-dot 1.6s ease-in-out infinite;
            }

            .sec-title {
                font-size: clamp(1.9rem, 3.5vw, 2.9rem);
                font-weight: 800;
                color: var(--c-primary);
                line-height: 1.18;
                margin-bottom: 1rem;
                letter-spacing: -0.02em;
            }

            .sec-title .grad {
                background: linear-gradient(135deg, var(--c-primary-light, #0e5a9e), var(--c-accent, #F5A623));
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            .sec-divider {
                width: 52px;
                height: 4px;
                background: linear-gradient(90deg, var(--c-primary), var(--c-accent));
                border-radius: 4px;
                margin: 0.75rem auto;
            }

            .sec-sub {
                font-size: 1rem;
                color: var(--c-text-muted);
                max-width: 580px;
                margin: 0.75rem auto 0;
                line-height: 1.78;
            }

            /* ─── BUTTONS ─── */
            .btn {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                font-family: 'Poppins', sans-serif;
                font-weight: 600;
                font-size: 0.88rem;
                padding: 0.78rem 2rem;
                border-radius: 50px;
                transition: var(--transition, all .4s cubic-bezier(.4, 0, .2, 1));
                cursor: pointer;
                border: none;
                text-decoration: none;
            }

            .btn-yellow {
                background: var(--c-accent);
                color: var(--c-primary-dark) !important;
                box-shadow: 0 6px 24px rgba(245, 166, 35, .4);
            }

            .btn-yellow:hover {
                background: var(--c-accent-light, #ffc85a);
                transform: translateY(-3px);
                box-shadow: 0 12px 36px rgba(245, 166, 35, .5);
            }

            .btn-white-outline {
                background: transparent;
                color: var(--c-white) !important;
                border: 2px solid rgba(255, 255, 255, .6);
            }

            .btn-white-outline:hover {
                background: rgba(255, 255, 255, .15);
                border-color: white;
                transform: translateY(-3px);
            }

            .btn-blue {
                background: var(--c-primary);
                color: white !important;
                box-shadow: 0 6px 24px rgba(7, 41, 77, .3);
            }

            .btn-blue:hover {
                background: var(--c-primary-mid, #0a3d6b);
                transform: translateY(-3px);
                box-shadow: 0 12px 36px rgba(7, 41, 77, .4);
            }

            .btn-blue-outline {
                background: transparent;
                color: var(--c-primary) !important;
                border: 2px solid var(--c-primary);
            }

            .btn-blue-outline:hover {
                background: var(--c-primary);
                color: white !important;
                transform: translateY(-3px);
            }


            /* ════════════════════════════════════════
           HERO SLIDER
        ════════════════════════════════════════ */
            #uni-hero {
                position: relative;
                height: 100vh;
                min-height: 680px;
                overflow: hidden;
            }

            .hero-slides-wrap {
                width: 100%;
                height: 100%;
            }

            .hero-slide {
                position: absolute;
                inset: 0;
                opacity: 0;
                visibility: hidden;
                transition: opacity 1.3s ease, visibility 1.3s;
            }

            .hero-slide.active {
                opacity: 1;
                visibility: visible;
            }

            .hero-slide-bg {
                position: absolute;
                inset: 0;
                background-size: cover;
                background-position: center;
                animation: hero-ken-burns 12s ease-out forwards;
            }

            .hero-slide.active .hero-slide-bg {
                animation-play-state: running;
            }

            .hero-overlay {
                position: absolute;
                inset: 0;
                background: linear-gradient(to right,
                        rgba(0, 25, 54, .92) 0%,
                        rgba(7, 41, 77, .72) 55%,
                        rgba(0, 25, 54, .30) 100%);
            }

            .hero-overlay-pattern {
                position: absolute;
                inset: 0;
                background-image:
                    radial-gradient(circle at 1px 1px, rgba(255, 255, 255, .06) 1px, transparent 0);
                background-size: 40px 40px;
                opacity: 0.5;
            }

            .hero-content {
                position: relative;
                z-index: 5;
                height: 100%;
                display: flex;
                align-items: center;
            }

            .hero-text {
                max-width: 760px;
            }

            .hero-slide .hero-eyebrow {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                background: rgba(245, 166, 35, .18);
                border: 1px solid rgba(245, 166, 35, .4);
                color: var(--c-accent);
                font-size: 0.7rem;
                font-weight: 700;
                letter-spacing: 0.14em;
                text-transform: uppercase;
                padding: 0.38rem 1rem;
                border-radius: 50px;
                margin-bottom: 1.6rem;
                opacity: 0;
                transform: translateY(16px);
                transition: all .6s ease .2s;
            }

            .hero-slide.active .hero-eyebrow {
                opacity: 1;
                transform: translateY(0);
            }

            .hero-slide h1 {
                font-size: clamp(2.4rem, 5.5vw, 4.6rem);
                font-weight: 900;
                color: var(--c-white);
                line-height: 1.08;
                letter-spacing: -0.03em;
                margin-bottom: 1.6rem;
                opacity: 0;
                transform: translateY(28px);
                transition: all .7s ease .45s;
            }

            .hero-slide.active h1 {
                opacity: 1;
                transform: translateY(0);
            }

            .hero-slide h1 em {
                color: var(--c-accent);
                font-style: normal;
            }

            .hero-slide p {
                font-size: 1.08rem;
                color: rgba(255, 255, 255, .78);
                max-width: 540px;
                margin-bottom: 2.5rem;
                line-height: 1.8;
                opacity: 0;
                transform: translateY(20px);
                transition: all .7s ease .65s;
            }

            .hero-slide.active p {
                opacity: 1;
                transform: translateY(0);
            }

            .hero-slide .hero-btns {
                display: flex;
                gap: 1rem;
                flex-wrap: wrap;
                opacity: 0;
                transform: translateY(18px);
                transition: all .7s ease .85s;
            }

            .hero-slide.active .hero-btns {
                opacity: 1;
                transform: translateY(0);
            }

            /* Hero Controls */
            .hero-ui {
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0;
                z-index: 10;
            }

            /* Stats strip */
            .hero-stats-bar {
                background: rgba(0, 25, 54, .88);
                backdrop-filter: blur(20px);
                border-top: 1px solid rgba(255, 255, 255, .07);
            }

            .hero-stats-inner {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                gap: 0;
            }

            .hero-stat {
                text-align: center;
                padding: 1.4rem 1rem;
                border-right: 1px solid rgba(255, 255, 255, .07);
                position: relative;
            }

            .hero-stat:last-child {
                border-right: none;
            }

            .hero-stat::before {
                content: '';
                position: absolute;
                top: 0;
                left: 50%;
                transform: translateX(-50%);
                width: 0;
                height: 2px;
                background: var(--c-accent);
                transition: width .4s;
            }

            .hero-stat:hover::before {
                width: 40px;
            }

            .hero-stat-val {
                font-family: 'Poppins', sans-serif;
                font-weight: 800;
                font-size: 2.2rem;
                color: var(--c-accent);
                line-height: 1;
                margin-bottom: 0.3rem;
            }

            .hero-stat-lbl {
                font-size: 0.72rem;
                color: rgba(255, 255, 255, .45);
                font-weight: 500;
                text-transform: uppercase;
                letter-spacing: 0.06em;
            }

            /* Slide dots */
            .hero-dots-wrap {
                position: absolute;
                bottom: 140px;
                left: 50%;
                transform: translateX(-50%);
                display: flex;
                gap: 0.5rem;
                z-index: 11;
            }

            .hero-dot {
                width: 8px;
                height: 8px;
                border-radius: 4px;
                background: rgba(255, 255, 255, .35);
                border: none;
                cursor: pointer;
                transition: all .35s;
            }

            .hero-dot.active {
                background: var(--c-accent);
                width: 28px;
            }

            /* Arrows */
            .hero-arrows-wrap {
                position: absolute;
                right: var(--container-px, 2rem);
                bottom: 145px;
                display: flex;
                gap: 0.6rem;
                z-index: 11;
            }

            .hero-arrow-btn {
                width: 46px;
                height: 46px;
                border-radius: 50%;
                background: rgba(255, 255, 255, .12);
                border: 1.5px solid rgba(255, 255, 255, .25);
                color: white;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                transition: var(--transition-fast, all .25s);
                backdrop-filter: blur(8px);
            }

            .hero-arrow-btn:hover {
                background: var(--c-accent);
                border-color: var(--c-accent);
                color: var(--c-primary-dark);
            }

            /* Scroll hint */
            .hero-scroll-hint {
                position: absolute;
                bottom: 145px;
                left: var(--container-px, 2rem);
                z-index: 11;
                display: flex;
                align-items: center;
                gap: 0.65rem;
                color: rgba(255, 255, 255, .45);
                font-size: 0.72rem;
                text-transform: uppercase;
                letter-spacing: 0.1em;
                font-weight: 600;
            }

            .scroll-line {
                width: 36px;
                height: 1px;
                background: rgba(255, 255, 255, .3);
            }

            /* Slide counter */
            .hero-counter {
                position: absolute;
                top: 50%;
                right: var(--container-px, 2rem);
                transform: translateY(-50%);
                z-index: 11;
                writing-mode: vertical-rl;
                font-size: 0.7rem;
                color: rgba(255, 255, 255, .35);
                letter-spacing: 0.1em;
                font-weight: 600;
            }

            .hero-counter span {
                color: var(--c-accent);
            }


            /* ════════════════════════════════════════
           ABOUT US
        ════════════════════════════════════════ */
            #uni-about {
                padding: var(--section-py, 6rem) 0;
                background: var(--c-white);
                overflow: hidden;
                position: relative;
            }

            #uni-about::before {
                content: '';
                position: absolute;
                top: -120px;
                right: -120px;
                width: 600px;
                height: 600px;
                background: radial-gradient(ellipse, rgba(7, 41, 77, .04) 0%, transparent 65%);
                border-radius: 50%;
                pointer-events: none;
            }

            #uni-about::after {
                content: '';
                position: absolute;
                bottom: -80px;
                left: -80px;
                width: 400px;
                height: 400px;
                background: radial-gradient(ellipse, rgba(245, 166, 35, .05) 0%, transparent 65%);
                border-radius: 50%;
                pointer-events: none;
            }

            .about-grid {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 5rem;
                align-items: center;
            }

            /* Images block */
            .about-images-block {
                position: relative;
                height: 540px;
            }

            .about-img-1 {
                position: absolute;
                top: 0;
                left: 0;
                width: 73%;
                height: 78%;
                border-radius: var(--radius-lg, 24px);
                overflow: hidden;
                box-shadow: var(--shadow-xl);
                z-index: 2;
            }

            .about-img-1 img,
            .about-img-2 img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform .7s ease;
            }

            .about-img-1:hover img,
            .about-img-2:hover img {
                transform: scale(1.06);
            }

            .about-img-2 {
                position: absolute;
                bottom: 0;
                right: 0;
                width: 62%;
                height: 57%;
                border-radius: var(--radius-lg, 24px);
                overflow: hidden;
                box-shadow: var(--shadow-xl);
                border: 5px solid var(--c-white);
                z-index: 3;
            }

            /* Logo badge */
            .about-logo-badge {
                position: absolute;
                top: 50%;
                left: -28px;
                transform: translateY(-50%);
                z-index: 10;
                width: 78px;
                height: 78px;
                background: var(--c-accent);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 8px 32px rgba(245, 166, 35, .5);
                animation: float 4s ease-in-out infinite;
                border: 4px solid white;
            }

            /* Experience badge */
            .about-exp-badge {
                position: absolute;
                top: 18px;
                right: -14px;
                z-index: 10;
                background: var(--c-primary);
                color: white;
                border-radius: var(--radius-md, 16px);
                padding: 0.9rem 1.3rem;
                text-align: center;
                box-shadow: var(--shadow-lg);
                border: 4px solid white;
            }

            .about-exp-num {
                font-family: 'Poppins', sans-serif;
                font-weight: 800;
                font-size: 2.2rem;
                color: var(--c-accent);
                line-height: 1;
            }

            .about-exp-lbl {
                font-size: 0.62rem;
                color: rgba(255, 255, 255, .6);
                text-transform: uppercase;
                letter-spacing: 0.07em;
                margin-top: 0.25rem;
                line-height: 1.35;
            }

            /* Award badge */
            .about-award-badge {
                position: absolute;
                bottom: 32%;
                left: -20px;
                z-index: 10;
                background: white;
                border-radius: 14px;
                padding: 0.8rem 1rem;
                box-shadow: var(--shadow-md);
                display: flex;
                align-items: center;
                gap: 0.6rem;
                animation: floatX 5s ease-in-out infinite;
                border-left: 4px solid var(--c-accent);
            }

            .about-award-icon {
                font-size: 1.5rem;
                flex-shrink: 0;
            }

            .about-award-text {
                font-family: 'Poppins', sans-serif;
                font-size: 0.75rem;
                font-weight: 700;
                color: var(--c-primary);
                line-height: 1.3;
            }

            .about-award-sub {
                font-size: 0.65rem;
                color: var(--c-text-muted);
                font-weight: 400;
            }

            /* Content */
            .about-content-block .sec-head {
                text-align: left;
                margin-bottom: 1.75rem;
            }

            .about-content-block .sec-title {
                text-align: left;
            }

            .about-content-block .sec-divider {
                margin: 0.75rem 0;
            }

            .about-lead {
                font-size: 1.05rem;
                color: var(--c-text-muted);
                line-height: 1.88;
                margin-bottom: 1.5rem;
            }

            .about-body {
                font-size: 0.9rem;
                color: var(--c-text-muted);
                line-height: 1.85;
                margin-bottom: 1.75rem;
            }

            .about-highlights {
                display: flex;
                flex-direction: column;
                gap: 0.7rem;
                margin-bottom: 2rem;
            }

            .about-hl-item {
                display: flex;
                align-items: flex-start;
                gap: 0.7rem;
                font-size: 0.88rem;
                color: var(--c-text);
                font-weight: 500;
            }

            .about-hl-icon {
                width: 22px;
                height: 22px;
                background: linear-gradient(135deg, var(--c-accent), var(--c-accent-light, #ffc85a));
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-shrink: 0;
                margin-top: 0.1rem;
            }

            .about-stats-row {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 1rem;
                background: var(--c-light);
                border-radius: var(--radius-md, 16px);
                padding: 1.4rem 1rem;
                margin-bottom: 2rem;
                border: 1px solid var(--c-border);
            }

            .about-stat-item {
                text-align: center;
            }

            .about-sv {
                font-family: 'Poppins', sans-serif;
                font-weight: 800;
                font-size: 2rem;
                color: var(--c-primary);
                line-height: 1;
            }

            .about-sl {
                font-size: 0.7rem;
                color: var(--c-text-muted);
                margin-top: 0.25rem;
                text-transform: uppercase;
                letter-spacing: 0.06em;
            }

            .about-read-more {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                color: var(--c-primary);
                font-family: 'Poppins', sans-serif;
                font-weight: 700;
                font-size: 0.88rem;
                border-bottom: 2px solid var(--c-accent);
                padding-bottom: 2px;
                transition: gap .2s, color .2s;
            }

            .about-read-more:hover {
                gap: 0.8rem;
                color: var(--c-primary-light, #0e5a9e);
            }


            /* ════════════════════════════════════════
           FACULTIES SLIDER
        ════════════════════════════════════════ */
            #uni-faculties {
                padding: var(--section-py, 6rem) 0;
                background: var(--c-light);
                position: relative;
                overflow: hidden;
            }

            .fac-slider-wrap {
                position: relative;
            }

            .fac-slider {}

            .fac-card {
                margin: 0 0.85rem;
                background: white;
                border-radius: var(--radius-lg, 24px);
                overflow: hidden;
                box-shadow: var(--shadow-sm);
                transition: var(--transition, all .4s cubic-bezier(.4, 0, .2, 1));
                border: 1px solid var(--c-border);
            }

            .fac-card:hover {
                transform: translateY(-10px);
                box-shadow: var(--shadow-xl);
                border-color: rgba(7, 41, 77, .2);
            }

            .fac-card-img {
                height: 210px;
                overflow: hidden;
                position: relative;
            }

            .fac-card-img img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform .7s ease;
            }

            .fac-card:hover .fac-card-img img {
                transform: scale(1.1);
            }

            .fac-card-img-ov {
                position: absolute;
                inset: 0;
                background: linear-gradient(to top, rgba(7, 41, 77, .75) 0%, transparent 55%);
            }

            .fac-card-badge {
                position: absolute;
                top: 1rem;
                right: 1rem;
                background: var(--c-accent);
                color: var(--c-primary-dark);
                font-size: 0.62rem;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 0.06em;
                padding: 0.25rem 0.7rem;
                border-radius: 50px;
            }

            .fac-card-icon-wrap {
                position: absolute;
                bottom: 1rem;
                left: 1rem;
                width: 48px;
                height: 48px;
                background: var(--c-accent);
                border-radius: var(--radius-sm, 8px);
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.3rem;
                box-shadow: 0 4px 16px rgba(245, 166, 35, .45);
                border: 2px solid white;
            }

            .fac-card-body {
                padding: 1.5rem;
            }

            .fac-count {
                font-size: 0.68rem;
                font-weight: 700;
                color: var(--c-accent);
                text-transform: uppercase;
                letter-spacing: 0.08em;
                margin-bottom: 0.4rem;
            }

            .fac-title {
                font-family: 'Poppins', sans-serif;
                font-size: 1.1rem;
                font-weight: 700;
                color: var(--c-primary);
                margin-bottom: 0.5rem;
                line-height: 1.3;
            }

            .fac-desc {
                font-size: 0.8rem;
                color: var(--c-text-muted);
                line-height: 1.72;
                margin-bottom: 1rem;
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }

            .fac-link {
                display: inline-flex;
                align-items: center;
                gap: 0.35rem;
                font-family: 'Poppins', sans-serif;
                font-size: 0.8rem;
                font-weight: 700;
                color: var(--c-primary);
                transition: gap .2s, color .2s;
            }

            .fac-card:hover .fac-link {
                gap: .6rem;
                color: var(--c-accent);
            }

            /* Custom prev/next */
            .fac-prev,
            .fac-next {
                width: 50px;
                height: 50px;
                background: white;
                border: 2px solid var(--c-border);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                transition: var(--transition-fast, all .25s);
                box-shadow: var(--shadow-md);
                color: var(--c-primary);
            }

            .fac-prev:hover,
            .fac-next:hover {
                background: var(--c-primary);
                border-color: var(--c-primary);
                color: white;
            }

            .fac-slider-controls {
                display: flex;
                justify-content: center;
                gap: 0.75rem;
                margin-top: 2.5rem;
            }

            /* Slick theme overrides */
            .slick-dots {
                bottom: -2.5rem;
            }

            .slick-dots li button::before {
                color: var(--c-primary) !important;
                font-size: 7px !important;
            }

            .slick-dots li.slick-active button::before {
                color: var(--c-accent) !important;
                font-size: 10px !important;
            }


            /* ════════════════════════════════════════
           PROGRAMS & STUDY
        ════════════════════════════════════════ */
            #uni-programs {
                padding: var(--section-py, 6rem) 0;
                background: white;
            }

            .prog-filters {
                display: flex;
                justify-content: center;
                flex-wrap: wrap;
                gap: 0.55rem;
                margin-bottom: 3rem;
            }

            .prog-filter-btn {
                padding: 0.55rem 1.4rem;
                border-radius: 50px;
                border: 2px solid var(--c-border);
                background: white;
                color: var(--c-text-muted);
                font-family: 'Poppins', sans-serif;
                font-weight: 600;
                font-size: 0.82rem;
                cursor: pointer;
                transition: var(--transition-fast, all .25s);
            }

            .prog-filter-btn:hover {
                border-color: var(--c-primary);
                color: var(--c-primary);
            }

            .prog-filter-btn.active {
                background: var(--c-primary);
                border-color: var(--c-primary);
                color: white;
                box-shadow: 0 6px 20px rgba(7, 41, 77, .3);
            }

            .prog-grid {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 1.5rem;
            }

            .prog-card {
                background: var(--c-light);
                border-radius: var(--radius-md, 16px);
                padding: 1.8rem;
                border: 1.5px solid var(--c-border);
                transition: var(--transition, all .4s cubic-bezier(.4, 0, .2, 1));
                position: relative;
                overflow: hidden;
            }

            .prog-card::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 4px;
                height: 100%;
                background: linear-gradient(to bottom, var(--c-accent), var(--c-primary));
                transform: scaleY(0);
                transform-origin: top;
                transition: transform .4s ease;
            }

            .prog-card:hover::before {
                transform: scaleY(1);
            }

            .prog-card:hover {
                background: white;
                box-shadow: var(--shadow-lg);
                transform: translateY(-6px);
                border-color: rgba(7, 41, 77, .2);
            }

            .prog-card-icon {
                width: 54px;
                height: 54px;
                border-radius: var(--radius-sm, 8px);
                background: rgba(7, 41, 77, .06);
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.5rem;
                margin-bottom: 1.2rem;
                transition: var(--transition-fast, all .25s);
            }

            .prog-card:hover .prog-card-icon {
                background: var(--c-accent);
            }

            .prog-cat {
                font-size: 0.66rem;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 0.1em;
                color: var(--c-accent);
                margin-bottom: 0.35rem;
            }

            .prog-name {
                font-family: 'Poppins', sans-serif;
                font-size: 1.02rem;
                font-weight: 700;
                color: var(--c-primary);
                margin-bottom: 0.5rem;
                line-height: 1.35;
            }

            .prog-meta {
                display: flex;
                flex-wrap: wrap;
                gap: 0.6rem 1rem;
                font-size: 0.73rem;
                color: var(--c-text-muted);
                margin-bottom: 0.75rem;
            }

            .prog-meta span {
                display: flex;
                align-items: center;
                gap: .25rem;
            }

            .prog-desc {
                font-size: 0.79rem;
                color: var(--c-text-muted);
                line-height: 1.68;
            }

            .prog-card-footer {
                margin-top: 1.2rem;
                padding-top: 1rem;
                border-top: 1px solid var(--c-border);
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .prog-seats {
                font-size: 0.72rem;
                color: var(--c-text-muted);
                font-weight: 500;
            }

            .prog-link {
                font-size: 0.78rem;
                font-weight: 700;
                font-family: 'Poppins', sans-serif;
                color: var(--c-primary);
                transition: color .2s;
                display: flex;
                align-items: center;
                gap: 0.25rem;
            }

            .prog-card:hover .prog-link {
                color: var(--c-accent);
            }


            /* ════════════════════════════════════════
           GALLERY
        ════════════════════════════════════════ */
            #uni-gallery {
                padding: var(--section-py, 6rem) 0;
                background: var(--c-light);
            }

            .gallery-grid {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                grid-template-rows: 220px 220px;
                gap: 1rem;
            }

            .g-item {
                position: relative;
                overflow: hidden;
                border-radius: var(--radius-md, 16px);
                cursor: pointer;
            }

            .g-item:nth-child(1) {
                grid-column: span 2;
                grid-row: span 2;
            }

            .g-item:nth-child(6) {
                grid-column: span 2;
            }

            .g-item img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform .65s ease;
            }

            .g-item:hover img {
                transform: scale(1.12);
            }

            .g-ov {
                position: absolute;
                inset: 0;
                background: linear-gradient(to top, rgba(7, 41, 77, .82) 0%, rgba(7, 41, 77, .1) 60%, transparent 100%);
                opacity: 0;
                transition: opacity .4s ease;
                display: flex;
                flex-direction: column;
                justify-content: flex-end;
                padding: 1.25rem;
            }

            .g-item:hover .g-ov {
                opacity: 1;
            }

            .g-ov-label {
                color: white;
                font-family: 'Poppins', sans-serif;
                font-size: .88rem;
                font-weight: 700;
            }

            .g-ov-sub {
                color: rgba(255, 255, 255, .65);
                font-size: .72rem;
                margin-top: .2rem;
            }

            .g-zoom {
                position: absolute;
                top: 1rem;
                right: 1rem;
                width: 36px;
                height: 36px;
                background: rgba(255, 255, 255, .2);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                opacity: 0;
                transition: opacity .3s;
                backdrop-filter: blur(6px);
                font-size: 0.85rem;
            }

            .g-item:hover .g-zoom {
                opacity: 1;
            }


            /* ════════════════════════════════════════
           TESTIMONIALS
        ════════════════════════════════════════ */
            #uni-testimonials {
                padding: var(--section-py, 6rem) 0;
                background: var(--c-primary-dark);
                position: relative;
                overflow: hidden;
            }

            .testi-bg-quote {
                position: absolute;
                top: -40px;
                left: 3%;
                font-size: 320px;
                font-family: 'Poppins', sans-serif;
                color: rgba(255, 255, 255, .025);
                font-weight: 900;
                line-height: 1;
                pointer-events: none;
                user-select: none;
            }

            #uni-testimonials .sec-tag {
                background: rgba(245, 166, 35, .12);
                border-color: rgba(245, 166, 35, .25);
                color: var(--c-accent);
            }

            #uni-testimonials .sec-title {
                color: white;
            }

            #uni-testimonials .sec-sub {
                color: rgba(255, 255, 255, .5);
            }

            .testi-slider-outer {
                overflow: hidden;
                position: relative;
            }

            .testi-track {
                display: flex;
                gap: 1.5rem;
                transition: transform .65s cubic-bezier(.4, 0, .2, 1);
            }

            .testi-card {
                flex: 0 0 calc(33.333% - 1rem);
                background: rgba(255, 255, 255, .06);
                border: 1px solid rgba(255, 255, 255, .1);
                border-radius: var(--radius-lg, 24px);
                padding: 2rem;
                transition: var(--transition, all .4s cubic-bezier(.4, 0, .2, 1));
                backdrop-filter: blur(10px);
            }

            .testi-card:hover {
                background: rgba(255, 255, 255, .1);
                border-color: rgba(245, 166, 35, .35);
                transform: translateY(-6px);
            }

            .testi-stars {
                color: var(--c-accent);
                font-size: 0.9rem;
                letter-spacing: 1px;
                margin-bottom: 1rem;
            }

            .testi-text {
                font-size: 0.9rem;
                color: rgba(255, 255, 255, .78);
                line-height: 1.82;
                font-style: italic;
                margin-bottom: 1.5rem;
                position: relative;
            }

            .testi-text::before {
                content: '\201C';
                font-family: 'Poppins', sans-serif;
                font-size: 3rem;
                color: var(--c-accent);
                line-height: 0.5;
                display: block;
                margin-bottom: 0.5rem;
            }

            .testi-footer {
                display: flex;
                align-items: center;
                gap: .8rem;
            }

            .testi-av {
                width: 50px;
                height: 50px;
                border-radius: 50%;
                background: linear-gradient(135deg, var(--c-primary-mid, #0a3d6b), var(--c-primary-light, #0e5a9e));
                border: 2px solid rgba(245, 166, 35, .4);
                display: flex;
                align-items: center;
                justify-content: center;
                font-family: 'Poppins', sans-serif;
                font-weight: 800;
                color: var(--c-accent);
                font-size: 1rem;
                flex-shrink: 0;
                overflow: hidden;
            }

            .testi-av img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .testi-name {
                font-family: 'Poppins', sans-serif;
                font-weight: 700;
                font-size: 0.9rem;
                color: white;
            }

            .testi-prog {
                font-size: 0.7rem;
                color: rgba(255, 255, 255, .4);
                margin-top: .15rem;
            }

            .testi-nav {
                display: flex;
                justify-content: center;
                align-items: center;
                gap: 1rem;
                margin-top: 2.5rem;
            }

            .testi-nav-btn {
                width: 44px;
                height: 44px;
                border-radius: 50%;
                background: rgba(255, 255, 255, .1);
                border: 1.5px solid rgba(255, 255, 255, .2);
                color: white;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                transition: var(--transition-fast, all .25s);
            }

            .testi-nav-btn:hover {
                background: var(--c-accent);
                border-color: var(--c-accent);
                color: var(--c-primary-dark);
            }

            .testi-dots {
                display: flex;
                gap: 0.5rem;
            }

            .testi-dot {
                width: 7px;
                height: 7px;
                border-radius: 50%;
                background: rgba(255, 255, 255, .25);
                cursor: pointer;
                transition: all .3s;
                border: none;
            }

            .testi-dot.active {
                background: var(--c-accent);
                width: 22px;
                border-radius: 4px;
            }


            /* ════════════════════════════════════════
           APPLY TODAY
        ════════════════════════════════════════ */
            #uni-apply {
                padding: var(--section-py, 6rem) 0;
                position: relative;
                overflow: hidden;
            }

            .apply-bg-img {
                position: absolute;
                inset: 0;
                background: url('https://images.unsplash.com/photo-1541339907198-e08756dedf3f?w=1600&q=80') center/cover;
                background-attachment: fixed;
            }

            .apply-ov {
                position: absolute;
                inset: 0;
                background: linear-gradient(135deg, rgba(0, 25, 54, .96) 0%, rgba(7, 41, 77, .9) 100%);
            }

            .apply-inner {
                position: relative;
                z-index: 2;
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 4rem;
                align-items: center;
            }

            .apply-content .sec-tag {
                background: rgba(245, 166, 35, .12);
                border-color: rgba(245, 166, 35, .25);
                color: var(--c-accent);
            }

            .apply-content .sec-title {
                color: white;
                text-align: left;
            }

            .apply-content .sec-divider {
                margin: 0.75rem 0;
            }

            .apply-sub {
                color: rgba(255, 255, 255, .62);
                font-size: 0.97rem;
                line-height: 1.82;
                margin: 1.5rem 0 2rem;
            }

            .apply-feats {
                display: flex;
                flex-direction: column;
                gap: 0.8rem;
                margin-bottom: 2.5rem;
            }

            .apply-feat {
                display: flex;
                align-items: center;
                gap: 0.75rem;
                color: rgba(255, 255, 255, .78);
                font-size: 0.9rem;
            }

            .apply-feat-icon {
                width: 24px;
                height: 24px;
                background: var(--c-accent);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-shrink: 0;
            }

            /* Form card */
            .apply-form-card {
                background: white;
                border-radius: var(--radius-lg, 24px);
                padding: 2.5rem;
                box-shadow: var(--shadow-xl);
            }

            .afc-title {
                font-family: 'Poppins', sans-serif;
                font-size: 1.35rem;
                font-weight: 700;
                color: var(--c-primary);
                margin-bottom: 0.3rem;
            }

            .afc-sub {
                font-size: 0.8rem;
                color: var(--c-text-muted);
                margin-bottom: 1.75rem;
            }

            .afc-row {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 1rem;
            }

            .afc-group {
                display: flex;
                flex-direction: column;
                gap: 0.35rem;
                margin-bottom: 1rem;
            }

            .afc-group label {
                font-size: 0.72rem;
                font-weight: 700;
                color: var(--c-text);
                text-transform: uppercase;
                letter-spacing: 0.05em;
            }

            .afc-group input,
            .afc-group select {
                width: 100%;
                border: 1.5px solid var(--c-border);
                border-radius: var(--radius-sm, 8px);
                padding: 0.72rem 1rem;
                font-size: 0.87rem;
                color: var(--c-text);
                font-family: 'Inter', sans-serif;
                outline: none;
                background: var(--c-lighter);
                transition: var(--transition-fast, all .25s);
                appearance: none;
                -webkit-appearance: none;
            }

            .afc-group input:focus,
            .afc-group select:focus {
                border-color: var(--c-primary);
                background: white;
                box-shadow: 0 0 0 3px rgba(7, 41, 77, .07);
            }

            .afc-submit {
                width: 100%;
                background: linear-gradient(135deg, var(--c-primary), var(--c-primary-mid, #0a3d6b));
                color: white;
                border: none;
                border-radius: 50px;
                padding: 0.95rem;
                font-family: 'Poppins', sans-serif;
                font-weight: 700;
                font-size: 0.95rem;
                cursor: pointer;
                transition: var(--transition, all .4s cubic-bezier(.4, 0, .2, 1));
                box-shadow: 0 8px 28px rgba(7, 41, 77, .35);
                margin-top: 0.5rem;
                letter-spacing: 0.01em;
            }

            .afc-submit:hover {
                background: linear-gradient(135deg, var(--c-accent), var(--c-accent-dark, #d4891a));
                color: var(--c-primary-dark);
                transform: translateY(-2px);
                box-shadow: 0 14px 40px rgba(245, 166, 35, .4);
            }

            .afc-note {
                text-align: center;
                font-size: 0.7rem;
                color: var(--c-text-muted);
                margin-top: 0.75rem;
            }


            /* ════════════════════════════════════════
           BLOG / NEWS
        ════════════════════════════════════════ */
            #uni-blog {
                padding: var(--section-py, 6rem) 0;
                background: white;
            }

            .blog-grid {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 2rem;
            }

            .blog-card {
                border-radius: var(--radius-lg, 24px);
                overflow: hidden;
                border: 1.5px solid var(--c-border);
                background: white;
                box-shadow: var(--shadow-sm);
                transition: var(--transition, all .4s cubic-bezier(.4, 0, .2, 1));
            }

            .blog-card:hover {
                transform: translateY(-8px);
                box-shadow: var(--shadow-xl);
                border-color: rgba(7, 41, 77, .2);
            }

            .blog-thumb {
                height: 220px;
                overflow: hidden;
                position: relative;
            }

            .blog-thumb img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform .65s ease;
            }

            .blog-card:hover .blog-thumb img {
                transform: scale(1.08);
            }

            .blog-cat-badge {
                position: absolute;
                bottom: 1rem;
                left: 1rem;
                background: var(--c-accent);
                color: var(--c-primary-dark);
                font-size: 0.63rem;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 0.06em;
                padding: 0.28rem 0.8rem;
                border-radius: 50px;
            }

            .blog-body {
                padding: 1.5rem 1.75rem 1.75rem;
            }

            .blog-meta {
                display: flex;
                align-items: center;
                gap: 1rem;
                font-size: 0.71rem;
                color: var(--c-text-muted);
                margin-bottom: 0.65rem;
            }

            .blog-meta span {
                display: flex;
                align-items: center;
                gap: .3rem;
            }

            .blog-title {
                font-family: 'Poppins', sans-serif;
                font-size: 1.05rem;
                font-weight: 700;
                color: var(--c-primary);
                line-height: 1.42;
                margin-bottom: 0.6rem;
                transition: color .2s;
            }

            .blog-card:hover .blog-title {
                color: var(--c-primary-light, #0e5a9e);
            }

            .blog-excerpt {
                font-size: 0.81rem;
                color: var(--c-text-muted);
                line-height: 1.72;
                margin-bottom: 1.2rem;
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }

            .blog-read {
                display: inline-flex;
                align-items: center;
                gap: 0.35rem;
                font-size: 0.8rem;
                font-weight: 700;
                font-family: 'Poppins', sans-serif;
                color: var(--c-primary);
                transition: gap .2s, color .2s;
            }

            .blog-card:hover .blog-read {
                gap: .6rem;
                color: var(--c-accent);
            }


            /* ════════════════════════════════════════
           CAMPUS LIFE
        ════════════════════════════════════════ */
            #uni-campus {
                padding: var(--section-py, 6rem) 0;
                background: var(--c-light);
            }

            .campus-grid {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                grid-auto-rows: 210px;
                gap: 1rem;
            }

            .campus-item {
                position: relative;
                overflow: hidden;
                border-radius: var(--radius-md, 16px);
                cursor: pointer;
            }

            .campus-item:nth-child(1) {
                grid-column: span 2;
                grid-row: span 2;
            }

            .campus-item:nth-child(5) {
                grid-column: span 2;
            }

            .campus-item img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform .65s ease;
            }

            .campus-item:hover img {
                transform: scale(1.12);
            }

            .campus-ov {
                position: absolute;
                inset: 0;
                background: linear-gradient(to top, rgba(7, 41, 77, .78) 0%, transparent 65%);
                opacity: 0;
                transition: opacity .4s;
                display: flex;
                align-items: flex-end;
                padding: 1.25rem;
            }

            .campus-item:hover .campus-ov {
                opacity: 1;
            }

            .campus-lbl {
                color: white;
                font-family: 'Poppins', sans-serif;
                font-size: 0.9rem;
                font-weight: 700;
            }

            .campus-lbl-sub {
                font-size: 0.7rem;
                color: rgba(255, 255, 255, .65);
                margin-top: .18rem;
                font-family: 'Inter', sans-serif;
            }


            /* ════════════════════════════════════════
           BACK TO TOP
        ════════════════════════════════════════ */
            #uni-back-top {
                position: fixed;
                bottom: 2rem;
                right: 2rem;
                width: 46px;
                height: 46px;
                border-radius: 50%;
                background: linear-gradient(135deg, var(--c-primary), var(--c-primary-mid, #0a3d6b));
                border: 2px solid rgba(245, 166, 35, .3);
                color: white;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 6px 24px rgba(7, 41, 77, .4);
                transition: var(--transition, all .4s cubic-bezier(.4, 0, .2, 1));
                opacity: 0;
                pointer-events: none;
                z-index: 999;
            }

            #uni-back-top.visible {
                opacity: 1;
                pointer-events: all;
            }

            #uni-back-top:hover {
                transform: translateY(-4px);
                box-shadow: 0 12px 36px rgba(7, 41, 77, .5);
                background: var(--c-accent);
            }


            /* ════════════════════════════════════════
           RESPONSIVE
        ════════════════════════════════════════ */
            @media(max-width:1024px) {
                :root {
                    --section-py: 4.5rem;
                }

                .about-grid {
                    grid-template-columns: 1fr;
                    gap: 3rem;
                }

                .about-images-block {
                    height: 420px;
                }

                .prog-grid {
                    grid-template-columns: repeat(2, 1fr);
                }

                .blog-grid {
                    grid-template-columns: repeat(2, 1fr);
                }

                .apply-inner {
                    grid-template-columns: 1fr;
                    gap: 3rem;
                }

                .gallery-grid {
                    grid-template-columns: repeat(2, 1fr);
                    grid-template-rows: none;
                }

                .g-item {
                    height: 200px;
                }

                .g-item:nth-child(1) {
                    grid-column: span 2;
                    height: 280px;
                }

                .g-item:nth-child(6) {
                    grid-column: span 2;
                    height: 200px;
                }

                .hero-stats-inner {
                    grid-template-columns: repeat(2, 1fr);
                }

                .hero-stat:nth-child(2) {
                    border-right: none;
                }

                .hero-stat {
                    border-right: 1px solid rgba(255, 255, 255, .07);
                    border-bottom: 1px solid rgba(255, 255, 255, .07);
                }
            }

            @media(max-width:768px) {
                :root {
                    --section-py: 3.5rem;
                }

                .prog-grid {
                    grid-template-columns: 1fr;
                }

                .blog-grid {
                    grid-template-columns: 1fr;
                }

                .testi-card {
                    flex: 0 0 calc(100% - 0.5rem);
                }

                .afc-row {
                    grid-template-columns: 1fr;
                }

                .campus-grid {
                    grid-template-columns: repeat(2, 1fr);
                }

                .campus-item:nth-child(1) {
                    grid-column: span 2;
                }

                .about-images-block {
                    height: 360px;
                }

                .about-logo-badge {
                    left: -14px;
                }

                .hero-counter {
                    display: none;
                }

                .hero-scroll-hint {
                    display: none;
                }
            }

            @media(max-width:540px) {
                .gallery-grid {
                    grid-template-columns: 1fr 1fr;
                    grid-template-rows: none;
                }

                .g-item {
                    height: 150px !important;
                }

                .g-item:nth-child(1),
                .g-item:nth-child(6) {
                    grid-column: span 2;
                    height: 200px !important;
                }

                .hero-btns {
                    flex-direction: column;
                }

                .hero-btns .btn {
                    justify-content: center;
                }

                .hero-stat-val {
                    font-size: 1.7rem;
                }

                .campus-grid {
                    grid-template-columns: 1fr 1fr;
                }

                .campus-item:nth-child(5) {
                    grid-column: span 2;
                }
            }

            @media (min-width:1200px){
                .container{
                    max-width:95%;
                }
            }
        </style>
    @endpush

@section('content')

    @include('articals.blue.BlueArtical.header')

    {{-- ══════════════════════════════════════
     HERO SLIDER
══════════════════════════════════════ --}}
    <section id="uni-hero">

        {{-- Slides --}}
        <div class="hero-slides-wrap" id="heroSlides">

            {{-- Slide 1 --}}
            <div class="hero-slide active" data-index="0">
                <div class="hero-slide-bg"
                    style="background-image:url('https://images.unsplash.com/photo-1562774053-701939374585?w=1600&q=85')">
                </div>
                <div class="hero-overlay"></div>
                {{-- <div class="hero-overlay-pattern"></div> --}}
                <div class="hero-content">
                    <div class="container1">
                        <div class="hero-text">
                            <div class="hero-eyebrow">🎓 Ranked #1 in Excellence · Admissions 2026 Open</div>
                            <h1>Shaping the <em>Leaders</em><br>of Tomorrow</h1>
                            <p>BluePeak University offers a transformative academic experience that combines world-class
                                faculty, cutting-edge research, and a vibrant campus life to inspire lifelong learning.</p>
                            <div class="hero-btns">
                                <a href="#apply" class="btn btn-yellow">Apply Now — 2026 ↗</a>
                                <a href="#about" class="btn btn-white-outline">Discover More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Slide 2 --}}
            <div class="hero-slide" data-index="1">
                <div class="hero-slide-bg"
                    style="background-image:url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=1600&q=85')">
                </div>
                <div class="hero-overlay"></div>
                {{-- <div class="hero-overlay-pattern"></div> --}}
                <div class="hero-content">
                    <div class="container1">
                        <div class="hero-text">
                            <div class="hero-eyebrow">🔬 Research & Innovation Hub</div>
                            <h1>Where <em>Knowledge</em><br>Meets Innovation</h1>
                            <p>With 50+ research centres and state-of-the-art laboratories, we are at the forefront of
                                scientific discovery, technological advancement, and social impact.</p>
                            <div class="hero-btns">
                                <a href="#programs" class="btn btn-yellow">Explore Programs</a>
                                <a href="#faculties" class="btn btn-white-outline">Our Faculties</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Slide 3 --}}
            <div class="hero-slide" data-index="2">
                <div class="hero-slide-bg"
                    style="background-image:url('https://images.unsplash.com/photo-1541339907198-e08756dedf3f?w=1600&q=85')">
                </div>
                <div class="hero-overlay"></div>
                {{-- <div class="hero-overlay-pattern"></div> --}}
                <div class="hero-content">
                    <div class="container1">
                        <div class="hero-text">
                            <div class="hero-eyebrow">🏆 National Award Winning Campus</div>
                            <h1>A Campus That <em>Inspires</em><br>Every Dream</h1>
                            <p>Our award-winning 500-acre campus provides world-class sports facilities, cultural centres,
                                student housing, and green spaces that enrich student life beyond the classroom.</p>
                            <div class="hero-btns">
                                <a href="#campus" class="btn btn-yellow">Campus Life</a>
                                <a href="#gallery" class="btn btn-white-outline">View Gallery</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- Slide counter --}}
        {{-- <div class="hero-counter" id="heroCounter">
    <span id="heroCurrentSlide">01</span> / 03
  </div> --}}

        {{-- Scroll hint --}}
        {{-- <div class="hero-scroll-hint">
    <div class="scroll-line"></div>
    Scroll to explore
  </div> --}}

        {{-- Navigation dots --}}
        <div class="hero-dots-wrap" id="heroDots">
            <button class="hero-dot active" data-slide="0"></button>
            <button class="hero-dot" data-slide="1"></button>
            <button class="hero-dot" data-slide="2"></button>
        </div>

        {{-- Arrows --}}
        <div class="hero-arrows-wrap">
            <button class="hero-arrow-btn" id="heroPrev" aria-label="Previous">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5"
                    viewBox="0 0 24 24">
                    <path d="m15 18-6-6 6-6" />
                </svg>
            </button>
            <button class="hero-arrow-btn" id="heroNext" aria-label="Next">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5"
                    viewBox="0 0 24 24">
                    <path d="m9 18 6-6-6-6" />
                </svg>
            </button>
        </div>

        {{-- Stats bar --}}
        <div class="hero-ui">
            <div class="hero-stats-bar">
                <div class="container">
                    <div class="hero-stats-inner">
                        <div class="hero-stat">
                            <div class="hero-stat-val" data-count="25000">25K+</div>
                            <div class="hero-stat-lbl">Students Enrolled</div>
                        </div>
                        <div class="hero-stat">
                            <div class="hero-stat-val">1200+</div>
                            <div class="hero-stat-lbl">Expert Faculty</div>
                        </div>
                        <div class="hero-stat">
                            <div class="hero-stat-val">98%</div>
                            <div class="hero-stat-lbl">Placement Rate</div>
                        </div>
                        <div class="hero-stat">
                            <div class="hero-stat-val">40+</div>
                            <div class="hero-stat-lbl">Years of Excellence</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>


    {{-- ══════════════════════════════════════
     ABOUT US
══════════════════════════════════════ --}}
    <section id="uni-about" class="section-py">
        <div class="container">
            <div class="about-grid">

                {{-- Images left --}}
                <div class="about-images-block reveal-left">

                    <div class="about-img-1">
                        <img src="https://images.unsplash.com/photo-1523580494863-6f3031224c94?w=700&q=85"
                            alt="University campus">
                    </div>

                    <div class="about-img-2">
                        <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7?w=500&q=85"
                            alt="Students studying">
                    </div>

                    {{-- Logo badge --}}
                    {{-- <div class="about-logo-badge">
                        <svg width="32" height="32" fill="none" viewBox="0 0 32 32">
                            <path d="M16 3L3 10l13 7 13-7L16 3z" fill="var(--c-primary-dark)"
                                stroke="var(--c-primary-dark)" stroke-width="1" />
                            <path d="M3 22l13 7 13-7" stroke="var(--c-primary-dark)" stroke-width="2.5"
                                stroke-linecap="round" />
                            <path d="M3 16l13 7 13-7" stroke="var(--c-primary-dark)" stroke-width="2.5"
                                stroke-linecap="round" />
                        </svg>
                    </div> --}}

                    {{-- Experience badge --}}
                    <div class="about-exp-badge">
                        <div class="about-exp-num">40+</div>
                        <div class="about-exp-lbl">Years of<br>Excellence</div>
                    </div>

                    {{-- Award badge --}}
                    {{-- <div class="about-award-badge">
                        <div class="about-award-icon">🏆</div>
                        <div>
                            <div class="about-award-text">Best University Award</div>
                            <div class="about-award-sub">National Education Summit 2025</div>
                        </div>
                    </div> --}}

                </div>

                {{-- Content right --}}
                <div class="about-content-block reveal-right">

                    <div class="sec-head" style="text-align:left;margin-bottom:1.75rem;">
                        <div class="sec-tag"><span class="dot-pulse"></span> About BluePeak</div>
                        <h2 class="sec-title" style="text-align:left;">
                            Committed to <span class="grad">Academic Excellence</span><br>Since 1985
                        </h2>
                        <div class="sec-divider" style="margin-left:0;"></div>
                    </div>

                    <p class="about-lead">
                        BluePeak University stands as one of India's premier institutions of higher learning, with a rich
                        legacy of academic excellence, groundbreaking research, and holistic student development spanning
                        over four decades.
                    </p>

                    <p class="about-body">
                        Our diverse community of scholars, researchers, and innovators work together to address the most
                        pressing challenges of our time. With more than 120 programs across 15 faculties, we offer every
                        student the opportunity to discover their passion and realise their full potential.
                    </p>

                    <div class="about-highlights">
                        <div class="about-hl-item">
                            <div class="about-hl-icon">
                                <svg width="12" height="12" fill="none" stroke="var(--c-primary-dark)"
                                    stroke-width="2.5" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5" />
                                </svg>
                            </div>
                            NAAC 'A++' Accredited — Highest grade in India
                        </div>
                        <div class="about-hl-item">
                            <div class="about-hl-icon">
                                <svg width="12" height="12" fill="none" stroke="var(--c-primary-dark)"
                                    stroke-width="2.5" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5" />
                                </svg>
                            </div>
                            500-acre green campus with world-class infrastructure
                        </div>
                        <div class="about-hl-item">
                            <div class="about-hl-icon">
                                <svg width="12" height="12" fill="none" stroke="var(--c-primary-dark)"
                                    stroke-width="2.5" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5" />
                                </svg>
                            </div>
                            Partnerships with 200+ global universities &amp; corporates
                        </div>
                        <div class="about-hl-item">
                            <div class="about-hl-icon">
                                <svg width="12" height="12" fill="none" stroke="var(--c-primary-dark)"
                                    stroke-width="2.5" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5" />
                                </svg>
                            </div>
                            98% placement record with top-tier recruiters
                        </div>
                    </div>

                    <div class="about-stats-row">
                        <div class="about-stat-item">
                            <div class="about-sv">120+</div>
                            <div class="about-sl">Programs</div>
                        </div>
                        <div class="about-stat-item">
                            <div class="about-sv">15</div>
                            <div class="about-sl">Faculties</div>
                        </div>
                        <div class="about-stat-item">
                            <div class="about-sv">50+</div>
                            <div class="about-sl">Research Centres</div>
                        </div>
                    </div>

                    <a href="#" class="about-read-more">
                        Discover Our Story
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5"
                            viewBox="0 0 24 24">
                            <path d="M5 12h14M12 5l7 7-7 7" />
                        </svg>
                    </a>

                </div>

            </div>
        </div>
    </section>


    {{-- ══════════════════════════════════════
     OUR FACULTIES
══════════════════════════════════════ --}}
    <section id="uni-faculties" class="section-py">
        <div class="container">

            <div class="sec-head reveal">
                <div class="sec-tag"><span class="dot-pulse"></span> Academic Divisions</div>
                <h2 class="sec-title">Our <span class="grad">Faculties</span></h2>
                <div class="sec-divider"></div>
                <p class="sec-sub">Explore our diverse range of faculties led by distinguished scholars, Nobel laureates,
                    and industry veterans committed to your success.</p>
            </div>

            <div class="fac-slider-wrap reveal">
                <div class="fac-slider" id="facSlider">

                    @php
                        $faculties = [
                            [
                                'icon' => '⚙️',
                                'badge' => '150+ Seats',
                                'img' => 'photo-1581091226825-a6a2a5aee158',
                                'title' => 'Faculty of Engineering & Technology',
                                'desc' =>
                                    'Cutting-edge programs in CS, AI, Mechanical, Civil, Electronics and more. Industry-integrated curriculum with 100% placement support.',
                                'count' => '12 Programs · 1200 Students',
                            ],
                            [
                                'icon' => '🏥',
                                'badge' => '100 Seats',
                                'img' => 'photo-1576091160550-2173dba999ef',
                                'title' => 'Faculty of Medical Sciences',
                                'desc' =>
                                    'MBBS, BDS, Pharmacy and Allied Health Sciences with world-class hospitals and research facilities serving 50,000+ patients annually.',
                                'count' => '8 Programs · 800 Students',
                            ],
                            [
                                'icon' => '💼',
                                'badge' => '200+ Seats',
                                'img' => 'photo-1507003211169-0a1dd7228f2d',
                                'title' => 'Faculty of Business & Commerce',
                                'desc' =>
                                    'BBA, MBA, CA Foundation and Finance programs with real-world case studies, live projects, and Fortune 500 internship opportunities.',
                                'count' => '10 Programs · 950 Students',
                            ],
                            [
                                'icon' => '🎨',
                                'badge' => '80 Seats',
                                'img' => 'photo-1561070791-2526d30994b5',
                                'title' => 'Faculty of Arts & Design',
                                'desc' =>
                                    'Fine Arts, Graphic Design, Fashion, and Performing Arts programs nurturing creativity with state-of-the-art studios and exhibition spaces.',
                                'count' => '9 Programs · 550 Students',
                            ],
                            [
                                'icon' => '🔬',
                                'badge' => '120 Seats',
                                'img' => 'photo-1532094349884-543559be79b9',
                                'title' => 'Faculty of Pure Sciences',
                                'desc' =>
                                    'Physics, Chemistry, Biology, Mathematics and interdisciplinary science programs with advanced research laboratories and DST-funded projects.',
                                'count' => '8 Programs · 700 Students',
                            ],
                            [
                                'icon' => '⚖️',
                                'badge' => '60 Seats',
                                'img' => 'photo-1589829545856-d10d557cf95f',
                                'title' => 'Faculty of Law & Governance',
                                'desc' =>
                                    'LLB, LLM, and Policy programs with prestigious moot court facilities, legal aid clinics, and strong alumni network across the judiciary.',
                                'count' => '5 Programs · 320 Students',
                            ],
                        ];
                    @endphp

                    @foreach ($faculties as $fac)
                        <div class="fac-card">
                            <div class="fac-card-img">
                                <img src="https://images.unsplash.com/{{ $fac['img'] }}?w=500&h=250&fit=crop&q=80"
                                    alt="{{ $fac['title'] }}" loading="lazy">
                                <div class="fac-card-img-ov"></div>
                                <span class="fac-card-badge">{{ $fac['badge'] }}</span>
                                <div class="fac-card-icon-wrap">{{ $fac['icon'] }}</div>
                            </div>
                            <div class="fac-card-body">
                                <div class="fac-count">{{ $fac['count'] }}</div>
                                <h3 class="fac-title">{{ $fac['title'] }}</h3>
                                <p class="fac-desc">{{ $fac['desc'] }}</p>
                                <a href="#" class="fac-link">
                                    Explore Faculty
                                    <svg width="14" height="14" fill="none" stroke="currentColor"
                                        stroke-width="2.5" viewBox="0 0 24 24">
                                        <path d="M5 12h14M12 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach

                </div>

                <div class="fac-slider-controls">
                    <button class="fac-prev" id="facPrev" aria-label="Previous">
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5"
                            viewBox="0 0 24 24">
                            <path d="m15 18-6-6 6-6" />
                        </svg>
                    </button>
                    <button class="fac-next" id="facNext" aria-label="Next">
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5"
                            viewBox="0 0 24 24">
                            <path d="m9 18 6-6-6-6" />
                        </svg>
                    </button>
                </div>

            </div>

        </div>
    </section>


    {{-- ══════════════════════════════════════
     PROGRAMS & STUDY
══════════════════════════════════════ --}}
    <section id="uni-programs" class="section-py">
        <div class="container">

            <div class="sec-head reveal">
                <div class="sec-tag"><span class="dot-pulse"></span> Academic Programs</div>
                <h2 class="sec-title">Programs &amp; <span class="grad">Study</span></h2>
                <div class="sec-divider"></div>
                <p class="sec-sub">Browse our 120+ programs across all disciplines. Filter by your area of interest to find
                    the perfect course for your aspirations.</p>
            </div>

            <div class="prog-filters reveal">
                <button class="prog-filter-btn active" data-filter="all">All Programs</button>
                <button class="prog-filter-btn" data-filter="engineering">Engineering</button>
                <button class="prog-filter-btn" data-filter="medical">Medical</button>
                <button class="prog-filter-btn" data-filter="business">Business</button>
                <button class="prog-filter-btn" data-filter="arts">Arts &amp; Design</button>
                <button class="prog-filter-btn" data-filter="science">Sciences</button>
                <button class="prog-filter-btn" data-filter="law">Law</button>
            </div>

            <div class="prog-grid" id="prog-grid">

                @php
                    $programs = [
                        [
                            'cat' => 'engineering',
                            'icon' => '💻',
                            'name' => 'B.Tech Computer Science & AI',
                            'duration' => '4 Years',
                            'seats' => '180 seats',
                            'level' => 'Undergraduate',
                            'desc' =>
                                'Comprehensive program covering algorithms, machine learning, and software engineering with industry projects.',
                        ],
                        [
                            'cat' => 'medical',
                            'icon' => '🏥',
                            'name' => 'MBBS — Bachelor of Medicine',
                            'duration' => '5.5 Years',
                            'seats' => '100 seats',
                            'level' => 'Undergraduate',
                            'desc' =>
                                'Full medical degree with clinical rotations at our 1000-bed teaching hospital and rural health camps.',
                        ],
                        [
                            'cat' => 'business',
                            'icon' => '📊',
                            'name' => 'MBA — Business Administration',
                            'duration' => '2 Years',
                            'seats' => '120 seats',
                            'level' => 'Postgraduate',
                            'desc' =>
                                'Dual-specialisation MBA with live consulting projects, exchange programs, and guaranteed internships.',
                        ],
                        [
                            'cat' => 'arts',
                            'icon' => '🎨',
                            'name' => 'B.Des — Visual Communication',
                            'duration' => '4 Years',
                            'seats' => '60 seats',
                            'level' => 'Undergraduate',
                            'desc' =>
                                'Creative program in branding, UI/UX, illustration, and motion graphics with portfolio-driven curriculum.',
                        ],
                        [
                            'cat' => 'science',
                            'icon' => '🔬',
                            'name' => 'M.Sc Data Science',
                            'duration' => '2 Years',
                            'seats' => '80 seats',
                            'level' => 'Postgraduate',
                            'desc' =>
                                'Advanced program in big data, statistical modelling, Python and ML pipelines with live industry datasets.',
                        ],
                        [
                            'cat' => 'engineering',
                            'icon' => '⚙️',
                            'name' => 'B.Tech Mechanical Engineering',
                            'duration' => '4 Years',
                            'seats' => '150 seats',
                            'level' => 'Undergraduate',
                            'desc' =>
                                'Robust mechanical program with CAD/CAM labs, robotics workshop, and Tata-sponsored internship tracks.',
                        ],
                        [
                            'cat' => 'law',
                            'icon' => '⚖️',
                            'name' => 'LLB — Bachelor of Laws',
                            'duration' => '3 Years',
                            'seats' => '60 seats',
                            'level' => 'Undergraduate',
                            'desc' =>
                                'Comprehensive law degree with specialisations in corporate, criminal, and constitutional law.',
                        ],
                        [
                            'cat' => 'business',
                            'icon' => '💰',
                            'name' => 'BBA — Business Administration',
                            'duration' => '3 Years',
                            'seats' => '160 seats',
                            'level' => 'Undergraduate',
                            'desc' =>
                                'Foundation business program with entrepreneurship cells, startup incubation, and mentoring by CEOs.',
                        ],
                        [
                            'cat' => 'medical',
                            'icon' => '💊',
                            'name' => 'B.Pharm — Pharmacy',
                            'duration' => '4 Years',
                            'seats' => '100 seats',
                            'level' => 'Undergraduate',
                            'desc' =>
                                'Modern pharmacy education with emphasis on drug discovery, clinical pharmacology, and biotech.',
                        ],
                    ];
                @endphp

                @foreach ($programs as $prog)
                    <div class="prog-card reveal delay-{{ ($loop->index % 3) + 1 }}" data-cat="{{ $prog['cat'] }}">
                        <div class="prog-card-icon">{{ $prog['icon'] }}</div>
                        <div class="prog-cat">{{ ucfirst($prog['cat']) }}</div>
                        <h3 class="prog-name">{{ $prog['name'] }}</h3>
                        <div class="prog-meta">
                            <span>
                                <svg width="11" height="11" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="10" />
                                    <polyline points="12 6 12 12 16 14" />
                                </svg>
                                {{ $prog['duration'] }}
                            </span>
                            <span>
                                <svg width="11" height="11" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                                    <circle cx="9" cy="7" r="4" />
                                </svg>
                                {{ $prog['level'] }}
                            </span>
                        </div>
                        <p class="prog-desc">{{ $prog['desc'] }}</p>
                        <div class="prog-card-footer">
                            <span class="prog-seats">📍 {{ $prog['seats'] }}</span>
                            <a href="#apply" class="prog-link">
                                Apply
                                <svg width="12" height="12" fill="none" stroke="currentColor"
                                    stroke-width="2.5" viewBox="0 0 24 24">
                                    <path d="M5 12h14M12 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach

            </div>

            <div style="text-align:center;margin-top:3rem;" class="reveal">
                <a href="#" class="btn btn-blue">
                    View All 120+ Programs
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5"
                        viewBox="0 0 24 24">
                        <path d="M5 12h14M12 5l7 7-7 7" />
                    </svg>
                </a>
            </div>

        </div>
    </section>


    {{-- ══════════════════════════════════════
     GALLERY
══════════════════════════════════════ --}}
    <section id="uni-gallery" class="section-py">
        <div class="container">

            <div class="sec-head reveal">
                <div class="sec-tag"><span class="dot-pulse"></span> Photo Gallery</div>
                <h2 class="sec-title">Our <span class="grad">Campus</span> in Pictures</h2>
                <div class="sec-divider"></div>
                <p class="sec-sub">A visual journey through our vibrant campus — from state-of-the-art labs to lush green
                    grounds, sports arenas and cultural spaces.</p>
            </div>

            <div class="gallery-grid reveal">

                <div class="g-item">
                    <img src="https://images.unsplash.com/photo-1562774053-701939374585?w=700&q=80" alt="Main Building"
                        loading="lazy">
                    <div class="g-ov">
                        <div class="g-zoom">🔍</div>
                        <div>
                            <div class="g-ov-label">Main Academic Block</div>
                            <div class="g-ov-sub">Established 1985</div>
                        </div>
                    </div>
                </div>

                <div class="g-item">
                    <img src="https://images.unsplash.com/photo-1523580494863-6f3031224c94?w=500&q=80" alt="Library"
                        loading="lazy">
                    <div class="g-ov">
                        <div class="g-zoom">🔍</div>
                        <div>
                            <div class="g-ov-label">Central Library</div>
                            <div class="g-ov-sub">500,000+ Books & Journals</div>
                        </div>
                    </div>
                </div>

                <div class="g-item">
                    <img src="https://images.unsplash.com/photo-1508830524289-0adcbe822b40?w=500&q=80" alt="Lab"
                        loading="lazy">
                    <div class="g-ov">
                        <div class="g-zoom">🔍</div>
                        <div>
                            <div class="g-ov-label">Research Laboratories</div>
                            <div class="g-ov-sub">50+ Advanced Labs</div>
                        </div>
                    </div>
                </div>

                <div class="g-item">
                    <img src="https://images.unsplash.com/photo-1541339907198-e08756dedf3f?w=500&q=80" alt="Sports"
                        loading="lazy">
                    <div class="g-ov">
                        <div class="g-zoom">🔍</div>
                        <div>
                            <div class="g-ov-label">Sports Complex</div>
                            <div class="g-ov-sub">Olympic Standard Facilities</div>
                        </div>
                    </div>
                </div>

                <div class="g-item">
                    <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7?w=500&q=80" alt="Students"
                        loading="lazy">
                    <div class="g-ov">
                        <div class="g-zoom">🔍</div>
                        <div>
                            <div class="g-ov-label">Student Collaboration</div>
                            <div class="g-ov-sub">25,000+ Active Students</div>
                        </div>
                    </div>
                </div>

                <div class="g-item">
                    <img src="https://images.unsplash.com/photo-1567168544813-cc03465b4fa8?w=700&q=80" alt="Graduation"
                        loading="lazy">
                    <div class="g-ov">
                        <div class="g-zoom">🔍</div>
                        <div>
                            <div class="g-ov-label">Annual Convocation</div>
                            <div class="g-ov-sub">Celebrating Student Success</div>
                        </div>
                    </div>
                </div>

                <div class="g-item">
                    <img src="https://images.unsplash.com/photo-1580582932707-520aed937b7b?w=500&q=80" alt="Hostel"
                        loading="lazy">
                    <div class="g-ov">
                        <div class="g-zoom">🔍</div>
                        <div>
                            <div class="g-ov-label">Student Residences</div>
                            <div class="g-ov-sub">Smart AC Hostels</div>
                        </div>
                    </div>
                </div>

            </div>

            <div style="text-align:center;margin-top:2.5rem;" class="reveal">
                <a href="#" class="btn btn-blue-outline">
                    View Full Gallery
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5"
                        viewBox="0 0 24 24">
                        <path d="M5 12h14M12 5l7 7-7 7" />
                    </svg>
                </a>
            </div>

        </div>
    </section>


    {{-- ══════════════════════════════════════
     TESTIMONIALS
══════════════════════════════════════ --}}
    <section id="uni-testimonials" class="section-py">
        <div class="testi-bg-quote">"</div>
        <div class="container">

            <div class="sec-head reveal">
                <div class="sec-tag"><span class="dot-pulse"></span> Student Stories</div>
                <h2 class="sec-title">What Our <span class="grad">Students</span> Say</h2>
                <div class="sec-divider"></div>
                <p class="sec-sub" style="color:rgba(255,255,255,.5);">Real stories from real students — the
                    transformations that happen at BluePeak go beyond academics.</p>
            </div>

            <div class="testi-slider-outer reveal">
                <div class="testi-track" id="testiTrack">

                    @php
                        $testimonials = [
                            [
                                'name' => 'Aryan Mehta',
                                'prog' => 'B.Tech CSE · 2024',
                                'init' => 'AM',
                                'rating' => 5,
                                'text' =>
                                    'BluePeak transformed my career completely. The AI labs, the professors, the startup incubator — everything pushed me to become the software engineer I am today. I received 3 placement offers before graduation!',
                            ],
                            [
                                'name' => 'Priya Sharma',
                                'prog' => 'MBA · 2023',
                                'init' => 'PS',
                                'rating' => 5,
                                'text' =>
                                    'The MBA program here is truly world-class. The case-study method, live projects with real companies, and the industry mentorship gave me skills that no textbook could teach. Placed at McKinsey.',
                            ],
                            [
                                'name' => 'Dr. Kavya Nair',
                                'prog' => 'MBBS · 2022',
                                'init' => 'KN',
                                'rating' => 5,
                                'text' =>
                                    'As an MBBS graduate, BluePeak gave me hands-on clinical experience from Year 1. The teaching hospital exposure and the compassionate faculty shaped me into the doctor I always aspired to be.',
                            ],
                            [
                                'name' => 'Rahul Verma',
                                'prog' => 'B.Des · 2024',
                                'init' => 'RV',
                                'rating' => 5,
                                'text' =>
                                    'The design faculty here is breathtaking. Studio culture, industry workshops, and international exchange programs helped me build a portfolio that landed me at Google Design. Best decision of my life!',
                            ],
                            [
                                'name' => 'Sneha Gupta',
                                'prog' => 'LLB · 2023',
                                'init' => 'SG',
                                'rating' => 5,
                                'text' =>
                                    'The law faculty at BluePeak are some of the finest legal minds in the country. Moot court competitions, legal aid clinics, and the Supreme Court internship program gave me unparalleled practical exposure.',
                            ],
                            [
                                'name' => 'Vikram Singh',
                                'prog' => 'M.Sc Data Science · 2024',
                                'init' => 'VS',
                                'rating' => 5,
                                'text' =>
                                    'The Data Science program is phenomenal. Real-world datasets, industry collaboration, and research opportunities made me highly competitive. I am now a Data Scientist at Amazon ML team.',
                            ],
                        ];
                    @endphp

                    @foreach ($testimonials as $t)
                        <div class="testi-card">
                            <div class="testi-stars">
                                @for ($i = 0; $i < $t['rating']; $i++)
                                    ★
                                @endfor
                            </div>
                            <div class="testi-text">{{ $t['text'] }}</div>
                            <div class="testi-footer">
                                <div class="testi-av">{{ $t['init'] }}</div>
                                <div>
                                    <div class="testi-name">{{ $t['name'] }}</div>
                                    <div class="testi-prog">{{ $t['prog'] }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

            <div class="testi-nav reveal">
                <button class="testi-nav-btn" id="testiPrev" aria-label="Previous">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5"
                        viewBox="0 0 24 24">
                        <path d="m15 18-6-6 6-6" />
                    </svg>
                </button>
                <div class="testi-dots" id="testiDots"></div>
                <button class="testi-nav-btn" id="testiNext" aria-label="Next">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5"
                        viewBox="0 0 24 24">
                        <path d="m9 18 6-6-6-6" />
                    </svg>
                </button>
            </div>

        </div>
    </section>
 {{-- ══════════════════════════════════════
     BLOG / NEWS
══════════════════════════════════════ --}}
    <section id="uni-blog" class="section-py">
        <div class="container">

            <div class="sec-head reveal">
                <div class="sec-tag"><span class="dot-pulse"></span> News &amp; Updates</div>
                <h2 class="sec-title">Latest <span class="grad">News</span> &amp; Events</h2>
                <div class="sec-divider"></div>
                <p class="sec-sub">Stay updated with the latest happenings, achievements, research breakthroughs, and
                    upcoming events at BluePeak University.</p>
            </div>

            <div class="blog-grid">

                @php
                    $blogs = [
                        [
                            'cat' => 'Achievement',
                            'img' => 'photo-1567168544813-cc03465b4fa8',
                            'date' => 'June 12, 2026',
                            'read' => '4 min read',
                            'title' => 'BluePeak Ranked #1 in National Institutional Rankings 2026',
                            'excerpt' =>
                                'For the fifth consecutive year, BluePeak University has secured the top position in the National Institutional Ranking Framework — a testament to our commitment to excellence.',
                        ],
                        [
                            'cat' => 'Research',
                            'img' => 'photo-1532094349884-543559be79b9',
                            'date' => 'June 8, 2026',
                            'read' => '6 min read',
                            'title' => 'Breakthrough Cancer Research Published in Nature by BluePeak Scientists',
                            'excerpt' =>
                                'Our Medical Sciences faculty has made a landmark discovery in targeted cancer therapy, with results published in the prestigious Nature Medicine journal.',
                        ],
                        [
                            'cat' => 'Events',
                            'img' => 'photo-1523580494863-6f3031224c94',
                            'date' => 'June 5, 2026',
                            'read' => '3 min read',
                            'title' => 'Annual TechFest 2026 Attracts 10,000 Students from Across India',
                            'excerpt' =>
                                'BluePeak\'s iconic TechFest brought together innovators, entrepreneurs, and tech enthusiasts for 4 days of hackathons, workshops, and keynote speeches.',
                        ],
                    ];
                @endphp

                @foreach ($blogs as $b)
                    <div class="blog-card reveal delay-{{ $loop->iteration }}">
                        <div class="blog-thumb">
                            <img src="https://images.unsplash.com/{{ $b['img'] }}?w=600&h=280&fit=crop&q=80"
                                alt="{{ $b['title'] }}" loading="lazy">
                            <span class="blog-cat-badge">{{ $b['cat'] }}</span>
                        </div>
                        <div class="blog-body">
                            <div class="blog-meta">
                                <span>
                                    <svg width="11" height="11" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <rect x="3" y="4" width="18" height="18" rx="2" />
                                        <line x1="16" y1="2" x2="16" y2="6" />
                                        <line x1="8" y1="2" x2="8" y2="6" />
                                        <line x1="3" y1="10" x2="21" y2="10" />
                                    </svg>
                                    {{ $b['date'] }}
                                </span>
                                <span>
                                    <svg width="11" height="11" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <circle cx="12" cy="12" r="10" />
                                        <polyline points="12 6 12 12 16 14" />
                                    </svg>
                                    {{ $b['read'] }}
                                </span>
                            </div>
                            <h3 class="blog-title">{{ $b['title'] }}</h3>
                            <p class="blog-excerpt">{{ $b['excerpt'] }}</p>
                            <a href="#" class="blog-read">
                                Read Full Article
                                <svg width="13" height="13" fill="none" stroke="currentColor"
                                    stroke-width="2.5" viewBox="0 0 24 24">
                                    <path d="M5 12h14M12 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach

            </div>

            <div style="text-align:center;margin-top:3rem;" class="reveal">
                <a href="#" class="btn btn-blue">
                    View All News &amp; Events
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5"
                        viewBox="0 0 24 24">
                        <path d="M5 12h14M12 5l7 7-7 7" />
                    </svg>
                </a>
            </div>

        </div>
    </section>


    {{-- ══════════════════════════════════════
     APPLY TODAY
══════════════════════════════════════ --}}
    <section id="uni-apply" class="section-py">
        <div class="apply-bg-img"></div>
        <div class="apply-ov"></div>

        <div class="container">
            <div class="apply-inner">

                {{-- Content --}}
                <div class="apply-content reveal-left">
                    <div class="sec-tag"
                        style="background:rgba(245,166,35,.12);border-color:rgba(245,166,35,.25);color:var(--c-accent);">
                        <span class="dot-pulse"></span> Admissions 2026
                    </div>
                    <h2 class="sec-title" style="color:white;text-align:left;margin-top:0.75rem;">
                        Apply Today &amp;<br>Shape Your <span style="color:var(--c-accent);">Future</span>
                    </h2>
                    <div class="sec-divider" style="margin:0.75rem 0;"></div>

                    <p class="apply-sub">
                        Take the first step towards your dream career. Applications for the 2026 academic year are now open
                        across all programs. Limited seats available — apply early to secure your place.
                    </p>

                    <div class="apply-feats">
                        <div class="apply-feat">
                            <div class="apply-feat-icon">
                                <svg width="13" height="13" fill="none" stroke="var(--c-primary-dark)"
                                    stroke-width="2.5" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5" />
                                </svg>
                            </div>
                            Fully Online Application Process — Takes just 10 minutes
                        </div>
                        <div class="apply-feat">
                            <div class="apply-feat-icon">
                                <svg width="13" height="13" fill="none" stroke="var(--c-primary-dark)"
                                    stroke-width="2.5" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5" />
                                </svg>
                            </div>
                            Merit-based Scholarships up to 100% Tuition Waiver
                        </div>
                        <div class="apply-feat">
                            <div class="apply-feat-icon">
                                <svg width="13" height="13" fill="none" stroke="var(--c-primary-dark)"
                                    stroke-width="2.5" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5" />
                                </svg>
                            </div>
                            Results within 7 Working Days — Fast-track Admissions
                        </div>
                        <div class="apply-feat">
                            <div class="apply-feat-icon">
                                <svg width="13" height="13" fill="none" stroke="var(--c-primary-dark)"
                                    stroke-width="2.5" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5" />
                                </svg>
                            </div>
                            Dedicated Counsellor Assigned to Every Applicant
                        </div>
                    </div>

                    <div style="display:flex;gap:0.6rem;flex-wrap:wrap;">
                        <div
                            style="background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.12);border-radius:12px;padding:1rem 1.25rem;flex:1;min-width:130px;">
                            <div
                                style="font-family:'Poppins',sans-serif;font-weight:800;font-size:1.5rem;color:var(--c-accent);">
                                Jan 31</div>
                            <div
                                style="font-size:0.7rem;color:rgba(255,255,255,.45);margin-top:0.2rem;text-transform:uppercase;letter-spacing:0.06em;">
                                Last Date 2026</div>
                        </div>
                        <div
                            style="background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.12);border-radius:12px;padding:1rem 1.25rem;flex:1;min-width:130px;">
                            <div
                                style="font-family:'Poppins',sans-serif;font-weight:800;font-size:1.5rem;color:var(--c-accent);">
                                ₹0</div>
                            <div
                                style="font-size:0.7rem;color:rgba(255,255,255,.45);margin-top:0.2rem;text-transform:uppercase;letter-spacing:0.06em;">
                                Application Fee</div>
                        </div>
                        <div
                            style="background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.12);border-radius:12px;padding:1rem 1.25rem;flex:1;min-width:130px;">
                            <div
                                style="font-family:'Poppins',sans-serif;font-weight:800;font-size:1.5rem;color:var(--c-accent);">
                                120+</div>
                            <div
                                style="font-size:0.7rem;color:rgba(255,255,255,.45);margin-top:0.2rem;text-transform:uppercase;letter-spacing:0.06em;">
                                Programs Open</div>
                        </div>
                    </div>
                </div>

                {{-- Form --}}
                <div class="apply-form-card reveal-right">
                    <div class="afc-title">Start Your Application</div>
                    <div class="afc-sub">Fill in your details and our counsellor will reach you within 24 hours.</div>

                    <div class="afc-row">
                        <div class="afc-group">
                            <label>First Name *</label>
                            <input type="text" placeholder="e.g. Aryan">
                        </div>
                        <div class="afc-group">
                            <label>Last Name *</label>
                            <input type="text" placeholder="e.g. Mehta">
                        </div>
                    </div>

                    <div class="afc-group">
                        <label>Email Address *</label>
                        <input type="email" placeholder="your@email.com">
                    </div>

                    <div class="afc-row">
                        <div class="afc-group">
                            <label>Phone Number *</label>
                            <input type="tel" placeholder="+91 00000 00000">
                        </div>
                        <div class="afc-group">
                            <label>City / State *</label>
                            <input type="text" placeholder="e.g. Mumbai, MH">
                        </div>
                    </div>

                    <div class="afc-group">
                        <label>Program of Interest *</label>
                        <select>
                            <option value="">Select a Program</option>
                            <option>B.Tech Computer Science &amp; AI</option>
                            <option>B.Tech Mechanical Engineering</option>
                            <option>MBBS — Bachelor of Medicine</option>
                            <option>MBA — Business Administration</option>
                            <option>BBA — Business Administration</option>
                            <option>B.Des — Visual Communication</option>
                            <option>M.Sc Data Science</option>
                            <option>LLB — Bachelor of Laws</option>
                            <option>B.Pharm — Pharmacy</option>
                        </select>
                    </div>

                    <div class="afc-group">
                        <label>How did you hear about us?</label>
                        <select>
                            <option value="">Select an option</option>
                            <option>Google Search</option>
                            <option>Social Media</option>
                            <option>Friend / Family</option>
                            <option>Education Fair</option>
                            <option>Newspaper / Magazine</option>
                        </select>
                    </div>

                    <button class="afc-submit" type="button" onclick="submitApplication(this)">
                        Submit Application — Free & Fast ↗
                    </button>

                    <div class="afc-note">
                        🔒 Your data is safe. We never share your information with third parties.
                    </div>
                </div>

            </div>
        </div>
    </section>


   

    {{-- ══════════════════════════════════════
     DISCOVER CAMPUS LIFE
══════════════════════════════════════ --}}
    <section id="uni-campus" class="section-py">
        <div class="container">

            <div class="sec-head reveal">
                <div class="sec-tag"><span class="dot-pulse"></span> Life at BluePeak</div>
                <h2 class="sec-title">Discover <span class="grad">Campus Life</span></h2>
                <div class="sec-divider"></div>
                <p class="sec-sub">Life at BluePeak is more than academics. Discover our vibrant culture, clubs, sports,
                    fests, and the community that makes us a home away from home.</p>
            </div>

            <div class="campus-grid reveal">

                <div class="campus-item">
                    <img src="https://images.unsplash.com/photo-1562774053-701939374585?w=800&q=80" alt="Campus"
                        loading="lazy">
                    <div class="campus-ov">
                        <div>
                            <div class="campus-lbl">Main Campus</div>
                            <div class="campus-lbl-sub">500-acre green campus in the heart of the city</div>
                        </div>
                    </div>
                </div>

                <div class="campus-item">
                    <img src="https://images.unsplash.com/photo-1519452575417-564c1401ecc0?w=400&q=80" alt="Sports"
                        loading="lazy">
                    <div class="campus-ov">
                        <div>
                            <div class="campus-lbl">Sports Complex</div>
                            <div class="campus-lbl-sub">Olympic standard facilities</div>
                        </div>
                    </div>
                </div>

                <div class="campus-item">
                    <img src="https://images.unsplash.com/photo-1580582932707-520aed937b7b?w=400&q=80" alt="Hostel"
                        loading="lazy">
                    <div class="campus-ov">
                        <div>
                            <div class="campus-lbl">Student Residences</div>
                            <div class="campus-lbl-sub">Smart AC hostels for 5000+ students</div>
                        </div>
                    </div>
                </div>

                <div class="campus-item">
                    <img src="https://images.unsplash.com/photo-1549834125-82d3c9b9b6e2?w=400&q=80" alt="Cafe"
                        loading="lazy">
                    <div class="campus-ov">
                        <div>
                            <div class="campus-lbl">Food Courts</div>
                            <div class="campus-lbl-sub">Multi-cuisine dining, open 24/7</div>
                        </div>
                    </div>
                </div>

                <div class="campus-item">
                    <img src="https://images.unsplash.com/photo-1548690312-e3b507d8c110?w=800&q=80" alt="Cultural"
                        loading="lazy">
                    <div class="campus-ov">
                        <div>
                            <div class="campus-lbl">Cultural &amp; Arts Centre</div>
                            <div class="campus-lbl-sub">100+ clubs, fests, and cultural activities</div>
                        </div>
                    </div>
                </div>

                <div class="campus-item">
                    <img src="https://images.unsplash.com/photo-1531545514256-b1400bc00f31?w=400&q=80" alt="Clubs"
                        loading="lazy">
                    <div class="campus-ov">
                        <div>
                            <div class="campus-lbl">Student Clubs</div>
                            <div class="campus-lbl-sub">100+ active clubs & societies</div>
                        </div>
                    </div>
                </div>

                <div class="campus-item">
                    <img src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?w=400&q=80" alt="Startup"
                        loading="lazy">
                    <div class="campus-ov">
                        <div>
                            <div class="campus-lbl">Innovation Hub</div>
                            <div class="campus-lbl-sub">Startup incubator & co-working spaces</div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>


    @include('articals.blue.BlueArtical.footer')


    {{-- Back to top --}}
    <button id="uni-back-top" onclick="window.scrollTo({top:0,behavior:'smooth'})" aria-label="Back to top">
        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5"
            viewBox="0 0 24 24">
            <path d="m18 15-6-6-6 6" />
        </svg>
    </button>

@endsection


@push('scripts')
    {{-- jQuery + Slick --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

    <script>
        (function() {
            'use strict';

            /* ─── SCROLL REVEAL ─── */
            function runReveal() {
                document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-scale').forEach(el => {
                    if (el.getBoundingClientRect().top < window.innerHeight - 80) {
                        el.classList.add('visible');
                    }
                });
            }
            window.addEventListener('scroll', runReveal, {
                passive: true
            });
            runReveal();

            /* ─── BACK TO TOP ─── */
            window.addEventListener('scroll', () => {
                document.getElementById('uni-back-top').classList.toggle('visible', window.scrollY > 400);
            });

            /* ─── HERO SLIDER ─── */
            (function heroSlider() {
                const slides = document.querySelectorAll('.hero-slide');
                const dots = document.querySelectorAll('.hero-dot');
                const counter = document.getElementById('heroCurrentSlide');
                let current = 0;
                let timer;

                function goTo(n) {
                    slides[current].classList.remove('active');
                    dots[current].classList.remove('active');
                    current = (n + slides.length) % slides.length;
                    slides[current].classList.add('active');
                    dots[current].classList.add('active');
                    if (counter) counter.textContent = String(current + 1).padStart(2, '0');
                }

                function next() {
                    goTo(current + 1);
                }

                function prev() {
                    goTo(current - 1);
                }

                function startAuto() {
                    clearInterval(timer);
                    timer = setInterval(next, 6000);
                }

                document.getElementById('heroNext').addEventListener('click', () => {
                    next();
                    startAuto();
                });
                document.getElementById('heroPrev').addEventListener('click', () => {
                    prev();
                    startAuto();
                });

                dots.forEach(d => {
                    d.addEventListener('click', () => {
                        goTo(+d.dataset.slide);
                        startAuto();
                    });
                });

                startAuto();
            })();

            /* ─── FACULTIES SLICK SLIDER ─── */
            $(document).ready(function() {
                $('#facSlider').slick({
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    arrows: false,
                    dots: false,
                    infinite: true,
                    speed: 600,
                    cssEase: 'cubic-bezier(0.4, 0, 0.2, 1)',
                    responsive: [{
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 2
                            }
                        },
                        {
                            breakpoint: 640,
                            settings: {
                                slidesToShow: 1
                            }
                        }
                    ]
                });

                $('#facPrev').on('click', function() {
                    $('#facSlider').slick('slickPrev');
                });
                $('#facNext').on('click', function() {
                    $('#facSlider').slick('slickNext');
                });
            });

            /* ─── PROGRAMS FILTER ─── */
            document.querySelectorAll('.prog-filter-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    document.querySelectorAll('.prog-filter-btn').forEach(b => b.classList.remove(
                        'active'));
                    this.classList.add('active');
                    const f = this.dataset.filter;
                    document.querySelectorAll('.prog-card').forEach(card => {
                        const show = f === 'all' || card.dataset.cat === f;
                        card.style.display = show ? '' : 'none';
                        card.style.opacity = show ? '' : '0';
                    });
                });
            });

            /* ─── TESTIMONIALS SLIDER ─── */
            (function testiSlider() {
                const track = document.getElementById('testiTrack');
                const cards = track ? track.querySelectorAll('.testi-card') : [];
                const dotsWrap = document.getElementById('testiDots');
                let current = 0;
                let perView = window.innerWidth < 768 ? 1 : 3;
                let total;

                function calcTotal() {
                    perView = window.innerWidth < 768 ? 1 : window.innerWidth < 1024 ? 2 : 3;
                    total = Math.max(1, cards.length - perView + 1);
                }

                function buildDots() {
                    if (!dotsWrap) return;
                    dotsWrap.innerHTML = '';
                    for (let i = 0; i < total; i++) {
                        const d = document.createElement('button');
                        d.className = 'testi-dot' + (i === 0 ? ' active' : '');
                        d.addEventListener('click', () => goTo(i));
                        dotsWrap.appendChild(d);
                    }
                }

                function goTo(n) {
                    calcTotal();
                    current = Math.max(0, Math.min(n, total - 1));
                    const cardW = cards[0] ? cards[0].offsetWidth + 24 : 0;
                    track.style.transform = `translateX(-${current * cardW}px)`;
                    dotsWrap && dotsWrap.querySelectorAll('.testi-dot').forEach((d, i) => d.classList.toggle(
                        'active', i === current));
                }

                calcTotal();
                buildDots();

                const prevBtn = document.getElementById('testiPrev');
                const nextBtn = document.getElementById('testiNext');
                if (prevBtn) prevBtn.addEventListener('click', () => goTo(current - 1));
                if (nextBtn) nextBtn.addEventListener('click', () => goTo(current + 1));

                window.addEventListener('resize', () => {
                    calcTotal();
                    buildDots();
                    goTo(0);
                });

                let autoT = setInterval(() => goTo((current + 1) % total), 5000);
                track && track.addEventListener('mouseenter', () => clearInterval(autoT));
                track && track.addEventListener('mouseleave', () => {
                    autoT = setInterval(() => goTo((current + 1) % total), 5000);
                });
            })();

            /* ─── APPLICATION FORM ─── */
            function submitApplication(btn) {
                const form = btn.closest('.apply-form-card');
                const inputs = form.querySelectorAll('input[type="text"], input[type="email"], input[type="tel"]');
                let valid = true;
                inputs.forEach(inp => {
                    if (!inp.value.trim()) {
                        inp.style.borderColor = 'rgba(239,68,68,.6)';
                        valid = false;
                        setTimeout(() => inp.style.borderColor = '', 2500);
                    }
                });
                if (!valid) return;

                btn.disabled = true;
                btn.style.opacity = '.75';
                btn.textContent = '⏳ Submitting…';

                setTimeout(() => {
                    btn.textContent = '✅ Application Submitted!';
                    btn.style.background = 'linear-gradient(135deg, #16a34a, #22c55e)';
                    btn.style.opacity = '1';
                    setTimeout(() => {
                        btn.textContent = 'Submit Application — Free & Fast ↗';
                        btn.style.background = '';
                        btn.disabled = false;
                        form.querySelectorAll('input, select').forEach(el => el.value = '');
                    }, 4000);
                }, 2000);
            }

            /* ─── ACTIVE NAV LINK ON SCROLL ─── */
            const navSections = [{
                    id: 'uni-about',
                    link: '#about'
                },
                {
                    id: 'uni-faculties',
                    link: '#faculties'
                },
                {
                    id: 'uni-programs',
                    link: '#programs'
                },
                {
                    id: 'uni-gallery',
                    link: '#gallery'
                },
                {
                    id: 'uni-testimonials',
                    link: '#contact'
                },
                {
                    id: 'uni-blog',
                    link: '#blog'
                },
            ];

            window.addEventListener('scroll', () => {
                const scrollPos = window.scrollY + 120;
                navSections.forEach(s => {
                    const el = document.getElementById(s.id);
                    if (el && scrollPos >= el.offsetTop && scrollPos < el.offsetTop + el.offsetHeight) {
                        document.querySelectorAll('.uni-nav-link').forEach(l => l.classList.remove(
                            'active'));
                        const active = document.querySelector(`.uni-nav-link[href="${s.link}"]`);
                        if (active) active.classList.add('active');
                    }
                });
                if (window.scrollY < 100) {
                    document.querySelectorAll('.uni-nav-link').forEach(l => l.classList.remove('active'));
                    const homeLink = document.querySelector('.uni-nav-link[href="/"]');
                    if (homeLink) homeLink.classList.add('active');
                }
            }, {
                passive: true
            });

        })(); // end IIFE
    </script>
@endpush
