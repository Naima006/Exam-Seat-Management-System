<section>

    <div class="mb-8">

        <h2 class="text-2xl font-bold">
            Profile Information
        </h2>

        <p class="text-slate-400 mt-2">
            Update your personal information and email address.
        </p>

    </div>

    <form id="send-verification"
          method="POST"
          action="{{ route('verification.send') }}">

        @csrf

    </form>


    <form method="POST"
          action="{{ route('profile.update') }}"
          class="space-y-6">

        @csrf
        @method('PATCH')


        {{-- Name --}}
        <div>

            <label for="name"
                   class="block text-sm font-medium text-slate-300 mb-2">

                Full Name

            </label>

            <input
                id="name"
                name="name"
                type="text"
                value="{{ old('name', $user->name) }}"
                required
                autofocus
                autocomplete="name"
                class="input w-full">

            @error('name')

                <p class="text-red-400 text-sm mt-2">

                    {{ $message }}

                </p>

            @enderror

        </div>


        {{-- Email --}}
        <div>

            <label for="email"
                   class="block text-sm font-medium text-slate-300 mb-2">

                Email Address

            </label>

            <input
                id="email"
                name="email"
                type="email"
                value="{{ old('email', $user->email) }}"
                required
                autocomplete="username"
                class="input w-full">

            @error('email')

                <p class="text-red-400 text-sm mt-2">

                    {{ $message }}

                </p>

            @enderror

        </div>


        {{-- Verification Notice --}}
        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())

            <div class="rounded-xl border border-yellow-500/30 bg-yellow-500/10 p-4">

                <p class="text-yellow-300">

                    Your email address has not been verified.

                </p>

                <button
                    form="send-verification"
                    class="mt-3 text-sm font-semibold text-yellow-400 hover:text-yellow-300">

                    Resend Verification Email

                </button>

                @if (session('status') === 'verification-link-sent')

                    <p class="mt-3 text-green-400">

                        Verification email sent successfully.

                    </p>

                @endif

            </div>

        @endif


        {{-- Save Button --}}
        <div class="flex items-center gap-4">

            <button
                type="submit"
                class="btn btn-primary">

                Save Changes

            </button>

            @if (session('status') === 'profile-updated')

                <span class="text-green-400">

                    Profile updated successfully.

                </span>

            @endif

        </div>

    </form>

</section>