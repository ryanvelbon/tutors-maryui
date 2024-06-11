<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SubjectSeeder extends Seeder
{
    public function run(): void
    {
        $subjects = [
            'Mathematics',
            'Physics',
            'Biology',
            'Chemistry',
            'Computer Science',
            'Accounting'
        ];

        foreach ($subjects as $subject) {
            DB::table('subjects')->insert([
                'title' => $subject,
                'slug' => Str::slug($subject),
            ]);
        }
    }
}
