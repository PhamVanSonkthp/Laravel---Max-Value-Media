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
            "name" => "Adx Banner",
        ]);

        GroupZoneDimension::firstOrCreate([
            "name" => "Video",
        ]);

        GroupZoneDimension::firstOrCreate([
            "name" => "Native",
        ]);

        GroupZoneDimension::firstOrCreate([
            "name" => "Direct Campaign",
        ]);

        GroupZoneDimension::firstOrCreate([
            "name" => "MAGIC",
        ]);
    }
}
