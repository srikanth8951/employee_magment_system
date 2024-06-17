<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function store(Request $request, Employee $employee)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'skill' => 'required|string|max:255',
        ]);

        // Check if the skill already exists for the employee
        $existingSkill = $employee->skills()->where('skill', $validated['skill'])->first();

        if ($existingSkill) {
            // If the skill already exists, return a message indicating it already exists
            return response()->json(['message' => 'Skill already exists for this employee.'], 200);
        } else {
            // If the skill does not exist, create a new skill for the employee
            $skill = $employee->skills()->create($validated);
            return response()->json($skill, 201);
        }
    }

    public function update(Request $request, Skill $skill)
    {
        $validated = $request->validate([
            'skill' => 'required|string|max:255',
        ]);

        // Check if the skill already exists for the employee
        $existingSkill = Skill::where('employee_id', $skill->employee_id)
            ->where('skill', $validated['skill'])
            ->first();

        if ($existingSkill) {
            // If the skill exists, return a response indicating the duplicate
            return response()->json(['message' => 'Skill already exists for this employee'], 422);
        }

        // If the skill does not exist, proceed with the update
        $skill->update($validated);

        return response()->json($skill);
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();

        return response()->json(null, 204);
    }
}
