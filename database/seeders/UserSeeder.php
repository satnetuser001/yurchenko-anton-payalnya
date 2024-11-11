<?php

namespace Database\Seeders;

use App\Models\User;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory;

class UserSeeder extends Seeder
{
    protected $numberOfTestUsers = 500;

    /**
     * create a test users in database
     */
    public function run(): void
    {
        //create Faker with Ukrainian location
        $faker = Factory::create('uk_UA');

        //create the specified number of test users
        for ($i=0; $i < $this->numberOfTestUsers; $i++) { 
            User::create([
                'firstName' => $faker->firstName(),
                'lastName' => $faker->lastName(),
                'email' => $faker->unique()->safeEmail(),
                'phone_number' => $faker->phoneNumber(),
                'status' => $faker->randomElement([
                    'Потенційний',
                    'Активний',
                    'Неактивний',
                    'Втрачений',
                ]),
                'city' => $faker->city(),
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'remember_token' => Str::random(10),
            ]);
        }
    }
}
