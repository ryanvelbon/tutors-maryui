<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AcademicYearSeeder extends Seeder
{
    public function run(): void
    {
        $grades = [
            'Primary 1',
            'Primary 2',
            'Primary 3',
            'Primary 4',
            'Primary 5',
            'Primary 6',
            'Form 1',
            'Form 2',
            'Form 3',
            'Form 4',
            'Form 5',
            '6th Form (1st year)',
            '6th Form (2nd year)',
        ];

        foreach ($grades as $grade) {
            DB::table('academic_years')->insert([
                'title' => $grade,
                'slug' => Str::slug($grade),
            ]);
        }
    }
}
