<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EmployeeSkill;
use Illuminate\Http\Request;

class EmployeeSkillController extends Controller
{
    public function destroy($employeeId, $skillId)
    {
        try {
            // Find the employee skill record to delete
            $deleted = EmployeeSkill::where('employee_id', $employeeId)
                ->where('skill_id', $skillId)
                ->delete();

            if ($deleted) {
                return response()->json(['message' => 'Employee skill deleted successfully']);
            } else {
                return response()->json(['message' => 'Employee skill not found'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete employee skill', 'error' => $e->getMessage()], 500);
        }
    }
}
