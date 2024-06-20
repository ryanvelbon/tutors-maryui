<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/*
| We are storing course details directly in the course_offerings table instead of fetching
| this data through the relationship so as to allow tutors to adjust specifics like price
| and duration for each course without affecting past offerings.
|
*/

return new class extends Migration
{
    private function defineCommonColumns(Blueprint $table)
    {
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
    }

    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $this->defineCommonColumns($table);
        });

        Schema::create('course_offerings', function (Blueprint $table) {
            $this->defineCommonColumns($table);
            $table->foreignId('course_id');
            $table->unsignedSmallInteger('capacity');
            $table->date('start_date');
            $table->string('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_offerings');
        Schema::dropIfExists('courses');
    }
};
