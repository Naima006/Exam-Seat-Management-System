<tbody id="studentTableBody">

@forelse($students as $student)

<tr class="hover:bg-white/5 transition border-b border-white/5">

    <td>
        {{ $loop->iteration + ($students->currentPage()-1) * $students->perPage() }}
    </td>

    <td>
        <span class="font-semibold text-blue-400">
            {{ $student->student_id }}
        </span>
    </td>

    <td>
        {{ $student->student_name }}
    </td>

    <td>
        {{ $student->department->department_name }}
    </td>

    <td>
        {{ $student->course->course_name }}
    </td>

    <td>
        {{ $student->batch }}
    </td>

    <td class="text-center whitespace-nowrap">

        <div class="flex justify-center items-center gap-2">

            {{-- Edit --}}
            <a
                href="{{ route('students.edit', $student) }}"
                class="p-2 rounded-lg bg-blue-500/10 border border-blue-500/20 text-blue-400 hover:bg-blue-500/20 transition-all duration-200"
                title="Edit Student">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-4 h-4"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.5-9.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z"/>

                </svg>

            </a>

            {{-- Delete --}}
            <form
                action="{{ route('students.destroy',$student) }}"
                method="POST"
                class="delete-form inline">

                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="p-2 rounded-lg bg-red-500/10 border border-red-500/20 text-red-400 hover:bg-red-500/20 transition-all duration-200"
                    title="Delete Student">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-4 h-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M19 7H5m2 0V5a2 2 0 012-2h6a2 2 0 012 2v2m-9 0v12a2 2 0 002 2h6a2 2 0 002-2V7m-10 11V11m4 7V11"/>

                    </svg>

                </button>

            </form>

        </div>

    </td>

</tr>

@empty

<tr>

    <td colspan="7" class="text-center py-16">

        <div class="space-y-3">

            <div class="text-6xl">
                🎓
            </div>

            <h3 class="text-2xl font-semibold">
                No Students Found
            </h3>

            <p class="text-slate-400">
                Try another search keyword.
            </p>

        </div>

    </td>

</tr>

@endforelse

</tbody>