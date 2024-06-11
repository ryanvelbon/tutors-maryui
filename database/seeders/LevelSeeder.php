<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LevelSeeder extends Seeder
{
    public function run(): void
    {
        $levels = [
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
            'Form 5 Paper A',
            'Form 5 Paper B',
            '6th Form (Intermediate)',
            '6th Form (A-Level)',
        ];

        foreach ($levels as $level) {
            DB::table('levels')->insert([
                'title' => $level,
                'slug' => Str::slug($level),
            ]);
        }
    }
}
