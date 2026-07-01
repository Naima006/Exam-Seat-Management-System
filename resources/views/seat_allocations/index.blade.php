@extends('layouts.app')

@section('title', 'Seat Allocations')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="card p-6">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

            <div>

                <h1 class="text-3xl font-bold">
                    Seat Allocations
                </h1>

                <p class="text-slate-400 mt-2">
                    Generate and manage examination seat allocations.
                </p>

            </div>

            <div class="flex flex-wrap gap-3">

                <a
                    href="{{ route('seat-allocations.lookup') }}"
                    class="btn btn-outline">

                    Student Lookup

                </a>

                <a
                    href="{{ route('seat-allocations.room-invigilators') }}"
                    class="btn btn-outline">

                    Room Invigilators

                </a>

                <button
                    type="button"
                    id="openExportModal"
                    class="btn btn-outline pdf-btn">

                    <span class="pdf-icon">📄</span>

                    Export PDF

                </button>

                <a
                    href="{{ route('seat-allocations.create') }}"
                    class="btn btn-primary">

                    Generate Seating

                </a>

            </div>

        </div>

    </div>

    {{-- Statistics --}}
    <div class="grid grid-cols-1 md:grid-cols-3 xl:grid-cols-3 gap-5">

        <div class="card stat-card">

            <p class="stat-title">
                Total Allocations
            </p>

            <h2 class="stat-value">

                {{ $totalAllocations }}

            </h2>

        </div>

        <div class="card stat-card">

            <p class="stat-title">
                Total Rooms Used
            </p>

            <h2 class="stat-value">

                {{ $totalRooms }}

            </h2>

        </div>

        <div class="card stat-card">

            <p class="stat-title">
                Total Invigilators Assigned
            </p>

            <h2 class="stat-value">

                {{ $totalInvigilators }}

            </h2>

        </div>

    </div>

    
    {{-- Search --}}
    <div class="card p-5">

        <form
            method="GET"
            action="{{ route('seat-allocations.index') }}">

            <div class="flex flex-col md:flex-row gap-4">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search by Student ID or Student Name."
                    class="input flex-1">

                <div class="flex gap-3">

                    <button
                        type="submit"
                        class="btn btn-primary">

                        Search

                    </button>

                    @if(request()->filled('search'))

                        <a
                            href="{{ route('seat-allocations.index') }}"
                            class="btn btn-outline">

                            Reset

                        </a>

                    @endif

                </div>

            </div>

        </form>

    </div>

    {{-- Table --}}
    <div class="card overflow-hidden">

        @include('seat_allocations.partials.table')

    </div>

</div>

{{-- Export PDF Modal --}}

<div
    id="exportModal"
    class="fixed inset-0 bg-black/60 backdrop-blur-sm hidden z-50 flex items-center justify-center">

    <div class="card w-full max-w-lg p-8 relative">

        <button
            id="closeExportModal"
            class="absolute top-5 right-5 text-slate-400 hover:text-white text-xl">

            ✕

        </button>

        <h2 class="text-2xl font-bold mb-2">

            Export Seating Plan

        </h2>

        <p class="text-slate-400 mb-6">

            Select an examination session to generate the seating report.

        </p>

        <form
            method="GET"
            action="{{ route('seat-allocations.export.pdf') }}">

            <div class="space-y-5">

                <div>

                    <label class="block mb-2 font-semibold">

                        Examination Date

                    </label>

                    <input
                        type="date"
                        name="exam_date"
                        class="input w-full"
                        required>

                </div>

                <div>

                    <label class="block mb-2 font-semibold">

                        Start Time

                    </label>

                    <input
                        type="time"
                        name="start_time"
                        class="input w-full"
                        required>

                </div>

            </div>

            <div class="flex justify-end gap-3 mt-8">

                <button
                    type="button"
                    id="cancelExport"
                    class="btn btn-outline">

                    Cancel

                </button>

                <button
                    class="btn btn-primary">

                    Export PDF

                </button>

            </div>

        </form>

    </div>

</div>

@endsection

@push('styles')

<style>

.pdf-btn{

    transition:.25s ease;

}

.pdf-btn:hover{

    border-color:#ef4444;

    transform:translateY(-2px);

    box-shadow:0 10px 20px rgba(239,68,68,.18);

}

.pdf-icon{

    font-size:16px;

    margin-right:6px;

}

</style>

@endpush

@push('scripts')

<script>

const exportModal = document.getElementById('exportModal');

document
.getElementById('openExportModal')
.addEventListener('click',()=>{

    exportModal.classList.remove('hidden');

});

document
.getElementById('closeExportModal')
.addEventListener('click',()=>{

    exportModal.classList.add('hidden');

});

document
.getElementById('cancelExport')
.addEventListener('click',()=>{

    exportModal.classList.add('hidden');

});

exportModal.addEventListener('click',(e)=>{

    if(e.target===exportModal){

        exportModal.classList.add('hidden');

    }

});

</script>

@endpush

@push('scripts')
<script>
document.querySelectorAll('.confirm-delete').forEach(button => {
    button.addEventListener('click', function(e) {
        e.preventDefault();
        let form = this.closest('form');
        
        // Direct boolean check for your specific light theme class token
        const isLightTheme = document.body.classList.contains('light-theme');
        
        Swal.fire({
            title: 'Delete Seat Allocation?',
            text: "This action cannot be undone.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Yes, Delete',
            cancelButtonText: 'Cancel',
            
            // Explicitly force light or dark color values based on the theme state
            background:'#ffffff',
            color:'#0f172a',
            
            customClass: {
                popup: 'card'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
</script>
@endpush

