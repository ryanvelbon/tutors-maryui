<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class SeedSampleData extends Command
{
    protected $signature = 'db:demo';

    protected $description = 'Seed the database with sample data for demo purposes';

    public function handle()
    {
        $this->info('Seeding database with sample data...');

        Artisan::call('db:seed', [
            '--class' => 'DemoSeeder'
        ]);

        $this->info('Sample data seeded successfully.');

        return Command::SUCCESS;
    }
}
