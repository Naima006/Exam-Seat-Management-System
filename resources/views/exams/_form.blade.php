@csrf

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    {{-- Course --}}
    <div>

        <label class="form-label">
            Course
        </label>

        <select
            name="course_id"
            class="input"
            required>

            <option value="">
                Select Course
            </option>

            @foreach($courses as $course)

                <option
                    value="{{ $course->id }}"
                    {{ old('course_id', $exam->course_id ?? '') == $course->id ? 'selected' : '' }}>

                    {{ $course->course_name }}

                </option>

            @endforeach

        </select>

        @error('course_id')

            <p class="text-red-400 text-sm mt-1">

                {{ $message }}

            </p>

        @enderror

    </div>

    {{-- Exam Date --}}
    <div>

        <label class="form-label">
            Exam Date
        </label>

        <input
            type="date"
            name="exam_date"
            class="input"
            value="{{ old('exam_date',$exam->exam_date ?? '') }}"
            required>

        @error('exam_date')

            <p class="text-red-400 text-sm mt-1">

                {{ $message }}

            </p>

        @enderror

    </div>

    {{-- Start Time --}}
    <div>

        <label class="form-label">

            Start Time

        </label>

        <input
            type="time"
            name="start_time"
            class="input"
            value="{{ old('start_time',$exam->start_time ?? '') }}"
            required>

        @error('start_time')

            <p class="text-red-400 text-sm mt-1">

                {{ $message }}

            </p>

        @enderror

    </div>

    {{-- End Time --}}
    <div>

        <label class="form-label">

            End Time

        </label>

        <input
            type="time"
            name="end_time"
            class="input"
            value="{{ old('end_time',$exam->end_time ?? '') }}"
            required>

        @error('end_time')

            <p class="text-red-400 text-sm mt-1">

                {{ $message }}

            </p>

        @enderror

    </div>

</div>

<div class="flex justify-end gap-3 mt-8">

    <a href="{{ route('exams.index') }}"
       class="btn btn-outline">

        Cancel

    </a>

    <button
        class="btn btn-primary">

        {{ $button }}

    </button>

</div>