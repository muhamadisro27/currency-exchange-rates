<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $this->command->info(PHP_EOL);
        $this->command->info('🧑🏻‍💻 Dummy Default System ' . PHP_EOL);
        $this->command->info('************ User Management ************' . PHP_EOL);
        $this->command->info('************************************' . PHP_EOL);

        $this->call(UserSeeder::class);

    }
}
