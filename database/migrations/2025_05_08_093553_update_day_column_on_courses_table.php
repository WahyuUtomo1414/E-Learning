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
        Schema::table('course', function (Blueprint $table) {
            $table->dropColumn('day'); // Hapus kolom lama (date)
            $table->foreignId('day_id')->after('learning_materials')->constrained('day');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('course', function (Blueprint $table) {
            $table->dropForeign(['day_id']);
            $table->dropColumn('day_id');
            $table->date('day')->nullable();
        });
    }
};
