<section>

    <div class="mb-8">

        <h2 class="text-2xl font-bold">
            Change Password
        </h2>

        <p class="text-slate-400 mt-2">
            Choose a strong password to keep your account secure.
        </p>

    </div>

    <form method="POST"
          action="{{ route('password.update') }}"
          class="space-y-6">

        @csrf
        @method('PUT')

        {{-- Current Password --}}
        <div>

            <label for="update_password_current_password"
                   class="block text-sm font-medium text-slate-300 mb-2">

                Current Password

            </label>

            <input
                id="update_password_current_password"
                name="current_password"
                type="password"
                autocomplete="current-password"
                class="input w-full">

            @if ($errors->updatePassword->has('current_password'))

                <p class="text-red-400 text-sm mt-2">
                    {{ $errors->updatePassword->first('current_password') }}
                </p>

            @endif

        </div>


        {{-- New Password --}}
        <div>

            <label for="update_password_password"
                   class="block text-sm font-medium text-slate-300 mb-2">

                New Password

            </label>

            <input
                id="update_password_password"
                name="password"
                type="password"
                autocomplete="new-password"
                class="input w-full">

            @if ($errors->updatePassword->has('password'))

                <p class="text-red-400 text-sm mt-2">
                    {{ $errors->updatePassword->first('password') }}
                </p>

            @endif

        </div>


        {{-- Confirm Password --}}
        <div>

            <label for="update_password_password_confirmation"
                   class="block text-sm font-medium text-slate-300 mb-2">

                Confirm New Password

            </label>

            <input
                id="update_password_password_confirmation"
                name="password_confirmation"
                type="password"
                autocomplete="new-password"
                class="input w-full">

            @if ($errors->updatePassword->has('password_confirmation'))

                <p class="text-red-400 text-sm mt-2">
                    {{ $errors->updatePassword->first('password_confirmation') }}
                </p>

            @endif

        </div>


        {{-- Save Button --}}
        <div class="flex items-center gap-4">

            <button
                type="submit"
                class="btn btn-primary">

                Update Password

            </button>

            @if (session('status') === 'password-updated')

                <span class="text-green-400">
                    Password updated successfully.
                </span>

            @endif

        </div>

    </form>

</section>