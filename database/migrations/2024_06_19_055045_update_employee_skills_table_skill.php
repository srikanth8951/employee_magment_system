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
            if (Schema::hasColumn('employee_skills', 'skill')) {
                $table->dropColumn('skill');
            }
            if (Schema::hasColumn('employee_skills', 'id')) {
                $table->dropColumn('id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employee_skills', function (Blueprint $table) {
            // You may want to recreate the columns if needed
            if (!Schema::hasColumn('employee_skills', 'skill')) {
                $table->string('skill')->nullable();
            }
            if (!Schema::hasColumn('employee_skills', 'id')) {
                $table->increments('id');
            }
        });
    }
};
