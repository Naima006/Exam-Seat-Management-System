<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    {{-- Department --}}
    <div>

        <label class="block mb-2 font-medium text-slate-300">
            Department <span class="text-red-400">*</span>
        </label>

        <select
            name="department_id"
            class="input w-full @error('department_id') border-red-500 @enderror">

            <option value="">Select Department</option>

            @foreach($departments as $department)

                <option
                    value="{{ $department->id }}"
                    {{ old('department_id', $course->department_id ?? '') == $department->id ? 'selected' : '' }}>

                    {{ $department->department_name }}

                </option>

            @endforeach

        </select>

        @error('department_id')
            <p class="text-red-400 text-sm mt-2">
                {{ $message }}
            </p>
        @enderror

    </div>

    {{-- Semester --}}
    <div>

        <label class="block mb-2 font-medium text-slate-300">
            Semester <span class="text-red-400">*</span>
        </label>

        <select
            name="semester"
            class="input w-full @error('semester') border-red-500 @enderror">

            @for($i=1;$i<=12;$i++)

                <option
                    value="{{ $i }}"
                    {{ old('semester', $course->semester ?? '') == $i ? 'selected' : '' }}>

                    Semester {{ $i }}

                </option>

            @endfor

        </select>

        @error('semester')
            <p class="text-red-400 text-sm mt-2">
                {{ $message }}
            </p>
        @enderror

    </div>

    {{-- Course Name --}}
    <div>

        <label class="block mb-2 font-medium text-slate-300">
            Course Name <span class="text-red-400">*</span>
        </label>

        <input
            type="text"
            name="course_name"
            class="input w-full @error('course_name') border-red-500 @enderror"
            value="{{ old('course_name',$course->course_name ?? '') }}"
            placeholder="Object Oriented Programming">

        @error('course_name')
            <p class="text-red-400 text-sm mt-2">
                {{ $message }}
            </p>
        @enderror

    </div>

    {{-- Course Code --}}
    <div>

        <label class="block mb-2 font-medium text-slate-300">
            Course Code <span class="text-red-400">*</span>
        </label>

        <input
            type="text"
            name="course_code"
            class="input w-full @error('course_code') border-red-500 @enderror"
            value="{{ old('course_code',$course->course_code ?? '') }}"
            placeholder="CSE-221">

        @error('course_code')
            <p class="text-red-400 text-sm mt-2">
                {{ $message }}
            </p>
        @enderror

    </div>

</div>

<div class="flex justify-end gap-4 mt-8">

    <a
        href="{{ route('courses.index') }}"
        class="btn btn-outline">

        Cancel

    </a>

    <button
        type="submit"
        class="btn btn-primary">

        {{ isset($course) ? 'Update Course' : 'Save Course' }}

    </button>

</div>