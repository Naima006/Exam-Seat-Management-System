<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    {{-- Room Number --}}
    <div>

        <label class="block mb-2 font-medium text-slate-300">
            Room Number <span class="text-red-400">*</span>
        </label>

        <input
            type="text"
            name="room_no"
            value="{{ old('room_no', $room->room_no ?? '') }}"
            class="input w-full @error('room_no') border-red-500 @enderror"
            placeholder="e.g. A-101">

        @error('room_no')
            <p class="text-red-400 text-sm mt-2">
                {{ $message }}
            </p>
        @enderror

    </div>

    {{-- Building --}}
    <div>

        <label class="block mb-2 font-medium text-slate-300">
            Building no <span class="text-red-400">*</span>
        </label>

        <input
            type="text"
            name="building"
            value="{{ old('building', $room->building ?? '') }}"
            class="input w-full @error('building') border-red-500 @enderror"
            placeholder="Engineering Block">

        @error('building')
            <p class="text-red-400 text-sm mt-2">
                {{ $message }}
            </p>
        @enderror

    </div>

    {{-- Capacity --}}
    <div>

        <label class="block mb-2 font-medium text-slate-300">
            Capacity <span class="text-red-400">*</span>
        </label>

        <input
            type="number"
            min="1"
            name="capacity"
            value="{{ old('capacity', $room->capacity ?? '') }}"
            class="input w-full @error('capacity') border-red-500 @enderror"
            placeholder="40">

        @error('capacity')
            <p class="text-red-400 text-sm mt-2">
                {{ $message }}
            </p>
        @enderror

    </div>

    {{-- Status --}}
   <div>

    <label class="block mb-2 font-medium text-slate-300">
        Status
    </label>

    <select
        name="status"
        class="input w-full">

        <option value="Active"
            {{ old('status', $room->status ?? 'Active') == 'Active' ? 'selected' : '' }}>
            Active
        </option>

        <option value="Inactive"
            {{ old('status', $room->status ?? '') == 'Inactive' ? 'selected' : '' }}>
            Inactive
        </option>

    </select>

</div>

</div>

{{-- Buttons --}}
<div class="flex justify-end gap-4 mt-8">

    <a href="{{ route('rooms.index') }}"
       class="btn btn-outline">

        Cancel

    </a>

    <button
        type="submit"
        class="btn btn-primary">

        {{ isset($room) ? 'Update Room' : 'Save Room' }}

    </button>

</div>