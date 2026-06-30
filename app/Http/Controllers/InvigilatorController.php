<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Invigilator;
use Illuminate\Http\Request;
use App\Http\Requests\StoreInvigilatorRequest;
use App\Http\Requests\UpdateInvigilatorRequest;

class InvigilatorController extends Controller
{
    /**
     * Display all invigilators.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $invigilators = Invigilator::with('department')

            ->when($search, function ($query) use ($search) {

                $query->where('name', 'LIKE', "%{$search}%")
                      ->orWhere('email', 'LIKE', "%{$search}%")
                      ->orWhere('phone', 'LIKE', "%{$search}%")
                      ->orWhereHas('department', function ($q) use ($search) {

                          $q->where('department_name', 'LIKE', "%{$search}%");

                      });

            })

            ->latest()

            ->paginate(10)

            ->withQueryString();

        return view('invigilators.index', [

            'invigilators' => $invigilators,

            'totalInvigilators' => Invigilator::count(),

            'totalDepartments' => Department::count(),

        ]);
    }

    /**
     * Show create form.
     */
    public function create()
    {
        $departments = Department::orderBy('department_name')->get();

        return view('invigilators.create', compact('departments'));
    }

    /**
     * Store new invigilator.
     */
    public function store(StoreInvigilatorRequest $request)
    {
        Invigilator::create($request->validated());

        return redirect()

            ->route('invigilators.index')

            ->with('success','Invigilator added successfully.');
    }

    /**
     * Display details.
     */
    public function show(Invigilator $invigilator)
    {
        $invigilator->load('department');

        return view('invigilators.show', compact('invigilator'));
    }

    /**
     * Edit form.
     */
    public function edit(Invigilator $invigilator)
    {
        $departments = Department::orderBy('department_name')->get();

        return view('invigilators.edit', compact(

            'invigilator',

            'departments'

        ));
    }

    /**
     * Update.
     */
    public function update(UpdateInvigilatorRequest $request, Invigilator $invigilator)
    {
        $invigilator->update($request->validated());

        return redirect()

            ->route('invigilators.index')

            ->with('success','Invigilator updated successfully.');
    }

    /**
     * Delete.
     */
    public function destroy(Invigilator $invigilator)
    {
        $invigilator->delete();

        return redirect()

            ->route('invigilators.index')

            ->with('success','Invigilator deleted successfully.');
    }
}