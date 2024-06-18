<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Skill;
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
            'available' => 'nullable|boolean', // Make 'available' field nullable,
            'skills' => 'nullable|array',
            'skills.*' => 'string|max:255',
        ]);

        $employee->update($validated);

        if (!empty($validated['skills'])) {
            $existingSkills = $employee->skills->pluck('skill')->toArray();
            $newSkills = array_diff($validated['skills'], $existingSkills);

            foreach ($newSkills as $skillName) {
                $skill = Skill::firstOrCreate(['skill' => $skillName]);
                $employee->skills()->attach($skill->id);
            }
        }

        return response()->json($employee->load('skills'), 200);
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        // return response()->json(null, 204);
        return response()->json(['message' => 'Employee deleted successfully']);
    }

    // Add this method for toggling availability
    public function toggleAvailability(Employee $employee)
    {
        $employee->available = !$employee->available;
        $employee->save();

        return response()->json($employee);
    }
}
