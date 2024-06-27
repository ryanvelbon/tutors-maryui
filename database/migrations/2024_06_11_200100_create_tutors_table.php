<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tutors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->onDelete('CASCADE');
            $table->timestamps();
        });

        Schema::create('tutor_subject_level', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tutor_id')->constrained()->cascadeOnDelete();
            $table->foreignId('subject_id')->constrained()->cascadeOnDelete();
            $table->foreignId('level_id')->constrained()->cascadeOnDelete();
            $table->unique(['tutor_id', 'subject_id', 'level_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tutor_subject_level');
        Schema::dropIfExists('tutors');
    }
};
