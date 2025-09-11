<?php

namespace Database\Seeders;

use App\Models\CategoryWebsite;
use App\Models\News;
use App\Models\ZoneStatus;
use App\Models\ZoneWebsiteTimeType;
use Illuminate\Database\Seeder;

class CreateZoneWebsiteTimeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ZoneWebsiteTimeType::firstOrCreate([
            "name" => "Second",
            "code" => "Second",
        ]);


    }
}
