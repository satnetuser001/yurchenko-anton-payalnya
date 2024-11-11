<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run all seeds
     */
    public function run(): void
    {
        $this->call([
            //Create a test users in database
            UserSeeder::class,
        ]);
    }
}
