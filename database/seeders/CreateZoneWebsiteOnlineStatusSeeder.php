<?php

namespace Database\Seeders;

use App\Models\CategoryWebsite;
use App\Models\News;
use App\Models\ZoneStatus;
use App\Models\ZoneWebsiteOnlineStatus;
use App\Models\ZoneWebsiteTimeType;
use Illuminate\Database\Seeder;

class CreateZoneWebsiteOnlineStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        ZoneWebsiteOnlineStatus::firstOrCreate([
            "name" => "Not check yet",
            "background_color" => "#f59e0b",
        ]);

        ZoneWebsiteOnlineStatus::firstOrCreate([
            "name" => "Online",
            "background_color" => "#22c55e",
        ]);

        ZoneWebsiteOnlineStatus::firstOrCreate([
            "name" => "Not online",
            "background_color" => "#ef4444",
        ]);

    }
}
