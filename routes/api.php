<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\EmployeeSkillController;
use App\Http\Controllers\Api\SkillController;

Route::apiResource('employees', EmployeeController::class);
Route::apiResource('employees.skills', SkillController::class)->shallow();
Route::delete('employee-skills/{employeeId}/{skillId}', [EmployeeSkillController::class, 'destroy']);

// Add this route for toggling availability
Route::patch('employees/{employee}/toggle-availability', [EmployeeController::class, 'toggleAvailability']);


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
