<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeederHierarchy extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Countries
        $this->countries();

        // Currency
        $setting = \App\Models\Vrm\Setting::where('title', 'currency')->where('type', 'shop_defaults')->first(['value']);
        \App\Models\Vrm\Hierarchy::create([
            "type" => "currency",
            "parent" => 0,
            "name" => $setting->value,
            "flag" => 1,
        ]);
    }

    /**
     * Todo: For Hierarchy
     * ? Countries
     */
    public function countries()
    {
        /**
         * Todo: Add country
         * ? Generate array of countries
         * ? loop from array of countries
         * ? create country
         */
        $country = \App\Models\Vrm\Setting::where('title', 'country')->whereFlag(1)->first(['value']); //->toArray()
        $country = json_decode($country->value);
        foreach ($country as $index => $list) {
            // Create Country
            $table = \App\Models\Vrm\Hierarchy::create([
                "type" => "country",
                "parent" => 0,
                "name" => $list->name,
                "flag" => 1,
            ]);

            // Create Hierarchy Attributes
            \App\Models\Vrm\HierarchyAttributes::create([
                "hierarchy_id" => $table->id,
                "name" => 'country_code',
                "value" => $list->code,
            ]);

            // Create Hierarchy Attributes
            \App\Models\Vrm\HierarchyAttributes::create([
                "hierarchy_id" => $table->id,
                "name" => 'country_dial_code',
                "value" => $list->dial_code,
            ]);
        }
    }

}
