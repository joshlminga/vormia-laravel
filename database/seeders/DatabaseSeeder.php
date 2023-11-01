<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Add SettingSeeder
        $this->call(SettingSeeder::class);

        // Access Level
        $level = LevelSeeder::class;
        $this->call($level);

        //Admin
        \App\Models\Vrm\User::create([
            "name" => "John Doe",
            "username" => "admin",
            "email" => "admin@vrm.com",
            "phone" => null,
            "password" => bcrypt("admin"),
            "level" => "superadmin",
            "authority" => "a",
            "flag" => 1,
        ]);

        // Add UserSeeder
        $user = UserSeeder::class;
        $this->call($user);

        // Add SeederHierarchy
        $this->call(SeederHierarchy::class);

        // Exhange Rate
        \App\Models\Vrm\Setting::create([
            "type" => "called",
            "title" => "exhange",
            "value" => 120,
            "flag" => 1,
        ]);

        // Add TermsSeeder
        $this->call(TermsSeeder::class);
    }
}
