<header
    class="sticky top-0 z-30">

    <div
        class="card flex items-center justify-between px-6 py-4 mx-4 mt-4">

        {{-- Left --}}

        <div class="flex items-center gap-4">

            {{-- Mobile Menu --}}

            <button
                id="sidebarToggle"
                class="lg:hidden text-white hover:text-blue-400 transition">

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="w-7 h-7"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16"/>

                </svg>

            </button>

            <div>

                <h2 class="text-2xl font-bold">

                    @yield('title','Dashboard')

                </h2>

                <p class="text-slate-400 text-sm">

                    Welcome back,
                    <span class="text-white font-medium">
                        {{ Auth::user()->name }}
                    </span>

                </p>

            </div>

        </div>

        {{-- Right --}}

        <div class="flex items-center gap-4">

            {{-- Search --}}

            <div class="hidden md:block relative">

                <input
                    id="globalSearch"
                    type="text"
                    placeholder="Search..."
                    class="input w-72 pl-10">

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 absolute left-3 top-3.5 text-slate-400"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z"/>

                </svg>

            </div>

            {{-- Notification Button --}}

            <button
                class="relative p-2 rounded-xl hover:bg-white/10 transition">

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="w-6 h-6"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M15 17h5l-1.4-1.4A2 2 0 0118 14.17V11a6 6 0 10-12 0v3.17a2 2 0 01-.6 1.43L4 17h5m6 0a3 3 0 11-6 0"/>

                </svg>

                <span
                    class="absolute top-1 right-1 w-2 h-2 rounded-full bg-red-500">

                </span>

            </button>

            {{-- User Dropdown --}}

            <div class="relative">

                <button
                    id="profileButton"
                    class="flex items-center gap-3 rounded-xl hover:bg-white/10 px-3 py-2 transition">

                    <div
                        class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center font-bold">

                        {{ strtoupper(substr(Auth::user()->name,0,1)) }}

                    </div>

                    <div class="hidden md:block text-left">

                        <p class="font-semibold">

                            {{ Auth::user()->name }}

                        </p>

                        <p class="text-xs text-slate-400">

                            Administrator

                        </p>

                    </div>

                </button>

                {{-- Dropdown --}}

                <div
                    id="profileMenu"
                    class="hidden absolute right-0 mt-3 w-56 card p-2">

                    <a
                        href="{{ route('profile.edit') }}"
                        class="block px-4 py-3 rounded-xl hover:bg-white/10 transition">

                        Profile

                    </a>

                    <hr class="border-white/10 my-2">

                    <form
                        method="POST"
                        action="{{ route('logout') }}">

                        @csrf

                        <button
                            type="submit"
                            class="w-full text-left px-4 py-3 rounded-xl hover:bg-red-500/20 transition">

                            Logout

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</header>