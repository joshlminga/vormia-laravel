<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Vrm\User;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        User::create([
            "name" => $faker->name,
            "username" => 'kelvin',
            "email" => $faker->email,
            "phone" => $faker->regexify('[0-9]{7,10}'),
            "password" => bcrypt('kelvin'),
            "level" => 'manager',
            "flag" => 1,
        ]);
    }
}
