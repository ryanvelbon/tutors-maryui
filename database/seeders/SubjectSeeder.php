<?php

namespace Database\Seeders;

use App\Models\Level;
use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SubjectSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'subjects' => ['Mathematics', 'English', 'Maltese'],
                'levels' => ['P1', 'P2', 'P3', 'P4', 'P5', 'P6', 'F1', 'F2', 'F3', 'F4', 'F5a', 'F5b', 'F6a', 'F6i'],
            ],
            [
                'subjects' => ['Italian', 'French', 'German', 'Spanish', 'Arabic', 'Russian', 'Chinese'],
                'levels' => ['F1', 'F2', 'F3', 'F4', 'F5a', 'F5b', 'F6a', 'F6i'],
            ],
            [
                'subjects' => ['Physics', 'Biology', 'Chemistry', 'Accounting', 'Economics', 'Computer Science'],
                'levels' => ['F3', 'F4', 'F5a', 'F5b', 'F6a', 'F6i'],
            ],
            [
                'subjects' => ['Marketing', 'Philosophy', 'Sociology', 'History', 'Latin'],
                'levels' => ['F6a', 'F6i'],
            ],
        ];

        foreach ($data as $item) {

            $levelIds = Level::whereIn('code', $item['levels'])->pluck('id');

            foreach ($item['subjects'] as $title) {

                $subject = Subject::create([
                    'title' => $title,
                    'slug' => Str::slug($title),
                ]);

                $subject->levels()->attach($levelIds);
            }
        }
    }
}
