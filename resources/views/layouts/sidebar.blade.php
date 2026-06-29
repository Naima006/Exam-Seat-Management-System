<aside
    id="sidebar"
    class="sidebar fixed inset-y-0 left-0 z-50 w-72 -translate-x-full lg:translate-x-0 transition-transform duration-300">

    <div class="card h-full flex flex-col mx-4 my-4 p-6">

        <!-- Mobile Close -->
        <div class="flex justify-end lg:hidden mb-2">

            <button
                id="sidebarClose"
                class="text-slate-300 hover:text-white text-2xl">

                &times;

            </button>

        </div>

        <!-- Logo -->

        <div class="mb-10">

            <h1 class="text-2xl font-bold tracking-wide">

                ExamSeat

            </h1>

            <p class="text-slate-400 text-sm mt-1">

                Management System

            </p>

        </div>

        <!-- Navigation -->

        <nav class="flex-1 space-y-2">

            {{-- Dashboard --}}

            <a href="{{ route('dashboard') }}"
                class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">

                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M3 12l9-9 9 9M4 10v10h16V10"/>

                </svg>

                Dashboard

            </a>

            <a href="{{ route('departments.index') }}"
            class="sidebar-link {{ request()->routeIs('departments.*') ? 'active' : '' }}">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M3 7h18M3 12h18M3 17h18"/>

                </svg>

                Departments

            </a>

            <a href="#"
                class="sidebar-link">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 6v12M6 12h12"/>

                </svg>

                Courses

            </a>

            <a href="#" class="sidebar-link">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">

                    <!-- Graduation Cap Path -->
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 14l9-5-9-5-9 5 9 5zm0 0v6m4.5-2.5v1.8c0 .8-.7 1.4-1.5 1.4H9c-.8 0-1.5-.6-1.5-1.4v-1.8"/>

                </svg>

                Students

            </a>

            <a href="{{ route('rooms.index') }}"
    class="sidebar-link {{ request()->routeIs('rooms.*') ? 'active' : '' }}">

    <svg xmlns="http://www.w3.org/2000/svg"
        class="w-5 h-5"
        fill="none"
        stroke="currentColor"
        viewBox="0 0 24 24">

        <path stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M8 7V3h8v4m4 0H4v14h16V7z"/>

    </svg>

    Rooms

</a>

            <a href="#"
                class="sidebar-link">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-3.33 0-6 2.67-6 6h12c0-3.33-2.67-6-6-6z"/>

                </svg>

                Invigilators

            </a>

            <a href="#"
                class="sidebar-link">

                📝 Exams

            </a>

            <a href="#"
                class="sidebar-link">

                💺 Seat Allocation

            </a>

            <a href="#"
                class="sidebar-link">

                📊 Reports

            </a>

        </nav>

        <!-- Bottom -->

        <div class="pt-6 mt-6 border-t border-white/10">

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
                    class="btn btn-danger w-full">

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