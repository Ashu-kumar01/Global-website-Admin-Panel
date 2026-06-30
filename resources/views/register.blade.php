<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register — Get Your Dream Website | WebAdmin</title>
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

        /* Image slider */
        .slide-item {
            position: absolute;
            inset: 0;
            opacity: 0;
            transition: opacity 1.4s ease-in-out;
        }

        .slide-item.active {
            opacity: 1;
        }

        /* Step panels */
        .step-panel {
            display: none;
        }

        .step-panel.active {
            display: block;
            animation: fadeUp .4s ease forwards;
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

        /* Form inputs */
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

        select.form-input {
            cursor: pointer;
        }

        /* Upload area */
        .upload-area {
            border: 2px dashed #e5e7eb;
            border-radius: 1rem;
            transition: border-color .2s, background .2s;
            cursor: pointer;
        }

        .upload-area:hover,
        .upload-area.drag-over {
            border-color: #7c3aed;
            background: #f5f3ff;
        }

        /* Gradient button */
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

        /* Progress bar */
        #progress-bar {
            transition: width .45s cubic-bezier(.4, 0, .2, 1);
        }

        /* Step circles */
        .step-circle {
            transition: background .3s, color .3s, box-shadow .3s;
        }

        /* Line between steps */
        .step-line {
            transition: background .3s;
        }

        /* Slide dots */
        .slide-dot {
            transition: width .35s, background .35s;
        }

        /* Scrollbar */
        .right-panel::-webkit-scrollbar {
            width: 4px;
        }

        .right-panel::-webkit-scrollbar-track {
            background: #f9fafb;
        }

        .right-panel::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 4px;
        }

        /* Checkbox pill */
        .page-pill input[type="checkbox"]:checked~span {
            background: #ede9fe;
            color: #7c3aed;
            border-color: #a78bfa;
        }
    </style>
</head>

