<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'WebAdmin — Premium Web Services')</title>
    <meta name="description" content="@yield('description', 'WebAdmin Reliable Services — professional websites delivered in 48 hours.')">
    <meta name="robots" content="index, follow">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Base reset --}}
    <style>
        *, *::before, *::after { box-sizing: border-box; }

        html { scroll-behavior: smooth; }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', 'Poppins', sans-serif;
            background: #ffffff;
            color: #0f172a;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        h1, h2, h3, h4, h5, h6 { font-family: 'Poppins', sans-serif; }

        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: linear-gradient(180deg, #0074d1, #38bdf8); border-radius: 9px; }
    </style>

    {{-- Page-specific styles --}}
    @stack('styles')
</head>

<body>

    {{-- Page-specific content (header + body + footer all go inside) --}}
    @yield('content')

    {{-- Page-specific scripts --}}
    @stack('scripts')

</body>

</html>
