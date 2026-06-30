(function ($) {
    "use strict";

    /* ═══════════════════════════════════════════════
               UTILITIES
            ═══════════════════════════════════════════════ */

    /** Safe querySelector — returns null, never throws */
    function qs(sel, ctx) {
        try {
            return (ctx || document).querySelector(sel);
        } catch (e) {
            return null;
        }
    }

    /** Safe querySelectorAll — always returns an Array */
    function qsa(sel, ctx) {
        try {
            return Array.from((ctx || document).querySelectorAll(sel));
        } catch (e) {
            return [];
        }
    }

    /** RAF double-frame flush (forces browser style recalc) */
    function nextFrame(fn) {
        requestAnimationFrame(function () {
            requestAnimationFrame(fn);
        });
    }

    /* ═══════════════════════════════════════════════
               ❶  STICKY HEADER
            ═══════════════════════════════════════════════ */
    function initStickyHeaders() {
        var headers = qsa("#site-header, #header");
        if (!headers.length) return;

        window.addEventListener(
            "scroll",
            function () {
                var scrolled = window.scrollY > 50;
                headers.forEach(function (h) {
                    h.classList.toggle("scrolled", scrolled);
                });
            },
            {
                passive: true,
            },
        );
    }

    /* ═══════════════════════════════════════════════
               ❷  HERO IMAGE COLUMN VISIBILITY
            ═══════════════════════════════════════════════ */
    function initHeroImgCol() {
        var col = qs("#heroImgCol");
        if (!col) return;

        function setVisibility() {
            col.style.display = window.innerWidth >= 992 ? "block" : "none";
        }
        setVisibility();
        window.addEventListener("resize", setVisibility, {
            passive: true,
        });
    }

    /* ═══════════════════════════════════════════════
               ❸  MOBILE DRAWER
            ═══════════════════════════════════════════════ */
    function initMobileDrawer() {
        var hamburger = qs("#hamburger");
        var mobileMenu = qs("#mobileMenu");
        var drawerClose = qs("#drawerClose");
        if (!hamburger || !mobileMenu) return;

        function openDrawer() {
            mobileMenu.classList.add("open");
            document.body.classList.add("menu-open");
            hamburger.classList.add("active");
        }

        function closeDrawer() {
            mobileMenu.classList.remove("open");
            document.body.classList.remove("menu-open");
            hamburger.classList.remove("active");
        }

        hamburger.addEventListener("click", openDrawer);
        if (drawerClose) drawerClose.addEventListener("click", closeDrawer);

        mobileMenu.addEventListener("click", function (e) {
            if (e.target === mobileMenu) closeDrawer();
        });

        qsa("[data-close]").forEach(function (el) {
            el.addEventListener("click", closeDrawer);
        });

        document.addEventListener("keydown", function (e) {
            if (e.key === "Escape") closeDrawer();
        });
    }

    /* ═══════════════════════════════════════════════
               ❹  FULLSCREEN EXPLORE MENU (#fs-menu)
            ═══════════════════════════════════════════════ */
    function initFsMenu() {
        var fsMenu = qs("#fs-menu");
        var openBtn = qs("#openFsMenu");
        var closeBtn = qs("#closeFsMenu");
        if (!fsMenu) return;

        function openFsMenu() {
            fsMenu.classList.add("active");
            document.body.classList.add("menu-open");
        }

        function closeFsMenu() {
            fsMenu.classList.remove("active");
            document.body.classList.remove("menu-open");
        }

        if (openBtn) openBtn.addEventListener("click", openFsMenu);
        if (closeBtn) closeBtn.addEventListener("click", closeFsMenu);

        qsa(".fs-quick, .fs-link", fsMenu).forEach(function (el) {
            el.addEventListener("click", closeFsMenu);
        });

        document.addEventListener("keydown", function (e) {
            if (e.key === "Escape") closeFsMenu();
        });
    }

    /* ═══════════════════════════════════════════════
               ❺  OVERLAY (#overlay)
            ═══════════════════════════════════════════════ */
    function initOverlay() {
        var overlay = qs("#overlay");
        if (!overlay) return;

        window.toggleOverlay = function () {
            var isOpen = overlay.classList.toggle("open");
            document.body.classList.toggle("menu-open", isOpen);
        };

        var closeBtn = qs(".overlay-close", overlay);
        if (closeBtn) closeBtn.addEventListener("click", window.toggleOverlay);

        document.addEventListener("keydown", function (e) {
            if (e.key === "Escape" && overlay.classList.contains("open")) {
                window.toggleOverlay();
            }
        });
    }

    /* ═══════════════════════════════════════════════
               ❻  TESTIMONIALS SWIPER (.testiSwiper)
            ═══════════════════════════════════════════════ */
    function initTestiSwiper() {
        if (!qs(".testiSwiper") || typeof Swiper === "undefined") return;

        new Swiper(".testiSwiper", {
            slidesPerView: 1,
            spaceBetween: 20,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                },
                992: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            },
        });
    }

    /* ═══════════════════════════════════════════════
               ❽  COUNTER ANIMATION (.stat-num)
            ═══════════════════════════════════════════════ */
    function initCounters() {
        var numEls = document.querySelectorAll(".stat-num");
        if (!numEls.length || typeof IntersectionObserver === "undefined")
            return;

        var io = new IntersectionObserver(
            function (entries) {
                entries.forEach(function (entry) {
                    if (!entry.isIntersecting || entry.target.dataset.done)
                        return;
                    entry.target.dataset.done = "1";

                    // ✅ Get value from data-target
                    var n = parseFloat(
                        entry.target.getAttribute("data-target"),
                    );
                    if (isNaN(n)) return;

                    var suffix = entry.target.getAttribute("data-suffix") || "";
                    var v = 0;
                    var step = n / (1400 / 16);

                    var t = setInterval(function () {
                        v += step;
                        if (v >= n) {
                            v = n;
                            clearInterval(t);
                        }
                        entry.target.textContent =
                            (Number.isInteger(n)
                                ? Math.floor(v)
                                : v.toFixed(1)) + suffix;
                    }, 16);
                });
            },
            {
                threshold: 0.6,
            },
        );

        numEls.forEach(function (el) {
            io.observe(el);
        });
    }

    /* ═══════════════════════════════════════════════
               ❾  HERO SWIPER (#heroSwiper)
            ═══════════════════════════════════════════════ */
    var SLIDE_DURATION = 5000;
    var WORD_BASE_DELAY = 1000;
    var WORD_STEP = 500;
    var HIGHLIGHT_INDEX = 1;
    var wordTimers = [];

    function buildWordSpans(headingEl) {
        var text =
            headingEl.getAttribute("aria-label") || headingEl.textContent || "";
        var words = text.trim().split(/\s+/);
        headingEl.innerHTML = "";

        words.forEach(function (word, i) {
            var wrap = document.createElement("span");
            wrap.className = "word-wrap";

            var span = document.createElement("span");
            span.className = "word";
            span.textContent = word;
            span.dataset.index = i;
            if (i === HIGHLIGHT_INDEX) span.classList.add("word-highlight");

            wrap.appendChild(span);
            headingEl.appendChild(wrap);
            if (i < words.length - 1)
                headingEl.appendChild(document.createTextNode(" "));
        });

        return headingEl.querySelectorAll(".word");
    }

    function animateWordsIn(headingEl, onComplete) {
        wordTimers.forEach(clearTimeout);
        wordTimers = [];

        var wordSpans = buildWordSpans(headingEl);
        wordSpans.forEach(function (span, i) {
            var delay = WORD_BASE_DELAY + i * WORD_STEP;
            var t = setTimeout(function () {
                span.classList.add("in");
                if (
                    i === wordSpans.length - 1 &&
                    typeof onComplete === "function"
                )
                    onComplete();
            }, delay);
            wordTimers.push(t);
        });
    }

    function resetWords(headingEl) {
        headingEl.querySelectorAll(".word").forEach(function (s) {
            s.classList.remove("in");
            void s.offsetWidth; // force reflow
        });
    }

    function activateSlide(slideEl) {
        if (!slideEl) return;

        var heading = slideEl.querySelector(".slide-heading");
        var eyebrow = slideEl.querySelector(".slide-eyebrow");
        var sub = slideEl.querySelector(".slide-sub");
        var ctas = slideEl.querySelector(".slide-ctas");
        var stats = slideEl.querySelector(".slide-stats");

        [eyebrow, sub, ctas, stats].forEach(function (el) {
            if (el) el.classList.remove("visible");
        });

        nextFrame(function () {
            if (eyebrow) eyebrow.classList.add("visible");
        });

        if (heading) {
            resetWords(heading);
            animateWordsIn(heading);
        }

        setTimeout(function () {
            if (sub) sub.classList.add("visible");
            if (ctas) ctas.classList.add("visible");
            if (stats) stats.classList.add("visible");
        }, WORD_BASE_DELAY + 400);
    }

    function initProgressBar(progressBar) {
        function start() {
            progressBar.style.transition = "none";
            progressBar.style.width = "0%";
            nextFrame(function () {
                progressBar.style.transition =
                    "width " + SLIDE_DURATION + "ms linear";
                progressBar.style.width = "100%";
            });
        }

        function stop() {
            progressBar.style.transition = "none";
            progressBar.style.width = "0%";
        }
        return {
            start: start,
            stop: stop,
        };
    }

    function buildHeroDots(container, count) {
        container.innerHTML = "";
        for (var i = 0; i < count; i++) {
            var d = document.createElement("button");
            d.className = "dot" + (i === 0 ? " active" : "");
            d.setAttribute("aria-label", "Go to slide " + (i + 1));
            d.dataset.index = i;
            container.appendChild(d);
        }
    }

    function updateHeroDots(container, idx) {
        qsa(".dot", container).forEach(function (d, i) {
            d.classList.toggle("active", i === idx);
        });
    }

    function initHeroSwiper() {
        var swiperEl = qs("#heroSwiper");
        var progressBar = qs("#progressBar");
        var dotsContainer = qs("#heroDots");
        var counterEl = qs("#counterCurrent");
        var btnPrev = qs("#btnPrev");
        var btnNext = qs("#btnNext");

        if (!swiperEl || typeof Swiper === "undefined") return;

        var progress = progressBar
            ? initProgressBar(progressBar)
            : {
                  start: function () {},
                  stop: function () {},
              };

        function updateCounter(idx) {
            if (counterEl)
                counterEl.textContent = String(idx + 1).padStart(2, "0");
        }

        var swiper = new Swiper("#heroSwiper", {
            loop: true,
            speed: 900,
            effect: "fade",
            fadeEffect: {
                crossFade: true,
            },
            autoplay: {
                delay: SLIDE_DURATION,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            },
            navigation: false,
            pagination: false,
            on: {
                init: function (sw) {
                    var slideCount = sw.slides
                        ? sw.slides.length - 2 * (sw.loopedSlides || 0)
                        : 0;
                    if (slideCount <= 0)
                        slideCount = sw.slides ? sw.slides.length : 0;

                    if (dotsContainer) buildHeroDots(dotsContainer, slideCount);

                    var realIdx = sw.realIndex || 0;
                    if (dotsContainer) updateHeroDots(dotsContainer, realIdx);
                    updateCounter(realIdx);
                    progress.start();
                    activateSlide(sw.slides ? sw.slides[sw.activeIndex] : null);
                },
                slideChangeTransitionStart: function () {
                    progress.stop();
                },
                slideChangeTransitionEnd: function (sw) {
                    var realIdx = sw.realIndex || 0;
                    if (dotsContainer) updateHeroDots(dotsContainer, realIdx);
                    updateCounter(realIdx);
                    progress.start();
                    activateSlide(sw.slides ? sw.slides[sw.activeIndex] : null);
                },
            },
        });

        if (btnPrev)
            btnPrev.addEventListener("click", function () {
                swiper.slidePrev();
            });
        if (btnNext)
            btnNext.addEventListener("click", function () {
                swiper.slideNext();
            });

        if (dotsContainer) {
            dotsContainer.addEventListener("click", function (e) {
                var btn = e.target.closest(".dot");
                if (btn) swiper.slideToLoop(parseInt(btn.dataset.index, 10));
            });
        }

        document.addEventListener("keydown", function (e) {
            if (e.key === "ArrowLeft") swiper.slidePrev();
            if (e.key === "ArrowRight") swiper.slideNext();
        });

        if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
            swiper.autoplay.stop();
            progress.stop();
            var firstActive = qs(".swiper-slide-active");
            if (firstActive) {
                var h = firstActive.querySelector(".slide-heading");
                if (h)
                    buildWordSpans(h).forEach(function (s) {
                        s.classList.add("in");
                    });
            }
        }
    }

    /* ═══════════════════════════════════════════════
               ❿  PARTICLES CANVAS
            ═══════════════════════════════════════════════ */
    function initParticles() {
        var canvas = qs("#particles-canvas");
        if (!canvas) return;

        var ctx = canvas.getContext("2d");
        var particles = [];
        var colors = [
            "rgba(255,107,26,.55)",
            "rgba(232,25,44,.5)",
            "rgba(123,47,190,.55)",
            "rgba(26,10,46,.25)",
        ];
        var rafParticles = null;

        function resize() {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        }
        resize();
        window.addEventListener("resize", resize, {
            passive: true,
        });

        for (var i = 0; i < 90; i++) {
            particles.push({
                x: Math.random() * canvas.width,
                y: Math.random() * canvas.height,
                r: Math.random() * 2 + 0.5,
                vx: (Math.random() - 0.5) * 0.4,
                vy: (Math.random() - 0.5) * 0.4,
                color: colors[Math.floor(Math.random() * colors.length)],
                alpha: Math.random() * 0.5 + 0.2,
            });
        }

        /* Pause when tab is hidden — saves CPU */
        document.addEventListener("visibilitychange", function () {
            if (document.hidden) {
                cancelAnimationFrame(rafParticles);
            } else {
                drawParticles();
            }
        });

        function drawParticles() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.globalAlpha = 1;

            particles.forEach(function (p) {
                ctx.beginPath();
                ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
                ctx.fillStyle = p.color;
                ctx.globalAlpha = p.alpha;
                ctx.fill();

                p.x += p.vx;
                p.y += p.vy;
                if (p.x < 0) p.x = canvas.width;
                if (p.x > canvas.width) p.x = 0;
                if (p.y < 0) p.y = canvas.height;
                if (p.y > canvas.height) p.y = 0;
            });

            /* Connection lines — every 3rd particle only */
            ctx.globalAlpha = 1;
            particles.forEach(function (p, i) {
                if (i % 3 !== 0) return;
                var p2 = particles[(i + 7) % particles.length];
                var dist = Math.hypot(p.x - p2.x, p.y - p2.y);
                if (dist < 100) {
                    ctx.beginPath();
                    ctx.moveTo(p.x, p.y);
                    ctx.lineTo(p2.x, p2.y);
                    ctx.strokeStyle =
                        "rgba(255,107,26," + 0.07 * (1 - dist / 100) + ")";
                    ctx.lineWidth = 0.5;
                    ctx.stroke();
                }
            });

            ctx.globalAlpha = 1;
            rafParticles = requestAnimationFrame(drawParticles);
        }

        /* Skip on reduced-motion */
        if (!window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
            drawParticles();
        }
    }

    /* ═══════════════════════════════════════════════
               ⓫  SCROLL REVEAL (.reveal / .reveal-left / .reveal-right)
            ═══════════════════════════════════════════════ */
    function initScrollReveal() {
        var revealEls = qsa(".reveal, .reveal-left, .reveal-right");
        if (!revealEls.length || typeof IntersectionObserver === "undefined")
            return;

        var observer = new IntersectionObserver(
            function (entries) {
                entries.forEach(function (e) {
                    if (e.isIntersecting) e.target.classList.add("visible");
                });
            },
            {
                threshold: 0.12,
            },
        );

        revealEls.forEach(function (el) {
            observer.observe(el);
        });
    }

    /* ═══════════════════════════════════════════════
               ⓬  RIPPLE EFFECT (.cta-primary)
            ═══════════════════════════════════════════════ */
    function initRipple() {
        if (!qs("#ripple-style")) {
            var s = document.createElement("style");
            s.id = "ripple-style";
            s.textContent =
                "@keyframes rippleAnim{to{transform:scale(3);opacity:0}}";
            document.head.appendChild(s);
        }

        qsa(".cta-primary").forEach(function (btn) {
            btn.addEventListener("click", function (e) {
                var rc = btn.querySelector(".ripple-container");
                if (!rc) return;

                var r = document.createElement("span");
                r.style.cssText = [
                    "position:absolute",
                    "border-radius:50%",
                    "background:rgba(255,255,255,.3)",
                    "transform:scale(0)",
                    "animation:rippleAnim .6s linear",
                    "width:120px",
                    "height:120px",
                    "left:" + (e.offsetX - 60) + "px",
                    "top:" + (e.offsetY - 60) + "px",
                    "pointer-events:none",
                ].join(";");
                rc.appendChild(r);
                setTimeout(function () {
                    if (r.parentNode) r.parentNode.removeChild(r);
                }, 620);
            });
        });
    }

    /* ═══════════════════════════════════════════════
               ⓭  SIMPLE TESTIMONIAL SLIDER (.slider-track)
            ═══════════════════════════════════════════════ */
    function initSimpleSlider() {
        var track = qs("#sliderTrack");
        var dotsWrap = qs("#sliderDots");
        if (!track || !dotsWrap) return;

        var cards = track.querySelectorAll(".testimonial-card");
        var total = cards.length;
        var current = 0;
        var timer = null;

        function getPerPage() {
            if (window.innerWidth < 768) return 1;
            if (window.innerWidth < 1024) return 2;
            return 3;
        }

        function buildDots(perPage) {
            dotsWrap.innerHTML = "";
            var pages = Math.ceil(total / perPage);
            for (var i = 0; i < pages; i++) {
                var d = document.createElement("button");
                d.className = "slider-dot" + (i === 0 ? " active" : "");
                d.dataset.idx = i;
                dotsWrap.appendChild(d);
            }
        }

        function goTo(idx) {
            var perPage = getPerPage();
            var pages = Math.ceil(total / perPage);
            current = ((idx % pages) + pages) % pages;

            var cardW = cards[0] ? cards[0].offsetWidth + 20 : 0;
            track.style.transform =
                "translateX(-" + current * perPage * cardW + "px)";

            qsa(".slider-dot", dotsWrap).forEach(function (d, i) {
                d.classList.toggle("active", i === current);
            });
        }

        function startTimer() {
            stopTimer();
            timer = setInterval(function () {
                var perPage = getPerPage();
                var pages = Math.ceil(total / perPage);
                goTo(current + 1 < pages ? current + 1 : 0);
            }, 4000);
        }

        function stopTimer() {
            clearInterval(timer);
        }

        buildDots(getPerPage());
        startTimer();

        dotsWrap.addEventListener("click", function (e) {
            var btn = e.target.closest(".slider-dot");
            if (!btn) return;
            stopTimer();
            goTo(parseInt(btn.dataset.idx, 10));
            startTimer();
        });

        track.addEventListener("mouseenter", stopTimer);
        track.addEventListener("mouseleave", startTimer);

        window.addEventListener(
            "resize",
            function () {
                var pp = getPerPage();
                buildDots(pp);
                goTo(0);
            },
            {
                passive: true,
            },
        );
    }

    /* ═══════════════════════════════════════════════
               ⓯  SLICK WRAPPER (.slick-wrapper)
                  Generic multi-item carousel
            ═══════════════════════════════════════════════ */
    function initSlickWrapper() {
        var $wrapper = $(".slick-wrapper");
        if (!$wrapper.length || typeof $.fn.slick === "undefined") return;

        $wrapper.slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            arrows: false,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                    },
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                    },
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                    },
                },
            ],
        });
    }

    function oppertunity_slider() {
        var $oppertunity_slider = $("#oppertunity_slider");
        if (!$oppertunity_slider.length || typeof $.fn.slick === "undefined")
            return;

        $oppertunity_slider.slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            arrows: true,
            autoplaySpeed: 2000,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 1,
                    },
                },
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                    },
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                    },
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                    },
                },
            ],
        });
    }

    /* ═══════════════════════════════════════════════
               ⓰  HERO BG SLICK SLIDER (.hero-bg)
            ═══════════════════════════════════════════════ */
    function initHeroBgSlider() {
        var $heroBg = $(".hero-bg");
        if (!$heroBg.length || !$heroBg.find(".hbg-slide").length) return;
        if (typeof $.fn.slick === "undefined") return;

        var isMobile = window.innerWidth <= 768;

        /* Inject background images from data attrs */
        $heroBg.find(".hbg-slide").each(function () {
            var bg = isMobile
                ? $(this).data("bg-mobile") || $(this).data("bg")
                : $(this).data("bg");
            if (bg) $(this).css("background-image", "url(" + bg + ")");
        });

        $heroBg.slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            fade: true,
            speed: 1000,
            autoplay: true,
            autoplaySpeed: 5000,
            pauseOnHover: true,
            dots: false,
            arrows: false,
            cssEase: "cubic-bezier(.77,0,.18,1)",
            lazyLoad: "ondemand",
            infinite: true,
            adaptiveHeight: false,
        });

        $heroBg.on("beforeChange", function (e, slick, curr) {
            $heroBg.find(".hbg-slide").eq(curr).css("transform", "scale(1)");
        });

        if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
            $heroBg.slick("slickPause");
        }
    }

    /* ═══════════════════════════════════════════════
               ⓱  HERO H1 WORD ANIMATION
            ═══════════════════════════════════════════════ */
    function initHeroH1() {
        var h1L1 = $(".h1-l1");
        var h1L3 = $(".h1-l3");
        var h1Words = $(".h1-l2 .h1-word");

        if (!h1L1.length && !h1Words.length) return;

        setTimeout(function () {
            h1L1.add(h1L3).addClass("in");
            h1Words.addClass("in");
        }, 200);
    }

    /* ═══════════════════════════════════════════════
               ⓲  PARALLAX HERO BG
                  NOTE: Only runs when .hero-bg is NOT a
                  Slick slider (would conflict with transforms)
            ═══════════════════════════════════════════════ */
    function initParallax() {
        var heroBg = qs(".hero-bg");
        /* Skip if .hero-bg has been converted to a slider */
        if (!heroBg || heroBg.classList.contains("slick-initialized")) return;

        window.addEventListener(
            "scroll",
            function () {
                heroBg.style.transform =
                    "translateY(" + window.scrollY * 0.2 + "px)";
            },
            {
                passive: true,
            },
        );
    }

    /* ═══════════════════════════════════════════════
                   ❼  AOS
                ═══════════════════════════════════════════════ */
    function initAOS() {
        if (typeof AOS === "undefined") return;
        AOS.init({
            duration: 800,
            easing: "ease-out-cubic",
            once: true,
            offset: 0,
        });
    }

    /* ═══════════════════════════════════════════════
               ⓳  BOOT — single DOMContentLoaded entry point
            ═══════════════════════════════════════════════ */
    function boot() {
        initStickyHeaders();
        oppertunity_slider();
        initHeroImgCol();
        initMobileDrawer();
        initFsMenu();
        initOverlay();
        initAOS();
        initCounters();
        initHeroSwiper(); /* Swiper-based hero (if present) */
        initHeroBgSlider(); /* Slick bg slider on .hero-bg   */
        initHeroH1(); /* H1 word reveal                */
        initParticles();
        initScrollReveal();
        initRipple();
        initTestiSwiper();
        initSimpleSlider();
        // initCampusSlider();
        initSlickWrapper();
        initParallax(); /* Runs AFTER slider init — safe */
    }

    /* Wait for jQuery ready (covers both deferred and inline script) */
    $(document).ready(boot);
})(window.jQuery);

