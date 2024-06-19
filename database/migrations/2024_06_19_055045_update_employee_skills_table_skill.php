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
            if (!Schema::hasColumn('employee_skills', 'id')) {
                $table->dropColumn('id'); // Optional: remove this if you don't need the auto-incrementing ID
            }
            // Add or modify the skill column to be nullable
            if (!Schema::hasColumn('employee_skills', 'skill')) {
                $table->string('skill')->nullable();
            } else {
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
            $table->dropColumn('skill');
            $table->bigIncrements('id'); // Optional: add this back if you removed it
        });
    }
};
