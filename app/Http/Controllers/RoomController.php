<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of rooms.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $rooms = Room::query()

            ->when($search, function ($query) use ($search) {

                $query->where(function ($q) use ($search) {

                    $q->where('room_no', 'LIKE', "%{$search}%")
                      ->orWhere('building', 'LIKE', "%{$search}%");

                });

            })

            ->latest()

            ->paginate(10)

            ->withQueryString();

        // Statistics
        $statistics = [

            'totalRooms' => Room::count(),

            'activeRooms' => Room::where('status', 'Active')->count(),

            'inactiveRooms' => Room::where('status', 'Inactive')->count(),

            'totalCapacity' => Room::sum('capacity'),

            'averageCapacity' => round(Room::avg('capacity') ?? 0),

        ];

        return view('rooms.index', array_merge(
            compact('rooms'),
            $statistics
        ));
    }

    /**
     * Show the form for creating a room.
     */
    public function create()
    {
        return view('rooms.create');
    }

    /**
     * Store a newly created room.
     */
    public function store(StoreRoomRequest $request)
    {
        Room::create($request->validated());

        return redirect()

            ->route('rooms.index')

            ->with('success', 'Room has been added successfully.');
    }

    /**
     * Display room details.
     */
    public function show(Room $room)
    {
        return view('rooms.show', compact('room'));
    }

    /**
     * Show edit form.
     */
    public function edit(Room $room)
    {
        return view('rooms.edit', compact('room'));
    }

    /**
     * Update room.
     */
    public function update(UpdateRoomRequest $request, Room $room)
    {
        $room->update($request->validated());

        return redirect()

            ->route('rooms.index')

            ->with('success', 'Room information updated successfully.');
    }

    /**
     * Delete room.
     */
    public function destroy(Room $room)
    {
        $room->delete();

        return redirect()

            ->route('rooms.index')

            ->with('success', 'Room deleted successfully.');
    }
}