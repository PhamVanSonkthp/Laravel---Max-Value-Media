<?php

namespace Database\Seeders;

use App\Models\Demand;
use App\Models\GroupZoneDimension;
use Illuminate\Database\Seeder;

class CreateGroupZoneDimensionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GroupZoneDimension::firstOrCreate([
            "name" => "Ownership verification",
        ]);

        GroupZoneDimension::firstOrCreate([
            "name" => "Best Performance",
        ]);

        GroupZoneDimension::firstOrCreate([
            "name" => "GAM 360",
        ]);

        GroupZoneDimension::firstOrCreate([
            "name" => "Banner format",
        ]);

        GroupZoneDimension::firstOrCreate([
            "name" => "Video format",
        ]);

        GroupZoneDimension::firstOrCreate([
            "name" => "Native format",
        ]);

        GroupZoneDimension::firstOrCreate([
            "name" => "Mobile format",
        ]);
    }
}
