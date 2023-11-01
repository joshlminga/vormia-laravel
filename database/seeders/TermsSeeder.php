<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TermsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $this->hierarchy();
    }

    /**
     * Todo: Create Terms For Hierarchies
     * ? Select all from Hierarchies
     * ? Create Terms
     */
    public function hierarchy()
    {
        // Select all from Hierarchies
        $hierarchies = \App\Models\Vrm\Hierarchy::all();

        // Create Terms
        foreach ($hierarchies as $hierarchy) {
            \App\Models\Vrm\Term::create([
                "table" => "hierarchies",
                "type" => null,
                "related_id" => $hierarchy->id,
                "slug" => \App\Models\Vrm\Term::slug($hierarchy->name),
                "flag" => 1,
            ]);
        }
    }
}
