<div class="table-container">

    <table class="table w-full">

        <thead>
            <tr>
                <th>Student ID</th>
                <th>Student Name</th>
                <th>Course</th>
                <th>Exam Date</th>
                <th class="text-center">Room</th>

                <th class="text-center">
                    Seat
                </th>

                <th class="text-center">
                    Row / Column
                </th>

                <th class="text-center">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Actions
                </th>
            </tr>
        </thead>

        <tbody>

        @forelse($allocations as $allocation)

            <tr>

                <td>
                    {{ optional($allocation->student)->student_id ?? 'N/A' }}
                </td>

                <td>
                    {{ optional($allocation->student)->student_name ?? 'N/A' }}
                </td>

                <td>
                    {{ optional(optional($allocation->exam)->course)->course_name ?? 'N/A' }}
                </td>

                <td>
                    {{ optional($allocation->exam?->exam_date)?->format('d M Y') ?? 'N/A' }}
                </td>

                <td>

                    <strong>

                        {{ optional($allocation->room)->room_no ?? 'N/A' }}

                    </strong>

                    <br>

                    <small class="text-slate-400">

                        {{ optional($allocation->room)->building }}

                    </small>

                </td>

                <td>

                    <span class="badge badge-primary">

                        Seat {{ $allocation->seat_number }}

                    </span>

                </td>

                <td>

                    R{{ $allocation->row_no }}

                    /

                    C{{ $allocation->column_no }}

                </td>


                <td>

                        <div class="flex items-center justify-center gap-2 flex-wrap">

                            <a
                                href="{{ route('seat-allocations.show', $allocation) }}"
                                class="btn btn-outline">

                                View

                            </a>

                            <a
                                href="{{ route('seat-allocations.edit', $allocation) }}"
                                class="btn btn-warning">

                                Edit

                            </a>

                            <form
                                method="POST"
                                action="{{ route('seat-allocations.destroy', $allocation) }}">

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn btn-danger confirm-delete">

                                    Delete

                                </button>

                            </form>

                        </div>

                </td>

            </tr>

        @empty

            <tr>

                <td colspan="9" class="text-center py-10 text-slate-400">

                    No seat allocations found.

                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

</div>

<div class="p-5">

    {{ $allocations->links() }}

</div>