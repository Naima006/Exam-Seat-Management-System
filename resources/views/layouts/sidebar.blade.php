<aside
    id="sidebar"
    class="sidebar fixed inset-y-0 left-0 z-50 w-72 -translate-x-full lg:translate-x-0 transition-transform duration-300">

    <div class="card h-full flex flex-col mx-4 my-4 p-6 overflow-hidden">

        <div class="flex justify-end lg:hidden mb-2">

            <button
                id="sidebarClose"
                class="text-slate-300 hover:text-white text-2xl">

                &times;

            </button>

        </div>

        <div class="mb-10 flex items-center gap-3 shrink-0">
            <div class="p-2.5 rounded-xl bg-gradient-to-tr from-indigo-500 to-violet-500 text-white shadow-lg shadow-indigo-500/30 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
            </div>
            <div>
                <h1 class="text-2xl font-bold tracking-wide">
                    ExamSeat
                </h1>
                <p class="text-slate-400 text-xs tracking-wider uppercase font-medium">
                    Management System
                </p>
            </div>
        </div>

        <nav class="flex-1 space-y-2 overflow-y-auto pr-1" style="scrollbar-width: none; -ms-overflow-style: none;">
            <style>
                nav::-webkit-scrollbar { display: none; }
            </style>

            {{-- Dashboard --}}
            <a href="{{ route('dashboard') }}"
                class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }} flex items-center gap-3">
                
                <div class="p-2 rounded-lg bg-slate-800/50 text-indigo-400 border border-slate-700/30 dynamic-icon-box transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l9-9 9 9M4 10v10h16V10"/>
                    </svg>
                </div>

                Dashboard

            </a>

            {{-- Departments --}}
            <a href="{{ route('departments.index') }}"
                class="sidebar-link {{ request()->routeIs('departments.*') ? 'active' : '' }} flex items-center gap-3">

                <div class="p-2 rounded-lg bg-slate-800/50 text-indigo-400 border border-slate-700/30 dynamic-icon-box transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18"/>
                    </svg>
                </div>

                Departments

            </a>

            {{-- Courses --}}
            <a href="{{ route('courses.index') }}"
                class="sidebar-link {{ request()->routeIs('courses.*') ? 'active' : '' }} flex items-center gap-3">

                <div class="p-2 rounded-lg bg-slate-800/50 text-indigo-400 border border-slate-700/30 dynamic-icon-box transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12M6 12h12"/>
                    </svg>
                </div>

                Courses

            </a>

            {{-- Students --}}
            <a href="#" class="sidebar-link flex items-center gap-3">

                <div class="p-2 rounded-lg bg-slate-800/50 text-indigo-400 border border-slate-700/30 dynamic-icon-box transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0v6m4.5-2.5v1.8c0 .8-.7 1.4-1.5 1.4H9c-.8 0-1.5-.6-1.5-1.4v-1.8"/>
                    </svg>
                </div>

                Students

            </a>

            {{-- Rooms --}}
            <a href="{{ route('rooms.index') }}"
                class="sidebar-link {{ request()->routeIs('rooms.*') ? 'active' : '' }} flex items-center gap-3">

                <div class="p-2 rounded-lg bg-slate-800/50 text-indigo-400 border border-slate-700/30 dynamic-icon-box transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3h8v4m4 0H4v14h16V7z"/>
                    </svg>
                </div>

                Rooms

            </a>

            {{-- Invigilators --}}
            <a href="#" class="sidebar-link flex items-center gap-3">

                <div class="p-2 rounded-lg bg-slate-800/50 text-indigo-400 border border-slate-700/30 dynamic-icon-box transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-3.33 0-6 2.67-6 6h12c0-3.33-2.67-6-6-6z"/>
                    </svg>
                </div>

                Invigilators

            </a>

            {{-- Exams --}}
            <a href="#" class="sidebar-link flex items-center gap-3">

                <div class="p-2 rounded-lg bg-slate-800/50 text-indigo-400 border border-slate-700/30 dynamic-icon-box transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>

                Exams

            </a>

            {{-- Seat Allocation --}}
            <a href="#" class="sidebar-link flex items-center gap-3">

                <div class="p-2 rounded-lg bg-slate-800/50 text-indigo-400 border border-slate-700/30 dynamic-icon-box transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM5 13h14M12 7v14" />
                    </svg>
                </div>

                Seat Allocation

            </a>

            {{-- Reports --}}
            <a href="#" class="sidebar-link flex items-center gap-3">

                <div class="p-2 rounded-lg bg-slate-800/50 text-indigo-400 border border-slate-700/30 dynamic-icon-box transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>

                Reports

            </a>

        </nav>

        <div class="pt-6 mt-6 border-t border-white/10 shrink-0">

            <p class="text-xs text-slate-400">

                Logged in as

            </p>

            <h4 class="font-semibold mt-1">

                {{ Auth::user()->name }}

            </h4>

            <form
                method="POST"
                action="{{ route('logout') }}"
                class="mt-5">

                @csrf

                <button
                    type="submit"
                    class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 hover:bg-red-500/20 hover:text-red-300 active:scale-[0.98] transition-all duration-200 font-medium tracking-wide shadow-lg shadow-red-950/20">
                    
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    
                    Logout

                </button>

            </form>

        </div>

    </div>

</aside>

<div
    id="sidebarOverlay"
    class="fixed inset-0 bg-black/50 hidden z-40 lg:hidden">
</div>