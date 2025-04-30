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
        Schema::create('assigment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('classroom_id')->constrained('classroom');
            $table->foreignId('course_id')->constrained('course');
            $table->string('name', 128);
            $table->text('desc')->nullable();
            $table->string('question_link', 255);
            $table->date('deadline');
            $this->base($table);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assigment');
    }
};
