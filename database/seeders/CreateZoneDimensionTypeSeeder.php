<?php

namespace Database\Seeders;

use App\Models\Demand;
use App\Models\GroupZoneDimension;
use App\Models\ZoneDimensionType;
use Illuminate\Database\Seeder;

class CreateZoneDimensionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        ZoneDimensionType::firstOrCreate([
            "name" => "GAM",
        ]);

        ZoneDimensionType::firstOrCreate([
            "name" => "Adserver",
        ]);

        ZoneDimensionType::firstOrCreate([
            "name" => "Demand",
        ]);
    }
}
