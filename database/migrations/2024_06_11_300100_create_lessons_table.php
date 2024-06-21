<?php

use App\Enums\LessonStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tutor_id')->constrained();
            $table->foreignId('subject_id')->constrained();
            $table->foreignId('course_offering_id')->nullable()->constrained();
            $table->unsignedTinyInteger('capacity')->default(1);
            $table->string('title');
            $table->text('description');
            $table->datetime('starts_at');
            $table->datetime('ends_at');
            $table->string('status')->default(LessonStatus::Scheduled);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
