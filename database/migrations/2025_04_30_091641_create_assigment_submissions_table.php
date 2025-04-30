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
        Schema::create('assigment_submission', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assigment_id')->constrained('assigment');
            $table->string('answer_link', 255);
            $table->string('score', 3)->nullable();
            $table->text('feedback')->nullable();
            $this->base($table);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assigment_submission');
    }
};