function initCampusSlider() {
    var $campusSlider = $(".campus-slider");
    var $menu = $("#campusMenu");

    if (!$campusSlider.length || typeof $.fn.slick === "undefined") return;

    var autoplayMs = 5000;
    var circumference = 57; // 2π × 9 (SVG circle r=9)
    var startTime = null;
    var rafId = null;
    var isManual = false; // flag: user clicked menu (skip double reset)

    /* ── Init Slick ── */
    $campusSlider.slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        fade: true,
        speed: 500,
        cssEase: "cubic-bezier(.25,.8,.25,1)",
        autoplay: true,
        autoplaySpeed: autoplayMs,
        dots: false, // ← OFF — #campusMenu is the custom nav, avoid conflict
        arrows: false,
        pauseOnHover: true,
    });

    /* ── Progress ring helpers ── */
    function getRing(idx) {
        // Scoped to #campusMenu only — prevents touching other .fill elements
        return $menu.find(".cl-menu-btn").eq(idx).find(".fill");
    }

    function animateRing(timestamp) {
        if (!startTime) startTime = timestamp;
        var fraction = Math.min((timestamp - startTime) / autoplayMs, 1);
        var offset = circumference - fraction * circumference;
        var activeIdx = $menu.find(".cl-menu-btn.active").index();

        getRing(activeIdx).css("stroke-dashoffset", offset);

        if (fraction < 1) {
            rafId = requestAnimationFrame(animateRing);
        }
    }

    function resetRing() {
        cancelAnimationFrame(rafId);
        startTime = null;

        /* Reset ALL rings in menu only */
        $menu.find(".fill").css("stroke-dashoffset", circumference);

        rafId = requestAnimationFrame(animateRing);
    }

    /* ── Active menu item ── */
    function setMenuActive(idx) {
        $menu
            .find(".cl-menu-btn")
            .removeClass("active")
            .eq(idx)
            .addClass("active");
    }

    /* ── Menu → Slider ── */
    $menu.on("click", ".cl-menu-btn", function () {
        var idx = parseInt($(this).data("slide"), 10);
        if (isNaN(idx)) return;

        isManual = true;

        /* goTo slide, let autoplay continue naturally */
        $campusSlider.slick("slickGoTo", idx);

        /* Restart autoplay timer from this slide */
        $campusSlider.slick("slickPause");
        setTimeout(function () {
            $campusSlider.slick("slickPlay");
            isManual = false;
        }, 50); // ← 50ms (not 0ms) — lets slick settle before resuming

        setMenuActive(idx);
        resetRing();
    });

    /* ── Slider → Menu (autoplay or manual swipe) ── */
    $campusSlider.on("beforeChange", function (e, slick, curr, next) {
        setMenuActive(next);

        /* Only reset ring if NOT triggered by a manual menu click
                   (menu click already called resetRing — prevents double reset) */
        if (!isManual) {
            resetRing();
        }
    });

    /* ── Pause ring when slider pauses (hover) ── */
    $campusSlider.on("afterChange", function () {
        /* Re-sync ring on each completed transition */
        if (!isManual) resetRing();
    });

    /* ── Kick off ── */
    resetRing();
}
initCampusSlider();

