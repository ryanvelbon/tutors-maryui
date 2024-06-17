<?php

namespace Database\Seeders;

use App\Models\School;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['name' => 'San Anton School', 'type' => 'pvt'],
            ['name' => 'St. Aloysius\' College', 'type' => 'church'],
            ['name' => 'St. Augustine College', 'type' => 'church'],
            ['name' => 'St. Catherine\'s High School', 'type' => 'pvt'],
            ['name' => 'St. Edward\'s College', 'type' => 'pvt'],
            ['name' => 'St. Joseph School', 'type' => 'church'],
            ['name' => 'St. Martin\'s College', 'type' => 'pvt'],
            ['name' => 'St. Michael School', 'type' => 'pvt'],
            ['name' => 'St. Monica School', 'type' => 'church'],
            ['name' => 'De La Salle College', 'type' => 'church'],
            ['name' => 'Verdala International School', 'type' => 'pvt'],
        ];

        School::insert($data);
    }
}
