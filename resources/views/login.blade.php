<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — WebAdmin</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        poppins: ['Poppins', 'sans-serif']
                    }
                }
            }
        }
    </script>
    <style>
        * {
            font-family: 'Poppins', sans-serif;
            box-sizing: border-box;
        }

        .slide-item {
            position: absolute;
            inset: 0;
            opacity: 0;
            transition: opacity 1.4s ease-in-out;
        }

        .slide-item.active {
            opacity: 1;
        }

        .slide-dot {
            transition: width .35s, background .35s;
        }

        .form-input {
            width: 100%;
            border: 1.5px solid #e5e7eb;
            border-radius: 0.875rem;
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
            color: #111827;
            background: #fff;
            transition: border-color .2s, box-shadow .2s;
            outline: none;
            font-family: 'Poppins', sans-serif;
        }

        .form-input::placeholder {
            color: #9ca3af;
        }

        .form-input:focus {
            border-color: #7c3aed;
            box-shadow: 0 0 0 3px rgba(124, 58, 237, .1);
        }

        .form-input.is-error {
            border-color: #f87171;
            box-shadow: 0 0 0 3px rgba(248, 113, 113, .1);
        }

        .btn-grad {
            background: linear-gradient(135deg, #7c3aed 0%, #FF2D9B 100%);
            transition: box-shadow .2s, transform .15s;
        }

        .btn-grad:hover {
            box-shadow: 0 10px 28px rgba(124, 58, 237, .35);
            transform: translateY(-1px);
        }

        .btn-grad:active {
            transform: translateY(0);
        }

        .btn-grad:disabled {
            opacity: .6;
            pointer-events: none;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(18px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-up {
            animation: fadeUp .45s ease forwards;
        }

        .captcha-box {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
            padding: .65rem 1.25rem;
            background: linear-gradient(135deg, #f5f3ff, #fdf4ff);
            border: 1.5px solid #e9d5ff;
            border-radius: .875rem;
            font-size: 1.15rem;
            font-weight: 700;
            letter-spacing: .12em;
            color: #6d28d9;
            user-select: none;
            flex-shrink: 0;
        }
    </style>
</head>

<body class="bg-white h-screen overflow-hidden">

    <div class="flex h-screen w-full overflow-hidden">

        {{-- ══════════ LEFT: IMAGE SLIDER ══════════ --}}
        <div class="hidden lg:block relative overflow-hidden bg-indigo-950 flex-shrink-0" style="width:42%">

            <div class="slide-item active">
                <img src="https://images.unsplash.com/photo-1467232004584-a241de8bcf5d?w=900&h=1200&fit=crop&q=85"
                    alt="" class="w-full h-full object-cover">
                <div class="absolute inset-0"
                    style="background:linear-gradient(180deg,rgb(6 0 14/85%) 0%,rgb(0 0 0/48%) 45%,rgb(0 0 0/30%) 100%)">
                </div>
            </div>
            <div class="slide-item">
                <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?w=900&h=1200&fit=crop&q=85"
                    alt="" class="w-full h-full object-cover">
                <div class="absolute inset-0"
                    style="background:linear-gradient(180deg,rgb(6 0 14/85%) 0%,rgb(0 0 0/48%) 45%,rgb(0 0 0/30%) 100%)">
                </div>
            </div>
            <div class="slide-item">
                <img src="https://images.unsplash.com/photo-1581291518633-83b4ebd1d83e?w=900&h=1200&fit=crop&q=85"
                    alt="" class="w-full h-full object-cover">
                <div class="absolute inset-0"
                    style="background:linear-gradient(180deg,rgb(6 0 14/85%) 0%,rgb(0 0 0/48%) 45%,rgb(0 0 0/30%) 100%)">
                </div>
            </div>
            <div class="slide-item">
                <img src="https://images.unsplash.com/photo-1551434678-e076c223a692?w=900&h=1200&fit=crop&q=85"
                    alt="" class="w-full h-full object-cover">
                <div class="absolute inset-0"
                    style="background:linear-gradient(180deg,rgb(6 0 14/85%) 0%,rgb(0 0 0/48%) 45%,rgb(0 0 0/30%) 100%)">
                </div>
            </div>
            <div class="slide-item">
                <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=900&h=1200&fit=crop&q=85"
                    alt="" class="w-full h-full object-cover">
                <div class="absolute inset-0"
                    style="background:linear-gradient(180deg,rgb(6 0 14/85%) 0%,rgb(0 0 0/48%) 45%,rgb(0 0 0/30%) 100%)">
                </div>
            </div>

            <div
                class="absolute inset-0 z-10 flex flex-col justify-between p-10 xl:p-14 drop-shadow-[2px_4px_6px_rgba(0,0,0,0.5)]">

                {{-- Logo --}}
                <div class="flex items-center gap-3">
                    <div class="w-11 h-11 rounded-2xl flex items-center justify-center shadow-2xl"
                        style="background:linear-gradient(135deg,#a78bfa,#FF2D9B)">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-white font-bold text-lg leading-tight tracking-wide">WebAdmin</div>
                        <div class="text-purple-300 text-xs font-medium tracking-wider">PREMIUM WEB SERVICES</div>
                    </div>
                </div>

                {{-- Quote --}}
                <div class="flex-1 flex flex-col justify-center">
                    <div id="slide-quote" class="max-w-xs"></div>
                </div>

                {{-- Bottom --}}
                <div>
                    <div class="flex flex-wrap gap-2 mb-7">
                        <span class="px-3 py-1.5 rounded-full text-white text-xs font-medium border border-white/20"
                            style="background:rgba(255,255,255,.1);backdrop-filter:blur(8px)">✦ 48hr Delivery</span>
                        <span class="px-3 py-1.5 rounded-full text-white text-xs font-medium border border-white/20"
                            style="background:rgba(255,255,255,.1);backdrop-filter:blur(8px)">✦ SEO Optimised</span>
                        <span class="px-3 py-1.5 rounded-full text-white text-xs font-medium border border-white/20"
                            style="background:rgba(255,255,255,.1);backdrop-filter:blur(8px)">✦ Mobile First</span>
                        <span class="px-3 py-1.5 rounded-full text-white text-xs font-medium border border-white/20"
                            style="background:rgba(255,255,255,.1);backdrop-filter:blur(8px)">✦ 24/7 Support</span>
                    </div>
                    <div class="flex items-center gap-2 mb-7" id="slide-dots">
                        <button class="slide-dot h-2 rounded-full bg-white" style="width:24px"
                            onclick="goToSlide(0)"></button>
                        <button class="slide-dot h-2 rounded-full" style="width:8px;background:rgba(255,255,255,.35)"
                            onclick="goToSlide(1)"></button>
                        <button class="slide-dot h-2 rounded-full" style="width:8px;background:rgba(255,255,255,.35)"
                            onclick="goToSlide(2)"></button>
                        <button class="slide-dot h-2 rounded-full" style="width:8px;background:rgba(255,255,255,.35)"
                            onclick="goToSlide(3)"></button>
                        <button class="slide-dot h-2 rounded-full" style="width:8px;background:rgba(255,255,255,.35)"
                            onclick="goToSlide(4)"></button>
                    </div>
                    <div class="pt-5 border-t border-white/10">
                        <p class="text-white/40 text-xs">Powered by <span class="text-white/75 font-semibold">Reliable
                                Services</span></p>
                        <p class="text-white/30 text-xs mt-0.5">Trusted by 500+ businesses across India</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- ══════════ RIGHT: LOGIN FORM ══════════ --}}
        <div class="flex flex-col flex-1 overflow-hidden">

            {{-- Top bar --}}
            <div
                class="flex items-center justify-between px-6 xl:px-10 py-4 border-b border-gray-100 bg-white flex-shrink-0">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-xl flex items-center justify-center lg:opacity-0"
                        style="background:linear-gradient(135deg,#7c3aed,#FF2D9B)">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                        </svg>
                    </div>
                    <span class="font-bold text-gray-800 text-sm lg:hidden">WebAdmin</span>
                </div>
                <a href="{{ route('register') }}"
                    class="text-sm font-semibold text-purple-600 hover:text-purple-800 transition-colors">
                    New here? <span class="underline underline-offset-2">Create account</span>
                </a>
            </div>

            {{-- Form area --}}
            <div class="flex-1 overflow-y-auto flex items-center justify-center px-6 py-10">
                <div class="w-full max-w-md fade-up pt-64">

                    {{-- Header --}}
                    <div class="mb-8">
                        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-semibold mb-4"
                            style="background:#f5f3ff;color:#7c3aed">
                            <span class="w-1.5 h-1.5 rounded-full bg-purple-500 animate-pulse inline-block"></span>
                            Secure Login
                        </div>
                        <h1 class="text-3xl font-bold text-gray-900 leading-tight">Welcome
                            back!</h1>
                        <p class="text-sm text-gray-500 mt-2">Sign in to your WebAdmin account to manage your website.
                        </p>
                    </div>

                    {{-- Error alerts --}}
                    @if ($errors->any())
                        <div class="flex items-start gap-3 rounded-xl px-4 py-3 mb-6 text-sm font-medium"
                            style="background:#fef2f2;border:1.5px solid #fecaca;color:#dc2626">
                            <svg class="w-4 h-4 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <ul class="list-none space-y-0.5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('status'))
                        <div class="flex items-center gap-2 rounded-xl px-4 py-3 mb-6 text-sm font-medium"
                            style="background:#f0fdf4;border:1.5px solid #bbf7d0;color:#16a34a">
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- Form --}}
                    <form method="POST" action="{{ route('login.submit') }}" class="space-y-5" id="login-form">
                        @csrf

                        {{-- User ID --}}
                        <div>
                            <label for="user_id" class="block text-xs font-semibold text-gray-600 mb-1.5">
                                User ID <span class="text-gray-400 font-normal">(email or username)</span>
                                <span class="text-red-400">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </span>
                                <input type="text" id="user_id" name="user_id" value="{{ old('user_id') }}"
                                    class="form-input {{ $errors->has('user_id') ? 'is-error' : '' }}"
                                    style="padding-left:2.75rem" placeholder="you@example.com or username"
                                    autocomplete="username" autofocus required>
                            </div>
                        </div>

                        {{-- Password --}}
                        <div>
                            <div class="flex items-center justify-between mb-1.5">
                                <label for="password" class="block text-xs font-semibold text-gray-600">
                                    Password <span class="text-red-400">*</span>
                                </label>
                                <a href="{{ route('password.request') }}"
                                    class="text-xs font-semibold text-purple-600 hover:text-purple-800 transition-colors">
                                    Forgot password?
                                </a>
                            </div>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </span>
                                <input type="password" id="password" name="password"
                                    class="form-input {{ $errors->has('password') ? 'is-error' : '' }}"
                                    style="padding-left:2.75rem;padding-right:3rem" placeholder="Enter your password"
                                    autocomplete="current-password" required>
                                <button type="button" onclick="togglePass()" id="eye-btn"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                                    <svg id="eye-open" class="w-4 h-4" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <svg id="eye-shut" class="w-4 h-4 hidden" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        {{-- Captcha --}}
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">
                                Captcha Verification <span class="text-red-400">*</span>
                            </label>
                            <div class="flex items-center gap-3">
                                <div class="captcha-box" id="captcha-display"
                                    title="Solve this to verify you're human">
                                    <svg class="w-4 h-4 opacity-60" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                    <span>{{ session('captcha_question') }} = ?</span>
                                </div>
                                <input type="text" id="captcha" name="captcha"
                                    class="form-input {{ $errors->has('captcha') ? 'is-error' : '' }}"
                                    placeholder="Answer" inputmode="numeric" autocomplete="off" maxlength="4"
                                    required>
                            </div>
                            <p class="text-xs text-gray-400 mt-1.5">Solve the simple math problem above.</p>
                        </div>

                        {{-- Remember me --}}
                        <div class="flex items-center gap-2.5">
                            <input type="checkbox" id="remember" name="remember" class="w-4 h-4 rounded"
                                style="accent-color:#7c3aed">
                            <label for="remember" class="text-sm text-gray-600 cursor-pointer select-none">Keep me
                                signed in</label>
                        </div>

                        {{-- Submit --}}
                        <button type="submit" id="submit-btn"
                            class="btn-grad w-full flex items-center justify-center gap-2 py-3.5 rounded-xl text-white text-sm font-semibold shadow-lg"
                            style="box-shadow:0 8px 24px rgba(124,58,237,.3)">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                            Sign In
                        </button>

                    </form>

                    {{-- Divider --}}
                    <div class="flex items-center gap-3 my-7">
                        <div class="flex-1 h-px bg-gray-100"></div>
                        <span class="text-xs text-gray-400 font-medium">Don't have an account?</span>
                        <div class="flex-1 h-px bg-gray-100"></div>
                    </div>

                    <a href="{{ route('register') }}"
                        class="flex items-center justify-center gap-2 w-full py-3.5 rounded-xl border border-gray-200 text-sm font-semibold text-gray-600 hover:border-purple-300 hover:bg-purple-50 hover:text-purple-700 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                        Create a free account
                    </a>

                    {{-- Trust badges --}}
                    <div class="flex flex-wrap items-center justify-center gap-5 mt-8 pt-6 border-t border-gray-100">
                        <div class="flex items-center gap-1.5 text-xs text-gray-400">
                            <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            SSL Secured
                        </div>
                        <div class="flex items-center gap-1.5 text-xs text-gray-400">
                            <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            Data Protected
                        </div>
                        <div class="flex items-center gap-1.5 text-xs text-gray-400">
                            <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            24/7 Support
                        </div>
                    </div>
                    <p class="text-center text-xs text-gray-300 mt-4">Powered by <span
                            class="text-gray-400 font-semibold">Reliable Services</span></p>

                </div>
            </div>
        </div>

    </div>

    <script>
        // ══ IMAGE SLIDER ══
        const slides = document.querySelectorAll('.slide-item');
        const dots = document.querySelectorAll('.slide-dot');
        let cur = 0;

        const quotes = [{
                icon: '🔐',
                title: 'Your Workspace Awaits',
                body: 'Log in to manage your website, track progress, and connect with our team — all from one dashboard.'
            },
            {
                icon: '🚀',
                title: 'Your Digital Presence Starts Here',
                body: 'We\'ve helped 500+ businesses launch stunning, high-performing websites.'
            },
            {
                icon: '⚡',
                title: 'Live in 48 Hours',
                body: 'From registration to live website — our team works around the clock to meet your deadline.'
            },
            {
                icon: '📈',
                title: 'Built to Rank on Google',
                body: 'SEO best practices baked in from day one. Your website is built to be discovered.'
            },
            {
                icon: '🤝',
                title: 'Trusted by Institutions',
                body: 'Schools, hospitals, restaurants & enterprises across India trust WebAdmin for their web presence.'
            },
        ];

        function goToSlide(n) {
            slides[cur].classList.remove('active');
            dots[cur].style.width = '8px';
            dots[cur].style.background = 'rgba(255,255,255,.35)';
            cur = n;
            slides[cur].classList.add('active');
            dots[cur].style.width = '24px';
            dots[cur].style.background = '#fff';
            const q = quotes[cur];
            document.getElementById('slide-quote').innerHTML =
                `<div style="font-size:2.5rem;margin-bottom:1rem">${q.icon}</div>
             <h3 style="color:#fff;font-size:1.2rem;font-weight:700;line-height:1.35;margin-bottom:.75rem">${q.title}</h3>
             <p style="color:rgba(255,255,255,.65);font-size:.85rem;line-height:1.7">${q.body}</p>`;
        }

        goToSlide(0);
        setInterval(() => goToSlide((cur + 1) % slides.length), 4500);

        // ══ PASSWORD TOGGLE ══
        function togglePass() {
            const inp = document.getElementById('password');
            const eyeOpen = document.getElementById('eye-open');
            const eyeShut = document.getElementById('eye-shut');
            const visible = inp.type === 'password';
            inp.type = visible ? 'text' : 'password';
            eyeOpen.classList.toggle('hidden', visible);
            eyeShut.classList.toggle('hidden', !visible);
        }

        // ══ SUBMIT LOADING STATE ══
        document.getElementById('login-form').addEventListener('submit', function() {
            const btn = document.getElementById('submit-btn');
            btn.disabled = true;
            btn.innerHTML = `<svg class="w-4 h-4 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
        </svg> Signing in…`;
        });
    </script>

</body>

</html>