<body class="bg-white h-screen overflow-hidden">

    <div class="flex h-screen w-full overflow-hidden">

        <div class="hidden lg:block relative overflow-hidden bg-indigo-950 flex-shrink-0" style="width:42%">

            <div class="slide-item active">
                <img src="https://images.unsplash.com/photo-1467232004584-a241de8bcf5d?w=900&h=1200&fit=crop&q=85"
                    alt="" class="w-full h-full object-cover">
                <div class="absolute inset-0"
                    style="background:linear-gradient(180deg, rgb(6 0 14 / 85%) 0%, rgb(0 0 0 / 48%) 45%, rgb(0 0 0 / 30%) 100%)">
                </div>
            </div>
            <div class="slide-item">
                <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?w=900&h=1200&fit=crop&q=85"
                    alt="" class="w-full h-full object-cover">
                <div class="absolute inset-0"
                    style="background:linear-gradient(180deg, rgb(6 0 14 / 85%) 0%, rgb(0 0 0 / 48%) 45%, rgb(0 0 0 / 30%) 100%)">
                </div>
            </div>
            <div class="slide-item">
                <img src="https://images.unsplash.com/photo-1581291518633-83b4ebd1d83e?w=900&h=1200&fit=crop&q=85"
                    alt="" class="w-full h-full object-cover">
                <div class="absolute inset-0"
                    style="background:linear-gradient(180deg, rgb(6 0 14 / 85%) 0%, rgb(0 0 0 / 48%) 45%, rgb(0 0 0 / 30%) 100%)">
                </div>
            </div>
            <div class="slide-item">
                <img src="https://images.unsplash.com/photo-1551434678-e076c223a692?w=900&h=1200&fit=crop&q=85"
                    alt="" class="w-full h-full object-cover">
                <div class="absolute inset-0"
                    style="background:linear-gradient(180deg, rgb(6 0 14 / 85%) 0%, rgb(0 0 0 / 48%) 45%, rgb(0 0 0 / 30%) 100%)">
                </div>
            </div>
            <div class="slide-item">
                <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=900&h=1200&fit=crop&q=85"
                    alt="" class="w-full h-full object-cover">
                <div class="absolute inset-0"
                    style="background:linear-gradient(180deg, rgb(6 0 14 / 85%) 0%, rgb(0 0 0 / 48%) 45%, rgb(0 0 0 / 30%) 100%)">
                </div>
            </div>

            {{-- Overlay content --}}
            <div
                class="absolute inset-0 z-10 flex flex-col justify-between p-10 xl:p-14 drop-shadow-[2px_4px_6px_rgba(0,0,0,0.5)]">

                {{-- Company logo (top) --}}
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

                {{-- Quote (middle) --}}
                <div class="flex-1 flex flex-col justify-center">
                    <div id="slide-quote" class="max-w-xs"></div>
                </div>

                {{-- Bottom section --}}
                <div>
                    {{-- Feature pills --}}
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

                    {{-- Slide dots --}}
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

                    {{-- Powered by --}}
                    <div class="pt-5 border-t border-white/10">
                        <p class="text-white/40 text-xs">Powered by <span class="text-white/75 font-semibold">Reliable
                                Services</span></p>
                        <p class="text-white/30 text-xs mt-0.5">Trusted by 500+ businesses across India</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- ══════════════ RIGHT: FORM ══════════════ --}}
        <div class="flex flex-col overflow-hidden" style="flex:1" id="form-container">

            {{-- Top bar --}}
            <div
                class="flex items-center justify-between px-6 xl:px-10 py-4 border-b border-gray-100 bg-white flex-shrink-0">
                {{-- Logo (mobile only left, desktop subtle) --}}
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

                <div class="text-xs font-medium text-gray-400">
                    Step <span id="step-label" class="text-gray-700 font-semibold">1</span> <span
                        class="text-gray-300">/</span> 4
                </div>

                <a href="{{ route('login') }}"
                    class="text-sm font-semibold text-purple-600 hover:text-purple-800 transition-colors">
                    Already registered? <span class="underline underline-offset-2">Login</span>
                </a>
            </div>

            {{-- Progress bar --}}
            <div class="h-1 bg-gray-100 flex-shrink-0">
                <div id="progress-bar" class="h-full rounded-r-full"
                    style="width:25%;background:linear-gradient(90deg,#7c3aed,#FF2D9B)"></div>
            </div>

            {{-- Scrollable content --}}
            <div class="flex-1 overflow-y-auto right-panel">
                <div class="max-w-lg mx-auto px-6 xl:px-2 py-8">
                    <form action="{{ route('save.register') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- ── Step Indicators ── --}}
                        <div class="flex items-start justify-between mb-10">

                            {{-- Step 1 --}}
                            <div class="flex flex-col items-center gap-2" id="ind-1">
                                <div class="step-circle w-11 h-11 rounded-full flex items-center justify-center text-white shadow-lg"
                                    style="background:linear-gradient(135deg,#7c3aed,#6d28d9);box-shadow:0 6px 20px rgba(124,58,237,.3)"
                                    id="circle-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <span class="text-xs font-semibold text-purple-700 text-center"
                                    id="label-1">Contact</span>
                            </div>

                            <div class="flex-1 mt-5 mx-2 h-px step-line bg-gray-200" id="line-12"></div>

                            {{-- Step 2 --}}
                            <div class="flex flex-col items-center gap-2" id="ind-2">
                                <div class="step-circle w-11 h-11 rounded-full flex items-center justify-center text-gray-400 bg-gray-100"
                                    id="circle-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                    </svg>
                                </div>
                                <span class="text-xs font-medium text-gray-400 text-center"
                                    id="label-2">Website</span>
                            </div>

                            <div class="flex-1 mt-5 mx-2 h-px step-line bg-gray-200" id="line-23"></div>

                            {{-- Step 3 --}}
                            <div class="flex flex-col items-center gap-2" id="ind-3">
                                <div class="step-circle w-11 h-11 rounded-full flex items-center justify-center text-gray-400 bg-gray-100"
                                    id="circle-3">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                    </svg>
                                </div>
                                <span class="text-xs font-medium text-gray-400 text-center"
                                    id="label-3">Social</span>
                            </div>

                            <div class="flex-1 mt-5 mx-2 h-px step-line bg-gray-200" id="line-34"></div>

                            {{-- Step 4 --}}
                            <div class="flex flex-col items-center gap-2" id="ind-4">
                                <div class="step-circle w-11 h-11 rounded-full flex items-center justify-center text-gray-400 bg-gray-100"
                                    id="circle-4">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <span class="text-xs font-medium text-gray-400 text-center"
                                    id="label-4">Branding</span>
                            </div>

                        </div>

                        {{-- ══ PANEL 1: Contact Info ══ --}}
                        <div class="step-panel active" id="panel-1">
                            <div class="mb-7">
                                <h2 class="text-2xl font-bold text-gray-900 leading-tight">Personal Details</h2>
                                <p class="text-sm text-gray-500 mt-1.5">Tell us who you are — we'll set up your
                                    account.
                                </p>
                            </div>
                            <div class="space-y-4">
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">First Name
                                            <span class="text-red-400">*</span></label>
                                        <input type="text" id="first-name" class="form-input" name="fname"
                                            value="{{ old('fname') }}" placeholder="John">
                                        @error('fname') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Last Name <span
                                                class="text-red-400">*</span></label>
                                        <input type="text" id="last-name" class="form-input" name="lname"
                                            value="{{ old('lname') }}" placeholder="Doe">
                                        @error('lname') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Email Address <span
                                            class="text-red-400">*</span></label>
                                    <input type="email" id="email" class="form-input" name="email"
                                        value="{{ old('email') }}" placeholder="john@example.com">
                                    @error('email') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Mobile Number <span
                                            class="text-red-400">*</span></label>
                                    <div class="relative">
                                        <span
                                            class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 text-sm font-semibold select-none">+91</span>
                                        <input type="tel" id="phone" class="form-input"
                                            style="padding-left:52px" placeholder="98765 43210" name="mobile_number"
                                            value="{{ old('mobile_number') }}" maxlength="10">
                                    </div>
                                    @error('mobile_number') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Password <span
                                            class="text-red-400">*</span></label>
                                    <div class="relative">
                                        <input type="password" id="password" name="password" class="form-input"
                                            style="padding-right:48px" placeholder="Min. 8 characters">
                                        <button type="button" onclick="togglePass('password')"
                                            class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors"
                                            id="eye-password">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="flex gap-1 mt-2">
                                        <div class="h-1 flex-1 rounded-full bg-gray-200 transition-all"
                                            id="sb1">
                                        </div>
                                        <div class="h-1 flex-1 rounded-full bg-gray-200 transition-all"
                                            id="sb2">
                                        </div>
                                        <div class="h-1 flex-1 rounded-full bg-gray-200 transition-all"
                                            id="sb3">
                                        </div>
                                        <div class="h-1 flex-1 rounded-full bg-gray-200 transition-all"
                                            id="sb4">
                                        </div>
                                    </div>
                                    <p class="text-xs mt-1 h-4" id="strength-text" style="color:#9ca3af"></p>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Confirm Password
                                        <span class="text-red-400">*</span></label>
                                    <div class="relative">
                                        <input type="password" id="confirm-password" name="confirmed_password"
                                            class="form-input" style="padding-right:48px"
                                            placeholder="Re-enter password">
                                        <button type="button" onclick="togglePass('confirm-password')"
                                            class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- ══ PANEL 2: Website Info ══ --}}
                        <div class="step-panel" id="panel-2">
                            <div class="mb-7">
                                <h2 class="text-2xl font-bold text-gray-900 leading-tight">Website Details</h2>
                                <p class="text-sm text-gray-500 mt-1.5">Tell us about the website you need — we'll
                                    customise it.</p>
                            </div>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Business /
                                        Organisation
                                        Name <span class="text-red-400">*</span></label>
                                    <input type="text" name="organisation_name" id="biz-name" class="form-input"
                                        value="{{ old('organisation_name') }}" placeholder="e.g. ABC School of Excellence">
                                    @error('organisation_name') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Website / Domain
                                        Name
                                        <span class="text-red-400">*</span></label>
                                    <div class="flex gap-2">
                                        <input type="text" name="website_name" id="web-name" class="form-input"
                                            value="{{ old('website_name') }}" placeholder="abcschool">
                                        <select class="form-input" name="domain"
                                            style="width:auto;min-width:95px;flex-shrink:0">
                                            @foreach (['.com', '.in', '.org', '.net', '.co.in', '.edu.in'] as $d)
                                                <option @selected(old('domain') === $d)>{{ $d }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('website_name') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                                    @error('domain') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Website Type <span
                                            class="text-red-400">*</span></label>
                                    <select id="web-type" name="website_type" class="form-input">
                                        <option value="">Select your website category</option>
                                        @foreach (['Corporate / Business', 'E-commerce / Online Store', 'Portfolio / Creative Agency', 'Healthcare / Medical Clinic', 'Restaurant / Food & Dining', 'Real Estate / Property', 'School', 'College', 'University', 'NGO / Non-Profit', 'Blog / News Portal', 'Other'] as $type)
                                            <option @selected(old('website_type') === $type)>{{ $type }}</option>
                                        @endforeach
                                    </select>
                                    @error('website_type') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Short Description
                                        <span class="text-red-400">*</span></label>
                                    <textarea id="web-desc" name="web_descroption" class="form-input" style="resize:none" rows="3"
                                        placeholder="Briefly describe your business and what you offer...">{{ old('web_descroption') }}</textarea>
                                    @error('web_descroption') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">City /
                                            Location</label>
                                        <input type="text" id="city" name="location" class="form-input"
                                            placeholder="e.g. Mumbai">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Target
                                            Audience</label>
                                        <input type="text" id="audience" name="target_audience"
                                            class="form-input" placeholder="e.g. Students">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- ══ PANEL 3: Social Media ══ --}}
                        <div class="step-panel" id="panel-3">
                            <div class="mb-7">
                                <h2 class="text-2xl font-bold text-gray-900 leading-tight">Social Media Links</h2>
                                <p class="text-sm text-gray-500 mt-1.5">Add your profiles — we'll integrate them into
                                    your
                                    website.</p>
                            </div>
                            <div class="space-y-4">

                                {{-- Facebook --}}
                                <div>
                                    <label class="flex items-center gap-2 text-xs font-semibold text-gray-600 mb-1.5">
                                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="#1877F2">
                                            <path
                                                d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                        </svg>
                                        Facebook
                                    </label>
                                    <input type="url" class="form-input" name="facebook"
                                        placeholder="https://facebook.com/yourpage">
                                </div>

                                {{-- Instagram --}}
                                <div>
                                    <label class="flex items-center gap-2 text-xs font-semibold text-gray-600 mb-1.5">
                                        <svg class="w-4 h-4" viewBox="0 0 24 24">
                                            <defs>
                                                <linearGradient id="ig1" x1="0" y1="1"
                                                    x2="1" y2="0">
                                                    <stop offset="0%" stop-color="#f09433" />
                                                    <stop offset="50%" stop-color="#dc2743" />
                                                    <stop offset="100%" stop-color="#bc1888" />
                                                </linearGradient>
                                            </defs>
                                            <path fill="url(#ig1)"
                                                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                        </svg>
                                        Instagram
                                    </label>
                                    <input type="url" name="instagram" class="form-input"
                                        placeholder="https://instagram.com/yourprofile">
                                </div>

                                {{-- Twitter/X --}}
                                <div>
                                    <label class="flex items-center gap-2 text-xs font-semibold text-gray-600 mb-1.5">
                                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="#000">
                                            <path
                                                d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.742l7.746-8.867L1.145 2.25H8.08l4.254 5.628 5.91-5.628zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                                        </svg>
                                        Twitter / X
                                    </label>
                                    <input type="url" name="twitter" class="form-input"
                                        placeholder="https://x.com/yourhandle">
                                </div>

                                {{-- LinkedIn --}}
                                <div>
                                    <label class="flex items-center gap-2 text-xs font-semibold text-gray-600 mb-1.5">
                                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="#0A66C2">
                                            <path
                                                d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                                        </svg>
                                        LinkedIn
                                    </label>
                                    <input type="url" class="form-input" name="linkedIn"
                                        placeholder="https://linkedin.com/company/yourname">
                                </div>

                                {{-- YouTube --}}
                                <div>
                                    <label class="flex items-center gap-2 text-xs font-semibold text-gray-600 mb-1.5">
                                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="#FF0000">
                                            <path
                                                d="M23.495 6.205a3.007 3.007 0 0 0-2.088-2.088c-1.87-.501-9.396-.501-9.396-.501s-7.507-.01-9.396.501A3.007 3.007 0 0 0 .527 6.205a31.247 31.247 0 0 0-.522 5.805 31.247 31.247 0 0 0 .522 5.783 3.007 3.007 0 0 0 2.088 2.088c1.868.502 9.396.502 9.396.502s7.506 0 9.396-.502a3.007 3.007 0 0 0 2.088-2.088 31.247 31.247 0 0 0 .5-5.783 31.247 31.247 0 0 0-.5-5.805zM9.609 15.601V8.408l6.264 3.602z" />
                                        </svg>
                                        YouTube
                                    </label>
                                    <input type="url" class="form-input" name="youtube"
                                        placeholder="https://youtube.com/@yourchannel">
                                </div>

                                {{-- WhatsApp --}}
                                <div>
                                    <label class="flex items-center gap-2 text-xs font-semibold text-gray-600 mb-1.5">
                                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="#25D366">
                                            <path
                                                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                                        </svg>
                                        WhatsApp Business
                                    </label>
                                    <div class="relative">
                                        <span
                                            class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 text-sm font-semibold select-none">+91</span>
                                        <input type="tel" class="form-input" style="padding-left:52px"
                                            name="whatsapp" placeholder="98765 43210" maxlength="10">
                                    </div>
                                </div>

                            </div>
                        </div>

                        {{-- ══ PANEL 4: Branding ══ --}}
                        <div class="step-panel" id="panel-4">
                            <div class="mb-7">
                                <h2 class="text-2xl font-bold text-gray-900 leading-tight">Branding & Logo</h2>
                                <p class="text-sm text-gray-500 mt-1.5">Upload your logo and share your brand identity
                                    with
                                    us.</p>
                            </div>
                            <div class="space-y-5">

                                {{-- Logo upload --}}
                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Company /
                                        Organisation
                                        Logo</label>
                                    <div class="upload-area p-7 text-center" id="drop-zone"
                                        onclick="document.getElementById('logo-input').click()">
                                        <input type="file" id="logo-input" accept="image/*" class="hidden"
                                            name="logo" onchange="previewLogo(event)">
                                        <div id="upload-placeholder">
                                            <div class="w-14 h-14 rounded-2xl mx-auto mb-3 flex items-center justify-center"
                                                style="background:#f5f3ff">
                                                <svg class="w-7 h-7" style="color:#a78bfa" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="1.5"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                            <p class="text-sm font-semibold text-gray-700">Drag & drop your logo here
                                            </p>
                                            <p class="text-xs text-gray-400 mt-1">or <span style="color:#7c3aed"
                                                    class="font-semibold">click to browse</span> — PNG, JPG, SVG · max
                                                5 MB
                                            </p>
                                        </div>
                                        <div id="logo-preview-wrap" class="hidden">
                                            <img id="logo-preview-img"
                                                class="h-20 object-contain mx-auto mb-2 rounded-xl"
                                                alt="Logo preview">
                                            <p id="logo-file-name" class="text-xs text-gray-500"></p>
                                            <button type="button" onclick="clearLogo(event)"
                                                class="mt-2 text-xs font-semibold text-red-400 hover:text-red-600 transition-colors">✕
                                                Remove</button>
                                        </div>
                                    </div>
                                </div>

                                {{-- Brand colour --}}
                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Brand Primary
                                        Colour</label>
                                    <div class="flex items-center gap-3">
                                        <input type="color" id="brand-color" value="#7c3aed"
                                            class="w-14 h-12 rounded-xl border border-gray-200 cursor-pointer p-1"
                                            oninput="document.getElementById('color-hex').value=this.value">
                                        <input type="text" id="color-hex" class="form-input" value="#7c3aed"
                                            name="primary_color" maxlength="7" placeholder="#7c3aed"
                                            oninput="syncColor(this)">
                                        <span
                                            class="text-xs text-gray-400 leading-tight whitespace-nowrap">Primary<br>colour</span>
                                    </div>
                                </div>

                                {{-- Tagline --}}
                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Tagline /
                                        Slogan</label>
                                    <input type="text" class="form-input" name="tagline"
                                        placeholder="e.g. Empowering Students Since 2005">
                                </div>

                                {{-- Pages required --}}
                                {{-- <div>
                                    <label class="block text-xs font-semibold text-gray-600 mb-2">
                                        Pages Required <span class="font-normal text-gray-400">(select all you need)</span>
                                    </label>
                                    <div class="grid grid-cols-2 gap-2">
                                        @foreach (['Home', 'About Us', 'Services / Courses', 'Gallery / Photos', 'Contact Us', 'Blog / News', 'Testimonials', 'FAQ', 'Admissions / Booking', 'Team / Staff'] as $pg)
                                            <label
                                                class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl border border-gray-200 cursor-pointer transition-all hover:border-purple-300 hover:bg-purple-50 text-sm text-gray-700 select-none">
                                                <input type="checkbox" class="w-4 h-4 rounded" name="pages[]"
                                                    style="accent-color:#7c3aed"> {{ $pg }}
                                            </label>
                                        @endforeach
                                    </div>
                                </div> --}}

                                {{-- Additional notes --}}
                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Additional Notes /
                                        Requirements</label>
                                    <textarea class="form-input" style="resize:none" rows="3" name="notes"
                                        placeholder="Any special requirements, references, or details you'd like us to know..."></textarea>
                                </div>

                                {{-- Terms --}}
                                <label class="flex items-start gap-3 cursor-pointer">
                                    <input type="checkbox" id="terms" class="mt-0.5 w-4 h-4 rounded"
                                        name="terms" style="accent-color:#7c3aed">
                                    <span class="text-xs text-gray-500 leading-relaxed">
                                        I agree to the <a href="#" style="color:#7c3aed"
                                            class="underline underline-offset-2">Terms of Service</a> and <a
                                            href="#" style="color:#7c3aed"
                                            class="underline underline-offset-2">Privacy Policy</a>. I understand my
                                        website will be delivered within <strong class="text-gray-700">48 business
                                            hours</strong> of confirmation.
                                    </span>
                                </label>

                            </div>
                        </div>

                        {{-- ── Navigation Buttons ── --}}
                        <div class="flex items-center justify-between mt-9 pt-6 border-t border-gray-100">
                            <button id="btn-prev" type="button" onclick="prevStep(event)"
                                class="hidden items-center gap-2 px-6 py-3 rounded-xl border border-gray-200 text-sm font-semibold text-gray-600 hover:border-gray-300 hover:bg-gray-50 transition-all">
                                ← Back
                            </button>
                            <div id="prev-spacer"></div>

                            <button id="btn-next" type="button" onclick="nextStep(event)"
                                class="btn-grad flex items-center gap-2 px-8 py-3.5 rounded-xl text-white text-sm font-semibold shadow-lg"
                                style="box-shadow:0 8px 24px rgba(124,58,237,.3)">
                                Continue <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                            <button id="btn-submit"
                                class="btn-grad hidden items-center gap-2 px-8 py-3.5 rounded-xl text-white text-sm font-semibold shadow-lg"
                                style="box-shadow:0 8px 24px rgba(124,58,237,.3)">
                                🚀 Submit Registration
                            </button>
                        </div>

                        {{-- ── Trust badges ── --}}
                        <div class="mt-8 pt-6 border-t border-gray-100">
                            <div class="flex flex-wrap items-center justify-center gap-5">
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
                                    <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                    48hr Delivery
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
                            <p class="text-center text-xs text-gray-300 mt-4">
                                Powered by <span class="text-gray-500 font-semibold">Reliable Services</span>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- ══ SUCCESS SCREEN (hidden) ══ --}}
        {{-- <div id="success-screen" class="hidden flex-col items-center justify-center px-6 py-12 text-center"
            style="flex:1">
            <div class="w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6 shadow-xl"
                style="background:linear-gradient(135deg,#d1fae5,#a7f3d0)">
                <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold text-green-700 mb-4"
                style="background:#dcfce7">
                <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse inline-block"></span>
                Registration Successful
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-3">You're All Set! 🎉</h2>
            <p class="text-gray-500 text-sm leading-relaxed max-w-sm mx-auto mb-8">
                Thank you for registering with <strong class="text-gray-700">WebAdmin</strong>. Our team will review
                your details and your fully customised website will be live within
                <strong style="color:#7c3aed">48 business hours</strong>.
            </p>
            <div class="flex flex-col gap-3 w-full max-w-xs mx-auto">
                <a href="{{ route('home') }}"
                    class="btn-grad flex items-center justify-center gap-2 px-8 py-3.5 rounded-xl text-white text-sm font-semibold shadow-lg"
                    style="box-shadow:0 8px 24px rgba(124,58,237,.3)">
                    ← Back to Home
                </a>
                <a href="{{ route('login') }}"
                    class="flex items-center justify-center gap-2 px-8 py-3.5 rounded-xl border border-gray-200 text-sm font-semibold text-gray-600 hover:border-gray-300 hover:bg-gray-50 transition-all">
                    🔑 Login to Dashboard
                </a>
            </div>
            <p class="text-xs text-gray-300 mt-10">Powered by <span class="text-gray-400 font-semibold">Reliable
                    Services</span></p>
        </div> --}}

    </div>

    <script>
        // ══════════ IMAGE SLIDER ══════════
        const slides = document.querySelectorAll('.slide-item');
        const dots = document.querySelectorAll('.slide-dot');
        let cur = 0;

        const quotes = [{
                icon: '🚀',
                title: 'Your Digital Presence Starts Here',
                body: 'We\'ve helped 500+ businesses and institutions launch stunning, high-performing websites.'
            },
            {
                icon: '🎨',
                title: 'Designed for Your Industry',
                body: 'Every template is crafted specifically for your niche — nothing generic, everything tailored.'
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

        // ══════════ STEP LOGIC ══════════
        const fieldStepMap = {
            fname: 1, lname: 1, email: 1, mobile_number: 1, password: 1, confirmed_password: 1,
            organisation_name: 2, website_name: 2, domain: 2, website_type: 2, web_descroption: 2, location: 2, target_audience: 2,
            facebook: 3, instagram: 3, twitter: 3, linkedIn: 3, youtube: 3, whatsapp: 3,
            logo: 4, primary_color: 4, tagline: 4, notes: 4, terms: 4,
        };
        const errorFields = @json(array_keys($errors->getMessages()));
        let step = 1;
        if (errorFields.length) {
            const steps = errorFields.map(f => fieldStepMap[f] || 1);
            step = Math.min(...steps);
        }
        const TOTAL = 4;

        const stepIcons = {
            1: '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>',
            2: '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>',
            3: '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/></svg>',
            4: '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>',
        };
        const checkIcon =
            '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>';

        function updateUI() {
            // Panels
            document.querySelectorAll('.step-panel').forEach(p => p.classList.remove('active'));
            document.getElementById('panel-' + step).classList.add('active');

            // Step circles & labels
            for (let i = 1; i <= TOTAL; i++) {
                const circle = document.getElementById('circle-' + i);
                const label = document.getElementById('label-' + i);
                if (i < step) {
                    circle.style.background = '#22c55e';
                    circle.style.boxShadow = '0 6px 20px rgba(34,197,94,.3)';
                    circle.style.color = '#fff';
                    circle.innerHTML = checkIcon;
                    label.style.color = '#16a34a';
                    label.style.fontWeight = '600';
                } else if (i === step) {
                    circle.style.background = 'linear-gradient(135deg,#7c3aed,#6d28d9)';
                    circle.style.boxShadow = '0 6px 20px rgba(124,58,237,.3)';
                    circle.style.color = '#fff';
                    circle.innerHTML = stepIcons[i];
                    label.style.color = '#7c3aed';
                    label.style.fontWeight = '600';
                } else {
                    circle.style.background = '#f3f4f6';
                    circle.style.boxShadow = 'none';
                    circle.style.color = '#9ca3af';
                    circle.innerHTML = stepIcons[i];
                    label.style.color = '#9ca3af';
                    label.style.fontWeight = '500';
                }
            }

            // Connecting lines
            ['line-12', 'line-23', 'line-34'].forEach((id, idx) => {
                document.getElementById(id).style.background = (idx + 1) < step ? '#22c55e' : '#e5e7eb';
            });

            // Progress bar
            document.getElementById('progress-bar').style.width = ((step / TOTAL) * 100) + '%';
            document.getElementById('step-label').textContent = step;

            // Buttons
            const btnPrev = document.getElementById('btn-prev');
            const btnNext = document.getElementById('btn-next');
            const btnSubmit = document.getElementById('btn-submit');
            const spacer = document.getElementById('prev-spacer');

            if (step > 1) {
                btnPrev.classList.remove('hidden');
                btnPrev.classList.add('flex');
                spacer.classList.add('hidden');
            } else {
                btnPrev.classList.add('hidden');
                btnPrev.classList.remove('flex');
                spacer.classList.remove('hidden');
            }

            if (step === TOTAL) {
                btnNext.classList.add('hidden');
                btnSubmit.classList.remove('hidden');
                btnSubmit.classList.add('flex');
            } else {
                btnNext.classList.remove('hidden');
                btnSubmit.classList.add('hidden');
                btnSubmit.classList.remove('flex');
            }
        }

        updateUI();
        @if ($errors->any())
            showError(@json($errors->first()));
        @endif

        function showError(msg) {
            document.querySelectorAll('.form-err').forEach(e => e.remove());
            const el = document.createElement('div');
            el.className = 'form-err flex items-center gap-2 rounded-xl px-4 py-3 text-sm font-medium mt-4';
            el.style.cssText = 'background:#fef2f2;border:1.5px solid #fecaca;color:#dc2626';
            el.innerHTML =
                `<svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>${msg}`;
            document.getElementById('panel-' + step).appendChild(el);
            setTimeout(() => el.remove(), 4500);
        }

        function validate() {
            if (step === 1) {
                if (!document.getElementById('first-name').value.trim()) {
                    showError('Please enter your first name.');
                    return false;
                }
                if (!document.getElementById('last-name').value.trim()) {
                    showError('Please enter your last name.');
                    return false;
                }
                const em = document.getElementById('email').value.trim();
                if (!em || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(em)) {
                    showError('Please enter a valid email address.');
                    return false;
                }
                const ph = document.getElementById('phone').value.trim();
                if (!ph || ph.length < 10) {
                    showError('Please enter a valid 10-digit phone number.');
                    return false;
                }
                const pw = document.getElementById('password').value;
                if (!pw || pw.length < 8) {
                    showError('Password must be at least 8 characters.');
                    return false;
                }
                if (pw !== document.getElementById('confirm-password').value) {
                    showError('Passwords do not match.');
                    return false;
                }
            }
            if (step === 2) {
                if (!document.getElementById('biz-name').value.trim()) {
                    showError('Please enter your business / organisation name.');
                    return false;
                }
                if (!document.getElementById('web-name').value.trim()) {
                    showError('Please enter a website / domain name.');
                    return false;
                }
                if (!document.getElementById('web-type').value) {
                    showError('Please select a website type.');
                    return false;
                }
                if (!document.getElementById('web-desc').value.trim()) {
                    showError('Please write a short description.');
                    return false;
                }
            }
            if (step === 4) {
                if (!document.getElementById('terms').checked) {
                    showError('Please accept the Terms of Service to continue.');
                    return false;
                }
            }
            return true;
        }

        function nextStep(e) {
            if (e) {
                e.preventDefault();
            }
            if (!validate()) return;
            if (step < TOTAL) {
                step++;
                updateUI();
                document.querySelector('.right-panel').scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }
        }

        function prevStep(e) {
            if (e) {
                e.preventDefault();
            }
            if (step > 1) {
                step--;
                updateUI();
                document.querySelector('.right-panel').scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }
        }


        // ══════════ PASSWORD TOGGLE ══════════
        function togglePass(id) {
            const inp = document.getElementById(id);
            inp.type = inp.type === 'password' ? 'text' : 'password';
        }

        // ══════════ PASSWORD STRENGTH ══════════
        document.getElementById('password').addEventListener('input', function() {
            const v = this.value;
            let s = 0;
            if (v.length >= 8) s++;
            if (/[A-Z]/.test(v)) s++;
            if (/[0-9]/.test(v)) s++;
            if (/[^A-Za-z0-9]/.test(v)) s++;
            const clr = ['', '#ef4444', '#f97316', '#eab308', '#22c55e'];
            const lbl = ['', 'Weak', 'Fair', 'Good', 'Strong ✓'];
            for (let i = 1; i <= 4; i++) {
                document.getElementById('sb' + i).style.background = i <= s ? clr[s] : '#e5e7eb';
            }
            const st = document.getElementById('strength-text');
            st.textContent = v ? lbl[s] : '';
            st.style.color = clr[s];
        });

        // ══════════ BRAND COLOUR SYNC ══════════
        function syncColor(el) {
            if (/^#[0-9A-Fa-f]{6}$/.test(el.value)) document.getElementById('brand-color').value = el.value;
        }

        // ══════════ LOGO UPLOAD ══════════
        function previewLogo(e) {
            const file = e.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = ev => {
                document.getElementById('upload-placeholder').classList.add('hidden');
                document.getElementById('logo-preview-wrap').classList.remove('hidden');
                document.getElementById('logo-preview-img').src = ev.target.result;
                document.getElementById('logo-file-name').textContent = file.name;
            };
            reader.readAsDataURL(file);
        }

        function clearLogo(e) {
            e.stopPropagation();
            document.getElementById('logo-input').value = '';
            document.getElementById('upload-placeholder').classList.remove('hidden');
            document.getElementById('logo-preview-wrap').classList.add('hidden');
        }

        const dropZone = document.getElementById('drop-zone');
        dropZone.addEventListener('dragover', e => {
            e.preventDefault();
            dropZone.classList.add('drag-over');
        });
        dropZone.addEventListener('dragleave', () => dropZone.classList.remove('drag-over'));
        dropZone.addEventListener('drop', e => {
            e.preventDefault();
            dropZone.classList.remove('drag-over');
            const file = e.dataTransfer.files[0];
            if (file && file.type.startsWith('image/')) {
                const dt = new DataTransfer();
                dt.items.add(file);
                document.getElementById('logo-input').files = dt.files;
                previewLogo({
                    target: {
                        files: [file]
                    }
                });
            }
        });
    </script>
</body>

</html>
