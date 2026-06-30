@csrf

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    {{-- Name --}}
    <div>
        <label class="block mb-2 font-medium">
            Full Name <span class="text-red-500">*</span>
        </label>

        <input
            type="text"
            name="name"
            value="{{ old('name', $invigilator->name ?? '') }}"
            class="input w-full @error('name') border-red-500 @enderror"
            placeholder="Enter full name">

        @error('name')
            <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
        @enderror
    </div>

    {{-- Email --}}
    <div>
        <label class="block mb-2 font-medium">
            Email Address <span class="text-red-500">*</span>
        </label>

        <input
            type="email"
            name="email"
            value="{{ old('email', $invigilator->email ?? '') }}"
            class="input w-full @error('email') border-red-500 @enderror"
            placeholder="example@university.edu">

        @error('email')
            <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
        @enderror
    </div>

    {{-- Phone --}}
    <div>
        <label class="block mb-2 font-medium">
            Phone Number <span class="text-red-500">*</span>
        </label>

        <input
            type="text"
            name="phone"
            value="{{ old('phone', $invigilator->phone ?? '') }}"
            class="input w-full @error('phone') border-red-500 @enderror"
            placeholder="01XXXXXXXXX">

        @error('phone')
            <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
        @enderror
    </div>

    {{-- Department --}}
    <div>
        <label class="block mb-2 font-medium">
            Department <span class="text-red-500">*</span>
        </label>

        <select
            name="department_id"
            class="input w-full @error('department_id') border-red-500 @enderror">

            <option value="">
                Select Department
            </option>

            @foreach($departments as $department)

                <option
                    value="{{ $department->id }}"
                    {{ old('department_id', $invigilator->department_id ?? '') == $department->id ? 'selected' : '' }}>

                    {{ $department->department_name }}

                </option>

            @endforeach

        </select>

        @error('department_id')
            <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
        @enderror

    </div>

</div>

<div class="flex justify-end gap-3 mt-8">

    <a href="{{ route('invigilators.index') }}"
       class="btn btn-outline">

        Cancel

    </a>

    <button
        type="submit"
        class="btn btn-primary">

        {{ isset($invigilator) ? 'Update Invigilator' : 'Save Invigilator' }}

    </button>

</div>