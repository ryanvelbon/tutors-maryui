<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'title' => 'Primary 1',
                'code'  => 'P1',
            ],
            [
                'title' => 'Primary 2',
                'code'  => 'P2',
            ],
            [
                'title' => 'Primary 3',
                'code'  => 'P3',
            ],
            [
                'title' => 'Primary 4',
                'code'  => 'P4',
            ],
            [
                'title' => 'Primary 5',
                'code'  => 'P5',
            ],
            [
                'title' => 'Primary 6',
                'code'  => 'P6',
            ],
            [
                'title' => 'Form 1',
                'code'  => 'F1',
            ],
            [
                'title' => 'Form 2',
                'code'  => 'F2',
            ],
            [
                'title' => 'Form 3',
                'code'  => 'F3',
            ],
            [
                'title' => 'Form 4',
                'code'  => 'F4',
            ],
            [
                'title' => 'Form 5 Paper A',
                'code'  => 'F5a',
            ],
            [
                'title' => 'Form 5 Paper B',
                'code'  => 'F5b',
            ],
            [
                'title' => '6th Form (Intermediate)',
                'code'  => 'F6i',
            ],
            [
                'title' => '6th Form (A-Level)',
                'code'  => 'F6a',
            ],
        ];

        foreach ($items as $data) {
            Level::create($data);
        }
    }
}
