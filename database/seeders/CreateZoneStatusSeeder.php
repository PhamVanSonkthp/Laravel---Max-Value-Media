<?php

namespace Database\Seeders;

use App\Models\CategoryWebsite;
use App\Models\News;
use App\Models\ZoneStatus;
use Illuminate\Database\Seeder;

class CreateZoneStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ZoneStatus::firstOrCreate([
            "name" => "PENDING",
            "adserver_id" => "7010",
        ]);

        ZoneStatus::firstOrCreate([
            "name" => "APPROVED",
            "adserver_id" => "7000",
        ]);

        ZoneStatus::firstOrCreate([
            "name" => "REJECTED",
            "adserver_id" => "7020",
        ]);

        ZoneStatus::firstOrCreate([
            "name" => "APPROVED (In active)",
            "adserver_id" => "7000",
        ]);

        ZoneStatus::firstOrCreate([
            "name" => "REVIEWING",
            "adserver_id" => "7000",
        ]);


    }
}
