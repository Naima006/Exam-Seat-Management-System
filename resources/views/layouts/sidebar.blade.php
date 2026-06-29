<aside id="sidebar"
    class="sidebar glass flex flex-col justify-between">

    <div>

        {{-- Logo --}}
        <div class="mb-10">

            <h1 class="text-2xl font-bold tracking-wide text-white">

                🎓 ExamSeat

            </h1>

            <p class="text-sm text-slate-400 mt-1">

                Management System

            </p>

        </div>

        {{-- Navigation --}}
        <nav class="space-y-2">

            <a href="{{ route('dashboard') }}"
                class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">

                <span>🏠</span>

                <span>Dashboard</span>

            </a>

            <a href="#"
                class="sidebar-link {{ request()->routeIs('departments.*') ? 'active' : '' }}">  //href="{{ route('departments.index') }}"

                <span>🏢</span>

                <span>Departments</span>

            </a>

            <a href="#"
                class="sidebar-link {{ request()->routeIs('courses.*') ? 'active' : '' }}">  //href="{{ route('courses.index') }}"

                <span>📚</span>

                <span>Courses</span>

            </a>

            <a href="#"
                class="sidebar-link {{ request()->routeIs('students.*') ? 'active' : '' }}">

                <span>🎓</span>

                <span>Students</span>

            </a>

            <a href="#"
                class="sidebar-link {{ request()->routeIs('rooms.*') ? 'active' : '' }}">

                <span>🏫</span>

                <span>Rooms</span>

            </a>

            <a href="#"
                class="sidebar-link {{ request()->routeIs('invigilators.*') ? 'active' : '' }}">  //href="{{ route('invigilators.index') }}"

                <span>👨‍🏫</span>

                <span>Invigilators</span>

            </a>

            <a href="#"
                class="sidebar-link {{ request()->routeIs('exams.*') ? 'active' : '' }}"> //href="{{ route('exams.index') }}"

                <span>📝</span>

                <span>Exams</span>

            </a>

            <a href="#"
                class="sidebar-link {{ request()->routeIs('seat-allocations.*') ? 'active' : '' }}"> //href="{{ route('seat-allocations.index') }}"

                <span>💺</span>

                <span>Seat Allocation</span>

            </a>

            <a href="#"
                class="sidebar-link {{ request()->routeIs('reports.*') ? 'active' : '' }}">

                <span>📊</span>

                <span>Reports</span>

            </a>

        </nav>

    </div>

    {{-- Bottom --}}

    <div class="pt-6 border-t border-white/10">

        <div class="text-sm text-slate-400 mb-3">

            Logged in as

        </div>

        <div class="font-semibold text-white mb-5">

            {{ Auth::user()->name }}

        </div>

        <form method="POST" action="{{ route('logout') }}">

            @csrf

            <button
                class="btn btn-danger w-full">

                Logout

            </button>

        </form>

    </div>

</aside>