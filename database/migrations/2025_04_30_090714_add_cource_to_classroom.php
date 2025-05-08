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
        Schema::table('classroom', function (Blueprint $table) {
            $table->foreignId('course_id')->constrained('course')->after('major_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('classroom', function (Blueprint $table) {
            $table->foreignId('course_id')->constrained('course')->after('major_id')->nullable();
        });
    }
};
