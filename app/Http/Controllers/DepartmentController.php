<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of departments.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $departments = Department::query()

            ->when($search, function ($query) use ($search) {

                $query->where(function ($q) use ($search) {

                    $q->where('department_name', 'LIKE', "%{$search}%")
                      ->orWhere('department_code', 'LIKE', "%{$search}%");

                });

            })

            ->latest()

            ->paginate(10)

            ->withQueryString();

        // Dashboard Statistics
        $statistics = [

            // Total departments
            'totalDepartments' => Department::count(),

            // Departments added today
            'departmentsAddedToday' => Department::whereDate(
                'created_at',
                today()
            )->count(),

            // Latest department
            'latestDepartment' => Department::latest()->first(),

        ];

        return view(
            'departments.index',
            array_merge(
                compact('departments'),
                $statistics
            )
        );
    }

    /**
     * Show create form.
     */
    public function create()
    {
        return view('departments.create');
    }

    /**
     * Store new department.
     */
    public function store(StoreDepartmentRequest $request)
    {
        Department::create($request->validated());

        return redirect()
            ->route('departments.index')
            ->with('success', 'Department has been added successfully.');
    }

    /**
     * Display department details.
     */
    public function show(Department $department)
    {
        return view('departments.show', compact('department'));
    }

    /**
     * Show edit form.
     */
    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

    /**
     * Update department.
     */
    public function update(
        UpdateDepartmentRequest $request,
        Department $department
    ) {
        $department->update($request->validated());

        return redirect()
            ->route('departments.index')
            ->with('success', 'Department updated successfully.');
    }

    /**
     * Delete department.
     */
    public function destroy(Department $department)
    {
        $department->delete();

        return redirect()
            ->route('departments.index')
            ->with('success', 'Department deleted successfully.');
    }
}