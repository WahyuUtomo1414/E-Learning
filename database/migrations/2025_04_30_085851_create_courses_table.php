<?php

use App\Traits\BaseModelSoftDelete;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    use BaseModelSoftDelete;
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('course', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->constrained('teacher');
            $table->foreignId('classroom_id')->constrained('classroom')->nullable();
            $table->string('name', 128);
            $table->string('desc', 255)->nullable();
            $table->string('learning_materials', 255)->nullable();
            $table->date('day');
            $table->time('check_in');
            $table->time('check_out');
            $this->base($table);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course');
    }
};
