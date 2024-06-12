<?php

namespace Database\Seeders;

use App\Models\Tutor;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'username' => 'john2000',
            'email' => 'john@x.com',
        ]);

        $this->call([
            SubjectSeeder::class,
            LevelSeeder::class,
        ]);

        Tutor::factory(50)->create();
    }
}
