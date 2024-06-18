<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeSkill extends Model
{
    protected $table = 'employee_skills';

    protected $fillable = [
        'employee_id',
        'skill_id',
        // Add other fillable fields here if needed
    ];

    // Define relationships if needed
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function skill()
    {
        return $this->belongsTo(Skill::class);
    }
}
