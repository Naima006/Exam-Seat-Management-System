<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title', 'Dashboard') | Exam Seat Management System
    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>

<body class="text-white">

    {{-- Sidebar --}}
    @include('layouts.sidebar')

    {{-- Main Content --}}
    <div class="lg:ml-72 min-h-screen flex flex-col">

        {{-- Top Navigation --}}
        @include('layouts.navigation')

        {{-- Flash Messages --}}
        <div class="px-4 pt-4">

            @if(session('success'))

                <div
                    class="auto-dismiss card border border-green-500/30 bg-green-500/10 px-5 py-4 mb-4">

                    <div class="flex items-center gap-3">

                        <span class="text-green-400 text-xl">

                            ✓

                        </span>

                        <span>

                            {{ session('success') }}

                        </span>

                    </div>

                </div>

            @endif

            @if(session('error'))

                <div
                    class="auto-dismiss card border border-red-500/30 bg-red-500/10 px-5 py-4 mb-4">

                    <div class="flex items-center gap-3">

                        <span class="text-red-400 text-xl">

                            ⚠

                        </span>

                        <span>

                            {{ session('error') }}

                        </span>

                    </div>

                </div>

            @endif

        </div>

        {{-- Page Content --}}
        <main
            class="flex-1 px-4 pb-6 fade-up">

            @yield('content')

        </main>

        {{-- Footer --}}
        <footer
            class="px-6 py-5 text-center text-sm text-slate-400 border-t border-white/10">

            © <span id="currentYear"></span>

            Exam Seat Management System

            • Developed by Team ESMS

        </footer>

    </div>

</body>

</html>