<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->foreignId('subject_id');
            $table->foreignId('level_id');
            $table->foreignId('tutor_id');
            $table->unsignedTinyInteger('total_hours');
            $table->unsignedInteger('price');
            $table->unsignedInteger('hourly_rate')->virtualAs('price / nullif(total_hours, 0)');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
