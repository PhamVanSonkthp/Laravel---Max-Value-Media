<?php

namespace Database\Seeders;

use App\Models\AdScoreZoneStatus;
use App\Models\Demand;
use Illuminate\Database\Seeder;

class CreateAdScoreZoneStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdScoreZoneStatus::firstOrCreate([
            "name" => "Active",
        ]);

        AdScoreZoneStatus::firstOrCreate([
            "name" => "In Active",
        ]);
    }
}
