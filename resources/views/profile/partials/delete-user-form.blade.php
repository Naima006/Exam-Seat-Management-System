<section>

    <div class="mb-8">

        <h2 class="text-2xl font-bold text-red-400">
            Delete Account
        </h2>

        <p class="text-slate-400 mt-2">
            Permanently delete your account and all associated data. This action cannot be undone.
        </p>

    </div>


    <div class="rounded-2xl border border-red-500/20 bg-red-500/5 p-6">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

            <div>

                <h3 class="font-semibold text-lg text-white">

                    Danger Zone

                </h3>

                <p class="text-slate-400 mt-2">

                    Once your account is deleted, all your data will be permanently removed.

                </p>

            </div>

            <button
                x-data=""
                x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                class="btn bg-red-600 hover:bg-red-700 text-white">

                Delete Account

            </button>

        </div>

    </div>


    {{-- Confirmation Modal --}}
    <x-modal
        name="confirm-user-deletion"
        :show="$errors->userDeletion->isNotEmpty()"
        focusable>

        <form
            method="POST"
            action="{{ route('profile.destroy') }}"
            class="p-8 space-y-6">

            @csrf
            @method('DELETE')

            <div>

                <h2 class="text-2xl font-bold text-red-500">

                    Confirm Account Deletion

                </h2>

                <p class="mt-3 text-slate-400">

                    This action is permanent. Please enter your password to confirm account deletion.

                </p>

            </div>


            <div>

                <label
                    for="password"
                    class="block text-sm font-medium text-slate-300 mb-2">

                    Password

                </label>

                <input
                    id="password"
                    name="password"
                    type="password"
                    placeholder="Enter your password"
                    class="input w-full">

                @if($errors->userDeletion->has('password'))

                    <p class="text-red-400 text-sm mt-2">

                        {{ $errors->userDeletion->first('password') }}

                    </p>

                @endif

            </div>


            <div class="flex justify-end gap-3">

                <button
                    type="button"
                    x-on:click="$dispatch('close')"
                    class="btn btn-outline">

                    Cancel

                </button>

                <button
                    type="submit"
                    class="btn bg-red-600 hover:bg-red-700 text-white">

                    Delete Account

                </button>

            </div>

        </form>

    </x-modal>

</section>