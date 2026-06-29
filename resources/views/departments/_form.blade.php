<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    {{-- Department Name --}}
    <div>

        <label for="department_name" class="label">

            Department Name <span class="text-red-400">*</span>

        </label>

        <input
            type="text"
            id="department_name"
            name="department_name"
            class="input"
            placeholder="e.g. Software Engineering"
            value="{{ old('department_name', $department->department_name ?? '') }}"
            required>

        @error('department_name')

            <p class="text-sm text-red-400 mt-2">

                {{ $message }}

            </p>

        @enderror

    </div>

    {{-- Department Code --}}
    <div>

        <label for="department_code" class="label">

            Department Code <span class="text-red-400">*</span>

        </label>

        <input
            type="text"
            id="department_code"
            name="department_code"
            class="input"
            placeholder="e.g. SWE"
            value="{{ old('department_code', $department->department_code ?? '') }}"
            required>

        @error('department_code')

            <p class="text-sm text-red-400 mt-2">

                {{ $message }}

            </p>

        @enderror

    </div>

</div>

<div class="flex justify-end gap-3 mt-8">

    <a
        href="{{ route('departments.index') }}"
        class="btn btn-outline">

        Cancel

    </a>

    <button
        type="submit"
        class="btn btn-primary loading-btn">

        {{ isset($department) ? 'Update Department' : 'Save Department' }}

    </button>

</div>