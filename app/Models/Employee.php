<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    
    protected $fillable = ['first_name', 'last_name', 'field_of_employment', 'about', 'available'];

    public function skills()
    {
        return $this->hasMany(Skill::class);
    }
}
