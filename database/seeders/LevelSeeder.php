<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Vrm\Level::create([
            "name" => 'superadmin',
            "module" => 'main,user,seller,member',
            "flag" => 1,
        ]);

        \App\Models\Vrm\Level::create([
            "name" => 'manager',
            "module" => 'invoice',
            "flag" => 1,
        ]);

        \App\Models\Vrm\Level::create([
            "name" => 'seller',
            "module" => 'seller-dashboard,seller-product,seller-profile,seller-order,seller-invoice,seller-setting',
            "flag" => 1,
        ]);

        \App\Models\Vrm\Level::create([
            "name" => 'customer',
            "module" => 'customer-dashboard,customer-profile,customer-wishlist,customer-order,customer-invoice,customer-setting',
            "flag" => 1,
        ]);
    }
}
