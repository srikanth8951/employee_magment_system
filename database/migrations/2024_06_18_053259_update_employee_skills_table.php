<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('employee_skills', function (Blueprint $table) {
            // Add the foreign key constraint for skill_id if the column doesn't already exist
            if (!Schema::hasColumn('employee_skills', 'skill_id')) {
                $table->foreignId('skill_id')->constrained('skills')->onDelete('cascade');
            } else {
                // Ensure skill_id is correctly set up as a foreign key
                $table->foreign('skill_id')->references('id')->on('skills')->onDelete('cascade');
            }

            // Ensure the employee_id column is set up correctly as a foreign key
            if (!Schema::hasColumn('employee_skills', 'employee_id')) {
                $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
            } else {
                $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            }

            // Add or modify the skill column to be nullable
            if (!Schema::hasColumn('employee_skills', 'skill')) {
                $table->string('skill')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employee_skills', function (Blueprint $table) {
            // Drop foreign key constraints
            $table->dropForeign(['skill_id']);
            $table->dropForeign(['employee_id']);

            // Drop the skill column if it was added
            $table->dropColumn('skill');

            // Optionally, drop the skill_id column if needed
            // $table->dropColumn('skill_id');
        });
    }
};
