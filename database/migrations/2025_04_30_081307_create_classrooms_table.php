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
        Schema::create('classroom', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->constrained('teacher');
            $table->foreignId('school_id')->constrained('school');
            $table->foreignId('major_id')->constrained('major');
            $table->string('name', 128);
            $table->string('classroom_number', 10);
            $table->string('desc', 255);
            $this->base($table);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classroom');
    }
};
