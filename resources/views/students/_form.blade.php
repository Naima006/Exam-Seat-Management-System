<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    {{-- Student ID --}}
    <div>
        <label class="block mb-2 font-medium">
            Student ID
        </label>

        <input
            type="text"
            name="student_id"
            class="input w-full"
            placeholder="e.g. 221-15-5234"
            value="{{ old('student_id', $student->student_id ?? '') }}">

        @error('student_id')
            <p class="text-red-400 text-sm mt-2">
                {{ $message }}
            </p>
        @enderror
    </div>


    {{-- Student Name --}}
    <div>
        <label class="block mb-2 font-medium">
            Student Name
        </label>

        <input
            type="text"
            name="student_name"
            class="input w-full"
            placeholder="Enter student name"
            value="{{ old('student_name', $student->student_name ?? '') }}">

        @error('student_name')
            <p class="text-red-400 text-sm mt-2">
                {{ $message }}
            </p>
        @enderror
    </div>


    {{-- Department --}}
    <div>
        <label class="block mb-2 font-medium">
            Department
        </label>

        <select
            id="department"
            name="department_id"
            class="input w-full">

            <option value="">
                Select Department
            </option>

            @foreach($departments as $department)

                <option
                    value="{{ $department->id }}"
                    {{ old('department_id', $student->department_id ?? '') == $department->id ? 'selected' : '' }}>

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


    {{-- Course --}}
    <div>
        <label class="block mb-2 font-medium">
            Course
        </label>

        <select
            id="course"
            name="course_id"
            class="input w-full">

            <option value="">
                Select Course
            </option>

            @foreach($courses as $course)

                <option
                    value="{{ $course->id }}"
                    data-department="{{ $course->department_id }}"
                    {{ old('course_id', $student->course_id ?? '') == $course->id ? 'selected' : '' }}>

                    {{ $course->course_name }}

                </option>

            @endforeach

        </select>

        @error('course_id')
            <p class="text-red-400 text-sm mt-2">
                {{ $message }}
            </p>
        @enderror
    </div>


    {{-- Batch --}}
    <div>
        <label class="block mb-2 font-medium">
            Batch
        </label>

        <input
            type="number"
            name="batch"
            min="1"
            class="input w-full"
            placeholder="e.g. 61"
            value="{{ old('batch', $student->batch ?? '') }}">

        @error('batch')
            <p class="text-red-400 text-sm mt-2">
                {{ $message }}
            </p>
        @enderror
    </div>

</div>

<div class="flex justify-end gap-4 mt-8">

    <a
        href="{{ route('students.index') }}"
        class="btn btn-outline">

        Cancel

    </a>

    <button
        type="submit"
        class="btn btn-primary loading-btn">

        Save Student

    </button>
    
    @push('scripts')

    <script>

        document.addEventListener('DOMContentLoaded', () => {

            const department = document.getElementById('department');
            const course = document.getElementById('course');

            // Current course (used when editing)
            const selectedCourse = "{{ old('course_id', $student->course_id ?? '') }}";

            function loadCourses(departmentId, selected = '') {

                course.innerHTML = '<option value="">Loading...</option>';

                if (!departmentId) {

                    course.innerHTML = '<option value="">Select Course</option>';
                    return;

                }

                fetch(`/departments/${departmentId}/courses`)
                    .then(response => response.json())
                    .then(data => {

                        course.innerHTML = '<option value="">Select Course</option>';

                        data.forEach(item => {

                            const option = document.createElement('option');

                            option.value = item.id;
                            option.textContent = `${item.course_name} (${item.course_code})`;

                            if (selected == item.id) {
                                option.selected = true;
                            }

                            course.appendChild(option);

                        });

                    });

            }

            // When department changes
            department.addEventListener('change', function () {

                loadCourses(this.value);

            });

            // Automatically load courses on page load (Edit page)
            if (department.value) {

                loadCourses(department.value, selectedCourse);

            }

        });

    </script>

@endpush

</div>