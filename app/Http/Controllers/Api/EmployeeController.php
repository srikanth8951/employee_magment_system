<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Employee::with('skills')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'field_of_employment' => 'required|string|max:255',
            'about' => 'nullable|string',
            'available' => 'boolean',
        ]);

        $employee = Employee::create($validated);

        return response()->json($employee, 201);
    }

    public function show(Employee $employee)
    {
        return $employee->load('skills');
    }

    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'first_name' => 'string|max:255',
            'last_name' => 'string|max:255',
            'field_of_employment' => 'string|max:255',
            'about' => 'nullable|string',
            'available' => 'boolean',
        ]);

        $employee->update($validated);

        return response()->json($employee);
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return response()->json(null, 204);
    }

    // Add this method for toggling availability
    public function toggleAvailability(Employee $employee)
    {
        $employee->available = !$employee->available;
        $employee->save();

        return response()->json($employee);
    }
}