(function () {
    "use strict";

    var TOTAL = 5;
    var slider = $("#heroSlider");

    // ── Init Slick ──
    slider.slick({
        autoplay: true,
        autoplaySpeed: 5500,
        speed: 1000,
        fade: true,
        cssEase: "ease-in-out",
        arrows: false,
        dots: false,
        pauseOnHover: false,
        infinite: true,
    });

    // ── Build progress dots ──
    var progressEl = document.getElementById("slideProgress");
    for (var i = 0; i < TOTAL; i++) {
        var btn = document.createElement("button");
        btn.className = "sp-dot" + (i === 0 ? " active" : "");
        btn.setAttribute("aria-label", "Go to slide " + (i + 1));
        (function (idx) {
            btn.addEventListener("click", function () {
                slider.slick("slickGoTo", idx);
            });
        })(i);
        progressEl.appendChild(btn);
    }

    // ── Slide change handler ──
    slider.on("afterChange", function (e, slick, current) {
        // Update counter
        document.getElementById("snCurrent").textContent = String(
            current + 1,
        ).padStart(2, "0");

        // Update dots
        var dots = document.querySelectorAll(".sp-dot");
        dots.forEach(function (d, i) {
            d.classList.toggle("active", i === current);
        });

        // Restart Ken Burns on current slide
        var imgs = document.querySelectorAll(".hs-item img");
        imgs.forEach(function (img) {
            img.style.animation = "none";
            void img.offsetWidth; // force reflow
            img.style.animation = "";
        });
    });

    // ── Ripple on Apply button ──
    var applyBtn = document.getElementById("applyBtn");
    if (applyBtn) {
        applyBtn.addEventListener("click", function (e) {
            var span = document.createElement("span");
            span.className = "ripple";
            var rect = this.getBoundingClientRect();
            span.style.left = e.clientX - rect.left + "px";
            span.style.top = e.clientY - rect.top + "px";
            this.appendChild(span);
            setTimeout(function () {
                span.remove();
            }, 600);
        });
    }
})();
