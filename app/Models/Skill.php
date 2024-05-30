<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'skill'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
